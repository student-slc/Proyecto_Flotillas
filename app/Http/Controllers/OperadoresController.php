<?php

namespace App\Http\Controllers;

use App\Models\Operadore;
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
        $operadores = Operadore::paginate(5);
        return view('operadores.index', compact('operadores'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operadores.crear');
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
            "id_flotilla" => 'required'
        ]);

        Operadore::create($request->all());
        return redirect()->route('operadores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            "id_flotilla" => 'required'
        ]);
        $operadore->update($request->all());
        return redirect()->route('operadores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operadore $operadore)
    {
        $operadore->delete();
        return redirect()->route('operadores.index');
    }
}
