@extends('layouts.app')
@section('title')
    Seguros
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Seguro</h3>
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
                            <form action="{{ route('seguros.update', $seguro->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- ========================================= OCULTOS ========================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="id_unidad">id_unidad</label>
                                        <input type="text" name="id_unidad" class="form-control"
                                            value="{{ $seguro->id_unidad }}">
                                    </div>
                                </div>
                                {{-- ========================================================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nopoliza">No. Poliza</label>
                                        <input type="text" name="nopoliza" class="form-control"
                                        value="{{ $seguro->nopoliza }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechainicio">Fecha de Inicio</label>
                                        <input type="date" name="fechainicio" class="form-control"
                                        value="{{ $seguro->fechainicio }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechavencimiento">Fecha de Vencimiento</label>
                                        <input type="date" name="fechavencimiento" class="form-control"
                                        value="{{ $seguro->fechavencimiento }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tiposeguro">Tipo de Seguro</label>
                                        <input type="text" name="tiposeguro" class="form-control"
                                        value="{{ $seguro->tiposeguro }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="caratulaseguro">Caratula Seguro</label>
                                        <input type="text" name="caratulaseguro" class="form-control"
                                        value="{{ $seguro->caratulaseguro }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="provedor">Proveedor</label>
                                        <input type="text" name="provedor" class="form-control"
                                        value="{{ $seguro->provedor }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="text" name="precio" class="form-control"
                                        value="{{ $seguro->precio }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="impuestos">Impuestos</label>
                                        <input type="text" name="impuestos" class="form-control"
                                        value="{{ $seguro->impuestos }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="costototal">Costo Total</label>
                                        <input type="text" name="costototal" class="form-control"
                                        value="{{ $seguro->costototal }}">
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
