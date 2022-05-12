@extends('layoutsCompartido.body')
@section('content')
    <!-- Segundo header -->
    <div class="" style="margin-bottom: 40px; margin-top:50px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Configurar Usuario</span>
            <h3 style="font-weight: bold;">Menu Usuario</h3>
        </div>
    </div>
    <div id="contenedor_create" class="container">
        @if(session()->has('success'))
            <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
                {{ session()->get('success') }}
            </div>
        @endif
        <form method="POST" action="{{route('user.update',$usuario)}}" class="row" enctype="multipart/form-data">

            @csrf
            {{csrf_field()}}
            @method('put')

            <did class="contenedor_create_inputs col-xl-1 col-12">
                <h3>Nombre Usuario</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Nombre Usuario" name="nombre" value="{{$usuario->name}}">
            </did>


            <div class="contenedor_create_inputs col-12">
                <h3>Password</h3>
                <input class="contenedor_inputs_line" type="password" placeholder="Nueva Contraseña" name="password">
            </div>

            <div id="drop-area" class="input-file">

                <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)" name="file_path[]">
                <div id="gallery" /></div>
            <progress id="progress-bar" max=100 value=0></progress>
    </div>
    <button class="btn btn-primary col-lg-12" type="submit" id="send" style="float: right; margin-top:40px">Actualizar Usuario</button>
    </form>
    </div>
    @include('layoutsCompartido.scriptFoto')
@endsection



