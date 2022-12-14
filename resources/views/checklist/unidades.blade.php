@php
    /*
                                                                =========================== VERDE ===========================
                                                                    <div class="col-2">
                                                                        <div class="input-group">
                                                                            <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                                                            style="font-size: 2rem; color: rgb(0, 128, 55);"></span>CON
                                                                            VERIFICACION</label>
                                                                        </div>
                                                                    </div>
                                                                =========================== ROJO ===========================
                                                                    <div class="col-2">
                                                                        <div class="input-group">
                                                                            <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                                                                            style="font-size: 2rem; color: rgb(255, 0, 0);"></span> SIN
                                                                            VERIFICACION</label>
                                                                        </div>
                                                                    </div>

                                                                =========================== AMARILLO ===========================
                                                                    <div class="col-2">
                                                                        <div class="input-group">
                                                                            <label class="label"> <span id="boot-icon" class="bi bi-check-circle-fill"
                                                                                 style="font-size: 2rem; color: rgb(255, 210, 48);"></span> SIN
                                                                            VERIFICACION</label>
                                                                        </div>
                                                                    </div>
                                                                =========================== AZUL ===========================
                                                                    <div class="col-2">
                                                                        <div class="input-group">
                                                                            <label class="label"> <span id="boot-icon" class="bi bi-check-circle-fill"
                                                                                style="font-size: 2rem; color: rgb(0, 0, 255);"></span> SIN
                                                                            VERIFICACION</label>
                                                                        </div>
                                                                    </div>

                                                                */

    $unidad = $_POST['unidad_change'];
    $cadena_1 = ' ';
    use App\Models\Unidade;
    $unidades = Unidade::where('serieunidad', '=', $unidad)->get();
    /* ========================= //BUG: SEGUROS ========================= */
    foreach ($unidades as $unidade) {
        if ($unidade->seguro == 'Sin Seguro') {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Seguro</label>
                    </div>
                </div>';
        } else {
            /* FECHA LICENCIA */
            $vencimiento_dia = substr($unidade->seguro_fecha, 8, 2);
            $vencimiento_mes = substr($unidade->seguro_fecha, 5, 2);
            $vencimiento_año = substr($unidade->seguro_fecha, 0, 4);
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
        }
        if ($mes_contador >= 9) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 5 && $mes_contador <= 8) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 2 && $mes_contador <= 4) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 1 && $uno == 'nulo') {
            if ($calcular == 0) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
            } else {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
            }
        }
        if ($mes_contador == 1 && $uno == 'uno') {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos > 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Seguro</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos <= 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Seguro</label>
                    </div>
                </div>';
        }
    }
    /* ========================================================================== */

    /* ========================= //BUG: V.AMBIENTAL ========================= */
    if ($unidade->verificacion == 'Sin Verificación') {
        $cadena_1 =
            $cadena_1 .
            '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Verificación A.</label>
                    </div>
                </div>';
    } else {
        /* FECHA LICENCIA */
        $vencimiento_dia = substr($unidade->verificacion_fecha, 8, 2);
        $vencimiento_mes = substr($unidade->verificacion_fecha, 5, 2);
        $vencimiento_año = substr($unidade->verificacion_fecha, 0, 4);
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

        if ($mes_contador >= 9) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 5 && $mes_contador <= 8) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 2 && $mes_contador <= 4) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 1 && $uno == 'nulo') {
            if ($calcular == 0) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
            } else {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
            }
        }
        if ($mes_contador == 1 && $uno == 'uno') {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos > 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación A.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos <= 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Verificación A.</label>
                    </div>
                </div>';
        }
    }

    /* ========================================================================== */
    /* ========================= //BUG: V.FISICOMECANICA ========================= */
    if ($unidade->verificacion2 == 'Sin Verificación') {
        $cadena_1 =
            $cadena_1 .
            '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Verificación F-M.</label>
                    </div>
                </div>';
    } else {
        /* FECHA LICENCIA */
        $vencimiento_dia = substr($unidade->verificacion_fecha2, 8, 2);
        $vencimiento_mes = substr($unidade->verificacion_fecha2, 5, 2);
        $vencimiento_año = substr($unidade->verificacion_fecha2, 0, 4);
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

        if ($mes_contador >= 9) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 5 && $mes_contador <= 8) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 2 && $mes_contador <= 4) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 1 && $uno == 'nulo') {
            if ($calcular == 0) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
            } else {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
            }
        }
        if ($mes_contador == 1 && $uno == 'uno') {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos > 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Verificación F-M.</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos <= 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Verificación F-M.</label>
                    </div>
                </div>';
        }
    }
    /* ========================================================================== */
    /* ========================= //BUG: MANTENIMIENTO ========================= */
    if ($unidade->mantenimiento == 'Sin Mantenimiento') {
        $cadena_1 =
            $cadena_1 .
            '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Mantenimiento</label>
                    </div>
                </div>';
    } else {
        if ($unidade->tipomantenimiento == 'Fecha') {
            /* ===================== CALCULO_DE_FECHAS_MANTENIMIENTO ===================== */

            /* FECHA LICENCIA */
            $vencimiento_dia = substr($unidade->mantenimiento_fecha, 8, 2);
            $vencimiento_mes = substr($unidade->mantenimiento_fecha, 5, 2);
            $vencimiento_año = substr($unidade->mantenimiento_fecha, 0, 4);
            $vencimiento_mes = $vencimiento_mes + $unidade->frecuencia_mante;
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
            $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
            $direstantes = (int) $cantidaddias - (int) $dia_actual;
            $dias_resto = $calcular;
            $opc = 2;
            for ($i = 0; $i <= $opc; $i++) {
                if ($calcular >= 30) {
                    $mes_contador = $mes_contador + 1;
                    $calcular = $calcular - 30;
                }
            }
            if ($mes_contador >= 9) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
            }
            if ($mes_contador >= 5 && $mes_contador <= 8) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
            }
            if ($mes_contador >= 2 && $mes_contador <= 4) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
            }
            if ($mes_contador == 1 && $uno == 'nulo') {
                if ($calcular == 0) {
                    $cadena_1 =
                        $cadena_1 .
                        '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
                } else {
                    $cadena_1 =
                        $cadena_1 .
                        '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
                }
            }
            if ($mes_contador == 1 && $uno == 'uno') {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
            }
            if ($mes_contador == 0 && $dias_exactos > 0) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
            }
            if ($mes_contador == 0 && $dias_exactos <= 0) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Mantenimiento</label>
                    </div>
                </div>';
            }
        }
        /* KILOMETROS */
        if ($unidade->tipomantenimiento == 'Kilometraje') {
            $km_contador = $unidade->kilometros_contador;
            $frecuencia = $unidade->frecuencia_mante;
            $km_actual = $unidade->kilometros_actuales;
            $diferencia = $frecuencia + $km_actual - $km_contador;
            if ($km_contador >= $frecuencia + $km_actual) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Mantenimiento</label>
                    </div>
                </div>';
            }
            if ($km_contador < $frecuencia + $km_actual) {
                $diferencia = $frecuencia + $km_actual - $km_contador;
                if ($diferencia >= 1 && $diferencia < 100) {
                    $cadena_1 =
                        $cadena_1 .
                        '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
                }
                if ($diferencia >= 100 && $diferencia < 300) {
                    $cadena_1 =
                        $cadena_1 .
                        '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
                }
                if ($diferencia >= 300 && $diferencia < 500) {
                    $cadena_1 =
                        $cadena_1 .
                        '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
                }
                if ($diferencia >= 500) {
                    $cadena_1 =
                        $cadena_1 .
                        '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Mantenimiento</label>
                                    </div>
                                </div>';
                }
            }
        }
    }
    /* ========================================================================== */

    /* ========================================================================== */
    /* ========================= //BUG: FUMIGACION ========================= */
    if ($unidade->fumigacion == 'Sin Fumigación') {
        $cadena_1 =
            $cadena_1 .
            '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Fumigación</label>
                    </div>
                </div>';
    } else {
        /* FECHA LICENCIA */
        $vencimiento_dia = substr($unidade->lapsofumigacion, 8, 2);
        $vencimiento_mes = substr($unidade->lapsofumigacion, 5, 2);
        $vencimiento_año = substr($unidade->lapsofumigacion, 0, 4);
        $vencimiento_mes = $vencimiento_mes + $unidade->frecuencia_fumiga;
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
        $cantidaddias = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $año_actual);
        $direstantes = (int) $cantidaddias - (int) $dia_actual;
        $dias_resto = $calcular;
        $opc = 2;
        for ($i = 0; $i <= $opc; $i++) {
            if ($calcular >= 30) {
                $mes_contador = $mes_contador + 1;
                $calcular = $calcular - 30;
            }
        }
        if ($mes_contador >= 9) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 5 && $mes_contador <= 8) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador >= 2 && $mes_contador <= 4) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 1 && $uno == 'nulo') {
            if ($calcular == 0) {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
            } else {
                $cadena_1 =
                    $cadena_1 .
                    '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
            }
        }
        if ($mes_contador == 1 && $uno == 'uno') {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos > 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><span id="boot-icon" class="bi bi-check-circle-fill"
                                        style="font-size: 2rem; color: rgb(0, 128, 55);"></span>Con Fumigación</label>
                                    </div>
                                </div>';
        }
        if ($mes_contador == 0 && $dias_exactos <= 0) {
            $cadena_1 =
                $cadena_1 .
                '<div class="col-2">
                    <div class="input-group">
                        <label class="label"><span id="boot-icon" class="bi bi-x-circle-fill"
                        style="font-size: 2rem; color: rgb(255, 0, 0);"></span>Sin Fumigación</label>
                    </div>
                </div>';
        }
    }

    echo $cadena_1;
@endphp
