<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "universoanimal");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT m.*, m.usuario_id, u.nombre AS nombre_usuario 
FROM mascotas_perdidas m
LEFT JOIN usuarios u ON m.usuario_id = u.id
ORDER BY m.fecha DESC";

$resultado = $conexion->query($sql);

// 🔹 Usar el rol correcto (de la sesión real)
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Feed | Universo Animal</title>
    <link rel="stylesheet" href="../estilos/diseño.css">
    <link rel="stylesheet" href="/UNIVERSOANIMAL/estilos/diseño.css?v=<?php echo time(); ?>">
</head>
<body>

<header class="Encabezado">
        <div class="logo-container">
            <img src="../img/logo.png">
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

<br><br>

    <h1 class="titu">Subi a tu mascota perdida</h1>

    <?php if (isset($_SESSION['usuario_id'])): ?>
    <div class="boton-publicar-container">
        <a href="publicar.php" class="boton-publicar">+ Nueva publicación</a>
    </div>
<?php else: ?>
    <p class="aviso-login">Iniciá sesión para poder publicar una mascota perdida.</p>
<?php endif; ?>

    <div class="conten">
    <?php while($fila = $resultado->fetch_assoc()): ?>
        <div class="publicacion">
            <strong>Publicado por: <?php echo htmlspecialchars($fila['nombre_usuario']); ?></strong>
            <h2><?php echo htmlspecialchars($fila['nombre']); ?></h2>
            <img src="<?php echo $fila['foto']; ?>" alt="Foto de la mascota">
            <p><?php echo nl2br(htmlspecialchars($fila['descripcion'])); ?></p>
            <small>Publicado el: <?php echo $fila['fecha']; ?></small>

           <div class="comentarios">
                <h4>Comentarios:</h4>
                <?php
                $comentarios_sql = "SELECT c.texto, c.fecha, u.nombre 
                                    FROM comentarios c 
                                    JOIN usuarios u ON c.usuario_id = u.id 
                                    WHERE c.publicacion_id = ? 
                                    ORDER BY c.fecha ASC";
                $comentarios_stmt = $conexion->prepare($comentarios_sql);
                $comentarios_stmt->bind_param("i", $fila['id']);
                $comentarios_stmt->execute();
                $comentarios_resultado = $comentarios_stmt->get_result();
                ?>

                <?php while($coment = $comentarios_resultado->fetch_assoc()): ?>
                    <div class="comentario">
                        <strong><?php echo htmlspecialchars($coment['nombre']); ?>:</strong>
                        <?php echo htmlspecialchars($coment['texto']); ?>
                     <small><?php echo $coment['fecha']; ?></small>
                    </div>
                <?php endwhile; ?>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <form class="form-comentario" action="comentar.php" method="POST">
                        <input type="hidden" name="publicacion_id" value="<?php echo $fila['id']; ?>">
                        <textarea name="texto" rows="2" required></textarea>
                        <br>
                        <button type="submit">Comentar</button>
                    </form>
                <?php else: ?>
                    <small>Inicia sesión para comentar.</small>
                <?php endif; ?>
            </div>

<?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $fila['usuario_id']): ?>
    <div class="menu-opciones">
        <button class="menu-toggle">⋮</button>
        <div class="submenu-acciones">
            <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a>
            <form action="eliminar.php" method="POST" onsubmit="return confirm('¿Eliminar esta publicación?');">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <button type="submit">Eliminar</button>
            </form>
        </div>
    </div>
<?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<br><br><br>

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

    <script>
  document.querySelectorAll('.menu-toggle').forEach(function(button) {
    button.addEventListener('click', function(e) {
      e.stopPropagation(); // evita que se cierre al instante
      const submenu = this.nextElementSibling;
      submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    });
  });

  // Cerrar cualquier submenú si hacés clic fuera
  window.addEventListener('click', function() {
    document.querySelectorAll('.submenu-acciones').forEach(function(menu) {
      menu.style.display = 'none';
    });
  });
</script>

</body>
</html>

<?php $conexion->close(); ?>
