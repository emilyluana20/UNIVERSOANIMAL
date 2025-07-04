<?php
session_start();
$isAdmin = $_SESSION['rol'] === 'admin';
$bodyClass = $isAdmin ? 'admin' : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Universo Animal</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="Registro/Estilo/Diseño.css">
</head>

<body class="<?php echo $bodyClass; ?>">
<header>
  <div class="logo">Universo Animal</div>
  <nav>
    <a href="datos.php">Cuidados</a>
    <a href="campañas.php">Campañas</a>
    <?php if ($_SESSION['rol'] === 'admin'): ?>
      <a href="Registro/crear_campañias.php">+ Crear campaña</a>
      <a href="tabla.php">- Eliminar Usuario</a>
    <?php endif; ?>
    <a href="redsocial/ver.php">Perdidos</a>
    <a href="#reencuentros">Reencuentros</a>
    <a href="contacto.php">Contacto</a>
    <a href="Registro/logout.php">Cerrar Sesión</a>
  </nav>
</header>
<main class="contenido-principal">
  <section class="hero">
    <div class="hero-content">
      <h1>Bienvenid@ a Universo Animal</h1>
      <p>Un espacio pensado para el cuidado, la protección y el bienestar de tus mascotas.</p>
      <a href="#cuidados" class="btn-principal">Conocé más</a>
    </div>
  </section>

  <section id="cuidados" class="seccion">
    <h2>Guías de cuidado y bienestar</h2>
    <p>Información clara y confiable para que tu mascota esté sana, feliz y segura.</p>
    <div class="cards-grid">
      <div class="card">
        <img src="Registro/imagenes/Vacunación1.jpg" alt="Vacunación">
        <h3>Vacunación</h3>
        <p>Conocé el calendario de vacunas obligatorio y preventivo para cada etapa.</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/Desparacitación.jpg" alt="Desparasitación">
        <h3>Desparasitación</h3>
        <p>Protegé a tu mascota de parásitos internos y externos con los tratamientos adecuados.</p>
      </div>
      <div class="card">
        <img src="Registro/imagenes/baños.webp" alt="Higiene">
        <h3>Higiene</h3>
        <p>Tips para mantener a tu mascota limpia, sana y cómoda en casa.</p>
      </div>
    </div>
  </section>

  <section id="campanias" class="seccion">
    <h2>Campañas de atención veterinaria</h2>
    <p>Enterate de las campañas de vacunación, castración y control sanitario en tu zona.</p>
    <div class="cards-grid">
      <div class="card">
        <h3>Monte Grande</h3>
        <p>Vacunación pública gratuita</p>
        <p>Lunes a Viernes - 09:00 a 13:30 hs</p>
      </div>
      <div class="card">
        <h3>Barrio Ledesma</h3>
        <p>Castraciones privadas con turno</p>
        <p>Lunes a Jueves - 08:00 a 12:30 hs</p>
      </div>
    </div>
  </section>

  <section id="perdidos" class="seccion">
    <h2>Ayudanos a reunir familias</h2>
    <p>Publicá o buscá mascotas perdidas en tu ciudad. Junt@s podemos hacer la diferencia.</p>
    <?php if ($_SESSION['rol'] === 'usuario'): ?>
      <a href="publicar_perdido.php" class="btn-secundario">Publicar perrito perdido</a>
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
document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.querySelector('.sidebar');

  toggleBtn?.addEventListener('click', () => {
    document.body.classList.toggle('sidebar-visible');
  });

  document.addEventListener('click', (e) => {
    if (
      document.body.classList.contains('sidebar-visible') &&
      !sidebar.contains(e.target) &&
      e.target !== toggleBtn
    ) {
      document.body.classList.remove('sidebar-visible');
    }
  });
});
</script>
</body>
</html>
