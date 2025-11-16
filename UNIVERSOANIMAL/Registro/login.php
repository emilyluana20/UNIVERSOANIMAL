<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include "Conexion.php";

// Inicializar el contador de intentos si no existe
if (!isset($_SESSION['intentos_login'])) {
    $_SESSION['intentos_login'] = 0;
}

// Bloquear si supera el límite de intentos
if ($_SESSION['intentos_login'] >= 5) {
    header("Location: index.php?msg=demasiados_intentos");
    exit();
}

// Validar que se hayan enviado los datos
if (!isset($_POST['email'], $_POST['password'])) {
    header("Location: index.php?msg=faltan_datos");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

// Buscar el usuario por email
$stmt = $conn->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Si no existe el usuario
if ($stmt->num_rows === 0) {
    $_SESSION['intentos_login']++;
    header("Location: index.php?msg=correo_no_registrado");
    exit();
}

// Extraer datos del usuario
$stmt->bind_result($id, $nombre, $hash, $rol);
$stmt->fetch();

// Verificar contraseña
if (password_verify($password, $hash)) {
    // Inicio de sesión exitoso
    $_SESSION['usuario_id'] = $id;
    $_SESSION['usuario'] = $nombre;
    $_SESSION['rol'] = $rol; // ← Guarda el rol del usuario
    $_SESSION['intentos_login'] = 0;

    header("Location: dashboard.php?msg=login_exitoso");
    exit();
} else {
    $_SESSION['intentos_login']++;
    header("Location: index.php?msg=contrasena_incorrecta");
    exit();
}

$stmt->close();
$conn->close();
?>
