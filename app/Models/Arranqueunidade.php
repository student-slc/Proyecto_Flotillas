<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arranqueunidade extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_cliente',
        'id_operador',
        'id_unidad',
        'eco',
        'kmarranque',
        'combustible',
        'llantarefaccion',
        'crucetaygato',
        'lonas',
        'cuerdas',
        'exterior',
        'banderin',
        'firma',
        'fotoreporte',
        'fecha',
        'hora',
        'respuestas',
        'status',
    ];
}
