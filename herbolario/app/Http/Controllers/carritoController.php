<?php

namespace App\Http\Controllers;

use App\Models\lista_producto;
use App\Models\FotosProducto;
use App\Models\Producto;
use App\Models\direccione;
use Illuminate\Http\Request;
use App\Models\Avatar_usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class carritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $avatar = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
        $listaP = lista_producto::all()->where('id_usuario','=',Auth::user()->id);
        $direcciones = direccione::all()->where('id_usuario','=',Auth::user()->id);
        $listaP = $listaP->where('finalizado','=','0');

        $precio = 0;
        $FotoProducto=[];
        $Productos = [];


        foreach ($listaP as $lista){
            $producto = Producto::all()->where('id','=',$lista->id_producto)->first();
            $precio+=$producto->precio * 1.21;
            array_push($FotoProducto,FotosProducto::all()->where('id_product','=',$lista->id_producto)->first());
            array_push($Productos,Producto::all()->where('id','=',$lista->id_producto)->first());
        }



        return view('user.carrito.carritoIndex',[
            'listaP' => $listaP,
            'FotoUsuario'=>$avatar,
            'precioF'=>$precio,
            'fotoProducto'=>$FotoProducto,
            'producto'=> $Productos,
            'direcciones'=>$direcciones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Producto::all()->where('id','=',$request->id)->first();

        $listaProduct = lista_producto::all()->where('id_producto','=',$request->id);

        $estado = false;
        if($store->cantidad != 0){


            foreach ($listaProduct as $lista) {

                if ($lista->id_producto == $request->id && $lista->finalizado == 0) {

                    $cantidad = $lista->cantidad + 1;

                    $ok = $lista->updateOrFail([

                        'cantidad' => $cantidad

                    ]);
                    $estado = true;
                }

            }
            if($estado == false){
                $ok = lista_producto::create([
                    'id_usuario' => Auth::user()->id,
                    'id_producto' => $request->id,
                    'finalizado' => false,
                    'cantidad' => 1
                ]);
            }


            if(count($listaProduct) == 0){
                dd("adios");
                $ok = lista_producto::create([
                    'id_usuario'=>Auth::user()->id,
                    'id_producto'=>$request->id,
                    'finalizado'=>false,
                    'cantidad'=> 1
                ]);
            }



            return Redirect::back()->with('success', 'Elemento agregado al carrito');



        }

        if ($request->ajax()) {
              return [
                    "success" => false,
                    "message" => "Lo sentimos no tenemos stock"
                ];
        } else {
            return Redirect::back()->with('success', 'Lo sentimos no tenemos stock');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lista_producto  $lista_producto
     * @return \Illuminate\Http\Response
     */
    public function show(lista_producto $lista_producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lista_producto  $lista_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(lista_producto $lista_producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lista_producto  $lista_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lista_producto $lista_producto)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lista_producto  $lista_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $lista_producto = lista_producto::all()->where('id','=',$id)->first();

        $lista_producto->delete();
        return Redirect::back()->with('success','Producto eliminado del carrito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */

    public function cantidProducto(Request $request)
    {
        $lista = lista_producto::all()->where('id_producto','=',$request->id);
        $listaU = $lista->where('id_usuario','=', Auth::user()->id);



        foreach ($listaU as $listaF){
            if($listaF->finalizado == 0){
                $listaF->updateOrFail([
                    'cantidad'=>$request->quantitat
                ]);
            }
        }


        return Redirect::back()->with('success', 'Elemento agregado al carrito');

    }





}

