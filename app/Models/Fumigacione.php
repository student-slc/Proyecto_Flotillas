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
        "unidad",
        "numerofumigacion",
        "producto",
        "insectosvoladores",
        "pulgas",
        "aracnidos",
        "roedores",
        "insectosrastreros",
        "mosca",
        "hormigas",
        "alacranes",
        "cucaracha",
        "chinches",
        "termitas",
        "carcamo",
        "tipo",
        "observaciones",
        "proxima_fumigacion"
    ];
}
