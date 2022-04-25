@extends('layoutsCompartido.body')
@section('content')
    <div class="marg-top100px ">
        <nav>
            <div id="wrapper" >
                <ul>
                    <li><a href="">TÉS</a></li>
                    <li><a href="">ESPECIAS</a></li>
                    <li ><a href="">COMPLEMENTOS</a></li>
                    <li ><a href="">ALIMENTACION</a></li>
                    <li ><a href="">APICOLAS</a></li>
                    <li ><a href="">COSMÉTICA NATURAL</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Modificar con los parametros reales de la base de datos -->
    <div class="contenedor_productos">
        @foreach($productos as $producto)
            <div class="productos">
                <div class="imagen_producto ">
                    <img src="https://www.herbolariodeconfianza.es/img/cms/Herbolario%20y%20salud%20natural.jpg" class="w-100">
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
        <div class="productos">
            <div class="imagen_producto ">
                <img src="https://www.herbolariodeconfianza.es/img/cms/Herbolario%20y%20salud%20natural.jpg" class="w-100">
            </div>
            <div class="info_producto">
                <p>Nombre Producto</p>
                <p>Precio</p>
                <p>Descripcion</p>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto btn_producto_info">
                <a href="#" class="btn btn-success">Info</a>
            </div>
        </div>
        <div class="productos">
            <div class="imagen_producto">
                <img src="https://www.herbolariodeconfianza.es/img/cms/Herbolario%20y%20salud%20natural.jpg">
            </div>
            <div class="info_producto">
                <p>Nombre Producto</p>
                <p>Precio</p>
                <p>Descripcion</p>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto btn_producto_info">
                <a href="#" class="btn btn-success">Info</a>
            </div>
        </div>

        <div class="productos">
            <div class="imagen_producto">
                <img src="https://www.herbolariodeconfianza.es/img/cms/Herbolario%20y%20salud%20natural.jpg">
            </div>
            <div class="info_producto">
                <p>Nombre Producto</p>
                <p>Precio</p>
                <p>Descripcion</p>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto btn_producto_info">
                <a href="#" class="btn btn-success">Info</a>
            </div>
        </div>

        <div class="productos">
            <div class="imagen_producto">
                <img src="https://www.herbolariodeconfianza.es/img/cms/Herbolario%20y%20salud%20natural.jpg">
            </div>
            <div class="info_producto">
                <p>Nombre Producto</p>
                <p>Precio</p>
                <p>Descripcion</p>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto btn_producto_info">
                <a href="#" class="btn btn-success">Info</a>
            </div>
        </div>
    </div>
@endsection
