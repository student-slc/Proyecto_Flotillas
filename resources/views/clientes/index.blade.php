@extends('layouts.app')
@section('title')
    Clientes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Clientes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('clientes.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Cliente</th>
                                    <th style="color:#fff;">Información completa</th>
                                    <th style="color:#fff;">Unidades</th>
                                    <th style="color:#fff;">Status de Servicio</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td style="display: none;">{{ $cliente->id }}</td>
                                            <td>{{ $cliente->nombrecompleto }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#{{ str_replace(' ', '', $cliente->nombrecompleto) }}">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                <a class="btn btn-dark"
                                                    href="{{ route('clientes.show', $usuario = $cliente->nombrecompleto) }}">
                                                    <i class="fas fa-bus"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($cliente->statuspago == 'Sin Servicio')
                                                    <h5><span class="badge badge-dark">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'Por Confirmar')
                                                    <h5><span class="badge badge-warning">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'En Ejecucion')
                                                    <h5><span class="badge badge-primary">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'No Pagado')
                                                    <h5><span class="badge badge-danger">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'Pagado')
                                                    <h5><span class="badge badge-success">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('clientes.edit', $cliente->id) }}">
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
                                {!! $clientes->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($clientes as $cliente)
        <div class="modal fade" id="{{ str_replace(' ', '', $cliente->nombrecompleto) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $cliente->nombrecompleto }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" class="close"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <b>Telefono:</b>
                        <li class="list-group-item">
                            {{ $cliente->telefono }}
                        </li>
                        <br>
                        <b>Correo:</b>
                        <li class="list-group-item">
                            {{ $cliente->correo }}
                        </li>
                        <br>
                        <b>Dirección:</b>
                        <li class="list-group-item">
                            {{ $cliente->direccionfisica }}
                        </li>
                        <br>
                        <b>Razon Social:</b>
                        <li class="list-group-item">
                            {{ $cliente->razonsocial }}
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
