@include('layoutsCompartido.head')
<body>
    <header style="margin-bottom: 40px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Añadir productos</span>
            <h3 style="font-weight: bold;">Añadir Producto</h3>
        </div>
    </header>
    @if(session()->has('failed'))
        <div class="alert alert-success" style="width: 100%; height: auto">
            {{ session()->get('failed') }}
        </div>
    @endif
    <div class="icono_lista dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="currentColor" class="bi bi-filter-left btm dropdown-toggle" style="float: left" id="dropdownList" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
            <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
        </svg>
        <div class="dropdown-menu float-start contenedor_dropdown" aria-labelledby="dropdownList" >
            <a class="btn btn-primary marg-bot15px" href="{{route('productos.index')}}">Listar Productos</a>
            <a class="btn btn-primary marg-bot15px" href="{{route('productos.create')}}">Crear Productos</a>
            <a class="btn btn-primary marg-bot15px">Listar Usuarios</a>
            <a class="btn btn-primary">Crear Usuarios</a>
        </div>
    </div>
    <form method="POST" action="{{route('productos.store')}}" >
        @csrf
        @method('post')
        <input type="text" placeholder="Nombre Producto" name="nombre">
        <input type="text" placeholder="Precio" name="precio">
        <input type="text" placeholder="Descripcion" name="descripcion">
        <input type="text" placeholder="Cantidad" name="cantidad">
        <button type="submit">Enviar</button>
    </form>

</body>
