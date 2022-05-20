@extends('layoutsCompartido.body')
@section('content')
    <div class="pos-f-t" style="margin-top: 56px" id='contenedor-nav'>
        <!-- BOTON RESPONSIVE -->
          <nav class="navbar navbar-dark bg-dark" style="display:none;padding-top: 5px!important;" id='prenav'>
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </nav>
          <!-- RESPONSIVE NAV -->
          <div class="collapse" id="navbarToggleExternalContent">
            <nav class="" id='responsive-nav'>

                <div id="wrapper" >
                    <ul>
                        <li><a href="{{route('categoria','tes')}}">TÉS</a></li>
                        <li><a href="{{route('categoria','infusiones')}}">INFUSIONES</a></li>
                        <li ><a href="{{route('categoria','dieteticos')}}">DIETÉTICOS</a></li>
                        <li ><a href="{{route('categoria','nutricion_deportiva')}}">NUTRICIÓN DEPORTIVA</a></li>
                        <li ><a href="{{route('categoria','alimentacion_saludable')}}">ALIMENTACIÓN SALUDABLE</a></li>
                        <li ><a href="{{route('categoria','incienso')}}">INCIENSOS</a></li>
                    </ul>
                </div>
            </nav>
          </div>

          <!-- Normal -->
          <nav class="" id='nav-container'>
            <div id="wrapper" >
                <ul>
                    <li><a href="{{route('categoria','todo')}}">TODOS</a></li>
                    <li><a href="{{route('categoria','tes')}}">TÉS</a></li>
                    <li><a href="{{route('categoria','infusiones')}}">INFUSIONES</a></li>
                    <li ><a href="{{route('categoria','dieteticos')}}">DIETÉTICOS</a></li>
                    <li ><a href="{{route('categoria','nutricion_deportiva')}}">NUTRICIÓN DEPORTIVA</a></li>
                    <li ><a href="{{route('categoria','alimentacion_saludable')}}">ALIMENTACIÓN SALUDABLE</a></li>
                    <li ><a href="{{route('categoria','incienso')}}">INCIENSOS</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Modificar con los parametros reales de la base de datos -->
    <div class="">
        <div class="contenedor_productos row">

            @foreach($productos as $producto)
                @if($producto->estado == 1)
                <div class="productos col-lg-2 col-12">
                    <div class="imagen_producto ">
                        @foreach($FotosProducto as $foto)
                            @if($foto->activo == true )
                                @if($producto->id == $foto->id_product)
                                    <img src="{{asset('storage/' .$foto->file_path)}}" class="w-100">
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="info_producto">
                        <p>Nombre Producto: {{$producto->nombre}}</p>
                        <p>Precio: {{$producto->precio}}€</p>
                        <p>Descripcion: {{$producto->descripcion}}</p>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto btn_producto_info">
                        <a href="{{route('home.show', $producto,$producto->id)}}" class="btn btn-success">Info</a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
