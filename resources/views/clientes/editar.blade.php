@extends('layouts.app')
@section('title')
    Clientes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Cliente: {{ $cliente->nombrecompleto }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @method('PUT')
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
                                                <label for="nombrecompleto">Nombre Completo</label>
                                                <input type="text" name="nombrecompleto" class="form-control"
                                                    value="{{ $cliente->nombrecompleto }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="telefono">Telefono</label>
                                                <input type="text" name="telefono" class="form-control"
                                                    value="{{ $cliente->telefono }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="codigopostal">Codigo Postal</label>
                                                <input type="text" name="codigopostal" class="form-control"
                                                    value="{{ $cliente->codigopostal }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="estado">Estado</label>
                                                <input type="text" name="estado" class="form-control"
                                                value="{{ $cliente->estado }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad</label>
                                                <input type="text" name="ciudad" class="form-control"
                                                    value="{{ $cliente->ciudad }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="municipio">Municipio</label>
                                                <input type="text" name="municipio" class="form-control"
                                                    value="{{ $cliente->municipio }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="colonia">Colonia</label>
                                                <input type="text" name="colonia" class="form-control"
                                                    value="{{ $cliente->colonia }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="direccionfisica">Dirección</label>
                                                <input type="text" name="direccionfisica" class="form-control"
                                                    value="{{ $cliente->direccionfisica }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="correo">Correo</label>
                                                <input type="text" name="correo" class="form-control"
                                                    value="{{ $cliente->correo }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="statuspago">Status de Servivio</label>
                                                <select name="statuspago" id="statuspago" class=" selectsearch">
                                                    @if ($cliente->statuspago == 'Sin Servicio')
                                                        <option value="Sin Servicio" selected>Sin Servicio</option>
                                                    @else
                                                        <option value="Sin Servicio">Sin Servicio</option>
                                                    @endif
                                                    @if ($cliente->statuspago == 'Por Confirmar')
                                                        <option value="Por Confirmar" selected>Por Confirmar</option>
                                                    @else
                                                        <option value="Por Confirmar">Por Confirmar</option>
                                                    @endif
                                                    @if ($cliente->statuspago == 'En Ejecucion')
                                                        <option value="En Ejecucion" selected>En Ejecucion</option>
                                                    @else
                                                        <option value="En Ejecucion">En Ejecucion</option>
                                                    @endif
                                                    @if ($cliente->statuspago == 'No Pagado')
                                                        <option value="No Pagado" selected>No Pagado</option>
                                                    @else
                                                        <option value="No Pagado">No Pagado</option>
                                                    @endif
                                                    @if ($cliente->statuspago == 'Pagado')
                                                        <option value="Pagado" selected>Pagado</option>
                                                    @else
                                                        <option value="Pagado">Pagado</option>
                                                    @endif
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
                                            <input type="text" name="razonsocial" class="form-control"
                                                value="{{ $cliente->razonsocial }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="rfc">RFC</label>
                                            <input type="text" name="rfc" class="form-control"
                                                value="{{ $cliente->rfc }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="text" name="numero" class="form-control"
                                                value="{{ $cliente->numero }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control" rows="7"
                                                >{{ $cliente->observaciones }}</textarea>
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
