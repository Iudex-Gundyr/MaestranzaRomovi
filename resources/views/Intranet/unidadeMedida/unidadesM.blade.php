<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medidas</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        <div style="text-align: center;">
        <a href="/CrearUnidadMedida" class="btn">Crear nueva medida</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Nombre de la medida</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medidas as $medida)
                <tr>

                    <td>{{ $medida->nombrem }}</td>
                    <td>
                        <a href="/exanimarMedida/{{ $medida->id_medida }}" class="btnExaminar">Examinar</a>
                        <a href="#" onclick="confirmarEliminarMedida({{ $medida->id_medida }})" class="btnEliminar">Eliminar</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
