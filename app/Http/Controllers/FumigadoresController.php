<?php

namespace App\Http\Controllers;

use App\Http\Requests\FumigadoresRequest;
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
        $fumigadores = Fumigadore::all();
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
    public function store(FumigadoresRequest $request)
    {
        Fumigadore::create($request->validated());
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
    public function update(FumigadoresRequest $request, Fumigadore $fumigadore)
    {
        $fumigadore->update($request->validated());
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
