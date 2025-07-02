<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /UNIVERSOANIMAL/Registro/login.php");
    exit;
}

$conexion = new mysqli("localhost", "root", "", "universoanimal");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$foto = $_FILES['foto'];
$usuario_id = $_SESSION['usuario_id'];

$carpeta = "fotos/";
$nombreFoto = uniqid() . "-" . basename($foto["name"]);
$rutaFoto = $carpeta . $nombreFoto;

if (move_uploaded_file($foto["tmp_name"], $rutaFoto)) {
    $sql = "INSERT INTO mascotas_perdidas (nombre, descripcion, foto, usuario_id) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssi", $nombre, $descripcion, $rutaFoto, $usuario_id);

        if ($stmt->execute()) {
            echo "Publicación exitosa. <a href='/UNIVERSOANIMAL/redsocial/ver.php'>Ver publicaciones</a>";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
} else {
    echo "Error al subir la imagen.";
}

$conexion->close();
?>
