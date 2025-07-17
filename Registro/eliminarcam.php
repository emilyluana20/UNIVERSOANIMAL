<?php
session_start();
include "conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    echo "<h2 style='color: crimson; font-family: sans-serif; text-align: center; margin-top: 50px;'>🚫 Acceso denegado. Solo los administradores pueden eliminar campañas.</h2>";
    exit();
}


$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID de campaña no válido.";
    exit();
}

// Ejecutar eliminación
$stmt = $conn->prepare("DELETE FROM campanias WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: eliminado.php");
    exit();
}
 else {
    echo "Error al eliminar campaña: " . $conn->error;
}
?>
