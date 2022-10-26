<?php

namespace App\Http\Controllers;

use App\Http\Requests\SegurosRequest;
use App\Models\Seguro;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SegurosExport;

class SegurosController extends Controller
{
    public function index()
    {
        //Con paginación
        /* $seguros = Cliente::paginate(5);
         return view('clientes.index',compact('clientes')); */
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* return view('seguros.crear'); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacion = request()->validate([
            'id_unidad' => 'required',
            'estado' => 'required',
            'nopoliza' => 'required',
            'fechainicio' => 'required',
            'fechavencimiento' => 'required',
            'tiposeguro' => 'required',
            'provedor' => 'required',
            'precio' => 'required',
            'impuestos' => 'required',
            'costototal' => 'required',
            'caratulaseguro' => 'required',
        ]);
        /* CARGAR DOCUMENTOS */
        $caratula = 'sin evidencia';
        $ruta = "img/evidencia_seguros";
        if (is_dir($ruta)) {
        } else {
            $ruta = "img/evidencia_seguros";
            \File::makeDirectory($ruta, 0775, true);
        }
        //------------------------------------------------ EVIDENCIA_CARATULA ------------------------------------------------
        if ($request->hasfile('caratulaseguro')) {
            $file_p11 = $request->file('caratulaseguro');
            $destino_p11 = 'img/evidencia_seguros/';
            $filename_p11 = 'caratulaseguro_' . str_replace(' ', '_', $request->nopoliza) . '_' . str_replace(' ', '_', $file_p11->getClientOriginalName());
            $cargar_p11 = $request->file('caratulaseguro')->move($destino_p11, $filename_p11);
            $caratula = $destino_p11 . $filename_p11;
        }
        //-----------------------------------------------------------------------------------------------------------------------
        $unidad = $request->get('id_unidad');
        //------- CODIGO PARA ELIMINAR LOS SEGUROS VIEJOS Y DEJAR SOLO DOS UNO ACTIVO Y UNO ANTIGUO -------
        $cambio=Seguro::where('id_unidad', '=', $unidad)->get();
        foreach ($cambio as $cambios) {
            if ($cambios->estado=="Inactivo") {
                unlink($cambios->caratulaseguro);
                $cambio = Seguro::where('nopoliza', '=', $cambios->nopoliza)->delete();
            }
        }
        if ($validacion) {
            $cambio = Seguro::where('id_unidad', '=', $unidad)->update(["estado" => "Inactivo"]);
        }
        //-------------------------------------------------------------------------------------------------
        $caratula = $destino_p11 . $filename_p11;
        Seguro::create([
            'id_unidad' => $request['id_unidad'],
            'estado' => $request['estado'],
            'nopoliza' => $request['nopoliza'],
            'fechainicio' => $request['fechainicio'],
            'fechavencimiento' => $request['fechavencimiento'],
            'tiposeguro' => $request['tiposeguro'],
            'provedor' => $request['provedor'],
            'precio' => $request['precio'],
            'impuestos' => $request['impuestos'],
            'costototal' => $request['costototal'],
            'caratulaseguro' => $caratula,
        ]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["seguro" => $request->get('nopoliza')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["seguro_fecha" => $request->get('fechavencimiento')]);
        return redirect()->route('unidades.show', $unidad);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        return view('seguros.crear', compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguro $seguro)
    {
        return view('seguros.editar', compact('seguro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguro $seguro)
    {
        $validacion = request()->validate([
            'id_unidad' => 'required',
            'estado' => 'required',
            'nopoliza' => 'required',
            'fechainicio' => 'required',
            'fechavencimiento' => 'required',
            'tiposeguro' => 'required',
            'provedor' => 'required',
            'precio' => 'required',
            'impuestos' => 'required',
            'costototal' => 'required',
            'caratulaseguro' => 'required',
        ]);
        /* CARGAR DOCUMENTOS */
        $caratula = 'sin evidencia';
        $ruta = "img/evidencia_seguros";
        if (is_dir($ruta)) {
        } else {
            $ruta = "img/evidencia_seguros";
            \File::makeDirectory($ruta, 0775, true);
        }
        //------------------------------------------------ EVIDENCIA_CARATULA ------------------------------------------------
        if ($request->hasfile('caratulaseguro')) {
            $file_p11 = $request->file('caratulaseguro');
            $destino_p11 = 'img/evidencia_seguros/';
            $filename_p11 = 'caratulaseguro_' . str_replace(' ', '_', $request->nopoliza) . '_' . str_replace(' ', '_', $file_p11->getClientOriginalName());
            unlink($seguro->caratulaseguro);
            $cargar_p11 = $request->file('caratulaseguro')->move($destino_p11, $filename_p11);
            $caratula = $destino_p11 . $filename_p11;
        }
        //-----------------------------------------------------------------------------------------------------------------------
        $caratula = $destino_p11 . $filename_p11;
        $seguro->update([
            'id_unidad' => $request['id_unidad'],
            'estado' => $request['estado'],
            'nopoliza' => $request['nopoliza'],
            'fechainicio' => $request['fechainicio'],
            'fechavencimiento' => $request['fechavencimiento'],
            'tiposeguro' => $request['tiposeguro'],
            'provedor' => $request['provedor'],
            'precio' => $request['precio'],
            'impuestos' => $request['impuestos'],
            'costototal' => $request['costototal'],
            'caratulaseguro' => $caratula,
        ]);
        //-----------------------------------------------------------------------------------------------------------------------
        $unidad = $seguro->id_unidad;
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["seguro" => $request->get('nopoliza')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["seguro_fecha" => $request->get('fechavencimiento')]);
        return redirect()->route('unidades.show', $unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seguro $seguro)
    {
        $unidad = $seguro->id_unidad;
        $seguros = $seguro->nopoliza;
        unlink($seguro->caratulaseguro);
        $seguro->delete();
        $cambio = Unidade::where('seguro', '=', $seguros)->update(["seguro" => "Sin Seguro"]);
        $cambio = Unidade::where('seguro', '=', $seguros)->update(["seguro_fecha" => "Sin Fecha"]);
        return redirect()->route('unidades.show', $unidad);
    }
    public function export($unidad)
    {
        return (new SegurosExport($unidad))->download('Seguros_unidad_' . $unidad . '.xlsx');
    }
}
