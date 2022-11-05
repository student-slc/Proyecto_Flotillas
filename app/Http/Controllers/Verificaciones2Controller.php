<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerificacionesRequest;
use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VerificacionesExport;

class Verificaciones2Controller extends Controller
{
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
        return view('verificaciones2.crear', compact('unidad'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VerificacionesRequest $request)
    {
        $unidad = $request->id_unidad;
        if ($request->validated()) {
            $cambio = Verificacione::where('id_unidad', '=', $unidad)
                ->where('tipoverificacion', '=', "Fisica")
                ->update(["estado" => "Inactivo"]);
        }
        Verificacione::create($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion2" => $request->get('noverificacion')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion_fecha2" => $request->get('fechavencimiento')]);
        return redirect()->route('verificacionesfisicomecanicas.show', $unidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $verificaciones = Verificacione::where('id_unidad', '=', $unidad)
            ->where('tipoverificacion', '=', "Fisica")->get();
        return view('verificaciones2.index', compact('verificaciones', 'unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Verificacione $verificacionesfisicomecanica)
    {
        return view('verificaciones2.editar', compact('verificacionesfisicomecanica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VerificacionesRequest $request, Verificacione $verificacionesfisicomecanica)
    {
        $unidad = $verificacionesfisicomecanica->id_unidad;
        $verificacionesfisicomecanica->update($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion2" => $request->get('noverificacion')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion_fecha2" => $request->get('fechavencimiento')]);
        return redirect()->route('verificacionesfisicomecanicas.show', $unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verificacione $verificacionesfisicomecanica)
    {
        $unidad = $verificacionesfisicomecanica->id_unidad;
        $verificacion = $verificacionesfisicomecanica->noverificacion;
        $verificacionesfisicomecanica->delete();
        $cambio = Unidade::where('verificacion2', '=', $verificacion)->update(["verificacion2" => "Sin Verificación"]);
        $cambio = Unidade::where('verificacion2', '=', $verificacion)->update(["verificacion_fecha2" => "Sin Fecha"]);
        return redirect()->route('verificacionesfisicomecanicas.show', $unidad);
    }
    public function export($unidad)
    {
        return (new VerificacionesExport($unidad))->download('Verificaciones_unidad_' . $unidad . '.xlsx');
    }
}
