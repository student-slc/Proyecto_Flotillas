@extends('layouts.app')
@section('title')
    Reportes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            @if ($color == 'azul')
                @php
                    $estado = '9 a 12 meses para expirar';
                @endphp
            @endif
            @if ($color == 'verde')
                @php
                    $estado = '5 a 8 meses para expirar';
                @endphp
            @endif
            @if ($color == 'amarillo')
                @php
                    $estado = '2 a 4 meses para expirar';
                @endphp
            @endif
            @if ($color == 'rojo')
                @php
                    $estado = '1 mes para expirar';
                @endphp
            @endif
            @if ($color == 'expirado')
                @php
                    $estado = 'Seguro Expirada';
                @endphp
            @endif
            <h3 class="page__heading">Estado Licencias de Operadores en: {{ $estado }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('home') }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped mt-2" id="tabla">
                                <thead style="background-color:#95b8f6">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Operador</th>
                                    <th style="color:#fff;">Informacion</th>
                                    <th style="color:#fff;">Estado Licencia</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                        $pos = 0;
                                        $cont = 0;
                                    @endphp
                                    {{-- IF COLORES --}}
                                    @if ($color == 'azul')
                                        @php
                                            $pos = 2;
                                        @endphp
                                    @endif
                                    @if ($color == 'verde')
                                        @php
                                            $pos = 3;
                                        @endphp
                                    @endif
                                    @if ($color == 'amarillo')
                                        @php
                                            $pos = 4;
                                        @endphp
                                    @endif
                                    @if ($color == 'rojo')
                                        @php
                                            $pos = 5;
                                        @endphp
                                    @endif
                                    @if ($color == 'expirado')
                                        @php
                                            $pos = 6;
                                        @endphp
                                    @endif
                                    @php
                                        if ($calculo[$pos][0] == 'vacio') {
                                            $cont = 10;
                                            $opc_2 = 0;
                                        } else {
                                            $opc_2 = count($calculo[$pos]);
                                        }
                                    @endphp
                                    @foreach ($operadores as $operadore)
                                        @if ($opc_2 > $cont)
                                            @if ($calculo[$pos][$cont] == $operadore->nombreoperador)
                                                @php
                                                    if ($opc_2 == 1) {
                                                        $cont = $cont + 10;
                                                    } else {
                                                        $cont = $cont + 1;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td style="display: none;">{{ $operadore->id }}</td>
                                                    <td>{{ $operadore->nombreoperador }}</td>
                                                    {{-- Boton MODAL --}}
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="$('#{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('show')">
                                                            Detalles
                                                        </button>
                                                    </td>
                                                    {{-- ====================== --}}
                                                    <td>
                                                        {{-- ===================== CALCULO_DE_FECHAS_MEDICO ===================== --}}
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
                                                        @endphp
                                                        {{-- ============================================================== --}}
                                                        {{-- ========================== IF PARA MOSTRAR =================== --}}
                                                        <h5>
                                                            @if ($mes_contador >= 9)
                                                                <span class="badge badge-primary">
                                                                    Expira en:
                                                                    {{ $mes_contador }} meses
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                                <span class="badge badge-success">
                                                                    Expira en:
                                                                    {{ $mes_contador }} meses
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                                <span class="badge badge-warning">
                                                                    Expira en:
                                                                    {{ $mes_contador }} meses
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'nulo')
                                                                @if ($calcular == 0)
                                                                    <span class="badge badge-danger">
                                                                        Expira en:
                                                                        {{ $mes_contador }} mes
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-danger">
                                                                        Expira en:
                                                                        {{ $mes_contador }} mes
                                                                        <br>y {{ $calcular }} dias
                                                                    </span>
                                                                @endif
                                                            @endif
                                                            @if ($mes_contador == 1 && $uno == 'uno')
                                                                <span class="badge badge-danger">
                                                                    Expira en:
                                                                    {{ $dias_exactos }} dias
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos > 0)
                                                                <span class="badge badge-danger">
                                                                    Expira en:
                                                                    {{ $dias_exactos }} dias
                                                                </span>
                                                            @endif
                                                            @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                                <span class="badge badge-danger">
                                                                    LICENCIA EXPIRADA
                                                                </span>
                                                            @endif
                                                        </h5>
                                                    </td>
                                                    {{-- ============================================================== --}}
                                                    {{-- ============================================================== --}}
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{-- <div class="pagination justify-content-end">
                                {!! $operadores->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($operadores as $operadore)
        <div class="modal fade" id="{{ str_replace(' ', '', $operadore->nombreoperador) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $operadore->nombreoperador }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Fecha Nacimiento:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechanacimiento }}
                        </li>
                        <br>
                        <b>Numero de Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->nolicencia }}
                        </li>
                        <br>
                        <b>Tipo de Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->tipolicencia }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento Medico:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechavencimientomedico }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechavencimientolicencia }}
                        </li>
                        <br>
                        <b>cliente:</b>
                        <li class="list-group-item">
                            {{ $operadore->cliente }}
                        </li>
                        <br>
                        <b>Licencia:</b>
                        <li class="list-group-item">
                            <object type="application/pdf" data="{{ asset($operadore->licencia) }}"
                                style="width: 400px; height: 300px;">
                                ERROR (no puede mostrarse el objeto)
                            </object>
                        </li>
                        <br>
                        <b>Certificación:</b>
                        <li class="list-group-item">
                            <object type="application/pdf" data="{{ asset($operadore->curso) }}"
                                style="width: 400px; height: 300px;">
                                ERROR (no puede mostrarse el objeto)
                            </object>
                        </li>
                        <br>
                        <b>Examen Medico:</b>
                        <li class="list-group-item">
                            <object type="application/pdf" data="{{ asset($operadore->examenmedico) }}"
                                style="width: 400px; height: 300px;">
                                ERROR (no puede mostrarse el objeto)
                            </object>
                        </li>
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ str_replace(' ', '', $operadore->nombreoperador) }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- =========================================== --}}
@endsection
