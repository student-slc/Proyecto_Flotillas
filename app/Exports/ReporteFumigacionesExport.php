<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteFumigacionesExport implements FromCollection, WithHeadings
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
    public function headings(): array
    {
        return [
            "CLIENTE",
            "MARCA", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD", "FECHA ULTIMA FUMIGACIÓN"
        ];
    }
}
