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
        'cliente',
        'operador'
    ];
}
