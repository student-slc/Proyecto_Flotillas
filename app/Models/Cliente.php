<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombrecompleto',
        'razonsocial',
        'telefono',
        'nombrecompletoc',
        'telefonoc',
        'direccionfisica',
        'correo',
        'statuspago',

        'colonia',
        'ciudad',
        'municipio',
        'estado',
        'codigopostal',
        'rfc',
        'numero',
        'observaciones',
        'regimen_fiscal',
        'sfdi',
        'servicio_seguro',
        'servicio_ambiental',
        'servicio_fisica',
        'servicio_mantenimiento',
        'servicio_fumigacion',
    ];
}
