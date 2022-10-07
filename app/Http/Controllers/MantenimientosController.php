<?php

namespace App\Http\Controllers;

use App\Http\Requests\MantenimientosRequest;
use App\Models\Mantenimiento;
use App\Models\Unidade;
use Illuminate\Http\Request;
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
        Mantenimiento::create($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["mantenimiento" => "Con Mantenimiento"]);
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
        $mantenimientos = Mantenimiento::where('id_unidad', '=', $unidad)->paginate(10);
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
        $mantenimiento->delete();
        return redirect()->route('mantenimientos.show', $unidad);
    }
}
