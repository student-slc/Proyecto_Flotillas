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
        'statuspago'
    ];
}
