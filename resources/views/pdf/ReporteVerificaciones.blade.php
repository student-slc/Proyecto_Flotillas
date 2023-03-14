<!DOCTYPE html>
<html>

<head>
    <title>{{ $nombre }}</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid black;
            padding: 8px;

        }

        td {
            font-size: 10px
        }


        #customers th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #efa94a;
            color: white;
            font-size: 12px;
        }


        table {
            margin-left: auto;
            margin-right: auto;

        }

        .angled-gradient {
            background-color: #3c3c3c;
            height: 50px;
            padding: 9px;
            border-radius: 10px;
            margin-bottom: 2px;

        }

        img {
            height: 60px;
            float: left;

        }
    </style>
</head>

<body>

    <div style="overflow-x:auto;">

        <div class="angled-gradient">

            <img src="https://0201.nccdn.net/1_2/000/000/14b/70b/5b99725845e97.png#RDAMDAID16968973" alt="">
            <div style="float:left">
                <h3 style="color:white; margin-left:20px">{{ $nombre }}</h3>

            </div>
            <div style="text-align:right;">
                @php
                    date_default_timezone_set('America/Mexico_City');
                    $fecha = date('d-m-Y H:i:s');
                @endphp
                <p style="color: white">Fecha de emisión del reporte: {{ $fecha }}
                </p>
            </div>
        </div>

        <table id="customers">
            <thead>
                <th>Id Cliente</th>
                <th>Cliente</th>
                <th>Marca</th>
                <th>Serie Unidad</th>
                <th>Año Unidad</th>
                <th>Placas</th>
                <th>Tipo Unidad</th>
                <th>Razon Social Unidad</th>
                <th>Digito Placa</th>
                <th>Folio Verificación</th>
                <th>Tipo Verificación</th>
                <th>Subtipo Verificación</th>
                <th>Ultima Verificación</th>
            </thead>
            <tbody>
                @foreach ($unidades as $unidade)
                    <tr>
                        <td> {{ $unidade->id }} </td>
                        <td> {{ $unidade->nombrecompleto }} </td>
                        <td> {{ $unidade->marca }} </td>
                        <td> {{ $unidade->serieunidad }} </td>
                        <td> {{ $unidade->añounidad }} </td>
                        <td> {{ $unidade->placas }} </td>
                        <td> {{ $unidade->tipounidad }} </td>
                        <td> {{ $unidade->razonsocialunidad }} </td>
                        <td> {{ $unidade->digitoplaca }} </td>
                        <td> {{ $unidade->noverificacion }} </td>
                        <td> {{ $unidade->tipoverificacion }} </td>
                        <td> {{ $unidade->subtipoverificacion }} </td>
                        <td> {{ $unidade->ultimaverificacion }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ $nombre }}</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="{{ asset('css/reporte.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div id="header">
        <div class="wrap">
            <img id="logo" alt="image" src="{{ asset('img/logo_reporte.png') }}" width="200" height="110">
            <h1 id="logo"><a href="#">{{ $nombre }}</a></h1>
            @php
                date_default_timezone_set('America/Mexico_City');
                $fecha = date('d-m-Y H:i:s');
            @endphp
            <p><br />Fecha de emisión del reporte: {{ $fecha }} </p>
        </div>
    </div>
    <div class='wrap'>
        <table class="table table-striped mt-2">
            <thead style="background-color:#000000">
                <th style="color:#fff;">Cliente</th>
                <th style="color:#fff;">Tipo Verificación</th>
                <th style="color:#fff;">Subtipo Verificación</th>
                <th style="color:#fff;">Ultima Verificación</th>
                <th style="color:#fff;">Marca</th>
                <th style="color:#fff;">Serie Unidad</th>
                <th style="color:#fff;">Año Unidad</th>
                <th style="color:#fff;">Placas</th>
                <th style="color:#fff;">Tipo Unidad</th>
                <th style="color:#fff;">Razon Social</th>
                <th style="color:#fff;">Digito Placa</th>
            </thead>
            <tbody>
                @foreach ($unidades as $unidade)
                    <tr>
                        <td>{{ $unidade->cliente }} </td>
                        <td>{{ $unidade->tipoverificacion }} </td>
                        <td>{{ $unidade->subtipoverificacion }} </td>
                        <td>{{ $unidade->ultimaverificacion }} </td>
                        <td>{{ $unidade->marca }} </td>
                        <td>{{ $unidade->serieunidad }} </td>
                        <td>{{ $unidade->añounidad }} </td>
                        <td>{{ $unidade->placas }} </td>
                        <td>{{ $unidade->tipounidad }} </td>
                        <td>{{ $unidade->razonsocialunidad }} </td>
                        <td>{{ $unidade->digitoplaca }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

</html>


 --}}
