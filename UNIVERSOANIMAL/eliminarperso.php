<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}

if (!empty($_GET["id"])) {
    include 'conexion.php'; // asegúrate de tener conexión
    $id = intval($_GET["id"]); // por seguridad
    $sql = $conn->query("DELETE FROM usuarios WHERE id = $id");

    if ($conn->affected_rows > 0) {
        header("Location: tabla.php?mensaje=ok");
        exit();
    }
}
?>
