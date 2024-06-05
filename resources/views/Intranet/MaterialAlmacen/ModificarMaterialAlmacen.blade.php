<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examinando Material</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">

        <h1 style="text-align: center">Agregar material a un almacen de {{$ubicacion->nombreu}}<h1>

            <form action="/modificarMaterialAlmacen/{{$ubicacion->id_ubicacion}}/{{$id_Mat_Alm}}" method="POST">
                @csrf <!-- Para protección contra ataques CSRF en Laravel -->
                @method('PUT') <!-- Para indicar que usaremos el método PUT en el envío del formulario -->
            <label for="nombre">Nombre del almacen:</label>
            <select name="id_almacen" id="id_almacen" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                <option value="{{ $almActual->id_almacen }}">{{ $almActual->nombrea }} (Seleccion Actual)</option>
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id_almacen }}">{{ $almacen->nombrea }} </option>
                @endforeach
            </select>
            <label for="nombre">Material</label>
            <select name="id_material" id="id_material" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                <option value="{{ $matActual->id_material }}">{{ $matActual->nombrema }} (Seleccion Actual)</option>
                @foreach($materiales as $material)
                    <option value="{{ $material->id_material }}">{{ $material->nombrema }}</option>
                @endforeach
            </select>
            <button type="submit">Modificar Material</button>
        
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
