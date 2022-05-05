<?php

namespace App\Http\Controllers;

use App\Models\direccione;
use App\Models\Avatar_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class direccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotosUsuario = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
        $direccionUser = direccione::all()->where('id_usuario','=',Auth::user()->id);
        return view('user.direccion.index',[
            'FotoUsuario'=>$fotosUsuario,
            'direcciones'=>$direccionUser
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fotosUsuario = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
        return view('user.direccion.direccionCreate',[
            'FotoUsuario'=>$fotosUsuario
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pais'=>'required',
            'nombre'=>'required',
            'telefono'=>'required|regex:/[0-9]{9}/',
            'direccion'=>'required',
            'codigo_postal'=>'required',
            'ciudad'=>'required',
            'provincia'=>'required'

        ]);

        $ok = direccione::create([
            'id_usuario'=>Auth::user()->id,
            'nombre'=>$request->nombre,
            'pais'=>$request->pais,
            'telefono'=>$request->telefono,
            'linea_direccion'=>$request->direccion,
            'codigo_postal'=>$request->codigo_postal,
            'ciudad'=>$request->ciudad,
            'provincia'=>$request->provincia,
        ]);

        if($ok){
            return redirect()->route('direccion.index')->with('success','Direccion creada');
        }else{
            return redirect()->route('direccion.index')->with('error','Error no se pudo crear la direccion');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\direccione  $direccione
     * @return \Illuminate\Http\Response
     */
    public function show(direccione $direccione, $id)
    {
        $fotosUsuario = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
        $direccione = $direccione::all()->where('id','=',$id)->first();
        return view('user.direccion.direccionShow',[
            'direccion'=>$direccione,
            'FotoUsuario'=>$fotosUsuario
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\direccione  $direccione
     * @return \Illuminate\Http\Response
     */
    public function edit(direccione $direccione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\direccione  $direccione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        dd("HOAL");
        $request->validate([
            'pais'=>'required',
            'nombre'=>'required',
            'telefono'=>'required|regex:/[0-9]{9}/',
            'direccion'=>'required',
            'codigo_postal'=>'required',
            'ciudad'=>'required',
            'provincia'=>'required'

        ]);

        $direccion = direccione::all()->where('id','=',$id)->first();

        $ok= $direccion->updateOrFail([
            'id_usuario'=>Auth::user()->id,
            'nombre'=>$request->nombre,
            'pais'=>$request->pais,
            'telefono'=>$request->telefono,
            'linea_direccion'=>$request->direccion,
            'codigo_postal'=>$request->codigo_postal,
            'ciudad'=>$request->ciudad,
            'provincia'=>$request->provincia,
        ]);

        if($ok){
            return redirect()->route('direccion.index')->with('success','Direccion editada');
        }else{
            return redirect()->route('direccion.index')->with('error','Error no se pudo crear la direccion');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\direccione  $direccione
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $direccion = direccione::all()->where('id','=',$id)->first();
        $direccion->delete();
        return redirect()->route('direccion.index')->with('success', 'Producto eliminado');
    }
}
