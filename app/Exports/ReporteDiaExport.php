<?php

namespace App\Exports;

use App\Models\Unidade;
use App\Models\Fumigacione;
use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteDiaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final, string $unidad, string $tipou)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->unidad = $unidad;
        $this->tipou = $tipou;
    }
    public function collection()
    {
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $unidad = $this->unidad;
        $tipou = $this->tipou;
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Habitacion') {
                            return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
                                )->get();
                        }
                        if ($tipou == 'Vehiculo') {
                            return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                                ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                                ->where('clientes.nombrecompleto', '=', $cli)
                                ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                                ->where('unidades.id', '=', $unidad)
                                ->where('fumigaciones.status', 'Realizado')
                                ->select(
                                    'clientes.id',
                                    'clientes.nombrecompleto',
                                    'fumigaciones.numerofumigacion',
                                    'fumigaciones.fechaprogramada',
                                    'fumigaciones.proxima_fumigacion',
                                    'fumigaciones.id_fumigador',
                                    'fumigaciones.unidad',
                                    'unidades.frecuencia_fumiga',
                                    'fumigaciones.status',
                                    'unidades.marca',
                                    'unidades.añounidad',
                                    'unidades.placas',
                                    'unidades.tipo',
                                    'unidades.razonsocialunidad',
                                    'clientes.razonsocial',
                                    'clientes.direccionfisica',
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
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                            ->where('unidades.id', '=', $unidad)
                            ->where('fumigaciones.status', 'Realizado')
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->where('fumigaciones.status', 'Realizado')
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->where('fumigaciones.status', 'Realizado')
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
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
                            ->where('unidades.id', '=', $unidad)
                            ->where('fumigaciones.status', 'Realizado')
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                            )->get();
                    }
                    if ($tipou == 'Habitacion') {
                        return Fumigacione::join('unidades', 'unidades.direccion', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Habitacional o Comercial')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->where('fumigaciones.status', 'Realizado')
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                            )->get();
                    }
                    if ($tipou == 'Vehiculo') {
                        return Fumigacione::join('unidades', 'unidades.serieunidad', '=', 'fumigaciones.unidad')
                            ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('clientes.nombrecompleto', '=', $cli)
                            ->whereDate('fumigaciones.proxima_fumigacion', '<=', $final)
                            ->whereDate('fumigaciones.proxima_fumigacion', '>=', $inicio)
                            ->where('unidades.id', '=', $unidad)
                            ->where('fumigaciones.status', 'Realizado')
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'fumigaciones.numerofumigacion',
                                'fumigaciones.fechaprogramada',
                                'fumigaciones.proxima_fumigacion',
                                'fumigaciones.id_fumigador',
                                'fumigaciones.unidad',
                                'unidades.frecuencia_fumiga',
                                'fumigaciones.status',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipo',
                                'unidades.razonsocialunidad',
                                'clientes.razonsocial',
                                'clientes.direccionfisica',
                            )->get();
                    }
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "ID ClIENTE", "CLIENTE", "FOLIO FUMIGACION",
            "ULTIMA FUMIGACIÓN", "PROXIMA FUMIGACIÓN", "FUMIGADOR", "PLACAS / DIRECCIÓN",
            "FRECUENCIA DE FUMIGACIÓN", "STATUS", "MARCA",
            "AÑO UNIDAD", "PLACAS", "TIPO", "RAZON SOCIAL",
            "RAZON SOCIAL CLIENTE", "DIRECCION FISICA CLIENTE"
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->applyFromArray(array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '9dbad5')
            )
        ));
        return [


            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
