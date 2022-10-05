@extends('layouts.app')
@section('title')
    Operadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Operador</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger"
                                href="{{ route('operadores.show', $usuario = $operadore->cliente) }}">Regresar</a>
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
                            <form action="{{ route('operadores.update', $operadore->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="cliente">cliente</label>
                                        <input type="text" name="cliente" class="form-control"
                                            value="{{ $operadore->cliente }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombreoperador">Nombre del Operador</label>
                                        <input type="text" name="nombreoperador" class="form-control"
                                            value="{{ $operadore->nombreoperador }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechanacimiento">Fecha de Nacimiento</label>
                                        <input type="date" name="fechanacimiento" class="form-control"
                                            value="{{ $operadore->fechanacimiento }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nolicencia">No Licencia</label>
                                        <input type="text" name="nolicencia" class="form-control"
                                            value="{{ $operadore->nolicencia }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tipolicencia">Tipo de Licencia</label>
                                        <select name="tipolicencia" id="tipolicencia" class=" selectsearch">
                                            <option disabled selected value="">Selecciona el Tipo de Licencia</option>
                                            @if ($operadore->tipolicencia == 'Federal')
                                                <option selected value="Federal">Federal</option>
                                            @else
                                                <option value="Federal">Federal</option>
                                            @endif
                                            @if ($operadore->tipolicencia == 'Estatal')
                                                <option selected value="Estatal">Estatal</option>
                                            @else
                                                <option value="Estatal">Estatal</option>
                                            @endif
                                            {{-- <option value="No Pagado">No Pagado</option>
                                            <option value="Pagado">Pagado</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechavencimientomedico">Fecha de Vencimiento Medico</label>
                                        <input type="date" name="fechavencimientomedico" class="form-control"
                                            value="{{ $operadore->fechavencimientomedico }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="fechavencimientolicencia">Fecha de Vencimiento Licencia</label>
                                        <input type="date" name="fechavencimientolicencia" class="form-control"
                                            value="{{ $operadore->fechavencimientomedico }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="unidad">unidad</label>
                                        <input type="text" name="unidad" class="form-control"
                                            value="{{ $operadore->unidad }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="licenciaruta">licenciaruta</label>
                                        <input type="text" name="licenciaruta" class="form-control"
                                            value="{{ $operadore->licencia }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="cursoruta">cursoruta</label>
                                        <input type="text" name="cursoruta" class="form-control"
                                            value="{{ $operadore->curso }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                    <div class="form-group">
                                        <label for="examenmedicoruta">examenmedicoruta</label>
                                        <input type="text" name="examenmedicoruta" class="form-control"
                                            value="{{ $operadore->examenmedico }}">
                                    </div>
                                </div>
                                <br>
                                {{-- ==================================================== SUBIR DOCUMENTOS ======================== --}}
                                <div class="form">
                                    <div class="grid">
                                        {{-- LICENCIA --}}
                                        <div class="form-element">
                                            <div class="from-group">
                                                <input name="licencia" type="file" id="licencia">
                                                <label for="licencia" id="licencia-preview">
                                                    <object type="application/pdf" data="{{ asset($operadore->licencia) }}"
                                                        style="width: 200px; height: 250px;">
                                                        ERROR (no puede mostrarse el objeto)
                                                    </object>
                                                    <div>
                                                        <span>+</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="form">
                                                <label>Licencia</label>
                                            </div>
                                        </div>
                                        {{-- CERTIFICADO --}}
                                        <div class="form-element">
                                            <div class="from-group">
                                                <input name="curso" type="file" id="curso">
                                                <label for="curso" id="curso-preview">
                                                    <object type="application/pdf" data="{{ asset($operadore->curso) }}"
                                                        style="width: 200px; height: 250px;">
                                                        ERROR (no puede mostrarse el objeto)
                                                    </object>
                                                    <div>
                                                        <span>+</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="from">
                                                <label>Certificado</label>
                                            </div>
                                        </div>
                                        {{-- EXAMEN MEDICO --}}
                                        <div class="form-element">
                                            <div class="from-group">
                                                <input name="examenmedico" type="file" id="examenmedico">
                                                <label for="examenmedico" id="examenmedico-preview">
                                                    <object type="application/pdf"
                                                        data="{{ asset($operadore->examenmedico) }}"
                                                        style="width: 200px; height: 250px;">
                                                        ERROR (no puede mostrarse el objeto)
                                                    </object>
                                                    <div>
                                                        <span>+</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="form">
                                                <label>Examen Medico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                {{-- ======================================================== --}}
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
        previewBeforeUpload("licencia");
        previewBeforeUpload("curso");
        previewBeforeUpload("examenmedico");
    </script>
@endsection
