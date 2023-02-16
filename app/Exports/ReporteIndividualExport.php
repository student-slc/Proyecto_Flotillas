<?php

namespace App\Exports;

use App\Models\Operadore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
class ReporteIndividualExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final, string $operador)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->operador = $operador;
    }
    public function collection()
    {
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $operador = $this->operador;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Operadore::select(
                        'cliente',
                        'nombreoperador',
                        'nolicencia',
                        'fechavencimientolicencia',
                        'fechavencimientomedico',
                    )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::where('cliente', '=', $cli)
                            ->where('nombreoperador', '=', $operador)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Operadore::whereDate('fechavencimientolicencia', '<=', $final)
                        ->whereDate('fechavencimientomedico', '<=', $final)
                        ->select(
                            'cliente',
                            'nombreoperador',
                            'nolicencia',
                            'fechavencimientolicencia',
                            'fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::whereDate('fechavencimientolicencia', '<=', $final)
                            ->whereDate('fechavencimientomedico', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::whereDate('fechavencimientolicencia', '<=', $final)
                            ->whereDate('fechavencimientomedico', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->where('nombreoperador', '=', $operador)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Operadore::whereDate('fechavencimientolicencia', '>=', $inicio)
                        ->whereDate('fechavencimientomedico', '>=', $inicio)
                        ->select(
                            'cliente',
                            'nombreoperador',
                            'nolicencia',
                            'fechavencimientolicencia',
                            'fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::where('cliente', '=', $cli)
                            ->whereDate('fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('fechavencimientomedico', '>=', $inicio)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::where('cliente', '=', $cli)
                            ->where('nombreoperador', '=', $operador)
                            ->whereDate('fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('fechavencimientomedico', '>=', $inicio)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Operadore::whereDate('fechavencimientolicencia', '>=', $inicio)
                        ->whereDate('fechavencimientomedico', '>=', $inicio)
                        ->whereDate('fechavencimientolicencia', '<=', $final)
                        ->whereDate('fechavencimientomedico', '<=', $final)
                        ->select(
                            'cliente',
                            'nombreoperador',
                            'nolicencia',
                            'fechavencimientolicencia',
                            'fechavencimientomedico',
                        )->get();
                } else {
                    if ($operador == 'todos') {
                        return Operadore::whereDate('fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('fechavencimientomedico', '>=', $inicio)
                            ->whereDate('fechavencimientolicencia', '<=', $final)
                            ->whereDate('fechavencimientomedico', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
                            )->get();
                    } else {
                        return Operadore::whereDate('fechavencimientolicencia', '>=', $inicio)
                            ->whereDate('fechavencimientomedico', '>=', $inicio)
                            ->whereDate('fechavencimientolicencia', '<=', $final)
                            ->whereDate('fechavencimientomedico', '<=', $final)
                            ->where('cliente', '=', $cli)
                            ->where('nombreoperador', '=', $operador)
                            ->select(
                                'cliente',
                                'nombreoperador',
                                'nolicencia',
                                'fechavencimientolicencia',
                                'fechavencimientomedico',
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
            "NOMBRE OPERADOR", "NO. LICENCIA", "VENCIMIENTO LICENCIA", "VENCIMIENTO MEDICO"
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->applyFromArray(array(
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
