<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "universoanimal");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar si la publicación pertenece al usuario
    $stmt = $conexion->prepare("SELECT * FROM mascotas_perdidas WHERE id = ? AND usuario_id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $id, $usuario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            // Eliminar comentarios asociados
            $comentarios_stmt = $conexion->prepare("DELETE FROM comentarios WHERE publicacion_id = ?");
            if ($comentarios_stmt) {
                $comentarios_stmt->bind_param("i", $id);
                $comentarios_stmt->execute();
                $comentarios_stmt->close();
            }

            // Eliminar publicación
            $delete = $conexion->prepare("DELETE FROM mascotas_perdidas WHERE id = ?");
            if ($delete) {
                $delete->bind_param("i", $id);
                $delete->execute();
                $delete->close();
            }
        }

        $stmt->close();
    }
}

$conexion->close();
header("Location: ver.php"); // volver al feed
exit();
