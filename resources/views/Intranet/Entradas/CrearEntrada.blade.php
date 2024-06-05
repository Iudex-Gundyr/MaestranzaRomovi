<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Entrada</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">

        <h1 style="text-align: center">Agregar material a un almacen de {{$ubicacion->nombreu}}</h1>

        <form action="{{ route('registrarEntrada', $ubicacion->id_ubicacion) }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            <label for="nombre">Nombre del almacen:</label>
            <select name="id_almacen" id="id_almacen" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                <option value="">-</option>
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id_almacen }}">{{ $almacen->nombrea }}</option>
                @endforeach
            </select>
            <label for="nombre">Material</label>
            <select name="id_material" id="id_material" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                <option value="">-</option>
                @foreach($materiales as $material)
                    <option value="{{ $material->id_material }}">{{ $material->nombrema }}</option>
                @endforeach
            </select>
            <label for="cantidad">Cantidad:</label>
            <input class="input" type="number" id="cantidad" name="cantidad" step="0.001" value="{{ old('cantidad') }}" required>
            <label for="valor">Valor de la entrada $CLP:</label>
            <input  type="text" id="valor" name="valor" value="{{ old('valor') }}" required>
            <button type="submit">Crear entrada</button>
        
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
