<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperadoresRequest;
use App\Models\Operadore;
use App\Models\Unidade;
use Illuminate\Http\Request;

class OperadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        /* $operadores = Operadore::get();
        return view('operadores.index', compact('operadores')); */
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* return view('operadores.crear',compact('unidad')); */
    }
    public function crear($usuario)
    {
        return view('operadores.crear', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            "nombreoperador" => 'required',
            "fechanacimiento" => 'required',
            "nolicencia" => 'required',
            "tipolicencia" => 'required',
            "fechavencimientomedico" => 'required',
            "fechavencimientolicencia" => 'required',
            "cliente" => 'required',
            "licencia" => 'required',
            "curso" => 'required',
            "examenmedico" => 'required'
        ]);
        /* CARGAR DOCUMENTOS */
        $licencia = 'sin evidencia';
        $curso = 'sin evidencia';
        $examenmedico = 'sin evidencia';
        $ruta = "img/evidencia";
        if (is_dir($ruta)) {
        } else {
            $ruta = "img/evidencia";
            \File::makeDirectory($ruta, 0775, true);
        }
        //------------------------------------------------ EVIDENCIA_PREGUNTA_1 ------------------------------------------------
        if ($request->hasfile('licencia')) {
            $file_p11 = $request->file('licencia');
            $destino_p11 = 'img/evidencia/';
            $filename_p11 = 'Licencia_' . str_replace(' ', '_', $request->nombreoperador) . '_' . $file_p11->getClientOriginalName();
            $cargar_p11 = $request->file('licencia')->move($destino_p11, $filename_p11);
            $licencia = $destino_p11 . $filename_p11;
        }
        if ($request->hasfile('curso')) {
            $file_p12 = $request->file('curso');
            $destino_p12 = 'img/evidencia/';
            $filename_p12 = 'Curso_' . str_replace(' ', '_', $request->nombreoperador) . '_' . $file_p12->getClientOriginalName();
            $cargar_p12 = $request->file('curso')->move($destino_p12, $filename_p12);
            $curso = $destino_p12 . $filename_p12;
        }
        if ($request->hasfile('examenmedico')) {
            $file_p12 = $request->file('examenmedico');
            $destino_p12 = 'img/evidencia/';
            $filename_p12 = 'Examen_Medico_' . str_replace(' ', '_', $request->nombreoperador) . '_' . $file_p12->getClientOriginalName();
            $cargar_p12 = $request->file('examenmedico')->move($destino_p12, $filename_p12);
            $examenmedico = $destino_p12 . $filename_p12;
        }
        /* ======================================================== */
        $usuario = $request->cliente;
        Operadore::create([
            'nombreoperador' => $request['nombreoperador'],
            'fechanacimiento' => $request['fechanacimiento'],
            'nolicencia' => $request['nolicencia'],
            'tipolicencia' => $request['tipolicencia'],
            'fechavencimientomedico' => $request['fechavencimientomedico'],
            'fechavencimientolicencia' => $request['fechavencimientolicencia'],
            'cliente' => $request['cliente'],
            'licencia' => $licencia,
            'curso' => $curso,
            'examenmedico' => $examenmedico
        ]);
        return redirect()->route('operadores.show', $usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($usuario)
    {
        $operadores = Operadore::where('cliente', '=', $usuario)->get();
        return view('operadores.index', compact('operadores', 'usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Operadore $operadore)
    {
        return view('operadores.editar', compact('operadore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operadore $operadore)
    {
        request()->validate([
            "nombreoperador" => 'required',
            "fechanacimiento" => 'required',
            "nolicencia" => 'required',
            "tipolicencia" => 'required',
            "fechavencimientomedico" => 'required',
            "fechavencimientolicencia" => 'required',
            "cliente" => 'required',
        ]);
        /* CARGAR DOCUMENTOS */
        $licencia = $request->licenciaruta;
        $curso = $request->cursoruta;
        $examenmedico = $request->examenmedicoruta;
        $ruta = "img/evidencia";
        if (is_dir($ruta)) {
        } else {
            $ruta = "img/evidencia";
            \File::makeDirectory($ruta, 0775, true);
        }
        //------------------------------------------------ EVIDENCIA_PREGUNTA_1 ------------------------------------------------
        if ($request->hasfile('licencia')) {
            $file_p11 = $request->file('licencia');
            $destino_p11 = 'img/evidencia/';
            $filename_p11 = 'Licencia_' . str_replace(' ', '_', $request->nombreoperador) . '_' . $file_p11->getClientOriginalName();
            unlink($request->licenciaruta);
            $cargar_p11 = $request->file('licencia')->move($destino_p11, $filename_p11);
            $licencia = $destino_p11 . $filename_p11;
        }
        if ($request->hasfile('curso')) {
            $file_p12 = $request->file('curso');
            $destino_p12 = 'img/evidencia/';
            $filename_p12 = 'Curso_' . str_replace(' ', '_', $request->nombreoperador) . '_' . $file_p12->getClientOriginalName();
            unlink($request->cursoruta);
            $cargar_p12 = $request->file('curso')->move($destino_p12, $filename_p12);
            $curso = $destino_p12 . $filename_p12;
        }
        if ($request->hasfile('examenmedico')) {
            $file_p12 = $request->file('examenmedico');
            $destino_p12 = 'img/evidencia/';
            $filename_p12 = 'Examen_Medico_' . str_replace(' ', '_', $request->nombreoperador) . '_' . $file_p12->getClientOriginalName();
            unlink($request->examenmedicoruta);
            $cargar_p12 = $request->file('examenmedico')->move($destino_p12, $filename_p12);
            $examenmedico = $destino_p12 . $filename_p12;
        }
        /* ======================================================== */
        $usuario = $request->cliente;
        $operadore->update([
            'nombreoperador' => $request['nombreoperador'],
            'fechanacimiento' => $request['fechanacimiento'],
            'nolicencia' => $request['nolicencia'],
            'tipolicencia' => $request['tipolicencia'],
            'fechavencimientomedico' => $request['fechavencimientomedico'],
            'fechavencimientolicencia' => $request['fechavencimientolicencia'],
            'cliente' => $request['cliente'],
            'licencia' => $licencia,
            'curso' => $curso,
            'examenmedico' => $examenmedico
        ]);
        return redirect()->route('operadores.show', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operadore $operadore)
    {
        $usuario = $operadore->cliente;
        unlink($operadore->licencia);
        unlink($operadore->curso);
        unlink($operadore->examenmedico);
        $operadore->delete();
        return redirect()->route('operadores.show', $usuario);
    }
}
