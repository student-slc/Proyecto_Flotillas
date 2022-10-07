@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Unidades de {{ $usuario }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.index') }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('unidades.crear', $usuario) }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">No. Serie</th>
                                    <th style="color:#fff;">Información Unidad</th>
                                    <th style="color:#fff;">Seguro</th>
                                    <th style="color:#fff;">Verificación</th>
                                    <th style="color:#fff;">Mantenimiento</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                    @endphp
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td style="display: none;">{{ $unidade->id }}</td>
                                            <td>{{ $unidade->serieunidad }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#{{ $a }}">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                @if ($unidade->seguro == 'Sin Seguro')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->seguro }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->seguro == 'Con Seguro')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->seguro }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($unidade->verificacion == 'Sin Verificación')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->verificacion }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->verificacion == 'Con Verificación')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('verificaciones.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->verificacion }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->mantenimiento }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->mantenimiento == 'Con Mantenimiento')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->mantenimiento }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('unidades.destroy', $unidade->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('unidades.edit', $unidade->id) }}">
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
                                {!! $unidades->links() !!}
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
    @foreach ($unidades as $unidade)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $unidade->serieunidad }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" class="close" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <b>Marca:</b>
                        <li class="list-group-item">
                            {{ $unidade->marca }}
                        </li>
                        <br>
                        <b>SubMarca:</b>
                        <li class="list-group-item">
                            {{ $unidade->submarca }}
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
                        <b>Razon Social:</b>
                        <li class="list-group-item">
                            {{ $unidade->razonsocialunidad }}
                        </li>
                        <br>
                        <b>Placas:</b>
                        <li class="list-group-item">
                            {{ $unidade->placas }}
                        </li>
                        <br>
                        <b>Status:</b>
                        <li class="list-group-item">
                            {{ $unidade->status }}
                        </li>
                        <br>
                        <b>Cliente:</b>
                        <li class="list-group-item">
                            {{ $unidade->cliente }}
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
