@extends('layouts.app')
@section('title')
    Mantenimientos
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Mantenimientos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger"
                                href="{{ route('mantenimientos.show', $unidad = $mantenimiento->id_unidad) }}">Regresar</a>
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
                            <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- ========================================= OCULTOS ========================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="id_unidad">id_unidad</label>
                                        <input type="text" name="id_unidad" class="form-control"
                                            value="{{ $mantenimiento->id_unidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="estado">estado</label>
                                        <input type="text" name="estado" class="form-control"
                                            value="{{ $mantenimiento->estado }}">
                                    </div>
                                </div>
                                {{-- ========================================================================= --}}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nomantenimiento">Numero de Mantenimiento</label>
                                        <input type="text" name="nomantenimiento" class="form-control"
                                            value="{{ $mantenimiento->nomantenimiento }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="kminiciales">Kilometros Iniciales</label>
                                        <input id="kminiciales" type="text" name="kminiciales" class="form-control"
                                        value="{{ $mantenimiento->kminiciales }}" onkeyup="calcular(this)">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="kmfinales">Kilometros Finales</label>
                                        <input id="kmfinales" type="text" name="kmfinales" class="form-control"
                                        value="{{ $mantenimiento->kmfinales }}" onkeyup="calcular(this)">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="kmfaltantes">Kilometros Faltantes</label>
                                        <input id="kmfaltantes"type="text" name="kmfaltantes" class="form-control"
                                        value="{{ $mantenimiento->kmfaltantes }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" class="form-control"
                                            value="{{ $mantenimiento->fecha }}" min="{{ $fecha_actual }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="frecuencia">Frecuencia</label>
                                        <input type="text" name="frecuencia" class="form-control"
                                            value="{{ $mantenimiento->frecuencia }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="sigservicio">Siguiente Servicio</label>
                                        <input type="text" name="sigservicio" class="form-control"
                                            value="{{ $mantenimiento->sigservicio }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tipomantenimiento">Tipo De Mantenimiento</label>
                                        <select name="tipomantenimiento" id="tipomantenimiento" class=" selectsearch">
                                            @if ($mantenimiento->tipomantenimiento == 'Kilometraje')
                                                <option value="Kilometraje" selected>Mantenimiento por Kilometraje</option>
                                            @else
                                                <option value="Kilometraje">Mantenimiento por Kilometraje</option>
                                            @endif
                                            @if ($mantenimiento->tipomantenimiento == 'Fecha')
                                                <option value="Fecha" selected>Mantenimiento por Fecha de Vencimiento
                                                </option>
                                            @else
                                                <option value="Fecha">Mantenimiento por Fecha de Vencimiento</option>
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
    <script>
        function calcular(input) {
            var kmfinales = document.getElementById("kmfinales").value
            var kminiciales = document.getElementById("kminiciales").value
            document.getElementById("kmfaltantes").value = kmfinales - kminiciales;
        }
    </script>
@endsection
