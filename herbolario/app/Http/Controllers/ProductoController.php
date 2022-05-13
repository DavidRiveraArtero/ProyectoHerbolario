<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\FotosProducto;
use App\Models\Avatar_usuarios;
use App\Models\User;
use App\Models\lista_producto;
use App\Models\comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            $fotoUser = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
            return view("home.index",[
                "productos" => Producto::all(),
                "FotosProducto" => FotosProducto::all(),
                "FotoUsuario" => $fotoUser
            ]);
        }else{
            return view("home.index",[
                "productos" => Producto::all(),
                "FotosProducto" => FotosProducto::all(),
            ]);
        }

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
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto,$id)
    {

        $fotoProducto = FotosProducto::all()->where('id_product','=',$id);

        $producto = Producto::where('id',$id)->first();

        $cometario = comentario::all()->where('id_producto','=',$id);



        if(Auth::user()) {
            $loCompro = lista_producto::all()->where('id_usuario','=',Auth::user()->id);
            $loCompro = $loCompro->where('id_producto','=',$id);
            $loCompro = $loCompro->where('id_comanda','<>',"");

            $fotoUser = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);

            return view("home.show", [
                "producto" => $producto,
                "fotoProducto" => $fotoProducto,
                "FotoUsuario" => $fotoUser,
                "comentarios" => $cometario,
                'usuarios'=> User::all(),
                'loCompro'=>$loCompro


            ]);
        }else{
            return view("home.show", [
                "producto" => $producto,
                "fotoProducto" => $fotoProducto,
                "comentarios" => $cometario,
                'usuarios'=> User::all()


            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
