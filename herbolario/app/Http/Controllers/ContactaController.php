<?php

namespace App\Http\Controllers;
use App\Models\Avatar_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactaController extends Controller
{

    public function index()
    {
        if(Auth::user()){
            $fotoUser = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);
            return view('contacta',[
                "FotoUsuario" => $fotoUser
            ]);
        }else{
            return view('contacta');
        }


    }
}
