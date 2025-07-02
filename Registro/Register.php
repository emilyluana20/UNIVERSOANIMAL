<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


// Verificar si el correo ya existe
$verificar = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$verificar->bind_param("s", $email);
$verificar->execute();
$verificar->store_result();

if ($verificar->num_rows > 0) {
  echo "El correo ya está registrado.";
} else {
  $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $nombre, $email, $telefono, $password);

  if ($stmt->execute()) {
    echo "Registro exitoso. <a href='Registro/Index.html'>Iniciar sesión</a>";
  } else {
    echo "Error al registrar: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
