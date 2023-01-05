@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('title')
    REPORTE SERVICIOS
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Servicios de la Semana</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <a class="btn btn-danger" href="{{ route('tabla_reportes.dashboard') }}">Regresar</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @php
                                use App\Models\Cliente;
                                $clientesf = Cliente::all();
                            @endphp
                            <form action="{{ route('tabla_reportes.reporte_serviciosexcel') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Filtro por Fechas</label>
                                                <div class="input-group">
                                                    <label for="filtrofechainicio" style="width:55%">Fecha Inicio</label>
                                                    <label for="filtrofechafinal" style="width:45%">Fecha Final</label>
                                                </div>
                                                <div class="input-group">
                                                    <input type="date" name="filtrofechainicio" class="form-control"
                                                        style="width:40%">
                                                    <span id="boot-icon" class="bi bi-dash-square-fill"
                                                        style="font-size: 2rem; color: rgb(84, 84, 84);"></span>
                                                    <input type="date" name="filtrofechafinal" class="form-control"
                                                        style="width:40%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        {{--  <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrounidad">Filtro Tipo Unidades</label>
                                                <select name="filtrounidad" id="filtrounidad" class=" selectsearch"
                                                    style="width:80%">
                                                    <option selected value="Ambas">Ambas Unidadades</option>
                                                    <option value="Habitacional">Unidad Habitacional</option>
                                                    <option value="Vehicular">Unidad Vehicular</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrocli">Filtro Clientes</label>
                                                <select name="filtrocli" id="filtrocli" class=" selectsearch"
                                                    style="width:80%">
                                                    <option selected value="todos">Todos los Clientes</option>
                                                    @foreach ($clientesf as $cliente)
                                                        <option value="{{ $cliente->nombrecompleto }}">
                                                            {{ $cliente->nombrecompleto }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <table id='tablas-style' class="table table-striped mt-2"{{--  id="tabla" --}}>
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
