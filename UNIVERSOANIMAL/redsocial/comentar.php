
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /UNIVERSOANIMAL/Registro/login.php");
    exit;
}

$conexion = new mysqli("localhost", "root", "", "universoanimal");

$publicacion_id = $_POST['publicacion_id'];
$usuario_id = $_SESSION['usuario_id'];
$texto = trim($_POST['texto']);

if ($texto !== "") {
    $sql = "INSERT INTO comentarios (publicacion_id, usuario_id, texto) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iis", $publicacion_id, $usuario_id, $texto);
    $stmt->execute();
}

header("Location: ver.php");
exit;
