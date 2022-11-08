<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ExcelLogController;
use App\Http\Controllers\ObservadorController;
use App\Http\Controllers\OperadoresController;
use App\Http\Controllers\FumigadoresController;
use App\Http\Controllers\FumigacionesController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\VerificacionesController;
use App\Http\Controllers\Verificaciones2Controller;
use App\Http\Controllers\MantenimientosController;
use App\Models\Mantenimiento;

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
Route::resource('operadores', OperadoresController::class);
Route::resource('fumigadores', FumigadoresController::class);
Route::resource('fumigaciones', FumigacionesController::class);
Route::resource('seguros', SegurosController::class);
Route::resource('verificaciones', VerificacionesController::class);
Route::resource('verificacionesfisicomecanicas', Verificaciones2Controller::class);
Route::resource('mantenimientos', MantenimientosController::class);
Route::resource('logs', ObservadorController::class);
});
/* Route::controller(ExcelLogController::class)->group(function(){
    Route::get('log-export', 'export')->name('log.export');
    Route::post('log-import', 'import')->name('log.import');
}); */

///--------------------------------------UNIDADES--------------------------------------------------------------------
Route::get('/clientes/unidades/crear/{usuario}','App\Http\Controllers\UnidadesController@crear')->name('unidades.crear');

///--------------------------------------OPERADORES--------------------------------------------------------------------
Route::get('/clientes/unidades/operadores/crear/{usuario}','App\Http\Controllers\OperadoresController@crear')->name('operadores.crear');

///--------------------------------------CREAR VERIFICACIÓN--------------------------------------------------------------------
Route::get('/clientes/unidades/verificaciones/crear/{unidad}','App\Http\Controllers\VerificacionesController@crear')->name('verificaciones.crear');
///--------------------------------------CREAR MANTENIMIENTO--------------------------------------------------------------------
Route::get('/clientes/unidades/mantenimientos/crear/{unidad}','App\Http\Controllers\MantenimientosController@crear')->name('mantenimientos.crear');
///--------------------------------------CREAR FUMIGACION--------------------------------------------------------------------
Route::get('/clientes/unidades/fumigaciones/crear/{unidad}','App\Http\Controllers\FumigacionesController@crear')->name('fumigaciones.crear');
///--------------------------------------CREAR VERIFICACIÓN--------------------------------------------------------------------
Route::get('/clientes/unidades/verificacionesfisicomecanicas/crear/{unidad}','App\Http\Controllers\Verificaciones2Controller@crear')->name('verificacionesfisicomecanicas.crear');

///--------------------------------------CREAR EXCEL LOG--------------------------------------------------------------------
Route::controller(ObservadorController::class)->group(function(){
    Route::get('logs-export', 'export')->name('logs.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL CLIENTES--------------------------------------------------------------------
Route::controller(ClientesController::class)->group(function(){
    Route::get('clientes-export', 'export')->name('clientes.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL FUMIGACIONES--------------------------------------------------------------------
Route::controller(FumigacionesController::class)->group(function(){
    Route::get('fumigaciones-export', 'export')->name('fumigaciones.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL FUMIGADORES--------------------------------------------------------------------
Route::controller(FumigadoresController::class)->group(function(){
    Route::get('fumigadores-export', 'export')->name('fumigadores.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL OPERADORES--------------------------------------------------------------------
Route::controller(OperadoresController::class)->group(function(){
    Route::get('operadores-export/{usuario}', 'export')->name('operadores.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL UNIDADES--------------------------------------------------------------------
Route::controller(UnidadesController::class)->group(function(){
    Route::get('unidades-export/{usuario}', 'export')->name('unidades.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL MANTENIMIENTOS--------------------------------------------------------------------
Route::controller(MantenimientosController::class)->group(function(){
    Route::get('mantenimientos-export/{unidad}', 'export')->name('mantenimientos.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL SEGUROS--------------------------------------------------------------------
Route::controller(SegurosController::class)->group(function(){
    Route::get('seguros-export/{unidad}', 'export')->name('seguros.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL VERIFICACIONES--------------------------------------------------------------------
Route::controller(VerificacionesController::class)->group(function(){
    Route::get('verificaciones-export/{unidad}', 'export')->name('verificaciones.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});
///--------------------------------------CREAR EXCEL VERIFICACIONES--------------------------------------------------------------------
Route::controller(VerificacionesController::class)->group(function(){
    Route::get('verificacionesfisicomecanicas-export/{unidad}', 'export')->name('verificacionesfisicomecanicas.export');
    /* Route::post('log-import', 'import')->name('log.import'); */
});

///--------------------------------------REPORTES SEGUROS--------------------------------------------------------------------
Route::get('/reportes/seguros', [App\Http\Controllers\ReportesController::class, 'seguros'])->name('reportes.seguros');
///--------------------------------------REPORTES VERIFICACIONES AMBIENTALES--------------------------------------------------------------------
Route::get('/reportes/verificaciones_ambientales', [App\Http\Controllers\ReportesController::class, 'vambiental'])->name('reportes.vambiental');
///--------------------------------------REPORTES VERIFICACIONES FISICO-MECANICAS--------------------------------------------------------------------
Route::get('/reportes/verificaciones_fisico_mecanicas', [App\Http\Controllers\ReportesController::class, 'vfisicas'])->name('reportes.vfisica');
///--------------------------------------REPORTES VERIFICACIONES FISICO-MECANICAS--------------------------------------------------------------------
Route::get('/reportes/mantenimientos', [App\Http\Controllers\ReportesController::class, 'mantenimientos'])->name('reportes.mantenimientos');






