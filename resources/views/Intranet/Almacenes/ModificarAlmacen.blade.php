<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examinando almacen</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">
        <h2>Modificar almacen</h2>
        <form action="{{ route('modificarAlmacen', $almacen->id_almacen) }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            @method('PUT') <!-- Para indicar que usaremos el método PUT en el envío del formulario -->
            <label for="nombre">Nombre del almacen:</label>
            <input type="text" id="nombrea" name="nombrea" value="{{$almacen->nombrea}}" required>
            <select name="ubicacion_id" id="ubicacion_id" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                <option value="{{ $almacen->ubicacion->id_ubicacion }}">{{ $almacen->ubicacion->nombreu }} (Seleccion actual)</option>
                @foreach($Ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id_ubicacion }}">{{ $ubicacion->nombreu }}</option>
                @endforeach
            </select>
            <button type="submit">Modificar almacen</button>
        
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
