<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css" />
    <!-- Title Page-->
    <title>Checklist Salida</title>
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    {{-- selectize --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/css/selectize.bootstrap3.min.css"
        rel="stylesheet" />
    {{--  --}}
    <style>
        .without_ampm::-webkit-datetime-edit-ampm-field {
            display: none;
        }

        input[type=time]::-webkit-clear-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            -o-appearance: none;
            -ms-appearance: none;
            appearance: none;
            margin: -10px;
        }

        .image-upload>input {
            display: none;

        }

        .image-upload img {
            width: 100px;
            height: 100px;
            cursor: pointer;
        }





        .brand-logo {
            max-height: 100px;
            top: 40px;
            right: 40px;
        }
    </style>
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
</head>

<body onload="mueveReloj()">
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <form>
                        {{--  <img align="right" class="brand-logo" src="img/sumapp.png" alt="SuMapp">
                        <br>
                        <br> --}}
                        <h2 class="title">Checklist de Salida</h2>
                        <hr style="border-color:red;">
                        <br>
                        @php
                            date_default_timezone_set('America/Mexico_City');
                            $fechaActual = date('d/m/y');
                        @endphp
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">FECHA ACTUAL:</label>
                                    <input id="fecha" name="fecha" value="{{ $fechaActual }}" readonly="readonly"
                                        class="input--style-4" type="text">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">HORA ACTUAL:</label>
                                    <input id="hora" name="hora" readonly="readonly" class="input--style-4"
                                        type="text" size="10">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">USUARIO</label>
                                    <input id="usuario" name="usuario" readonly="readonly" class="input--style-4"
                                        type="text"value="{{ $user }}">
                                </div>
                            </div>
                            @can('particular-rol')
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label" for="id_cliente">CLIENTE:</label>
                                        <input id="id_cliente" name="id_cliente" readonly="readonly" class="input--style-4"
                                            type="text" size="10" value='{{ $clientes }}'>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label" for="id_unidad">UNIDAD</label>
                                        <select name="id_unidad" id="id_unidad" readonly="readonly" class=" selectsearch">
                                            <option disabled selected value="">SELECCIONA UNA UNIDAD</option>
                                            @foreach ($unidades as $unidade)
                                                <option value="{{ $unidade->id }}">{{ $unidade->serieunidad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label" for="id_operador">OPERADOR</label>
                                        <select name="id_operador" id="id_operador" readonly="readonly"
                                            class=" selectsearch">
                                            <option disabled selected value="">SELECCIONA UN OPERADOR</option>
                                            @foreach ($operadores as $operador)
                                                <option value="{{ $operador->id }}">
                                                    {{ $operador->nombreoperador }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endcan
                            @can('general-rol')
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label" for="id_cliente">CLIENTE</label>
                                        <select name="id_cliente" id="id_cliente" readonly="readonly"
                                            class="selectsearch">
                                            <option disabled selected value="">SELECCIONA UN CLIENTE</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->nombrecompleto }}">
                                                    {{ $cliente->nombrecompleto }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group" id="unidades_opciones">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group" id="operadores_opciones">
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <br>
                        <hr style="border-color:red;">
                        <br>
                        <h2 style="text-align: center" class="title">INFORMACION DE UNIDAD</h2>
                        <div class="row row-space" id="info_unidades">
                        </div>
                        <br>
                        <hr style="border-color:red;">
                        <br>
                        <h2 style="text-align: center" class="title">INFORMACION DE OPERADOR</h2>
                        <div class="row row-space" id="info_operadores">
                        </div>
                        <br>
                        <hr style="border-color:red;">
                        <br>
                        <h2 style="text-align: center" class="title">LLENAR TODOS LOS CAMPOS</h2>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">KILOMETROS</label>
                                    <input id="kmarranque" name="kmarranque" class="input--style-4"type="text">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">COMBUSTIBLE</label>
                                    <select name="combustible" id="combustible" readonly="readonly"
                                        class=" selectsearch">
                                        <option disabled selected value="">SELECCIONA UNA OPCIÓN</option>
                                        <option value="1/4">1/4</option>
                                        <option value="2/4">2/4</option>
                                        <option value="3/4">3/4</option>
                                        <option value="4/4">4/4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">ECO</label>
                                    <input id="eco" name="eco" class="input--style-4"type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr style="border-color:red;">
                        <br>
                        <h2 style="text-align: center" class="title">EQUIPO DE SEGURIDAD Y EMBALAJE</h2>
                        {{-- ---------------------------------------------- --}}
                        <label class="label">LLANTA DE REFACCIÓN</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="llantarefaccion" id="llantarefaccion" type="radio"
                                value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="llantarefaccion" id="llantarefaccion"
                                type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ---------------------------------------------- --}}
                        <br>
                        <br>
                        <label class="label">LLANTA DE REFACCIÓN</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="llantarefaccion" id="llantarefaccion" type="radio"
                                value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="llantarefaccion" id="llantarefaccion"
                                type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ---------------------------------------------- --}}
                        <br>
                        <br>
                        <label class="label">CRUCETA Y GATO</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="crucetaygato" id="crucetaygato" type="radio" value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="crucetaygato" id="crucetaygato" type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ---------------------------------------------- --}}
                        <br>
                        <br>
                        <label class="label">LONAS</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="lonas" id="lonas" type="radio" value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="lonas" id="lonas" type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ---------------------------------------------- --}}
                        <br>
                        <br>
                        <label class="label">CUERDAS</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="CUERDAS" id="CUERDAS" type="radio" value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="CUERDAS" id="CUERDAS" type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ---------------------------------------------- --}}
                        <br>
                        <br>
                        <label class="label">EXTINTOR</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="extintor" id="extintor" type="radio" value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="extintor" id="extintor" type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ---------------------------------------------- --}}
                        <br>
                        <br>
                        <label class="label">BANDERIN</label>
                        <label class="radio-container m-r-45">SI
                            <input readonly name="banderin" id="banderin" type="radio" value="SI">
                            <span class="checkmark"></span>
                        </label>
                        <label class="radio-container">NO
                            <input readonly name="banderin" id="banderin" type="radio"value="NO">
                            <span class="checkmark"></span>
                        </label>
                        {{-- ---------------------------------------------- --}}
                        {{-- ==================================================== SUBIR DOCUMENTOS ======================== --}}
                        <div class="form">
                            <div class="grid">
                                <div class="form-element">
                                    <input name="evidencia_1" type="file" id="evidencia_1" accept="image/*"
                                        capture="camera">
                                    <label for="evidencia_1" id="evidencia_1-preview">
                                        <img src="https://bit.ly/3ubuq5o" alt="" width="100px">
                                        <div>
                                            <span>+</span>
                                        </div>
                                    </label>
                                </div>
                                {{-- </div>
                            <div class="grid"> --}}
                                <div class="form-element">
                                    <input name="evidencia_2" type="file" id="evidencia_2" accept="image/*"
                                        capture="camera">
                                    <label for="evidencia_2" id="evidencia_2-preview">
                                        <img src="https://bit.ly/3ubuq5o" alt="" width="100px">
                                        <div>
                                            <span>+</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                        {{-- ======================================================== --}}
                        {{-- ==================================================== SUBIR DOCUMENTOS ======================== --}}
                        <div class="form">
                            <div class="grid">
                                <div class="form-element">
                                    <input name="evidencia_3" type="file" id="evidencia_3" accept="image/*"
                                        capture="camera">
                                    <label for="evidencia_3" id="evidencia_3-preview">
                                        <img src="https://bit.ly/3ubuq5o" alt="" width="100px">
                                        <div>
                                            <span>+</span>
                                        </div>
                                    </label>
                                </div>
                                {{-- </div>
                            <div class="grid"> --}}
                                <div class="form-element">
                                    <input name="evidencia_4" type="file" id="evidencia_4" accept="image/*"
                                        capture="camera">
                                    <label for="evidencia_4" id="evidencia_4-preview">
                                        <img src="https://bit.ly/3ubuq5o" alt="" width="100px">
                                        <div>
                                            <span>+</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                        {{-- ======================================================== --}}
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="vendor/js/global.js"></script>
    {{-- SELECTIZE --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.1/js/standalone/selectize.min.js"></script>
    <script>
        $('.selectsearch').selectize({
            plugins: ['remove_button'],
            sortField: 'text'
        });
    </script>
    {{--  --}}
</body>
<script type="text/javascript">
    /* ==================== RELOJ ==================== */
    function mueveReloj() {
        momentoActual = new Date()
        hora = momentoActual.getHours()
        minuto = momentoActual.getMinutes()
        segundo = momentoActual.getSeconds()
        horaImprimible = hora + " : " + minuto + " : " + segundo
        document.getElementById("hora").value = horaImprimible
        setTimeout("mueveReloj()", 1000)
    }
    /* =============================================== */
</script>
<script type="text/javascript">
    /* ==================== AJAX_UNIDADES ==================== */
    function recargarLista() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('checklist.datos_unidades') }}",
            data: 'datos_unidad=' + $('#id_cliente').val(),
            success: function(r) {
                $('#unidades_opciones').html(r);
            },
            error: function() {
                /* alert("ERROR AL CARGAR UNIDADES"); */
            }
        });
    }
    /* =============================================== */
</script>
<script type="text/javascript">
    /* ==================== AJAX_OPERADORES ==================== */
    function recargarLista_2() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('checklist.datos_operadores') }}",
            data: 'datos_operador=' + $('#id_cliente').val(),
            success: function(r) {
                $('#operadores_opciones').html(r);
            },
            error: function() {
                /* alert("ERROR AL CARGAR LOS OPERADORES"); */
            }
        });
    }
    /*  console.log('fuera: '+$('#id_unidad').val());
                 alert("ERROR AL CARGAR INFORMACION UNIDADES"); */
    /* =============================================== */
</script>
<script type="text/javascript">
    /* ==================== AJAX_UNIDADES_INFORMACION ==================== */
    function recargarLista_3() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('checklist.infounidades') }}",
            data: 'unidad_change=' + $('#id_unidad').val(),
            success: function(r) {
                $('#info_unidades').html(r);
            },
            error: function() {
                /*  alert("ERROR AL CARGAR LAS UNIDADES"); */
            }
        });
    }
    /* =============================================== */
</script>
<script type="text/javascript">
    /* ==================== AJAX_OPERADORES_INFORMACION ==================== */
    function recargarLista_4() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('checklist.infooperadores') }}",
            data: 'operador_change=' + $('#id_operador').val(),
            success: function(r) {
                /* console.log('ENTRE'); */
                $('#info_operadores').html(r);
            },
            error: function() {
               /*  console.log('AFUERA');
                alert("ERROR AL CARGAR LOS OPERADORES"); */
            }
        });
    }
    /* =============================================== */
</script>
<script type="text/javascript">
    $(document).ready(function() {
        /* ------------------ CARGAR UNIDADES ------------------------------------------- */
        $('#id_cliente').val();
        recargarLista();
        $('#id_cliente').change(function() {
            recargarLista();
        });
        /* ------------------ CARGAR OPERADORES ------------------------------------------ */
        $('#id_cliente').val();
        recargarLista_2();
        $('#id_cliente').change(function() {
            recargarLista_2();
        });
    })
</script>
@can('particular-rol')
    <script type="text/javascript">
        $(document).ready(function() {
            /* ------------------ CARGAR INFORMACION DE UNIDADES ---------------------------- */
            $('#id_unidad').val();
            recargarLista_3();
            $('#id_unidad').change(function() {
                recargarLista_3();
            });
            /* ------------------ CARGAR INFORMACION DE OPERADORES ---------------------------- */
            $('#id_operador').val();
            recargarLista_4();
            $('#id_operador').change(function() {
                recargarLista_4();
            });
            /* ------------------------------------------------------------------------------ */
        })
    </script>
@endcan
@can('general-rol')
    <script type="text/javascript">
        $(document).ready(function() {
            /* ------------------ CARGAR INFORMACION DE UNIDADES ---------------------------- */
            $('#unidades_opciones').val();
            recargarLista_3();
            $('#unidades_opciones').change(function() {
                recargarLista_3();
            });
            /* ------------------ CARGAR INFORMACION DE OPERADORES ---------------------------- */
            $('#operadores_opciones').val();
            recargarLista_4();
            $('#operadores_opciones').change(function() {
                recargarLista_4();
            });
            /* ------------------------------------------------------------------------------ */
        })
    </script>
@endcan
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
    previewBeforeUpload("evidencia_1");
    previewBeforeUpload("evidencia_2");
    previewBeforeUpload("evidencia_3");
    previewBeforeUpload("evidencia_4");
</script>

</html>
<!-- end document-->
