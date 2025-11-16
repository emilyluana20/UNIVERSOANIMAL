<?php
session_start();
include "conexion.php";

// Solo admin puede acceder
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID de campaña no válido.";
    exit();
}

// Obtener datos actuales
$stmt = $conn->prepare("SELECT * FROM campanias WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$campania = $resultado->fetch_assoc();

if (!$campania) {
    echo "Campaña no encontrada.";
    exit();
}

// Guardar cambios si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $lugar = $_POST['lugar'];
    $horario = $_POST['horario'];

    // Preparar statement correctamente
    $update = $conn->prepare("UPDATE campanias SET titulo = ?, descripcion = ?, lugar = ?, horario = ? WHERE id = ?");
    if (!$update) {
        die("Error en la preparación del statement: " . $conn->error);
    }

    // Vincular parámetros (s = string, i = integer)
    $update->bind_param("ssssi", $titulo, $descripcion, $lugar, $horario, $id);

    if ($update->execute()) {
        header("Location: ../callamulloproyecto/index.php?editada=" . $id);
        exit();
    } else {
        echo "Error al actualizar: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Campaña</title>
    <link rel="stylesheet" href="Estilo/admin.css">
</head>
<body>
    <h2>Editar campaña</h2>
    <form method="POST">
        <label>Título</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($campania['titulo']) ?>" required><br><br>

        <label>Descripción</label><br>
        <textarea name="descripcion" required><?= htmlspecialchars($campania['descripcion']) ?></textarea><br><br>

        <label>Lugar</label><br>
        <input type="text" name="lugar" value="<?= htmlspecialchars($campania['lugar']) ?>" required><br><br>

        <label>Horario</label><br>
        <input type="text" name="horario" value="<?= htmlspecialchars($campania['horario']) ?>" required><br><br>

        <button type="submit">Guardar Cambios</button>
        <a href="../callamulloproyecto/index.php">Cancelar</a>
    </form>
</body>
</html>
