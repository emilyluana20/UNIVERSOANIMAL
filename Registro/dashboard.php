<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: Index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel</title>
  <link rel="stylesheet" href="Estilo/Saludo.css">
</head>
<body>
  <div class="panel">
    <div class="saludo">¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</div>
    <div class="rol">Tu rol es: <span><?php echo htmlspecialchars($_SESSION['rol']); ?></span></div>

    <?php if ($_SESSION['rol'] === 'admin'): ?>
    <div class="acciones">
      <h3>Lo que podés hacer como <strong>administrador</strong>:</h3>
      <ul>
        <li>
          <svg viewBox="0 0 24 24"><path d="M9 19h6v-2H9v2zm-3-4h12v-2H6v2zm-3-4h18v-2H3v2z"/></svg>
          Crear, modificar y eliminar campañas
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M9 19h6v-2H9v2zm-3-4h12v-2H6v2zm-3-4h18v-2H3v2z"/></svg>
          Moderar publicaciones de mascotas perdidas
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2z"/></svg>
          Acceso completo al panel de administración
        </li>
      </ul>
    </div>
    <?php else: ?>
    <div class="acciones">
      <h3>Lo que podés hacer como <strong>usuario</strong>:</h3>
      <ul>
        <li>
          <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6 4 4 6.5 4 9 4 11 6 12 8c1-2 3-4 5.5-4 2.5 0 4.5 2 4.5 4.5 0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
          Publicar mascotas perdidas
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M21 8V7l-3 2-2-1v4h6v-4z"/></svg>
          Usar el formulario de contacto
        </li>
        <li>
          <svg viewBox="0 0 24 24"><path d="M9 21H7v-2h2v2zm2-4H7v-2h4v2zm4 0h-2v-2h2v2zm4-4h-6v-2h6v2z"/></svg>
          Consultar campañas y noticias
        </li>
      </ul>
    </div>
    <?php endif; ?>

    <a href="../pagina.php" class="boton-inicio">Ir a página inicial</a>
  </div>
</body>
</html>