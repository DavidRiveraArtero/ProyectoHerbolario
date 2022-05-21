@extends('layoutsCompartido.body')
@section('content')

    <div class="" style="margin-bottom: 40px; margin-top:50px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Mis Pedidos</span>
            <h3 style="font-weight: bold;">Mis Pedidos</h3>
        </div>
    </div>
    <div class="container">
        @if(count($comandas)>0)
        <div class="row">
                @php($cont2 = 0)
                @foreach($comandas as $key => $comanda)
                    <div class="col-lg-7 form_direccion" style=" height:auto; margin-bottom:40px">
                        <div class="col-lg-12 col-12" style="border-bottom: 1px solid black; float: left;height: auto" >
                            <table class="table_comanda">
                                <tr>
                                    <td>Pedido Realizado</td>
                                    <td>Total</td>
                                    <td>ENVIAR A</td>
                                    <td>Pedido num</td>
                                </tr>
                                <tr>
                                    <td>{{$comanda->created_at}}</td>
                                    <td>{{$comanda->precio_final}}$</td>
                                    <td>{{$direccions[$cont2]->linea_direccion}}</td>
                                    <td>{{$comanda->id}}</td>
                                </tr>
                            </table>
                            @php($cont2++)
                        </div>

                        @php($cont = 0)
                        @foreach($listaP as $key => $lista)

                            @if($comanda->id == $lista->id_comanda)
                            <div class="col-lg-12 " style="margin-top: 20px;float: left;height: auto">
                                <div class="col-lg-5 " style="margin-left: 25px; margin-bottom: 25px; float: left">
                                    <img src="{{asset("storage/".$foto_producto[$cont]->file_path)}}">
                                </div>
                                <div style="float: left">
                                    <h3 style=" margin-left: 20px;margin-bottom: 20px">{{$productos[$cont]->nombre}}</h3>
                                    <h3 style=" margin-left: 20px;margin-bottom: 20px">Precio: {{$productos[$cont]->precio}}$</h3>
                                    <h4 style=" margin-left: 20px;margin-bottom: 20px">Cantidad: {{$lista->cantidad}}</h4>
                                    <a href="{{route('home.show',$productos[$cont])}}" class="btn btn-success" style="margin-left: 20px">Deje su Opinion del producto</a>

                                </div>
                                <div style="float: left;">
                                </div>

                            </div>
                            @endif
                                @php($cont++)
                        @endforeach
                    </div>
                @endforeach
        </div>
        @else
            <div class="col-lg-6" style="background-color: white; border: 1px solid black">

                <p style="font-size: 40px">No compraste ningun producto</p>

                <p style="font-size: 20px; width: 70%">Puedes rellenar tu cesta con los productos que te ofrecemos. Seguro que encuentras algo interesante.<a href="{{route('home.index')}}">Comprar</a></p>

            </div>
        @endif
    </div>
@endsection
