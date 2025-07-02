<?php
session_start();
include "conexion.php";

if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] ?? '') !== 'admin') {
    header("Location: index.php");
    exit();
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $lugar = $_POST["lugar"];
    $horario = $_POST["horario"];

    $stmt = $conn->prepare("INSERT INTO campanias (titulo, descripcion, lugar, horario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $titulo, $descripcion, $lugar, $horario);

    if ($stmt->execute()) {
        $mensaje = "¡Campaña creada correctamente!";
    } else {
        $mensaje = "Error al crear la campaña: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Campaña</title>
    <link rel="stylesheet" href="Estilo/admin.css">
</head>
<body>
    <div class="container">
        <h1>Crear nueva campaña</h1>

        <?php if ($mensaje): ?>
            <div class="message <?= strpos($mensaje, 'Error') === false ? 'success' : 'error' ?>">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" required></textarea>

            <label for="lugar">Lugar</label>
            <input type="text" name="lugar" id="lugar" required>

            <label for="horario">Horario</label>
            <input type="text" name="horario" id="horario" required placeholder="Ej: Lunes a Viernes - 09:00 a 13:30 hs">

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar campaña</button>
                <a href="campañas.php" class="btn btn-edit">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
