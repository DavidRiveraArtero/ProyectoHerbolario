<div class="icono_lista dropdown">
    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="currentColor" class="bi bi-filter-left btm dropdown-toggle" style="float: left" id="dropdownList" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
        <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
    </svg>
    <div class="dropdown-menu float-start contenedor_dropdown" aria-labelledby="dropdownList" >
        <div class="menu">

            <div class="item">
                <a class="" href="">Admin<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a class="sub-item" href="{{route('productos.index')}}">Listar Productos</a>
                    <a class="sub-item" href="{{route('productos.create')}}">Crear Productos</a>
                    <a class="sub-item" href="{{route('usuarios.index')}}">Listar Usuarios</a>
                    <a class="sub-item" href="{{route('usuarios.create')}}">Crear Usuarios</a>
                </div>
            </div>

            <div class="item">
                <a class="" href="">Home<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a class="sub-item" href="{{route('productos.index')}}">Inicio</a>
                    <a class="sub-item" href="{{route('perfil.show',Auth::user())}}">Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
