@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Unidad de {{ $unidade->cliente }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('clientes.show', $usuario=$unidade->cliente) }}">Regresar</a>
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
                            <form action="{{ route('unidades.update', $unidade->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- ========================================= OCULTOS ========================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="seguro">seguro</label>
                                        <input type="text" name="seguro" class="form-control"
                                            value="{{ $unidade->seguro }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="verificacion">verificacion</label>
                                        <input type="text" name="verificacion" class="form-control"
                                            value="{{ $unidade->verificacion }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="mantenimiento">mantenimiento</label>
                                        <input type="text" name="mantenimiento" class="form-control"
                                            value="{{ $unidade->mantenimiento }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="cliente">cliente</label>
                                        <input type="text" name="cliente" class="form-control"
                                            value="{{ $unidade->cliente }}">
                                    </div>
                                </div>
                                {{-- ========================================================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="serieunidad">No. Serie</label>
                                        <input type="text" name="serieunidad" class="form-control"
                                            value="{{ $unidade->serieunidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" name="marca" class="form-control"
                                            value="{{ $unidade->marca }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="submarca">Sub Marca</label>
                                        <input type="text" name="submarca" class="form-control"
                                            value="{{ $unidade->submarca }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="añounidad">Año</label>
                                        <input type="number" min="1900" max="2099" step="1" type="text"
                                            name="añounidad" class="form-control" value="{{ $unidade->añounidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tipounidad">Tipo</label>
                                        <input type="text" name="tipounidad" class="form-control"
                                            value="{{ $unidade->tipounidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="razonsocialunidad">Razon Social</label>
                                        <input type="text" name="razonsocialunidad" class="form-control"
                                            value="{{ $unidade->razonsocialunidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="placas">Placas</label>
                                        <input type="text" name="placas" class="form-control"
                                            value="{{ $unidade->placas }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="status">Status de Servivio</label>
                                        <select name="status" id="status" class=" selectsearch">
                                            <option disabled value="">Selecciona Status</option>
                                            @if ($unidade->status == 'Status 1')
                                                <option selected value="Status 1">Status 1</option>
                                            @else
                                                <option value="Status 1">Status 1</option>
                                            @endif
                                            @if ($unidade->status == 'Status 2')
                                                <option selected value="Status 2">Status 2</option>
                                            @else
                                                <option value="Status 2">Status 2</option>
                                            @endif
                                            @if ($unidade->status == 'Status 3')
                                                <option selected value="Status 3">Status 3</option>
                                            @else
                                                <option value="Status 3">Status 3</option>
                                            @endif
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
