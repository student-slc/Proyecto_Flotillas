<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ReposteSegurosExport implements FromQuery, WithHeadings
{
   /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function query()
    {
        return Unidade::query()->where('tipo', '=', 'Unidad Vehicular')->select(
            'cliente',
            'marca',
            'serieunidad',
            'añounidad',
            'placas',
            'tipounidad',
            'razonsocialunidad',
            'seguro_fecha'
        );
    }
    public function headings(): array
    {
        return ["CLIENTE",
            "MARCA",
            "SERIE UNIDAD","AÑO UNIDAD",
            "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD","FECHA VENCIMIENTO SEGURO"
        ];
    }
}
