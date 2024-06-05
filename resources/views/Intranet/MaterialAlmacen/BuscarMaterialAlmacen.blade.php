<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materiales Almacen</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        @foreach($matalm as $materialAlmacen)
            <h1 style="text-align: center">Materiales de almacenes de {{$materialAlmacen->almacen->ubicacion->nombreu}}</h1>
            <h4 style="text-align: center">Se muestran los materiales que contengan "{{$filtro}}" en su nombre</h4>
            @break
        @endforeach

        @if (isset($success))
            <div class="alert alert-success" style="background-color:green">
                {{$success}}
            </div>
        @endif
        @if (isset($error))
            <div class="alert alert-danger" style="background-color: red">
                {{ $error }}
            </div>
        @endif
        @foreach($matalm as $materialAlmacen)
        <form action="{{ route('buscarMaterialAlmacen',$materialAlmacen->almacen->ubicacion->id_ubicacion) }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            <label for="nombre">Buscar por nombre (No escribir nada para que muestre todos los materiales nuevamente):</label>
            <input type="text" id="nombrema" name="nombrema" value="{{ old('nombrema') }}">
        
            <button type="submit">Buscar</button>
        
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
        @break
        @endforeach

        <table>
            <thead>
                <tr>
                    <th>Nombre del material</th>
                    <th>Cantidad Actual</th>
                    <th>Cantidad de seguridad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                <tr>
                    <td>{{$dato->nombrema}}</td>
                    <td>{{$dato->suma_entrada - $dato->suma_salida }}   /   {{$dato->nombrem}}</td>
                    <td>{{$dato->cantidad_seguridad}}</td>
                </tr>
                @endforeach

  
            </tbody>

        </table>
    </div>

</body>
</html>
