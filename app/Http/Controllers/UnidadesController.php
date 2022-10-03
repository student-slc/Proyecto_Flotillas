<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadesRequest;
use App\Models\Seguro;
use App\Models\Unidade;
use Illuminate\Http\Request;

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
        /* $unidades = Unidade::paginate(5);
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
        $usuario=$request->cliente;
        Unidade::create($request->validated());
        return redirect()->route('clientes.show',$usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $seguros = Seguro::where('id_unidad', '=', $unidad)->paginate(10);
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
        $usuario=$unidade->cliente;
        $unidade->update($request->validated());
        return redirect()->route('clientes.show',$usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        $usuario=$unidade->cliente;
        $unidad = $unidade->serieunidad;
        $cambio = Seguro::where('id_unidad', '=', $unidad)->delete();
        $unidade->delete();
        return redirect()->route('clientes.show',$usuario);
    }
}
