<?php

namespace App\Http\Controllers;

use App\Models\comanda;
use App\Models\Avatar_usuarios;
use App\Models\FotosProducto;
use App\Models\Producto;
use App\Models\direccione;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\lista_producto;

class misPedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avatar = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
        $comanda = comanda::all()->where('id_usuario','=',Auth::user()->id);
        $listaP = lista_producto::all()->where('id_usuario','=',Auth::user()->id);
        $listaP = $listaP->where('finalizado','=',true);
        $listaFoto = [];
        $productos = [];
        $direccions = [];
        $direccion = direccione::all()->where('id_usuario','=',Auth::user()->id);

        foreach ($listaP as $key => $lista){
            array_push($listaFoto, FotosProducto::all()->where('id_product','=',$lista->id_producto)->first());
            array_push($productos, Producto::all()->where('id','=',$lista->id_producto)->first());
        }

        foreach ($comanda as $com){
            array_push($direccions, $direccion->where('id','=',$com->id_direccion)->first());
        }

        return view('user.pedidos.misPedidos',[
            'FotoUsuario'=>$avatar,
            'comandas'=>$comanda,
            'foto_producto'=>$listaFoto,
            'listaP'=>$listaP,
            'productos'=>$productos,
            'direccions'=>$direccions
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
     * @param  \App\Models\comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function show(comanda $comanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function edit(comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comanda $comanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(comanda $comanda)
    {
        //
    }
}
