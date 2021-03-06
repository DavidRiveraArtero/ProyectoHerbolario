<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\comentarioController;
use App\Http\Controllers\ContactaController;
use App\Http\Controllers\direccionController;
use App\Http\Controllers\carritoController;
use App\Http\Controllers\comandaController;
use App\Http\Controllers\misPedidosController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\quienesSomosController;
use App\Http\Controllers\AdminComandaController;
use Illuminate\Http\Request;
use App\Models\Avatar_usuarios;
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

Auth::routes(['verify'=>true]);

// ADMIN
Route::resource('admin/productos', AdminProductoController::class)->middleware(['auth', 'role:1']);

Route::resource('admin/usuarios', AdminUserController::class)->middleware(['auth', 'role:1']);

Route::resource('admin/comentarios', AdminUserController::class)->middleware(['auth', 'role:1']);

// REGISTER
Route::resource('user', UserController::class);

// Comentario
Route::resource('productos.comentarios', comentarioController::class);

// PERFIL
Route::resource('perfil',UserController::class)->middleware(['auth','verified']);

// CONTACTANOS
Route::resource('contactanos', ContactaController::class)->middleware(['auth','verified']);;

// Direccion
Route::resource('direccion', direccionController::class)->middleware(['auth','verified']);;

// Carrito
Route::resource('carrito',carritoController::class)->middleware(['auth','verified']);;

// COMANDA
Route::resource('comanda',comandaController::class)->middleware(['auth','verified']);;

// MIS PEDIDOS
Route::resource('misPedidos',misPedidosController::class);

// CATEGORIAS
Route::get("categoria/{categoria}", [categoriaController::class,'categoria'])->name('categoria');

// PAYPAL STATUS
Route::get('/paypal/status',[comandaController::class,'payPalStatus']);

// Quienes somos
Route::get('/quienes_somos',[quienesSomosController::class , 'index'])->name('quienes_somos');

Route::resource('adminCategoria',categoriaController::class);

// Admin Comanda
Route::resource('adminComanda', AdminComandaController::class);

Route::post('filtrarComanda', [AdminComandaController::class, 'filtrarComanda'])->name('filtrar_comanda');

Route::post('cantidad_carrito',[carritoController::class , 'cantidProducto'])->name('carrit_ajax.store');

// LOGIN
Route::get('/login',function (){
    return view('auth/login');
})->name('login');




//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

