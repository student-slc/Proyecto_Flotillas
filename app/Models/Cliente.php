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
        'observaciones'
    ];
}
