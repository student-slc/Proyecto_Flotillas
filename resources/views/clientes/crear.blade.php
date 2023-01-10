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
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <a class="btn btn-danger" href="{{ route('clientes.index') }}">Regresar</a>
                        <div class="card-deck mt-2">
                            {{-- ============== DATOS PERSONALES ============== --}}
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Datos Personales</h4>
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
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="nombrecompleto">Nombre del Cliente</label>
                                                <input type="text" name="nombrecompleto" class="form-control">
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
                                                <label for="nombrecompletoc">Nombre del Contacto</label>
                                                <input type="text" name="nombrecompletoc" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="telefonoc">Telefono Contacto</label>
                                                <input type="text" name="telefonoc" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="codigopostal">Codigo Postal</label>
                                                <input type="text" name="codigopostal" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="estado">Estado</label>
                                                <input type="text" name="estado" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad</label>
                                                <input type="text" name="ciudad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="municipio">Municipio</label>
                                                <input type="text" name="municipio" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="colonia">Colonia</label>
                                                <input type="text" name="colonia" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="direccionfisica">Dirección</label>
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
                                                <label for="observaciones">Observaciones</label>
                                                <textarea name="observaciones" id="observaciones" class="form-control" rows="7"></textarea>
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
                                    </div>
                                </div>
                            </div>
                            {{-- ================================================= --}}
                            {{-- ============== DATOS DE FACTURACION ============== --}}
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Datos de Facturación</h4>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="razonsocial">Razon Social</label>
                                            <input type="text" name="razonsocial" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="rfc">RFC</label>
                                            <input type="text" name="rfc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" name="numero" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="regimen_fiscal">Regimen Fiscal</label>
                                            <input type="text" name="regimen_fiscal" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="sfdi">SFDI</label>
                                            <input type="text" name="sfdi" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ================================================= --}}
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
    </section>
@endsection
