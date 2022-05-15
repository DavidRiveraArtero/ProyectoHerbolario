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

        return view('admin.categoria.indexCategoria',[
            "categorias"=>categoria_producto::paginate(10),
            "nameProducto"=>Producto::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.createCategoria',[
            'productos'=>Producto::all(),
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
            "categorias"=>'required',
            "productos"=>'required',
        ]);
        $todasCategorias= categoria_producto::all()->where('categoria','=',$request->categorias);

        foreach ($todasCategorias as $categoria){
            if($categoria->id_producto == $request->productos){
                return redirect()->route('adminCategoria.index')->with('success','Lo sentimos este producto ya tiene esa categoria');
            }
        }


        categoria_producto::create([
            'categoria'=>$request->categorias,
            'id_producto'=>$request->productos
        ]);

        return redirect()->route('adminCategoria.index')->with('success','Categoria Creada');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function show(categoria_producto $categoria_producto)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(categoria_producto $categoria_producto,$id)
    {
        $categoriaSelect = categoria_producto::all()->where('id','=',$id)->first();
        $producSelect = Producto::all()->where('id','=',$categoriaSelect->id_producto)->first();

        return view('admin.categoria.updateCategoria',[
            'categoriaSelect'=>$categoriaSelect,
            'productSelect'=>$producSelect,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categoria_producto $categoria_producto,$id)
    {

        $categoria_producto = categoria_producto::all()->where('id','?',$id)->first();
        $request->validate([
            'categorias'=>'required'
        ]);

        $ok = $categoria_producto->updateOrFail([
            'categoria'=>$request->categorias
        ]);

        if($ok){
            return redirect()->route('adminCategoria.index')->with('success','Se cambio la categoria del producto correctamente');
        }else{
            return redirect()->route('adminCategoria.index')->with('success','Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoria_producto  $categoria_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(categoria_producto $categoria_producto, $id)
    {
        $categoria = categoria_producto::all()->where('id','=',$id)->first();
        $categoria->delete();
        return Redirect::back()->with('success','Producto quitado de la categoria');
    }
}
