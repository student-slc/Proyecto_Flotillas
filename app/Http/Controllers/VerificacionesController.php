<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerificacionesRequest;
use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VerificacionesExport;
use App\Models\Folio;

class VerificacionesController extends Controller
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
        $folios = Folio::where('tipo', '=', 'Ambiental')->get();
        return view('verificaciones.crear', compact('unidad', 'folios'));
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
        $folio_actual = $request->noverificacion;
        $folios = Folio::where('id', '=', $folio_actual)->get();
        foreach ($folios as $folio) {
            $contador = $folio->contador;
            $string = $folio->folio;
            $inicio = preg_replace('/[^0-9]/', '', $string);
            $string_2 = $folio->rango;
            $final = preg_replace('/[^0-9]/', '', $string_2);
            $fin = (int) $final;
        }
        $request->merge(['noverificacion' => '' . (int) $inicio + (int) $folio->contador]);
        if ($request->validated()) {
            $cambio = Verificacione::where('id_unidad', '=', $unidad)->update(["estado" => "Inactivo"]);
        }
        Verificacione::create($request->all());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion" => $request->get('noverificacion')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion_fecha" => $request->get('fechavencimiento')]);
        $cambio = Folio::where('id', '=', $folio_actual)->update(["contador" => $contador + 1]);
        return redirect()->route('verificaciones.show', $unidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $verificaciones = Verificacione::where('id_unidad', '=', $unidad)->where('tipoverificacion', '=', "Ambiental")->get();
        return view('verificaciones.index', compact('verificaciones', 'unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Verificacione $verificacione)
    {
        return view('verificaciones.editar', compact('verificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VerificacionesRequest $request, Verificacione $verificacione)
    {
        $unidad = $verificacione->id_unidad;
        $verificacione->update($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion" => $request->get('noverificacion')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["verificacion_fecha" => $request->get('fechavencimiento')]);
        return redirect()->route('verificaciones.show', $unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verificacione $verificacione)
    {
        $unidad = $verificacione->id_unidad;
        $verificacion = $verificacione->noverificacion;
        $verificacione->delete();
        $cambio = Unidade::where('verificacion', '=', $verificacion)->update(["verificacion" => "Sin Verificación"]);
        $cambio = Unidade::where('verificacion', '=', $verificacion)->update(["verificacion_fecha" => "Sin Fecha"]);
        return redirect()->route('verificaciones.show', $unidad);
    }
    public function export($unidad)
    {
        return (new VerificacionesExport($unidad))->download('Verificaciones_unidad_' . $unidad . '.xlsx');
    }
}
