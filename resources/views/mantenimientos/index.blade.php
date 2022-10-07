@extends('layouts.app')
@section('title')
    Mantenimientos
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Mantenimientos: {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.show', $usuario = $unidad) }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('mantenimientos.crear', $unidad) }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Identificador</th>
                                    <th style="color:#fff;">Información</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($mantenimientos as $mantenimiento)
                                        <tr>
                                            <td style="display: none;">{{ $mantenimiento->id }}</td>
                                            <td>{{ $mantenimiento->id }}</td>
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
                                                <form action="{{ route('mantenimientos.destroy', $mantenimiento->id, $unidad) }}"
                                                    method="POST">
                                                    <a class="btn btn-info" href="{{ route('mantenimientos.edit', $mantenimiento->id) }}">
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
                                {!! $mantenimientos->links() !!}
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
    @foreach ($mantenimientos as $mantenimiento)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $mantenimiento->id }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" class="close" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <b>Unidad:</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->id_unidad }}
                        </li>
                        <br>
                        <b>Kilometros Finales</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->kmfinales }}
                        </li>
                        <br>
                        <b>Fecha</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->fecha }}
                        </li>
                        <br>
                        <b>Frecuencia</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->frecuencia }}
                        </li>
                        <br>
                        <b>Siguiente Servicio</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->sigservicio }}
                        </li>
                        <br>
                        <b>Kilometros Faltantes</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->kmfaltantes }}
                        </li>
                        <br>
                        <b>Tipo de Mantenimiento</b>
                        <li class="list-group-item">
                            {{ $mantenimiento->tipomantenimiento }}
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
