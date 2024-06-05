<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Usuario</title>
</head>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">
        <h2>Crear Usuario</h2>
        <form action="{{ route('modificarUsuario', $usuario->id_usuario) }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            @method('PUT') <!-- Para indicar que usaremos el método PUT en el envío del formulario -->
        
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $usuario->nombre }}" required>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $usuario->email }}" required>
        
            <label for="password">Contraseña (Dejar en blanco si no desea modificar):</label>
            <input type="password" id="password" name="password">
        
            <button type="submit">Modificar Usuario</button>
        
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
