<?php
session_start();
include "Registro/Conexion.php";
include "eliminarperso.php";
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
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRUD</title>
  <link rel="stylesheet" href="estilos/tabla.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/285c2964f3.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <div class="logo">Universo Animal</div>
    <button class="hamburger" aria-label="Abrir menú">&#9776;</button>

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

  </header>

  <h1 class="text-center p-3">Administración de usuarios</h1>

  <!-- Función de confirmación para eliminar -->
  <script>
    function eliminar() {
      var respuesta = confirm("¿Estás seguro que deseas eliminar este usuario?");
      return respuesta;
    }
  </script>

  <div class="col-lg-10 p-4 m-auto">
    <div class="table-responsive">
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Teléfono</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = $conn->query("SELECT * FROM usuarios");
          while ($datos = $sql->fetch_object()) {
          ?>
            <tr>
              <td><?= $datos->id ?></td>
              <td><?= $datos->nombre ?></td>
              <td><?= $datos->email ?></td>
              <td><?= $datos->password ?></td>
              <td><?= $datos->telefono ?></td>
              <td>
                <a onclick="return eliminar()" href="tabla.php?id=<?= $datos->id ?>" class="btn btn-small btn-danger">
                  <i class="fa-solid fa-user-slash"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <!-- Mensaje de eliminación con limpieza de URL -->
      <?php if (!empty($_GET["mensaje"]) && $_GET["mensaje"] === "ok"): ?>
        <div class="alert alert-success mt-3">Persona eliminada correctamente</div>

        <script>
          // Limpiar el parámetro 'mensaje' de la URL sin recargar
          const url = new URL(window.location.href);
          url.searchParams.delete('mensaje');
          window.history.replaceState({}, document.title, url.pathname + url.search);
        </script>
      <?php endif; ?>

    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"
  ></script>
</body>
</html>