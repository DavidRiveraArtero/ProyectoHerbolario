<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\FotosProducto;

use Illuminate\Http\Request;

class AdminProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.productos.index',[
            "productos"=>Producto::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.productos.create");
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
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'cantidad'=>'required',
            'file_path'=>'required'
        ]);

        $ok = Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'cantidad'=> $request->cantidad,
            'descripcion' => $request->descripcion,

        ]);


        if($ok){

            $long = $request->file_path;


            for($x = 0; $x<count($long); $x++){
                FotosProducto::create([
                    'id_product'=>$ok->id,
                    'file_path'=>$long[$x],
                ]);
            }

            return redirect()->route('productos.index')->with('success', 'Producto Creado');
        }else{
            return redirect()->route('productos.index')->with('success', 'Producto Creado');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {

        return view("admin.productos.show",[
            "producto" => $producto
        ]);
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
        $foto_id = FotosProducto::where('id_product',$producto->id)->delete();
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
}
