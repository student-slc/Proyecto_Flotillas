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
                <th>Cliente</th>
                <th>Tipo Verificación</th>
                <th>Subtipo Verificación</th>
                <th>Ultima Verificación</th>
                <th>Marca</th>
                <th>Serie Unidad</th>
                <th>Año Unidad</th>
                <th>Placas</th>
                <th>Tipo Unidad</th>
                <th>Razon Social</th>
                <th>Digito Placa</th>
                <th>Kilometros</th>
                <th>Tipo Mantenimiento</th>
                <th>Frecuencia Mantenimiento</th>
                <th>Vencimiento Seguro</th>
                <th>Frecuencia Fumigacion</th>
                {{--  , "KILOMETROS", "TIPO MANTENIMIENTO", "FRECUENCIA MANTENIMIENTO", "VENCIMIENTO SEGURO", "FRECUENCIA FUMIGACION" --}}
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
                        <td>{{ $unidade->kilometros_contador }}</td>
                        <td>{{ $unidade->tipomantenimiento }}</td>
                        <td>{{ $unidade->frecuencia_mante }}</td>
                        <td>{{ $unidade->seguro_fecha }}</td>
                        <td>{{ $unidade->lapsofumigacion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
