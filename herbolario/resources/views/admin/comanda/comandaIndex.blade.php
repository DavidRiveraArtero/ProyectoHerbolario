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
                    <td  scope="col">Importe con IVA</td>
                    <td  scope="col">Importe sin IVA</td>
                    <td scope="col">Fecha</td>
                </tr>

            </thead>

            <tbody>

                @php($cont = 0)

                @foreach($comandas as $comanda)

                    <tr>
                        <th scope="row">{{$comanda->id}}</th>
                        <th scope="row">{{$cantidades[$cont]}}</th>
                        <td>{{$comanda->precio_final}}€</td>
                        <td>{{$comanda->precio_final - (float)$comanda->precio_final*(21/100)}}€</td>
                        <td>{{$comanda->created_at}}</td>
                    </tr>

                    @php($cont++)

                @endforeach

            </tbody>

        </table>
        <table class="table table-bordered 1" style="float: right; width: 22%!important; text-align: center">
            <tr class="table-success">
                <td>Precio con IVA</td>
                <td>Precio sin IVA</td>
                <td>IVA</td>
            </tr>
            <tr>
                <th>{{$precioTotal }}€</th>
                <th>{{$precioTotal - (float)$precioTotal*21/100}}€</th>
                <th>+{{(float)$precioTotal*21/100}}€</th>
            </tr>
        </table>



        {{-- Pagination --}}
        <div class="d-flex justify-content-center mylinks">
            {!! $comandas->links() !!}
        </div>

    </div>

</div>

</body>
