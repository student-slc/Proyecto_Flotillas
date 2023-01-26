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
                            <a class="btn btn-warning" href="{{ route('fumigaciones.crear',$unidad) }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                <a class="btn btn-success" href="{{ route('fumigaciones.export') }}"><i
                                        class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Identificador Fumigación</th>
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
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                @if ($fumigacione->status == 'En Proceso')
                                                    <h5><span class="badge badge-warning">{{ $fumigacione->status }}</span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Concluido')
                                                    <h5><span class="badge badge-success">{{ $fumigacione->status }}</span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Por Confirmar')
                                                    <h5><span class="badge badge-warning">{{ $fumigacione->status }}</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-info"
                                                    href="{{ route('fumigaciones.edit', $fumigacione->id) }}">
                                                    <i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger"
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
                                Información de la Fumigación: {{ $fumigacione->numerofumigacion }}</b></h5>
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
                        <b>Fecha Programada:</b>
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
                        <b>Satisfacciòn del Servicio:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->satisfaccionservicio }}
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
                        <button type="button" class="btn-close" onclick="$('#delete{{ $a }}').modal('hide')">
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
        @php
            $a = $a . 'a';
        @endphp
    @endforeach
    {{-- =========================================== --}}
@endsection
