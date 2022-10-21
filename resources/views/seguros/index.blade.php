@extends('layouts.app')
@section('title')
    Seguros
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Seguros: {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.show', $usuario = $unidad) }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('seguros.show', $unidad) }}">Nuevo</a>
                            <table class="table table-striped mt-2" id="tabla">
                                <a class="btn btn-success" href="{{ route('seguros.export', $unidad) }}"><i
                                        class="fas fa-file-excel"></i></a>
                                <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar....">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">No. Poliza</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($seguros as $seguro)
                                        <tr>
                                            <td style="display: none;">{{ $seguro->id }}</td>
                                            <td>{{ $seguro->nopoliza }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ $a }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                @if ($seguro->estado == 'Activo')
                                                    <h5><span class="badge badge-success">Activo</span>
                                                    </h5>
                                                @else
                                                    <h5><span class="badge badge-danger">Inactivo</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('seguros.edit', $seguro->id) }}">
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

                            <!-- Ubicamos la paginacion a la derecha -->
                            {{-- <div class="pagination justify-content-end">
                                {!! $seguros->links() !!}
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
    @foreach ($seguros as $seguro)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $seguro->nopoliza }}</b></h5>
                        <button type="button" class="btn-close" onclick="$('#{{ $a }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Unidad:</b>
                        <li class="list-group-item">
                            {{ $seguro->id_unidad }}
                        </li>
                        <br>
                        <b>Fecha de Inicio:</b>
                        <li class="list-group-item">
                            {{ $seguro->fechainicio }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento:</b>
                        <li class="list-group-item">
                            {{ $seguro->fechavencimiento }}
                        </li>
                        <br>
                        <b>Tipo de Seguro:</b>
                        <li class="list-group-item">
                            {{ $seguro->tiposeguro }}
                        </li>
                        <br>
                        <b>Caratula del Seguro:</b>
                        <li class="list-group-item">
                            {{ $seguro->caratulaseguro }}
                        </li>
                        <br>
                        <b>Proveedor:</b>
                        <li class="list-group-item">
                            {{ $seguro->provedor }}
                        </li>
                        <br>
                        <b>Precio:</b>
                        <li class="list-group-item">
                            {{ $seguro->precio }}
                        </li>
                        <br>
                        <b>Impuestos:</b>
                        <li class="list-group-item">
                            {{ $seguro->impuestos }}
                        </li>
                        <br>
                        <b>Costo Total:</b>
                        <li class="list-group-item">
                            {{ $seguro->costototal }}
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
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ $a }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar el Seguro
                                {{ $seguro->nopoliza }}?</b></h5>
                        <button type="button" class="btn-close" onclick="$('#delete{{ $a }}').modal('hide')">
                    </div>
                    <form action="{{ route('seguros.destroy', $seguro->id, $unidad) }}" method="POST">
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
