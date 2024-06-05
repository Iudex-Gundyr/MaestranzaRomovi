<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Almacenes</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        <div style="text-align: center;">
        <a href="/CrearAlmacen" class="btn">Crear nuevo almacen</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Nombre del almacen</th>
                    <th>Ubicacion del almacen</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($almacenes as $almacen)
                <tr>
                    <td>{{ $almacen->nombrea }}</td>
                    <td>{{ $almacen->ubicacion->nombreu }}</td>
                    <td>
                        <a href="/examinarAlmacen/{{ $almacen->id_almacen }}" class="btnExaminar">Examinar</a>
                        <a href="#" onclick="confirmarEliminarAlmacenes({{ $almacen->id_almacen }})" class="btnEliminar">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</body>
</html>
