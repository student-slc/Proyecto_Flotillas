@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Unidad a {{ $usuario }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('clientes.show', $usuario) }}">Regresar</a>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('unidades.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    {{-- ========================================= OCULTOS ========================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="seguro">seguro</label>
                                            <input type="text" name="seguro" class="form-control" value="Sin Seguro">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="verificacion">verificacion</label>
                                            <input type="text" name="verificacion" class="form-control"
                                                value="Sin Verificación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="mantenimiento">mantenimiento</label>
                                            <input type="text" name="mantenimiento" class="form-control"
                                                value="Sin Mantenimiento">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="cliente">cliente</label>
                                            <input type="text" name="cliente" class="form-control"
                                                value="{{ $usuario }}">
                                        </div>
                                    </div>
                                    {{-- ========================================================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="serieunidad">No. Serie</label>
                                            <input type="text" name="serieunidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="marca">Marca</label>
                                            <input type="text" name="marca" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="submarca">Sub Marca</label>
                                            <input type="text" name="submarca" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="añounidad">Año</label>
                                            <input type="number" min="1900" max="2099" step="1"
                                                value="2022" name="añounidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="tipounidad">Tipo</label>
                                            <input type="text" name="tipounidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="razonsocialunidad">Razon Social</label>
                                            <input type="text" name="razonsocialunidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="placas">Placas</label>
                                            <input type="text" name="placas" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status de Servivio</label>
                                            <select name="status" id="status" class=" selectsearch">
                                                <option disabled selected value="">Selecciona Status</option>
                                                <option value="Status 1">Status 1</option>
                                                <option value="Status 2">Status 2</option>
                                                <option value="Status 3">Status 3</option>
                                                {{-- <option value="No Pagado">No Pagado</option>
                                                <option value="Pagado">Pagado</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
