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
use App\Models\Folio;
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
        $folios = Folio::where('tipo', '=', 'Fumigaciones')->get();
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
        return view('fumigaciones.crear', compact('unidad', 'fumigadores', 'tipo', 'lugar', 'pcliente', 'direccion', 'folios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FumigacionesRequest $request)
    {
        $folio_actual = $request->numerofumigacion;
        $folios = Folio::where('id', '=', $folio_actual)->get();
        $unidad = $request->unidad;
        if ($request->validated()) {
            $cambio = Fumigacione::where('unidad', '=', $unidad)->update(["status" => "Inactivo"]);
        }
        /* ---------------------------------------------- FOLIOS ---------------------------------------------- */
        foreach ($folios as $folio) {
            $contador = $folio->contador;
            $string = $folio->folio;
            $inicio = preg_replace('/[^0-9]/', '', $string);
            $fin = (int) $inicio + (int) $contador;
        }
        $request->merge(['numerofumigacion' => '' . $fin]);
        $cambio = Folio::where('id', '=', $folio_actual)->update(["contador" => $contador + 1]);
        /* ---------------------------------------------------------------------------------------------------- */
        Fumigacione::create(
            [
                "id_fumigador" => $request['id_fumigador'],
                "fechaprogramada" => $request['fechaprogramada'],
                "fechaultimafumigacion" => $request['fechaultimafumigacion'],
                "lugardelservicio" => $request['lugardelservicio'],
                "status" => $request['status'],
                "numerodevisitas" => $request['numerodevisitas'],
                "costo" => $request['costo'],
                "numerofumigacion" => $request['numerofumigacion'],
                "unidad" => $request['unidad'],
                "producto" => $request['producto'],
                "insectosvoladores" => $request['insectosvoladores'],
                "pulgas" => $request['pulgas'],
                "aracnidos" => $request['aracnidos'],
                "roedores" => $request['roedores'],
                "insectosrastreros" => $request['insectosrastreros'],
                "mosca" => $request['mosca'],
                "hormigas" => $request['hormigas'],
                "alacranes" => $request['alacranes'],
                "cucaracha" => $request['cucaracha'],
                "chinches" => $request['chinches'],
                "termitas" => $request['termitas'],
                "carcamo" => $request['carcamo'],
                "tipo" => $request['tipo'],
                "observaciones" => $request['observaciones'],
            ]
        );
        $estado = $request->get('status');
        if ($estado == 'Realizado') {
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
        }
        if ($estado != 'Realizado') {
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["lapsofumigacion" => $estado]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["lapsofumigacion" => $estado]);
        }
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
        $estado = $request->get('status');
        $fumigacione->update($request->validated());
        if ($estado == 'Realizado') {
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["fumigacion" => $request->get('numerofumigacion')]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["lapsofumigacion" => $request->get('fechaprogramada')]);
        }
        if ($estado != 'Realizado') {
            $cambio = Unidade::where('serieunidad', '=', $unidad)->update(["lapsofumigacion" => $estado]);
            $cambio = Unidade::where('direccion', '=', $unidad)->update(["lapsofumigacion" => $estado]);
        }
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
        $estado = $fumigacione->status;
        $fumigacione->delete();
        if ($estado == 'Realizado') {
            $cambio = Unidade::where('fumigacion', '=', $fumigacion)->update(["lapsofumigacion" => "Sin Fecha de Fumigación"]);
            $cambio = Unidade::where('fumigacion', '=', $fumigacion)->update(["fumigacion" => "Sin Fumigación"]);
        } else {
        }
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
