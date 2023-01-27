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
        $verificacion=Verificacione::where('id_unidad','=',$unidad)
        ->where('estado','=','Activo')->get();
        foreach ($verificacion as $veri) {
            $ultima=$veri->ultimaverificacion;
        }
        return view('verificaciones.crear', compact('unidad', 'folios','ultima'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unidad = $request->id_unidad;
        $folio_actual = $request->noverificacion;
        $folios = Folio::where('id', '=', $folio_actual)->get();
        $ruta = "img/evidencia/verificaciones_ambientales";
        if (is_dir($ruta)) {
        } else {
            $ruta = "img/evidencia/verificaciones_ambientales";
            \File::makeDirectory($ruta, 0775, true);
        }
        foreach ($folios as $folio) {
            $contador = $folio->contador;
            $string = $folio->folio;
            $inicio = preg_replace('/[^0-9]/', '', $string);
            $fin = (int) $inicio + (int) $contador;
        }
        $request->merge(['noverificacion' => '' . $fin]);
        //------------------------------------------------ ARCHIVO ------------------------------------------------
        $caratula = 'sin evidencia';
        if ($request->hasfile('caratulaverificacion')) {
            $file = $request->file('caratulaverificacion');
            $destino = 'img/evidencia/verificaciones_ambientales/';
            $filename =  $fin . '_' . str_replace(' ', '_', $unidad) . '_' . $file->getClientOriginalName();
            $cargar = $request->file('caratulaverificacion')->move($destino, $filename);
            $caratula =  $destino . $filename;
        }
        /* ======================================================== */
        $validacion =request()->validate([
            "noverificacion" => 'required',
            "id_unidad" => 'required',
            "fechavencimiento" => 'required',
            "tipoverificacion" => 'required',
            "subtipoverificacion" => 'required',
            "ultimaverificacion" => 'required',
            "estado" => 'required',
        ]);
        if ($validacion) {
            $cambio = Verificacione::where('id_unidad', '=', $unidad)->update(["estado" => "Inactivo"]);
        }
        Verificacione::create(
            [
                'noverificacion' => $request['noverificacion'],
                'id_unidad' => $request['id_unidad'],
                'fechavencimiento' => $request['fechavencimiento'],
                'tipoverificacion' => $request['tipoverificacion'],
                'subtipoverificacion' => $request['subtipoverificacion'],
                'ultimaverificacion' => $request['ultimaverificacion'],
                'estado' => $request['estado'],
                'caratulaverificacion' => $caratula,
            ]
        );
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
