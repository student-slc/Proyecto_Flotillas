@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">CHECK LIST DE ARRANQUE</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('checklist.guardarsalida') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @php
                                        date_default_timezone_set('America/Mexico_City');
                                        $fechaActual = date('d/m/y');
                                        $hora = date('h:i:s');
                                    @endphp
                                    {{-- 111111111111111111111111111111111111111111111 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>FECHA ACTUAL</label>
                                            <input type="text"class="form-control"
                                                value="{{ $fechaActual }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="fecha">FECHA ACTUAL</label>
                                            <input type="text" name="fecha" class="form-control"
                                                value="{{ $fechaActual }}">
                                        </div>
                                    </div>
                                    {{-- 111111111111111111111111111111111111111111111 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label >TIEMPO ACTUAL</label>
                                            <input type="text"  class="form-control"
                                                value="{{ $hora }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="hora">TIEMPO ACTUAL</label>
                                            <input type="text" name="hora" class="form-control"
                                                value="{{ $hora }}">
                                        </div>
                                    </div>
                                    {{-- 111111111111111111111111111111111111111111111 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_operador">OPERADOR</label>
                                            <select name="id_operador" id="id_operador" class=" selectsearch">
                                                <option disabled selected value="">Selecciona camarista</option>
                                                {{--  @foreach ($camarista as $camaristas)
                                                    @if ($camaristas->status == 'Activo')
                                                        <option value="{{ $camaristas->camarista }}">
                                                            {{ $camaristas->camarista }}</option>
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_unidad">UNIDAD</label>
                                            <select name="id_unidad" id="id_unidad" class=" selectsearch">
                                                <option disabled selected value="">Selecciona camarista</option>
                                                {{--  @foreach ($camarista as $camaristas)
                                                    @if ($camaristas->status == 'Activo')
                                                        <option value="{{ $camaristas->camarista }}">
                                                            {{ $camaristas->camarista }}</option>
                                                    @endif
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    {{-- 111111111111111111111111111111111111111111111 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="kmarranque">KILOMETROS DE ARRANQUE</label hidden>
                                            <input type="text" name="kmarranque" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>KILOMETROS DE ARRANQUE</label>
                                            <input type="text" class="form-control" value=""
                                                disabled>
                                        </div>
                                    </div>
                                    {{-- 111111111111111111111111111111111111111111111 --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="combustible">COMBUSTIBLE</label>
                                            <input type="text" name="combustible" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="eco">ECO</label>
                                            <input type="text" name="eco" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="status">status</label>
                                            <input type="text" name="status" class="form-control" value="Activo">
                                        </div>
                                    </div>
                                    {{-- ============================================================================= //BUG: 1 ============================================================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <h5>EQUIPO DE SEGURIDAD Y EMBALAJE</h5>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    <label for="status" class="form-check-label">LLANTA DE REFACCIÓN</label>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="llantarefaccion"
                                                id="Pregunta_11" value="Si">
                                            <label class="form-check-label" for="Pregunta_11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="llantarefaccion"
                                                id="Pregunta_12" value="No">
                                            <label class="form-check-label" for="Pregunta_12">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    {{-- ----------------------------------------- --}}
                                    <label for="status" class="form-check-label">CRUCETA Y GATO</label>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="crucetaygato"
                                                id="Pregunta_11" value="Si">
                                            <label class="form-check-label" for="Pregunta_11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="crucetaygato"
                                                id="Pregunta_12" value="No">
                                            <label class="form-check-label" for="Pregunta_12">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    {{-- ----------------------------------------- --}}
                                    <label for="status" class="form-check-label">LONAS</label>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lonas"
                                                id="Pregunta_11" value="Si">
                                            <label class="form-check-label" for="Pregunta_11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="lonas"
                                                id="Pregunta_12" value="No">
                                            <label class="form-check-label" for="Pregunta_12">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    {{-- ----------------------------------------- --}}
                                    <label for="status" class="form-check-label">CUERDAS</label>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cuerdas"
                                                id="Pregunta_11" value="Si">
                                            <label class="form-check-label" for="Pregunta_11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cuerdas"
                                                id="Pregunta_12" value="No">
                                            <label class="form-check-label" for="Pregunta_12">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    {{-- ----------------------------------------- --}}
                                    <label for="status" class="form-check-label">EXTINTOR</label>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="extintor"
                                                id="Pregunta_11" value="Si">
                                            <label class="form-check-label" for="Pregunta_11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="extintor"
                                                id="Pregunta_12" value="No">
                                            <label class="form-check-label" for="Pregunta_12">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    {{-- ----------------------------------------- --}}
                                    <label for="status" class="form-check-label">BANDERIN</label>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="banderin"
                                                id="Pregunta_11" value="Si">
                                            <label class="form-check-label" for="Pregunta_11">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="banderin"
                                                id="Pregunta_12" value="No">
                                            <label class="form-check-label" for="Pregunta_12">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------- --}}
                                    <div class="form">
                                        <div class="grid">
                                            {{-- CARATULA --}}
                                            <div class="form-element">
                                                <div class="from-group">
                                                    <input name="fotoreporte" type="file" id="fotoreporte" accept="image/*" capture="camera">
                                                    <label for="fotoreporte" id="fotoreporte-preview">
                                                        <object type="application/pdf" data="https://bit.ly/3ubuq5o"
                                                            style="width: 200px; height: 250px;">
                                                            ERROR (no puede mostrarse el objeto)
                                                        </object>
                                                        <div>
                                                            <span>+</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form">
                                                    <label>FOTO DE FIRMA O REPORTE</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        //================================================ //BUG: IMAGE PREVIEW ========================================
        function previewBeforeUpload(id) {
            document.querySelector("#" + id).addEventListener("change", function(e) {
                if (e.target.files.length == 0) {
                    return;
                }
                let file = e.target.files[0];
                let url = URL.createObjectURL(file);
                document.querySelector("#" + id + "-preview div").innerText = file.name;
                document.querySelector("#" + id + "-preview object").data = url;
            });
        }
        previewBeforeUpload("fotoreporte");
    </script>
@endsection
