<?php

namespace App\Http\Controllers;

use App\Models\comanda;
use App\Models\lista_producto;
use App\Models\Producto;

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

            foreach ($listaP as $lista) {
                $producto = Producto::all()->where('id', '=', $lista->id_producto)->first();
                $precio += $producto->precio;
            }

            // PAYPAL
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $amount = new Amount();
            $amount->setTotal($precio);
            $amount->setCurrency('EUR');

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

            foreach ($listaP as $lista) {
                $producto = Producto::all()->where('id', '=', $lista->id_producto)->first();
                $precio += $producto->precio;
            }

            $ok = comanda::create([
                'id_usuario' => Auth::user()->id,
                'precio_final' => $precio,
            ]);

            if ($ok) {
                foreach ($listaP as $lista)
                    $lista->updateOrFail([
                        'id_comanda' => $ok->id,
                        'finalizado' => true
                    ]);
            }


            $status = "Gracias. El pago a traves de PayPal se ha realizado correctamente.";
            return Redirect::back()->with('success', $status);
        }

        $status = "Lo sentimos. El pago a traves de PayPal no se pudo realizar.";
        return Redirect::back()->with('success', $status);

    }
}
