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
    public function headings(): array
    {
        return [
            "ID CLIENTE","CLIENTE","RAZON SOCIAL CLIENTE",
            "NOMBRE OPERADOR", "NO. LICENCIA", "VENCIMIENTO LICENCIA", "VENCIMIENTO MEDICO"
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
