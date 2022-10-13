<?php

namespace App\Http\Controllers;

use App\Http\Requests\SegurosRequest;
use App\Models\Seguro;
use App\Models\Unidade;
use Illuminate\Http\Request;

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
    public function store(SegurosRequest $request)
    {
        $unidad=$request->get('id_unidad');
        if ($request->validated()) {
            $cambio=Seguro::where('id_unidad', '=', $unidad)->update(["estado"=>"Inactivo"]);
        }
        Seguro::create($request->validated());
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["seguro"=>$request->get('nopoliza')]);
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["seguro_fecha"=>$request->get('fechavencimiento')]);
        return redirect()->route('unidades.show',$unidad);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        return view('seguros.crear',compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguro $seguro)
    {
        return view('seguros.editar',compact('seguro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SegurosRequest $request, Seguro $seguro)
    {
        $seguro->update($request->validated());
        $unidad=$seguro->id_unidad;
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["seguro"=>$request->get('nopoliza')]);
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["seguro_fecha"=>$request->get('fechavencimiento')]);
        return redirect()->route('unidades.show',$unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seguro $seguro)
    {
        $unidad=$seguro->id_unidad;
        $seguros=$seguro->nopoliza;
        $seguro->delete();
        $cambio=Unidade::where('seguro', '=', $seguros)->update(["seguro"=>"Sin Seguro"]);
        $cambio=Unidade::where('seguro', '=', $seguros)->update(["seguro_fecha"=>"Sin Fecha"]);
        return redirect()->route('unidades.show',$unidad);
    }
}
