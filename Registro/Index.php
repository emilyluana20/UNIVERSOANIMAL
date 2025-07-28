<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Universo Animal | Login y Registro</title>
  <link rel="stylesheet" href="Estilo/style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

</head>
<?php
if (isset($_GET['msg'])) {
    $mensajes = [
        'faltan_datos' => 'Faltan datos.',
        'correo_no_registrado' => 'Correo no registrado.',
        'contrasena_incorrecta' => 'Contraseña incorrecta.',
        'demasiados_intentos' => 'Demasiados intentos fallidos. Esperá e intentá más tarde.',
        'login_exitoso' => 'Inicio de sesión exitoso.'
    ];
    $codigo = $_GET['msg'];
    if (isset($mensajes[$codigo])) {
        // Mostramos el mensaje con JS para que tenga animación y estilo
        echo "<script>window.onload = function() {
            mostrarMensaje('".$mensajes[$codigo]."', '".($codigo==='login_exitoso' ? "exito" : "error")."');
        }</script>";
    }
}
?>
<body>

  <div class="form-container">

    <!-- Formulario de Login -->
    <form id="loginForm" action="login.php" method="POST" class="formulario">
      <h2>Iniciar Sesión</h2>
      <label for="email_login">Correo electrónico</label>
      <input type="email" id="email_login" name="email" required>

      <label for="password_login">Contraseña</label>
      <input type="password" id="password_login" name="password" required>

      <button type="submit">Entrar</button>
      <button type="button" onclick="mostrarRegistro()">¿No tenés una cuenta? Registrate</button>
    </form>

    <!-- Formulario de Registro -->
    <form id="registerForm" action="Register.php" method="POST" class="formulario hidden">
      <h2>Registro</h2>
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="email">Correo electrónico</label>
      <input type="email" id="email" name="email" required>

      <label for="telefono">Teléfono</label>
      <input type="tel" id="telefono" name="telefono" required>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Registrarse</button>
      <button type="button" onclick="mostrarLogin()">¿Ya tenés cuenta? Iniciar Sesión</button>
    </form>

  </div>

  <div id="mensaje" class="mensaje"></div>
  <script src="js/js.js"></script>

</body>
</html>
