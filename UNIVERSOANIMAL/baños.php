<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /UNIVERSOANIMAL/index.php?msg=acceso_no_autorizado");
    exit();
}

$isAdmin = (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin');
// 🔹 Usar el rol correcto (de la sesión real)
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>
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
            <a href="pagina.php"><img src="img/logo.png"></a>
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
            <img src="img/ultima.png" class="imagen-principal">
            <div class="texto">
                <h1>Datos sobre nuestras mascotas</h1>
                <h3>El mejor cuidado para tu mascota. 🐾</h3>
                <p class="descripcion">En Universo Animal nos preocupamos por el bienestar de tus compañeros peludos.</p>
            </div>
        </div>
    </main>

    <br><br>
    
<section class="bath-info">
  <h2>Baños recomendados para perros y gatos</h2>

  <div class="species-section">
    <!-- PERROS -->
    <div class="species-box">
      <h3>Perros</h3>
      <p>¿Cuándo puede ser el primer baño?<br>
        A partir de los 2 meses, idealmente cuando ya tenga todas sus primeras vacunas.  
        Si se ensucia antes, usar baño seco o toallas húmedas especiales para mascotas.
      </p>
      <p>¿Cada cuánto bañarlo?<br>
        Cada 1 a 3 meses, según el tipo de pelaje y estilo de vida:
        <ul>
          <li>Pelo corto y poco exterior: cada 2–3 meses.</li>
          <li>Pelo largo o salidas frecuentes: cada mes.</li>
        </ul>
      </p>
      <p>Consejos:</p>
      <ul>
        <li>Usar shampoo especial para perros.</li>
        <li>Secar bien, sobre todo si hace frío.</li>
        <li>No usar perfumes ni productos con alcohol.</li>
      </ul>
    </div>

    <!-- GATOS -->
    <div class="species-box">
      <h3>Gatos</h3>
      <p>¿Cuándo puede ser el primer baño?<br>
        Generalmente no necesitan baño, pero si es necesario, se recomienda desde los 3 meses.
      </p>
      <p>¿Cada cuánto bañarlo?<br>
        Solo cuando sea estrictamente necesario.  
        Algunos gatos aceptan baños cada 6 meses o más.  
        Razas sin pelo (como el Sphynx) pueden requerir más frecuencia.
      </p>
      <p>Consejos:</p>
      <ul>
        <li>Usar shampoo especial para gatos.</li>
        <li>Mantener el ambiente cálido y tranquilo.</li>
        <li>Secar con toalla suave, evitar secador si se asustan.</li>
      </ul>
    </div>
  </div>

  <!-- TIPS GENERALES -->
  <h2>Tips para que se acostumbren al baño</h2>
  <div class="species-section">
    <!-- PERROS -->
    <div class="species-box">
      <h3>Para Perros</h3>
      <ul>
        <li>Empezá desde cachorro: cuanto antes lo conozca, mejor.</li>
        <li>Hacelo divertido: usá juguetes o hablale con voz alegre.</li>
        <li>Baños cortos: 5–10 minutos al principio para evitar estrés.</li>
        <li>Premialo: un snack o caricia después del baño ayuda.</li>
        <li>Agua tibia: con presión suave. No mojarle la cabeza directamente.</li>
        <li>Mantené la calma: ellos perciben tu energía.</li>
      </ul>
    </div>

    <!-- GATOS -->
    <div class="species-box">
      <h3>Para Gatos</h3>
      <ul>
        <li>Desde chiquito: que se familiarice con el agua sin forzarlo.</li>
        <li>Todo listo antes: tené a mano shampoo, agua y toalla.</li>
        <li>Poca agua y ruido: no uses grifo fuerte ni bañera llena.</li>
        <li>Movete con calma: mojá patas primero y luego el cuerpo.</li>
        <li>Pedí ayuda: si se mueve mucho, que otra persona lo sujete.</li>
        <li>Secá con toalla: evitá el secador si le tiene miedo.</li>
      </ul>
    </div>
  </div>
</section>

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