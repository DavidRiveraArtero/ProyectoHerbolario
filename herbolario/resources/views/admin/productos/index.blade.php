@include('layoutsCompartido.head')
<body>

    <header style="margin-bottom: 40px" >
        @include('layoutsCompartido.adminNavegacion')
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Productos</span>
            <h3 style="font-weight: bold;">Lista Productos</h3>
        </div>
    </header>


    @if(session()->has('success'))
        <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="contenedor_tablas">


        <div class="container mt-5 margtop0">
            <div class="row" >
                <a href="{{route('productos.create')}}" class="btn btn-primary col-lg-2 col-5 align-self-end" style="float: right!important;">Crear Producto</a>

                <table class="table table-bordered mb-5 col-lg-12 ">
                    <thead>
                    <tr class="table-success">
                        <td  scope="col">Id</td>
                        <td  scope="col">Nombre</td>
                        <td  scope="col">Precio</td>

                        <td scope="col">Estado</td>
                        <td  scope="col">Opciones</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <th scope="row">{{$producto->id}}</th>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->precio}}</td>

                            @if($producto->estado == 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            <td>
                                <a class="btn btn-info" href="{{route('productos.edit',$producto)}}" style="float: left">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <form method="post" action="{{route('productos.destroy',$producto)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" style="float: left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mylinks">
                {!! $productos->links() !!}
            </div>
        </div>
    </div>

</body>
