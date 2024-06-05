<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/Intranet.css') }}" rel="stylesheet">

</head>
<body>
    <div class="navbar">
  
        <ul>
            <img src="{{ asset('img/LogoRomovi.png') }}" alt="Logo de la empresa" class="logo">
            <li class="open"><a href="/dashboard"><i class="fa fa-building" aria-hidden="true"></i>Dashboard</a></li>
            <li>
                <a href="#"><i class="fas fa-bars" aria-hidden="true"></i>Almacenes<i class="fa fa-arrow-down arrow-icon" aria-hidden="true"></i></a>
                <ul class="sub-menu">
                @foreach($ubicaciones as $ubicacion)
                    <li><a href="/MaterialAlmacen/{{ $ubicacion->id_ubicacion }}"><i class="fa fa-compass" aria-hidden="true"></i>{{ $ubicacion->nombreu }}</a>
                        <ul>
                            <li><a href="/Entradas/{{ $ubicacion->id_ubicacion }}" ><i class="fa fa-compass" aria-hidden="true"></i>Entradas</a></li>
                            <li><a href="/Salidas/{{ $ubicacion->id_ubicacion }}" ><i class="fa fa-compass" aria-hidden="true"></i>Salidas</a></li>
                        </ul>
                    </li>
                @endforeach
                </ul>
            </li>
            <li class="parent"><a href="#"><i class="fas fa-cog"></i>Configuración<i class="fa fa-arrow-down arrow-icon" aria-hidden="true"></i></a>
                <ul class="sub-menu">
                    <li><a href="/ubicaciones"><i class="fa fa-compass" aria-hidden="true"></i>Ubicaciones</a></li>
                    <li><a href="/Almacenes"><i class="fa fa-archive" aria-hidden="true"></i>Almacenes</a></li>
                    <li><a href="/unidadesMedidas"><i class="fa fa-list-ol" aria-hidden="true"></i>Unidades de medida</a></li>
                    <li><a href="/Materiales"><i class="fa fa-tag" aria-hidden="true"></i>Materiales</a></li>
                    <li><a href="/Usuarios"><i class="fa fa-user" aria-hidden="true"></i>Usuarios</a></li>
                </ul>
            </li>
        </ul>
    </div>
</body>
</html>
<script src="{{ asset('js/Intranet.js') }}"></script>