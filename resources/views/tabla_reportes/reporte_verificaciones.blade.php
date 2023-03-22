@extends('layouts.app')
@section('title')
    REPORTE VERIFICACIONES
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Verificaciones</h3>
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
                                            dir="{{ route('tabla_reportes.reporte_verificacionesexcel') }}">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                        <button type="submit" class="btn btn-md" style="background-color: #ff8097"
                                            dir="{{ route('pdf.reporte_verificacionespdf') }}">
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
                                                    <input type="date" name="filtrofechainicio" class="form-control" id="min"
                                                        style="width:40%">
                                                    <span id="boot-icon" class="bi bi-dash-square-fill"
                                                        style="font-size: 2rem; color: rgb(84, 84, 84);"></span>
                                                    <input type="date" name="filtrofechafinal" class="form-control" id="max"
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
                                                    <input type="text" name="filtrocli" id="filtrocli" class="form-control filtroClientes" data-column="1"
                                                        value="{{ $clientes }}" readonly="readonly" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtrounid">Filtro Unidades</label>
                                                    <select name="filtrounid" id="filtrounid" readonly="readonly" 
                                                        class="form-control filtroUnidades" data-column="3" style="width:100%">
                                                        <option  value=" ">Todas Las Unidades</option>
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
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtroveri">Filtro Verificaciones</label>
                                                    <select name="filtroveri" id="filtroveri" class="form-control filtroVerificaciones"  data-column="10"
                                                        style="width:100%">
                                                        <option selected value=" ">Ambas Verificaciones</option>
                                                        <option value="Ambiental">Verificaciones Ambientales</option>
                                                        <option value="Fisica">Verificaciones Fisico-Mecanicas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                                {{-- GENERAL --}}
                                @can('general-rol')
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="input-group">
                                                    <label class="label" for="filtrocli">Filtro Clientes</label>
                                                    <select name="filtrocli" id="filtrocli" {{-- class="selectsearch" --}}
                                                        class="form-select form-select-sm mb-3 form-control filtroClientes" data-column="1"
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
                                    <div class="row">
                                        <div class="card-deck mt-6">
                                            <div class="card col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="filtroveri">Filtro Verificaciones</label>
                                                    <select name="filtroveri" id="filtroveri" class="form-control filtroVerificaciones"  data-column="10"
                                                        style="width:100%">
                                                        <option selected value=" ">Ambas Verificaciones</option>
                                                        <option value="Ambiental">Verificaciones Ambientales</option>
                                                        <option value="Fisica">Verificaciones Fisico-Mecanicas</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </form>
                            <br>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <thead style="background-color: #9dbad5">
                                    <th style="color:#fff;">Id Cliente</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Marca</th>
                                    <th style="color:#fff;">Serie Unidad</th>
                                    <th style="color:#fff;">Año Unidad</th>
                                    <th style="color:#fff;">Placas</th>
                                    <th style="color:#fff;">Tipo Unidad</th>
                                    <th style="color:#fff;">Razon Social Unidad</th>
                                    <th style="color:#fff;">Digito Placa</th>
                                    <th style="color:#fff;">Folio Verificación</th>
                                    <th style="color:#fff;">Tipo Verificación</th>
                                    <th style="color:#fff;">Subtipo Verificación</th>
                                    <th style="color:#fff;">Ultima Verificación</th>
                                </thead>
                                <tbody>
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td> {{ $unidade->id }} </td>
                                            <td> {{ $unidade->nombrecompleto }} </td>
                                            <td> {{ $unidade->marca }} </td>
                                            <td> {{ $unidade->serieunidad }} </td>
                                            <td> {{ $unidade->añounidad }} </td>
                                            <td> {{ $unidade->placas }} </td>
                                            <td> {{ $unidade->tipounidad }} </td>
                                            <td> {{ $unidade->razonsocialunidad }} </td>
                                            <td> {{ $unidade->digitoplaca }} </td>
                                            <td> {{ $unidade->noverificacion }} </td>
                                            <td> {{ $unidade->tipoverificacion }} </td>
                                            <td> {{ $unidade->subtipoverificacion }} </td>
                                            <td> {{ $unidade->ultimaverificacion }} </td>
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
