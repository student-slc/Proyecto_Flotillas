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
use App\Exports\ReporteSemanalExport;
use App\Exports\ReporteVeriExport;
use App\Exports\ReposteSegurosExport;


class CalculoFechas  extends Controller
{
    public function fechas($color, $fecha, $tipo, $mstipo, $sin, $frecuencia)
    {
        /* =============================================== //BUG:FECHAS  =============================================== */
        /* tipo y frecuencia */
        $sin_seguro = 0;
        $azul = 0;
        $verde = 0;
        $amarillo = 0;
        $rojo = 0;
        $expirado = 0;
        $unidades = Unidade::all();
        $matriz[1][0] = 'vacio';
        $matriz[2][0] = 'vacio';
        $matriz[3][0] = 'vacio';
        $matriz[4][0] = 'vacio';
        $matriz[5][0] = 'vacio';
        $matriz[6][0] = 'vacio';
        foreach ($unidades as $unidade) {
            if ($unidade->tipo == 'Unidad Vehicular') {
                if ($frecuencia == 'fecha') {
                    if ($unidade->tipomantenimiento == 'Kilometraje' && $tipo == 'mantenimiento') {
                    } else {
                        if ($unidade->$tipo == $mstipo) {
                            if ($color == $sin) {
                                $matriz[1][$sin_seguro] = $unidade->serieunidad;
                                $sin_seguro = $sin_seguro + 1;
                            }
                        } else {
                            /* FECHA LICENCIA */
                            $vencimiento_dia = substr($unidade->$fecha, 8, 2);
                            $vencimiento_mes = substr($unidade->$fecha, 5, 2);
                            $vencimiento_año = substr($unidade->$fecha, 0, 4);
                            if ($tipo == 'mantenimiento' && $unidade->tipomantenimiento == 'Fecha') {
                                $vencimiento_mes = $vencimiento_mes + $unidade->frecuencia_mante;
                                if ($vencimiento_mes > 12) {
                                    $vencimiento_año = $vencimiento_año + 1;
                                    $vencimiento_mes = $vencimiento_mes - 12;
                                }
                            }
                            if ($tipo == 'fumigacion') {
                                $vencimiento_mes = (int)$vencimiento_mes + (int) $unidade->frecuencia_fumiga;
                                if ($vencimiento_mes > 12) {
                                    $vencimiento_año = $vencimiento_año + 1;
                                    $vencimiento_mes = $vencimiento_mes - 12;
                                }
                            }
                            /* FECHA ACTUAL */
                            $año_actual = date('Y');
                            $mes_actual = date('n');
                            $dia_actual = date('d');
                            /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                            $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                            /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                            $uno = 'nulo';
                            $calcular = 0;
                            if ($diferencia_año >= 1) {
                                $meses = $diferencia_año * 12 + 12;
                                $operacion_1 = $meses - (int) $mes_actual;
                                $operacion_2 = 12 - (int) $vencimiento_mes;
                                $operacion_3 = $operacion_1 - $operacion_2;
                                $meses = $operacion_3;
                            } else {
                                $meses = (int) $vencimiento_mes - (int) $mes_actual;
                            }
                            if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                                $uno = 'uno';
                                $calcular = 0;
                            } else {
                                $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                                $direstantes = (int) $cantidaddias - (int) $dia_actual;
                                $calcular = $direstantes + (int) $vencimiento_dia;
                            }
                            /* CALCULO DE DIAS EXACTOS */
                            $dias_exactos = 0;
                            $contador_1 = 0;
                            $contador_2 = 0;
                            $cuenta_mes = $mes_actual;
                            $operacion_1 = 0;
                            $mes_contador = 0;
                            for ($i = 0; $i <= $meses; $i++) {
                                if ($uno == 'uno') {
                                    $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                    $i = $meses + 1;
                                } else {
                                    if ($contador_1 == 0) {
                                        $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                        $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                        $dias_exactos = $dias_exactos + $operacion_2;
                                        $contador_1 = 1;
                                    } else {
                                        if ($i == $meses) {
                                            $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                        } else {
                                            $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                            $dias_exactos = $dias_exactos + (int) $operacion_1;
                                            $mes_contador = $mes_contador + 1;
                                        }
                                    }
                                    if ($cuenta_mes == 12) {
                                        $contador_2 = $contador_2 + 1;
                                        $cuenta_mes = 1;
                                    } else {
                                        $cuenta_mes = $cuenta_mes + 1;
                                    }
                                }
                            }
                            /* CALCULO DE MESES EXACTOS */
                            $dias_resto = $calcular;
                            $opc = 2;
                            for ($i = 0; $i <= $opc; $i++) {
                                if ($calcular >= 30) {
                                    $mes_contador = $mes_contador + 1;
                                    $calcular = $calcular - 30;
                                }
                            }
                            /* ========================== */
                            /* CALCULO DE CONTADORES */
                            if ($mes_contador >= 9 && $color == 'azul') {
                                $matriz[2][$azul] = $unidade->serieunidad;
                                $azul = $azul + 1;
                            }
                            if ($mes_contador >= 5 && $mes_contador <= 8 && $color == 'verde') {
                                $matriz[3][$verde] = $unidade->serieunidad;
                                $verde = $verde + 1;
                            }
                            if ($mes_contador >= 2 && $mes_contador <= 4 && $color == 'amarillo') {
                                $matriz[4][$amarillo] = $unidade->serieunidad;
                                $amarillo = $amarillo + 1;
                            }
                            if ($mes_contador == 1 && $uno == 'nulo' && $color == 'rojo') {
                                if ($calcular == 0) {
                                    $matriz[5][$rojo] = $unidade->serieunidad;
                                    $rojo = $rojo + 1;
                                } else {
                                    $matriz[5][$rojo] = $unidade->serieunidad;
                                    $rojo = $rojo + 1;
                                }
                            }
                            if ($mes_contador == 1 && $uno == 'uno' && $color == 'rojo') {
                                $matriz[5][$rojo] = $unidade->serieunidad;
                                $rojo = $rojo + 1;
                            }
                            if ($mes_contador == 0 && $dias_exactos > 0 && $color == 'rojo') {
                                $matriz[5][$rojo] = $unidade->serieunidad;
                                $rojo = $rojo + 1;
                            }
                            if ($mes_contador == 0 && $dias_exactos <= 0 && $color == 'expirado') {
                                $matriz[6][$expirado] = $unidade->serieunidad;
                                $expirado = $expirado + 1;
                            }
                        }
                    }
                }
                /* ========================================== MANTENIMIENTO KILOMETRAJE ========================================== */
                if ($unidade->tipomantenimiento == 'Kilometraje' && $frecuencia == 'kilometro') {
                    if ($unidade->$tipo == $mstipo) {
                        if ($color == $sin) {
                            $matriz[1][$sin_seguro] = $unidade->serieunidad;
                            $sin_seguro = $sin_seguro + 1;
                        }
                    } else {
                        $km_contador = (int)$unidade->kilometros_contador;
                        $frecuenciakm = (int)$unidade->frecuencia_mante;
                        $km_actual = (int)$unidade->kilometros_actuales;
                        $diferencia = $frecuenciakm + $km_actual - $km_contador;
                        if ($km_contador >= $frecuenciakm + $km_actual && $color == 'expirado') {
                            $matriz[6][$expirado] = $unidade->serieunidad;
                            $expirado = $expirado + 1;
                        } else {
                            if ($km_contador < $frecuenciakm + $km_actual) {
                                if ($diferencia >= 500 && $color == 'azul') {
                                    $matriz[2][$azul] = $unidade->serieunidad;
                                    $azul = $azul + 1;
                                }
                                if ($diferencia >= 300 && $diferencia < 500 && $color == 'verde') {
                                    $matriz[3][$verde] = $unidade->serieunidad;
                                    $verde = $verde + 1;
                                }
                                if ($diferencia >= 100 && $diferencia < 300 && $color == 'amarillo') {
                                    $matriz[4][$amarillo] = $unidade->serieunidad;
                                    $amarillo = $amarillo + 1;
                                }
                                if ($diferencia >= 1 && $diferencia < 100 && $color == 'rojo') {
                                    $matriz[5][$rojo] = $unidade->serieunidad;
                                    $rojo = $rojo + 1;
                                }
                            }
                        }
                    }
                }
                /* ====================================================================================================== */
            }
            if ($unidade->tipo == 'Unidad Habitacional o Comercial' && $tipo == 'fumigacion') {
                if ($frecuencia == 'fecha') {
                    if ($unidade->$tipo == $mstipo) {
                        if ($color == $sin) {
                            $matriz[1][$sin_seguro] = $unidade->direccion;
                            $sin_seguro = $sin_seguro + 1;
                        }
                    } else {
                        /* FECHA LICENCIA */
                        $vencimiento_dia = substr($unidade->$fecha, 8, 2);
                        $vencimiento_mes = substr($unidade->$fecha, 5, 2);
                        $vencimiento_año = substr($unidade->$fecha, 0, 4);
                        $vencimiento_mes = (int)$vencimiento_mes + (int) $unidade->frecuencia_fumiga;
                        if ($vencimiento_mes > 12) {
                            $vencimiento_año = $vencimiento_año + 1;
                            $vencimiento_mes = $vencimiento_mes - 12;
                        }
                        /* FECHA ACTUAL */
                        $año_actual = date('Y');
                        $mes_actual = date('n');
                        $dia_actual = date('d');
                        /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
                        $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
                        /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
                        $uno = 'nulo';
                        $calcular = 0;
                        if ($diferencia_año >= 1) {
                            $meses = $diferencia_año * 12 + 12;
                            $operacion_1 = $meses - (int) $mes_actual;
                            $operacion_2 = 12 - (int) $vencimiento_mes;
                            $operacion_3 = $operacion_1 - $operacion_2;
                            $meses = $operacion_3;
                        } else {
                            $meses = (int) $vencimiento_mes - (int) $mes_actual;
                        }
                        if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                            $uno = 'uno';
                            $calcular = 0;
                        } else {
                            $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                            $direstantes = (int) $cantidaddias - (int) $dia_actual;
                            $calcular = $direstantes + (int) $vencimiento_dia;
                        }
                        /* CALCULO DE DIAS EXACTOS */
                        $dias_exactos = 0;
                        $contador_1 = 0;
                        $contador_2 = 0;
                        $cuenta_mes = $mes_actual;
                        $operacion_1 = 0;
                        $mes_contador = 0;
                        for ($i = 0; $i <= $meses; $i++) {
                            if ($uno == 'uno') {
                                $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                                $i = $meses + 1;
                            } else {
                                if ($contador_1 == 0) {
                                    $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                    $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                                    $dias_exactos = $dias_exactos + $operacion_2;
                                    $contador_1 = 1;
                                } else {
                                    if ($i == $meses) {
                                        $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                                    } else {
                                        $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                                        $dias_exactos = $dias_exactos + (int) $operacion_1;
                                        $mes_contador = $mes_contador + 1;
                                    }
                                }
                                if ($cuenta_mes == 12) {
                                    $contador_2 = $contador_2 + 1;
                                    $cuenta_mes = 1;
                                } else {
                                    $cuenta_mes = $cuenta_mes + 1;
                                }
                            }
                        }
                        /* CALCULO DE MESES EXACTOS */
                        $dias_resto = $calcular;
                        $opc = 2;
                        for ($i = 0; $i <= $opc; $i++) {
                            if ($calcular >= 30) {
                                $mes_contador = $mes_contador + 1;
                                $calcular = $calcular - 30;
                            }
                        }
                        /* ========================== */
                        /* CALCULO DE CONTADORES */
                        if ($mes_contador >= 9 && $color == 'azul') {
                            $matriz[2][$azul] = $unidade->direccion;
                            $azul = $azul + 1;
                        }
                        if ($mes_contador >= 5 && $mes_contador <= 8 && $color == 'verde') {
                            $matriz[3][$verde] = $unidade->direccion;
                            $verde = $verde + 1;
                        }
                        if ($mes_contador >= 2 && $mes_contador <= 4 && $color == 'amarillo') {
                            $matriz[4][$amarillo] = $unidade->direccion;
                            $amarillo = $amarillo + 1;
                        }
                        if ($mes_contador == 1 && $uno == 'nulo' && $color == 'rojo') {
                            if ($calcular == 0) {
                                $matriz[5][$rojo] = $unidade->direccion;
                                $rojo = $rojo + 1;
                            } else {
                                $matriz[5][$rojo] = $unidade->direccion;
                                $rojo = $rojo + 1;
                            }
                        }
                        if ($mes_contador == 1 && $uno == 'uno' && $color == 'rojo') {
                            $matriz[5][$rojo] = $unidade->direccion;
                            $rojo = $rojo + 1;
                        }
                        if ($mes_contador == 0 && $dias_exactos > 0 && $color == 'rojo') {
                            $matriz[5][$rojo] = $unidade->direccion;
                            $rojo = $rojo + 1;
                        }
                        if ($mes_contador == 0 && $dias_exactos <= 0 && $color == 'expirado') {
                            $matriz[6][$expirado] = $unidade->direccion;
                            $expirado = $expirado + 1;
                        }
                    }
                }
            }
        }
        return $matriz;
        /* ====================================================================================================== */
    }
    /* =============================================== //BUG:OPERADORES  =============================================== */
    public function operadores($color, $tipo)
    {
        $azul = 0;
        $verde = 0;
        $amarillo = 0;
        $rojo = 0;
        $expirado = 0;
        $operadores = Operadore::all();
        $matriz[1][0] = 'vacio';
        $matriz[2][0] = 'vacio';
        $matriz[3][0] = 'vacio';
        $matriz[4][0] = 'vacio';
        $matriz[5][0] = 'vacio';
        $matriz[6][0] = 'vacio';
        foreach ($operadores as $operadore) {
            /* FECHA LICENCIA */
            $vencimiento_dia = substr($operadore->$tipo, 8, 2);
            $vencimiento_mes = substr($operadore->$tipo, 5, 2);
            $vencimiento_año = substr($operadore->$tipo, 0, 4);
            /* FECHA ACTUAL */
            $año_actual = date('Y');
            $mes_actual = date('n');
            $dia_actual = date('d');
            /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
            $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
            /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
            $uno = 'nulo';
            $calcular = 0;
            if ($diferencia_año >= 1) {
                $meses = $diferencia_año * 12 + 12;
                $operacion_1 = $meses - (int) $mes_actual;
                $operacion_2 = 12 - (int) $vencimiento_mes;
                $operacion_3 = $operacion_1 - $operacion_2;
                $meses = $operacion_3;
            } else {
                $meses = (int) $vencimiento_mes - (int) $mes_actual;
            }
            if ((int) $año_actual == (int) $vencimiento_año && (int) $mes_actual == (int) $vencimiento_mes) {
                $uno = 'uno';
                $calcular = 0;
            } else {
                $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
                $direstantes = (int) $cantidaddias - (int) $dia_actual;
                $calcular = $direstantes + (int) $vencimiento_dia;
            }
            /* CALCULO DE DIAS EXACTOS */
            $dias_exactos = 0;
            $contador_1 = 0;
            $contador_2 = 0;
            $cuenta_mes = $mes_actual;
            $operacion_1 = 0;
            $mes_contador = 0;
            for ($i = 0; $i <= $meses; $i++) {
                if ($uno == 'uno') {
                    $dias_exactos = (int) $vencimiento_dia - (int) $dia_actual;
                    $i = $meses + 1;
                } else {
                    if ($contador_1 == 0) {
                        $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                        $operacion_2 = (int) $operacion_1 - (int) $dia_actual;
                        $dias_exactos = $dias_exactos + $operacion_2;
                        $contador_1 = 1;
                    } else {
                        if ($i == $meses) {
                            $dias_exactos = $dias_exactos + (int) $vencimiento_dia;
                        } else {
                            $operacion_1 = cal_days_in_month(CAL_GREGORIAN, $cuenta_mes, $año_actual + $contador_2);
                            $dias_exactos = $dias_exactos + (int) $operacion_1;
                            $mes_contador = $mes_contador + 1;
                        }
                    }
                    if ($cuenta_mes == 12) {
                        $contador_2 = $contador_2 + 1;
                        $cuenta_mes = 1;
                    } else {
                        $cuenta_mes = $cuenta_mes + 1;
                    }
                }
            }
            /* CALCULO DE MESES EXACTOS */
            $dias_resto = $calcular;
            $opc = 2;
            for ($i = 0; $i <= $opc; $i++) {
                if ($calcular >= 30) {
                    $mes_contador = $mes_contador + 1;
                    $calcular = $calcular - 29;
                }
            }
            /* ========================== */
            /* CALCULO DE CONTADORES */
            if ($mes_contador >= 9 && $color == 'azul') {
                $matriz[2][$azul] = $operadore->nombreoperador;
                $azul = $azul + 1;
            }
            if ($mes_contador >= 5 && $mes_contador <= 8 && $color == 'verde') {
                $matriz[3][$verde] = $operadore->nombreoperador;
                $verde = $verde + 1;
            }
            if ($mes_contador >= 2 && $mes_contador <= 4 && $color == 'amarillo') {
                $matriz[4][$amarillo] = $operadore->nombreoperador;
                $amarillo = $amarillo + 1;
            }
            if ($mes_contador == 1 && $uno == 'nulo' && $color == 'rojo') {
                if ($calcular == 0) {
                    $matriz[5][$rojo] = $operadore->nombreoperador;
                    $rojo = $rojo + 1;
                } else {
                    $matriz[5][$rojo] = $operadore->nombreoperador;
                    $rojo = $rojo + 1;
                }
            }
            if ($mes_contador == 1 && $uno == 'uno' && $color == 'rojo') {
                $matriz[5][$rojo] = $operadore->nombreoperador;
                $rojo = $rojo + 1;
            }
            if ($mes_contador == 0 && $dias_exactos > 0 && $color == 'rojo') {
                $matriz[5][$rojo] = $operadore->nombreoperador;
                $rojo = $rojo + 1;
            }
            if ($mes_contador == 0 && $dias_exactos <= 0 && $color == 'expirado') {
                $matriz[6][$expirado] = $operadore->nombreoperador;
                $expirado = $expirado + 1;
            }
        }
        return $matriz;
    }
    public function pago()
    {
    }
}
class ReportesController extends CalculoFechas
{
    /* ============================================= DASHBOARD ==================================================== */
    public function dashboard()
    {
        return view('tabla_reportes.dashboard');
    }
    /* ============================================================================================================= */
    /* ============================================= REPORTES GRAFICAS ============================================= */
    public function seguros($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'seguro_fecha', 'seguro', 'Sin Seguro', 'sin seguro', 'fecha');
        $unidades = Unidade::all();
        return view('reportes.seguros', compact('calculo', 'color', 'unidades'));
    }
    public function vambiental($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'verificacion_fecha', 'verificacion', 'Sin Verificación', 'sin verificacion', 'fecha');
        $unidades = Unidade::all();
        return view('reportes.vambiental', compact('calculo', 'color', 'unidades'));
    }
    public function vfisicas($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'verificacion_fecha2', 'verificacion2', 'Sin Verificación', 'sin verificacion', 'fecha');
        $unidades = Unidade::all();
        return view('reportes.vfisicos', compact('calculo', 'color', 'unidades'));
    }
    public function mantenimientosk($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'mantenimiento_fecha', 'mantenimiento', 'Sin Mantenimiento', 'sin mantenimiento', 'kilometro');
        $unidades = Unidade::all();
        return view('reportes.kmantenimiento', compact('calculo', 'color', 'unidades'));
    }
    public function mantenimientos($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'mantenimiento_fecha', 'mantenimiento', 'Sin Mantenimiento', 'sin mantenimiento', 'fecha');
        $unidades = Unidade::all();
        return view('reportes.mantenimiento', compact('calculo', 'color', 'unidades'));
    }
    public function fumigaciones($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'lapsofumigacion', 'fumigacion', 'Sin Fumigación', 'sin fumigacion', 'fecha');
        $unidades = Unidade::all();
        return view('reportes.fumigacion', compact('calculo', 'color', 'unidades'));
    }
    public function medico($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::operadores($color, 'fechavencimientomedico');
        $operadores = Operadore::all();
        return view('reportes.medico', compact('calculo', 'color', 'operadores'));
    }
    public function licencia($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::operadores($color, 'fechavencimientolicencia');
        $operadores = Operadore::all();
        return view('reportes.licencias', compact('calculo', 'color', 'operadores'));
    }
    /* ============================================================================================================= */
    /* ============================================= REPORTES EXCEL================================================= */
    public function reporte_flotilla()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_flotilla', compact('unidades'));
    }
    public function reporte_seguros()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_seguros', compact('unidades'));
    }
    public function reporte_veri()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_veri', compact('unidades'));
    }
    public function reporte_preventivo()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_preventivo', compact('unidades'));
    }
    public function reporte_fumigaciones()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_fumigaciones', compact('unidades'));
    }
    public function reporte_operadores()
    {
        $operadores = Operadore::all();
        return view('tabla_reportes.reporte_operador', compact('operadores'));
    }
    public function reporte_semanal()
    {
        $unidades = Unidade::all();
        return view('tabla_reportes.reporte_semanal', compact('unidades'));
    }
    public function reporte_dia()
    {
        $unidades = Unidade::all();
        return view('tabla_reportes.reporte_dia', compact('unidades'));
    }
    public function reporte_servicios()
    {
        $unidades = Unidade::all();
        return view('tabla_reportes.reporte_servicios', compact('unidades'));
    }
    public function reporte_individual()
    {
        $operadores = Operadore::all();
        return view('tabla_reportes.reporte_individual', compact('operadores'));
    }
    public function reporte_satisfaccion()
    {
        $unidades = Unidade::all();
        return view('tabla_reportes.reporte_satisfaccion', compact('unidades'));
    }
    public function reporte_individualv()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_individualv', compact('unidades'));
    }
    public function reporte_bd()
    {
        $unidades = Unidade::where('tipo', '=', 'Unidad Vehicular')->get();
        return view('tabla_reportes.reporte_bd', compact('unidades'));
    }
    /* ============================================================================================================= */
    /* ============================================= EXCELES FUNCIONES ============================================= */
    public function reporte_flotillasexcel(Request $request)
    {
        /* return (new SegurosExport($unidad))->download('Seguros_unidad_' . $unidad . '.xlsx'); */
        $tipo = $request['filtroveri'];
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            if ($tipo == 'Ambiental') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final))->download('Reporte_Flotillas_Ambientales.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final))->download('Reporte_Flotillas_F_Mecanicas.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final))->download('Reporte_Flotillas_Ambas_Veri.xlsx');
            }
        } else {
            if ($tipo == 'Ambiental') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final))->download('Reporte_Flotillas_Ambientales_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Fisica') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final))->download('Reporte_Flotillas_F_Mecanicas_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
            if ($tipo == 'Ambas') {
                return (new ReporteFlotillasExport($tipo, $cli, $inicio, $final))->download('Reporte_Flotillas_Ambas_Veri_' . str_replace(' ', '_', $cli) . '.xlsx');
            }
        }
    }
    public function reporte_segurosexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReposteSegurosExport($cli, $inicio, $final))->download('Reporte_Seguros.xlsx');
        } else {
            return (new ReposteSegurosExport($cli, $inicio, $final))->download('Reporte_Seguros_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_veriexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        /* $final = "" . $request['filtrofechafinal']; */
        /* $inicio = "" . $request['filtrofechainicio']; */
        if ($cli == 'todos') {
            return (new ReporteVeriExport($cli))->download('Reporte_Verificaciones.xlsx');
        } else {
            return (new ReporteVeriExport($cli))->download('Reporte_Verificaciones_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_fumigacionesexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteFumigacionesExport($cli, $inicio, $final))->download('Reporte_Verificaciones.xlsx');
        } else {
            return (new ReporteFumigacionesExport($cli, $inicio, $final))->download('Reporte_Verificaciones_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_semanalexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteSemanalExport($cli, $inicio, $final))->download('Reporte_Semanal.xlsx');
        } else {
            return (new ReporteSemanalExport($cli, $inicio, $final))->download('Reporte_Semanal_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_diaexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Dia.xlsx');
        } else {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Dia_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_serviciosexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Servicios.xlsx');
        } else {
            return (new ReporteDiaExport($cli, $inicio, $final))->download('Reporte_Servicios_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    public function reporte_individualexcel(Request $request)
    {
        /* return Excel::download(new ReposteSegurosExport, 'Reporte_Seguros.xlsx'); */
        $cli = $request['filtrocli'];
        $final = "" . $request['filtrofechafinal'];
        $inicio = "" . $request['filtrofechainicio'];
        if ($cli == 'todos') {
            return (new ReporteIndividualExport($cli, $inicio, $final))->download('Reporte_individual.xlsx');
        } else {
            return (new ReporteIndividualExport($cli, $inicio, $final))->download('Reporte_individual_' . str_replace(' ', '_', $cli) . '.xlsx');
        }
    }
    /* ============================================================================================================= */
}
