@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Servicio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger"
                                href="{{ route('fumigaciones.show', $unidad = $fumigacione->unidad) }}">Regresar</a>
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
                            <form action="{{ route('fumigaciones.update', $fumigacione->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numerofumigacion">Número Fumigación</label>
                                            <input type="text" name="numerofumigacion" class="form-control"
                                                value="{{ $fumigacione->numerofumigacion }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="unidad">Unidad</label>
                                            <input type="text" name="unidad" class="form-control"
                                                value="{{ $fumigacione->unidad }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_fumigador">Fumigador</label>
                                            <select name="id_fumigador" id="id_fumigador" class=" selectsearch">
                                                <option disabled value="">Selecciona el Fumigador</option>
                                                @foreach ($fumigadores as $fumigadore)
                                                    @if ($fumigacione->id_fumigador == $fumigadore->nombrecompleto)
                                                        <option value="{{ $fumigadore->nombrecompleto }}" selected>
                                                            {{ $fumigadore->nombrecompleto }}</option>
                                                    @else
                                                        <option value="{{ $fumigadore->nombrecompleto }}">
                                                            {{ $fumigadore->nombrecompleto }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaprogramada">Fecha</label>
                                            <input type="date" name="fechaprogramada" class="form-control"
                                                value="{{ $fumigacione->fechaprogramada }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaultimafumigacion">Fecha ultima fumigacion</label>
                                            <input type="date" name="fechaultimafumigacion" class="form-control"
                                                value="{{ $fumigacione->fechaultimafumigacion }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="lugardelservicio">Lugar</label>
                                            <input type="text" name="lugardelservicio" class="form-control"
                                                value="{{ $fumigacione->lugardelservicio }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numerodevisitas">Numero de Visitas</label>
                                            <input type="text" name="numerodevisitas" class="form-control"
                                                value="{{ $fumigacione->numerodevisitas }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control"
                                                value="{{ $fumigacione->costo }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class=" selectsearch">
                                                <option disabled value="">Selecciona un Status</option>
                                                <option value="En Proceso"
                                                    @if ($fumigacione->status == 'En Proceso') selected @endif>En Proceso</option>
                                                <option value="Concluido" @if ($fumigacione->status == 'Concluido') selected @endif>
                                                    Concluido</option>
                                                <option value="Por Confirmar"
                                                    @if ($fumigacione->status == 'Por Confirmar') selected @endif>Por Confirmar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="satisfaccionservicio">Satisfacción del Servicio</label>
                                            <select name="satisfaccionservicio" id="satisfaccionservicio"
                                                class=" selectsearch">
                                                {{-- <option disabled selected value="">Selecciona una opción</option> --}}
                                                <option value="En Proceso" selected>En Proceso</option>
                                                {{--  <option disabled value="Malo">Malo</option>
                                                <option disabled value="Regular">Regular</option>
                                                <option disabled value="Bueno">Bueno</option>
                                                <option disabled value="Excelente">Excelente</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
