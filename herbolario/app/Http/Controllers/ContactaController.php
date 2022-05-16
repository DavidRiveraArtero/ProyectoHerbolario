<?php

namespace App\Http\Controllers;
use App\Models\Avatar_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;

class ContactaController extends Controller
{

    // VISTA CONTACTA
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

    // SEND EMAIL
    public function store(Request $request){
        $details = [
            'asunto'=> $request->asunto,
            'mensaje'=> $request->mensaje,
            'nombre'=> $request->nombre,
            'email'=> $request->email,
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ];
        \Mail::to('dariar@fp.insjoaquimmir.cat')->send(new SendMail($details));

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
