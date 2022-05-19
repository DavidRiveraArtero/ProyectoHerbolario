@include('layoutsCompartido.head')
<body>
<header style="margin-bottom: 40px" >
    @include('layoutsCompartido.adminNavegacion')

    <div class="txt-centrado marg-top15px">
        <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Añadir usuario</span>
        <h3 style="font-weight: bold;">Añadir Usuario</h3>
    </div>
</header>

<div id="contenedor_create" class="container">
    @if(session()->has('error'))
        <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
            {{ session()->get('error') }}
        </div>
    @endif
    <form method="POST" action="{{route('usuarios.store')}}" class="row" enctype="multipart/form-data">

        @csrf
        {{csrf_field()}}
        @method('post')

        <did class="contenedor_create_inputs col-xl-1">
            <h3>Nombre Usuario</h3>
            <input class="contenedor_inputs_line" type="text" placeholder="Nombre Usuario" name="nombre" value="{{ old('nombre') }}">
        </did>

        <div class="contenedor_create_inputs ">
            <h3>Email</h3>
            <input class="contenedor_inputs_line" type="email" placeholder="Correo" name="email">
        </div>

        <div class="contenedor_create_inputs">
            <h3>Password</h3>
            <input class="contenedor_inputs_line" type="password" placeholder="Contraseña" name="password">
        </div>
        <did class="contenedor_create_inputs">
            <h3>Role</h3>
            <select class="contenedor_inputs_line" name="rol">
                <option value="">-----------</option>
                @foreach($rolesUsuario as $rol)
                    <option value="{{$rol->name}}">{{$rol->name}}</option>
                @endforeach
            </select>
        </did>
        <div id="drop-area" class="input-file">

            <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
            <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)" name="file_path[]">
            <div id="gallery" /></div>
        <progress id="progress-bar" max=100 value=0></progress>
</div>
<button class="btn btn-primary col-lg-12" type="submit" id="send" style="float: right; margin-top:40px">Crear Usuario</button>
</form>
</div>
</body>
@include('layoutsCompartido.scriptFoto')
