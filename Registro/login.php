<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "conexion.php";

if (!isset($_POST['email'], $_POST['password'])) {
    header("Location: index.html?msg=faltan_datos");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

// Preparar y ejecutar consulta
$stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    header("Location: index.html?msg=correo_no_registrado");
    exit();
}

$stmt->bind_result($id, $nombre, $hash);
$stmt->fetch();

if (password_verify($password, $hash)) {
    $_SESSION['usuario_id'] = $id;
    $_SESSION['usuario'] = $nombre;
    header("Location: inicio.php?msg=login_exitoso");
    exit();
} else {
    header("Location: index.html?msg=contrasena_incorrecta");
    exit();
}

$stmt->close();
$conn->close();
?>
