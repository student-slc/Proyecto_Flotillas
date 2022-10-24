<?php

namespace App\Exports;

use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnidadesExport implements FromQuery, WithHeadings
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
        return Unidade::query()->where('cliente', '=', $this->usuario)->select(
            "serieunidad",
            "marca",
            "submarca",
            "añounidad",
            "tipounidad",
            "razonsocialunidad",
            "placas",
            "seguro_fecha",
            "verificacion_fecha",
            "mantenimiento_fecha",
            "status",
        );
        /* ::query()->where('id_unidad','=', $this->unidad)->get(); */
    }
    public function headings(): array
    {
        return [
            "SERIE UNIDAD",
            "MARCA",
            "SUBMARCA", "AÑO DE UNIDAD", "TIPOUNIDAD",
            "RAZON SOCIAL UNIDAD","PLACAS","VENCIMIENTO DE SEGURO",
            "VENCIMIENTO DE VERIFICACION", "VENCIMIENTO DE MANTENIMIENTO",
            "STATUS"
        ];
    }
}
