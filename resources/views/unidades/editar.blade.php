@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Unidad de {{ $unidade->cliente }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger"
                                href="{{ route('clientes.show', $usuario = $unidade->cliente) }}">Regresar</a>
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
                            <form action="{{ route('unidades.update', $unidade->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                {{-- TIPO DE UNIDAD --}}
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <h4 class="form-check-label">Tipo de Unidad</h4>
                                    @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="habitacion"
                                                value="Unidad Habitacional o Comercial" checked>
                                            <label class="form-check-label" for="habitacion">
                                                Unidad Habitacional o Comercial
                                            </label>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="habitacion"
                                                value="Unidad Habitacional o Comercial">
                                            <label class="form-check-label" for="habitacion">
                                                Unidad Habitacional o Comercial
                                            </label>
                                        </div>
                                    @endif
                                    @if ($unidade->tipo == 'Unidad Vehicular')
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="vehiculo"
                                                value="Unidad Vehicular" checked>
                                            <label class="form-check-label" for="vehiculo">
                                                Unidad Vehicular
                                            </label>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="vehiculo"
                                                value="Unidad Vehicular">
                                            <label class="form-check-label" for="vehiculo">
                                                Unidad Vehicular
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                {{-- ========================================= OCULTOS ========================================= --}}
                                <div class="form">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="cliente">cliente</label>
                                                <input type="text" name="cliente" class="form-control"
                                                    value="{{ $unidade->cliente }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="razonsocialunidad">Razon Social</label>
                                                <input type="text" name="razonsocialunidad" class="form-control"
                                                    value="{{ $unidade->razonsocialunidad }}">
                                            </div>
                                        </div>
                                        @if ($unidade->tipo == 'Unidad Vehicular')
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="kilometraje">kilometraje</label>
                                                    <input type="text" name="kilometraje" class="form-control"
                                                        value="{{ $unidade->kilometraje }}">
                                                </div>
                                            </div>
                                            {{-- 'kilometraje_actual','kilometraje_cont', --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="kilometros_actuales">kilometros_actuales</label>
                                                    <input id="kilometros_actuales" type="text"
                                                        name="kilometros_actuales" class="form-control"
                                                        value="{{ $unidade->kilometros_actuales }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="kilometros_contador">kilometros_contador</label>
                                                    <input id="kilometros_contador" type="text"
                                                        name="kilometros_contador" class="form-control"
                                                        value="{{ $unidade->kilometros_contador }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="seguro">seguro</label>
                                                    <input type="text" name="seguro" class="form-control"
                                                        value="{{ $unidade->seguro }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="verificacion">verificacion</label>
                                                    <input type="text" name="verificacion" class="form-control"
                                                        value="{{ $unidade->verificacion }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="verificacion2">verificacion2</label>
                                                    <input type="text" name="verificacion2" class="form-control"
                                                        value="{{ $unidade->verificacion2 }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="mantenimiento">mantenimiento</label>
                                                    <input type="text" name="mantenimiento" class="form-control"
                                                        value="{{ $unidade->mantenimiento }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="seguro_fecha">seguro_fecha</label>
                                                    <input type="text" name="seguro_fecha" class="form-control"
                                                        value="{{ $unidade->seguro_fecha }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="verificacion_fecha">verificacion_fecha</label>
                                                    <input type="text" name="verificacion_fecha" class="form-control"
                                                        value="{{ $unidade->verificacion_fecha }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="verificacion_fecha2">verificacion_fecha2</label>
                                                    <input type="text" name="verificacion_fecha2" class="form-control"
                                                        value="{{ $unidade->verificacion_fecha2 }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="mantenimiento_fecha">mantenimiento_fecha</label>
                                                    <input type="text" name="mantenimiento_fecha" class="form-control"
                                                        value="{{ $unidade->mantenimiento_fecha }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="lapsofumigacion">lapsofumigacion</label>
                                                    <input type="text" name="lapsofumigacion" class="form-control"
                                                        value="{{ $unidade->lapsofumigacion }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="fumigacion">fumigacion</label>
                                                    <input type="text" name="fumigacion" class="form-control"
                                                        value="{{ $unidade->fumigacion }}">
                                                </div>
                                            </div>
                                            {{-- ========================================================================= --}}
                                            {{-- -------------------------- DATOS UNIDADES VEHICULARES -------------------------- --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="serieunidad">No. Serie</label>
                                                    <input type="text" name="serieunidad" class="form-control"
                                                        value="{{ $unidade->serieunidad }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="economico">No. Economico</label>
                                                    <input type="text" name="economico" class="form-control"
                                                        value="{{ $unidade->economico }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="marca">Marca</label>
                                                    <input type="text" name="marca" class="form-control"
                                                        value="{{ $unidade->marca }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="submarca">Sub Marca</label>
                                                    <input type="text" name="submarca" class="form-control"
                                                        value="{{ $unidade->submarca }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="añounidad">Año</label>
                                                    <input type="number" min="1900" max="2099" step="1"
                                                        name="añounidad" class="form-control"
                                                        value="{{ $unidade->añounidad }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="tipounidad">Tipo de Unidad</label>
                                                    <select name="tipounidad" id="tipounidad" class=" selectsearch">
                                                        <option disabled value="">Selecciona el Tipo de
                                                            Unidad
                                                        </option>
                                                        <option @if ($unidade->tipounidad == 'B2') selected @endif
                                                            value="B2">B2: AUTOBUS DE 2 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'B3') selected @endif
                                                            value="B3">B3: AUTOBUS DE 3 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'B4') selected @endif
                                                            value="B4">B4: AUTOBUS DE 4 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'C2') selected @endif
                                                            value="C2">C2: CAMION DE 2 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'C3') selected @endif
                                                            value="C3">C3: CAMION DE 3 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'C4') selected @endif
                                                            value="C4">C4: CAMION DE 4 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'DOLLY') selected @endif
                                                            value="DOLLY">DOLLY: DOLLY</option>
                                                        <option @if ($unidade->tipounidad == 'GA') selected @endif
                                                            value="GA">GA: GRUA TIPO A</option>
                                                        <option @if ($unidade->tipounidad == 'GB') selected @endif
                                                            value="GB">GB: GRUA TIPO B</option>
                                                        <option @if ($unidade->tipounidad == 'GC') selected @endif
                                                            value="GC">GC: GRUA TIPO C</option>
                                                        <option @if ($unidade->tipounidad == 'GD') selected @endif
                                                            value="GD">GD: GRUA TIPO D</option>
                                                        <option @if ($unidade->tipounidad == 'GI') selected @endif
                                                            value="GI">GI: GRUA TIPO I</option>
                                                        <option @if ($unidade->tipounidad == 'MINIVAN') selected @endif
                                                            value="MINIVAN">MINIVAN: MINIVAN</option>
                                                        <option @if ($unidade->tipounidad == 'R2') selected @endif
                                                            value="R2">R2: REMOLQUE DE 2 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'R3') selected @endif
                                                            value="R3">R3: REMOLQUE DE 3 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'R4') selected @endif
                                                            value="R4">R4: REMOLQUE DE 4 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'R5') selected @endif
                                                            value="R5">R5: REMOLQUE DE 5 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'R6') selected @endif
                                                            value="R6">R6: REMOLQUE DE 6 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'S1') selected @endif
                                                            value="S1">S1: SEMIREMOLQUE DE 1 EJE</option>
                                                        <option @if ($unidade->tipounidad == 'S2') selected @endif
                                                            value="S2">S2: SEMIREMOLQUE DE 2 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'S3') selected @endif
                                                            value="S3">S3: SEMIREMOLQUE DE 3 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'S4') selected @endif
                                                            value="S4">S4: SEMIREMOLQUE DE 4 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'S5') selected @endif
                                                            value="S5">S5: SEMIREMOLQUE DE 5 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'S6') selected @endif
                                                            value="S6">S6: SEMIREMOLQUE DE 6 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'T2') selected @endif
                                                            value="T2">T2: TRACTOCAMION DE 2 EJES</option>
                                                        <option @if ($unidade->tipounidad == 'T3') selected @endif
                                                            value="T3">T3: TRACTOCAMION DE 3 EJES</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="placas">Placas</label>
                                                    <input id="placas" type="text" name="placas"
                                                        class="form-control" value="{{ $unidade->placas }}"
                                                        onkeyup="PasarValorP(this);">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="digitoplaca">digitoplaca</label>
                                                    <input id="digitoplaca" type="text" name="digitoplaca"
                                                        class="form-control" value="{{ $unidade->digitoplaca }}">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="tipomantenimiento">Tipo de Mantenimiento</label>
                                                    <select name="tipomantenimiento" id="tipomantenimiento"
                                                        class=" selectsearch">
                                                        <option disabled value="">Selecciona Status</option>
                                                        <option value="Kilometraje"
                                                            @if ($unidade->tipomantenimiento == 'Kilometraje') selected @endif>
                                                            Mantenimiento
                                                            por Kilometraje
                                                        </option>
                                                        <option value="Fecha"
                                                            @if ($unidade->tipomantenimiento == 'Fecha') selected @endif>
                                                            Mantenimiento
                                                            por Fecha
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="frecuencia_mante">Frecuencia de Mantenimiento</label>
                                                    <input type="number" min="1"step="1"
                                                        name="frecuencia_mante" class="form-control"
                                                        placeholder="Frecuencia por Meses o Kilometros"
                                                        value="{{ $unidade->frecuencia_mante }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="status">Status de Unidad</label>
                                                    <select name="status" id="status" class=" selectsearch">
                                                        <option disabled value="">Selecciona Status
                                                        </option>
                                                        <option @if ($unidade->status == 'Activo') selected @endif
                                                            value="Activo">
                                                            Activo</option>
                                                        <option @if ($unidade->status == 'Inactivo') selected @endif
                                                            value="Inactivo">Inactivo</option>
                                                        <option @if ($unidade->status == 'Reparación') selected @endif
                                                            value="Reparación">Reparación</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- SERVICIOS --}}
                                            {{-- \\\\\\\\\\\ NO \\\\\\\\\\\ --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12 card-deck" hidden>
                                                <div class="card">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="No"
                                                            checked id="status_seguro" name="status_seguro">
                                                        <label class="form-check-label" for="status_seguro">
                                                            SEGURO
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="No"
                                                            checked id="status_ambiental" name="status_ambiental">
                                                        <label class="form-check-label" for="status_ambiental">
                                                            V. AMBIENTAL
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="No"
                                                            checked id="status_fisica" name="status_fisica">
                                                        <label class="form-check-label" for="status_fisica">
                                                            V. FISICA
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="No"
                                                            checked id="status_mantenimiento" name="status_mantenimiento">
                                                        <label class="form-check-label" for="status_mantenimiento">
                                                            MANTENIMIENTO
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="No"
                                                            checked id="status_fumigacion" name="status_fumigacion">
                                                        <label class="form-check-label" for="status_fumigacion">
                                                            FUMIGACION
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                                            {{-- \\\\\\\\\\\ SI \\\\\\\\\\\ --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12 card-deck">
                                                <div class="card">
                                                    <h5 class="form-check-label">SERVICIOS PARA ESTA UNIDAD</h5>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Si"
                                                            @if ($unidade->status_seguro == 'Si') checked @endif
                                                            id="status_seguro" name="status_seguro">
                                                        <label class="form-check-label" for="status_seguro">
                                                            SEGURO
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Si"
                                                            @if ($unidade->status_ambiental == 'Si') checked @endif
                                                            id="status_ambiental" name="status_ambiental">
                                                        <label class="form-check-label" for="status_ambiental">
                                                            V. AMBIENTAL
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Si"
                                                            @if ($unidade->status_fisica == 'Si') checked @endif
                                                            id="status_fisica" name="status_fisica">
                                                        <label class="form-check-label" for="status_fisica">
                                                            V. FISICA
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Si"
                                                            @if ($unidade->status_mantenimiento == 'Si') checked @endif
                                                            id="status_mantenimiento" name="status_mantenimiento">
                                                        <label class="form-check-label" for="status_mantenimiento">
                                                            MANTENIMIENTO
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Si"
                                                            @if ($unidade->status_fumigacion == 'Si') checked @endif
                                                            id="status_fumigacion" name="status_fumigacion">
                                                        <label class="form-check-label" for="status_fumigacion">
                                                            FUMIGACION
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                                            {{--  --}}
                                        @endif
                                        {{-- ========================================================================= --}}
                                        @if ($unidade->tipo == 'Unidad Habitacional o Comercial')
                                            {{-- -------------------------- DATOS UNIDADES HABITACIONALES -------------------------- --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="cp">Codigo Postal</label>
                                                    <input type="number" min="10000" max="99999" step="1"
                                                        name="cp" class="form-control" value="{{ $unidade->cp }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="direccion">Dirección</label>
                                                    <input type="text" name="direccion" class="form-control"
                                                        value="{{ $unidade->direccion }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="calle">Calle</label>
                                                    <input type="text" name="calle" class="form-control"
                                                        value="{{ $unidade->calle }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="ciudad">Ciudad</label>
                                                    <input type="text" name="ciudad" class="form-control"
                                                        value="{{ $unidade->ciudad }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="responsable">Responsable</label>
                                                    <input type="text" name="responsable" class="form-control"
                                                        value="{{ $unidade->responsable }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="lapsofumigacion">lapsofumigacion</label>
                                                    <input type="text" name="lapsofumigacion" class="form-control"
                                                        value="{{ $unidade->lapsofumigacion }}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                                <div class="form-group">
                                                    <label for="fumigacion">fumigacion</label>
                                                    <input type="text" name="fumigacion" class="form-control"
                                                        value="{{ $unidade->fumigacion }}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="frecuencia_fumiga">Frecuencia de Fumigacion</label>
                                                <input type="number" min="1" step="1"
                                                    name="frecuencia_fumiga" class="form-control"
                                                    placeholder="Frecuencia en meses"
                                                    value="{{ $unidade->frecuencia_fumiga }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="comisionfumigacion">Comisión por Fumigación</label>
                                                <input type="number" min="1" step="1"
                                                    name="comisionfumigacion" class="form-control"
                                                    placeholder="Datos en % Porcentaje"
                                                    value="{{ $unidade->comisionfumigacion }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="distanciakm">Distancia Fumigación</label>
                                                <input type="number" min="1" step="1" name="distanciakm"
                                                    class="form-control" placeholder="Datos en Kilometros (KM)"
                                                    value="{{ $unidade->distanciakm }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ltrsgasolina">Litros Gasolina</label>
                                                <input type="number" min="1" step="1" name="ltrsgasolina"
                                                    class="form-control" placeholder="Datos en Litros (Ltrs)"
                                                    value="{{ $unidade->ltrsgasolina }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- ========================================================================= --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        //----------------------------------------- MOSTRAR TIPO DE UNIDAD -----------------------------------------
        var habitacion = document.getElementById('unidadv');
        document.getElementById('habitacion').addEventListener('click', function(e) {
            habitacion.style.display = 'none';
        });
        document.getElementById('vehiculo').addEventListener('click', function(e) {
            habitacion.style.display = 'inline';
        });
        /* llllllllllllllllllllllllllllllllllllllllllllllllllll */
        var vehiculo = document.getElementById('unidadh');
        document.getElementById('habitacion').addEventListener('click', function(e) {
            vehiculo.style.display = 'inline';
        });
        document.getElementById('vehiculo').addEventListener('click', function(e) {
            vehiculo.style.display = 'none';
        });
        //------------------------------------------------------------------------------------------------------------
        function PasarValorP(input) {
            var regex = /(\d+)/g;
            var expresion = /(,+)/g;
            /* var name = "i_txt_7_14"; */
            /* console.log(name.match(regex)); */
            var placas = document.getElementById("placas").value
            var digito = placas.match(regex);
            var cadena = digito.toString();
            var remplazo = cadena.replace(expresion, "");
            document.getElementById("digitoplaca").value = remplazo.substr(3, 1);;
            /* document.getElementById("digitoplaca").value = placas.substr(3, 1); */
        }
    </script>
@endsection
