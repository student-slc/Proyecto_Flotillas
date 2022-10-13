<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;
    protected $fillable=[
        'nopoliza',
        'id_unidad',
        'fechavencimiento',
        'fechainicio',
        'tiposeguro',
        'caratulaseguro',
        'provedor',
        'precio',
        'impuestos',
        'costototal',
        'estado',
    ];
}
