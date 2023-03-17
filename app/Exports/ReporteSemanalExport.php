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

class ReporteSemanalExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
    public function headings(): array
    {
        return [
            "ID CLIENTE", "CLIENTE", "RAZON SOCIAL CLIENTE", "DIRECCION FISICA CLIENTE", "FOLIO FUMIGACION",
            "UNIDAD", "FUMIGADOR", "FECHA FUMIGACIÓN", "STATUS",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO", "RAZON SOCIAL UNIDAD"
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:O1')->applyFromArray(array(
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
