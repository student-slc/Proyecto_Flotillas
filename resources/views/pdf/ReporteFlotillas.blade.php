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
            </thead>
            <tbody>
                @foreach ($unidades as $unidade)
                    <tr>
                        <td>{{ $unidade->id }}</td>
                        <td>{{ $unidade->nombrecompleto }}</td>
                        <td>{{ $unidade->marca }}</td>
                        <td>{{ $unidade->serieunidad }}</td>
                        <td>{{ $unidade->añounidad }}</td>
                        <td>{{ $unidade->placas }}</td>
                        <td>{{ $unidade->tipounidad }}</td>
                        <td>{{ $unidade->razonsocialunidad }}</td>
                        <td>{{ $unidade->digitoplaca }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
