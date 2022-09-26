<?php

namespace App\Http\Controllers;

use App\Models\Fumigadore;
use Illuminate\Http\Request;

class FumigadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        $fumigadores = Fumigadore::paginate(5);
        return view('fumigadores.index', compact('fumigadores'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fumigadores.crear');
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
            'nombrecompleto' => 'required',
            'fechanacimiento' => 'required',
            'certificacion' => 'required'
        ]);

        Fumigadore::create($request->all());
        return redirect()->route('fumigadores.index');
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
    public function edit(Fumigadore $fumigadore)
    {
        return view('fumigadores.editar', compact('fumigadore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fumigadore $fumigadore)
    {
        request()->validate([
            'nombrecompleto' => 'required',
            'fechanacimiento' => 'required',
            'certificacion' => 'required'
        ]);
        $fumigadore->update($request->all());
        return redirect()->route('fumigadores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fumigadore $fumigadore)
    {
        $fumigadore->delete();
        return redirect()->route('fumigadores.index');
    }
}
