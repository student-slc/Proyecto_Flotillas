<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadesRequest;
use App\Models\Mantenimiento;
use App\Models\Seguro;
use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnidadesExport;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* //TODO Operadores_reponer */
        //Con paginación
        /* $unidades = Unidade::get(;
        return view('unidades.index', compact('unidades')); */
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* return view('unidades.crear'); */
    }
    public function crear($usuario)
    {
        return view('unidades.crear', compact('usuario'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadesRequest $request)
    {
        $usuario = $request->cliente;
        Unidade::create($request->validated());
        return redirect()->route('clientes.show', $usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $seguros = Seguro::where('id_unidad', '=', $unidad)->get();
        return view('seguros.index', compact('seguros', 'unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidade $unidade)
    {
        return view('unidades.editar', compact('unidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadesRequest $request, Unidade $unidade)
    {
        $usuario = $unidade->cliente;
        $unidad = $unidade->serieunidad;
        $unidade->update($request->validated());
        $cambio = Verificacione::where('id_unidad', '=', $unidad)->update(["id_unidad" => $request->serieunidad]);
        $cambio = Seguro::where('id_unidad', '=', $unidad)->update(["id_unidad" => $request->serieunidad]);
        $cambio = Mantenimiento::where('id_unidad', '=', $unidad)->update(["id_unidad" => $request->serieunidad]);
        return redirect()->route('clientes.show', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        $usuario = $unidade->cliente;
        $unidad = $unidade->serieunidad;
        $unidade->delete();
        $cambio = Seguro::where('id_unidad', '=', $unidad)->delete();
        $cambio = Verificacione::where('id_unidad', '=', $unidad)->delete();
        $cambio = Mantenimiento::where('id_unidad', '=', $unidad)->delete();
        return redirect()->route('clientes.show', $usuario);
    }
    public function export($usuario)
    {
        return (new UnidadesExport($usuario))->download('Unidades_del_usuario_'.$usuario.'.xlsx');
    }
}