<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolioRequest;
use App\Models\Folio;
use Illuminate\Http\Request;

class FoliosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folios = Folio::all();
        return view('folios.index', compact('folios'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('folios.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolioRequest $request)
    {
        Folio::create($request->validated());
        return redirect()->route('folios.index');
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
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FolioRequest $request, Folio $folio)
    {
        $folio->update($request->validated());
        return redirect()->route('folios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folio $folio)
    {
        $folio->delete();
        return redirect()->route('folios.index');
    }
   /*  public function export()
    {
        return Excel::download(new FumigadoresExport, 'Fumigadores.xlsx');
    } */
}
