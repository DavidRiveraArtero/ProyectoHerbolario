@include('layoutsCompartido.head')
<body>

<header style="margin-bottom: 40px" >
    @include('layoutsCompartido.adminNavegacion')
    <div class="txt-centrado marg-top15px">



        <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Comanda</span>

        <h3 style="font-weight: bold;">Lista Comanda</h3>

    </div>

</header>


@if(session()->has('success'))

    <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">
        {{ session()->get('success') }}
    </div>

@endif

<div class="contenedor_tablas">

    <div class="container mt-5 margtop0">

        <div class="col-lg-3">

            <h3>Facturación</h3>

            <form method="post" action="{{route('filtrar_comanda')}}">
                @csrf

                @method('post')

                <h5 style="margin-bottom: 30px">De: <input name="fechaInicio" style="float: right;" type="date"></h5>

                <h5 style="margin-bottom: 30px">Hasta: <input name="fechaFin" style="float: right" type="date"></h5>

                <button class="btn btn-primary col-lg-5" type="submit">Filtrar</button>

                <a href="{{route('adminComanda.index')}}" class="btn btn-primary col-lg-5" type="submit">Todos</a>

            </form>

        </div>

        <table class="table table-bordered mb-5">

            <thead>

                <tr class="table-success">
                    <td  scope="col">Id Comanda</td>
                    <td  scope="col">Cantidad producto</td>
                    <td  scope="col">Importe</td>
                </tr>

            </thead>

            <tbody>

                @php($cont = 0)

                @foreach($comandas as $comanda)

                    <tr>
                        <th scope="row">{{$comanda->id}}</th>
                        <th scope="row">{{$cantidades[$cont]}}</th>
                        <td>{{$comanda->precio_final}}€</td>
                    </tr>

                    @php($cont++)

                @endforeach

            </tbody>

        </table>
        <table class="table table-bordered 1" style="float: right; width: 22%!important;">
            <tr class="table-success">
                <td>Total</td>
            </tr>
            <tr>
                <th>{{$precioTotal}}€</th>
            </tr>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mylinks">
            {!! $comandas->links() !!}
        </div>

    </div>

</div>

</body>
