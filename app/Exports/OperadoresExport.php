<?php

namespace App\Exports;

use App\Models\Operadore;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperadoresExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $usuario)
    {
        $this->usuario = $usuario;
    }

    public function query()
    {
        return Operadore::query()->where('cliente', '=', $this->usuario)->select(
            "nombreoperador",
            "fechanacimiento",
            "nolicencia",
            "tipolicencia",
            "fechavencimientomedico",
            "fechavencimientolicencia",
        );
        /* ::query()->where('id_unidad','=', $this->unidad)->get(); */
    }
    public function headings(): array
    {
        return [
            "NOMBRE DEL OPERADOR",
            "FECHA DE NACIMIENTO",
            "NO LICENCIA", "TIPO DE LICENCIA", "FECHA VENCIMIENTO MEDICO",
            "FECHA VENCIMIENTO LICENCIA"
        ];
    }
}
