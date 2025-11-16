<?php
session_start();

// 🔒 Verificar sesión activa
if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}

// 🔧 Rol por defecto
if (!isset($_SESSION['usuario_rol'])) {
    $_SESSION['usuario_rol'] = 'usuario';
}
$rol = $_SESSION['usuario_rol'];
$isAdmin = ($rol === 'admin');

// 🗄️ Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "universoanimal");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// 🧾 Traer campañas desde la base
$sql = "SELECT * FROM campanias ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);
if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}
$campanias = $resultado->fetch_all(MYSQLI_ASSOC);
$conn->close();

$editadaId = $_GET['editada'] ?? null;
// 🔹 Usar el rol correcto (de la sesión real)
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Campañas | Universo Animal</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
  <div class="logoo">
    <a href="/UNIVERSOANIMAL/pagina.php">
      <img src="../img/logo.png" alt="Logo Universo Animal">
    </a>
  </div>

  <nav>
    <div class="nav-container">
      <button class="menu-toggle" id="menuToggle">☰</button>

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
</header>

<!-- ✅ Mensajes -->
<?php if ($editadaId): ?>
  <div id="mensaje-exito" style="background-color:#d4edda; color:#155724; padding: 1rem; border-radius: 8px; max-width: 480px; margin: 1rem auto; text-align: center; font-weight: bold;">
      ✅ Campaña actualizada correctamente.
  </div>
<?php endif; ?>

<?php if (isset($_GET['eliminada']) && $_GET['eliminada'] === 'ok'): ?>
  <div style="background: #d4edda; color: #155724; padding: 1rem; margin: 1rem auto; border-radius: 8px; max-width: 480px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
      ✅ La campaña fue eliminada correctamente.
  </div>
<?php endif; ?>

<!-- 🔍 SECCIÓN DE BÚSQUEDA -->
<section class="search-section">
  <h2>Buscar Lugares, Fechas y Horarios</h2>
  <input type="text" id="searchInput" placeholder="Escribí para buscar...">

  <ul id="resultsList" class="list">
    <?php foreach ($campanias as $campania): 
        $claseResaltado = ($campania['id'] == $editadaId) ? 'resaltado' : '';
    ?>
      <li class="list-item <?= $claseResaltado ?>"
          data-lugar="<?= strtolower($campania['lugar']) ?>"
          data-fecha="<?= $campania['fecha_creacion'] ?>"
          data-horario="<?= $campania['horario'] ?>">

        <div class="place"><?= htmlspecialchars($campania['lugar']) ?></div>
        <div class="datetime"><?= htmlspecialchars($campania['horario']) ?> · <?= date("d/m/Y", strtotime($campania['fecha_creacion'])) ?></div>
        <div class="descripcion"><?= htmlspecialchars($campania['descripcion']) ?></div>

        <?php if ($isAdmin): ?>
          <a href="../Registro/editarcam.php?id=<?= $campania['id'] ?>" class="btn-principal">Editar</a>
          <a href="../Registro/eliminarcam.php?id=<?php echo $campania['id']; ?>" 
   class="btn-secundario" 
   onclick="return confirm('¿Estás segur@ que querés eliminar esta campaña?')">
   Eliminar
</a>

        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</section>

<!-- === JS FUNCIONAL === -->
<script>
  // Menú responsive
  document.getElementById('menuToggle').addEventListener('click', function() {
    document.getElementById('navMenu').classList.toggle('open');
  });

  // Búsqueda en tiempo real
  const searchInput = document.getElementById('searchInput');
  const listItems = document.querySelectorAll('.list-item');

  searchInput.addEventListener('input', function () {
    const query = this.value.toLowerCase();
    listItems.forEach(item => {
      const lugar = item.dataset.lugar;
      const fecha = item.dataset.fecha;
      const horario = item.dataset.horario;
      const coincide = lugar.includes(query) || fecha.includes(query) || horario.includes(query);
      item.style.display = coincide ? 'block' : 'none';
    });
  });

  // Desaparecer mensaje de éxito después de 5 segundos
  window.addEventListener('DOMContentLoaded', () => {
    const mensaje = document.getElementById('mensaje-exito');
    if (mensaje) {
      setTimeout(() => {
        mensaje.style.transition = 'opacity 0.5s ease';
        mensaje.style.opacity = '0';
        setTimeout(() => mensaje.remove(), 500);
      }, 5000);
    }
  });
</script>

</body>
</html>
