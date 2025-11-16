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

// Verificar que la publicación pertenece al usuario
$sql = "SELECT * FROM mascotas_perdidas WHERE id = ? AND usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id, $_SESSION['usuario_id']);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows !== 1) {
    die("No tienes permiso para editar esta publicación.");
}

$publicacion = $resultado->fetch_assoc();
$foto_actual = $publicacion['foto'];

// Procesar nueva imagen si se subió
if (isset($_FILES['nueva_foto']) && $_FILES['nueva_foto']['error'] === UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['nueva_foto']['tmp_name'];
    $nombre_archivo = basename($_FILES['nueva_foto']['name']);
    $ruta_destino = "../img/mascotas/" . time() . "_" . $nombre_archivo;

    move_uploaded_file($tmp_name, $ruta_destino);

    // Opcional: borrar la imagen anterior si querés
    // if (file_exists($foto_actual)) {
    //     unlink($foto_actual);
    // }

    $foto_final = $ruta_destino;
} else {
    $foto_final = $foto_actual;
}

// Actualizar la publicación
$sql_update = "UPDATE mascotas_perdidas SET nombre = ?, descripcion = ?, foto = ? WHERE id = ?";
$stmt = $conexion->prepare($sql_update);
$stmt->bind_param("sssi", $nombre, $descripcion, $foto_final, $id);
$stmt->execute();

header("Location: /UNIVERSOANIMAL/redsocial/ver.php");
exit;
?>
