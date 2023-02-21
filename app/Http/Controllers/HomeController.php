<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Operadore;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = \Auth::user();
        $rol = $usuario->rol;
        $cliente = $usuario->clientes;
        if ($rol == 'SuperAdministrador') {
            $operadores = Operadore::all();
            $unidades = Unidade::all();
            $unidadesk = Unidade::where('tipomantenimiento', '=', 'Kilometraje')->get();
            $unidadest = Unidade::where('tipomantenimiento', '=', 'Fecha')->get();
        }
        if ($rol == 'Administrador') {
            $operadores = Operadore::all();
            $unidades = Unidade::all();
            $unidadesk = Unidade::where('tipomantenimiento', '=', 'Kilometraje')->get();
            $unidadest = Unidade::where('tipomantenimiento', '=', 'Fecha')->get();
        }
        if ($rol == 'Usuario') {
            $operadores = Operadore::where('cliente', '=', $cliente)->get();
            $unidades = Unidade::where('cliente', '=', $cliente)->get();
            $unidadesk = Unidade::where('tipomantenimiento', '=', 'Kilometraje')
                ->where('cliente', '=', $cliente)
                ->get();
            $unidadest = Unidade::where('tipomantenimiento', '=', 'Fecha')
                ->where('cliente', '=', $cliente)
                ->get();
        }
        return view('home', compact('operadores', 'unidades', 'unidadesk', 'unidadest'));
    }
}
