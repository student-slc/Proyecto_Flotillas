<?php

namespace App\Exports;

use App\Models\Verificacione;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VerificacionesExport implements FromQuery, WithHeadings
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
        return Verificacione::query()->where('id_unidad', '=', $this->unidad)->select(
            'noverificacion',
            'fechavencimiento',
            'tipoverificacion',
            'subtipoverificacion',
            'ultimaverificacion',
            'caratulaverificacion',
            'estado',
        );
        /* ::query()->where('id_unidad','=', $this->unidad)->get(); */
    }
    public function headings(): array
    {
        return [
            'NO VERIFICACION',
            'FECHA DE VENCIMIENTO',
            'TIPO DE VERIFICACION',
            'SUB TIPO DE VERIFICACION',
            'ULTIMA VERIFICACION',
            'CARATULA',
            'ESTADO',
        ];
    }
}
