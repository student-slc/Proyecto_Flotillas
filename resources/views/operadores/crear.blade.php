@extends('layouts.app')
@section('title')
    Operadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Operador</h3>
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

                            <form action="{{ route('operadores.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nombreoperador">Nombre del Operador</label>
                                            <input type="text" name="nombreoperador" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechanacimiento">Fecha de Nacimiento</label>
                                            <input type="date" name="fechanacimiento" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nolicencia">No Licencia</label>
                                            <input type="text" name="nolicencia" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="tipolicencia">Tipo de Licencia</label>
                                            <select name="tipolicencia" id="tipolicencia" class=" selectsearch">
                                                <option disabled selected value="">Selecciona el Tipo de Licencia</option>
                                                <option value="Federal">Federal</option>
                                                <option value="Estatal">Estatal</option>
                                                {{-- <option value="No Pagado">No Pagado</option>
                                                <option value="Pagado">Pagado</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechavencimientomedico">Fecha de Vencimiento Medico</label>
                                            <input type="date" name="fechavencimientomedico" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechavencimientolicencia">Fecha de Vencimiento Licencia</label>
                                            <input type="date" name="fechavencimientolicencia" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_flotilla">Flotilla</label>
                                            <select name="id_flotilla" id="id_flotilla" class=" selectsearch">
                                                <option disabled selected value="">Selecciona la Flotilla</option>
                                                <option value="Flotilla 1">Flotilla 1</option>
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
