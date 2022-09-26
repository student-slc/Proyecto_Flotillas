<?php

namespace App\Http\Controllers;

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
        //Con paginación
        $unidades = Unidade::paginate(5);
        return view('unidades.index', compact('unidades'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidades.crear');
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
            'serieunidad' => 'required',
            'marca' => 'required',
            'submarca' => 'required',
            'añounidad' => 'required',
            'tipounidad' => 'required',
            'razonsocialunidad' => 'required',
            'placas' => 'required',
            'status' => 'required'
        ]);

        Unidade::create($request->all());
        return redirect()->route('unidades.index');
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
    public function update(Request $request, Unidade $unidade)
    {
        request()->validate([
            'serieunidad' => 'required',
            'marca' => 'required',
            'submarca' => 'required',
            'añounidad' => 'required',
            'tipounidad' => 'required',
            'razonsocialunidad' => 'required',
            'placas' => 'required',
            'status' => 'required'
        ]);
        $unidade->update($request->all());
        return redirect()->route('unidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        $unidade->delete();
        return redirect()->route('unidades.index');
    }
}
