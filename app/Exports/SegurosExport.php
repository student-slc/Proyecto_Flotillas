<?php

namespace App\Exports;

use App\Models\Seguro;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SegurosExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $unidad)
    {
        $this->unidad = $unidad;
    }

    public function query()
    {
        return Seguro::query()->where('id_unidad', '=', $this->unidad)->select(
            'nopoliza',
            'fechainicio',
            'fechavencimiento',
            'tiposeguro',
            'caratulaseguro',
            'provedor',
            'precio',
            'impuestos',
            'costototal',
            'estado',
        );
        /* ::query()->where('id_unidad','=', $this->unidad)->get(); */
    }
    public function headings(): array
    {
        return [
            'NO POLIZA',
            'FECHA DE INICIO',
            'FECHA DE VENCIMIENTO',
            'TIPO DE SEGURO',
            'CARATULA',
            'PROVEEDOR',
            'PRECIO',
            'IMPUESTOS',
            'COSTO TOTAL',
            'ESTADO',
        ];
    }
}
