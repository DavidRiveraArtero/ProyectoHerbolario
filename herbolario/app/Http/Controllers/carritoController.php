<?php

namespace App\Http\Controllers;

use App\Models\lista_producto;
use App\Models\FotosProducto;
use App\Models\Producto;
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

        $listaP = $listaP->where('finalizado','=','0');

        $precio = 0;
        $FotoProducto=[];
        $Productos = [];


        foreach ($listaP as $lista){
            $producto = Producto::all()->where('id','=',$lista->id_producto)->first();
            $precio+=$producto->precio;
            array_push($FotoProducto,FotosProducto::all()->where('id_product','=',$lista->id_producto)->first());
            array_push($Productos,Producto::all()->where('id','=',$lista->id_producto)->first());
        }




        return view('user.carrito.carritoIndex',[
            'listaP' => $listaP,
            'FotoUsuario'=>$avatar,
            'precioF'=>$precio,
            'fotoProducto'=>$FotoProducto,
            'producto'=> $Productos
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
        if($store->cantidad != 0){
            $ok = lista_producto::create([
                'id_usuario'=>Auth::user()->id,
                'id_producto'=>$request->id,
                'finalizado'=>false
            ]);

            if($ok){
                return Redirect::back()->with('success','Elemento agregado al carrito');
            }
        }else{
            return Redirect::back()->with('success','Lo sentimos no tenemos stock');
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
        //
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
}
