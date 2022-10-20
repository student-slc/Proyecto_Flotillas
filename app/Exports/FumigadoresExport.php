<?php

namespace App\Exports;

use App\Models\Fumigadore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FumigadoresExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Fumigadore::select(
            'nombrecompleto',
            'fechanacimiento',
            'certificacion',
        )->get();
    }
    public function headings(): array
    {
        return [
            "NOMBRE FUMIGADOR",
            "FECHA DE NACIMIENTO",
            "CERTIFICACIÓN"
        ];
    }
}
