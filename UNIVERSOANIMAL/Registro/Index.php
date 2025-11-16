<?php
session_start();
// No redirigimos acá, porque este es el login mismo.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Universo Animal | Login y Registro</title>
  <link rel="stylesheet" href="Estilo/style.css"/>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<?php
if (isset($_GET['msg'])) {
    $mensajes = [
        'faltan_datos' => 'Faltan datos.',
        'correo_no_registrado' => 'Correo no registrado.',
        'contrasena_incorrecta' => 'Contraseña incorrecta.',
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
      <h2 class="cinzel">Iniciar Sesión</h2>
      <label for="email_login" class="rokkitt">Correo electrónico</label>
      <input type="email" id="email_login" name="email" required>

      <label for="password_login" class="rokkitt">Contraseña</label>
      <input type="password" id="password_login" name="password" required>

      <button type="submit" class="rokkitt">Entrar</button>
      <button type="button" onclick="mostrarRegistro()" class="rokkitt">¿No tenés una cuenta? Registrate</button>
    </form>

    <!-- Formulario de Registro -->
    <form id="registerForm" action="Register.php" method="POST" class="formulario hidden">
      <h2 class="cinzel">Registro</h2>
      <label for="nombre" class="rokkitt">Nombre</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="email" class="rokkitt">Correo electrónico</label>
      <input type="email" id="email" name="email" required>

      <label for="telefono" class="rokitt">Teléfono</label>
      <input type="tel" id="telefono" name="telefono" required>

      <label for="password" class="rokkitt">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <button type="submit" class="rokkitt">Registrarse</button>
      <button type="button" onclick="mostrarLogin()" class="rokkitt">¿Ya tenés cuenta? Iniciar Sesión</button>
    </form>

  </div>

  <div id="mensaje" class="mensaje"></div>
  <script src="js/js.js"></script>

</body>
</html>
