<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Verificacione;
use Illuminate\Http\Request;
use PDF;

class Metodos extends Controller
{
    public function UnidadesTCFI($tipo, $cli, $final, $inicio)
    {
        /* ============================================================================== */
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            } else {
                if ($cli == 'todos') {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                } else {
                    if ($tipo == 'Ambiental') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Ambiental')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Fisica') {
                        return Unidade::join('verificaciones', 'verificaciones.noverificacion', '=', 'unidades.verificacion2')
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->where('verificaciones.tipoverificacion', '=', 'Fisica')
                            ->where('unidades.cliente', '=', $cli)
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                    if ($tipo == 'Ambas') {
                        return Unidade::join(
                            'verificaciones',
                            function ($join) {
                                $join->on('verificaciones.noverificacion', '=', 'unidades.verificacion')->orOn('verificaciones.noverificacion', '=', 'unidades.verificacion2');
                            }
                        )
                            ->where('unidades.tipo', '=', 'Unidad Vehicular')
                            ->whereDate('verificaciones.ultimaverificacion', '>=', $inicio)
                            ->whereDate('verificaciones.ultimaverificacion', '<=', $final)
                            ->where('unidades.cliente', '=', $cli)
                            ->select(
                                'unidades.cliente',
                                'verificaciones.tipoverificacion',
                                'verificaciones.subtipoverificacion',
                                'verificaciones.ultimaverificacion',
                                'unidades.marca',
                                'unidades.serieunidad',
                                'unidades.añounidad',
                                'unidades.placas',
                                'unidades.tipounidad',
                                'unidades.razonsocialunidad',
                                'unidades.digitoplaca',
                            )->get();
                    }
                }
            }
        }
        /* ============================================================================== */
    }
    public function UnidadesCFI($cli, $final, $inicio){
        if ($inicio == null) {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->where('cliente', '=', $cli)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->where('cliente', '=', $cli)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                }
            }
        } else {
            if ($final == null) {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->where('cliente', '=', $cli)
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                }
            } else {
                if ($cli == 'todos') {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                } else {
                    return Unidade::where('tipo', '=', 'Unidad Vehicular')
                        ->whereDate('seguro_fecha', '>=', $inicio)
                        ->whereDate('seguro_fecha', '<=', $final)
                        ->where('cliente', '=', $cli)
                        ->select(
                            'cliente',
                            'marca',
                            'serieunidad',
                            'añounidad',
                            'placas',
                            'tipounidad',
                            'razonsocialunidad',
                            'seguro_fecha'
                        )->get();
                }
            }
        }
    }
}
class ReportesPDFController extends Metodos
{
    public function ReporteFlotillaPDF(Request $request)
    {
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidades = Metodos::UnidadesTCFI($tipo, $cli, $final, $inicio);
        $pdf = PDF::loadView('pdf.ReporteFlotillas', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Flotillas',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Flotillas.pdf');
    }
    public function ReporteSegurosPDF(Request $request)
    {
        /* $tipo = $request['filtroveri']; */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidades = Metodos::UnidadesCFI($cli, $final, $inicio);
        $pdf = PDF::loadView('pdf.ReporteSeguros', [
            'unidades' => $unidades,
            'nombre' => 'Reporte Seguros',
        ]);
        /* landscape->HORIZONTAL */
        /* portrait->vertical */
        /* A3 -> "a3" => array(0,0,841.89,1190.55), */
        $pdf->setPaper(array(0, 0, 838, 1188), 'portrait');
        return $pdf->download('Reporte_Seguros.pdf');
    }
}
