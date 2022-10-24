<?php

namespace App\Exports;

use App\Models\Fumigacione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FumigacionesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Fumigacione::select(
            'id_cliente',
            'id_fumigador',
            'fechaprogramada',
            'fechaultimafumigacion',
            'lugardelservicio',
            'numerodevisitas',
            'costo',
            'status',
            'satisfaccionservicio'
        )->get();
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "FUMIGADOR",
            "FECHA PROGRAMADA", "FECHA DE ULTIMA FUMIGACION", "LUGAR DEL SERVICIO",
            "NUMERO DE VISITAS", "COSTO", "ESTADO",
            "SATISFACCIÓ DEL SERVICIO"
        ];
    }
}
