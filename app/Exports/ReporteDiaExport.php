<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteDiaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
    }
    public function collection()
    {
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                } else {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where('unidades.cliente', '=', $cli)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereDate('unidades.lapsofumigacion', '<=', $final)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                } else {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereDate('unidades.lapsofumigacion', '<=', $final)
                        ->where('unidades.cliente', '=', $cli)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereDate('unidades.lapsofumigacion', '>=', $inicio)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                } else {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where('unidades.cliente', '=', $cli)
                        ->whereDate('unidades.lapsofumigacion', '>=', $inicio)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereDate('unidades.lapsofumigacion', '>=', $inicio)
                        ->whereDate('unidades.lapsofumigacion', '<=', $final)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                } else {
                    return Unidade::join('fumigaciones', 'fumigaciones.numerofumigacion', '=', 'unidades.fumigacion')
                        ->join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->whereDate('unidades.lapsofumigacion', '>=', $inicio)
                        ->whereDate('unidades.lapsofumigacion', '<=', $final)
                        ->where('unidades.cliente', '=', $cli)
                        ->select(
                            'unidades.cliente',
                            'unidades.marca',
                            'unidades.serieunidad',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.tipounidad',
                            'unidades.razonsocialunidad',
                            'unidades.lapsofumigacion',
                            'fumigaciones.id_fumigador',
                            'clientes.razonsocial',
                            'clientes.direccionfisica',
                            'fumigaciones.status',
                        )->get();
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD", "FECHA ULTIMA FUMIGACIÓN", "TECNICO", "RAZON SOCIAL CLIENTE", "DIRECCION FISICA CLIENTE", "SATUS DE PAGO",
        ];
    }
}
