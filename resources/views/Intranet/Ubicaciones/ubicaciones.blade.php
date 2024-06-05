<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Ubicación</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        <div style="text-align: center;">
        <a href="/CrearUbicacion" class="btn">Crear nueva Ubicacion</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Nombre de la ubicacion</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Ubicaciones as $Ubicacion)
                <tr>

                    <td>{{ $Ubicacion->nombreu }}</td>
                    <td>
                        <a href="/examinarUbicacion/{{ $Ubicacion->id_ubicacion }}" class="btnExaminar">Examinar</a>
                        <a href="#" onclick="confirmarEliminarUbicacion({{ $Ubicacion->id_ubicacion }})" class="btnEliminar">Eliminar</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
