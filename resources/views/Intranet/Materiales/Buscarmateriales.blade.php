<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materiales</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->

    <div class="container" style="margin-left: 250px; padding: 20px;">
        <div style="text-align: center;">
        <a href="/CrearMaterial" class="btn">Crear nuevo Material</a>
        </div><br>
        <h4 style="text-align: center">Se muestran los materiales que contengan "{{$filtro}}" en su nombre</h4>
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('Buscarmateriales') }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            <label for="nombre">Buscar por nombre (Buscar los materiales con lo mas parecido escrito):</label>
            <input type="text" id="nombrema" name="nombrema" value="{{ old('nombrema') }}" required>
        
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
        <table>
            <thead>
                <tr>
                    <th>Nombre del material</th>
                    <th>Tipo de medida</th>
                    <th>Cantidad de seguridad</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiales as $material)
                <tr>
                    <td>{{$material->nombrema}}</td>
                    <td>{{$material->medida->nombrem}}</td>
                    <td>{{$material->cantidad_seguridad}}</td>
                    <td>
                        <a href="/examinarMaterial/{{$material->id_material}}" class="btnExaminar">Examinar</a>
                        <a href="#" onclick="confirmarEliminarMaterial({{$material->id_material}})" class="btnEliminar">Eliminar</a>
                    </td>
                </tr>
                @endforeach
  
            </tbody>

        </table>
    </div>

</body>
</html>
