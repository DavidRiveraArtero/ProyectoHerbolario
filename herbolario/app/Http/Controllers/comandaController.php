<?php

namespace App\Http\Controllers;

use App\Models\comanda;
use App\Models\lista_producto;
use App\Models\Producto;
use App\Models\direccione;
use App\Models\FotosProducto;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use App\Mail\AdminProductosCompradoMail;

class comandaController extends Controller
{

    private $apiContext;


    public function __construct(){
        // PAYPAL
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret'],
            )
        );
    }

    public function store(Request $request)
    {

        $precio = 0;
        $listaP = lista_producto::all()->where('id_usuario','=',Auth::user()->id);
        $listaP = $listaP->where('finalizado','=',0);
        if(count($listaP)>0) {
            $stocks = [];


            foreach ($listaP as $lista) {
                $producto = Producto::all()->where('id', '=', $lista->id_producto)->first();
                $precio += ($producto->precio * $lista->cantidad) * 1.21;
                array_push($stocks, Producto::all()->where('id','=',$lista->id_producto)->first());
            }
            foreach ($stocks as $stock){
                if ($stock->cantidad <= 0){
                    return Redirect::back()->with('success','Lo sentimos pero uno de nuestros productos no tiene stock no podemos seguir con la compra');
                }
                foreach ($listaP as $lista) {
                    if($lista->cantidad > $stock->cantidad){
                        return Redirect::back()->with('success','Lo sentimos pero has seleccionado m??s productos de los que tenemos en stock');
                    }
                }
            }


            comanda::create([
                'id_direccion'=>$request->id_direccion,
                'id_usuario' => Auth::user()->id,
                'estado'=>0
            ]);


            // PAYPAL
            $payer = new Payer();
            $payer->setPaymentMethod('paypal'); // METODO DE PAGO

            $amount = new Amount();
            $amount->setTotal($precio); // PRECIO QUE PAGARA EL USUARIO
            $amount->setCurrency('EUR'); // LA MONENDA

            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription('Producto');

            $callbackUrl = url('/paypal/status');
            $redirectUrl = new RedirectUrls();
            $redirectUrl->setReturnUrl($callbackUrl)->setCancelUrl($callbackUrl);

            $payment = new Payment();
            $payment->setIntent('sale')->setPayer($payer)->setTransactions(array($transaction))->setRedirectUrls($redirectUrl);

            try{
                $payment->create($this->apiContext);
                //echo $payment;

                return redirect()->away($payment->getApprovalLink()); // LINK VALIDADO POR PAYPAL

            }catch (PayPalConfigurationException $ex){
                echo $ex->getData();
            }

        }else{
            return Redirect::back()->with('success','Lo sentimos no tienes ningun producto para comprar');

        }
    }

    public function payPalStatus(Request $request){
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if(!$paymentId || !$payerId || !$token){
            return Redirect::back()->with('success', 'Error En la compra');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $exceution = new PaymentExecution();
        $exceution->setPayerId($payerId);

        $result = $payment->execute($exceution, $this->apiContext);

        if($result->getState() === 'approved'){
            $precio = 0;
            $listaP = lista_producto::all()->where('id_usuario','=',Auth::user()->id);
            $listaP = $listaP->where('finalizado','=',0);

            $comanda = comanda::all()->where('id_usuario','=',Auth::user()->id);
            $comanda = $comanda->where('estado','=',0)->first();

            foreach ($listaP as $lista) {
                $producto = Producto::all()->where('id', '=', $lista->id_producto)->first();
                $precio += ($producto->precio * $lista->cantidad)  * 1.21;
                $producto->updateOrFail([
                   'cantidad'=>$producto->cantidad - $lista->cantidad
                ]);
            }

            $ok = $comanda->updateOrFail([
                'precio_final' => $precio,
                'estado'=>1
            ]);

            foreach ($listaP as $lista)
                $lista->updateOrFail([
                    'id_comanda' => $comanda->id,
                    'finalizado' => true
                ]);
            $direccion = direccione::all()->where('id','=',$comanda->id_direccion)->first();
            $listaProductos = [];
            $fotoProducto = [];

            foreach ($listaP as $lista) {
                array_push($listaProductos,  Producto::all()->where('id', '=', $lista->id_producto)->first());
                array_push($fotoProducto, FotosProducto::all()->where('id_product','=',$lista->id_producto)->first());
            }

            $details = [
                'NombreUser'=>Auth::user()->name,
                'correo'=>Auth::user()->email,
                'telefono'=> $direccion->telefono,
                'direccion_envio'=>$direccion->linea_direccion,
                'codigo_postal'=>$direccion->codigo_postal,
                'provincia'=>$direccion->provincia,
                'ciudad' =>$direccion->ciudad,
                'productos'=>$listaProductos,
                'foto_producto'=>$fotoProducto
            ];
            \Mail::to('dariar@fp.insjoaquimmir.cat')->send(new AdminProductosCompradoMail($details));
            $status = "Gracias. El pago a traves de PayPal se ha realizado correctamente.";
            return redirect()->route('carrito.index')->with('success',$status);


        }else{
            $comanda = comanda::all()->where('id_usuario','=',Auth::user()->id);
            $comanda = $comanda->where('estado','=',0)->first();

            $comanda->delete();
            $status = "Lo sentimos. El pago a traves de PayPal no se pudo realizar.";
            return redirect()->route('carrito.index')->with('success',$status);
        }

    }
}
