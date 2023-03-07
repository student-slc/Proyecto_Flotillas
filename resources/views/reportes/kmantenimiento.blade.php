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
                    $estado = '500 km';
                @endphp
            @endif
            @if ($color == 'verde')
                @php
                    $estado = '300 a 500 km';
                @endphp
            @endif
            @if ($color == 'amarillo')
                @php
                    $estado = '100 a 300 km';
                @endphp
            @endif
            @if ($color == 'rojo')
                @php
                    $estado = '1 a 100 km';
                @endphp
            @endif
            @if ($color == 'expirado')
                @php
                    $estado = 'Mantenimiento Expirado';
                @endphp
            @endif
            <h3 class="page__heading">Mantenimiento por Kilometraje de Todas Las unidades en: {{ $estado }}</h3>
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
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">No. Serie</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Estado Mantenimiento</th>
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
                                            @if ($calculo[$pos][$cont] == $unidade->serieunidad && $unidade->tipomantenimiento == 'Kilometraje')
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
                                                        <h6>
                                                            @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                                                <span class="badge badge-danger">SIN MANTENIMIENTO</span>
                                                            @else
                                                                @if ($unidade->tipomantenimiento == 'Kilometraje')
                                                                    @php
                                                                        $km_contador = $unidade->kilometros_contador;
                                                                        $frecuencia = $unidade->frecuencia_mante;
                                                                        $km_actual = $unidade->kilometros_actuales;
                                                                        $diferencia = $frecuencia + $km_actual - $km_contador;
                                                                    @endphp
                                                                    @if ($km_contador >= $frecuencia + $km_actual)
                                                                        <span class="badge badge-danger">
                                                                            MANTENIMIENTO EXPIRADO</span>
                                                                    @endif
                                                                    @if ($km_contador < $frecuencia + $km_actual)
                                                                        @php
                                                                            $diferencia = $frecuencia + $km_actual - $km_contador;
                                                                        @endphp
                                                                        @if ($diferencia >= 1 && $diferencia < 100)
                                                                            <span class="badge badge-danger">
                                                                                {{ $diferencia }} KM
                                                                                PARA EXPIRAR</span>
                                                                        @endif
                                                                        @if ($diferencia >= 100 && $diferencia < 300)
                                                                            <span class="badge badge-warning">
                                                                                {{ $diferencia }} KM
                                                                                PARA EXPIRAR</span>
                                                                        @endif
                                                                        @if ($diferencia >= 300 && $diferencia < 500)
                                                                            <span class="badge badge-success">
                                                                                {{ $diferencia }} KM
                                                                                PARA EXPIRAR</span>
                                                                        @endif
                                                                        @if ($diferencia >= 500)
                                                                            <span class="badge badge-primary">
                                                                                {{ $diferencia }} KM
                                                                                PARA EXPIRAR</span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </h6>
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
