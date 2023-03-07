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
    /*permiso*/
    function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }
    // checar con middleware
    public function arranque()
    {
        $usuario = auth()->user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::where('cliente', '=', $clientes)->where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::where('cliente', '=', $clientes)->get();
        }
        return view('checklist.salida', compact('unidades', 'operadores', 'clientes', 'user'));
    }
    public function guardarSalida(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'eco' => 'required',
                'kmarranque' => 'required',
                'combustible' => 'required',
                'llantarefaccion' => 'required',
                'crucetaygato' => 'required',
                'lonas' => 'required',
                'cuerdas' => 'required',
                'extintor' => 'required',
                'banderin' => 'required',
            ]);
            Arranqueunidade::create( $request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
        return redirect()->route('home');
    }

    public function regreso()
    {
        $usuario = auth()->user();
        $rol = $usuario->rol;
        $user = $usuario->name;
        if ($rol == 'SuperAdministrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Administrador') {
            $clientes = Cliente::all();
            $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::all();
        }
        if ($rol == 'Usuario') {
            $clientes = $usuario->clientes;
            $unidades = Unidade::where('cliente', '=', $clientes)->where('tipo', '=', 'Unidad Vehicular')->get();
            $operadores = Operadore::where('cliente', '=', $clientes)->get();
        }
        return view('checklist.entrada', compact('unidades', 'operadores', 'clientes', 'user'));
    }
}
