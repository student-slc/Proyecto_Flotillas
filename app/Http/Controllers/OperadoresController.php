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
        /* $operadores = Operadore::paginate(5);
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
    public function crear($unidad)
    {
        return view('operadores.crear',compact('unidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperadoresRequest $request)
    {
        $unidad=$request->unidad;
        Operadore::create($request->validated());
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["operador"=>"1"]);
        return redirect()->route('operadores.show',$unidad);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $numero = Operadore::where('unidad', '=', $unidad)->count();
        $operadores = Operadore::where('unidad', '=', $unidad)->paginate(5);
        return view('operadores.index', compact('operadores','numero','unidad'));
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
    public function update(OperadoresRequest $request, Operadore $operadore)
    {
        $unidad=$request->unidad;
        $operadore->update($request->validated());
        return redirect()->route('operadores.show',$unidad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operadore $operadore)
    {
        $unidad=$operadore->unidad;
        $operadore->delete();
        $cambio=Unidade::where('serieunidad', '=', $unidad)->update(["operador"=>"0"]);
        return redirect()->route('operadores.show',$unidad);
    }
}
