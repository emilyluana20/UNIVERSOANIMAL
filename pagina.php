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
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="Registro/Estilo/Diseño.css">
  <link rel="stylesheet" href="estilos/diseño.css">
</head>
<body class="<?php echo $bodyClass; ?>">
<header class="main-header">
  <div class="header-container">
    <div class="logo">
      <div class="logo-container">
            <a href="/UNIVERSOANIMAL/pagina.php"><img src="img/logo.png"></a>
      </div>
      <i class='bx bx-paw'></i> Universo Animal
    </div>
    <div class="hamburger" onclick="toggleMenu()">
      <i class='bx bx-menu'></i>
    </div>
    <nav id="navMenu" class="nav-links">
      <div class="dropdown">
        <a href="#">Cuidados</a>
        <div class="submenu">
          <a href="desparacitacion.php">Desparacitación</a>
          <a href="pulgagarra.php">Pulgas y garrapatas</a>
          <a href="baños.php">Baños</a>
          <a href="Edades.php">Edades</a>
        </div>
      </div>
      <a href="callamulloproyecto/index.php">Campañas</a>
      
      <?php if ($isAdmin): ?>
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" onclick="toggleDropdown(event)">Admin <i class='bx bx-chevron-down'></i></a>
          <div class="dropdown-menu">
            <a href="Registro/crear_campañias.php">+ Crear campaña</a>
            <a href="tabla.php">- Eliminar Usuario</a>
          </div>
        </div>
      <?php endif; ?>
      
      <a href="redsocial/ver.php">Perdidos</a>
      <a href="contacto.php">Contacto</a>
      <a href="Registro/logout.php">Cerrar Sesión</a>
    </nav>
  </div>
</header>

<main class="contenido-principal">
  <section class="hero">
    <div class="hero-content">
      <h1>Bienvenida a Universo Animal</h1>
      <p>Un espacio pensado para el cuidado, la protección y el bienestar de tus mascotas.</p>
    </div>
  </section>

  <section id="cuidados" class="seccion">
    <h2>Guías de cuidado y bienestar</h2>
    <p>Información clara y confiable para que tu mascota esté sana, feliz y segura.</p>
    <div class="cards-grid">
      <div class="card">
        <img class="img" src="Registro/imagenes/Edad.jpg" alt="Vacunación">
        <a href="Edades.php"><h3>Edades</h3></a>
        <p>Conocé el calendario de vacunas obligatorio y preventivo para cada etapa.</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Desparacitación.jpg" alt="Desparasitación">
        <a href="desparacitacion.php"><h3>Desparacitación</h3></a>
        <p>Protegé a tu mascota de parásitos internos y externos con los tratamientos adecuados.</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/baños.webp" alt="Higiene">
        <a href="baños.php"><h3>Higiene</h3></a>
        <p>Tips para mantener a tu mascota limpia, sana y cómoda en casa.</p>
      </div>
    </div>
  </section>

  <section id="campanias" class="seccion">
    <h2>Campañas de atención veterinaria</h2>
    <p>Enterate de las campañas de vacunación, castración y control sanitario en tu zona.</p>
    <div class="cards-grid">
  <?php
  $consulta = "SELECT titulo, descripcion, lugar, direccion, horario, fecha_creacion FROM campanias ORDER BY fecha_creacion DESC";
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

  <section id="perdidos" class="seccion">
    <h2>Ayudanos a reunir familias</h2>
    <p>Publicá o buscá mascotas perdidas en tu ciudad. Junt@s podemos hacer la diferencia.</p>
    <?php if ($isUsuario || $isAdmin): ?>
    <a href="redsocial/ver.php" class="btn-secundario">Publicar perrito perdido</a>
    <?php endif; ?>
  </section>

  <section id="reencuentros" class="seccion">
    <h2>Historias con final feliz</h2>
    <p>Gracias a tu ayuda, muchas mascotas volvieron a casa. Estas son algunas de esas historias.</p>
    <div class="galeria-reencuentros">
      <div class="card">
        <img src="Registro/imagenes/Reencuentro1.jpeg" alt="Reencuentro 1">
        <p>¡Volvió a casa después de 2 semanas!</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Reencuentro2.jpeg" alt="Reencuentro 2">
        <p>Reencuentro con su familia humana 💜</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Reencuentro3.jpeg" alt="Reencuentro 3">
        <p>Gracias a la difusión, fue encontrado</p>
      </div>
    </div>
  </section>

  <section id="contacto" class="seccion">
    <h2>¿Querés colaborar o tenés dudas?</h2>
    <p>Contactanos para ser parte de nuestra comunidad, donar, adoptar o consultar información veterinaria.</p>
    <a href="contacto.php" class="btn-principal">Escribinos</a>
  </section>

  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 Universo Animal. Todos los derechos reservados.</p>
      <p>Desarrollado con 🐾 por Universo Animal</p>
    </div>
  </footer>
</main>

<script>
function toggleMenu() {
  const nav = document.getElementById("navMenu");
  nav.classList.toggle("active");
}

function toggleDropdown(event) {
  event.preventDefault();
  const dropdownMenu = event.target.closest(".dropdown").querySelector(".dropdown-menu");
  dropdownMenu.style.display = dropdownMenu.style.display === "flex" ? "none" : "flex";
}
</script>

</body>
</html>
