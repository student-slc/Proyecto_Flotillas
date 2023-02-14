@extends('layouts.app')
@section('title')
    Verificaciones
@endsection
@section('css')
    <script>
        function toggleButton() {
            var caratula = document.getElementById('caratulaverificacion').value;
            if (caratula) {
                document.getElementById('Boton').disabled = false;
            } else {
                document.getElementById('Boton').disabled = true;
            }
        }

        function toggleButton_2() {
            var noverificacion = document.getElementById('noverificacion').value;
            if (noverificacion) {
                document.getElementById('Boton_i').disabled = false;
            } else {
                document.getElementById('Boton_i').disabled = true;
            }
        }
    </script>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            @php
                use App\Models\Unidade;
                $todo = Unidade::where('serieunidad', '=', $unidad)->get();
                foreach ($todo as $todos) {
                    $placas = $todos->placas;
                }
            @endphp
            <h3 class="page__heading">Verificación Ambienta para: {{ $unidad }} / {{ $placas }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-dark" href="{{ route('verificaciones.show', $unidad) }}">Regresar</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-danger" onclick="$('#imprimir').modal('show')"
                                        id="Boton_i" disabled>
                                        <i class="fas fa-file-pdf"></i> Generar PDF</button>
                                </div>
                            </div>
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
                            <form action="{{ route('verificaciones.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row" id="cambios">
                                    {{-- ========================================= OCULTOS ========================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="id_unidad">id_unidad</label>
                                            <input type="text" name="id_unidad" id="id_unidad" class="form-control"
                                                value="{{ $unidad }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="estado">estado</label>
                                            <input type="text" name="estado" id="estado" class="form-control"
                                                value="Activo">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="tipoverificacion">Tipo de Verificación</label>
                                            <input type="text" name="tipoverificacion" id="tipoverificacion"
                                                class="form-control" value="Ambiental">
                                        </div>
                                    </div>
                                    {{-- ========================================================================= --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="label" for="noverificacion">Folio De Verificación</label>
                                            <select name="noverificacion" id="noverificacion"
                                                class="form-select form-select-sm mb-3" aria-label=".form-select-sm example"
                                                onchange="toggleButton_2()">
                                                <option disabled selected value="">SELECCIONA UN FOLIO</option>
                                                @foreach ($folios as $folio)
                                                    @php
                                                        $string = $folio->folio;
                                                        $inicio = preg_replace('/[^0-9]/', '', $string);
                                                        $string_2 = $folio->rango;
                                                        $final = preg_replace('/[^0-9]/', '', $string_2);
                                                        $fin = (int) $final;
                                                        $numeros = (int) $inicio + (int) $folio->contador;
                                                    @endphp
                                                    @if ($fin == $numeros)
                                                    @else
                                                        @if ($fin >= $numeros)
                                                            <option value="{{ $folio->id }}">{{ $numeros }}
                                                            </option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="subtipoverificacion">Sub Tipo de Verificación</label>
                                            <input type="text" name="subtipoverificacion" id="subtipoverificacion"
                                                class="form-control">
                                        </div>
                                    </div>
                                    @if ($ultima == null)
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ultimaverificacion">Fecha Ultima Verificación</label>
                                                <input type="date" name="ultimaverificacion" id="ultimaverificacion"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="ultimaverificacion">Fecha Ultima Verificación</label>
                                                <input type="text" name="ultimaverificacion" id="ultimaverificacion"
                                                    class="form-control" value="{{ $ultima }}" readonly="readonly">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechavencimiento">Fecha de Vencimiento</label>
                                            <input type="date" name="fechavencimiento" id="fechavencimiento"
                                                class="form-control" min="{{ $fecha_actual }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="caratulaverificacion">Caratula De Verificación</label>
                                            <input type="text" name="caratulaverificacion" class="form-control">
                                        </div>
                                    </div> --}}
                                    <br>
                                    <br>
                                    {{-- ==================================================== SUBIR DOCUMENTOS ======================== --}}
                                    <div class="form">
                                        <div class="grid">
                                            {{-- LICENCIA --}}
                                            <div class="form-element">
                                                <div class="from-group">
                                                    <input name="caratulaverificacion" type="file"
                                                        id="caratulaverificacion" onchange="toggleButton()">
                                                    <label for="caratulaverificacion" id="caratulaverificacion-preview">
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
                                                    <label>ARCHIVO</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button id="Boton" type="submit" class="btn btn-primary" disabled>Guardar
                                            Datos</button>
                                    </div>
                                    {{-- ======================================================== --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ===================== MODAL_IMPRIMIR ===================== --}}
    <div class="modal fade" id="imprimir" tabindex="-1" role="dialog" aria-labelledby="ModalDetallesTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDetallesTitle" style="text-align: center">
                        <b>Confirmacion de Datos para imprimir</b>
                    </h5>
                    <button type="button" class="btn-close" onclick="$('#imprimir').modal('hide')">
                </div>
                <form {{-- action="{{ route('verificaciones.destroy', $verificacione->id, $unidad) }}" --}} method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body" id="datos-modal">
                        {{-- <div class="container-fluid h-100">
                            <div class="row w-100 align-items-center ">
                                <div class="col text-center" >
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid h-100">
                            <div class="row w-100 align-items-center ">
                                <div class="col text-center">
                                    <button type="button" class="btn btn-danger" onclick="$('#imprimir').modal('hide')">
                                        NO</button>
                                    <button type="submit" class="btn btn-success">
                                        SI</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        previewBeforeUpload("caratulaverificacion");
    </script>
    <script>
        function modal() {
            var id_unidad = $('#id_unidad').val();
            var estado = $('#estado').val();
            var tipoverificacion = $('#tipoverificacion').val();
            var noverificacion = $('#noverificacion').val();
            var subtipoverificacion = $('#subtipoverificacion').val();
            var ultimaverificacion = $('#ultimaverificacion').val();
            var fechavencimiento = $('#fechavencimiento').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('verificaciones.datos') }}",
                data: {
                    "id_unidad": id_unidad,
                    "estado": estado,
                    "tipoverificacion": tipoverificacion,
                    "subtipoverificacion": subtipoverificacion,
                    "noverificacion": noverificacion,
                    "ultimaverificacion": ultimaverificacion,
                    "fechavencimiento": fechavencimiento,
                },
                success: function(response) {
                    $('#datos-modal').html(response);
                }
                error: function() {
                    alert("ERROR AL CARGAR MODAL");
                }
            });
        }
        modal();
        $('#cambios').change(function() {
            modal();
        });
    </script>
@endsection
