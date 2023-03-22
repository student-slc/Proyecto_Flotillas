@extends('layouts.app')
@section('title')
    REPORTE FUMIGACIONES ACUMULADAS
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Fumigaciones Acumuladas</h3>
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
                                            dir="{{ route('tabla_reportes.reporte_fumigacionesexcel') }}">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                        <button type="submit" class="btn btn-md" style="background-color: #ff8097"
                                            dir="{{ route('pdf.reporte_fumigacionespdf') }}">
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
                                @can('particular-rol')
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtrocli">Filtro Clientes:</label>
                                                    <input type="text" name="filtrocli" id="filtrocli" class="form-control filtroClientes" data-column="1"
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
                                                            @if ($unidade->tipo == 'Unidad Vehicular')
                                                                <option value="{{ $unidade->serieunidad }}">
                                                                    {{ $unidade->serieunidad }}</option>';
                                                            @endif
                                                            @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                                                <option value="{{ $unidade->direccion }}">
                                                                    {{ $unidade->direccion }}</option>';
                                                            @endif
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
                                                        class="form-select form-select-sm mb-3 filtroClientes" data-column="1"
                                                        aria-label=".form-select-sm example" style="width:100%">
                                                        <option value=" ">Todos los Clientes</option>
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
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrofumigador">Filtro Fumigadores</label>
                                                <select name="filtrofumigador" id="filtrofumigador" readonly="readonly"
                                                    class="form-select filtroFumigadores" style="width:100%" data-column="6">
                                                    <option  value=" ">Todos los Fumigadores</option>
                                                    @foreach ($fumigadores as $fumigador)
                                                        <option value="{{ $fumigador->nombrecompleto }}">
                                                            {{ $fumigador->nombrecompleto }}</option>';
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="card-deck mt-6">
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrotuni">Filtro Tipo de Unidad</label>
                                                <select name="filtrotuni" id="filtrotuni" class="form-select filtroTipoUnidad" data-column="13"
                                                    style="width:100%">
                                                    <option selected value=" ">Ambas Unidades</option>
                                                    <option value="Habitacion">Habitacionales</option>
                                                    <option value="Vehicular">Vehiculares</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrostatus">Filtros Status Fumigación</label>
                                                <select name="filtrostatus" id="filtrostatus" readonly="readonly"
                                                    class="form-select filtroEstatusFumigacion" style="width:100%" data-column="8">
                                                    <option value=" ">Todos los Status</option>
                                                    <option value="Realizado">Realizado</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                    <option value="Reprogramado">Reprogramado</option>
                                                    <option value="Pendiente">Pendiente</option>
                                                    <option value="Cancelado">Cancelado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                            <br>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Id CLiente</th>
                                    <th style="color:#fff;">CLiente</th>
                                    <th style="color:#fff;">Razon Social Cliente</th>
                                    <th style="color:#fff;">Dirección Fisica</th>
                                    <th style="color:#fff;">Folio Fumigación</th>
                                    <th style="color:#fff;">Unidad</th>
                                    <th style="color:#fff;">Fumigador</th>
                                    <th style="color:#fff;">Fecha Programada</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Marca</th>
                                    <th style="color:#fff;">Serie Unidad/Dirección</th>
                                    <th style="color:#fff;">Año Unidad</th>
                                    <th style="color:#fff;">Placas</th>
                                    <th style="color:#fff;">Tipo Unidad</th>
                                    <th style="color:#fff;">Razon Social Unidad</th>
                                </thead>
                                <tbody>
                                    @foreach ($fumigaciones as $fumigacion)
                                        <tr>
                                            <td>{{ $fumigacion->id }}</td>
                                            <td>{{ $fumigacion->nombrecompleto }}</td>
                                            <td>{{ $fumigacion->razonsocial }}</td>
                                            <td>{{ $fumigacion->direccionfisica }}</td>
                                            <td>{{ $fumigacion->numerofumigacion }}</td>
                                            <td>{{ $fumigacion->unidad }}</td>
                                            <td>{{ $fumigacion->id_fumigador }}</td>
                                            <td>{{ $fumigacion->fechaprogramada }}</td>
                                            <td>{{ $fumigacion->status }}</td>
                                            <td>{{ $fumigacion->marca }}</td>
                                            <td>{{ $fumigacion->serieunidad }}</td>
                                            <td>{{ $fumigacion->añounidad }}</td>
                                            <td>{{ $fumigacion->placas }}</td>
                                            <td>{{ $fumigacion->tipo }}</td>
                                            <td>{{ $fumigacion->razonsocialunidad }}</td>
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
