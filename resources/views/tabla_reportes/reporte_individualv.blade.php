@extends('layouts.app')
@section('title')
    REPORTE INDIVIDUAL VEHICULAR
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Individual Vehicular</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <a class="btn btn-danger" href="{{ route('tabla_reportes.dashboard') }}">Regresar</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id='tablas-style' class="table table-striped mt-2" id="tabla">
                                <a class="btn btn-success" {{-- href="{{ route('tabla_reportes.reporte_flotillasexcel') }}" --}}><i class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Placas</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Serie Unidad</th>
                                    {{-- <th style="color:#fff;">Marca</th> --}}
                                    {{-- <th style="color:#fff;">Año Unidad</th> --}}
                                    {{-- <th style="color:#fff;">Tipo Unidad</th> --}}
                                    <th style="color:#fff;">Razon Social</th>
                                    <th style="color:#fff;">Tipo Verificación</th>
                                    <th style="color:#fff;">Subtipo Verificación</th>
                                    <th style="color:#fff;">Ultima Verificación</th>
                                    <th style="color:#fff;">Mas Información</th>

                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                        use App\Models\Verificacione;
                                        $verificaciones = Verificacione::all();
                                    @endphp
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td>{{ $unidade->placas }}</td>
                                            <td>{{ $unidade->cliente }}</td>
                                            <td>{{ $unidade->serieunidad }}</td>
                                            {{-- <td>{{ $unidade->marca }}</td>
                                            <td>{{ $unidade->añounidad }}</td> --}}
                                            {{-- <td>{{ $unidade->tipounidad }}</td> --}}
                                            <td>{{ $unidade->razonsocialunidad }}</td>
                                            {{-- Boton MODAL --}}
                                            @php
                                                foreach ($verificaciones as $verificacione) {
                                                    if ($verificacione->id_unidad == $unidade->serieunidad && $verificacione->estado == 'Inactivo') {
                                                        echo '<td>' . $verificacione->tipoverificacion . '</td>';
                                                        echo '<td>' . $verificacione->subtipoverificacion . '</td>';
                                                        echo '<td>' . $verificacione->fechavencimiento . '</td>';
                                                        break;
                                                    } else {
                                                        echo '<td>No aplica</td>';
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
                            <br>
                            <b>Accesorios Completos</b>
                            <li class="list-group-item">
                                N/A
                            </li>
                            <br>
                            <b>Kilometraje</b>
                            <br>
                            <li class="list-group-item">
                                {{ $unidade->kilometros_contador }}
                            </li>
                            <br>
                            <b>Accesorios Completos</b>
                            <br>
                            <li class="list-group-item">
                                {{ $unidade->kilometros_contador }}
                            </li>
                            <br>
                            @if ($unidade->tipomantenimiento == 'Kilometraje')
                                <b>Sig. Mantenimiento KM</b>
                                <br>
                                <li class="list-group-item">
                                    {{ $unidade->kilometros_contador + $unidade->frecuenciamante }} km
                                </li>
                                <br>
                            @endif
                            @if ($unidade->tipomantenimiento == 'Fecha')
                                <b>Sig. Mantenimiento KM</b>
                                <br>
                                <li class="list-group-item">
                                    N/A
                                </li>
                                <br>
                            @endif
                            <b>Seguro Fecha</b>
                            <br>
                            <li class="list-group-item">
                                {{ $unidade->seguro_fecha }}
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
@section('scripts')
    <script src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#tablas-style').DataTable();
        });
    </script>
@endsection
