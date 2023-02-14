<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReposteSegurosExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final, string $unidad)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->unidad = $unidad;
    }
    public function collection()
    {
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $unidad = $this->unidad;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->whereDate('seguro_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->whereDate('seguro_fecha', '>=', $inicio)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->whereDate('seguro_fecha', '>=', $inicio)
                            ->whereDate('seguro_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('seguro_fecha', '=', 'Sin Fecha de Seguro')
                            ->where('cliente', '=', $cli)
                            ->where('unidades.id', '=', $unidad)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                                'seguro_fecha'
                            )->get();
                    }
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD", "FECHA DE VENCIMIENTO"
        ];
    }
}
