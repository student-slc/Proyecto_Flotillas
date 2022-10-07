<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
    protected $fillable=[
        "id_unidad",
        "kmfinales",
        "fecha",
        "frecuencia",
        "sigservicio",
        "kmfaltantes",
        "tipomantenimiento"
    ];
}
