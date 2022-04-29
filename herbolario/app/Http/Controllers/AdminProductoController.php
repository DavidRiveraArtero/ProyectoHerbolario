<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\FotosProducto;
use Illuminate\Support\Facades\Storage;

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


            for($x = 0; $x < count($long); $x++){
                $upload = $request->file('file_path');
                $ruta = 'uploads/' . $request->nombre;
                $fileName = $request->file('file_path')[$x]->getClientOriginalName();
                $fileUpload = time() . "_" . $fileName;
                $filePath = $upload[$x]->storeAs(
                    $ruta,
                    $fileUpload,
                    'public'
                );

                if(\Storage::disk('public')->exists($filePath)) {

                    $fullPath = \Storage::disk('public')->path($filePath);

                    FotosProducto::create([
                        'id_product' => $ok->id,
                        'file_path' => $filePath,
                    ]);

                }
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
        return view("admin.productos.edit",[
            "producto" => $producto
        ]);
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
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'cantidad'=>'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $storageDisk = FotosProducto::where('id_product',$producto->id)->get();

        Storage::disk('public')->delete($storageDisk[0]->file_path);

        $foto_id = FotosProducto::where('id_product',$producto->id)->delete();

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
}
