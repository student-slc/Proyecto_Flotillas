@extends('layouts.app')
@section('title')
    Verificaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Verificación Físico-Mecánica para: {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('verificacionesfisicomecanicas.show', $unidad) }}">Regresar</a>
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
                            @php
                                /* FECHA ACTUAL */
                                $fecha_actual = date('Y-n-d');
                            @endphp
                            <form action="{{ route('verificacionesfisicomecanicas.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    {{-- ========================================= OCULTOS ========================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="id_unidad">id_unidad</label>
                                            <input type="text" name="id_unidad" class="form-control"
                                                value="{{ $unidad }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="estado">estado</label>
                                            <input type="text" name="estado" class="form-control" value="Activo">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="tipoverificacion">Tipo de Verificación</label>
                                            <input type="text" name="tipoverificacion" class="form-control"
                                            value="Fisica">
                                        </div>
                                    </div>
                                    {{-- ========================================================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="noverificacion">Numero de Verificación</label>
                                            <input type="text" name="noverificacion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="subtipoverificacion">Sub Tipo de Verificación</label>
                                            <input type="text" name="subtipoverificacion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="ultimaverificacion">Fecha Ultima Verificación</label>
                                            <input type="date" name="ultimaverificacion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechavencimiento">Fecha de Vencimiento</label>
                                            <input type="date" name="fechavencimiento" class="form-control"
                                                min="{{ $fecha_actual }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="caratulaverificacion">Caratula De Verificación</label>
                                            <input type="text" name="caratulaverificacion" class="form-control">
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
