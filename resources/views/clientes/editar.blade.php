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
                                                <label for="nombrecompletoc">Nombre del Contacto</label>
                                                <input type="text" name="nombrecompletoc" class="form-control"
                                                    value="{{ $cliente->nombrecompletoc }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="telefonoc">Telefono Contacto</label>
                                                <input type="text" name="telefonoc" class="form-control"
                                                    value="{{ $cliente->telefonoc }}">
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
                                            <label for="regimen_fiscal">Regimen Fiscal</label>
                                            <input type="text" name="regimen_fiscal" class="form-control"
                                                value="{{ $cliente->regimen_fiscal }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="sfdi">SFDI</label>
                                            <input type="text" name="sfdi" class="form-control"
                                                value="{{ $cliente->sfdi }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control" rows="7">{{ $cliente->observaciones }}</textarea>
                                        </div>
                                    </div>
                                    {{-- SERVICIOS --}}
                                    {{-- \\\\\\\\\\\ NO \\\\\\\\\\\ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 card-deck" hidden>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_seguro" name="servicio_seguro">
                                                <label class="form-check-label" for="servicio_seguro">
                                                    SEGURO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_ambiental" name="servicio_ambiental">
                                                <label class="form-check-label" for="servicio_ambiental">
                                                    V. AMBIENTAL
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_fisica" name="servicio_fisica">
                                                <label class="form-check-label" for="servicio_fisica">
                                                    V. FISICA
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_mantenimiento" name="servicio_mantenimiento">
                                                <label class="form-check-label" for="servicio_mantenimiento">
                                                    MANTENIMIENTO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_fumigacion" name="servicio_fumigacion">
                                                <label class="form-check-label" for="servicio_fumigacion">
                                                    FUMIGACION
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_omedico" name="servicio_omedico">
                                                <label class="form-check-label" for="servicio_omedico">
                                                    MEDICO OPERADOR
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="servicio_olicencia" name="servicio_olicencia">
                                                <label class="form-check-label" for="servicio_olicencia">
                                                    LICENCIA OPERADOR
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                                    {{-- \\\\\\\\\\\ SI \\\\\\\\\\\ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 card-deck">
                                        <div class="card">
                                            <h5 class="card-title">Servicios Para El Cliente</h5>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    @if ($cliente->servicio_seguro == 'Si') checked @endif id="servicio_seguro"
                                                    name="servicio_seguro">
                                                <label class="form-check-label" for="servicio_seguro">
                                                    SEGURO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    @if ($cliente->servicio_ambiental == 'Si') checked @endif
                                                    id="servicio_ambiental" name="servicio_ambiental">
                                                <label class="form-check-label" for="servicio_ambiental">
                                                    V. AMBIENTAL
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    @if ($cliente->servicio_fisica == 'Si') checked @endif id="servicio_fisica"
                                                    name="servicio_fisica">
                                                <label class="form-check-label" for="servicio_fisica">
                                                    V. FISICA
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    @if ($cliente->servicio_mantenimiento == 'Si') checked @endif
                                                    id="servicio_mantenimiento" name="servicio_mantenimiento">
                                                <label class="form-check-label" for="servicio_mantenimiento">
                                                    MANTENIMIENTO
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    @if ($cliente->servicio_fumigacion == 'Si') checked @endif
                                                    id="servicio_fumigacion" name="servicio_fumigacion">
                                                <label class="form-check-label" for="servicio_fumigacion">
                                                    FUMIGACION
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                @if ($cliente->servicio_omedico == 'Si') checked @endif
                                                    id="servicio_omedico" name="servicio_omedico">
                                                <label class="form-check-label" for="servicio_omedico">
                                                    MEDICO OPERADOR
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                @if ($cliente->servicio_olicencia == 'Si') checked @endif
                                                    id="servicio_olicencia" name="servicio_olicencia">
                                                <label class="form-check-label" for="servicio_olicencia">
                                                    LICENCIA OPERADOR
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                                    {{--  --}}
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
