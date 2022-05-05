@extends('layoutsCompartido.body')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


@section('content')
    <div class="col-lg-12" style="margin-bottom: 15px;margin-top:50px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Contactanos</span>
            <h3 style="font-weight: bold;">Contactanos</h3>
        </div>
    </div>
    <div class="container" style="margin-bottom: 15px">
        <div class="row">
        <div class="col-lg-12" id="map" style="height: 400px;"></div>
            <div class="container marg-top45px">
                <div class="row">
                    <div class="col-lg-7">
                        <h1 style="text-align: center">Contacta con nosotros</h1>
                        <form method="post" action="{{route('contactanos.store')}}">
                            @csrf
                            <div class="col-lg-12 marg-top15px" style="float: left">
                                <!-- Nombre -->
                                <div class="col-lg-6 col-12" style="float: left">
                                    <h3 class="">Su nombre *</h3>
                                    @if(Auth::user())
                                        <input name="nombre" class="col-lg-10 col-12" type="text" value="{{Auth::user()->name}}" readonly>
                                    @else
                                        <input name="nombre" class="col-lg-10 col-12" type="text">
                                    @endif
                                </div>

                                <!-- EMAIL -->
                                <div class="col-lg-6 col-12" style="float: left">
                                    <h3>Email *</h3>
                                    @if(Auth::user())
                                        <input name="email" class="col-lg-10 col-12" type="email" value="{{Auth::user()->email}}" readonly>
                                    @else
                                        <input name="email" class="col-lg-10 col-12" type="text">
                                    @endif
                                </div>
                            </div>
                            <!-- ASUNTO -->
                            <div class="col-lg-12 col-12 marg-top45px" style="float: left">
                                <div class="col-lg-12 col-12" style="float: left">
                                    <h3 class="">Asunto *</h3>
                                    <input name="asunto" class="col-lg-11 col-12" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 marg-top45px" style="float: left">
                                <div class="col-lg-12 col-12" style="float: left">
                                    <h3 class="">Mensaje *</h3>
                                    <textarea name="mensaje" class="col-lg-11 col-12" type="text" rows="4"></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary col-lg-6 marg-top15px" type="submit">Enviar</button>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <h1 style="text-align: center">Oficina</h1>
                        <h3 class="col-lg-12 marg-top45px"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/><path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/></svg> Direccion: La que sea</h3>
                        <h3 class="marg-top45px"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/></svg>  Telefono: 111111111 </h3>
                        <hr class="marg-top45px">
                        <h1 class="marg-top45px" style="text-align: center">Horario Comercial</h1>
                        <h5>Lunes - Viernes de 9:00 a 14:00 y de 16:00 a 19:00</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // HACEMOS GEOLOCALIZACIÓN SI LE DAMOS A PERMITIR
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }

    // MOSTRAR POSICIÓN LATITUDINAL Y LONGITUDINAL
    function showPosition(position) {
        // CREAMOS POSICIONES DE LATITUD Y LONGITUD
        var l1 = position.coords.latitude
        var l2 = position.coords.longitude;

        // CREAMOS MARCADOR DEL CLIENTE
        var marker2 = new L.marker([l1, l2]).addTo(map);

        // AÑADIMOS ESTE MARCADOR AL ESTILO
        marker2._icon.classList.add("huechange");
        marker2.bindPopup("<b>YO</b>").openPopup();
    }

    // SITUAMOS EL MAPA EN UNAS CORDENADAS (LAS DEL INSTI EN ESTE CASO, CON 18 DE ZOOM)
    var map = L.map('map').setView([41.193723, 1.606490], 18);

    // CREAMOS MARCADOR CON LAS CORDENADAS DEL INSTI
    var marker = new L.marker([41.193723, 1.606490]).addTo(map);

    // AÑADIMOS POPUP
    marker.bindPopup("<b>Herbolaria</b>").openPopup();

    // CREACIÓN DE MAPA (LA PARTE DE LA API)
    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);
</script>
@endsection
