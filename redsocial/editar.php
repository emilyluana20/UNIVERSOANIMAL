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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar | Universo Animal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/UNIVERSOANIMAL/estilos/diseño.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="contenedor-editar">
        <h1 class="titulo-editar">Editar publicación</h1>

        <form action="/UNIVERSOANIMAL/redsocial/guardar_edicion.php" method="POST" enctype="multipart/form-data" class="formulario-editar">
            <input type="hidden" name="id" value="<?php echo $publicacion['id']; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($publicacion['nombre']); ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($publicacion['descripcion']); ?></textarea>

            <label>Imagen actual:</label>
            <div class="imagen-actual">
                <img src="<?php echo $publicacion['foto']; ?>" alt="Foto actual">
            </div>

            <label for="nueva_foto">¿Querés cambiar la imagen?</label>
            <input type="file" id="nueva_foto" name="nueva_foto" accept="image/*">

            <button type="submit" class="boton-guardar">Guardar cambios</button>
        </form>
    </div>

</body>
</html>
