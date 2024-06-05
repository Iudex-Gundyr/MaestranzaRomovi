<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entradas</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        @foreach($entradas as $entrada)
            <h1 style="text-align: center">Entradas de materiales de almacenes de {{$entrada->materialAlmacen->almacen->ubicacion->nombreu}}</h1>
            @break
        @endforeach
        <div style="text-align: center;">
            <a style="margin-bottom:15px" href="/CrearEntrada/{{ $id_ubicacion }}" class="btn">Crear nueva entrada</a>


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
                    <th>Cantidad</th>
                    <th>Valor entrada (CLP)</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->materialAlmacen->material->nombrema }}</td>
                    <td>{{ $entrada->materialAlmacen->almacen->nombrea }}</td>
                    <td>
                        {{ rtrim(rtrim(number_format($entrada->cantidad, 5), '0'), '.') }} <!-- Mostrar el número con máximo 4 decimales y sin ceros finales -->
                    </td>
                    <td>{{ number_format($entrada->valor, 0, ',', '.') }} CLP</td>
                    <td>
                        <a href="#" onclick="confirmarEliminarEntrada({{$id_ubicacion}},{{$entrada->id_entrada}})" class="btnEliminar">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
