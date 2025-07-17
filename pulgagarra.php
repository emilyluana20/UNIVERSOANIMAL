<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UNIVERSOANIMAL/estilos/diseño.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Datos | Universo Animal</title>
</head>
<body>
    <header class="Encabezado">
        <div class="logo-container">
            <img src="img/logo.png">
        </div>
        <nav class="menu">
            <a href="callamulloproyecto/index.php" class="styled-link">Búsqueda</a>
            <a href="redsocial/ver.php" class="styled-link">Feed</a>
            <div class="dropdown">
            <a href="" class="styled-link">Datos</a>
            <div class="submenu">
               <a href="desparacitacion.php">Desparacitación</a>
               <a href="pulgagarra.php">Pulgas y garrapatas</a>
               <a href="baños.php">Baños</a>
               <a href="Edades.php">Edades</a>
            </div>
            </div>
            <a href="contacto.php" class="styled-link">Contacto</a>
            <button class="boton"><a href="../Registro/logout.php">Cerrar sesión</a></button>
        </nav>
        <button class="menu-hamburguesa" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <main class="contenedor-principal">
        <div class="contenedor">
            <img src="img/sisi.png" class="imagen-principal">
            <div class="texto">
                <h1>Datos sobre nuestras mascotas</h1>
                <h3>El mejor cuidado para tu mascota. 🐾</h3>
                <p class="descripcion">En Universo Animal nos preocupamos por el bienestar de tus compañeros peludos.</p>
            </div>
        </div>
    </main>

    <br><br>

    <div class="tarjeta-desparasitacion">
  <h2 class="titulo-tarjeta">Desparasitación Externa en Perros y Gatos</h2>

  <p class="texto-tarjeta">
    La desparasitación externa protege a las mascotas de parásitos como pulgas, garrapatas y ácaros,
    que pueden causar irritación, enfermedades en la piel y transmitir infecciones graves.
  </p>

  <h3 class="subtitulo-tarjeta">¿Cuándo comenzar?</h3>
  <p class="texto-tarjeta">
    Se recomienda comenzar a partir de las 6 a 8 semanas de vida, según el producto. La protección debe
    mantenerse durante todo el año, incluso en invierno.
  </p>

  <h3 class="subtitulo-tarjeta">Frecuencia recomendada:</h3>
  <p class="texto-tarjeta">
    En general, se debe aplicar cada 30 días. En ambientes con mayor exposición, puede ser necesario reforzar 
    el tratamiento o combinar productos.
  </p>

  <h3 class="subtitulo-tarjeta">¿Cómo se realiza?</h3>
  <ul class="lista-tarjeta">
    <li>Pipetas: se aplican sobre la nuca; son eficaces y fáciles de usar.</li>
    <li>Collares antiparasitarios: brindan protección prolongada (hasta varios meses).</li>
    <li>Sprays o aerosoles: ideales para tratamientos puntuales.</li>
    <li>Comprimidos masticables: aunque se ingieren, actúan desde dentro contra parásitos externos.</li>
  </ul>

  <h3 class="subtitulo-tarjeta">Importante:</h3>
  <p class="texto-tarjeta">
    Usá siempre productos adecuados al peso, edad y especie de tu mascota. No bañes a tu mascota durante las 24-48
    horas antes o después de aplicar pipetas. Consultá con un veterinario para elegir el mejor tratamiento.
  </p>
</div>

    <br><br>

         <div class="footerContainer">
        <div class="logos">
            <li><ion-icon name="logo-instagram"></ion-icon></li>
            <li><ion-icon name="logo-facebook"></ion-icon></li>
            <li><ion-icon name="logo-twitter"></ion-icon></li>
        </div>
        <div class="footerNav">
           <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Busqueda</a></li>
            <li><a href="">Datos</a></li>
            <li><a href="">Feed</a></li>
           </ul>
        </div>
        <div class="footerBotton">
            <p>Copyright &copy;2025 | Derechos reservados a Universo Animal</p>
        </div>

    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js "></script> 
    <script  nomodule  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js "></script>
    <script src="/UNIVERSOANIMAL/prueba.js"></script>

</body>
</html>