<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\Unidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Verificacione;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteIndividualVExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(string $cli, string $inicio, string $final, string $unidad)
    {
        $this->cli = $cli;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->unidad = $unidad;
    }
    public function collection()
    {
        /* whereDate('created_at','<=', '2021-01-17') */
        $cli = $this->cli;
        $inicio = $this->inicio;
        $final = $this->final;
        $unidad = $this->unidad;
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'unidades.tipounidad',
                            'unidades.serieunidad',
                            'unidades.verificacion',
                            'unidades.verificacion_fecha',
                            'unidades.verificacion2',
                            'unidades.verificacion_fecha2',
                            'unidades.seguro',
                            'unidades.seguro_fecha',
                            'unidades.fumigacion',
                            'unidades.lapsofumigacion',
                            'unidades.frecuencia_fumiga',
                            'unidades.mantenimiento',
                            'unidades.mantenimiento_fecha',
                            'unidades.frecuencia_mante',
                            'unidades.tipomantenimiento',
                            'unidades.marca',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.digitoplaca',
                            'unidades.kilometros_contador',
                            'unidades.razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.verificacion_fecha', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.verificacion_fecha2', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.seguro_fecha', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.lapsofumigacion', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final) {
                                $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                    ->orWhere(
                                        function ($q) use ($final) {
                                            return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final);
                                        }
                                    );
                            }
                        )
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'unidades.tipounidad',
                            'unidades.serieunidad',
                            'unidades.verificacion',
                            'unidades.verificacion_fecha',
                            'unidades.verificacion2',
                            'unidades.verificacion_fecha2',
                            'unidades.seguro',
                            'unidades.seguro_fecha',
                            'unidades.fumigacion',
                            'unidades.lapsofumigacion',
                            'unidades.frecuencia_fumiga',
                            'unidades.mantenimiento',
                            'unidades.mantenimiento_fecha',
                            'unidades.frecuencia_mante',
                            'unidades.tipomantenimiento',
                            'unidades.marca',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.digitoplaca',
                            'unidades.kilometros_contador',
                            'unidades.razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final);
                                            }
                                        );
                                }
                            )
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($inicio) {
                                $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                    ->orWhere(
                                        function ($q) use ($inicio) {
                                            return $q->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'unidades.tipounidad',
                            'unidades.serieunidad',
                            'unidades.verificacion',
                            'unidades.verificacion_fecha',
                            'unidades.verificacion2',
                            'unidades.verificacion_fecha2',
                            'unidades.seguro',
                            'unidades.seguro_fecha',
                            'unidades.fumigacion',
                            'unidades.lapsofumigacion',
                            'unidades.frecuencia_fumiga',
                            'unidades.mantenimiento',
                            'unidades.mantenimiento_fecha',
                            'unidades.frecuencia_mante',
                            'unidades.tipomantenimiento',
                            'unidades.marca',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.digitoplaca',
                            'unidades.kilometros_contador',
                            'unidades.razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                        ->where('unidades.tipo', '=', 'Unidad Vehicular')
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha', '<=', $final)->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.verificacion_fecha2', '<=', $final)->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.seguro_fecha', '<=', $final)->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.lapsofumigacion', '<=', $final)->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->where(
                            function ($query) use ($final, $inicio) {
                                $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                    ->orWhere(
                                        function ($q) use ($final, $inicio) {
                                            return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final)->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                        }
                                    );
                            }
                        )
                        ->select(
                            'clientes.id',
                            'clientes.nombrecompleto',
                            'clientes.razonsocial',
                            'unidades.tipounidad',
                            'unidades.serieunidad',
                            'unidades.verificacion',
                            'unidades.verificacion_fecha',
                            'unidades.verificacion2',
                            'unidades.verificacion_fecha2',
                            'unidades.seguro',
                            'unidades.seguro_fecha',
                            'unidades.fumigacion',
                            'unidades.lapsofumigacion',
                            'unidades.frecuencia_fumiga',
                            'unidades.mantenimiento',
                            'unidades.mantenimiento_fecha',
                            'unidades.frecuencia_mante',
                            'unidades.tipomantenimiento',
                            'unidades.marca',
                            'unidades.añounidad',
                            'unidades.placas',
                            'unidades.digitoplaca',
                            'unidades.kilometros_contador',
                            'unidades.razonsocialunidad',
                        )->get();
                } else {
                    if ($unidad == 'todos') {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final)->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final)->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final)->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final)->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final)->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    } else {
                        return Unidade::join('clientes', 'clientes.nombrecompleto', '=', 'unidades.cliente')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->where('fumigaciones.unidad', '=', $unidad)
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha', '<=', $final)->whereDate('unidades.verificacion_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.verificacion_fecha2', '=', 'Sin Fecha de Verificación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.verificacion_fecha2', '<=', $final)->whereDate('unidades.verificacion_fecha2', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.seguro_fecha', '=', 'Sin Fecha de Seguro')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.seguro_fecha', '<=', $final)->whereDate('unidades.seguro_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.lapsofumigacion', '=', 'Sin Fecha de Fumigación')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.lapsofumigacion', '<=', $final)->whereDate('unidades.lapsofumigacion', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->where(
                                function ($query) use ($final, $inicio) {
                                    $query->where('unidades.mantenimiento_fecha', '=', 'Sin Fecha de Mantenimiento')
                                        ->orWhere(
                                            function ($q) use ($final, $inicio) {
                                                return $q->whereDate('unidades.mantenimiento_fecha', '<=', $final)->whereDate('unidades.mantenimiento_fecha', '>=', $inicio);
                                            }
                                        );
                                }
                            )
                            ->select(
                                'clientes.id',
                                'clientes.nombrecompleto',
                                'clientes.razonsocial',
                                'unidades.tipounidad',
                                'unidades.serieunidad',
                                'unidades.verificacion',
                                'unidades.verificacion_fecha',
                                'unidades.verificacion2',
                                'unidades.verificacion_fecha2',
                                'unidades.seguro',
                                'unidades.seguro_fecha',
                                'unidades.fumigacion',
                                'unidades.lapsofumigacion',
                                'unidades.frecuencia_fumiga',
                                'unidades.mantenimiento',
                                'unidades.mantenimiento_fecha',
                                'unidades.frecuencia_mante',
                                'unidades.tipomantenimiento',
                                'unidades.marca',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.digitoplaca',
                                'unidades.kilometros_contador',
                                'unidades.razonsocialunidad',
                            )->get();
                    }
                }
            }
        }
    }
    public function headings(): array
    {
        return [
            "ID CLIENTE",
            "CLIENTE",
            "RAZON SOCIAL CLIENTE",
            "TIPO DE UNIDAD",
            "SERIE UNIDAD",
            "VERIFICACIÓN FISICO-MECANICA",
            "FECHA VERIFICACIÓN",
            "VERIFICACIÓN AMBIENTAL",
            "FECHA VERIFICACIÓN",
            "SEGURO",
            "FECHA SEGURO",
            "FUMIGACIÓN",
            "FECHA FUMIGACIÓN",
            "FRECUENCIA DE FUMIGACIÓN",
            "MANTENIMIENTO",
            "FEHA MANTENIMIENTO",
            "FRECUENCIA DE MANTENIMIENTO",
            "TIPO DE MANTENIMIENTO",
            "MARCA",
            "AÑO UNIDAD",
            "PLACAS",
            "DIGITO PLACA",
            "KILOMETRAJE",
            "RAZON SOCIAL UNIDAD",
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:X1')->applyFromArray(array(
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'color' => array('rgb' => '9dbad5')
            )
        ));
        return [


            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
