@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Resumen Total</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    {{-- OBTENGO TODAS LAS UNIDADES --}}
                    @php
                        use App\Models\Unidade;
                        use App\Models\Operadore;
                        $operadores = Operadore::all();
                        $unidades = Unidade::all();
                        $unidadesk = Unidade::where('tipomantenimiento', '=', 'Kilometraje')->get();
                        $unidadest = Unidade::where('tipomantenimiento', '=', 'Fecha')->get();
                    @endphp
                    @php
                        $azul = 0;
                        $verde = 0;
                        $amarillo = 0;
                        $rojo = 0;
                        $expirado = 0;
                    @endphp
                    @foreach ($operadores as $operadore)
                        {{-- ===================//BUG: MEDICO =================== --}}
                        @php
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
                        @endphp
                        {{-- ============================================================== --}}
                        {{-- ========================== IF PARA MOSTRAR =================== --}}
                        @if ($mes_contador >= 9)
                            @php
                                $azul = $azul + 1;
                            @endphp
                        @endif
                        @if ($mes_contador >= 5 && $mes_contador <= 8)
                            @php
                                $verde = $verde + 1;
                            @endphp
                        @endif
                        @if ($mes_contador >= 2 && $mes_contador <= 4)
                            @php
                                $amarillo = $amarillo + 1;
                            @endphp
                        @endif
                        @if ($mes_contador == 1 && $uno == 'nulo')
                            @if ($calcular == 0)
                                @php
                                    $rojo = $rojo + 1;
                                @endphp
                            @else
                                @php
                                    $rojo = $rojo + 1;
                                @endphp
                            @endif
                        @endif
                        @if ($mes_contador == 1 && $uno == 'uno')
                            @php
                                $rojo = $rojo + 1;
                            @endphp
                        @endif
                        @if ($mes_contador == 0 && $dias_exactos > 0)
                            @php
                                $rojo = $rojo + 1;
                            @endphp
                        @endif
                        @if ($mes_contador == 0 && $dias_exactos <= 0)
                            @php
                                $expirado = $expirado + 1;
                            @endphp
                        @endif
                        {{-- ============================================================== --}}
                    @endforeach
                    {{--  --}}
                    @php
                        $datos_opem = [$azul, $verde, $amarillo, $rojo, $expirado];
                    @endphp
                    {{--  --}}
                    <br>
                    <div class="card-deck mt-6">
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">CLIENTES STATUS PAGO</h5>
                            <canvas id="mmmmmmm" class="card-top"></canvas>
                        </div>
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">OPERADORES MEDICO</h5>
                            <canvas id="medico" class="card-top"></canvas>
                        </div>
                        {{-- ============================================================================= --}}
                        @php
                            $azul = 0;
                            $verde = 0;
                            $amarillo = 0;
                            $rojo = 0;
                            $expirado = 0;
                        @endphp
                        @foreach ($operadores as $operadore)
                            {{-- ===================//BUG: LICENCIAS =================== --}}
                            @php
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
                            @endphp
                            {{-- ============================================================== --}}
                            {{-- ========================== IF PARA MOSTRAR =================== --}}
                            @if ($mes_contador >= 9)
                                @php
                                    $azul = $azul + 1;
                                @endphp
                            @endif
                            @if ($mes_contador >= 5 && $mes_contador <= 8)
                                @php
                                    $verde = $verde + 1;
                                @endphp
                            @endif
                            @if ($mes_contador >= 2 && $mes_contador <= 4)
                                @php
                                    $amarillo = $amarillo + 1;
                                @endphp
                            @endif
                            @if ($mes_contador == 1 && $uno == 'nulo')
                                @if ($calcular == 0)
                                    @php
                                        $rojo = $rojo + 1;
                                    @endphp
                                @else
                                    @php
                                        $rojo = $rojo + 1;
                                    @endphp
                                @endif
                            @endif
                            @if ($mes_contador == 1 && $uno == 'uno')
                                @php
                                    $rojo = $rojo + 1;
                                @endphp
                            @endif
                            @if ($mes_contador == 0 && $dias_exactos > 0)
                                @php
                                    $rojo = $rojo + 1;
                                @endphp
                            @endif
                            @if ($mes_contador == 0 && $dias_exactos <= 0)
                                @php
                                    $expirado = $expirado + 1;
                                @endphp
                            @endif
                        @endforeach
                        {{-- ============================================================================= --}}
                        @php
                            $datos_opel = [$azul, $verde, $amarillo, $rojo, $expirado];
                        @endphp
                        {{--  --}}
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">OPERADORES LICENCIA</h5>
                            <canvas id="licencia" class="card-top"></canvas>
                        </div>
                    </div>
                    <br>
                    {{-- --}}
                    {{-- OBTENGO TODAS LAS UNIDADES --}}
                    {{-- ===================//BUG: SEGUROS =================== --}}
                    {{-- CALCULO DE FECHAS --}}
                    @php
                        $sin_seguro = 0;
                        $azul = 0;
                        $verde = 0;
                        $amarillo = 0;
                        $rojo = 0;
                        $expirado = 0;
                        $color = 'nada';
                    @endphp
                    @foreach ($unidades as $unidade)
                        @if ($unidade->tipo == 'Unidad Vehicular')
                            @if ($unidade->seguro == 'Sin Seguro')
                                @php
                                    $sin_seguro = $sin_seguro + 1;
                                @endphp
                            @else
                                @php
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
                                @endphp
                                {{-- ============================================================== --}}
                                {{-- ========================== IF PARA MOSTRAR =================== --}}
                                @if ($mes_contador >= 9)
                                    @php
                                        $azul = $azul + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador >= 5 && $mes_contador <= 8)
                                    @php
                                        $verde = $verde + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador >= 2 && $mes_contador <= 4)
                                    @php
                                        $amarillo = $amarillo + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador == 1 && $uno == 'nulo')
                                    @if ($calcular == 0)
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @else
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                @endif
                                @if ($mes_contador == 1 && $uno == 'uno')
                                    @php
                                        $rojo = $rojo + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador == 0 && $dias_exactos > 0)
                                    @php
                                        $rojo = $rojo + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador == 0 && $dias_exactos <= 0)
                                    @php
                                        $expirado = $expirado + 1;
                                    @endphp
                                @endif
                            @endif
                        @endif
                    @endforeach
                    @php
                        $datos_seguro = [$sin_seguro, $azul, $verde, $amarillo, $rojo, $expirado];
                    @endphp
                    {{--  --}}
                    <div class="card-deck mt-6">
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">SEGUROS</h5>
                            <canvas id="seguro" class="card-top"></canvas>
                        </div>
                        {{--  --}}
                        {{-- ============================================================================== --}}
                        {{-- ===================//BUG: V.AMBIENTAL =================== --}}
                        {{-- CALCULO DE FECHAS --}}
                        @php
                            $sin_ambiental = 0;
                            $azul = 0;
                            $verde = 0;
                            $amarillo = 0;
                            $rojo = 0;
                            $expirado = 0;
                        @endphp
                        @foreach ($unidades as $unidade)
                            @if ($unidade->tipo == 'Unidad Vehicular')
                                @if ($unidade->verificacion == 'Sin Verificación')
                                    @php
                                        $sin_ambiental = $sin_ambiental + 1;
                                    @endphp
                                @else
                                    @php
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
                                    @endphp
                                    {{-- ============================================================== --}}
                                    {{-- ========================== IF PARA MOSTRAR =================== --}}
                                    @if ($mes_contador >= 9)
                                        @php
                                            $azul = $azul + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador >= 5 && $mes_contador <= 8)
                                        @php
                                            $verde = $verde + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador >= 2 && $mes_contador <= 4)
                                        @php
                                            $amarillo = $amarillo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 1 && $uno == 'nulo')
                                        @if ($calcular == 0)
                                            @php
                                                $rojo = $rojo + 1;
                                            @endphp
                                        @else
                                            @php
                                                $rojo = $rojo + 1;
                                            @endphp
                                        @endif
                                    @endif
                                    @if ($mes_contador == 1 && $uno == 'uno')
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 0 && $dias_exactos > 0)
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 0 && $dias_exactos <= 0)
                                        @php
                                            $expirado = $expirado + 1;
                                        @endphp
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        @php
                            $datos_va = [$sin_ambiental, $azul, $verde, $amarillo, $rojo, $expirado];
                        @endphp
                        {{--  --}}
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">VERIFICACION AMBIENTAL</h5>
                            <canvas id="vambiental" class="card-top"></canvas>
                        </div>
                        {{-- </div> --}}
                        {{-- ============================================================================== --}}
                        {{-- OBTENGO TODAS LAS UNIDADES --}}
                        {{-- --}}
                        {{-- OBTENGO TODAS LAS UNIDADES --}}
                        {{-- ===================//BUG: V.FISICA =================== --}}
                        {{-- CALCULO DE FECHAS --}}
                        @php
                            $sin_ambiental = 0;
                            $azul = 0;
                            $verde = 0;
                            $amarillo = 0;
                            $rojo = 0;
                            $expirado = 0;
                        @endphp
                        @foreach ($unidades as $unidade)
                            @if ($unidade->tipo == 'Unidad Vehicular')
                                @if ($unidade->verificacion2 == 'Sin Verificación')
                                    @php
                                        $sin_ambiental = $sin_ambiental + 1;
                                    @endphp
                                @else
                                    @php
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
                                    @endphp
                                    {{-- ============================================================== --}}
                                    {{-- ========================== IF PARA MOSTRAR =================== --}}
                                    @if ($mes_contador >= 9)
                                        @php
                                            $azul = $azul + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador >= 5 && $mes_contador <= 8)
                                        @php
                                            $verde = $verde + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador >= 2 && $mes_contador <= 4)
                                        @php
                                            $amarillo = $amarillo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 1 && $uno == 'nulo')
                                        @if ($calcular == 0)
                                            @php
                                                $rojo = $rojo + 1;
                                            @endphp
                                        @else
                                            @php
                                                $rojo = $rojo + 1;
                                            @endphp
                                        @endif
                                    @endif
                                    @if ($mes_contador == 1 && $uno == 'uno')
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 0 && $dias_exactos > 0)
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 0 && $dias_exactos <= 0)
                                        @php
                                            $expirado = $expirado + 1;
                                        @endphp
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        {{--  --}}
                        @php
                            $datos_vfisica = [$sin_ambiental, $azul, $verde, $amarillo, $rojo, $expirado];
                        @endphp
                        {{--  --}}
                        {{-- <div class="card-deck mt-2"> --}}
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">VERIFICACIONES FISICO-MECANICAS</h5>
                            <canvas id="vfisica" class="card-top"></canvas>
                        </div>
                    </div>
                    {{-- ============================================================================== --}}
                    {{-- ===================//BUG: K.MANTENIMIENTO =================== --}}
                    {{-- CALCULO DE FECHAS --}}
                    @php
                        $sin_mantenimiento = 0;
                        $azul = 0;
                        $verde = 0;
                        $amarillo = 0;
                        $rojo = 0;
                        $expirado = 0;
                    @endphp
                    @foreach ($unidadesk as $unidade)
                        @if ($unidade->tipo == 'Unidad Vehicular')
                            @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                @php
                                    $sin_mantenimiento = $sin_mantenimiento + 1;
                                @endphp
                            @else
                                @if ($unidade->tipomantenimiento == 'Kilometraje')
                                    {{-- ============================================================== --}}
                                    {{-- ========================== IF PARA MOSTRAR =================== --}}
                                    @php
                                        $km_contador = $unidade->kilometros_contador;
                                        $frecuencia = $unidade->frecuencia_mante;
                                        $km_actual = $unidade->kilometros_actuales;
                                        $diferencia = $frecuencia + $km_actual - $km_contador;
                                    @endphp
                                    @if ($km_contador >= $frecuencia + $km_actual)
                                        @php
                                            $expirado = $expirado + 1;
                                        @endphp
                                    @else
                                        @if ($km_contador >= $frecuencia + $km_actual)
                                            @php
                                                $expirado = $expirado + 1;
                                            @endphp
                                        @endif
                                        @if ($km_contador < $frecuencia + $km_actual)
                                            @if ($diferencia >= 500)
                                                @php
                                                    $azul = $azul + 1;
                                                @endphp
                                            @endif
                                            @if ($diferencia >= 300 && $diferencia < 500)
                                                @php
                                                    $verde = $verde + 1;
                                                @endphp
                                            @endif
                                            @if ($diferencia >= 100 && $diferencia < 300)
                                                @php
                                                    $amarillo = $amarillo + 1;
                                                @endphp
                                            @endif
                                            @if ($diferencia >= 1 && $diferencia < 100)
                                                @php
                                                    $rojo = $rojo + 1;
                                                @endphp
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach
                    {{--  --}}
                    @php
                        $datos_mk = [$sin_mantenimiento, $azul, $verde, $amarillo, $rojo, $expirado];
                    @endphp
                    {{--  --}}
                    <br>
                    <div class="card-deck mt-6">
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">MANTENIMIENTO POR KILOMETRAJE</h5>
                            <canvas id="mkilometros" class="card-top"></canvas>
                        </div>
                        {{-- ============================================================================== --}}
                        {{-- ===================//BUG: T.MANTENIMIENTO =================== --}}
                        {{-- CALCULO DE FECHAS --}}
                        @php
                            $sin_mantenimiento = 0;
                            $azul = 0;
                            $verde = 0;
                            $amarillo = 0;
                            $rojo = 0;
                            $expirado = 0;
                        @endphp
                        @foreach ($unidadest as $unidade)
                            @if ($unidade->tipo == 'Unidad Vehicular')
                                @if ($unidade->mantenimiento == 'Sin Mantenimiento' && $unidade->tipomantenimiento == 'Fecha')
                                    @php
                                        $sin_mantenimiento = $sin_mantenimiento + 1;
                                    @endphp
                                @else
                                    @if ($unidade->tipomantenimiento == 'Fecha')
                                        @php
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
                                            $dias_resto = $calcular;
                                            $opc = 2;
                                            for ($i = 0; $i <= $opc; $i++) {
                                                if ($calcular >= 30) {
                                                    $mes_contador = $mes_contador + 1;
                                                    $calcular = $calcular - 30;
                                                }
                                            }
                                        @endphp
                                    @endif
                                    {{-- ============================================================== --}}
                                    {{-- ========================== IF PARA MOSTRAR =================== --}}
                                    @if ($mes_contador >= 9)
                                        @php
                                            $azul = $azul + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador >= 5 && $mes_contador <= 8)
                                        @php
                                            $verde = $verde + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador >= 2 && $mes_contador <= 4)
                                        @php
                                            $amarillo = $amarillo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 1 && $uno == 'nulo')
                                        @if ($calcular == 0)
                                            @php
                                                $rojo = $rojo + 1;
                                            @endphp
                                        @else
                                            @php
                                                $rojo = $rojo + 1;
                                            @endphp
                                        @endif
                                    @endif
                                    @if ($mes_contador == 1 && $uno == 'uno')
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 0 && $dias_exactos > 0)
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                    @if ($mes_contador == 0 && $dias_exactos <= 0)
                                        @php
                                            $expirado = $expirado + 1;
                                        @endphp
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        {{--  --}}
                        @php
                            $datos_mt = [$sin_mantenimiento, $azul, $verde, $amarillo, $rojo, $expirado];
                        @endphp
                        {{--  --}}
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">MANTENIMIENTO POR FECHA</h5>
                            <canvas id="tmantenimiento" class="card-top"></canvas>
                        </div>
                        <br>
                        {{-- ============================================================================== --}}
                        {{-- ===================//BUG: T.FUMIGACION =================== --}}
                        {{-- CALCULO DE FECHAS --}}
                        @php
                            $sin_mantenimiento = 0;
                            $azul = 0;
                            $verde = 0;
                            $amarillo = 0;
                            $rojo = 0;
                            $expirado = 0;
                        @endphp
                        @foreach ($unidades as $unidade)
                            @if ($unidade->fumigacion == 'Sin Fumigación')
                                @php
                                    $sin_mantenimiento = $sin_mantenimiento + 1;
                                @endphp
                            @else
                                @php
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
                                    $dias_resto = $calcular;
                                    $opc = 2;
                                    for ($i = 0; $i <= $opc; $i++) {
                                        if ($calcular >= 30) {
                                            $mes_contador = $mes_contador + 1;
                                            $calcular = $calcular - 30;
                                        }
                                    }
                                @endphp
                                {{-- ============================================================== --}}
                                {{-- ========================== IF PARA MOSTRAR =================== --}}
                                @if ($mes_contador >= 9)
                                    @php
                                        $azul = $azul + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador >= 5 && $mes_contador <= 8)
                                    @php
                                        $verde = $verde + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador >= 2 && $mes_contador <= 4)
                                    @php
                                        $amarillo = $amarillo + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador == 1 && $uno == 'nulo')
                                    @if ($calcular == 0)
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @else
                                        @php
                                            $rojo = $rojo + 1;
                                        @endphp
                                    @endif
                                @endif
                                @if ($mes_contador == 1 && $uno == 'uno')
                                    @php
                                        $rojo = $rojo + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador == 0 && $dias_exactos > 0)
                                    @php
                                        $rojo = $rojo + 1;
                                    @endphp
                                @endif
                                @if ($mes_contador == 0 && $dias_exactos <= 0)
                                    @php
                                        $expirado = $expirado + 1;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                        {{--  --}}
                        {{--  --}}
                        @php
                            $datos_fum = [$sin_mantenimiento, $azul, $verde, $amarillo, $rojo, $expirado];
                        @endphp
                        {{--  --}}
                        <div class="card text-center chart-container" style="position: center; height:70vh; width:70vw">
                            <h5 class="card-title">FUMIGACIONES</h5>
                            <canvas id="fumigacion" class="card-top"></canvas>
                        </div>
                    </div>
                    <br>
                    {{-- ============================================================================== --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        /* ================ //BUG:GRAFICA MEDICO ================*/
        const dataopem = [
            @php
                print '' . $datos_opem[0] . ',' . $datos_opem[1] . ',' . $datos_opem[2] . ',' . $datos_opem[3] . ',' . $datos_opem[4];
            @endphp
        ];
        var ctxopem = document.getElementById("medico");
        var myNewChartopem = new Chart(ctxopem, {
            type: 'pie',
            data: {
                labels: ['9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Medico Expirado'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: dataopem,
                    backgroundColor: [
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSeguroopem(click) {
            var sliceopem = myNewChartopem.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (sliceopem.length) {
                const firstPointopem = sliceopem[0];
                const labelopem = myNewChartopem.data.labels[firstPointopem.index];
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelopem == '9-12 meses') {
                    window.location.href = "/reportes/operadores/medico/azul";
                }
                if (labelopem == '5-8 meses') {
                    window.location.href = "/reportes/operadores/medico/verde";
                }
                if (labelopem == '2-4 meses') {
                    window.location.href = "/reportes/operadores/medico/amarillo";
                }
                if (labelopem == 'Sig. mes') {
                    window.location.href = "/reportes/operadores/medico/rojo";
                }
                if (labelopem == 'Medico Expirado') {
                    window.location.href = "/reportes/operadores/medico/expirado";
                }
            }
        }
        ctxopem.onclick = clickSeguroopem;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA LICENCIA ================*/
        const dataopel = [
            @php
                print '' . $datos_opel[0] . ',' . $datos_opel[1] . ',' . $datos_opel[2] . ',' . $datos_opel[3] . ',' . $datos_opel[4];
            @endphp
        ];
        var ctxopel = document.getElementById("licencia");
        var myNewChartopel = new Chart(ctxopel, {
            type: 'pie',
            data: {
                labels: ['9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Licencia Expirada'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: dataopel,
                    backgroundColor: [
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSeguroopel(click) {
            var sliceopel = myNewChartopel.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (sliceopel.length) {
                const firstPointopel = sliceopel[0];
                const labelopel = myNewChartopel.data.labels[firstPointopel.index];
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelopel == '9-12 meses') {
                    window.location.href = "/reportes/operadores/licencia/azul";
                }
                if (labelopel == '5-8 meses') {
                    window.location.href = "/reportes/operadores/licencia/verde";
                }
                if (labelopel == '2-4 meses') {
                    window.location.href = "/reportes/operadores/licencia/amarillo";
                }
                if (labelopel == 'Sig. mes') {
                    window.location.href = "/reportes/operadores/licencia/rojo";
                }
                if (labelopel == 'Licencia Expirada') {
                    window.location.href = "/reportes/operadores/licencia/expirado";
                }
            }
        }
        ctxopel.onclick = clickSeguroopel;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA SEGUROS ================*/
        const data = [
            @php
                print '' . $datos_seguro[0] . ',' . $datos_seguro[1] . ',' . $datos_seguro[2] . ',' . $datos_seguro[3] . ',' . $datos_seguro[4] . ',' . $datos_seguro[5];
            @endphp
        ];
        var ctx = document.getElementById("seguro");
        var myNewChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Sin Seguro', '9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Seguro Expirado'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: data,
                    backgroundColor: [
                        'rgb(32,32,32)',
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSeguro(click) {
            var slice = myNewChart.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (slice.length) {
                const firstPoint = slice[0];
                const label = myNewChart.data.labels[firstPoint.index];
                const value = myNewChart.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (label == 'Sin Seguro') {
                    window.location.href = "/reportes/seguros/sin%20seguro";
                }
                if (label == '9-12 meses') {
                    window.location.href = "/reportes/seguros/azul";
                }
                if (label == '5-8 meses') {
                    window.location.href = "/reportes/seguros/verde";
                }
                if (label == '2-4 meses') {
                    window.location.href = "/reportes/seguros/amarillo";
                }
                if (label == 'Sig. mes') {
                    window.location.href = "/reportes/seguros/rojo";
                }
                if (label == 'Seguro Expirado') {
                    window.location.href = "/reportes/seguros/expirado";
                }
            }
        }
        ctx.onclick = clickSeguro;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA V.AMBIENTAL ================*/
        const datava = [
            @php
                print '' . $datos_va[0] . ',' . $datos_va[1] . ',' . $datos_va[2] . ',' . $datos_va[3] . ',' . $datos_va[4] . ',' . $datos_va[5];
            @endphp
        ];
        var ctxva = document.getElementById("vambiental");
        var myNewChartva = new Chart(ctxva, {
            type: 'pie',
            data: {
                labels: ['Sin Verificación', '9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Verificación Expirada'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: datava,
                    backgroundColor: [
                        'rgb(32,32,32)',
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSegurova(click) {
            var sliceva = myNewChartva.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (sliceva.length) {
                const firstPointva = sliceva[0];
                const labelva = myNewChartva.data.labels[firstPointva.index];
                /*                 const value = myNewChartva.data.datasets[firstPointva.datasetIndex].data[firstPointva.index];
                 */
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelva == 'Sin Verificación') {
                    window.location.href = "/reportes/verificaciones_ambientales/sin%20verificacion";
                }
                if (labelva == '9-12 meses') {
                    window.location.href = "/reportes/verificaciones_ambientales/azul";
                }
                if (labelva == '5-8 meses') {
                    window.location.href = "/reportes/verificaciones_ambientales/verde";
                }
                if (labelva == '2-4 meses') {
                    window.location.href = "/reportes/verificaciones_ambientales/amarillo";
                }
                if (labelva == 'Sig. mes') {
                    window.location.href = "/reportes/verificaciones_ambientales/rojo";
                }
                if (labelva == 'Verificación Expirada') {
                    window.location.href = "/reportes/verificaciones_ambientales/expirado";
                }
            }
        }
        ctxva.onclick = clickSegurova;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA V.FISICA ================*/
        const datavf = [
            @php
                print '' . $datos_vfisica[0] . ',' . $datos_vfisica[1] . ',' . $datos_vfisica[2] . ',' . $datos_vfisica[3] . ',' . $datos_vfisica[4] . ',' . $datos_vfisica[5];
            @endphp
        ];
        var ctxvf = document.getElementById("vfisica");
        var myNewChartvf = new Chart(ctxvf, {
            type: 'pie',
            data: {
                labels: ['Sin Verificación', '9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Verificación Expirada'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: datavf,
                    backgroundColor: [
                        'rgb(32,32,32)',
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSegurovf(click) {
            var slicevf = myNewChartvf.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (slicevf.length) {
                const firstPointvf = slicevf[0];
                const labelvf = myNewChartvf.data.labels[firstPointvf.index];
                /*                 const value = myNewChartva.data.datasets[firstPointva.datasetIndex].data[firstPointva.index];
                 */
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelvf == 'Sin Verificación') {
                    window.location.href = "/reportes/verificaciones_fisico_mecanicas/sin%20verificacion";
                }
                if (labelvf == '9-12 meses') {
                    window.location.href = "/reportes/verificaciones_fisico_mecanicas/azul";
                }
                if (labelvf == '5-8 meses') {
                    window.location.href = "/reportes/verificaciones_fisico_mecanicas/verde";
                }
                if (labelvf == '2-4 meses') {
                    window.location.href = "/reportes/verificaciones_fisico_mecanicas/amarillo";
                }
                if (labelvf == 'Sig. mes') {
                    window.location.href = "/reportes/verificaciones_fisico_mecanicas/rojo";
                }
                if (labelvf == 'Verificación Expirada') {
                    window.location.href = "/reportes/verificaciones_fisico_mecanicas/expirado";
                }
            }
        }
        ctxvf.onclick = clickSegurovf;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA K.MANTENIMIENTO ================*/
        const datamk = [
            @php
                print '' . $datos_mk[0] . ',' . $datos_mk[1] . ',' . $datos_mk[2] . ',' . $datos_mk[3] . ',' . $datos_mk[4] . ',' . $datos_mk[5];
            @endphp
        ];
        var ctxmk = document.getElementById("mkilometros");
        var myNewChartmk = new Chart(ctxmk, {
            type: 'pie',
            data: {
                labels: ['Sin Mantenimiento', '500 km', '300 a 500 km', '100 a 300 km', '1 a 100 km',
                    'Mantenimiento Expirado'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: datamk,
                    backgroundColor: [
                        'rgb(32,32,32)',
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSeguromk(click) {
            var slicemk = myNewChartmk.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (slicemk.length) {
                const firstPointmk = slicemk[0];
                const labelmk = myNewChartmk.data.labels[firstPointmk.index];
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelmk == 'Sin Mantenimiento') {
                    window.location.href = "/reportes/mantenimientos_kilometraje/sin%20mantenimiento";
                }
                if (labelmk == '500 km') {
                    window.location.href = "/reportes/mantenimientos_kilometraje/azul";
                }
                if (labelmk == '300 a 500 km') {
                    window.location.href = "/reportes/mantenimientos_kilometraje/verde";
                }
                if (labelmk == '100 a 300 km') {
                    window.location.href = "/reportes/mantenimientos_kilometraje/amarillo";
                }
                if (labelmk == '1 a 100 km') {
                    window.location.href = "/reportes/mantenimientos_kilometraje/rojo";
                }
                if (labelmk == 'Mantenimiento Expirado') {
                    window.location.href = "/reportes/mantenimientos_kilometraje/expirado";
                }
            }
        }
        ctxmk.onclick = clickSeguromk;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA FUMIGACION ================*/
        const datamt = [
            @php
                print '' . $datos_mt[0] . ',' . $datos_mt[1] . ',' . $datos_mt[2] . ',' . $datos_mt[3] . ',' . $datos_mt[4] . ',' . $datos_mt[5];
            @endphp
        ];
        var ctxmt = document.getElementById("tmantenimiento");
        var myNewChartmt = new Chart(ctxmt, {
            type: 'pie',
            data: {
                labels: ['Sin Mantenimiento', '9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Mantenimiento Expirado'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: datamt,
                    backgroundColor: [
                        'rgb(32,32,32)',
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSeguromt(click) {
            var slicemt = myNewChartmt.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (slicemt.length) {
                const firstPointmt = slicemt[0];
                const labelmt = myNewChartmt.data.labels[firstPointmt.index];
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelmt == 'Sin Mantenimiento') {
                    window.location.href = "/reportes/mantenimientos/sin%20mantenimiento";
                }
                if (labelmt == '9-12 meses') {
                    window.location.href = "/reportes/mantenimientos/azul";
                }
                if (labelmt == '5-8 meses') {
                    window.location.href = "/reportes/mantenimientos/verde";
                }
                if (labelmt == '2-4 meses') {
                    window.location.href = "/reportes/mantenimientos/amarillo";
                }
                if (labelmt == 'Sig. mes') {
                    window.location.href = "/reportes/mantenimientos/rojo";
                }
                if (labelmt == 'Mantenimiento Expirado') {
                    window.location.href = "/reportes/mantenimientos/expirado";
                }
            }
        }
        ctxmt.onclick = clickSeguromt;
        /*  */
        /* ========================================================*/
        /* ================ //BUG:GRAFICA T.MANTENIMIENTO ================*/
        const datafum = [
            @php
                print '' . $datos_fum[0] . ',' . $datos_fum[1] . ',' . $datos_fum[2] . ',' . $datos_fum[3] . ',' . $datos_fum[4] . ',' . $datos_fum[5];
            @endphp
        ];
        var ctxfum = document.getElementById("fumigacion");
        var myNewChartfum = new Chart(ctxfum, {
            type: 'pie',
            data: {
                labels: ['Sin Fumigacion', '9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes',
                    'Fumigacion Expirada'
                ],
                datasets: [{
                    label: 'No. Unidades: ',
                    data: datafum,
                    backgroundColor: [
                        'rgb(32,32,32)',
                        'rgb(60,60,255)',
                        'rgb(0,153,0)',
                        'rgb(255, 255, 102)',
                        'rgb(255,51,51)',
                        'rgb(255,0,0)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
        /* EVENTO */
        function clickSegurofum(click) {
            var slicefum = myNewChartfum.getElementsAtEventForMode(click, 'nearest', {
                intersect: true
            }, true);
            if (slicefum.length) {
                const firstPointfum = slicefum[0];
                const labelfum = myNewChartfum.data.labels[firstPointfum.index];
                /* 'Sin Seguro','9-12 meses', '5-8 meses', '2-4 meses', 'Sig. mes', 'Seguro Expirado'*/
                if (labelfum == 'Sin Fumigacion') {
                    window.location.href = "/reportes/fumigaciones/sin%20fumigacion";
                }
                if (labelfum == '9-12 meses') {
                    window.location.href = "/reportes/fumigaciones/azul";
                }
                if (labelfum == '5-8 meses') {
                    window.location.href = "/reportes/fumigaciones/verde";
                }
                if (labelfum == '2-4 meses') {
                    window.location.href = "/reportes/fumigaciones/amarillo";
                }
                if (labelfum == 'Sig. mes') {
                    window.location.href = "/reportes/fumigaciones/rojo";
                }
                if (labelfum == 'Fumigacion Expirada') {
                    window.location.href = "/reportes/fumigaciones/expirado";
                }
            }
        }
        ctxfum.onclick = clickSegurofum;
        /*  */
        /* ========================================================*/
    </script>
@endsection
