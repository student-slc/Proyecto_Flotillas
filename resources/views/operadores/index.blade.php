@extends('layouts.app')
@section('title')
    Operadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Operadores de : {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.show', $usuario = $unidad) }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($numero == 0)
                                <a class="btn btn-warning" href="{{ route('operadores.crear', $unidad) }}">Nuevo</a>
                            @endif
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Operador</th>
                                    <th style="color:#fff;">Informacion</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($operadores as $operadore)
                                        <tr>
                                            <td style="display: none;">{{ $operadore->id }}</td>
                                            <td>{{ $operadore->nombreoperador }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#{{ str_replace(' ', '', $operadore->nombreoperador) }}">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                <form action="{{ route('operadores.destroy', $operadore->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('operadores.edit', $operadore->id) }}">
                                                        <i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $operadores->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($operadores as $operadore)
        <div class="modal fade" id="{{ str_replace(' ', '', $operadore->nombreoperador) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $operadore->nombreoperador }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" class="close" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <b>Fecha Nacimiento:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechanacimiento }}
                        </li>
                        <br>
                        <b>Numero de Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->nolicencia }}
                        </li>
                        <br>
                        <b>Tipo de Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->tipolicencia }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento Medico:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechavencimientomedico }}
                        </li>
                        <br>
                        <b>Fecha de Vencimiento Licencia:</b>
                        <li class="list-group-item">
                            {{ $operadore->fechavencimientolicencia }}
                        </li>
                        <br>
                        <b>Unidad:</b>
                        <li class="list-group-item">
                            {{ $operadore->unidad }}
                        </li>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- =========================================== --}}
@endsection
