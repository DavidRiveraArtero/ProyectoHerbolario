@extends('layoutsCompartido.body')
@section('content')

    <!-- Segundo header -->
    <div class="" style="margin-bottom: 40px; margin-top:80px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Añadir productos</span>
            <h3 style="font-weight: bold;">{{$producto->nombre}}</h3>
        </div>
    </div>

    <!-- Carousel -->
    <div class="marg-top45px container">


        <div id="demo" class="carousel slide" data-bs-ride="carousel" style="height: 40%;  ">

            <!-- Indicators/dots -->
            <div class="carousel-indicators" style="height: auto">
                @php($una=true)
                @php($cont = 0)
                @foreach ($fotoProducto as $key => $foto)
                    @if($una)
                        @php($una=false)
                        <button class="active" type="button" data-bs-target="#demo" data-bs-slide-to="{{$cont}}"></button>
                    @else
                        @php($cont++)
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="{{$cont}}"></button>
                    @endif
                @endforeach

            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                @php($una=true)
                @foreach ($fotoProducto as $key => $foto)

                    @if($una)
                        @php($una=false)
                        <div class="carousel-item active"  >
                            <img src="{{asset("storage/".$foto->file_path)}}" alt="" class="d-block w-100" style="height: 100%">
                        </div>
                    @else
                        <div class="carousel-item"  >
                            <img src="{{asset("storage/".$foto->file_path)}}" alt="" class="d-block w-100" style="height: 100%">
                        </div>
                    @endif


                @endforeach
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    <div class="container marg-top45px">
        <div class="row">
            @php($cont = 0)
            @foreach ($fotoProducto as $key => $foto)
                <div class="col-lg-2 col-sm-3 " style="float: left; margin-top: 20px">
                    <img type="button" data-bs-target="#demo" data-bs-slide-to="{{ $cont }}" src="{{asset("storage/".$foto->file_path)}}" alt="Chicago" class="d-block w-100" style="height: 100%; opacity: 1!important;">
                    @php($cont++)
                </div>
            @endforeach
        </div>
    </div>
    <div class="container marg-top45px">
        <div class="row contenedor_comentarios" >

            <div class="col-lg-6" style="margin-top: 20px;">
                <h3>Nombre Producto: <span>{{$producto->nombre}}</span></h3>
                <h3>Precio: <span>{{$producto->precio}}$</span></h3>
                <h3>Unidades: <span>{{$producto->cantidad}}</span></h3>
                <a class="btn btn-info" style="margin-bottom: 14px">Añadir al carrito</a>
            </div>
            <div class="col-lg-6"  style="margin-top: 20px;">
                <h1>Descripcion</h1>
                <h3>{{$producto->descripcion}}</h3>
            </div>
        </div>
    </div>

    <div class="container marg-top45px">

        <div class="row">
            <h2 class="col-lg-12 " style="text-align: center; margin-bottom: 40px">Comentarios</h2>

            @if(Auth::user())
                <div class="contenedor_comentarios">
                    <h4>{{Auth::user()->name}} - Añadir Comentario</h4>

                    <form method="post" action="{{route("productos.comentarios.store", $producto)}}">
                        @csrf
                        @method('post')

                        <textarea placeholder="Comentario" name="comentario" class="col-lg-12 col-12" rows="8"></textarea>
                        <button type="submit" class="btn btn-success col-12">Enviar</button>
                    </form>
                </div>
            @endif
            @foreach($comentarios as $comentario)
                <div class="col-lg-12" style="border: 1px solid black;border-radius: 10px; margin-bottom: 60px">
                    @foreach($usuarios as $usuario)
                        @if($comentario->id_usuario == $usuario->id)
                            <h4>{{$usuario->name}} - Created: {{$comentario->created_at}}</h4>
                            <hr>
                        @endif
                    @endforeach
                    <h5>{{$comentario->comentario}}</h5>
                </div>
            @endforeach
        </div>
    </div>


@endsection
