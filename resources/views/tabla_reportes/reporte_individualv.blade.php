@extends('layouts.app')
@section('title')
    REPORTE INDIVIDUAL VEHICULAR
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Individual Vehicular</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md" style="background-color: #7caa98"
                                            dir="{{ route('tabla_reportes.reportes_individualvexcel') }}">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                        <button type="submit" class="btn btn-md" style="background-color: #ff8097"
                                            dir="{{ route('pdf.reportes_individualvpdf') }}">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Filtro por Fechas</label>
                                                <div class="input-group">
                                                    <label for="filtrofechainicio" style="width:55%">Fecha
                                                        Inicio</label>
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
                                {{-- PARTICULAR --}}
                                @can('particular-rol')
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtrocli">Filtro Clientes:</label>
                                                    <input type="text" name="filtrocli" id="filtrocli" class="form-control"
                                                        value="{{ $clientes }}" readonly="readonly" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtrounid">Filtro Unidades</label>
                                                    <select name="filtrounid" id="filtrounid" readonly="readonly"
                                                        class=" selectsearch" style="width:100%">
                                                        <option selected value="todos">Todas Las Unidades</option>
                                                        @foreach ($unidades as $unidade)
                                                            <option value="{{ $unidade->serieunidad }}">{{ $unidade->serieunidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endcan
                                {{-- GENERAL --}}
                                @can('general-rol')
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="input-group">
                                                    <label class="label" for="filtrocli">Filtro Clientes</label>
                                                    <select name="filtrocli" id="filtrocli" {{-- class="selectsearch" --}}
                                                        class="form-select form-select-sm mb-3"
                                                        aria-label=".form-select-sm example" style="width:100%">
                                                        <option value="todos">Todos los Clientes</option>
                                                        @foreach ($clientes as $cliente)
                                                            <option value="{{ $cliente->nombrecompleto }}">
                                                                {{ $cliente->nombrecompleto }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="input-group" id="unidades_opciones">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endcan
                            </form>
                            <br>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <thead style="background-color:#95b8f6">
                                    <th style="color:#fff;">ID Cliente</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Razon Social Cliente</th>
                                    <th style="color:#fff;">Tipo Unidad</th>
                                    <th style="color:#fff;">Serie Unidad</th>
                                    <th style="color:#fff;">Verificacion Fisico-Mecanica</th>
                                    <th style="color:#fff;">Fecha Verificación</th>
                                    <th style="color:#fff;">Verificacion Ambiental</th>
                                    <th style="color:#fff;">Fecha Verificación</th>
                                    <th style="color:#fff;">Seguro</th>
                                    <th style="color:#fff;">Fecha Seguro</th>
                                    <th style="color:#fff;">Fumigación</th>
                                    <th style="color:#fff;">Fecha Fumigación</th>
                                    <th style="color:#fff;">Frecuencia Fumigación</th>
                                    <th style="color:#fff;">Mantenimiento</th>
                                    <th style="color:#fff;">Fecha Mantenimiento</th>
                                    <th style="color:#fff;">Frecuencia Mantenimiento</th>
                                    <th style="color:#fff;">Tipo de Mantenimiento</th>
                                    <th style="color:#fff;">Marca</th>
                                    <th style="color:#fff;">Año Unidad</th>
                                    <th style="color:#fff;">Placas</th>
                                    <th style="color:#fff;">Digito Placa</th>
                                    <th style="color:#fff;">Kilometraje</th>
                                    <th style="color:#fff;">Razon Social Unidad</th>
                                </thead>
                                <tbody>
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td>{{ $unidade->id }}</td>
                                            <td>{{ $unidade->nombrecompleto }}</td>
                                            <td>{{ $unidade->razonsocial }}</td>
                                            <td>{{ $unidade->tipounidad }}</td>
                                            <td>{{ $unidade->serieunidad }}</td>
                                            <td>{{ $unidade->verificacion }}</td>
                                            <td>{{ $unidade->verificacion_fecha }}</td>
                                            <td>{{ $unidade->verificacion2 }}</td>
                                            <td>{{ $unidade->verificacion_fecha2 }}</td>
                                            <td>{{ $unidade->seguro }}</td>
                                            <td>{{ $unidade->seguro_fecha }}</td>
                                            <td>{{ $unidade->fumigacion }}</td>
                                            <td>{{ $unidade->lapsofumigacion }}</td>
                                            <td>{{ $unidade->frecuencia_fumiga }}</td>
                                            <td>{{ $unidade->mantenimiento }}</td>
                                            <td>{{ $unidade->mantenimiento_fecha }}</td>
                                            <td>{{ $unidade->frecuencia_mante }}</td>
                                            <td>{{ $unidade->tipomantenimiento }}</td>
                                            <td>{{ $unidade->marca }}</td>
                                            <td>{{ $unidade->añounidad }}</td>
                                            <td>{{ $unidade->placas }}</td>
                                            <td>{{ $unidade->digitoplaca }}</td>
                                            <td>{{ $unidade->kilometros_contador }}</td>
                                            <td>{{ $unidade->razonsocialunidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        /* ==================== AJAX_UNIDADES ==================== */
        function recargarLista() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('pdf.datos_unidades') }}",
                data: 'datos_unidad=' + $('#filtrocli').val(),
                success: function(r) {
                    $('#unidades_opciones').html(r);
                },
                error: function() {
                    alert("ERROR AL CARGAR UNIDADES");
                }
            });
        }
        /* =============================================== */
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            /* ------------------ CARGAR UNIDADES ------------------------------------------- */
            recargarLista();
            $('#filtrocli').change(function() {
                recargarLista();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("button[type=submit]").click(function(e) {
                e.preventDefault();
                var accion = $(this).attr('dir'),
                    $form = $(this).closest('form');
                if (typeof accion !== 'undefined') {
                    $form.attr('action', accion);
                }
                $form.submit();
            });
        });
    </script>
@endsection
