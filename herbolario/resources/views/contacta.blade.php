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
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h1 style="text-align: center">Contacta con nosotros</h1>

                        <div class="col-lg-12 marg-top15px" style="float: left">
                            <!-- Nombre -->
                            <div class="col-lg-6 col-12" style="float: left">
                                <h3 class="">Su nombre *</h3>
                                <input class="col-lg-10 col-12" type="text">
                            </div>

                            <!-- EMAIL -->
                            <div class="col-lg-6 col-12" style="float: left">
                                <h3>Email *</h3>
                                <input class="col-lg-10 col-12" type="text">
                            </div>
                        </div>
                        <!-- ASUNTO -->
                        <div class="col-lg-12 marg-top45px" style="float: left">
                            <div class="col-lg-12 col-12" style="float: left">
                                <h3 class="">Asunto *</h3>
                                <input class="col-lg-11 col-12" type="text">
                            </div>
                        </div>
                        <div class="col-lg-12 marg-top45px" style="float: left">
                            <div class="col-lg-12 col-12" style="float: left">
                                <h3 class="">Mensaje *</h3>
                                <textarea class="col-lg-11 col-12" type="text" rows="4"></textarea>
                            </div>
                        </div>
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
