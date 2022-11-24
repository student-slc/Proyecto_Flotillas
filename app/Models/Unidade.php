<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;
    protected $fillable = [
        'serieunidad',
        'marca',
        'submarca',
        'añounidad',
        'tipounidad',
        'razonsocialunidad',
        'placas',
        'status',
        'seguro',
        'mantenimiento',
        'verificacion',
        'verificacion2',
        'cliente',
        'seguro_fecha',
        'mantenimiento_fecha',
        'verificacion_fecha',
        'verificacion_fecha2',
        'tipo',
        'direccion',
        'calle',
        'ciudad',
        'responsable',
        'cp',
        'lapsofumigacion',
        'fumigacion',
        'tipomantenimiento',
        'frecuencia_mante',
        'frecuencia_fumiga',
    ];
}
