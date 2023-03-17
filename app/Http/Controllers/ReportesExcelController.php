<?php

namespace App\Http\Controllers;

use App\Exports\ReporteDiaExport;
use App\Models\Operadore;
use Illuminate\Http\Request;
use App\Models\Seguro;
use App\Models\Unidade;
use App\Models\Verificacione;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteFlotillasExport;
use App\Exports\ReporteFumigacionesExport;
use App\Exports\ReporteIndividualExport;
use App\Exports\ReporteIndividualVExport;
use App\Exports\ReporteSatisfaccionExport;
use App\Exports\ReporteSegurosExport;
use App\Exports\ReporteSemanalExport;
use App\Exports\ReporteVeriExport;
use App\Exports\ReporteVerificacionesExport;
use App\Exports\ReposteSegurosExport;
use App\Models\Fumigacione;

class ReportesExcelController extends Controller
{
    /* ============================================= EXCELES FUNCIONES ============================================= */
    public function reporte_flotillasexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            return (new ReporteFlotillasExport($cli, $inicio, $final, $unidad))->download('Reporte_Flotillas.xlsx');
        } else {
            return (new ReporteFlotillasExport($cli, $inicio, $final, $unidad))->download('Reporte_Flotillas_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_verificacionesexcel(Request $request)
    {
        /* return (new SegurosExport($unidad))->download('Seguros_unidad_' . $unidad . '.xlsx'); */
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            if ($tipo == 'Ambiental') {
                return (new ReporteVerificacionesExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_Ambientales.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteVerificacionesExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_F_Mecanicas.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteVerificacionesExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_Ambas_Veri.xlsx');
            }
        } else {
            if ($tipo == 'Ambiental') {
                return (new ReporteVerificacionesExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_Ambientales_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteVerificacionesExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_F_Mecanicas_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteVerificacionesExport($tipo, $cli, $inicio, $final, $unidad))->download('Reporte_Verificaciones_Ambas_Veri_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
        }
    }
    public function reporte_segurosexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            return (new ReporteSegurosExport($cli, $inicio, $final, $unidad))->download('Reporte_Seguros.xlsx');
        } else {
            return (new ReporteSegurosExport($cli, $inicio, $final, $unidad))->download('Reporte_Seguros_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_fumigacionesexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        $fumigador = "" . $request['filtrofumigador'];
        $status = "" . $request['filtrostatus'];
        if ($cli == 'todos') {
            return (new ReporteFumigacionesExport($cli, $inicio, $final, $unidad, $tipou, $fumigador, $status))->download('Reporte_Fumigaciones_Acumuladas.xlsx');
        } else {
            return (new ReporteFumigacionesExport($cli, $inicio, $final, $unidad, $tipou, $fumigador, $status))->download('Reporte_Fumigaciones_Acumuladas_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_semanalexcel(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        if ($cli == 'todos') {
            return (new ReporteSemanalExport($cli, $inicio, $final, $unidad, $tipou))->download('Reporte_Fumigaciones_Realizadas.xlsx');
        } else {
            return (new ReporteSemanalExport($cli, $inicio, $final, $unidad, $tipou))->download('Reporte_Fumigaciones_Realizadas_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_diaexcel(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        if ($cli == 'todos') {
            return (new ReporteDiaExport($cli, $inicio, $final, $unidad, $tipou))->download('Reportes_Fumigaciones_Proximas.xlsx');
        } else {
            return (new ReporteDiaExport($cli, $inicio, $final, $unidad, $tipou))->download('Reportes_Fumigaciones_Proximas_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_serviciosexcel(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        if ($cli == 'todos') {
            return (new ReporteSemanalExport($cli, $inicio, $final, $unidad, $tipou))->download('Reporte_Servicio.xlsx');
        } else {
            return (new ReporteSemanalExport($cli, $inicio, $final, $unidad, $tipou))->download('Reporte_Servicio_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_individualexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $operador = "" . $request['filtrooper'];
        if ($cli == 'todos') {
            return (new ReporteIndividualExport($cli, $inicio, $final, $operador))->download('Reporte_individual.xlsx');
        } else {
            return (new ReporteIndividualExport($cli, $inicio, $final, $operador))->download('Reporte_individual_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reportes_individualvexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        if ($cli == 'todos') {
            return (new ReporteIndividualVExport($cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular.xlsx');
        } else {
            return (new ReporteIndividualVExport($cli, $inicio, $final, $unidad))->download('Reporte_Individual_Vehicular_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reportes_satisfaccionexcel(Request $request)
    {
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        $unidad = "" . $request['filtrounid'];
        $tipou = "" . $request['filtrotuni'];
        if ($cli == 'todos') {
            return (new ReporteSatisfaccionExport($cli, $inicio, $final, $unidad, $tipou))->download('Reporte_Satisfaccion.xlsx');
        } else {
            return (new ReporteSatisfaccionExport($cli, $inicio, $final, $unidad, $tipou))->download('Reporte_Satisfaccion_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    /* ============================================================================================================= */
}
