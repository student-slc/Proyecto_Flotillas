<?php

namespace App\Http\Controllers;

use App\Models\Fumigacione;
use App\Models\Operadore;
use App\Models\Unidade;
use App\Models\Cliente;
use App\Models\Fumigadore;
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
            $fumigadores = Fumigadore::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.numerofumigacion',
                    'fumigaciones.unidad',
                    'fumigaciones.id_fumigador',
                    'fumigaciones.fechaprogramada',
                    'fumigaciones.status',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigadores = Fumigadore::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.numerofumigacion',
                    'fumigaciones.unidad',
                    'fumigaciones.id_fumigador',
                    'fumigaciones.fechaprogramada',
                    'fumigaciones.status',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $fumigadores = Fumigadore::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('clientes.nombrecompleto', '=', $clientes)
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.numerofumigacion',
                    'fumigaciones.unidad',
                    'fumigaciones.id_fumigador',
                    'fumigaciones.fechaprogramada',
                    'fumigaciones.status',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        return view('tabla_reportes.reporte_fumigaciones', compact('fumigaciones', 'clientes', 'fumigadores'));
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
            $fumigadores = Fumigadore::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where(
                    function ($query) {
                        $query->where('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo');
                    }
                )
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.numerofumigacion',
                    'fumigaciones.unidad',
                    'fumigaciones.id_fumigador',
                    'fumigaciones.fechaprogramada',
                    'fumigaciones.status',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigadores = Fumigadore::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where(
                    function ($query) {
                        $query->where('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo');
                    }
                )
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.numerofumigacion',
                    'fumigaciones.unidad',
                    'fumigaciones.id_fumigador',
                    'fumigaciones.fechaprogramada',
                    'fumigaciones.status',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $fumigadores = Fumigadore::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('clientes.nombrecompleto', '=', $clientes)
                ->where(
                    function ($query) {
                        $query->where('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo');
                    }
                )
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.numerofumigacion',
                    'fumigaciones.unidad',
                    'fumigaciones.id_fumigador',
                    'fumigaciones.fechaprogramada',
                    'fumigaciones.status',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        return view('tabla_reportes.reporte_semanal',  compact('fumigaciones', 'clientes','fumigadores'));
    }
    public function reporte_dia()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('fumigaciones.status', 'Realizado')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.unidad',
                    'fumigaciones.proxima_fumigacion',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('fumigaciones.status', 'Realizado')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.unidad',
                    'fumigaciones.proxima_fumigacion',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $fumigaciones = Fumigacione::join(
                'unidades',
                function ($join) {
                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                }
            )
                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('clientes.nombrecompleto', '=', $clientes)
                ->where('fumigaciones.status', 'Realizado')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'clientes.direccionfisica',
                    'fumigaciones.unidad',
                    'fumigaciones.proxima_fumigacion',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipo',
                    'unidades.razonsocialunidad',
                )->get();
        }
        return view('tabla_reportes.reporte_dia', compact('fumigaciones', 'clientes'));
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
            $operadores = Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'operadores.nombreoperador',
                    'operadores.nolicencia',
                    'operadores.fechavencimientolicencia',
                    'operadores.fechavencimientomedico',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $operadores = Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'operadores.nombreoperador',
                    'operadores.nolicencia',
                    'operadores.fechavencimientolicencia',
                    'operadores.fechavencimientomedico',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $operadores = Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                ->where('clientes.nombrecompleto', '=', $clientes)
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'operadores.nombreoperador',
                    'operadores.nolicencia',
                    'operadores.fechavencimientolicencia',
                    'operadores.fechavencimientomedico',
                )->get();
        }
        return view('tabla_reportes.reporte_individual', compact('operadores', 'clientes'));
    }
    public function reporte_individualv()
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
                    'clientes.razonsocial',
                    'unidades.tipounidad',
                    'unidades.serieunidad',
                    'unidades.verificacion',
                    'unidades.verificacion_fecha',
                    'unidades.verificacion2',
                    'unidades.verificacion_fecha2',
                    'unidades.seguro',
                    'unidades.seguro_fecha',
                    'unidades.fumigacion',
                    'unidades.lapsofumigacion',
                    'unidades.frecuencia_fumiga',
                    'unidades.mantenimiento',
                    'unidades.mantenimiento_fecha',
                    'unidades.frecuencia_mante',
                    'unidades.tipomantenimiento',
                    'unidades.marca',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.digitoplaca',
                    'unidades.kilometros_contador',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'unidades.tipounidad',
                    'unidades.serieunidad',
                    'unidades.verificacion',
                    'unidades.verificacion_fecha',
                    'unidades.verificacion2',
                    'unidades.verificacion_fecha2',
                    'unidades.seguro',
                    'unidades.seguro_fecha',
                    'unidades.fumigacion',
                    'unidades.lapsofumigacion',
                    'unidades.frecuencia_fumiga',
                    'unidades.mantenimiento',
                    'unidades.mantenimiento_fecha',
                    'unidades.frecuencia_mante',
                    'unidades.tipomantenimiento',
                    'unidades.marca',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.digitoplaca',
                    'unidades.kilometros_contador',
                    'unidades.razonsocialunidad',
                )->get();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->where('unidades.cliente', '=', $clientes)
                ->select(
                    'clientes.id',
                    'clientes.nombrecompleto',
                    'clientes.razonsocial',
                    'unidades.tipounidad',
                    'unidades.serieunidad',
                    'unidades.verificacion',
                    'unidades.verificacion_fecha',
                    'unidades.verificacion2',
                    'unidades.verificacion_fecha2',
                    'unidades.seguro',
                    'unidades.seguro_fecha',
                    'unidades.fumigacion',
                    'unidades.lapsofumigacion',
                    'unidades.frecuencia_fumiga',
                    'unidades.mantenimiento',
                    'unidades.mantenimiento_fecha',
                    'unidades.frecuencia_mante',
                    'unidades.tipomantenimiento',
                    'unidades.marca',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.digitoplaca',
                    'unidades.kilometros_contador',
                    'unidades.razonsocialunidad',
                )->get();
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
