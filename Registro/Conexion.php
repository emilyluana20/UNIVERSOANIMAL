<?php
if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}
$host = "localhost";
$user = "root";
$pass = "";
$db = "universoanimal";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>
