<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ROMOVI</title>
        <link href="{{ asset('css/Romovi.css') }}" rel="stylesheet">
        <script src="{{ asset('js/Romovi.js') }}"></script>
        <link rel="icon" type="image/png" href="{{ asset('img/LogoRomovi.png') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
    </head>
    <body style="background-image: url('{{ asset('img/BackgroundRomovi.jpg') }}');">
        <div class="navbar" style="background-color: white">
            <!-- Logo al lado izquierdo -->
            <img src="{{ asset('img/LogoRomovi.png') }}" alt="Logo" class="logo"> <!-- Ajusta la ruta y el tamaño según necesites -->
            <div class="navbar">
                <!-- Enlaces alineados a la derecha -->
                <div class="links">
                    <a href="#services">Servicios</a>
                    <a href="#nosotros">Nosotros</a>
                    <a href="#VM">Vision y Mision</a>
                    <a href="#Contacto">Contacto</a>
                </div>
            </div>
        </div>
        <div >
            <div class="container" id="services">
                <div class="container" >
                    <div class="box" style="background-color:white;">
                        <div class="text-container romovi-text">
                            <h2>Servicios</h2>
                            - Mecanizado.<br><br>
                            - Fabricación de flexibles hidráulicos de baja y alta presión.<br><br>
                            - Fabricación y reparación de componentes de maquinarias.<br><br>
                            - Mecanizado en terreno con tornos portátiles.<br><br>
                            - Soldadura en general.<br><br>
                        </div>

                    </div>
                    <div id="randomBgImage" class="img" style="background-image: url('{{ asset('img/Romovi1.png') }}'); background-size: 100% auto; background-position: center; background-repeat: no-repeat;"></div>
                    </div>
                </div>
            </div>
            <div class="container" id="nosotros">
                <div class="container">
                    <div id="randomBgImage2" class="img" style="background-image: url('{{ asset('img/Romovi2.png') }}'); background-size: 100% auto; background-position: center; background-repeat: no-repeat;">
                    </div>
                    <div class="box" style="background-color:white;">
                        <div class="text-container nosotros-text">
                            <h1>Roberto C. Monroy V.</h1><br>
                            Dueño y Gerente de la empresa ROMOVI determina y se compromete a mantener un sistema para el mejoramiento continuo de sus procesos que aseguran el involucramiento de sus proveedores, colaboradores, socios comerciales para lograr acciones planeadas y sistemáticas que tienden a:<br><br>
                        
                            * Resguardar la identidad física de los trabajadores procurando ambientes de trabajo acordes a la normativa vigente.<br><br>
                            * Cuidado del medio ambiente como una garantía de desarrollo sustentable.<br><br>
                            * Fomentar relaciones de respeto y convivencia con la comunidad en la que se encuentra inserta.<br><br>
                            * Proporcionar un clima laboral ameno y agradable.<br><br>
                            * Desarrollar los procesos estableciendo estándares de calidad definitivos y auditables.<br><br>
                            * Dar cabal cumplimiento a la normativa legal vigente.<br><br>
                        </div>

                    </div>
                </div>
            </div>
            <div class="container" id="VM">
                <div class="container">
                    <div class="box" style="background-color:white;">
                        <div class="title-container vision-title">
                            <h1>Misión</h1>
                        </div>
                        <div class="text-container vision-text">
                            Suministrar, fabricar piezas, repuestos y accesorios metalmecánicos de óptima calidad y precisión para la Industria en general, que logren la satisfacción del cliente y proporcionen a nuestra organización una adecuada retribución.
                        </div>
                    </div>
                    <div class="box" style="background-color:white;">
                        <div class="title-container mision-title">
                            <h1>Visión</h1>
                        </div>
                        <div class="text-container mision-text">
                            Convertirnos en la mejor opción para nuestros clientes actuales y potenciales para el suministro de sus necesidades en lo referente a la fabricación de elementos metalmecánicos, siendo un apoyo tecnológico para sus procesos productivos.
                        </div>
                    </div>
                </div>

            </div>
            <div class="container" id="Contacto">
                <div class="container2">
                    <div class="box" style="background-color:white;">
                        <div class="title-container contactanos-title">
                            <h1>Contactanos</h1>
                        </div>
                        <div class="text-container contactanos-text">
                            <h2>dirección:</h2>Osorno 9, Maria Elena. <br><br>
                            <h2>Correo:</h2>r.monroy.v@maestranzaromovi.cl. <br><br>
                            <h2>Numero:</h2>+56 9 7585 3111<br>

                        </div>
                    </div>
                    <div class="box" style="background-color:white;">
        
                        <div class="text-container contactanos-text">
                            <h1>Envianos un mensaje</h1>
                            <form id="contactForm" method="POST">
                                @csrf
                                <label for="nombre">Nombre:</label><br>
                                <input type="text" id="nombre" name="nombre"><br><br>
                            
                                <label for="correo">Correo electrónico:</label><br>
                                <input type="email" id="correo" name="correo"><br><br>
                            
                                <label for="telefono">Teléfono:</label><br>
                                <input type="tel" id="telefono" name="telefono"><br><br>
                            
                                <label for="mensaje">Mensaje adicional:</label><br>
                                <textarea id="mensaje" name="mensaje"></textarea><br><br>
                                
                                <button type="submit">Enviar</button>
                            </form>
                            <div id="Enviado" style="display: none">¡Mensaje Enviado!</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box2" style="background-color:white;">
                <div class ="text-container mapa-text">
                    <h1>Ubicación en mapa</h1>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7380.5674134891415!2d-69.66954288310522!3d-22.342913994888143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96ac59022be4d1d7%3A0x3ca58f6db12e8a7f!2sMar%C3%ADa%20Elena%2C%20Maria%20Elena%2C%20Antofagasta!5e0!3m2!1ses!2scl!4v1710226200526!5m2!1ses!2scl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>


    </body>
</html>

<script>
$(document).ready(function() {
    $('#contactForm').submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de la manera tradicional
            $('#Enviado').css('display', 'block');
                // Oculta el formulario
            $('#contactForm').css('display', 'none');
        $.ajax({
            type: 'POST',
            url: '{{ route("send.email") }}',
            data: $(this).serialize(), // Serializa los datos del formulario
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

            },
            error: function(xhr, status, error) {
                // Manejar errores aquí
                alert('Hubo un error al enviar el correo.');
            }
        });
    });
});
</script>