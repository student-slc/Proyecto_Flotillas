@extends('layouts.app')
@section('title')
    Fumigadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Fumigadores</h3>
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
                            <form action="{{ route('fumigadores.update', $fumigadore->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombrecompleto">Nombre del Fumigador</label>
                                        <input type="text" name="nombrecompleto" class="form-control"
                                            value="{{ $fumigadore->nombrecompleto }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechanacimiento">Fecha de Nacimiento</label>
                                        <input type="date" name="fechanacimiento" class="form-control"
                                            value="{{ $fumigadore->fechanacimiento }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="certificacion">Certificación</label>
                                        <select name="certificacion" id="certificacion" class=" selectsearch">
                                            <option disabled selected value="">Selecciona una opción</option>
                                            @if ($fumigadore->certificacion == 'Si')
                                                <option selected value="Si">Si</option>
                                            @else
                                                <option value="Si">Si</option>
                                            @endif
                                            @if ($fumigadore->certificacion == 'No')
                                                <option selected value="No">No</option>
                                            @else
                                                <option value="No">No</option>
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
