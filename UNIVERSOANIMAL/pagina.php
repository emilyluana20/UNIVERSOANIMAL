<?php
session_start();
$rol = $_SESSION['rol'] ?? null;
$isAdmin = $rol === 'admin';
$isUsuario = $rol === 'usuario';
$bodyClass = $isAdmin ? 'admin' : '';
?>
<?php include "Registro/Conexion.php";?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Universo Animal</title>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="Registro/Estilo/Diseño.css">
  <link rel="stylesheet" href="estilos/diseño.css">
  <link rel="stylesheet" href="estilos/menu.css">
</head>
<body class="<?php echo $bodyClass; ?>">

<!-- MENÚ NUEVO -->
<nav class="navbar">
  <div class="nav-container">
    <a href="/UNIVERSOANIMAL/pagina.php" class="logo">
      <img src="img/logo.png" alt="Logo">
    </a>

    <button class="menu-toggle" id="menuToggle">☰</button>

    <ul class="nav-links" id="navMenu">
      <li class="dropdown">
        <a href="#" class="cinzel">Cuidados</a>
        <ul class="submenu">
          <li><a href="desparacitacion.php" class="cinzel">Desparasitación</a></li>
          <li><a href="pulgagarra.php" class="cinzel">Pulgas y garrapatas</a></li>
          <li><a href="baños.php" class="cinzel">Baños</a></li>
          <li><a href="Edades.php" class="cinzel">Edades</a></li>
        </ul>
      </li>
      <li><a href="callamulloproyecto/index.php" class="cinzel">Campañas</a></li>
      <li><a href="mapa.php" class="cinzel">Mapa</a></li>

      <?php if ($isAdmin): ?>
      <li class="dropdown">
        <a href="#" class="cinzel">Admin</a>
        <ul class="submenu">
          <li><a href="Registro/crear_campañias.php" class="cinzel">+ Crear campaña</a></li>
          <li><a href="tabla.php" class="cinzel">- Eliminar Usuario</a></li>
        </ul>
      </li>
      <?php endif; ?>

      <li><a href="redsocial/ver.php" class="cinzel">Perdidos</a></li>
      <li><a href="contacto.php" class="cinzel">Contacto</a></li>
      <li><a href="Registro/logout.php" class="logout cinzel">Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>

<main class="contenido-principal">

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="rokkitt">Bienvenida a Universo Animal</h1>
      <p class="rokkitt">Un espacio pensado para el cuidado, la protección y el bienestar de tus mascotas.</p>
    </div>
  </section>

  <!-- SECCIÓN CUIDADOS -->
  <section id="cuidados" class="seccion">
    <h2 class="cinzel">Guías de cuidado y bienestar</h2>
    <p class="rokkitt">Información clara y confiable para que tu mascota esté sana, feliz y segura.</p>
    <div class="cards-grid">
      <div class="card">
        <img class="img" src="Registro/imagenes/Edad.jpg" alt="Vacunación">
        <a href="Edades.php"><h3 class="cinzel">Edades</h3></a>
        <p class="rokkitt">Conocé el calendario de vacunas obligatorio y preventivo para cada etapa.</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Desparacitación.jpg" alt="Desparasitación">
        <a href="desparacitacion.php"><h3 class="cinzel">Desparacitación</h3></a>
        <p class="rokkitt">Protegé a tu mascota de parásitos internos y externos con los tratamientos adecuados.</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/baños.webp" alt="Higiene">
        <a href="baños.php"><h3 class="cinzel">Higiene</h3></a>
        <p class="rokkitt">Tips para mantener a tu mascota limpia, sana y cómoda en casa.</p>
      </div>
    </div>
  </section>

  <!-- SECCIÓN CAMPAÑAS -->
  <section id="campanias" class="seccion">
    <h2 class="cinzel">Campañas de atención veterinaria</h2>
    <p class="rokkitt">Enterate de las campañas de vacunación, castración y control sanitario en tu zona.</p>
    <div class="cards-grid">
      <?php
      $consulta = "SELECT titulo, descripcion, lugar, horario, fecha_creacion FROM campanias ORDER BY fecha_creacion DESC";
      $resultado = $conn->query($consulta);

      if ($resultado && $resultado->num_rows > 0):
          while ($fila = $resultado->fetch_assoc()):
      ?>
        <div class="card">
          <h3><?= htmlspecialchars($fila['lugar']) ?></h3>
          <p><strong><?= htmlspecialchars($fila['titulo']) ?></strong></p>
          <p><?= htmlspecialchars($fila['horario']) ?></p>
          <p><?= nl2br(htmlspecialchars($fila['descripcion'])) ?></p>
          <small style="color:#666">Publicado el <?= date('d/m/Y', strtotime($fila['fecha_creacion'])) ?></small>
        </div>
      <?php
          endwhile;
      else:
          echo "<p>No hay campañas publicadas aún.</p>";
      endif;
      ?>
    </div>
  </section>

  <!-- SECCIÓN PERDIDOS -->
  <section id="perdidos" class="seccion">
    <h2 class="cinzel">Ayudanos a reunir familias</h2>
    <p class="rokkitt">Publicá o buscá mascotas perdidas en tu ciudad. Junt@s podemos hacer la diferencia.</p>
    <?php if ($isUsuario || $isAdmin): ?>
      <a href="redsocial/ver.php" class="btn-secundario rokkitt">Publicar perrito perdido</a>
    <?php endif; ?>
  </section>

  <!-- SECCIÓN REENCUENTROS -->
  <section id="reencuentros" class="seccion">
    <h2 class="cinzel">Historias con final feliz</h2>
    <p class="rokkitt">Gracias a tu ayuda, muchas mascotas volvieron a casa. Estas son algunas de esas historias.</p>
    <div class="galeria-reencuentros">
      <div class="card">
        <img src="Registro/imagenes/Reencuentro1.jpeg" alt="Reencuentro 1">
        <p class="rokkitt">¡Volvió a casa después de 2 semanas!</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Reencuentro2.jpeg" alt="Reencuentro 2">
        <p class="rokkitt">Reencuentro con su familia humana 💜</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Reencuentro3.jpeg" alt="Reencuentro 3">
        <p class="rokkitt">Gracias a la difusión, fue encontrado</p>
      </div>
    </div>
  </section>

  <!-- SECCIÓN CONTACTO -->
  <section id="contacto" class="seccion">
    <h2 class="cinzel">¿Querés colaborar o tenés dudas?</h2>
    <p class="rokkitt">Contactanos para ser parte de nuestra comunidad, adoptar o consultar información veterinaria.</p>
    <a href="contacto.php" class="btn-secundario rokkitt">Escribinos</a>
  </section>

</main>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <p>&copy; 2025 Universo Animal. Todos los derechos reservados.</p>
    <p>Desarrollado con 🐾 por Universo Animal</p>
  </div>
</footer>

<!-- SCRIPT MENÚ -->
<script>
  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');

  menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('open');
  });
</script>

</body>
</html>
