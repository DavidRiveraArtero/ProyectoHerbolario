<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

// PRODUCTOS HOME
Route::resource('home',ProductoController::class);

Auth::routes();

// ADMIN
Route::resource('admin/productos', AdminProductoController::class)->middleware(['auth', 'role:1']);

Route::resource('admin/usuarios', AdminUserController::class)->middleware(['auth', 'role:1']);

// REGISTER
Route::resource('user', UserController::class);

Route::resource('perfil',UserController::class)->middleware(['auth']);


Route::get('/login',function (){
    return view('auth/login');
})->name('login');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

