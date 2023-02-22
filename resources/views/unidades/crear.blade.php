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
                                                <label for="tipounidad">Tipo de Unidad</label>
                                                <select name="tipounidad" id="tipounidad" class=" selectsearch">
                                                    <option disabled selected value="">Selecciona el Tipo de Unidad
                                                    </option>
                                                    <option value="B2">B2: AUTOBUS DE 2 EJES</option>
                                                    <option value="B3">B3: AUTOBUS DE 3 EJES</option>
                                                    <option value="B4">B4: AUTOBUS DE 4 EJES</option>
                                                    <option value="C2">C2: CAMION DE 2 EJES</option>
                                                    <option value="C3">C3: CAMION DE 3 EJES</option>
                                                    <option value="C4">C4: CAMION DE 4 EJES</option>
                                                    <option value="DOLLY">DOLLY: DOLLY</option>
                                                    <option value="GA">GA: GRUA TIPO A</option>
                                                    <option value="GB">GB: GRUA TIPO B</option>
                                                    <option value="GC">GC: GRUA TIPO C</option>
                                                    <option value="GD">GD: GRUA TIPO D</option>
                                                    <option value="GI">GI: GRUA TIPO I</option>
                                                    <option value="MINIVAN">MINIVAN: MINIVAN</option>
                                                    <option value="R2">R2: REMOLQUE DE 2 EJES</option>
                                                    <option value="R3">R3: REMOLQUE DE 3 EJES</option>
                                                    <option value="R4">R4: REMOLQUE DE 4 EJES</option>
                                                    <option value="R5">R5: REMOLQUE DE 5 EJES</option>
                                                    <option value="R6">R6: REMOLQUE DE 6 EJES</option>
                                                    <option value="S1">S1: SEMIREMOLQUE DE 1 EJE</option>
                                                    <option value="S2">S2: SEMIREMOLQUE DE 2 EJES</option>
                                                    <option value="S3">S3: SEMIREMOLQUE DE 3 EJES</option>
                                                    <option value="S4">S4: SEMIREMOLQUE DE 4 EJES</option>
                                                    <option value="S5">S5: SEMIREMOLQUE DE 5 EJES</option>
                                                    <option value="S6">S6: SEMIREMOLQUE DE 6 EJES</option>
                                                    <option value="T2">T2: TRACTOCAMION DE 2 EJES</option>
                                                    <option value="T3">T3: TRACTOCAMION DE 3 EJES</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="placas">Placas</label>
                                                <input id="placas" type="text" name="placas" class="form-control"
                                                    onkeyup="PasarValorP(this);">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="digitoplaca">digitoplaca</label>
                                                <input id="digitoplaca" type="text" name="digitoplaca"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="kilometraje">Kilometraje</label>
                                                <input id="kilometraje" type="text" name="kilometraje"
                                                    class="form-control" laceholder="Kilometraje de la unidad"
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
                                                <label for="status">Status de Unidad</label>
                                                <select name="status" id="status" class=" selectsearch">
                                                    <option disabled selected value="">Selecciona Status
                                                    </option>
                                                    <option value="Activo">Activo</option>
                                                    <option value="Inactivo">Inactivo</option>
                                                    <option value="Reparación">Reparación</option>
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
                                                        id="status_seguro" name="status_seguro">
                                                    <label class="form-check-label" for="status_seguro">
                                                        SEGURO
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="status_ambiental" name="status_ambiental">
                                                    <label class="form-check-label" for="status_ambiental">
                                                        V. AMBIENTAL
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="status_fisica" name="status_fisica">
                                                    <label class="form-check-label" for="status_fisica">
                                                        V. FISICA
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="status_mantenimiento" name="status_mantenimiento">
                                                    <label class="form-check-label" for="status_mantenimiento">
                                                        MANTENIMIENTO
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Si"
                                                        id="status_fumigacion" name="status_fumigacion">
                                                    <label class="form-check-label" for="status_fumigacion">
                                                        FUMIGACION
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                                        {{--  --}}
                                        <br>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <h5 class="form-check-label">TIPO DE MANTENIMIENTO</h5>
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
                                    {{-- \\\\\\\\\\\\\\\\\\' DATOS QUE SON PARA AMBAS UNIDADES VAN AQUI '\\\\\\\\\\\\\\\\\\ --}}
                                    <div class="form no_mostrar" id="guardar">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="razonsocialunidad">Razon Social</label>
                                                <input type="text" name="razonsocialunidad" class="form-control">
                                            </div>
                                        </div>
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
                                                <label for="comisionfumigacion">Comisión por Fumigación</label>
                                                <input type="number" min="1" step="1"
                                                    name="comisionfumigacion" class="form-control"
                                                    placeholder="Datos en % Porcentaje">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="distanciakm">Distancia Fumigación</label>
                                                <input type="number" min="1" step="1" name="distanciakm"
                                                    class="form-control" placeholder="Datos en Kilometros (KM)">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ltrsgasolina">Litros Gasolina</label>
                                                <input type="number" min="1" step="1" name="ltrsgasolina"
                                                    class="form-control" placeholder="Datos en Litros (Ltrs)">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
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
            var kilometraje = document.getElementById("kilometraje").value
            document.getElementById("kilometros_actuales").value = kilometraje;
            document.getElementById("kilometros_contador").value = kilometraje;
        }
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
