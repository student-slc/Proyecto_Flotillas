<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operadore extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombreoperador",
        "fechanacimiento",
        "nolicencia",
        "tipolicencia",
        "fechavencimientomedico",
        "fechavencimientolicencia",
        "cliente",
        "licencia",
        "curso",
        "examenmedico",
    ];
}
