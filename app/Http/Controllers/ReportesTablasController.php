<?php

namespace App\Http\Controllers;

use App\Models\Fumigacione;
use App\Models\Operadore;
use App\Models\Unidade;
use App\Models\Cliente;
use App\Models\Verificacione;
use Illuminate\Http\Request;

class ReportesTablasController extends Controller
{
    /* ============================================= REPORTES ================================================= */
    public function reporte_flotillas()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->where('cliente', '=', $clientes)
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                )->get();;
        }
        return view('tabla_reportes.reporte_flotillas', compact('unidades', 'clientes'));
    }
    public function reporte_verificaciones()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join(
                'verificaciones',
                function ($join) {
                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                }
            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                    "verificaciones.noverificacion",
                    'verificaciones.tipoverificacion',
                    'verificaciones.subtipoverificacion',
                    'verificaciones.ultimaverificacion',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join(
                'verificaciones',
                function ($join) {
                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                }
            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                    "verificaciones.noverificacion",
                    'verificaciones.tipoverificacion',
                    'verificaciones.subtipoverificacion',
                    'verificaciones.ultimaverificacion',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::join(
                'verificaciones',
                function ($join) {
                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                }
            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->where('unidades.cliente', '=', $clientes)
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                    "verificaciones.noverificacion",
                    'verificaciones.tipoverificacion',
                    'verificaciones.subtipoverificacion',
                    'verificaciones.ultimaverificacion',
                )->get();
        }
        return view('tabla_reportes.reporte_verificaciones', compact('unidades', 'clientes'));
    }
    public function reporte_seguros()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                    'unidades.seguro_fecha',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                    'unidades.seguro_fecha',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->where('unidades.cliente', '=', $clientes)
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                    'unidades.seguro_fecha',
                )->get();
        }
        return view('tabla_reportes.reporte_seguros', compact('unidades', 'clientes'));
    }
    public function reporte_preventivo()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_preventivo', compact('unidades'));
    }
    public function reporte_fumigaciones()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::where('cliente', '=', $clientes)->where('tipo', '=', 'Unidad Vehicular')->get();
        }
        return view('tabla_reportes.reporte_fumigaciones', compact('unidades', 'clientes'));
    }
    public function reporte_operadores()
    {
        $operadores = Operadore::all();
        return view('tabla_reportes.reporte_operador', compact('operadores'));
    }
    public function reporte_semanal()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::orWhere('status', 'Realizado')->orWhere('status', 'Inactivo')->get();
            $unidades = Unidade::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::orWhere('status', 'Realizado')->orWhere('status', 'Inactivo')->get();
            $unidades = Unidade::all();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $fumigaciones = Fumigacione::orWhere('status', 'Realizado')->orWhere('status', 'Inactivo')->get();
            $unidades = Unidade::where('cliente', '=', $clientes)->get();
        }
        return view('tabla_reportes.reporte_semanal',  compact('unidades', 'fumigaciones', 'clientes'));
    }
    public function reporte_dia()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::where('status', 'Realizado')->get();
            $unidades = Unidade::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::where('status', 'Realizado')->get();
            $unidades = Unidade::all();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $fumigaciones = Fumigacione::where('status', 'Realizado')->get();
            $unidades = Unidade::where('cliente', '=', $clientes)->get();
        }
        return view('tabla_reportes.reporte_dia', compact('unidades', 'fumigaciones', 'clientes'));
    }
    public function reporte_servicios()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::all();
            $unidades = Unidade::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::all();
            $unidades = Unidade::all();
        }
        if ($rol == 'Usuario') {
            $clientes = Cliente::where('nombrecompleto', '=', $usuario->clientes)->get();
            $fumigaciones = Fumigacione::all();
            $unidades = Unidade::where('cliente', '=', $clientes)->get();
        }
        return view('tabla_reportes.reporte_servicios', compact('unidades', 'fumigaciones', 'clientes'));
    }
    public function reporte_individual()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $operadores = Operadore::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $operadores = Operadore::all();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $operadores = Operadore::where('cliente', '=', $clientes)->get();
        }
        return view('tabla_reportes.reporte_individual', compact('clientes', 'operadores'));
    }
    public function reporte_individualv()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::where('cliente', '=', $clientes)->where('tipo', '=', 'Unidad Vehicular')->get();
        }
        $verificaciones = Verificacione::all();
        return view('tabla_reportes.reporte_individualv', compact('unidades', 'clientes', 'verificaciones'));
    }
    public function reporte_satisfaccion()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::all();
            $unidades = Unidade::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::all();
            $unidades = Unidade::all();
        }
        if ($rol == 'Usuario') {
            $clientes = Cliente::where('nombrecompleto', '=', $usuario->clientes)->get();
            $fumigaciones = Fumigacione::all();
            $unidades = Unidade::where('cliente', '=', $clientes)->get();
        }
        return view('tabla_reportes.reporte_satisfaccion', compact('unidades', 'fumigaciones', 'clientes'));
    }
    public function reporte_bd()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_bd', compact('unidades'));
    }
    /* ============================================================================================================= */
}
