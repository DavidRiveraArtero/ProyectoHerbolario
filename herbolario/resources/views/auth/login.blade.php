@extends('layoutsCompartido.body')
@section('content')
    <div class="aling-content-center" style="padding-top: 150px">
        <h1 class="txt-centrado">Login</h1>
        <hr>
        <div class="txt-centrado marg-top45px">
            <h3>Email</h3>
            <input type="email" class="input_form_login" placeholder="Email" style="margin-bottom: 45px">
            <h3>Password</h3>
            <input type="password" class="input_form_login " placeholder="Password"><br/>
            <div style="margin-top: 8px">
                <input type="checkbox" style="float: left; margin-left: 670px; margin-top: 5px">
                <h5 style="float: left; text-align: center">Recordar Contraseña. <a href="#">Detalles</a></h5>
            </div><br/><br/>
            <div class="d-grid gap-2 col-3 mx-auto" style="margin-top: 20px">
                <button class="btn btn-primary">Login</button>
            </div>
        </div>
        <div class="txt-centrado marg-top45px">
            <hr>
            <h3>¿Eres nuevo?</h3>
            <div class="d-grid gap-2 col-3 mx-auto" style="margin-top: 20px">
                <button class="btn btn-success">Crear Cuenta</button>
            </div>
        </div>
    </div>
@endsection
