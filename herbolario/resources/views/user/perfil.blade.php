@include('layoutsCompartido.head')
<body>
    <header style="margin-bottom: 40px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Perfil</span>
            <h3 style="font-weight: bold;">Menu Usuario</h3>
        </div>
    </header>

    <div class="container" >
        <div class="row align-items-center">
            <div class="avatar col-lg-2 col-8" >
                @foreach($FotoUsuario as $avatar)
                    @if($avatar->activo == "1")

                        <img src="{{asset("storage/". $avatar->file_path)}}" style="border-radius: 50%; height: 100%">

                    @endif
                @endforeach
            </div>
            <div class="col-lg-8 col-2" style="text-align:center">
                <h1>{{$datosUsuario->name}}</h1>
            </div>

            <hr style="margin-top:50px; border:2px solid black; opacity:1;">
        </div>
    </div>

    <div class="container marg-top45px">
        <div class="row ">
            <a href="#" class="col-lg-5 contenedor_opciones_user" style="background-image: url('https://st.depositphotos.com/1000128/4913/i/600/depositphotos_49136251-stock-photo-cardboard-boxes.jpg'); margin-bottom:40px; color: black" >
                <h3 class="txt-centrado" style="padding-top: 85px">Mis Pedidos</h3>
            </a>

            <!-- CONTENEDOR FANTASMA -->
            <div class="col-lg-2">

            </div>

            <a href="{{route('direccion.index')}}" class="col-lg-5 contenedor_opciones_user" style="background-image: url('https://depor.com/resizer/cdd_l1-KbEZArsh774BFj-7aWZo=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/FJNHB6ARHFAI3EUBW3GAQFQD5U.jpg'); margin-bottom:40px; color: black" >
                <h3 class="txt-centrado" style="padding-top: 85px">Editar direccion</h3>
            </a>



            <a href="{{route('contactanos.index')}}" class="col-lg-5 contenedor_opciones_user" style="background-image: url('https://depor.com/resizer/cdd_l1-KbEZArsh774BFj-7aWZo=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/FJNHB6ARHFAI3EUBW3GAQFQD5U.jpg'); color: black" >
                <h3 class="txt-centrado" style="padding-top: 85px">Contactanos</h3>
            </a>

            <!-- CONTENEDOR FANTASMA -->
            <div class="col-lg-2">

            </div>

            <a href="#" class="col-lg-5 contenedor_opciones_user" style="background-image: url('https://ecdisis.com/wp-content/uploads/2020/09/imagen-medios-de-pago-def.jpeg'); color: black" >
                <h3 class="txt-centrado" style="padding-top: 85px">Añadir metodo de pago</h3>
            </a>

            <!-- CONTENEDOR FANTASMA -->
            <div class="col-lg-3">

            </div>
            <a href="#" class="col-lg-5 contenedor_opciones_user" style="background-image: url('http://pasosparacrearunblog.co/wp-content/uploads/2015/10/banner-como-configurar-wordpress-2.png'); margin-top: 40px; color: black; margin-bottom: 40px" >
                <h3 class="txt-centrado" style="padding-top: 85px">Configurar</h3>
            </a>
        </div>


    </div>
</body>

