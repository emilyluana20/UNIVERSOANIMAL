<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Definir el rol automáticamente según el email
$rol = 'usuario'; // por defecto

// Email especial para admin (podés cambiarlo a uno que no exista realmente)
$email_admin = 'admin@universoanimal.local';

if ($email === $email_admin) {
    $rol = 'admin';
}

// Verificar si el correo ya existe
$verificar = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$verificar->bind_param("s", $email);
$verificar->execute();
$verificar->store_result();

if ($verificar->num_rows > 0) {
  echo "El correo ya está registrado.";
} else {
  $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, password, rol) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $nombre, $email, $telefono, $password, $rol);

  if ($stmt->execute()) {
    echo "Registro exitoso. <a href='index.php'>Iniciar sesión</a>";
  } else {
    echo "Error al registrar: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
