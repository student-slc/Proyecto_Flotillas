@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigaciones de {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.show', $usuario = $unidad) }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigaciones.crear', $unidad) }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                {{-- <a class="btn btn-md" style="background-color: #7caa98" href="{{ route('fumigaciones.export') }}"><i
                                        class="fas fa-file-excel"></i></a> --}}
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <br><br>
                                <thead style="background-color: #9dbad5">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Folio Fumigación</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($fumigaciones as $fumigacione)
                                        <tr>
                                            <td style="display: none;">{{ $fumigacione->id }}</td>
                                            <td>{{ $fumigacione->numerofumigacion }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-md" style="background-color: #9dbad5"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                @if ($fumigacione->status == 'Inactivo')
                                                    <h5>
                                                        <span class="badge badge-danger"
                                                            onclick="$('#update{{ $a }}').modal('show')">
                                                            Inactivo
                                                        </span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Cancelado')
                                                    <h5>
                                                        <span class="badge badge-danger"
                                                            onclick="$('#update{{ $a }}').modal('show')">
                                                            {{ $fumigacione->status }}
                                                        </span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Realizado')
                                                    <h5>
                                                        <span class="badge badge-success"
                                                            onclick="$('#update{{ $a }}').modal('show')">
                                                            Activo
                                                        </span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Reprogramado')
                                                    <h5>
                                                        <span class="badge badge-warning"
                                                            onclick="$('#update{{ $a }}').modal('show')">
                                                            {{ $fumigacione->status }}
                                                        </span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Pendiente')
                                                    <h5>
                                                        <span class="badge badge-warning"
                                                            onclick="$('#update{{ $a }}').modal('show')">
                                                            {{ $fumigacione->status }}
                                                        </span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm" style="background-color: #9dbad5"
                                                    href="{{ route('fumigaciones.edit', $fumigacione->id) }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-sm" style="background-color: #ff8097"
                                                    onclick="$('#delete{{ $a }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                            $a = $a . 'a';
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
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
    @foreach ($fumigaciones as $fumigacione)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>
                                Información del Folio de Fumigación: {{ $fumigacione->numerofumigacion }}</b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Unidad:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->unidad }}
                        </li>
                        <br>
                        <b>Fumigador:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->id_fumigador }}
                        </li>
                        <br>
                        <b>Fecha De Fumigación:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->fechaprogramada }}
                        </li>
                        <br>
                        <b>Fecha de la Ultima Fumigaciòn:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->fechaultimafumigacion }}
                        </li>
                        <br>
                        <b>Lugar del Servicio:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->lugardelservicio }}
                        </li>
                        <br>
                        <b>Numero de Visitas:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->numerodevisitas }}
                        </li>
                        <br>
                        <b>Costo:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->costo }}
                        </li>
                        <br>
                        <b>Producto Utilizado:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->producto }}
                        </li>
                        <br>
                        <b>Tipo:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->tipo }}
                        </li>
                        <br>
                        <b>Bichos Fumigados:</b>
                        <div class="card-deck">
                            <div class="card">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->insectosvoladores == 'Si') checked @endif id="insectosvoladores"
                                        name="insectosvoladores">
                                    <label class="form-check-label" for="insectosvoladores">
                                        Insectos Voladores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->insectosrastreros == 'Si') checked @endif id="insectosrastreros"
                                        name="insectosrastreros">
                                    <label class="form-check-label" for="insectosrastreros">
                                        Insectos Rastreros
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->cucaracha == 'Si') checked @endif id="cucaracha" name="cucaracha">
                                    <label class="form-check-label" for="cucaracha">
                                        Cucaracha (Ger/Ori/Ame)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->pulgas == 'Si') checked @endif id="pulgas" name="pulgas">
                                    <label class="form-check-label" for="pulgas">
                                        Pulgas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->mosca == 'Si') checked @endif id="mosca" name="mosca">
                                    <label class="form-check-label" for="mosca">
                                        Mosca
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->chinches == 'Si') checked @endif id="chinches" name="chinches">
                                    <label class="form-check-label" for="chinches">
                                        Chinches
                                    </label>
                                </div>
                            </div>
                            <div class="card">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->aracnidos == 'Si') checked @endif id="aracnidos" name="aracnidos">
                                    <label class="form-check-label" for="aracnidos">
                                        Aracnidos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->hormigas == 'Si') checked @endif id="hormigas"name="hormigas">
                                    <label class="form-check-label" for="hormigas">
                                        Hormigas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->termitas == 'Si') checked @endif id="termitas" name="termitas">
                                    <label class="form-check-label" for="termitas">
                                        Termitas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->roedores == 'Si') checked @endif id="roedores" name="roedores">
                                    <label class="form-check-label" for="roedores">
                                        Roedores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->alacranes == 'Si') checked @endif id="alacranes"
                                        name="alacranes">
                                    <label class="form-check-label" for="alacranes">
                                        Alacranes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" disabled
                                        @if ($fumigacione->carcamo == 'Si') checked @endif id="carcamo" name="carcamo">
                                    <label class="form-check-label" for="carcamo">
                                        Carcamo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <b>Observaciones:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->observaciones }}
                        </li>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ $a }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ========================================================== --}}
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ $a }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar la Fumigación
                                {{ $fumigacione->numerofumigacion }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ $a }}').modal('hide')">
                    </div>
                    <form action="{{ route('fumigaciones.destroy', $fumigacione->id) }}"method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ $a }}').modal('hide')">
                                            NO</button>
                                        <button type="submit" class="btn btn-success">
                                            SI</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ========================================================== --}}
        {{-- ===================== MODAL_STATUS ===================== --}}
        <div class="modal fade" id="update{{ $a }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>Actualizar Status
                                Folio Fumigación:
                                {{ $fumigacione->numerofumigacion }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#update{{ $a }}').modal('hide')">
                    </div>
                    <form action="{{ route('fumigaciones.update', $fumigacione->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="numerofumigacion">Folio de Fumigación</label>
                                                <input type="text" name="numerofumigacion" class="form-control"
                                                    value="{{ $fumigacione->numerofumigacion }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="unidad">Unidad</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $fumigacione->unidad }}" readonly="readonly">
                                            </div>
                                        </div>
                                        {{--  --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="id_fumigador">Fumigador</label>
                                                <select name="id_fumigador" id="id_fumigador" class=" selectsearch">
                                                    <option value="{{ $fumigacione->id_fumigador }}" selected>
                                                        {{ $fumigacione->id_fumigador }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        @php
                                            /* FECHA ACTUAL */
                                            $fecha_actual = date('Y-n-d');
                                        @endphp
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="fechaprogramada">Fecha de Servicio</label>
                                                <input type="datetime-local" name="fechaprogramada" class="form-control"
                                                    value="{{ $fumigacione->fechaprogramada }}"
                                                    min="{{ date('Y-n-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="fechaultimafumigacion">Fecha ultima fumigacion</label>
                                                <input type="text" name="fechaultimafumigacion" class="form-control"
                                                    value="{{ $fumigacione->fechaultimafumigacion }}"
                                                    readonly="readonly">
                                            </div>
                                        </div>
                                        {{-- MOSTRAR SI ES V O H --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="lugardelservicio">Lugar de Servicio</label>
                                                <input type="text" name="lugardelservicio" class="form-control"
                                                    readonly="readonly" value="{{ $fumigacione->lugardelservicio }}">
                                            </div>
                                        </div>
                                        {{--  --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="tipo">Tipo</label>
                                                <select name="tipo" id="tipo" class=" selectsearch">
                                                    <option value="Tipo" selected>Tipos</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="numerodevisitas">Numero de Visitas</label>
                                                <input type="text" name="numerodevisitas" class="form-control"
                                                    value="{{ $fumigacione->numerodevisitas }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="costo">Costo</label>
                                                <input type="text" name="costo" class="form-control"
                                                    value="{{ $fumigacione->costo }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="producto">Producto Utilizado</label>
                                                <select name="producto" id="producto" class=" selectsearch">
                                                    <option value="CYNOFF 40 PH"
                                                        @if ($fumigacione->producto == 'CYNOFF 40 PH') selected @endif>CYNOFF 40 PH
                                                    </option>
                                                    <option value="BIOTRINE FLOW"
                                                        @if ($fumigacione->producto == 'BIOTRINE FLOW') selected @endif>BIOTRINE FLOW
                                                    </option>
                                                    <option value="BIOTRINE C.E."
                                                        @if ($fumigacione->producto == 'BIOTRINE C.E.') selected @endif>BIOTRINE C.E.
                                                    </option>
                                                    <option value="ELEGY"
                                                        @if ($fumigacione->producto == 'ELEGY') selected @endif>
                                                        ELEGY</option>
                                                    <option value="TERMIDOR"
                                                        @if ($fumigacione->producto == 'TERMIDOR') selected @endif>
                                                        TERMIDOR</option>
                                                    <option value="TEMRPID SC"
                                                        @if ($fumigacione->producto == 'TEMRPID SC') selected @endif>TEMRPID SC
                                                    </option>
                                                    <option value="TYSON2E"
                                                        @if ($fumigacione->producto == 'TYSON2E') selected @endif>
                                                        TYSON2E</option>
                                                    <option value="DDVP 500"
                                                        @if ($fumigacione->producto == 'DDVP 500') selected @endif>
                                                        DDVP 500</option>
                                                    <option value="SIEGE"
                                                        @if ($fumigacione->producto == 'SIEGE') selected @endif>
                                                        SIEGE</option>
                                                    <option value="MAXFORCE"
                                                        @if ($fumigacione->producto == 'MAXFORCE') selected @endif>MAXFORCE
                                                    </option>
                                                    <option value="TALÓN BLOQUE"
                                                        @if ($fumigacione->producto == 'TALÓN BLOQUE') selected @endif>TALÓN BLOQUE
                                                    </option>
                                                    <option value="STORM"
                                                        @if ($fumigacione->producto == 'STORM') selected @endif>
                                                        STORM</option>
                                                    <option value="ARMA"
                                                        @if ($fumigacione->producto == 'ARMA') selected @endif>
                                                        ARMA</option>
                                                    <option value="RODILON BLOQUE"
                                                        @if ($fumigacione->producto == 'RODILON BLOQUE') selected @endif>RODILON BLOQUE
                                                    </option>
                                                    <option value="DIFARAT"
                                                        @if ($fumigacione->producto == 'DIFARAT') selected @endif>DIFARAT</option>
                                                    <option value="C-REALB"
                                                        @if ($fumigacione->producto == 'C-REALB') selected @endif>C-REALB</option>
                                                    <option value="BETA QUAT 4"
                                                        @if ($fumigacione->producto == 'BETA QUAT 4') selected @endif>BETA QUAT 4
                                                    </option>
                                                    <option value="VIRTUAL"
                                                        @if ($fumigacione->producto == 'VIRTUAL') selected @endif>VIRTUAL</option>
                                                    <option value="SAVAGE"
                                                        @if ($fumigacione->producto == 'SAVAGE') selected @endif>
                                                        SAVAGE</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- \\\\\\\\\\\ valor no PLAGAS \\\\\\\\\\\ --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12 card-deck" hidden>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="insectosvoladores" name="insectosvoladores">
                                                    <label class="form-check-label" for="insectosvoladores">
                                                        Insectos Voladores
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="insectosrastreros" name="insectosrastreros">
                                                    <label class="form-check-label" for="insectosrastreros">
                                                        Insectos Rastreros
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="cucaracha" name="cucaracha">
                                                    <label class="form-check-label" for="cucaracha">
                                                        Cucaracha (Ger/Ori/Ame)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="pulgas" name="pulgas">
                                                    <label class="form-check-label" for="pulgas">
                                                        Pulgas
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="mosca" name="mosca">
                                                    <label class="form-check-label" for="mosca">
                                                        Mosca
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="chinches" name="chinches">
                                                    <label class="form-check-label" for="chinches">
                                                        Chinches
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="aracnidos" name="aracnidos">
                                                    <label class="form-check-label" for="aracnidos">
                                                        Aracnidos
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="hormigas" name="hormigas">
                                                    <label class="form-check-label" for="hormigas">
                                                        Hormigas
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="termitas" name="termitas">
                                                    <label class="form-check-label" for="termitas">
                                                        Termitas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="roedores" name="roedores">
                                                    <label class="form-check-label" for="roedores">
                                                        Roedores
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="alacranes" name="alacranes">
                                                    <label class="form-check-label" for="alacranes">
                                                        Alacranes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="No"
                                                        checked id="carcamo" name="carcamo">
                                                    <label class="form-check-label" for="carcamo">
                                                        Carcamo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  --}}
                                        {{-- \\\\\\\\\\\ PLAGAS \\\\\\\\\\\ --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12 card-deck" hidden>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="insectosvoladores" name="insectosvoladores"
                                                        @if ($fumigacione->insectosvoladores == 'Si') checked @endif>
                                                    <label class="form-check-label" for="insectosvoladores">
                                                        Insectos Voladores
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="insectosrastreros" name="insectosrastreros"
                                                        @if ($fumigacione->insectosrastreros == 'Si') checked @endif>
                                                    <label class="form-check-label" for="insectosrastreros">
                                                        Insectos Rastreros
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="cucaracha" name="cucaracha"
                                                        @if ($fumigacione->cucaracha == 'Si') checked @endif>
                                                    <label class="form-check-label" for="cucaracha">
                                                        Cucaracha (Ger/Ori/Ame)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="pulgas" name="pulgas"
                                                        @if ($fumigacione->pulgas == 'Si') checked @endif>
                                                    <label class="form-check-label" for="pulgas">
                                                        Pulgas
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="mosca" name="mosca"
                                                        @if ($fumigacione->mosca == 'Si') checked @endif>
                                                    <label class="form-check-label" for="mosca">
                                                        Mosca
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="chinches" name="chinches"
                                                        @if ($fumigacione->chinches == 'Si') checked @endif>
                                                    <label class="form-check-label" for="chinches">
                                                        Chinches
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="aracnidos" name="aracnidos"
                                                        @if ($fumigacione->aracnidos == 'Si') checked @endif>
                                                    <label class="form-check-label" for="aracnidos">
                                                        Aracnidos
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="hormigas" name="hormigas"
                                                        @if ($fumigacione->hormigas == 'Si') checked @endif>
                                                    <label class="form-check-label" for="hormigas">
                                                        Hormigas
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="termitas" name="termitas"
                                                        @if ($fumigacione->termitas == 'Si') checked @endif>
                                                    <label class="form-check-label" for="termitas">
                                                        Termitas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="roedores" name="roedores"
                                                        @if ($fumigacione->roedores == 'Si') checked @endif>
                                                    <label class="form-check-label" for="roedores">
                                                        Roedores
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="alacranes" name="alacranes"
                                                        @if ($fumigacione->alacranes == 'Si') checked @endif>
                                                    <label class="form-check-label" for="alacranes">
                                                        Alacranes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="carcamo" name="carcamo"
                                                        @if ($fumigacione->carcamo == 'Si') checked @endif>
                                                    <label class="form-check-label" for="carcamo">
                                                        Carcamo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  --}}
                                        <br>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class=" selectsearch">
                                                    <option disabled value="">Selecciona un Status</option>
                                                    <option @if ($fumigacione->status == 'Realizado') selected @endif
                                                        value="Realizado">Realizado</option>
                                                    <option @if ($fumigacione->status == 'Cancelado') selected @endif
                                                        value="Cancelado">Cancelado</option>
                                                    <option @if ($fumigacione->status == 'Reprogramado') selected @endif
                                                        value="Reprogramado">Reprogramado</option>
                                                    <option @if ($fumigacione->status == 'Pendiente') selected @endif
                                                        value="Pendiente">Pendiente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="observaciones">Observaciones</label>
                                                <textarea name="observaciones" id="observaciones" class="form-control" rows="7">{{ $fumigacione->observaciones }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @php
            $a = $a . 'a';
        @endphp
    @endforeach
    {{-- =========================================== --}}
@endsection
