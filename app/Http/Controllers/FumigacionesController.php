<?php

namespace App\Http\Controllers;

use App\Http\Requests\FumigacionesRequest;
use App\Models\Cliente;
use App\Models\Fumigacione;
use App\Models\Fumigadore;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FumigacionesExport;
use App\Imports\FumigacionesImport;
use App\Models\Unidade;

class FumigacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* //Con paginación
        $fumigaciones = Fumigacione::all();
        return view('fumigaciones.index', compact('fumigaciones'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $clientes->links() !!} */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $clientes = Cliente::all();
        $fumigadores = Fumigadore::all();
        return view('fumigaciones.crear',compact('clientes','fumigadores')); */
    }
    public function crear($unidad)
    {
        $unidades = Unidade::orWhere('direccion', '=', $unidad)
            ->orWhere('serieunidad', '=', $unidad)
            ->get();
        foreach ($unidades as $unidade) {
            $tipo = $unidade->tipo;
            $lugar = $unidade->direccion;
            $cliente = $unidade->cliente;
        }
        $clientes = Cliente::where('nombrecompleto', '=', $cliente)->get();
        foreach ($clientes as $cliente) {
            $pcliente = $cliente->nombrecompleto;
            $direccion = $cliente->direccionfisica;
        }
        $fumigadores = Fumigadore::all();
        return view('fumigaciones.crear', compact('unidad', 'fumigadores', 'tipo', 'lugar', 'pcliente', 'direccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FumigacionesRequest $request)
    {
        $unidad = $request->unidad;
        if ($request->validated()) {
            $cambio = Fumigacione::where('unidad', '=', $unidad)->update(["status" => "Inactivo"]);
        }
        Fumigacione::create($request->validated());
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
        $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
        $cambio = Unidade::where('direccion', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
        $cambio = Unidade::where('direccion', '=', $unidad)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
        return redirect()->route('fumigaciones.show', $unidad);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unidad)
    {
        $fumigaciones = Fumigacione::where('unidad', '=', $unidad)->get();
        return view('fumigaciones.index', compact('fumigaciones', 'unidad'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fumigacione $fumigacione)
    {
        $fumigadores = Fumigadore::all();
        return view('fumigaciones.editar', compact('fumigacione', 'fumigadores'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FumigacionesRequest $request, Fumigacione $fumigacione)
    {
        $unidad = $fumigacione->unidad;
        $fumigacion = $fumigacione->numerofumigacion;
        $fumigacione->update($request->validated());
        $cambio = Unidade::where('fumigacion', '=', $fumigacion)->update(["fumigacion" => $request->get('numerofumigacion')]);
        $cambio = Unidade::where('fumigacion', '=', $fumigacion)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
        return redirect()->route('fumigaciones.show', $unidad);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fumigacione $fumigacione)
    {
        $unidad = $fumigacione->unidad;
        $fumigacion = $fumigacione->numerofumigacion;
        $fumigacione->delete();
        $cambio = Unidade::where('fumigacion', '=', $fumigacion)->update(["lapsofumigacion" => "Sin Fecha de Fumigación"]);
        $cambio = Unidade::where('fumigacion', '=', $fumigacion)->update(["fumigacion" => "Sin Fumigación"]);
        return redirect()->route('fumigaciones.show', $unidad);
    }
    public function export()
    {
        return Excel::download(new FumigacionesExport, 'Fumigaciones.xlsx');
    }
    /* public function import()
    {
        Excel::import(new ClientesImport,request()->file('file'));
        return back();
    } */
}
