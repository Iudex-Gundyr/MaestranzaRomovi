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
        <form action="{{ route('RegistrarUsuario') }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        
            <button type="submit">Crear Usuario</button>
        
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
