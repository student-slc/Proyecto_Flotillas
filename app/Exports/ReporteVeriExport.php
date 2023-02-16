<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
class ReporteVeriExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
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
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('verificacion_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('verificacion_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
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
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('verificacion_fecha', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->where('cliente', '=', $cli)
                            ->whereDate('verificacion_fecha', '>=', $inicio)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
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
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                        ->whereDate('verificacion_fecha', '>=', $inicio)
                        ->whereDate('verificacion_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == "todos") {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
                            ->whereDate('verificacion_fecha', '>=', $inicio)
                            ->whereDate('verificacion_fecha', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'marca',
                                'serieunidad',
                                'añounidad',
                                'placas',
                                'tipounidad',
                                'razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::where('tipo', '=', 'Unidad Vehicular')
                            ->whereNot('verificacion_fecha', '=', 'Sin Fecha de Verificación')
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
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD",
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray(array(
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
