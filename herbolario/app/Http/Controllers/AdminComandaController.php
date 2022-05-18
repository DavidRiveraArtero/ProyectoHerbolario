<?php

namespace App\Http\Controllers;

use App\Models\comanda;
use App\Models\lista_producto;
use Illuminate\Http\Request;

class AdminComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todaLista = lista_producto::all();

        $todaComanda = comanda::all();

        $listaP = [];

        $cantidad = 0;

        $precioTot = 0;

        foreach ($todaComanda as $comanda){

            $precioTot+=$comanda->precio_final;

            foreach ( $todaLista as $lista){

              if($lista->id_comanda == $comanda->id){

                  $cantidad++;

              }

            }

            array_push($listaP, $cantidad);

            $cantidad = 0;

        }

        return view('admin.comanda.comandaIndex',[

            'comandas'=>comanda::paginate(9),

            'cantidades' => $listaP,

            'precioTotal'=> $precioTot

        ]);
    }

    public function filtrarComanda(Request $request){

        $com =  comanda::whereBetween('created_at',[$request->fechaInicio, $request->fechaFin])->paginate(9);

        $todaLista = lista_producto::all();

        $listaP = [];

        $cantidad = 0;

        $precioTot = 0;

        foreach ($com as $comanda){

            $precioTot+=$comanda->precio_final;

            foreach ( $todaLista as $lista){

                if($lista->id_comanda == $comanda->id){

                    $cantidad++;

                }

            }

            array_push($listaP, $cantidad);

            $cantidad = 0;
        }
        return view('admin.comanda.comandaIndex',[

            'comandas'=>$com,

            'cantidades' => $listaP,

            'precioTotal'=> $precioTot

        ]);


    }
}
