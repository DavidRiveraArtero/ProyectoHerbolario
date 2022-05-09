<?php

namespace App\Http\Controllers;

use App\Models\comanda;
use App\Models\Avatar_usuarios;
use App\Models\FotosProducto;

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

        for($x = 0;$x<count($listaP);$x++){
            array_push($listaFoto, FotosProducto::all()->where('id_product','=',$listaP[$x]->id_producto)->first());
        }



        return view('user.pedidos.misPedidos',[
            'FotoUsuario'=>$avatar,
            'comandas'=>$comanda,
            'foto_producto'=>$listaFoto,
            'listaP'=>$listaP
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
