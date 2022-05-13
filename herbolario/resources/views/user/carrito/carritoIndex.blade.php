@extends('layoutsCompartido.body')
@section('content')
    <div class="" style="margin-bottom: 40px; margin-top:50px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Carrito</span>
            <h3 style="font-weight: bold;">Lista Carrito</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @if(session()->has('success'))
                <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
                    {{ session()->get('success') }}
                </div>
            @endif

            @foreach($fotoProducto as $key => $foto)

                <div class="col-lg-6" style="margin-bottom: 45px">
                    <img class="col-lg-5" src="{{asset('storage/'.$foto->file_path)}}" style="float: left">

                    <h3 class="col-lg-7" style="float: left">Producto: {{$producto[$key]->nombre}}</h3>

                    <h3 class="col-lg-7" style="float: left">Precio: {{$producto[$key]->precio}}$</h3>
                    @foreach($listaP as $lista)
                    <form method="post" action="{{route('carrito.destroy',$lista->id)}}">
                    @endforeach
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger col-lg-2">Eliminar</button>
                    </form>
                </div>
            @endforeach



                <div class="col-lg-6" id="contenedor_direccion">
                    <h2 class="col-lg-12" style="text-align: center">Direcciones</h2>
                    <form method="post" action="{{route('comanda.store')}}" style="margin-top: 30px">
                        @csrf
                        @method('post')
                        <select class="col-lg-12" style="margin-bottom: 30px" name="id_direccion">
                            @foreach($direcciones as $direccion)
                                <option value="{{$direccion->id}}">{{$direccion->linea_direccion}}</option>
                            @endforeach
                        </select>
                        <h4>Precio Total = {{$precioF}}$</h4>

                        <input readonly name="precio" type="hidden" value="{{$precioF}}">
                        <button type="submit" class="btn btn-success">Finalizar Compra</button>
                    </form>
                </div>



        </div>
    </div>
@endsection
