@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigaciones.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Informaciòn</th>
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
                                            <td>{{ $fumigacione->id_cliente }}</td>
                                            {{-- Boton MODAL --}}
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#{{ $a }}">
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
                                            </td>
                                            <td>
                                                <form action="{{ route('fumigaciones.destroy', $fumigacione->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('fumigaciones.edit', $fumigacione->id) }}">
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
                                {!! $fumigaciones->links() !!}
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
    @foreach ($fumigaciones as $fumigacione)
        <div class="modal fade" id="{{ $a }}" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle"><b>
                                Informacion de la Fumigaciòn</b></h5>
                        <button type="button" class="close" data-dismiss="modal" class="close" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">
                        <b>Cliente:</b>
                        <li class="list-group-item">
                            {{ $fumigacione->id_cliente }}
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
