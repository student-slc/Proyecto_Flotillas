<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Fumigacione;
use App\Models\Fumigadore;
use Illuminate\Http\Request;

class FumigacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        $fumigaciones = Fumigacione::paginate(5);
        return view('fumigaciones.index', compact('fumigaciones'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $fumigadores = Fumigadore::all();
        return view('fumigaciones.crear',compact('clientes','fumigadores'));
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
            "id_cliente" => 'required',
            "id_fumigador" => 'required',
            "fechaprogramada" => 'required',
            "fechaultimafumigacion" => 'required',
            "lugardelservicio" => 'required',
            "status" => 'required',
            "numerodevisitas" => 'required',
            "costo" => 'required',
            "satisfaccionservicio" => 'required',
        ]);
        Fumigacione::create($request->all());
        return redirect()->route('fumigaciones.index');
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
    public function edit(Fumigacione $fumigacione)
    {
        $clientes = Cliente::all();
        $fumigadores = Fumigadore::all();
        return view('fumigaciones.editar', compact('fumigacione','clientes','fumigadores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fumigacione $fumigacione)
    {
        request()->validate([
            "id_cliente" => 'required',
            "id_fumigador" => 'required',
            "fechaprogramada" => 'required',
            "fechaultimafumigacion" => 'required',
            "lugardelservicio" => 'required',
            "status" => 'required',
            "numerodevisitas" => 'required',
            "costo" => 'required',
            "satisfaccionservicio" => 'required',
        ]);
        $fumigacione->update($request->all());
        return redirect()->route('fumigaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fumigacione $fumigacione)
    {
        $fumigacione->delete();
        return redirect()->route('fumigaciones.index');
    }
}
