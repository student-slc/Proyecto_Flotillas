<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguro;
use App\Models\Unidade;

class CalculoFechas  extends Controller
{
    public function fechas($color, $fecha, $tipo, $mstipo,$sin)
    {
        /* =============================================== GENERAL =============================================== */
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
        return $matriz;
        /* ====================================================================================================== */
    }
}





class ReportesController extends CalculoFechas
{
    public function seguros($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'seguro_fecha', 'seguro', 'Sin Seguro','sin seguro');
        $unidades=Unidade::all();
        return view('reportes.seguros', compact('calculo','color','unidades'));
    }
    public function vambiental($color)
    {
        /* $color,$fecha,$tipo,$mstipo */
        $calculo = CalculoFechas::fechas($color, 'verificacion_fecha', 'verificacion', 'Sin Verificación','sin verificacion');
        $unidades=Unidade::all();
        return view('reportes.vambiental', compact('calculo','color','unidades'));
    }
    public function vfisicas($color)
    {
        return view('reportes.vfisicos');
    }
    public function mantenimientos($color)
    {
        return view('reportes.mantenimiento');
    }
    public function fumigaciones($color)
    {
        return view('reportes.fumigaciones');
    }
}
