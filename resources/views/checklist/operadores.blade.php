@php
    $operador = $_POST['operador_change'];
    $cadena_operador = ' ';
    use App\Models\Operadore;
    $operadores = Operadore::where('id', '=', $operador)->get();
    foreach ($operadores as $operadore) {
        $cadena_operador = $cadena_operador . '<h2 style="text-align: center" class="title">Nombre del operador: ' . $operadore->nombreoperador . '</h2><div class="row row-space">';
        /* ========================= //BUG: MEDICO ========================= */
        /* FECHA LICENCIA */
        $vencimiento_dia = substr($operadore->fechavencimientomedico, 8, 2);
        $vencimiento_mes = substr($operadore->fechavencimientomedico, 5, 2);
        $vencimiento_año = substr($operadore->fechavencimientomedico, 0, 4);
        /* FECHA ACTUAL */
        $año_actual = date('Y');
        $mes_actual = date('n');
        $dia_actual = date('d');
        /* OBTIENE LA DIFERENCIA DE AÑO ENTRE FECHA ACTUAL Y FECHA A VENCER */
        $diferencia_año = (int) $vencimiento_año - (int) $año_actual;
        /* CALCULO DE NUMERO DE MESES ENTRE FECHA ACTUAL Y VENCIMIENTO */
        $uno = 'nulo';
        $calcular = 0;
        $mes_contador = 1;
        $dias_exactos = 1;
        //cambio
        if ($diferencia_año >= 1) {
            $meses = $diferencia_año * 12 + 12;
            $operacion_1 = $meses - (int) $mes_actual;
            $operacion_2 = 12 - (int) $vencimiento_mes;
            $operacion_3 = $operacion_1 - $operacion_2;
            $meses = $operacion_3;
        } else {
            if ($diferencia_año == 0) {
                $meses = (int) $vencimiento_mes - (int) $mes_actual;
            } else {
                $mes_contador = 0;
                $dias_exactos = 0;
            }
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
        $contador_1 = 0;
        $contador_2 = 0;
        $cuenta_mes = $mes_actual;
        $operacion_1 = 0;
        if ($mes_contador == 1 && $dias_exactos == 1) {
            $mes_contador = 0;
            $dias_exactos = 0;
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
        }

        if ($mes_contador >= 9) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 5 && $mes_contador <= 8) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 2 && $mes_contador <= 4) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 1 && $uno == 'nulo') {
            if ($calcular == 0) {
                $cadena_operador =
                    $cadena_operador .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
            } else {
                $cadena_operador =
                    $cadena_operador .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
            }
        }
        if ($mes_contador == 1 && $uno == 'uno') {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos > 0) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos <= 0) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Seguro</label>
                    </div>
                </div>';
        }
        /* ========================= //BUG: MEDICO ========================= */
        /* FECHA LICENCIA */
        $vencimiento_dia = substr($operadore->fechavencimientolicencia, 8, 2);
        $vencimiento_mes = substr($operadore->fechavencimientolicencia, 5, 2);
        $vencimiento_año = substr($operadore->fechavencimientolicencia, 0, 4);
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

        if ($mes_contador >= 9) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 5 && $mes_contador <= 8) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 2 && $mes_contador <= 4) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 1 && $uno == 'nulo') {
            if ($calcular == 0) {
                $cadena_operador =
                    $cadena_operador .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
            } else {
                $cadena_operador =
                    $cadena_operador .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
            }
        }
        if ($mes_contador == 1 && $uno == 'uno') {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos > 0) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Licencia</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos <= 0) {
            $cadena_operador =
                $cadena_operador .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Licencia</label>
                    </div>
                </div>';
        }
    }
    echo $cadena_operador . '</div>';
@endphp
