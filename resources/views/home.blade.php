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
                    <div class="card-deck mt-2">
                        <div class="card text-center chart-container" style="position: center; height:80vh; width:80vw">
                            <div class="card-body">
                                <h5 class="card-title">SEGUROS</h5>
                                <canvas id="seguro"></canvas>
                            </div>
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
                        <div class="card text-center chart-container" style="position: center; height:80vh; width:80vw">
                            <div class="card-body">
                                <h5 class="card-title">VERIFICACION AMBIENTAL</h5>
                                <canvas id="vambiental"></canvas>
                            </div>
                        </div>
                    </div>
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
                    <div class="card-deck mt-2">
                        <div class="card text-center chart-container" style="position: center; height:80vh; width:80vw">
                            <div class="card-body">
                                <h5 class="card-title">VERIFICACIONES FISICO-MECANICAS</h5>
                                <canvas id="vfisica"></canvas>
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
                                    @php
                                        /* FECHA LICENCIA */
                                        $vencimiento_dia = substr($unidade->mantenimiento_fecha, 8, 2);
                                        $vencimiento_mes = substr($unidade->mantenimiento_fecha, 5, 2);
                                        $vencimiento_año = substr($unidade->mantenimiento_fecha, 0, 4);
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
                                    @php
                                        $km = $unidade->mantenimiento_fecha;
                                        $diferencia = 1000 - $km;
                                    @endphp
                                    @if ($diferencia <= 0)
                                        @php
                                            $expirado = $expirado + 1;
                                        @endphp
                                    @endif
                                    @if ($diferencia >= 500)
                                        @php
                                            $azul = $azul + 1;
                                        @endphp
                                    @endif
                                    @if ($diferencia >= 300 && $diferencia < 500)
                                        @php
                                            $verde = $verde + 1;
                                        @endphp
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
                        @endforeach
                        {{--  --}}
                        <div class="card text-center chart-container" style="position: center; height:80vh; width:80vw">
                            <div class="card-body">
                                <h5 class="card-title">VERIFICACIONES FISICO-MECANICAS</h5>
                                <canvas id="tmantenimiento"></canvas>
                            </div>
                        </div>
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
                            @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                @php
                                    $sin_mantenimiento = $sin_mantenimiento + 1;
                                @endphp
                            @else
                                @php
                                    /* FECHA LICENCIA */
                                    $vencimiento_dia = substr($unidade->mantenimiento_fecha, 8, 2);
                                    $vencimiento_mes = substr($unidade->mantenimiento_fecha, 5, 2);
                                    $vencimiento_año = substr($unidade->mantenimiento_fecha, 0, 4);
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h5>MANTENIMIENTO POR FECHA</h5>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Sin Mantenimiento</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-times-circle f-left"></i><span>{{ $sin_mantenimiento }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h5>9-12 meses a expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $azul }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-success order-card">
                                        <div class="card-block">
                                            <h5>5-8 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $verde }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-warning order-card">
                                        <div class="card-block">
                                            <h5>2-4 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-triangle f-left"></i><span>{{ $amarillo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-danger order-card">
                                        <div class="card-block">
                                            <h5>1-2 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-circle f-left"></i><span>{{ $rojo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Mantenimiento Expirado</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-times-circle f-left"></i><span>{{ $expirado }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h5>FUMIGACIONES</h5>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Sin Fumigación</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-times-circle f-left"></i><span>{{ $sin_mantenimiento }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h5>9-12 meses a expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $azul }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-success order-card">
                                        <div class="card-block">
                                            <h5>5-8 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $verde }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-warning order-card">
                                        <div class="card-block">
                                            <h5>2-4 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-triangle f-left"></i><span>{{ $amarillo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-danger order-card">
                                        <div class="card-block">
                                            <h5>1-2 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-circle f-left"></i><span>{{ $rojo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Fumigación Expirada</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-times-circle f-left"></i><span>{{ $expirado }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Vermás</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ============================================================================== --}}
                    @php
                        $azul = 0;
                        $verde = 0;
                        $amarillo = 0;
                        $rojo = 0;
                        $expirado = 0;
                    @endphp
                    @foreach ($operadores as $operadore)
                        {{-- ===================== CALCULO_DE_FECHAS_MEDICO ===================== --}}
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h5>CERTIFICADO MEDICO OPERADORES</h5>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h5>9-12 meses a expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $azul }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-success order-card">
                                        <div class="card-block">
                                            <h5>5-8 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $verde }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-warning order-card">
                                        <div class="card-block">
                                            <h5>2-4 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-triangle f-left"></i><span>{{ $amarillo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-danger order-card">
                                        <div class="card-block">
                                            <h5>1-2 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-circle f-left"></i><span>{{ $rojo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Medicos Expirados</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-times-circle f-left"></i><span>{{ $expirado }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        {{-- ===================== CALCULO_DE_FECHAS_LICENCIAS ===================== --}}
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h5>LICENCIAS OPERADORES</h5>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h5>9-12 meses a expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $azul }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-success order-card">
                                        <div class="card-block">
                                            <h5>5-8 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-check-circle f-left"></i><span>{{ $verde }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-warning order-card">
                                        <div class="card-block">
                                            <h5>2-4 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-triangle f-left"></i><span>{{ $amarillo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-danger order-card">
                                        <div class="card-block">
                                            <h5>1-2 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-exclamation-circle f-left"></i><span>{{ $rojo }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Licencias Expiradas</h5>
                                            <h2 class="text-right"><i
                                                    class="fa fa-times-circle f-left"></i><span>{{ $expirado }}</span>
                                            </h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver
                                                    más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
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
    </script>
@endsection
