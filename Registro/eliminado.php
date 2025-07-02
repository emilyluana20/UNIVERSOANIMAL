<?php
session_start();

// Opcional: redireccionar si no hay sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="Estilo/eliminado.css">
    <meta charset="UTF-8">
    <title>Campaña eliminada</title></head>
<body>
    <div class="container">
        <h1>✅ Campaña eliminada</h1>
        <p>La publicación fue eliminada exitosamente del sistema.</p>
        <a href="campañas.php">Volver a campañas</a>
    </div>
</body>
</html>