<?php

namespace App\Http\Controllers;

use App\Models\{Unidade, Fumigacione, Operadore, Verificacione};
use Illuminate\Http\Request;
use PDF;

class Metodos extends Controller
{
    public function Reporte_Flotillas($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
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
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('unidades.verificacion_fecha', '<=', $final)
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
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('unidades.verificacion_fecha', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
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
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
                        ->whereDate('unidades.verificacion_fecha', '<=', $final)
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
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('unidades.verificacion_fecha', '>=', $inicio)
                            ->whereDate('unidades.verificacion_fecha', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            }
        }
    }
    public function Reporte_Verificaciones($tipo, $cli, $final, $inicio, $unidad)
    {
        /* ============================================================================== */
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
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
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
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
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
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
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
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
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
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
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
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
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
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
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
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
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
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
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
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
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
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
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
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
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.serieunidad', '=', $unidad)
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
                    }
                }
            }
        }
        /* ============================================================================== */
    }
    public function Reporte_Seguros($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
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
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('unidades.seguro_fecha', '<=', $final)
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
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->whereDate('unidades.seguro_fecha', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('unidades.seguro_fecha', '>=', $inicio)
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
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('unidades.seguro_fecha', '>=', $inicio)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('unidades.seguro_fecha', '>=', $inicio)
                        ->whereDate('unidades.seguro_fecha', '<=', $final)
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
                } else {
                    if ($unidad == "todos") {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->whereDate('unidades.seguro_fecha', '>=', $inicio)
                            ->whereDate('unidades.seguro_fecha', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->join('seguros', 'seguros.nopoliza', '=', 'unidades.seguro')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereNot('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('unidades.serieunidad', '=', $unidad)
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
                }
            }
        }
    }
    public function FumigacionesUnidadesCFIU($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->whereDate('lapsofumigacion', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->whereDate('lapsofumigacion', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->whereDate('lapsofumigacion', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->whereDate('lapsofumigacion', '>=', $inicio)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                        ->whereDate('lapsofumigacion', '>=', $inicio)
                        ->whereDate('lapsofumigacion', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'lapsofumigacion'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->whereDate('lapsofumigacion', '>=', $inicio)
                            ->whereDate('lapsofumigacion', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'lapsofumigacion'
                            )->get();
                    }
                }
            }
        }
    }
    public function Reporte_Individual_Vehicular($cli, $final, $inicio, $unidad)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
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
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.verificacion_fecha', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.verificacion_fecha2', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.seguro_fecha', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.lapsofumigacion', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final);
                                        }
                                    );
                            }
                        )
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
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
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
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
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
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
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
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha', '<=', $final)->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha2', '<=', $final)->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.seguro_fecha', '<=', $final)->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.lapsofumigacion', '<=', $final)->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final)->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
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
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final)->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final)->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final)->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final)->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final)->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
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
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final)->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final)->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final)->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final)->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final)->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
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
                }
            }
        }
    }
    public function Reporte_Individual_Operador($cli, $final, $inicio, $operador)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'operadores.nombreoperador',
                            'operadores.nolicencia',
                            'operadores.fechavencimientolicencia',
                            'operadores.fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'operadores.nombreoperador',
                                'operadores.nolicencia',
                                'operadores.fechavencimientolicencia',
                                'operadores.fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->where('operadores.nombreoperador', '=', $operador)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                        ->whereDate('operadores.fechavencimientolicencia', '<=', $final)
                        ->whereDate('operadores.fechavencimientomedico', '<=', $final)
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'operadores.nombreoperador',
                            'operadores.nolicencia',
                            'operadores.fechavencimientolicencia',
                            'operadores.fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->whereDate('operadores.fechavencimientolicencia', '<=', $final)
                            ->whereDate('operadores.fechavencimientomedico', '<=', $final)
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'operadores.nombreoperador',
                                'operadores.nolicencia',
                                'operadores.fechavencimientolicencia',
                                'operadores.fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->whereDate('operadores.fechavencimientolicencia', '<=', $final)
                            ->whereDate('operadores.fechavencimientomedico', '<=', $final)
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->where('operadores.nombreoperador', '=', $operador)
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
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                        ->whereDate('operadores.fechavencimientolicencia', '>=', $inicio)
                        ->whereDate('operadores.fechavencimientomedico', '>=', $inicio)
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'operadores.nombreoperador',
                            'operadores.nolicencia',
                            'operadores.fechavencimientolicencia',
                            'operadores.fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('operadores.fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('operadores.fechavencimientomedico', '>=', $inicio)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'operadores.nombreoperador',
                                'operadores.nolicencia',
                                'operadores.fechavencimientolicencia',
                                'operadores.fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->where('operadores.nombreoperador', '=', $operador)
                            ->whereDate('operadores.fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('operadores.fechavencimientomedico', '>=', $inicio)
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
                }
            } else {
                if ($cli == 'todos') {
                    return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                        ->whereDate('operadores.fechavencimientolicencia', '>=', $inicio)
                        ->whereDate('operadores.fechavencimientomedico', '>=', $inicio)
                        ->whereDate('operadores.fechavencimientolicencia', '<=', $final)
                        ->whereDate('operadores.fechavencimientomedico', '<=', $final)
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'operadores.nombreoperador',
                            'operadores.nolicencia',
                            'operadores.fechavencimientolicencia',
                            'operadores.fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->whereDate('operadores.fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('operadores.fechavencimientomedico', '>=', $inicio)
                            ->whereDate('operadores.fechavencimientolicencia', '<=', $final)
                            ->whereDate('operadores.fechavencimientomedico', '<=', $final)
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'operadores.nombreoperador',
                                'operadores.nolicencia',
                                'operadores.fechavencimientolicencia',
                                'operadores.fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::join('clientes', 'clientes.nombrecompleto', '=', 'operadores.cliente')
                            ->whereDate('operadores.fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('operadores.fechavencimientomedico', '>=', $inicio)
                            ->whereDate('operadores.fechavencimientolicencia', '<=', $final)
                            ->whereDate('operadores.fechavencimientomedico', '<=', $final)
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->where('operadores.nombreoperador', '=', $operador)
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
                }
            }
        }
    }
    public function SatisfaccionCIFUT($cli, $inicio, $final, $unidad, $tipou)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'fumigaciones.numerofumigacion',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.unidad',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.id_fumigador',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                    'fumigaciones.status',
                                )->get();
                        }
                    }
                }
            }
        } else {
            if ($cli == 'todos') {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                }
            } else {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'fumigaciones.numerofumigacion',
                                'clientes.nombrecompleto',
                                'fumigaciones.unidad',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.id_fumigador',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                                'fumigaciones.status',
                            )->get();
                    }
                }
            }
        }
    }
    public function Reporte_Semanal($cli, $inicio, $final, $unidad, $tipou)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
                                ->orWhere('fumigaciones.status', 'Realizado')
                                ->orWhere('fumigaciones.status', 'Inactivo')
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
                    }
                }
            }
        } else {
            if ($cli == 'todos') {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                }
            } else {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.fechaprogramada', '<=', $final)
                            ->whereDate('fumigaciones.fechaprogramada', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->orWhere('fumigaciones.status', 'Realizado')
                            ->orWhere('fumigaciones.status', 'Inactivo')
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
                }
            }
        }
    }
    public function Reportes_Fumigaciones_Proximas($cli, $inicio, $final, $unidad, $tipou)
    {
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
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
                    } else {
                        if ($tipou == 'Ambas') {
                            return Fumigacione::join(
                                'unidades',
                                function ($join) {
                                    $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                                }
                            )
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('fumigaciones.unidad', '=', $unidad)
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
                    }
                }
            }
        } else {
            if ($cli == 'todos') {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
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
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                }
            } else {
                if ($unidad == 'todos') {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
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
                } else {
                    if ($tipou == 'Ambas') {
                        return Fumigacione::join(
                            'unidades',
                            function ($join) {
                                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
                            }
                        )
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('fumigaciones.unidad', '=', $unidad)
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
                }
            }
        }
    }
    public function ConstanciaFumigacion($id)
    {
        return Fumigacione::join(
            'unidades',
            function ($join) {
                $join->on('unidades.serieunidad', '=', 'fumigaciones.unidad')->orOn('unidades.direccion', '=', 'fumigaciones.unidad');
            }
        )
            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
            ->where('fumigaciones.status', 'Realizado')
            ->where('fumigaciones.id', $id)
            ->select(
                'clientes.id',
                'clientes.nombrecompleto',
                'fumigaciones.numerofumigacion',
                'fumigaciones.tipo',
                'fumigaciones.lugardelservicio',
                'fumigaciones.observaciones',
                'fumigaciones.fechaprogramada',
                'fumigaciones.proxima_fumigacion',
                'fumigaciones.id_fumigador',
                'fumigaciones.unidad',
                'unidades.frecuencia_fumiga',
                'fumigaciones.status',
                'unidades.marca',
                'unidades.añounidad',
                'unidades.placas',
                'unidades.razonsocialunidad',
                'clientes.razonsocial',
                'clientes.direccionfisica',
                "insectosvoladores",
                "fumigaciones.pulgas",
                "fumigaciones.aracnidos",
                "fumigaciones.roedores",
                "fumigaciones.insectosrastreros",
                "fumigaciones.mosca",
                "fumigaciones.hormigas",
                "fumigaciones.alacranes",
                "fumigaciones.cucaracha",
                "fumigaciones.chinches",
                "fumigaciones.termitas",
                "fumigaciones.carcamo",
            )
            ->get();
    }
}
class ReportesPDFController extends Metodos
{
    public function ReporteFlotillasPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::Reporte_Flotillas($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteFlotillas', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Flotillas',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Flotillas.pdf');
    }
    public function ReporteVerificacionesPDF(Request $request)
    {
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::Reporte_Verificaciones($tipo, $cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteVerificaciones', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Verificaciones',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 878, 1228), 'portrait');
        return $pdf->download('Reporte_Verificaciones.pdf');
    }
    public function ReporteSegurosPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::Reporte_Seguros($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteSeguros', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Seguros',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Seguros.pdf');
    }
    public function ReporteSemanalPDF(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        $unidades = Metodos::Reporte_Semanal($cli, $inicio, $final, $unidad, $tipou);
        $pdf = PDF::loadView('pdf.ReporteSemanal', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Semanal',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 988, 1228), 'landscape');
        return $pdf->download('Reporte_Fumigaciones_realizadas.pdf');
    }
    public function ReporteDiaPDF(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        $unidades = Metodos::Reportes_Fumigaciones_Proximas($cli, $inicio, $final, $unidad, $tipou);
        $pdf = PDF::loadView('pdf.ReporteDia', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Dia',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 840, 1240), 'landscape');
        return $pdf->download('Reporte_Fumigaciones_Proximas.pdf');
    }
    public function ReporteIndividualPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $operador = "" . $request['filtrooper'];
        $operadores = Metodos::Reporte_Individual_Operador($cli, $final, $inicio, $operador);
        $pdf = PDF::loadView('pdf.ReporteIndividual', [
            'operadores' => $operadores,
            'nombre' => 'Reporte Individual Operador',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Individual_Operador.pdf');
    }
    public function ReporteIndividualVPDF(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::Reporte_Individual_Vehicular($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteIndividualv', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Individual Vehicular',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 1188, 1538), 'landscape');
        return $pdf->download('Reporte_Individual_Vehicular.pdf');
    }
    public function ReporteSatisfaccionPDF(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        $unidades = Metodos::SatisfaccionCIFUT($cli, $inicio, $final, $unidad, $tipou);
        $pdf = PDF::loadView('pdf.ReporteSatisfaccion', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Satisfaccion',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Satisfaccion.pdf');
    }
    public function ReporteFumigacionesPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $unidades = Metodos::FumigacionesUnidadesCFIU($cli, $final, $inicio, $unidad);
        $pdf = PDF::loadView('pdf.ReporteFumigaciones', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Fumigaciones',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Fumigaciones.pdf');
    }
    public function ReporteServicioPDF(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        $unidades = Metodos::Reporte_Semanal($cli, $inicio, $final, $unidad, $tipou);
        $pdf = PDF::loadView('pdf.ReporteSemanal', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Servicio',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'landscape');
        return $pdf->download('Reporte_Servicio.pdf');
    }

    public function reporteIndividualFumigacion($id)
    {
        $fumigaciones = Metodos::ConstanciaFumigacion($id);
        /* $fumigacion = Fumigacione::findOrFail($id); */
        $pdf = PDF::loadView('pdf.constancia_fumigacion', [
            'fumigaciones' => $fumigaciones,
        ]);
        $pdf->setPaper(array(0, 0, 638, 888), 'portrait');
        $pdf->render();
        /* return $pdf->stream('Constancia_de_fumigación'); */
        return $pdf->download('Constancia_de_fumigación.pdf');
    }
}
