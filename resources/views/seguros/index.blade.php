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
                            <table class="table table-striped mt-2">
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#{{ $a }}">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                <h5><span class="badge badge-success">Activo</span>
                                                </h5>
                                            </td>
                                            <td>
                                                <form action="{{ route('seguros.destroy', $seguro->id, $unidad) }}"
                                                    method="POST">
                                                    <a class="btn btn-info" href="{{ route('seguros.edit', $seguro->id) }}">
                                                        <i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $a = $a . 'a';
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $seguros->links() !!}
                            </div>
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
                        <button type="button" class="close" data-dismiss="modal" class="close" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
