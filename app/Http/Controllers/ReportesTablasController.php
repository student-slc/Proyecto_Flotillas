<?php

namespace App\Http\Controllers;

use App\Models\Fumigacione;
use App\Models\Operadore;
use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;

class ReportesTablasController extends Controller
{
     /* ============================================= REPORTES ================================================= */
     public function reporte_flotilla()
     {
         $verificaciones = Verificacione::all();
         $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
         return view('tabla_reportes.reporte_flotilla', compact('unidades','verificaciones'));
     }
     public function reporte_seguros()
     {
         $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
         return view('tabla_reportes.reporte_seguros', compact('unidades'));
     }
     public function reporte_veri()
     {
         $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
         return view('tabla_reportes.reporte_veri', compact('unidades'));
     }
     public function reporte_preventivo()
     {
         $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
         return view('tabla_reportes.reporte_preventivo', compact('unidades'));
     }
     public function reporte_fumigaciones()
     {
         $unidades = Unidade::all();
         return view('tabla_reportes.reporte_fumigaciones', compact('unidades'));
     }
     public function reporte_operadores()
     {
         $operadores = Operadore::all();
         return view('tabla_reportes.reporte_operador', compact('operadores'));
     }
     public function reporte_semanal()
     {
         $fumigaciones= Fumigacione::all();
         $unidades = Unidade::all();
         return view('tabla_reportes.reporte_semanal', compact('unidades','fumigaciones'));
     }
     public function reporte_dia()
     {
         $unidades = Unidade::all();
         return view('tabla_reportes.reporte_dia', compact('unidades'));
     }
     public function reporte_servicios()
     {
         $unidades = Unidade::all();
         return view('tabla_reportes.reporte_servicios', compact('unidades'));
     }
     public function reporte_individual()
     {
         $operadores = Operadore::all();
         return view('tabla_reportes.reporte_individual', compact('operadores'));
     }
     public function reporte_satisfaccion()
     {
         $unidades = Unidade::all();
         return view('tabla_reportes.reporte_satisfaccion', compact('unidades'));
     }
     public function reporte_individualv()
     {
         $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
         return view('tabla_reportes.reporte_individualv', compact('unidades'));
     }
     public function reporte_bd()
     {
         $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
         return view('tabla_reportes.reporte_bd', compact('unidades'));
     }
     /* ============================================================================================================= */
}
