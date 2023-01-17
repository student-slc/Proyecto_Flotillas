@extends('layouts.app')
@section('title')
    Folios
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Folios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('folios.create') }}">Nuevo</a>
                            <table id='tablas-style' class="table table-striped mt-2">
                                {{-- <a class="btn btn-success" href="{{ route('operadores.export', $usuario) }}"><i
                                        class="fas fa-file-excel"></i></a> --}}
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Folio</th>
                                    <th style="color:#fff;">Fecha Creación</th>
                                    <th style="color:#fff;">Folio Inicial</th>
                                    <th style="color:#fff;">Folio Final</th>
                                    <th style="color:#fff;">Folio Actual</th>
                                    <th style="color:#fff;">Tipo de Folio</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($folios as $folio)
                                        <tr>
                                            <td style="display: none;">{{ $folio->id }}</td>
                                            <td>{{ $folio->nombre }}</td>
                                            <td>{{ $folio->fecha_update }}</td>
                                            <td>{{ $folio->folio }}</td>
                                            <td>{{ $folio->folio }}</td>
                                            <td>{{ $folio->folio }}</td>
                                            <td>{{ $folio->tipo }}</td>
                                            {{-- ====================== --}}
                                            <td>
                                                <button type="submit" class="btn btn-info"
                                                    onclick="$('#edit{{ str_replace(' ', '', $folio->id) }}').modal('show')">
                                                    <i class="fas fa-edit"></i></button>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="$('#delete{{ str_replace(' ', '', $folio->id) }}').modal('show')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            {{-- ============================================================== --}}
                                        </tr>
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
    @foreach ($folios as $folio)
        {{-- ===================== MODAL_ELIMINAR ===================== --}}
        <div class="modal fade" id="delete{{ str_replace(' ', '', $folio->id) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>¿Estas Seguro de
                                Eliminar este Folio
                                {{ $folio->nombre }}?</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#delete{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
                    </div>
                    <form action="{{ route('folios.destroy', $folio->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#delete{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
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
        {{-- ===================== MODAL_EDITAR ===================== --}}
        <div class="modal fade" id="edit{{ str_replace(' ', '', $folio->id) }}" tabindex="-1" role="dialog"
            aria-labelledby="ModalDetallesTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center"><b>
                                Folio:
                                {{ $folio->nombre }}</b></h5>
                        <button type="button" class="btn-close"
                            onclick="$('#licencia{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
                    </div>
                    <form action="{{ route('folios.update', $folio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-footer">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center ">
                                    <div class="col text-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" class="form-control"
                                                    value="{{ $folio->nombre }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="fecha_update">Fecha de Registro</label>
                                                <input type="date" name="fecha_update" class="form-control"
                                                    value="{{ $folio->fecha_update }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="folio">Folio</label>
                                                <input type="text" name="folio" class="form-control"
                                                    value="{{ $folio->folio }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="rango">Numero de Folios</label>
                                                <input type="text" name="rango" class="form-control"
                                                    value="{{ $folio->rango }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="contador">contador</label>
                                                <input type="text" name="contador" class="form-control"
                                                    value="{{ $folio->contador }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="tipo">Tipo De Folio</label>
                                                <select name="tipo" id="tipo" class=" selectsearch">
                                                    <option disabled value="">Selecciona el Tipo de Folio</option>
                                                    @if ($folio->tipo == 'Ambiental')
                                                        <option selected value="Ambiental">Ambiental</option>
                                                    @else
                                                        <option value="Ambiental">Ambiental</option>
                                                    @endif
                                                    @if ($folio->tipo == 'Fisico-Mecanica')
                                                        <option selected value="Fisico-Mecanica">Fisico-Mecanica</option>
                                                    @else
                                                        <option value="Fisico-Mecanica">Fisico-Mecanica</option>
                                                    @endif
                                                    {{-- <option value="No Pagado">No Pagado</option>
                                                    <option value="Pagado">Pagado</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            GUARDAR</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="$('#edit{{ str_replace(' ', '', $folio->id) }}').modal('hide')">
                                            CANCELAR</button>
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
