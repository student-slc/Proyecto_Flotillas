<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fumigacione extends Model
{
    use HasFactory;
    protected $fillable=[
        "id_fumigador",
        "fechaprogramada",
        "fechaultimafumigacion",
        "lugardelservicio",
        "status",
        "numerodevisitas",
        "costo",
        "satisfaccionservicio",
        "unidad",
        "numerofumigacion",
    ];
}
