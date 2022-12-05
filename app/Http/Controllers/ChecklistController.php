<?php

namespace App\Http\Controllers;

use App\Models\Arranqueunidade;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function arranque()
    {
        return view('checklist.salida');
    }
    public function guardarsalida()
    {
        $data = ['respuestas' => [
            'id_operador' => 12,
            'id_unidad' => 12,
            'id_cliente' => 12,
            'eco' => 12,
            'kmarranque' => 12,
            'combustible' => 12,
            'llantarefaccion' => 12,
            'crucetaygato' => 12,
            'lonas' => 12,
            'cuerdas' => 12,
            'extintor' => 12,
            'banderin' => 12,
            'fotoreporte' => 12,
            'fecha' => 12,
            'hora' => 12,
            'status' => 12,
        ]];
        $prb = response()->json($data, 200)->getContent();
        $arranque = new Arranqueunidade();
        $arranque->respuestas = $prb;
        $arranque->id_operador = 123;
        $arranque->id_unidad = 123;
        $arranque->id_cliente = 123;
        $arranque->eco = 123;
        $arranque->kmarranque = 123;
        $arranque->combustible = 123;
        $arranque->llantarefaccion = 123;
        $arranque->crucetaygato = 123;
        $arranque->lonas = 123;
        $arranque->cuerdas = 123;
        $arranque->extintor = 123;
        $arranque->banderin = 123;
        $arranque->fotoreporte = 123;
        $arranque->fecha = 123;
        $arranque->hora = 123;
        $arranque->status = 123;
        $arranque->save();
        return $arranque;
        /*  return view('checklist.salida'); */
    }
    public function regreso()
    {
        return view('checklist.entrada');
    }
}
