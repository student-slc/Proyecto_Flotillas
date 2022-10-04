@extends('layouts.app')
@section('title')
    Clientes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Clientes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('clientes.index') }}">Regresar</a>
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

                            <form action="{{ route('clientes.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nombrecompleto">Nombre Completo</label>
                                            <input type="text" name="nombrecompleto" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="razonsocial">Razon Social</label>
                                            <input type="text" name="razonsocial" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="telefono">Telefono</label>
                                            <input type="text" name="telefono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="direccionfisica">Dirección Fisica</label>
                                            <input type="text" name="direccionfisica" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input type="text" name="correo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="statuspago">Status de Servivio</label>
                                            <select name="statuspago" id="statuspago" class=" selectsearch">
                                                <option disabled selected value="">Selecciona Status</option>
                                                <option value="Sin Servicio">Sin Servicio</option>
                                                <option value="Por Confirmar">Por Confirmar</option>
                                                <option value="En Ejecucion">En Ejecucion </option>
                                                <option value="No Pagado">No Pagado</option>
                                                <option value="Pagado">Pagado</option>
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
