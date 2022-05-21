@extends('layoutsCompartido.body')

@section('content')

    <div class="" style="margin-bottom: 40px; margin-top:50px; background-color: #9BD682; border-top:1px solid black; height: 80px" >

        <div class="txt-centrado marg-top15px">

            <a href="{{route('home.index')}}"><span style="font-weight: bold;">Inicio</span></a><span style="font-weight: bold;"> / Carrito</span>

            <h3 style="font-weight: bold;">Lista Carrito</h3>

        </div>

    </div>

    <div class="container">

        <div class="row">

            @if(session()->has('success'))

                <div class="alert alert-success" style="width: 100%; height: auto; position:static!important;">

                    {{ session()->get('success') }}

                </div>

            @endif

            @if(count($listaP)>0)
                <div class="col-lg-6 col-12" style="height: auto">
                @php($cont = 0)
                @php($rep = "")
                    @foreach($producto as $key => $product)

                        @if($product->nombre != $rep)
                            @php($rep = $product->nombre)
                            <div class="col-lg-12 col-12" style="margin-bottom: 45px; background-color: white; padding-left: 0;height: 230px; float: left">

                                <img class="col-lg-5 col-6" src="{{asset('storage/'.$fotoProducto[$key]->file_path)}}" style="float: left;height: 100%">

                                <p class="col-lg-6 col-5" style="float: left; margin-top: 15px; font-size: 20px; margin-left: 30px">{{$product->nombre}}</p>

                                <p  class="col-lg-6 col-5" style="float: left;font-size: 28px; margin-left: 30px"><span class="precio_{{$product->id}} precioO">{{$product->precio * 1.21}}</span>€ <span style="font-size:0.7em">(amb IVA)</span></p>

                                @if($product->cantidad > 0)
                                    <p class="col-lg-6 col-5" style="float: left;margin-left: 30px; color: #00a600">En stock</p>
                                @else
                                    <p class="col-lg-6 col-5" style="float: left;margin-left: 30px; color: #e31313">Sin stock</p>

                                @endif
                                <label style="float: left;margin-left: 30px;">Cantidad: </label>



                                @foreach($listaP as $lista)
                                    @if($lista->id_producto == $product->id)
                                        <input class="col-lg-2 {{$product->id}} cantidad" style="margin-bottom: 15px"  type="text" value="{{$lista->cantidad}}" id="">
                                    @endif
                                @endforeach


                                <button value="{{$product->id }}" onclick="more(this)" class="up"> + </button>
                                <button value="{{$product->id }}" class="down" onclick="less(this)"> - </button>

                                @php($cont++)

                                @foreach($listaP as $lista)
                                    @if($lista->id_producto == $product->id)
                                        <form method="post" action="{{route('carrito.destroy',$lista->id)}}">
                                    @endif
                                @endforeach
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger col-lg-2" style="margin-left: 30px">Eliminar</button>

                                </form>
                            </div>
                        @endif
                    @endforeach
                </div>

            <!-- SI LA CESTA ESTA VACIA TE PRINTA ESTE BLOQUE -->
            @else
                <div class="col-lg-6" style="background-color: white; border: 1px solid black">

                    <p style="font-size: 40px">Tu cesta está vaciá</p>

                    <p style="font-size: 20px; width: 70%">Puedes rellenar tu cesta con los productos que te ofrecemos. Seguro que encuentras algo interesante. <a href="{{route("home.index")}}">Comprar</a></p>

                </div>
            @endif

            <!-- CONTENEDOR FANTASMA -->
            <div class="col-lg-2"></div>

            <div class="col-lg-4" id="contenedor_direccion" style="height: 230px; float: left">

                <h2 class="col-lg-12" style="text-align: center">Direcciones</h2>

                <form method="post" action="{{route('comanda.store')}}" style="margin-top: 30px">

                    @csrf
                    @method('post')

                    <select name='id_direccion' class="col-lg-12" style="margin-bottom: 30px">

                        @foreach($direcciones as $direccion)

                            <option value="{{$direccion->id}}">{{$direccion->linea_direccion}}</option>

                        @endforeach

                    </select>

                    <h4>Precio Total = <span id="precioF">{{$precioF}}</span>$</h4>

                    <input readonly name="precio" type="hidden" value="{{$precioF}}">

                    <section>

                    </section>

                    <button type="submit" class="btn btn-success">Finalizar Compra</button>
                </form>
            </div>

        </div>
    </div>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <script>
        input = document.getElementsByClassName('cantidad')

        precioF = document.getElementById('precioF')

        precioO = document.getElementsByClassName('precioO')

        cantidad = document.getElementsByClassName('cantidad')

        precio = 0
        // ACTUALIZAR PRECIO
        for(x = 0; x<precioO.length;x++){
            precio = precio + parseFloat(precioO[x].innerHTML) *  cantidad[x].value
        }

        console.log('precioF: ',precio);


        precioF.innerHTML = precio


        up = document.getElementsByClassName('up')


        down = document.getElementsByClassName('down')


        function actualitzarQuantitat(quantitat,valor) {
            console.log("dentro de ajax:", valor)
            $.ajax({
                type:'post',
                url:'{{route('carrit_ajax.store')}}',
                data:{
                    'id': idproducto,
                    '_token': '{{csrf_token()}}',
                    'quantitat': quantitat
                }
            }).done(function(resp){
                console.log(resp)
                valor.value = quantitat

                if (resp.success) {
                    // Actualitzar comptador producte

                } else {

                }
            })
        }

        function more(id){
           producto = id.value

        }

        function less(id){
            producto = id.value

        }


        for(x = 0; x<up.length;x++){


            up[x].addEventListener('click',event=>{
                idproducto = producto

                valor = event.target.parentNode.getElementsByClassName(idproducto)[0].value
                precio = event.target.parentNode.getElementsByClassName("precio_"+idproducto)[0].innerHTML
                inputV = event.target.parentNode.getElementsByClassName(idproducto)[0]

                console.log("precio UP: ", precio)
                console.log("Valor UP: ", valor)
                precioF.innerText = parseFloat(precio) + parseFloat(precioF.innerHTML)
                console.log("UP ACTUALIZAR PRECIO Final", precioF.innerHTML)
                actualitzarQuantitat(parseInt(valor)+1,inputV)


            })
        }

        for(x = 0; x<down.length;x++){
            down[x].addEventListener('click',event =>{
                idproducto = producto

                valor = event.target.parentNode.getElementsByClassName(idproducto)[0].value
                precio = event.target.parentNode.getElementsByClassName("precio_"+idproducto)[0].innerHTML
                inputV = event.target.parentNode.getElementsByClassName(idproducto)[0]
                console.log("precio DOWN: ", precio)
                console.log("Valor DOWN: ", valor)
                precioF.innerText =  parseFloat(precioF.innerHTML) - parseFloat(precio)
                actualitzarQuantitat(valor-1,inputV)

            })
        }




        for(x = 0; x<input.length;x++){
            input[x].addEventListener('change',event=>{
                idproducto = event.target.parentNode.getElementsByClassName("up")[0].value
                precio = event.target.parentNode.getElementsByClassName("precio_"+idproducto)[0].innerHTML
                valor = event.target.parentNode.getElementsByClassName(idproducto)[0].value

                console.log("input:" ,valor)
                precio = 0
                for(x = 0; x<precioO.length;x++){
                    precio = precio + parseFloat(precioO[x].innerHTML) *  cantidad[x].value
                }
                precioF.innerHTML = precio
                actualitzarQuantitat(parseInt(valor))

            })
        }

    </script>

@endsection
