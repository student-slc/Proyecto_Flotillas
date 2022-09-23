@extends('layouts.app')
@section('title')
    Clientes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Cliente</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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
                            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nombrecompleto">Nombre Completo</label>
                                            <input type="text" name="nombrecompleto" class="form-control"
                                            value="{{ $cliente->nombrecompleto }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="razonsocial">Razon Social</label>
                                            <input type="text" name="razonsocial" class="form-control"
                                            value="{{ $cliente->razonsocial }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="direccionfisica">Dirección Fisica</label>
                                            <input type="text" name="direccionfisica" class="form-control"
                                            value="{{ $cliente->direccionfisica }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="statuspago">Status de Servivio</label>
                                            <select name="statuspago" id="statuspago" class=" selectsearch">
                                                <option disabled value="">Selecciona Status</option>
                                                @if ($cliente->statuspago=='Sin Servicio')
                                                <option selected value="Sin Servicio">Sin Servicio</option>
                                                @else
                                                <option value="Sin Servicio">Sin Servicio</option>
                                                @endif
                                                @if ($cliente->statuspago=='Por Confirmar')
                                                <option selected value="Por Confirmar">Por Confirmar</option>
                                                @else
                                                <option value="Por Confirmar">Por Confirmar</option>
                                                @endif
                                                @if ($cliente->statuspago=='En Ejecucion')
                                                <option selected value="En Ejecucion">En Ejecucion</option>
                                                @else
                                                <option value="En Ejecucion">En Ejecucion</option>
                                                @endif
                                                @if ($cliente->statuspago=='No Pagado')
                                                <option selected value="No Pagado">No Pagado</option>
                                                @else
                                                <option value="No Pagado">No Pagado</option>
                                                @endif
                                                @if ($cliente->statuspago=='Pagado')
                                                <option selected value="Pagado">Pagado</option>
                                                @else
                                                <option value="Pagado">Pagado</option>
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
