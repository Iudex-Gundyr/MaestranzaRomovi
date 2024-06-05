<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salidas</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        @foreach($salidas as $salida)
            <h1 style="text-align: center">Salidas de materiales de almacenes de {{$salida->materialAlmacen->almacen->ubicacion->nombreu}}</h1>
            @break
        @endforeach
        <div style="text-align: center;">
            <a style="margin-bottom:15px" href="/CrearSalida/{{ $id_ubicacion }}" class="btn">Crear nueva Salida</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" style="background-color:green">
                {{ session('success') }}
            </div>
        @endif
        @if (isset($error))
            <div class="alert alert-danger" style="background-color: red">
                {{ $error }}
            </div>
        @endif


        <table>
            <thead>
                <tr>
                    <th>Nombre del material</th>
                    <th>En el Almacen</th>
                    <th>Cantidad de salida</th>

                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salidas as $salida)
                    @if($salida->cantidad > 0 )
                    <tr>

                        <td>{{$salida->materialAlmacen->material->nombrema}}</td>
                        <td>{{$salida->materialAlmacen->almacen->nombrea}}</td>
                        <td>
                            {{ rtrim(rtrim(number_format($salida->cantidad, 5), '0'), '.') }} <!-- Mostrar el número con máximo 4 decimales y sin ceros finales -->

                        </td>
                        <td>
                            <a href="#" onclick="confirmarEliminarSalida({{$id_ubicacion}},{{$salida->id_salida}})" class="btnEliminar">Eliminar</a>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
