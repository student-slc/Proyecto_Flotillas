<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verificacione extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_unidad',
        'fechavencimiento',
        'tipoverificacion',
        'subtipoverificacion',
        'ultimaverificacion',
        'caratulaverificacion',
    ];
}
