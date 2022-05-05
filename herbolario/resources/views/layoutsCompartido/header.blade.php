<div class="fixed-top">
    <nav class="navbar navbar-dark " style="height: auto; background-color:#9BD682;!important">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" >
                <span class="navbar-toggler-icon" ></span>
            </button>
            <h2 style="color: white">El herbolario de Ana</h2>

            @guest
            <div class="dropdown" id="" style="">
                <a class="btn bg-light" href="{{route("login")}}">
                   <span>Login</span>
                </a>
            </div>
            @else

            <div class="dropdown" id="">
                @foreach($FotoUsuario as $avatar)
                    @if($avatar->activo == "1")
                        <div class="" style="height: 80px; float: left">
                            <img src="{{asset("storage/". $avatar->file_path)}}" style="border-radius: 50%; height: 100%">
                        </div>
                    @endif
                @endforeach
                <span class="bi bi-person-circle" id="nombre_user" > {{ Auth::user()->name }}</span>

            </div>

        @endif

        </div>
    </nav>


    <div class="collapse " id="header" >
        <div class="bg-white p-4 contenedor_dropdown" >
            <div class="menu" style="margin-top: 0">
                @if(Auth::user())
                    <div class="item">
                        <a class="" href="">Menu User<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a class="dropdown-item sub-item" href="{{route("perfil.show",Auth::user())}}"><h5>Mi cuenta</h5></a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <h5>{{ __('Logout') }}</h5>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <a class="dropdown-item sub-item" href="{{route("perfil.show",Auth::user())}}"><h5>Carrito</h5></a>
                            @if(Auth::user()->role_id == 1)
                                <a class="dropdown-item sub-item" href="{{route("productos.index")}}"><h5>Intranet</h5></a>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="item"><a class="" href="{{route("login")}}">Iniciar Sesion<i class="fas fa-angle-right dropdown"></i></a></div>
                    <div class="item"><a class="" href="{{route("register")}}">Registro<i class="fas fa-angle-right dropdown"></i></a></div>
                @endif

                <div class="item"><a class="" href="{{route('contactanos.index')}}">Contacto<i class="fas fa-angle-right dropdown"></i></a></div>
                <div class="item"><a class="" href="">Quienes somos<i class="fas fa-angle-right dropdown"></i></a></div>


            </div>
        </div>
    </div>
</div>


