@extends('layouts.app')
@section('title')
    Folios
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Folio</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('folios.index') }}">Regresar</a>
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
                            <form action="{{ route('folios.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fecha_update">Fecha de Registro</label>
                                            <input type="date" name="fecha_update" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="folio">Folio Inicial</label>
                                            <input type="text" name="folio" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="rango">Folio Final</label>
                                            <input type="text" name="rango" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="contador">contador</label>
                                            <input type="text" name="contador" class="form-control" value="0">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="tipo">Tipo De Folio</label>
                                            <select name="tipo" id="tipo" class=" selectsearch">
                                                <option disabled selected value="">Selecciona el Tipo de Folio
                                                </option>
                                                <option selected value="Ambiental">Ambiental</option>
                                                <option value="Fisico-Mecanica-Arrastre">Fisico-Mecanica Arrastre</option>
                                                <option value="Fisico-Mecanica-Motriz">Fisico-Mecanica Motriz</option>
                                                {{-- <option value="No Pagado">No Pagado</option>
                                                <option value="Pagado">Pagado</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                    {{-- ======================================================== --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
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
