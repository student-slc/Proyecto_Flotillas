<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Mantenimiento;
use App\Models\Operadore;
use App\Models\Seguro;
use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientesExport;
use App\Imports\ClientesImport;


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($usuario)
    {
        /* ESTE CODIGO ES PARA QUE FUNCIONE EL REGRESO DE SEGUROS, VERIFICACIONES Y MANTENIMIENTO */
        $uni = Unidade::all();
        foreach ($uni as $unis) {
            if ($unis->serieunidad == $usuario) {
                $usuario = $unis->cliente;
            }
        }
        $unidades = Unidade::where('cliente', '=', $usuario)->get();
        return view('unidades.index', compact('unidades', 'usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $usuario = $cliente->nombrecompleto;
        $cliente->update($request->validated());
        $cambio = Operadore::where('cliente', '=', $usuario)->update(["cliente" => $request->nombrecompleto]);
        $cambio = Unidade::where('cliente', '=', $usuario)->update(["cliente" => $request->nombrecompleto]);
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $usuario = $cliente->nombrecompleto;
        $cliente->delete();
        $unidades = Unidade::where('cliente', '=', $usuario)->get();
        foreach ($unidades as $unidad) {
            $cambio = Seguro::where('id_unidad', '=', $unidad->serieunidad)->delete();
            $cambio = Verificacione::where('id_unidad', '=', $unidad->serieunidad)->delete();
            $cambio = Mantenimiento::where('id_unidad', '=', $unidad->serieunidad)->delete();
        }
        $cambio = Operadore::where('cliente', '=', $usuario)->delete();
        $cambio = Unidade::where('cliente', '=', $usuario)->delete();
        return redirect()->route('clientes.index');
    }
    public function export()
    {
        return Excel::download(new ClientesExport, 'Clientes.xlsx');
    }
    /* public function import()
    {
        Excel::import(new ClientesImport,request()->file('file'));
        return back();
    } */
}
