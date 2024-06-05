<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SoftwareSouls</title>
</head>
<link rel="icon" href="{{ asset('img/Mascot-Logo16.png') }}" />
<body>

    <div class="background">
    </div>


    <div class="container2">
        <div class="box2">
            <div class="LogoContainer">
                <img src="{{ asset('img/Mascot-Logo.png') }}" alt="logo" class="Logo">
            </div>

            <div class="Firma">
                Esta firma certifica que el software presente ha sido meticulosamente desarrollado por SoftwareSouls. Su propósito es puramente testimonial y no tiene la intención de llevar a cabo acciones o interacciones dentro del sistema en el que se implementa. Más bien, se presenta como una declaración oficial de autoría por parte de SoftwareSouls, la entidad responsable detrás del desarrollo del software en cuestión.

Te invitamos cordialmente a validar la autenticidad de esta afirmación al observar el dominio actual en el que te encuentras, el cual está directamente vinculado con el sitio web del software desarrollado.
            </div>

            <div class="Firma">
                <h1>
                    <button class="bttn" onclick="window.location.href = 'https://maestranzaromovi.cl';">Ver la aplicación web</button>

                </h1>
            </div>
        </div>
    </div>
</body>
</html>
<style>
    .bttn {
        margin: 40%;
        width: 200px; /* Cambiar el valor del ancho del botón */
        position: relative;
        background-color: rgba(128, 0, 0, 0.87);
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
    }
    .bttn:hover {
      background-color: rgba(150, 0, 0, 1);
      box-shadow: 0 0 10px rgba(229, 255, 0, 0.8);
      transform: scale(1.1); /* Aumenta el tamaño al pasar el mouse */
    }
    .LogoContainer {
        display: inline-block;
        perspective: 1000px; /* Perspectiva para efecto 3D */
    }
    
    .Logo {
        width: 150px; /* Tamaño deseado de la imagen */
    
    }
    .container2 {
        color: #fff;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        height: 100vh; /* Utiliza el 100% de la altura visible */
    }
    @keyframes fuego {
        0% { transform: translateY(0); box-shadow: 0px 0px 10px 0px rgba(255, 81, 0, 0.87); }
        25% { transform: translateY(0px); box-shadow: 0px 0px 20px 0px rgba(255, 0, 0, 0.842); }
        50% { transform: translateY(0); box-shadow: 0px 0px 10px 0px rgba(255, 0, 0, 0.884); }
        75% { transform: translateY(0px); box-shadow: 0px 0px 20px 0px rgba(255, 174, 0, 0.959); }
        100% { transform: translateY(0); box-shadow: 0px 0px 10px 0px rgba(255, 208, 0, 0.877); }
    }
    
    .box2 {
        animation: fuego 1.5s infinite alternate; /* Animación de fuego */
        display: flex; /* Aplicar display flex a los elementos .box2 */
        justify-content: space-evenly; /* Distribuir los elementos .Firma horizontalmente */
        align-items: center; /* Centrar los elementos .Firma verticalmente */
        width: 75%; /* Ancho del 50% menos el espacio */
        height: 25%;
        margin: 10px;
        padding: 20px;
        background-color: rgba(36, 10, 10, 0.871);
        text-align: center;
    }
    
    .Firma {
        text-align: justify;
        width: 50%;
    }
    
    /* Eliminar los márgenes predeterminados de los elementos .Firma */
    .Firma > * {
        margin: 0;
    }
    .background {
        background-image: url('../../../img/background.jpg');
        background-color: rgba(241, 12, 12, 0.74); /* Color de filtro */
        background-blend-mode: multiply; /* Aplica el filtro de multiplicación */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        overflow: auto;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
    }
    
    @media screen and (max-width: 768px) {
        .box {
            width: calc(100% - 20px); /* En dispositivos móviles, el ancho será del 100% */
        }
    }
    
    </style>