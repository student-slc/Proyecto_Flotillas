<?php

namespace App\Http\Controllers;

use App\Http\Requests\MantenimientosRequest;
use App\Models\Mantenimiento;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MantenimientosExport;

class MantenimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function crear($unidad)
    {
        return view('mantenimientos.crear', compact('unidad'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MantenimientosRequest $request)
    {
        $unidad = $request->id_unidad;
        if ($request->validated()) {
            $cambio = Mantenimiento::where('id_unidad', '=', $unidad)->update(["estado" => "Inactivo"]);
        }
        Mantenimiento::create($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["mantenimiento" => $request->get('nomantenimiento')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["mantenimiento_fecha" => $request->get('fecha')]);
        return redirect()->route('mantenimientos.show', $unidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $mantenimientos = Mantenimiento::where('id_unidad', '=', $unidad)->get();
        return view('mantenimientos.index', compact('mantenimientos', 'unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.editar', compact('mantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MantenimientosRequest $request, Mantenimiento $mantenimiento)
    {
        $unidad = $mantenimiento->id_unidad;
        $mantenimiento->update($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["mantenimiento" => $request->get('nomantenimiento')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["mantenimiento_fecha" => $request->get('fecha')]);
        return redirect()->route('mantenimientos.show', $unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        $unidad = $mantenimiento->id_unidad;
        $mantenimientos = $mantenimiento->nomantenimiento;
        $mantenimiento->delete();
        $cambio = Unidade::where('mantenimiento', '=', $mantenimientos)->update(["mantenimiento" => "Sin Mantenimiento"]);
        $cambio = Unidade::where('mantenimiento', '=', $mantenimientos)->update(["mantenimiento_fecha" => "Sin Fecha"]);
        return redirect()->route('mantenimientos.show', $unidad);
    }
    public function export($unidad)
    {
        return (new MantenimientosExport($unidad))->download('Mantenimientos_unidad_'.$unidad.'.xlsx');
    }
}
