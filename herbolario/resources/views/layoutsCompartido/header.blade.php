<header class="fixed-top">
    <div class=""> <!--SE PUEDE PROVAR CON CONTAINER-->
        <div class="row">
            <div class="col-xl-3 col-lg-5 col-sm-5" id="contenedor-titulo" style="padding-left: 140px; text-aling:center;">
                <h2>Nombre de la tienda</h2>
            </div>

            <div class="input-group col-xl-5 col-lg-7 col-sm-7 " id="contenedor-input">
                <input type="text" placeholder="Buscador" id="buscador">
                <span class="input-group-text btn btn-secondary">Search</span>
            </div>

            <!-- No logeado -->
            @guest
                <div class="col-xl-1 col-lg-2 col-sm-2  dropdown" id="contenedor_usuario" style="padding-right: 100px">
                    <a href="{{route("login")}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle btn dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg><span class="bi bi-person-circle" id="nombre_user">Login</span></a>
                </div>

            <!-- REGISTRADO -->
            @else
                <div class="col-xl-2 col-lg-2 col-sm-2  dropdown" id="contenedor_usuario">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle btn dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg><span class="bi bi-person-circle" id="nombre_user"> {{ Auth::user()->name }}</span>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <h3 style="text-align: center;">Menu user</h3>
                        <hr>
                        <!-- MI CUENTA -->
                        <a class="dropdown-item" href="#">Mi cuenta</a>
                        <!-- LOGOUT -->
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

            @endif

            <!-- Carrito -->
            <div class="col-xl-1 col-lg-1 col-sm-1 " id="contenedor_carrito">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg><span class="bi bi-cart">2</span>
                </a>
            </div>

        </div>
    </div>
</header>


