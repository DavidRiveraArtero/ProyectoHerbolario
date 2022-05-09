@extends('layoutsCompartido.body')
@section('content')

    <div class="" style="margin-bottom: 40px; margin-top:80px; background-color: #9BD682; border-top:1px solid black; height: 80px" >
        <div class="txt-centrado marg-top15px">
            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Mis Pedidos</span>
            <h3 style="font-weight: bold;">Mis Pedidos</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="">
                @foreach($comandas as $comanda)
                    <div class="col-lg-7 form_direccion" style=" height:100% ;border: 1px solid black; margin-bottom:40px">
                        <div class="col-lg-12 " style="border-bottom: 1px solid black; float: left" >
                            <table class="table_comanda">
                                <tr>
                                    <td>Pedido Realizado</td>
                                    <td>Total</td>
                                    <td>ENVIAR A</td>
                                    <td>Pedido num</td>
                                </tr>
                                <tr>
                                    <td>{{$comanda->created_at}}</td>
                                    <td>{{$comanda->precio_final}}</td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td>{{$comanda->id}}</td>
                                </tr>
                            </table>
                        </div>
                        @foreach($listaP as $key => $lista)

                            <div class="col-lg-12 " style="margin-top: 20px;float: left">
                                <div class="col-lg-5 " style="margin-left: 25px; margin-bottom: 25px">
                                    @if($comanda->id == $lista->id_comanda)
                                        <img src="{{asset("storage/".$foto_producto[$key]->file_path)}}">
                                    @endif
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
