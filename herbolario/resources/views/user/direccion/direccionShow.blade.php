@extends('layoutsCompartido.body')
@section('content')
    <div class="" style="margin-bottom: 40px; margin-top:50px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Añadir Direccion</span>
            <h3 style="font-weight: bold;">Añadir Direccion</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6 form_direccion">
                <form style="margin-top: 15px" method="post" action="{{route("direccion.update",$direccion->id)}}">
                    @csrf
                    @method('put')
                    <h4 class="col-lg-12 col-12">Pais/Region</h4>
                    <select name="pais" class="col-lg-12 col-12 border_bottom">
                        <option value="">------</option>
                        <option value="España">España</option>
                    </select><br/><br/><br/>

                    <h4 class="col-lg-12 col-12">Nombre Usuario</h4>
                    <input name="nombre" class="col-lg-12 col-12 border_bottom" type="text" placeholder="Nombre" value="{{$direccion->nombre}}"><br/><br/><br/>

                    <h4 class="col-lg-12 col-12">Numero de telefono</h4>
                    <input name="telefono" class="col-lg-12 col-12 border_bottom" type="text" placeholder="Numero de telefono" value="{{$direccion->telefono}}"><br/><br/><br/>

                    <h4 class="col-lg-12 col-12">Direccion</h4>
                    <input name="direccion" class="col-lg-12 col-12 border_bottom" type="text" placeholder="Direccion" value="{{$direccion->linea_direccion}}"><br/><br/><br/>

                    <div class="col-lg-6 col-12" style="float: left">
                        <h4 class="col-lg-11 col-12">Codigo Postal</h4>
                        <input name="codigo_postal" class="col-lg-11 col-12 border_bottom" type="text" placeholder="Codigo Postal" value="{{$direccion->codigo_postal}}">
                    </div>
                    <div class="col-lg-6 col-12" style="float: left">
                        <h4 class="col-lg-11 col-12">Ciudad</h4>
                        <input name="ciudad" class="col-lg-12 col-12 border_bottom" style="margin-bottom: 40px" type="text" placeholder="Ciudad" value="{{$direccion->ciudad}}">
                    </div>

                    <div >
                        <h4 class="col-lg-12 col-12" style="margin-top: 40px">Provincia</h4>
                        <input name="provincia" class="col-lg-12 col-12 border_bottom" type="text" placeholder="Provincia" value="{{$direccion->provincia}}"><br/><br/><br/>
                    </div>
                    <div class="col-lg-12 col-12" >
                        <button type="submit" class="btn btn-success col-lg-5 col-12" style="float: left;margin-bottom: 20px; margin-right: 100px">Editar</button>
                        <form method="post" action="{{route('direccion.destroy',$direccion)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger col-lg-5 col-12" style="float: left">Eliminar</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

