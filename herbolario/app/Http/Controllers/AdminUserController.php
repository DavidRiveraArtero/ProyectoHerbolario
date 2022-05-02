<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avatar_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index',[
            'usuarios'=>User::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            "nombre"=>'required',
            'email'=>'required|email',
            'password'=>'required|min:9',
            'rol'=>'required'
        ]);

        $request->old('nombre');
        if($request->rol == "user"){
            $rol = 2;
        }else{
            $rol = 1;
        }

        $ok = User::create([
            'name'=>$request->nombre,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role_id'=>$rol
        ]);


        if($ok){
            $long = $request->file_path;

            for($x = 0; $x < count($long); $x++){
                $upload = $request->file('file_path');
                $ruta = 'uploads/users/'.$request->email;
                $fileName = $request->file('file_path')[$x]->getClientOriginalName();
                $fileUpload = time() . "_" . $fileName;
                $filePath = $upload[$x]->storeAs(
                    $ruta,
                    $fileUpload,
                    'public'
                );

                if(\Storage::disk('public')->exists($filePath)) {

                    $fullPath = \Storage::disk('public')->path($filePath);
                    if ($x == 0) {
                        Avatar_usuarios::create([
                            'id_usuario' => $ok->id,
                            'file_path' => $filePath,
                            'activo' => 1
                        ]);
                    } else {
                        Avatar_usuarios::create([
                            'id_usuario' => $ok->id,
                            'file_path' => $filePath,
                            'activo' => 0
                        ]);
                    }
                }
            }
            return redirect()->route('usuarios.index')->with('success', 'Usuario Creado');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
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
    public function destroy(User $user, $id)
    {
        $user = User::all()->where('id','=',$id)->first();

        $storageDisk = Avatar_usuarios::where('id_usuario',$user->id)->get();

        Storage::disk('public')->delete($storageDisk[0]->file_path);

        $foto_id = Avatar_usuarios::where('id_usuario',$user->id)->delete();

        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado');

    }
}
