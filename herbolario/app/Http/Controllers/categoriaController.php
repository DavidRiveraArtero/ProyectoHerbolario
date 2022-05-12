<?php

namespace App\Http\Controllers;

use App\Models\Avatar_usuarios;
use App\Models\categoria_producto;
use App\Models\FotosProducto;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function categoria($categoria){
        $productos = [];
        $producto_categoria = categoria_producto::all()->where('categoria','=',$categoria);
        foreach ($producto_categoria as $key => $categorias){
            array_push($productos, Producto::all()->where('id','=',$categorias->id_producto)->first());
        }


        if($categoria == "todo"){
            if(Auth::user()) {
                $fotoUser = Avatar_usuarios::all()->where('id_usuario', '=', Auth::user()->id);
                return redirect()->route('home.index');
            }else {
                return redirect()->route('home.index');
            }
        }else{
            if(Auth::user()) {
                $fotoUser = Avatar_usuarios::all()->where('id_usuario', '=', Auth::user()->id);
                return view("home.index",[
                    "productos" => $productos,
                    "FotosProducto" => FotosProducto::all(),
                    "FotoUsuario" => $fotoUser
                ]);
            }else{
                return view("home.index",[
                    "productos" => $productos,
                    "FotosProducto" => FotosProducto::all(),
                ]);
            }
        }
    }

    public function index()
    {

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function show(categoria_producto $categoria_producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(categoria_producto $categoria_producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoria_producto $categoria_producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoria_producto $categoria_producto)
    {
        //
    }
}
