@include('layoutsCompartido.head')
<body>
    <header style="margin-bottom: 40px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Editar productos</span>
            <h3 style="font-weight: bold;">Editar Producto</h3>
        </div>
    </header>
    @include('layoutsCompartido.adminNavegacion')

    <div id="contenedor_create" class="container">

        <form method="POST" action="{{route('productos.update',$producto)}}" class="row" enctype="multipart/form-data">

            @csrf
            {{csrf_field()}}
            @method('put')

            <did class="contenedor_create_inputs col-xl-1">
                <h3>Nombre Producto</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Nombre Producto" name="nombre" value="{{$producto->nombre}}">
            </did>

            <div class="contenedor_create_inputs ">
                <h3 >Precio Producto</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Precio" name="precio" value="{{$producto->precio}}">
            </div>

            <div class="contenedor_create_inputs">
                <h3>Descripcion</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Descripcion" name="descripcion" value="{{$producto->descripcion}}">
            </div>
            <did class="contenedor_create_inputs">
                <h3>Cantidad</h3>
                <input class="contenedor_inputs_line" type="text" placeholder="Cantidad" name="cantidad" value="{{$producto->cantidad}}">
            </did>
            <div id="drop-area" class="input-file">

                <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                <input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)" name="file_path[]"/>
                <div id="gallery"></div>
                <progress id="progress-bar" max=100 value=0></progress>
            </div>
            <button class="btn btn-primary col-lg-12" type="submit" id="send" style="float: right; margin-top:40px">Editar Producto</button>
        </form>
    </div>
</body>

@include('layoutsCompartido.scriptFoto')

