<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Verificacione;


class ReporteIndividualVExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $tipo, string $cli, string $inicio, string $final, string $unidad)
    {
        $this->tipo = $tipo;
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->unidad = $unidad;
    }
    public function collection()
    {
        /* whereDate('created_at','<=', '2021-01-17') */
        $tipo = $this->tipo;
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $unidad = $this->unidad;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
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
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.tipomantenimiento',
                                'unidades.frecuencia_mante',
                                'unidades.seguro_fecha',
                                'unidades.lapsofumigacion',
                            )->get();
                    }
                } else {
                    if ($unidad == 'todos') {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    } else {
                        if ($tipo == 'Ambiental') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Fisica') {
                            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                        if ($tipo == 'Ambas') {
                            return Unidade::join(
                                'verificaciones',
                                function ($join) {
                                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                                }
                            )
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.cliente', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->select(
                                    'unidades.cliente',
                                    'verificaciones.tipoverificacion',
                                    'verificaciones.subtipoverificacion',
                                    'verificaciones.ultimaverificacion',
                                    'unidades.marca',
                                    'unidades.serieunidad',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipounidad',
                                    'unidades.razonsocialunidad',
                                    'unidades.digitoplaca',
                                    'unidades.kilometros_contador',
                                    'unidades.tipomantenimiento',
                                    'unidades.frecuencia_mante',
                                    'unidades.seguro_fecha',
                                    'unidades.lapsofumigacion',
                                )->get();
                        }
                    }
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "TIPO VERIFICACION",
            "SUB TIPO VERIFICACION", "ULTIMA VERIFICACION",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD", "DIGITO PLACA"
            , "KILOMETROS", "TIPO MANTENIMIENTO", "FRECUENCIA MANTENIMIENTO", "VENCIMIENTO SEGURO", "FRECUENCIA FUMIGACION"
        ];
    }
}
