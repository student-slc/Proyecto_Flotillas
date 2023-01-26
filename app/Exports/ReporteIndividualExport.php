<?php

namespace App\Exports;

use App\Models\Operadore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteIndividualExport implements FromCollection, WithHeadings
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
                    return Operadore::select(
                        'cliente',
                        'nombreoperador',
                        'nolicencia',
                        'fechavencimientolicencia',
                        'fechavencimientomedico',
                    )->get();
                } else {
                    return Operadore::where('cliente', '=', $cli)
                        ->select(
                            'cliente',
                            'nombreoperador',
                            'nolicencia',
                            'fechavencimientolicencia',
                            'fechavencimientomedico',
                        )->get();
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
}
