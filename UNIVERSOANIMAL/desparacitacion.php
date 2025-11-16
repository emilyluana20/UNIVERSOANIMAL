<?php
session_start();

// 🔹 Verificar si hay sesión activa
if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}

// 🔹 Usar el rol correcto (de la sesión real)
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>

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
            <a href="/UNIVERSOANIMAL/pagina.php"><img src="img/logo.png" alt="Logo Universo Animal"></a>
        </div>

        <nav class="navbar">
  <div class="nav-container">


    <button class="menu-toggle" id="menuToggle">
      ☰
    </button>

    <ul class="nav-links" id="navMenu">
      <li class="dropdown">
        <a href="#">Cuidados</a>
        <ul class="submenu">
          <li><a href="desparacitacion.php">Desparasitación</a></li>
          <li><a href="pulgagarra.php">Pulgas y garrapatas</a></li>
          <li><a href="baños.php">Baños</a></li>
          <li><a href="Edades.php">Edades</a></li>
        </ul>
      </li>

      <li><a href="callamulloproyecto/index.php">Campañas</a></li>

      <?php if ($isAdmin): ?>
      <li class="dropdown">
        <a href="#">Admin</a>
        <ul class="submenu">
          <li><a href="Registro/crear_campañias.php">+ Crear campaña</a></li>
          <li><a href="tabla.php">- Eliminar Usuario</a></li>
        </ul>
      </li>
      <?php endif; ?>

      <li><a href="redsocial/ver.php">Perdidos</a></li>
      <li><a href="contacto.php">Contacto</a></li>
      <li><a href="Registro/logout.php" class="logout">Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>


        <button class="menu-hamburguesa" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <main class="contenedor-principal">
        <div class="contenedor">
            <img src="img/porfa.png" class="imagen-principal" alt="Mascota feliz">
            <div class="texto">
                <h1>Datos sobre nuestras mascotas</h1>
                <h3>El mejor cuidado para tu mascota. 🐾</h3>
                <p class="descripcion">En Universo Animal nos preocupamos por el bienestar de tus compañeros peludos.</p>
            </div>
        </div>
    </main>

    <section class="tarjeta-desparasitacion">
        <h2 class="titulo-tarjeta">Desparasitación Interna en Perros y Gatos</h2>
        <p class="texto-tarjeta">
            La desparasitación interna protege a las mascotas de parásitos intestinales como lombrices y tenias, 
            que pueden causar vómitos, diarrea, pérdida de peso y anemia. También ayuda a prevenir la transmisión a humanos.
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
    </section>

    <footer class="footerContainer">
        <div class="logos">
            <li><ion-icon name="logo-instagram"></ion-icon></li>
            <li><ion-icon name="logo-facebook"></ion-icon></li>
            <li><ion-icon name="logo-twitter"></ion-icon></li>
        </div>
        <div class="footerBotton">
            <p>Copyright &copy;2025 | Derechos reservados a Universo Animal</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="/UNIVERSOANIMAL/prueba.js"></script>
    <script>
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');

menuToggle.addEventListener('click', () => {
  navMenu.classList.toggle('open');
});
</script>

</body>
</html>
