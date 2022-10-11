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
                                    <th style="color:#fff;">Operadores</th>
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
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ str_replace(' ', '', $cliente->nombrecompleto) }}').modal('show')">
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
                                                <a class="btn btn-dark"
                                                    href="{{ route('operadores.show', $usuario = $cliente->nombrecompleto) }}">
                                                    <i class="fas fa-address-card"></i>
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
                                                <a class="btn btn-info" href="{{ route('clientes.edit', $cliente->id) }}">
                                                    <i class="fas fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="$('#delete{{ str_replace(' ', '', $cliente->nombrecompleto) }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
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
@endsection
@section('modal')
    {{-- ===================== MODAL_DETALLES ===================== --}}
    @foreach ($clientes as $cliente)
        <div class="modal fade" id="{{ str_replace(' ', '', $cliente->nombrecompleto) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $cliente->nombrecompleto }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#{{ str_replace(' ', '', $cliente->nombrecompleto) }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <h5 style="text-align: center">Datos de Personales</h5>
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
                        <b>Municipio:</b>
                        <li class="list-group-item">
                            {{ $cliente->municipio }}
                        </li>
                        <br>
                        <b>Clonia:</b>
                        <li class="list-group-item">
                            {{ $cliente->colonia }}
                        </li>
                        <br>
                        <b>Estado:</b>
                        <li class="list-group-item">
                            {{ $cliente->estado }}
                        </li>
                        <br>
                        <b>CP:</b>
                        <li class="list-group-item">
                            {{ $cliente->codigopostal }}
                        </li>
                        <br>
                        <h5 style="text-align: center">Datos de Facturación</h5>
                        <b>RFC:</b>
                        <li class="list-group-item">
                            {{ $cliente->rfc }}
                        </li>
                        <br>
                        <b>Razon Social:</b>
                        <li class="list-group-item">
                            {{ $cliente->razonsocial }}
                        </li>
                        <br>
                        <b>Numero:</b>
                        <li class="list-group-item">
                            {{ $cliente->numero }}
                        </li>
                        <br>
                        <b>Observaciones:</b>
                        <li class="list-group-item">
                            {{ $cliente->observaciones }}
                        </li>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ str_replace(' ', '', $cliente->nombrecompleto) }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ========================================================== --}}
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ str_replace(' ', '', $cliente->nombrecompleto) }}" tabindex="-1"
            role="dialog" aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar al Cliente
                                {{ $cliente->nombrecompleto }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ str_replace(' ', '', $cliente->nombrecompleto) }}').modal('hide')">
                    </div>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ str_replace(' ', '', $cliente->nombrecompleto) }}').modal('hide')">
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
    @endforeach
    {{-- =========================================== --}}
@endsection
