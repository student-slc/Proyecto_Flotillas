@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reportes De Seguros</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    {{-- OBTENGO TODAS LAS UNIDADES --}}
                    @php
                        use App\Models\Unidade;
                        $unidades = Unidade::all();
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
                        $expirado=0;
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
                                <h5>
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
                                </h5>
                            @endif
                        @endif
                    @endforeach
                    {{--  --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Unidades sin seguro</h5>
                                            <h2 class="text-right"><i
                                                    class="fas fa-hospital-user f-left"></i><span>{{ $sin_seguro }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h5>9 a 12 meses a expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fas fa-hospital-user f-left"></i><span>{{ $azul }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-success order-card">
                                        <div class="card-block">
                                            <h5>5 a 8 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fas fa-hospital-user f-left"></i><span>{{ $verde }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-warning order-card">
                                        <div class="card-block">
                                            <h5>2 a 4 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fas fa-hospital-user f-left"></i><span>{{ $amarillo }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-danger order-card">
                                        <div class="card-block">
                                            <h5>1 a 2 meses para expirar</h5>
                                            <h2 class="text-right"><i
                                                    class="fas fa-hospital-user f-left"></i><span>{{ $rojo }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-dark order-card">
                                        <div class="card-block">
                                            <h5>Seguros Expirados</h5>
                                            <h2 class="text-right"><i
                                                    class="fas fa-hospital-user f-left"></i><span>{{ $expirado }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-pink order-card">
                                            <div class="card-block">
                                                <h5>Blogs</h5>
                                                @php
                                                 use App\Models\Blog;
                                                $cant_blogs = Blog::count();
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$cant_blogs}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/blogs" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- ============================================================================== --}}
                </div>
            </div>
        </div>
    </section>
@endsection
