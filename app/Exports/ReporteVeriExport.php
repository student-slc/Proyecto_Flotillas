<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ReporteVeriExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli)
    {
        $this->cli = $cli;
    }
    public function collection()
    {
        $cli = $this->cli;
        if ($cli == 'todos') {
            return Unidade::where('tipo', '=', 'Unidad Vehicular')
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
        }
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD",
        ];
    }
}
