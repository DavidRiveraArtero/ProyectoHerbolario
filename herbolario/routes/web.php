<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminProductoController;
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

//Route::get('/', function () {
//    return view('home/home');
//});

// PRODUCTOS HOME
Route::resource('home',ProductoController::class);

// ADMIN
Route::resource('admin/productos', AdminProductoController::class);



Route::get('/login',function (){
    return view('auth/login');
})->name('login');
