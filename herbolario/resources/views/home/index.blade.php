@extends('layoutsCompartido.body')
@section('content')
    <div class="marg-top100px pos-f-t" id='contenedor-nav'>
        <!-- BOTON RESPONSIVE -->
          <nav class="navbar navbar-dark bg-dark" style="display:none;" id='prenav'>
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

                        <li><a href="">TÉS</a></li>
                        <li><a href="">INFUSIONES</a></li>
                        <li ><a href="">DIETÉTICOS</a></li>
                        <li ><a href="">NUTRICIÓN DEPORTIVA</a></li>
                        <li ><a href="">ALIMENTACIÓN SALUDABLE</a></li>
                        <li ><a href="">INCIENSOS</a></li>
                    </ul>
                </div>
            </nav>
          </div>

          <!-- Normal -->
          <nav class="" id='nav-container'>
            <div id="wrapper" >
                <ul>

                    <li><a href="">TÉS</a></li>
                    <li><a href="">INFUSIONES</a></li>
                    <li ><a href="">DIETÉTICOS</a></li>
                    <li ><a href="">NUTRICIÓN DEPORTIVA</a></li>
                    <li ><a href="">ALIMENTACIÓN SALUDABLE</a></li>
                    <li ><a href="">INCIENSOS</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Modificar con los parametros reales de la base de datos -->
    <div class="contenedor_productos">

        @foreach($productos as $producto)

            <div class="productos">
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
                    <p>Precio: {{$producto->precio}}</p>
                    <p>Descripcion: {{$producto->descripcion}}</p>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto btn_producto_info">
                    <a href="{{route('home.show', $producto,$producto->id)}}" class="btn btn-success">Info</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
