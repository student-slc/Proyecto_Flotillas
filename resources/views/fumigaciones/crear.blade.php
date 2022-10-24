@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Servicio de Fumigacion</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('fumigaciones.index') }}">Regresar</a>
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

                            <form action="{{ route('fumigaciones.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_cliente">Cliente</label>
                                            <select name="id_cliente" id="id_cliente" class=" selectsearch">
                                                <option disabled selected value="">Selecciona el Cliente</option>
                                                @foreach ($clientes as $cliente )
                                                <option value="{{ $cliente->nombrecompleto }}">{{ $cliente->nombrecompleto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_fumigador">Fumigador</label>
                                            <select name="id_fumigador" id="id_fumigador" class=" selectsearch">
                                                <option disabled selected value="">Selecciona el Fumigador</option>
                                                @foreach ($fumigadores as $fumigadore )
                                                <option value="{{ $fumigadore->nombrecompleto }}">{{ $fumigadore->nombrecompleto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaprogramada">Fecha</label>
                                            <input type="date" name="fechaprogramada" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaultimafumigacion">Fecha ultima fumigacion</label>
                                            <input type="date" name="fechaultimafumigacion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="lugardelservicio">Lugar</label>
                                            <input type="text" name="lugardelservicio" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numerodevisitas">Numero de Visitas</label>
                                            <input type="text" name="numerodevisitas" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control" value="$">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class=" selectsearch">
                                                <option disabled selected value="">Selecciona un Status</option>
                                                <option value="En Proceso">En Proceso</option>
                                                <option value="Concluido">Concluido</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="satisfaccionservicio">Satisfacción del Servicio</label>
                                            <select name="satisfaccionservicio" id="satisfaccionservicio" class=" selectsearch">
                                                <option disabled selected value="">Selecciona una opción</option>
                                                <option value="En Proceso">En Proceso</option>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
