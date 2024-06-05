<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div style="margin-left: 250px; padding: 20px;">
        <h1 style="text-align: center">Materiales bajo el stock de seguridad</h1>
        <div class="gastos">
            <div class="gasto">
                Gastos últimos 30 días
            </div>

            <div class="gasto">
                Gastos últimos 6 meses
            </div>

            <div class="gasto">
                Gastos últimos 12 meses
            </div>

        </div>
        <div class="gastos">
            <div class="gasto1">
                ${{ number_format($suma1, 0, ',', '.') }} CLP
            </div>
            <div class="gasto1">
                ${{ number_format($suma6, 0, ',', '.') }} CLP
            </div>
            <div class="gasto1">
                ${{ number_format($suma12, 0, ',', '.') }} CLP
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre del material</th>
                    <th>Ubicacion</th>
                    <th>Cantidad actual/Tipo Medida</th>
                    <th>Cantidad de seguridad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    

                    <tr>
                        <td>{{$dato->nombrema}}</td>
                        <td>{{$dato->nombreu}}</td>
                        <td style="color: red">{{$dato->suma_entrada - $dato->suma_salida }}   /   {{$dato->nombrem}}</td>
                        <td>{{$dato->cantidad_seguridad}}</td>

                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
