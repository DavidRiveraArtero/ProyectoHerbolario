<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar_usuarios;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role_id'=>2
        ]);

        $user->sendEmailVerificationNotification();

        return redirect('login')->with('success','Cuenta Creada. Verifique su cuenta en el correo');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($auth)
    {
        $user = User::where('id','=',$auth)->first();
        $fotoUser = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);

        // CONTROLAR QUE SOLO EL USUARIO LOGEADO PUEDA ENTRAR EN SU PERFIL
        if($auth == Auth::user()->id){
            return view("user.perfil",[
                'datosUsuario'=>$user,
                "FotoUsuario" => $fotoUser

            ]);
        }else{
            dd("ERROR ESTE NO ES TU USUARIO");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
