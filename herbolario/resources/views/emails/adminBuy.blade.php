<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['NombreUser'] }}</title>

</head>
@include('layoutsCompartido.head')
<body>

<h1>Nueva Comanda por: {{ $details['NombreUser'] }}</h1>
<h4>Su email es: {{ $details['correo'] }} </h4>
<h4>Su telefono es: {{ $details['telefono']}}</h4><br/>
<h1>Informacion</h1>
<table class="table_comanda" style="width: 100%">
    <tr>
        <th style="border: 1px solid black; size: 20px">Direccion Envio</th>
        <th style="border: 1px solid black; size: 20px">Codigo Postal</th>
        <th style="border: 1px solid black; size: 20px">Provincia</th>
        <th style="border: 1px solid black; size: 20px">Ciudad</th>
    </tr>
    <tr style="border: 1px solid black">
        <th style="border: 1px solid black">{{ $details['direccion_envio'] }}</th>
        <th style="border: 1px solid black">{{ $details['codigo_postal'] }}</th>
        <th style="border: 1px solid black">{{ $details['provincia'] }}</th>
        <th style="border: 1px solid black">{{ $details['ciudad'] }}</th>
    </tr>
</table>

@php($cont = 0)
@foreach($details['productos'] as $producto)
    <h1>Nombre Producto: {{$producto->nombre}}</h1>
    @foreach($details['foto_producto'] as $foto)
     <img src="{{asset('storage/'.$foto->file_path)}}">
    @endforeach
    @php($cont++)
@endforeach

<p>Thank you</p>
</body>
</html>
