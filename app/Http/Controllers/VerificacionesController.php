<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerificacionesRequest;
use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
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
        return view('verificaciones.crear', compact('unidad'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VerificacionesRequest $request)
    {
        $unidad=$request->id_unidad;
        Verificacione::create($request->validated());
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["verificacion"=>"Con Verificación"]);
        return redirect()->route('verificaciones.show',$unidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $verificaciones = Verificacione::where('id_unidad', '=', $unidad)->paginate(10);
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
    public function update(VerificacionesRequest $request,Verificacione $verificacione)
    {
        $unidad=$verificacione->id_unidad;
        $verificacione->update($request->validated());
        return redirect()->route('verificaciones.show',$unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verificacione $verificacione)
    {
        $unidad=$verificacione->id_unidad;
        $verificacione->delete();
        return redirect()->route('verificaciones.show',$unidad);
    }
}
