@extends('layouts.app')
@section('title')
    REPORTE FLOTILLAS
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Flotillas</h3>
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
                                $clientes = Cliente::all();
                            @endphp
                            <form action="{{ route('tabla_reportes.reporte_flotillasexcel') }}" method="POST"
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
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtroveri">Filtro Verificaciones</label>
                                                <select name="filtroveri" id="filtroveri" class=" selectsearch"
                                                    style="width:80%">
                                                    <option selected value="Ambas">Ambas Verificaciones</option>
                                                    <option value="Ambiental">Verificaciones Ambientales</option>
                                                    <option value="Fisica">Verificaciones Fisico-Mecanicas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="filtrocli">Filtro Clientes</label>
                                                <select name="filtrocli" id="filtrocli" class=" selectsearch"
                                                    style="width:80%">
                                                    <option selected value="todos">Todos los Clientes</option>
                                                    @foreach ($clientes as $cliente)
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
                            <table id='tablas-style' class="table table-striped mt-2">
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
                                    @foreach ($verificaciones as $verificacione)
                                        @php
                                            $noaplica = 0;
                                            foreach ($unidades as $unidade) {
                                                if ($verificacione->noverificacion == $unidade->verificacion) {
                                                    echo '<tr>';
                                                    echo '<td>' . $unidade->placas . '</td>';
                                                    echo '<td>' . $unidade->cliente . '</td>';
                                                    echo '<td>' . $unidade->serieunidad . '</td>';
                                                    echo '<td>' . $unidade->razonsocialunidad . '</td>';

                                                    echo '<td>' . $verificacione->tipoverificacion . '</td>';
                                                    echo '<td>' . $verificacione->subtipoverificacion . '</td>';
                                                    echo '<td>' . $verificacione->ultimaverificacion . '</td>';

                                                    echo '<td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$("#{{ $a }}").modal("show")">
                                                    Detalles
                                                </button>
                                            </td>';
                                                    echo '</tr>';
                                                    $noaplica = 1;
                                                    break;
                                                }
                                            }
                                            /* if ($noaplica == 0) {
                                                    echo '<td>' . $unidade->placas . '</td>';
                                                    echo '<td>' . $unidade->cliente . '</td>';
                                                    echo '<td>' . $unidade->serieunidad . '</td>';
                                                    echo '<td>' . $unidade->razonsocialunidad . '</td>';

                                                    echo '<td>Sin Ambiental</td>';
                                                    echo '<td>Sin Ambiental</td>';
                                                    echo '<td>Sin Ambiental</td>';
                                                    echo '<td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$("#{{ $a }}").modal("show")">
                                                    Detalles
                                                </button>
                                            </td>';
                                                } */
                                        @endphp
                                        {{-- AQUI VA --}}

                                        {{--  --}}
                                        @php
                                            $a = $a . 'a';
                                        @endphp
                                    @endforeach
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
                                                $noaplica = 0;
                                                foreach ($verificaciones as $verificacione) {
                                                    if ($verificacione->noverificacion == $unidade->verificacion2) {
                                                        echo '<td>' . $verificacione->tipoverificacion . '</td>';
                                                        echo '<td>' . $verificacione->subtipoverificacion . '</td>';
                                                        echo '<td>' . $verificacione->ultimaverificacion . '</td>';
                                                        $noaplica = 1;
                                                        break;
                                                    }
                                                }
                                                if ($noaplica == 0) {
                                                    echo '<td>Sin F.Mecanica</td>';
                                                    echo '<td>Sin F.Mecanica</td>';
                                                    echo '<td>Sin F.Mecanica</td>';
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
