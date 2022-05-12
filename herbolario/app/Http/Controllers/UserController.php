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
        $fotoUser = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);

        if($user->id == Auth::user()->id) {
            return view('user.configurar.configurarUser', [
                'usuario' => Auth::user(),
                "FotoUsuario" => $fotoUser
            ]);
        }else{
            dd("ERROR ESTE NO ES TU USUARIO");
        }
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
        $request->validate([
            'nombre'=>'required|min:3',
            'password'=>'required|min:8'
        ]);

        $ok = $user->updateOrFail([
            'name'=>$request->nombre,
            'password'=>Hash::make($request->password)
        ]);

        if($ok){
            if($request->file_path){
                $long = $request->file_path;
                for($x = 0; $x < count($long); $x++){
                    $upload = $request->file('file_path');
                    $ruta = 'uploads/users/'.$user->email;
                    $fileName = $request->file('file_path')[$x]->getClientOriginalName();
                    $fileUpload = time() . "_" . $fileName;
                    $filePath = $upload[$x]->storeAs(
                        $ruta,
                        $fileUpload,
                        'public'
                    );

                    if(\Storage::disk('public')->exists($filePath)) {

                        $fullPath = \Storage::disk('public')->path($filePath);
                        $existActive = Avatar_usuarios::all()->where('id_usuario','=',Auth::user()->id);

                        $active = $existActive->where('activo','=',1);



                        if (count($active) == 0) {
                            Avatar_usuarios::create([
                                'id_usuario' => $user->id,
                                'file_path' => $filePath,
                                'activo' => 1
                            ]);
                        }else{
                            Avatar_usuarios::create([
                                'id_usuario' => $user->id,
                                'file_path' => $filePath,
                                'activo' => 0
                            ]);
                        }
                    }
                }
            }
            return Redirect()->back()->with('success','Los cambios se han guardado con exito');
        }else{
            return Redirect()->back()->with('success','Error para actualizar los datos');

        }

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
