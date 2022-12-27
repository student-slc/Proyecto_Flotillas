@extends('layouts.app')
@section('title')
    REPORTE DIA
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte del Dia Servicios (Acumulados)</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id='tablas-style' class="table table-striped mt-2" id="tabla">
                                <a class="btn btn-success"{{--  href="{{ route('unidades.export', $usuario) }}" --}}><i class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Placas/Dirección</th>
                                    <th style="color:#fff;">Cliente</th>
                                    {{-- <th style="color:#fff;">Serie Unidad</th> --}}
                                    {{-- <th style="color:#fff;">Marca</th> --}}
                                    <th style="color:#fff;">Ultima Fumigación</th>
                                    <th style="color:#fff;">Fumigador</th>
                                    <th style="color:#fff;">Status Pago</th>
                                    <th style="color:#fff;">Dirección Fisica</th>
                                    <th style="color:#fff;">Razón Social</th>
                                    <th style="color:#fff;">Información</th>

                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                        use App\Models\Fumigacione;
                                        use App\Models\Cliente;
                                        $clientes = Cliente::all();
                                        $fumigaciones = Fumigacione::all();
                                    @endphp
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                <td>{{ $unidade->placas }}</td>
                                            @endif
                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                <td>{{ $unidade->direccion }}</td>
                                            @endif
                                            <td>{{ $unidade->cliente }}</td>
                                            {{-- Boton MODAL --}}
                                            @php
                                                foreach ($fumigaciones as $fumigacione) {
                                                    if ($fumigacione->unidad == $unidade->serieunidad) {
                                                        echo '<td>' . $fumigacione->fechaultimafumigacion . '</td>';
                                                        echo '<td>' . $fumigacione->id_fumigador . '</td>';
                                                        echo '<td>' . $fumigacione->status . '</td>';
                                                        break;
                                                    } else {
                                                        echo '<td>No aplica</td>';
                                                        echo '<td>No aplica</td>';
                                                        echo '<td>No aplica</td>';
                                                        break;
                                                    }
                                                }
                                            @endphp
                                             @php
                                             foreach ($clientes as $cliente) {
                                                 if ($cliente->nombrecompleto == $unidade->cliente) {
                                                     echo '<td>' . $cliente->razonsocial . '</td>';
                                                     echo '<td>' . $cliente->direccionfisica . '</td>';
                                                     break;
                                                 } else {
                                                     echo '<td>No aplica</td>';
                                                     echo '<td>No aplica</td>';
                                                     break;
                                                 }
                                             }
                                         @endphp
                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- AQUI VA --}}

                                            {{--  --}}
                                        </tr>
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
                                    {{ $unidade->placas }}
                                @endif
                            </b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        @if ($unidade->tipo == 'Unidad Vehicular')
                            <b>Serie Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->serieunidad }}
                            </li>
                            <br>
                            <b>Razon Social:</b>
                            <li class="list-group-item">
                                {{ $unidade->razonsocialunidad }}
                            </li>
                            <br>
                            <b>Marca:</b>
                            <li class="list-group-item">
                                {{ $unidade->marca }}
                            </li>
                            <br>
                            <b>Año de la Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->añounidad }}
                            </li>
                            <br>
                            <b>Tipo de Unidad:</b>
                            <li class="list-group-item">
                                {{ $unidade->tipounidad }}
                            </li>
                        @endif
                        @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                            <b>Serie Unidad:</b>
                            <li class="list-group-item">
                                No aplica
                            </li>
                            <br>
                            <b>Razon Social:</b>
                            <li class="list-group-item">
                                {{ $unidade->razonsocialunidad }}
                            </li>
                            <br>
                            <b>Marca:</b>
                            <li class="list-group-item">
                                No aplica
                            </li>
                            <br>
                            <b>Año de la Unidad:</b>
                            <li class="list-group-item">
                                No aplica
                            </li>
                            <br>
                            <b>Tipo de Unidad:</b>
                            <li class="list-group-item">
                                No aplica
                            </li>
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
@section('scripts')
    <script src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#tablas-style').DataTable();
        });
    </script>
@endsection
