<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Unidade;
use App\Models\Verificacione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteFlotillasExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $tipo)
    {
        $this->tipo = $tipo;
    }
    public function collection()
    {
        $tipo = $this->tipo;
        if ($tipo == 'Ambiental') {
            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                ->select(
                    'unidades.cliente',
                    'verificaciones.tipoverificacion',
                    'verificaciones.subtipoverificacion',
                    'verificaciones.ultimaverificacion',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                )->get();
        }
        if ($tipo == 'Fisica') {
            return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                ->select(
                    'unidades.cliente',
                    'verificaciones.tipoverificacion',
                    'verificaciones.subtipoverificacion',
                    'verificaciones.ultimaverificacion',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                )->get();
        }
        if ($tipo == 'Ambas') {
            return Unidade::join('verificaciones',
                function ($join) {
                    $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                }
            )
                ->where('unidades.tipo', '=', 'Unidad Vehicular')
                ->select(
                    'unidades.cliente',
                    'verificaciones.tipoverificacion',
                    'verificaciones.subtipoverificacion',
                    'verificaciones.ultimaverificacion',
                    'unidades.marca',
                    'unidades.serieunidad',
                    'unidades.añounidad',
                    'unidades.placas',
                    'unidades.tipounidad',
                    'unidades.razonsocialunidad',
                    'unidades.digitoplaca',
                )->get();
        }
    }
    public function headings(): array
    {
        return [
            "CLIENTE",
            "TIPO VERIFICACION",
            "SUB TIPO VERIFICACION", "ULTIMA VERIFICACION",
            "MARCA", "SERIE UNIDAD", "AÑO UNIDAD", "PLACAS", "TIPO UNIDAD", "RAZON SOCIAL UNIDAD", "DIGITO PLACA"
        ];
    }
}
