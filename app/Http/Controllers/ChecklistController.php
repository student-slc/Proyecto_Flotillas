<?php

namespace App\Http\Controllers;

use App\Models\Arranqueunidade;
use App\Models\Cliente;
use App\Models\Operadore;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }
    public function arranque()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user=$usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes=Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Administrador') {
            $clientes=Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Usuario'){
            $clientes=$usuario->clientes;
            $unidades = Unidade::where('cliente', '=', $clientes)->where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::where('cliente', '=', $clientes)->get();
        }
        return view('checklist.salida', compact('unidades','operadores','clientes','user'));
    }
    public function guardarsalida()
    {
        Arranqueunidade::beginTransaction();
        try {
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
            Arranqueunidade::commit();
            return $arranque;
        } catch (\Exception $e) {
            Arranqueunidade::rollback();
            return $e->getMessage();
        }

        /*  return view('checklist.salida'); */
    }
    public function regreso()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $user=$usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes=Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Administrador') {
            $clientes=Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Usuario'){
            $clientes=$usuario->clientes;
            $unidades = Unidade::where('cliente', '=', $clientes)->where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::where('cliente', '=', $clientes)->get();
        }
        return view('checklist.entrada', compact('unidades','operadores','clientes','user'));
    }
}
