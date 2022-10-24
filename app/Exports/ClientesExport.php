<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Cliente::select(
            'nombrecompleto',
            'razonsocial',
            'telefono',
            'direccionfisica',
            'correo',
            'colonia',
            'ciudad',
            'municipio',
            'estado',
            'codigopostal',
            'rfc',
            'numero',
            'observaciones',
            'statuspago',
        )->get();
    }
    public function headings(): array
    {
        return [
            "NOMBRE COMPLETO",
            "RAZON SOCIAL",
            "TELEFONO", "DIRECCION FISICA", "CORREO", "COLONIA", "CIUDAD", "MUNICIPIO",
            "ESTADO", "CODIGO POSTAL", "RFC", "NUMERO", "OBSERVACIONES", "ESTATUS DE PAGO"
        ];
    }
}
