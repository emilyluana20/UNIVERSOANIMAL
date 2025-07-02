
<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "universoanimal");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /UNIVERSOANIMAL/Registro/Index.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM mascotas_perdidas WHERE id = ? AND usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id, $_SESSION['usuario_id']);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $publicacion = $resultado->fetch_assoc();
} else {
    die("No tienes permiso para editar esta publicación.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/UNIVERSOANIMAL/estilos/otros.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar | Universo Animal</title>
</head>
<body>
    <form action="/UNIVERSOANIMAL/redsocial/guardar_edicion.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $publicacion['id']; ?>">
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($publicacion['nombre']); ?>" required><br><br>
    <textarea name="descripcion" required><?php echo htmlspecialchars($publicacion['descripcion']); ?></textarea><br><br>
    <button type="submit">Guardar cambios</button>
</form>
</body>
</html>
