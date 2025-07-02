<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "universoanimal");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /UNIVERSOANIMAL/Registro/Index.php");
    exit;
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "UPDATE mascotas_perdidas SET nombre = ?, descripcion = ? WHERE id = ? AND usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssii", $nombre, $descripcion, $id, $usuario_id);

if ($stmt->execute()) {
    echo "¡Publicación actualizada! <a href='/UNIVERSOANIMAL/redsocial/ver.php'>Volver a publicaciones</a>";
} else {
    echo "Error al actualizar: " . $stmt->error;
}
?>
