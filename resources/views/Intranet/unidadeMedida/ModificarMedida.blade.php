<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificando Medida</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">
        <h2>Modificando Medida</h2>
        <form action="{{ route('modificarUnidadMedida', $medidas->id_medida ) }}" method="POST">
                @csrf <!-- Para protección contra ataques CSRF en Laravel -->
                @method('PUT') <!-- Para indicar que usaremos el método PUT en el envío del formulario -->
            <label for="nombre">Nombre de medida:</label>
            <input type="text" id="nombrem" name="nombrem" value="{{ $medidas->nombrem }}" required>
        
            <button type="submit">Modificar Medida</button>
        
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: #ffcccc; color: #cc0000; padding: 10px; border-radius: 5px;">
                    <ul style="list-style-type: none; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

</body>
</html>
