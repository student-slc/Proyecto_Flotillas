<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ObservadorController;


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
    return view('auth.login');
});

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' =>['auth']],function(){
Route::resource('roles', RolController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('unidades', UnidadesController::class);
Route::resource('operadores', UnidadesController::class);
Route::resource('logs', ObservadorController::class);
Route::resource('logs', ObservadorController::class);
});
