<?php

namespace App\Exports;

use App\Models\Mantenimiento;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MantenimientosExport implements FromQuery, WithHeadings
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
        return Mantenimiento::query()->where('id_unidad', '=', $this->unidad)->select(
            'nomantenimiento',
            "id_unidad",
            "kmfinales",
            "fecha",
            "frecuencia",
            "sigservicio",
            "kmfaltantes",
            "tipomantenimiento",
            'estado',
        );
        /* ::query()->where('id_unidad','=', $this->unidad)->get(); */
    }
    public function headings(): array
    {
        return [
            "IDENTIFICACOR",
            "UNIDAD",
            "KM FINALES", "FECHA", "FRECUENCIA",
            "SIG SERVICIO", "KM FALTANTES", "TIPO DE MANTENIMIENTO",
            "ESTADO"
        ];
    }
}
