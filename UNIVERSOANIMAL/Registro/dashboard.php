<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: Index.php");
    exit();
}
if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Estilo/Saludo.css">
</head>
<body>
  <div class="panel">
    <div class="saludo cinzel">¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</div>
    <div class="rol cinzel">Tu rol es: <span><?php echo htmlspecialchars($_SESSION['rol']); ?></span></div>

    <?php if ($_SESSION['rol'] === 'admin'): ?>
    <div class="acciones">
      <h3 class="cinzel">Lo que podés hacer como <strong>administrador</strong>:</h3>
      <ul>
        <li>
          <a href="../callamulloproyecto/index.php" class="rokkitt">🐕‍🦺 Crear, modificar y eliminar campañas</a>
        </li>
        <li>
          <a href="../redsocial/ver.php" class="rokkitt"> 🦮Moderar publicaciones de mascotas perdidas</a>
        </li>
        <li>
          <a href="../pagina.php" class="rokkitt">🧑‍💻Acceso completo al panel de administración</a>
        </li>
      </ul>
    </div>
    <?php else: ?>
    <div class="acciones">
      <h3>Lo que podés hacer como <strong>usuario</strong>:</h3>
      <ul>
        <li>
          <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4 9 4 11 6 12 8c1-2 3-4 5.5-4 2.5 0 4.5 2 4.5 4.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
          <a href="../redsocial/ver.php" class="rokkitt">Publicar mascotas perdidas</a>   
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M21 8V7l-3 2-2-1v4h6v-4z"/></svg>
          <a href="../contacto.php" class="rokkitt">Usar el formulario de contacto</a>
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M9 21H7v-2h2v2zm2-4H7v-2h4v2zm4 0h-2v-2h2v2zm4-4h-6v-2h6v2z"/></svg>
          <a href="../callamulloproyecto/index.php">Consultar campañas y noticias</a>
        </li>
      </ul>
    </div>
    <?php endif; ?>

    <a href="../pagina.php" class="boton-inicio cinzel">Ir a página inicial</a>
  </div>
</body>
</html>