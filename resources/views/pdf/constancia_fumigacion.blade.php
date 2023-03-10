<!DOCTYPE html>
<html>

<head>

    <style>
        img {
            height: 80px;
            float: left;
        }

        .checkbox-grid {
            float: left;
            width: 25%
        }
    </style>
</head>
@foreach ($fumigaciones as $fumigacion)

    <body>
        <div>
            <div>
                <div style="float: left;">
                    <img src="data:image/png;base64,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"
                        alt="Imagen no encontrada">
                </div>
                <div style="text-align: center;margin:padding:20px">
                    <h4 style="color: red;">PROFESIONALES EN CONTROL INTEGRAL DE PLAGAS <br>LIC. COPRISEH 21-13A001</h4>
                </div>
            </div>
            <div>
                <div style="float:left; width:74%">
                    <h6 style="text-align: center;">EN ACATAMIENTO AL ARTICULO 139 FRACC. V Y VI DE LA LEY GENERAL DE
                        SALUD,
                        Y SU
                        APOYO EN ARTICULOS
                        6,7,8,9 Y DEMÁS APLIUCABLES DE NORMAS DE SALUD GENERAL, ASI COMO EL REGLAMENTEO FEDERAL DE
                        DESINFECCIÓN, DESINFECTACIÓN Y DESRATIZACIÓN SE EXTIENDE LA PRESENTE CONSTANCIA PARA LOS FINES
                        QUE CONSIDERE EL INTERESADO </h6>
                </div>
                <div style="margin-left:50px;">
                    <h5>FOLIO: <b>{{ $fumigacion->numerofumigacion }}</b></h5>
                </div>
            </div>
            <div style="text-align: center;">
                <br>
                <h5>CONSTANCIA DE SERVICIO DE CONTRPOL DE PLAGAS ESTABLECIMIENTOS COMERCIALES</h5>
            </div>
            <!-- Fechas -->
            <div style="float:left; padding:30px;">
                @php
                    $vencimiento_dia = substr($fumigacion->fechaprogramada, 8, 2);
                    $vencimiento_mes = substr($fumigacion->fechaprogramada, 5, 2);
                    $vencimiento_año = substr($fumigacion->fechaprogramada, 0, 4);
                @endphp
                <p>Fecha: <b>{{ $vencimiento_dia }}/{{ $vencimiento_mes }}/{{ $vencimiento_año }} -
                        {{ substr($fumigacion->fechaprogramada, 11, 5) }}</b></p>
            </div>
            <div style="float:left;  padding:30px;">
                @if ($fumigacion->frecuencia_fumiga == 1)
                    <p>Vigencia del servicio: <b>{{ $fumigacion->frecuencia_fumiga }} Mes</b></p>
                @else
                    <p>Vigencia del servicio: <b>{{ $fumigacion->frecuencia_fumiga }} Meses</b></p>
                @endif
            </div>
            @php
                $vencimiento_dia = substr($fumigacion->proxima_fumigacion, 8, 2);
                $vencimiento_mes = substr($fumigacion->proxima_fumigacion, 5, 2);
                $vencimiento_año = substr($fumigacion->proxima_fumigacion, 0, 4);
            @endphp
            <div style="padding:30px;">
                <p>Proximo servicio: <b>{{ $vencimiento_dia }}/{{ $vencimiento_mes }}/{{ $vencimiento_año }}</b></p>
            </div>
            <!-- Tipo de Unidad-->
            <div style="margin-left: 30px;">
                <p>Tipo: <b>{{ $fumigacion->tipo }}</b></p>
            </div>
            <!-- Propiedad y Domicilio  -->
            <div style="margin-left: 30px;">
                <p>Propiedad de: <b>{{ $fumigacion->nombrecompleto }}</b></p>
                <p>Con domicilio en: <b>{{ $fumigacion->lugardelservicio }}</b></p>
            </div>
            <div style="margin-left: 30px;">
                <p>Empleando los siguientes productos autorizados por la Secretaria de Salud.</p>
            </div>

            <div style="margin-left: 30px;">

                <div style="width: 50%; text-align:center">
                    <table style="float: left;">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Nombre Comercial.</th>
                                <td>PENDIENTE</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Laboratorio.</th>
                                <td>PENDIENTE</td>
                            </tr>
                            <tr>
                                <th>Dosificación. ML/LT</th>
                                <td>PENDIENTE</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div style="width: 50%;">
                    <table style="margin-left:90%">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Autorización SS.</th>
                                <td>PENDIENTE</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Ingrediente.</th>
                                <td>PENDIENTE</td>
                            </tr>
                            <tr>
                                <th>Cantidad Utilizada</th>
                                <td>PENDIENTE</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div style="margin-left: 30px;">
                <!-- Plaga a Controlar -->
                <p>Plaga a controloar</p>
                {{--  @foreach ($config->category as $value)
                <label><input type="checkbox" value="{{ $value }}" name="category[]"
                        @if ($value == '') checked @endif>{{ $value }}</label>
            @endforeach --}}
                <div class="checkbox-grid">

                    <input type="checkbox" id="insectosVoladores" name="insectosVoladores" value="insectosVoladores"
                        @if ($fumigacion->insectosvoladores == 'Si') checked @endif>
                    <label for="insectosVoladores"> Insectos Voladores</label><br>
                    <input type="checkbox" id="insectosRastreros" name="insectosRastreros" value="insectosRastreros"
                    @if ($fumigacion->insectosrastreros == 'Si') checked @endif>
                    <label for="insectosRastreros"> Insectos Rastreros</label><br>
                    <input type="checkbox" id="cucarachas" name="cucarachas" value="cucarachas"
                    @if ($fumigacion->cucaracha == 'Si') checked @endif>
                    <label for="vehicle3" style="font-size: 12px"> Cucarachas(Get/Ori/Ame)</label><br><br>


                </div>
                <div class="checkbox-grid">

                    <input type="checkbox" id="pulgas" name="pulgas" value="pulgas"
                    @if ($fumigacion->pulgas == 'Si') checked @endif>
                    <label for="pulgas"> Pulgas</label><br>
                    <input type="checkbox" id="mosca" name="mosca" value="mosca"
                    @if ($fumigacion->mosca == 'Si') checked @endif>
                    <label for="moscas"> Mosca</label><br>
                    <input type="checkbox" id="chinches" name="chinches" value="chinches"
                    @if ($fumigacion->chinches == 'Si') checked @endif>
                    <label for="chinches"> Chinches</label><br><br>


                </div>
                <div class="checkbox-grid">

                    <input type="checkbox" id="aracnidos" name="aracnidos" value="aracnidos"
                    @if ($fumigacion->aracnidos == 'Si') checked @endif>
                    <label for="aracnidos"> Aracnidos</label><br>
                    <input type="checkbox" id="hormigas" name="hormigas" value="hormigas"
                    @if ($fumigacion->hormigas == 'Si') checked @endif>
                    <label for="hormigas"> Hormigas</label><br>
                    <input type="checkbox" id="termitas" name="termitas" value="termitas"
                    @if ($fumigacion->termitas == 'Si') checked @endif>
                    <label for="termitas"> Termitas</label><br><br>


                </div>
                <div class="checkbox-grid">

                    <input type="checkbox" id="roedores" name="roedores" value="roedores"
                    @if ($fumigacion->roedores == 'Si') checked @endif>
                    <label for="roedores"> Roedores</label><br>
                    <input type="checkbox" id="alacranes" name="alacranes" value="alacranes"
                    @if ($fumigacion->alacranes == 'Si') checked @endif>
                    <label for="alacranes"> Alacranes</label><br>
                    <input type="checkbox" id="carcoma" name="carcoma" value="carcoma"
                    @if ($fumigacion->carcamo == 'Si') checked @endif>
                    <label for="carcoma"> carcoma</label><br><br>


                </div>
                <div>
                    <!-- Observaciones -->
                    <p>Observaciones</p>
                    <div style="border-style: solid; width:100%; heigth:10%;">
                        <p> <b> {{ $fumigacion->observaciones }} </b></p>
                    </div>

                    <!-- Método empleado -->
                    <p>Método de control empleado: <b>PENDIENTE</b></p>
                </div>

                <div style="text-align: center">
                    <p style="font-size: 14px;">Ing. Ruben Salazar A.</p>
                    <p style="font-size: 14px;">Tec. Control de Plagas</p>

                    <p style="font-size: 14px;">Calle Noche Buena #20 A. Colonia San Miguel Nopalapa, Epazoyuca Hdo,
                        43580
                    </p>
                    <p style="font-size: 14px;">Tels. 771 156 2821, 771110 1523 Email procip@outlook.com</p>
                </div>
            </div>

        </div>
    </body>
@endforeach

</html>
