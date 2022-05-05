@extends('layoutsCompartido.body')
@section('content')
    <div class="" style="margin-bottom: 40px; margin-top:80px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Lista Direccion</span>
            <h3 style="font-weight: bold;">Lista Direccion</h3>
        </div>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
            {{ session()->get('success') }}
        </div>

    @endif

    <div class="container">
        <div class="row">
            <a href="{{route('direccion.create')}}" class="col-lg-3 container-direccion_plus">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-plus" style="margin-top: 30%" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </a>

            @foreach($direcciones as $direccion)
                <div class="col-lg-1"></div>
                <div class="col-lg-3 container-direccion_plus">
                    <h4 style="text-align: left">Nombre: {{$direccion->nombre}}</h4>
                    <h4 style="text-align: left">Pais: {{$direccion->pais}}</h4>
                    <h4 style="text-align: left">Provincia: {{$direccion->provincia}}</h4>
                    <h4 style="text-align: left">Codigo Postal: {{$direccion->codigo_postal}}</h4>
                    <h4 style="text-align: left">Telefono: {{$direccion->telefono}}</h4>
                    <h4 style="text-align: left">Direccion: {{$direccion->linea_direccion}}</h4>
                    <a href="{{route('direccion.show',$direccion,$direccion->id)}}" class="btn btn-primary">Editar</a>
                </div>
            @endforeach
        </div>
    </div>


@endsection
