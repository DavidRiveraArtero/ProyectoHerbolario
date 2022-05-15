@include('layoutsCompartido.head')
<body>

    <header style="margin-bottom: 40px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Categorias</span>
            <h3 style="font-weight: bold;">Lista Categoria</h3>
        </div>
    </header>

    @include('layoutsCompartido.adminNavegacion')

    <div id="contenedor_create" class="container">

        @if(session()->has('error'))
            <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
                {{ session()->get('error') }}
            </div>
        @endif

        <form method="POST" action="{{route('adminCategoria.store')}}" class="row" enctype="multipart/form-data">

            @csrf
            {{csrf_field()}}
            @method('post')

            <did class="contenedor_create_inputs">
                <h3>Productos</h3>
                <select class="contenedor_inputs_line" name="productos">
                    <option value="">-----------</option>
                    @foreach($productos as $producto)
                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                    @endforeach
                </select>
            </did>

            <did class="contenedor_create_inputs">
                <h3>Categoria</h3>
                <select class="contenedor_inputs_line" name="categorias">
                    <option value="">-----------</option>
                    <option value="tes">TÉS</option>
                    <option value="infusiones">INFUSIONES</option>
                    <option value="dieteticos">DIETÉTICOS</option>
                    <option value="nutricion_deportiva">NUTRICIÓN DEPORTIVA</option>
                    <option value="nutricion_deportiva">ALIMENTACIÓN SALUDABLE</option>
                    <option value="incienso">INCIENSOS</option>
                </select>
            </did>
            <button class="btn btn-primary col-lg-12" type="submit" id="send" style="float: right; margin-top:40px">Crear Producto</button>
        </form>
    </div>
</body>
