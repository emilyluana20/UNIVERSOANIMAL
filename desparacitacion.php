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
            <a href="pagina.php" class="styled-link">Inicio</a>
            <a href="callamulloproyecto/index.php" class="styled-link">Búsqueda</a>
            <a href="redsocial/ver.php" class="styled-link">Feed</a>
            <div class="dropdown">
            <a href="desparacitacion.php" class="styled-link">Datos</a>
            <div class="submenu">
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
            <img src="img/porfa.png" class="imagen-principal">
            <div class="texto">
                <h1>Datos sobre nuestras mascotas</h1>
                <h3>El mejor cuidado para tu mascota. 🐾</h3>
                <p class="descripcion">En Universo Animal nos preocupamos por el bienestar de tus compañeros peludos.</p>
            </div>
        </div>
    </main>

    <br><br>

    <div class="tarjeta-desparasitacion">
  <h2 class="titulo-tarjeta">Desparasitación Interna en Perros y Gatos</h2>
  <p class="texto-tarjeta">
    La desparasitación interna protege a las mascotas de parásitos intestinales como lombrices y tenias, que pueden causar 
    vómitos, diarrea, pérdida de peso y anemia. También ayuda a prevenir la transmisión a humanos.
  </p>

  <h3 class="subtitulo-tarjeta">¿Cuándo comenzar?</h3>
  <p class="texto-tarjeta">
    Cachorros: desde los 15 días de vida. Gatitos y perritos deben desparasitarse cada 15 días hasta los 3 meses.
  </p>

  <h3 class="subtitulo-tarjeta">Frecuencia según la edad:</h3>
  <ul class="lista-tarjeta">
    <li>3 a 6 meses: cada 30 días.</li>
    <li>Desde los 6 meses: cada 3 a 6 meses según el entorno y estilo de vida.</li>
  </ul>

  <h3 class="subtitulo-tarjeta">¿Cómo se realiza?</h3>
  <p class="texto-tarjeta">
    Se administra un antiparasitario oral en forma de:
  </p>
  <ul class="lista-tarjeta">
    <li>Jarabe (ideal para cachorros)</li>
    <li>Comprimido masticable</li>
    <li>Pastilla tradicional</li>
  </ul>
  <p class="texto-tarjeta">
    Siempre debe dosificarse según el peso del animal y bajo recomendación veterinaria.
  </p>

  <h3 class="subtitulo-tarjeta">Importante:</h3>
  <p class="texto-tarjeta">
    Muchas veces no hay síntomas visibles, por eso es clave realizar la desparasitación de 
    forma preventiva y periódica. Consultá al veterinario para elegir el producto adecuado.
  </p>
</div>

    <br><br>

     <div class="footerContainer">
        <div class="logos">
            <li><ion-icon name="logo-instagram"></ion-icon></li>
            <li><ion-icon name="logo-facebook"></ion-icon></li>
            <li><ion-icon name="logo-twitter"></ion-icon></li>
        </div>
        <div class="footerBotton">
            <p>Copyright &copy;2025 | Derechos reservados a Universo Animal</p>
        </div>

    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js "></script> 
    <script  nomodule  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js "></script>
    <script src="/UNIVERSOANIMAL/prueba.js"></script>

</body>
</html>