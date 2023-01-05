@extends('layouts.app')
@section('title')
    Reportes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            @if ($color == 'sin mantenimiento')
                @php
                    $estado = 'Sin Mantenimiento';
                @endphp
            @endif
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
                    $estado = 'Verificacion Expirada';
                @endphp
            @endif
            <h3 class="page__heading">Mantenimiento por Fechas de Todas Las unidades en: {{ $estado }}</h3>
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
                                <a class="btn btn-success" {{-- href="{{ route('unidades.export', $usuario) }}" --}}><i class="fas fa-file-excel"></i></a>
                                <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar....">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">No. Serie</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Estado Mantenimiento</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                        $pos = 0;
                                        $cont = 0;
                                    @endphp
                                    {{-- IF COLORES --}}
                                    @if ($color == 'sin mantenimiento')
                                        @php
                                            $pos = 1;
                                        @endphp
                                    @endif
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
                                    {{--  --}}
                                    @foreach ($unidades as $unidade)
                                        @if ($opc_2 > $cont && $unidade->tipo == 'Unidad Vehicular')
                                            @if ($calculo[$pos][$cont] == $unidade->serieunidad)
                                                @php
                                                    if ($opc_2 == 1) {
                                                        $cont = $cont + 10;
                                                    } else {
                                                        $cont = $cont + 1;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td style="display: none;">{{ $unidade->id }}</td>
                                                    <td>{{ $unidade->cliente }}</td>
                                                    <td>{{ $unidade->serieunidad }}</td>
                                                    {{-- Boton MODAL --}}
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="$('#{{ $a }}').modal('show')">
                                                            Detalles
                                                        </button>
                                                    </td>
                                                    {{-- ================================ //BUG:SEGUROS ================================ --}}
                                                    <td>
                                                        @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                                            <h6><span class="badge badge-danger">Sin
                                                                    <br> Mantenimiento</span>
                                                            </h6>
                                                        @else
                                                            {{-- ===================== CALCULO_DE_FECHAS_SEGURO ===================== --}}
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
                                                            <h6>
                                                                @if ($mes_contador >= 9)
                                                                    <span class="badge badge-primary">
                                                                        Expira
                                                                        en:
                                                                        {{ $mes_contador }} meses
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador >= 5 && $mes_contador <= 8)
                                                                    <span class="badge badge-success">
                                                                        Expira
                                                                        en:
                                                                        {{ $mes_contador }} meses
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador >= 2 && $mes_contador <= 4)
                                                                    <span class="badge badge-warning">
                                                                        Expira
                                                                        en:
                                                                        {{ $mes_contador }} meses
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador == 1 && $uno == 'nulo')
                                                                    @if ($calcular == 0)
                                                                        <span class="badge badge-danger">
                                                                            Expira
                                                                            en:
                                                                            {{ $mes_contador }} mes
                                                                        </span>
                                                                    @else
                                                                        <span class="badge badge-danger">
                                                                            Expira
                                                                            en:
                                                                            {{ $mes_contador }} mes
                                                                            <br>y {{ $calcular }} dias
                                                                        </span>
                                                                    @endif
                                                                @endif
                                                                @if ($mes_contador == 1 && $uno == 'uno')
                                                                    <span class="badge badge-danger">
                                                                        Expira
                                                                        en:
                                                                        {{ $dias_exactos }} dias
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador == 0 && $dias_exactos > 0)
                                                                    <span class="badge badge-danger">
                                                                        Expira
                                                                        en:
                                                                        {{ $dias_exactos }} dias
                                                                    </span>
                                                                @endif
                                                                @if ($mes_contador == 0 && $dias_exactos <= 0)
                                                                    <span class="badge badge-danger">
                                                                        MANTENIMIENTO
                                                                        <br> EXPIRADO
                                                                    </span>
                                                                @endif
                                                            </h6>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info"
                                                            href="{{ route('unidades.edit', $unidade->id) }}">
                                                            <i class="fas fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="$('#delete{{ $a }}').modal('show')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                        @php
                                            $a = $a . 'a';
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{--  <div class="pagination justify-content-end">
                                {!! $unidades->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @php
        $a = 'a';
    @endphp
    @foreach ($unidades as $unidade)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                    {{ $unidade->direccion }}
                                @endif
                                @if ($unidade->tipo == 'Unidad Vehicular')
                                    {{ $unidade->serieunidad }}
                                @endif
                            </b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        @if ($unidade->tipo == 'Unidad Vehicular')
                            <b>Cliente:</b>
                            <li class="list-group-item">
                                {{ $unidade->cliente }}
                            </li>
                            <br>
                            <b>Marca:</b>
                            <li class="list-group-item">
                                {{ $unidade->marca }}
                            </li>
                            <br>
                            <b>SubMarca:</b>
                            <li class="list-group-item">
                                {{ $unidade->submarca }}
                            </li>
                            <br>
                            <b>Año de la Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->añounidad }}
                            </li>
                            <br>
                            <b>Kilometraje:</b>
                            <li class="list-group-item">
                                {{ $unidade->kilometros_contador }}
                            </li>
                            <br>
                            <b>Tipo de Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->tipounidad }}
                            </li>
                            <br>
                            <b>Razon Social:</b>
                            <li class="list-group-item">
                                {{ $unidade->razonsocialunidad }}
                            </li>
                            <br>
                            <b>Placas:</b>
                            <li class="list-group-item">
                                {{ $unidade->placas }}
                            </li>
                            <br>
                            <b>Vencimiento Seguro:</b>
                            <li class="list-group-item">
                                {{ $unidade->seguro_fecha }}
                            </li>
                            <br>
                            <b>Vencimiento Verificación:</b>
                            <li class="list-group-item">
                                {{ $unidade->verificacion_fecha }}
                            </li>
                            <br>
                            @if ($unidade->tipomantenimiento == 'Fecha')
                                <b>Tipo de Mantenimiento:</b>
                                <li class="list-group-item">
                                    Mantenimiento por Fecha de Vencimiento
                                </li>
                                <br>
                            @endif
                            @if ($unidade->tipomantenimiento == 'Kilometraje')
                                <b>Tipo de Mantenimiento:</b>
                                <li class="list-group-item">
                                    Mantenimiento por Kilometraje
                                </li>
                                <br>
                            @endif
                            <b>Vencimiento Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->lapsofumigacion }}
                            </li>
                            <br>
                            <b>Status:</b>
                            <li class="list-group-item">
                                {{ $unidade->status }}
                            </li>
                            <br>
                        @endif
                        @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                            <b>Cliente:</b>
                            <li class="list-group-item">
                                {{ $unidade->cliente }}
                            </li>
                            <br>
                            <b>Codigo Postal:</b>
                            <li class="list-group-item">
                                {{ $unidade->cp }}
                            </li>
                            <br>
                            <b>Dirección:</b>
                            <li class="list-group-item">
                                {{ $unidade->direccion }}
                            </li>
                            <br>
                            <b>Calle:</b>
                            <li class="list-group-item">
                                {{ $unidade->calle }}
                            </li>
                            <br>
                            <b>Ciudad:</b>
                            <li class="list-group-item">
                                {{ $unidade->ciudad }}
                            </li>
                            <br>
                            <b>Responsable:</b>
                            <li class="list-group-item">
                                {{ $unidade->responsable }}
                            </li>
                            <br>
                            <b>Razon Social:</b>
                            <li class="list-group-item">
                                {{ $unidade->razonsocialunidad }}
                            </li>
                            <br>
                            <b>Vencimiento Fumigación:</b>
                            <li class="list-group-item">
                                {{ $unidade->lapsofumigacion }}
                            </li>
                            <br>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ $a }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        @php
            $a = $a . 'a';
        @endphp
    @endforeach
    {{-- =========================================== --}}
@endsection
