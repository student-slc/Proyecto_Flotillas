@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Unidad a {{ $usuario }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('clientes.show', $usuario) }}">Regresar</a>
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

                            <form action="{{ route('unidades.store') }}" method="POST">

                                @csrf
                                {{-- TIPO DE UNIDAD --}}
                                <div class="row">
                                    <h4 class="form-check-label">Tipo de Unidad</h4>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="habitacion"
                                                value="Unidad Habitacional o Comercial">
                                            <label class="form-check-label" for="habitacion">
                                                Unidad Habitacional o Comercial
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="vehiculo"
                                                value="Unidad Vehicular">
                                            <label class="form-check-label" for="vehiculo">
                                                Unidad Vehicular
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ========================================= OCULTOS ========================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="seguro">seguro</label>
                                            <input type="text" name="seguro" class="form-control" value="Sin Seguro">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="verificacion">verificacion</label>
                                            <input type="text" name="verificacion" class="form-control"
                                                value="Sin Verificación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="verificacion2">verificacion</label>
                                            <input type="text" name="verificacion2" class="form-control"
                                                value="Sin Verificación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="mantenimiento">mantenimiento</label>
                                            <input type="text" name="mantenimiento" class="form-control"
                                                value="Sin Mantenimiento">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="fumigacion">fumigacion</label>
                                            <input type="text" name="fumigacion" class="form-control"
                                                value="Sin Fumigación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="seguro_fecha">seguro_fecha</label>
                                            <input type="text" name="seguro_fecha" class="form-control"
                                                value="Sin Fecha de Seguro">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="verificacion_fecha">verificacion_fecha</label>
                                            <input type="text" name="verificacion_fecha" class="form-control"
                                                value="Sin Fecha de Verificación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="verificacion_fecha2">verificacion_fecha</label>
                                            <input type="text" name="verificacion_fecha2" class="form-control"
                                                value="Sin Fecha de Verificación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="mantenimiento_fecha">mantenimiento_fecha</label>
                                            <input type="text" name="mantenimiento_fecha" class="form-control"
                                                value="Sin Fecha de Mantenimiento">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="lapsofumigacion">lapsofumigacion</label>
                                            <input type="text" name="lapsofumigacion" class="form-control"
                                                value="Sin Fecha de Fumigación">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="cliente">cliente</label>
                                            <input type="text" name="cliente" class="form-control"
                                                value="{{ $usuario }}">
                                        </div>
                                    </div>
                                    {{-- ========================================================================= --}}
                                    {{-- -------------------------- DATOS UNIDADES VEHICULARES -------------------------- --}}
                                    <div class="form no_mostrar" id="unidadv">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="serieunidad">No. Serie</label>
                                                <input type="text" name="serieunidad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="economico">No. Economico</label>
                                                <input type="text" name="economico" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="marca">Marca</label>
                                                <input type="text" name="marca" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="submarca">Sub Marca</label>
                                                <input type="text" name="submarca" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="añounidad">Año</label>
                                                <input type="number" min="1900" max="2099" step="1"
                                                    value="2022" name="añounidad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="tipounidad">Tipo</label>
                                                <input type="text" name="tipounidad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="placas">Placas</label>
                                                <input id="placas" type="text" name="placas" class="form-control"
                                                onkeyup="PasarValorP(this);">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="digitoplaca">digitoplaca</label>
                                                <input id="digitoplaca" type="text" name="digitoplaca" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="kilometraje">Kilometraje</label>
                                                <input id="kilometraje" type="text" name="kilometraje" class="form-control"
                                                    laceholder="Kilometraje de la unidad"
                                                    onkeyup="PasarValor(this);">
                                            </div>
                                        </div>
                                        {{-- 'kilometraje_actual','kilometraje_cont', --}}
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="kilometros_actuales">kilometros_actuales</label>
                                                <input id="kilometros_actuales" type="text" name="kilometros_actuales"
                                                class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                            <div class="form-group">
                                                <label for="kilometros_contador">kilometros_contador</label>
                                                <input id="kilometros_contador" type="text" name="kilometros_contador"
                                                class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="status">Status de Servivio</label>
                                                <select name="status" id="status" class=" selectsearch">
                                                    <option disabled selected value="">Selecciona Status
                                                    </option>
                                                    <option value="Status 1">Status 1</option>
                                                    <option value="Status 2">Status 2</option>
                                                    <option value="Status 3">Status 3</option>
                                                    {{-- <option value="No Pagado">No Pagado</option>
                                                <option value="Pagado">Pagado</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <h4 class="form-check-label">Tipo De Mantenimiento</h4>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipomantenimiento"
                                                    id="Kilometraje" value="Kilometraje">
                                                <label class="form-check-label" for="Kilometraje">
                                                    Mantenimiento por Kilometraje
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tipomantenimiento"
                                                    id="Fecha" value="Fecha">
                                                <label class="form-check-label" for="Fecha">
                                                    Mantenimiento por Fecha
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="frecuencia_mante">Frecuencia de Mantenimiento</label>
                                                <input type="number" min="1"step="1"
                                                    name="frecuencia_mante" class="form-control"
                                                    placeholder="Frecuencia por Meses o Kilometros">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ========================================================================= --}}
                                    {{-- -------------------------- DATOS UNIDADES HABITACIONALES -------------------------- --}}
                                    <div class="form no_mostrar" id="unidadh">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="cp">Codigo Postal</label>
                                                <input type="number" min="10000" max="99999" step="1"
                                                    name="cp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" name="direccion" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="calle">Calle</label>
                                                <input type="text" name="calle" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ciudad">Ciudad</label>
                                                <input type="text" name="ciudad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="responsable">Responsable</label>
                                                <input type="text" name="responsable" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form no_mostrar" id="guardar">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="frecuencia_fumiga">Frecuencia de Fumigacion</label>
                                                <input type="number" min="1" step="1"
                                                    name="frecuencia_fumiga" class="form-control"
                                                    placeholder="Frecuencia en meses">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="razonsocialunidad">Razon Social</label>
                                                <input type="text" name="razonsocialunidad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
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
        var guardar = document.getElementById('guardar');
        document.getElementById('habitacion').addEventListener('click', function(e) {
            habitacion.style.display = 'none';
            guardar.style.display = 'inline';
        });
        document.getElementById('vehiculo').addEventListener('click', function(e) {
            habitacion.style.display = 'inline';
            guardar.style.display = 'inline';
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
        //----------------------------------------- MOSTRAR FRECUENCIA DE MANTENIMIENTO ------------------------------
        var Kilometraje = document.getElementById('frecuenciakm');
        document.getElementById('Fecha').addEventListener('click', function(e) {
            Kilometraje.style.display = 'none';
        });
        document.getElementById('Kilometraje').addEventListener('click', function(e) {
            Kilometraje.style.display = 'inline';
        });
        /* llllllllllllllllllllllllllllllllllllllllllllllllllll */
        var Fecha = document.getElementById('frecuenciaf');
        document.getElementById('Fecha').addEventListener('click', function(e) {
            Fecha.style.display = 'inline';
        });
        document.getElementById('Kilometraje').addEventListener('click', function(e) {
            Fecha.style.display = 'none';
        });
        //------------------------------------------------------------------------------------------------------------
        function PasarValor(input) {
            var kilometraje=document.getElementById("kilometraje").value
            document.getElementById("kilometros_actuales").value = kilometraje;
            document.getElementById("kilometros_contador").value = kilometraje;
        }
        //------------------------------------------------------------------------------------------------------------
        function PasarValorP(input) {
            var placas=document.getElementById("placas").value
            document.getElementById("digitoplaca").value = placas.substr(3,1);
        }
    </script>
@endsection
