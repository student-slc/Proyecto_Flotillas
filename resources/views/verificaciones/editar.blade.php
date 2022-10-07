@extends('layouts.app')
@section('title')
    Verificaiones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Verificación</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger"
                                href="{{ route('verificaciones.show', $unidad = $verificacione->id_unidad) }}">Regresar</a>
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
                            <form action="{{ route('verificaciones.update', $verificacione->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- ========================================= OCULTOS ========================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="id_unidad">id_unidad</label>
                                        <input type="text" name="id_unidad" class="form-control"
                                            value="{{ $verificacione->id_unidad }}">
                                    </div>
                                </div>
                                {{-- ========================================================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechavencimiento">Fecha de Vencimiento</label>
                                        <input type="date" name="fechavencimiento" class="form-control"
                                        value="{{ $verificacione->fechavencimiento }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tipoverificacion">Tipo de Verificación</label>
                                        <input type="text" name="tipoverificacion" class="form-control"
                                        value="{{ $verificacione->tipoverificacion }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="subtipoverificacion">Sub Tipo de Verificación</label>
                                        <input type="text" name="subtipoverificacion" class="form-control"
                                        value="{{ $verificacione->subtipoverificacion }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="ultimaverificacion">Fecha Ultima Verificación</label>
                                        <input type="date" name="ultimaverificacion" class="form-control"
                                        value="{{ $verificacione->ultimaverificacion }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechavencimiento">Fecha de Vencimiento</label>
                                        <input type="date" name="fechavencimiento" class="form-control"
                                        value="{{ $verificacione->fechavencimiento }}">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="caratulaverificacion">Caratula De Verificación</label>
                                        <input type="text" name="caratulaverificacion" class="form-control"
                                        value="{{ $verificacione->caratulaverificacion }}">
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
