@extends('layouts.app')
@section('title')
    Fumigadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigadores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigadores.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Informacion</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($fumigadores as $fumigadore)
                                        <tr>
                                            <td style="display: none;">{{ $fumigadore->id }}</td>
                                            <td>{{ $fumigadore->nombrecompleto }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="$('#{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('show')">
                                                    Detalles
                                                </button>
                                            </td>
                                            {{-- ====================== --}}
                                            <td>
                                                <form action="{{ route('fumigadores.destroy', $fumigadore->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('fumigadores.edit', $fumigadore->id) }}">
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
                                {!! $fumigadores->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MODAL --}}
    @foreach ($fumigadores as $fumigadore)
        <div class="modal fade" id="{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>Informacion de
                                {{ $fumigadore->nombrecompleto }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('hide')">
                    </div>
                    <div class="modal-body">
                        <b>Fecha de Nacimiento:</b>
                        <li class="list-group-item">
                            {{ $fumigadore->fechanacimiento }}
                        </li>
                        <br>
                        <b>Certificado:</b>
                        <li class="list-group-item">
                            {{ $fumigadore->certificacion }}
                        </li>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            onclick="$('#{{ str_replace(' ', '', $fumigadore->nombrecompleto) }}').modal('hide')">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- =========================================== --}}
@endsection
