<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Material</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">
        <h2>Crear Material</h2>
        <form action="{{ route('RegistrarMaterial') }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            <label for="nombre">Nombre del Material:</label>
            <input type="text" id="nombrema" name="nombrema" value="{{ old('nombrema') }}" required>
            <label for="nombre">Cantidad de seguridad (Aviso al llegar al limite):</label>
            <input type="text" id="cantidad_seguridad" name="cantidad_seguridad" value="{{ old('cantidad_seguridad') }}" required>
            <label for="nombre">Unidad de medida:</label>
            <select name="id_medida" id="id_medida" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                @foreach($Medidas as $medida)
                    <option value="{{ $medida->id_medida }}">{{ $medida->nombrem }}</option>
                @endforeach
            </select>
            <button type="submit">Crear Material</button>
        
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
