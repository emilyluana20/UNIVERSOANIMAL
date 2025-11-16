<?php
session_start();

// Si no existe el rol, definimos un valor por defecto
if (!isset($_SESSION['usuario_rol'])) {
    $_SESSION['usuario_rol'] = 'usuario'; // por ejemplo
}

// Definimos si el usuario actual es administrador
$isAdmin = ($_SESSION['usuario_rol'] === 'admin');


if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}
// 🔹 Usar el rol correcto (de la sesión real)
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/contacto.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Contacto | Universo Animal</title>
</head>
<header>

           <nav class="navbar">
  <div class="nav-container">
    <a href="/UNIVERSOANIMAL/pagina.php"><img src="img/logo.png" alt="Logo Universo Animal"></a>
    <button class="menu-toggle" id="menuToggle">
      ☰
    </button>

    <ul class="nav-links" id="navMenu">
      <li class="dropdown">
        <a href="#">Cuidados</a>
        <ul class="submenu">
          <li><a href="desparacitacion.php">Desparasitación</a></li>
          <li><a href="pulgagarra.php">Pulgas y garrapatas</a></li>
          <li><a href="baños.php">Baños</a></li>
          <li><a href="Edades.php">Edades</a></li>
        </ul>
      </li>

      <li><a href="callamulloproyecto/index.php">Campañas</a></li>

      <?php if ($isAdmin): ?>
      <li class="dropdown">
        <a href="#">Admin</a>
        <ul class="submenu">
          <li><a href="Registro/crear_campañias.php">+ Crear campaña</a></li>
          <li><a href="tabla.php">- Eliminar Usuario</a></li>
        </ul>
      </li>
      <?php endif; ?>

      <li><a href="redsocial/ver.php">Perdidos</a></li>
      <li><a href="contacto.php">Contacto</a></li>
      <li><a href="Registro/logout.php" class="logout">Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>

</header>
<body>
    <div class="container">
        <h1>🐾 Contáctanos 🐾</h1>
        
        <form action="#" method="post">
            <!-- Información personal -->
            <div class="form-group">
                <label for="nombre" class="required">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej: Juan Pérez">
            </div>
            
            <div class="form-group">
                <label for="email" class="required">Correo electrónico</label>
                <input type="email" id="email" name="email" required placeholder="Ej: ejemplo@dominio.com">
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej: +54 9 11 8985-3289">
            </div>
            
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" min="1" max="120" placeholder="Ej: 30">
            </div>
        
            
            <!-- Experiencia con animales -->
            <div class="form-group">
                <label>¿Tienes experiencia previa con animales?</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="experiencia-si" name="experiencia" value="si">
                        <label for="experiencia-si">Sí, tengo experiencia</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="experiencia-no" name="experiencia" value="no">
                        <label for="experiencia-no">No, pero me gustaría aprender</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="experiencia-algo" name="experiencia" value="algo">
                        <label for="experiencia-algo">Algo de experiencia</label>
                    </div>
                </div>
            </div>

            <!-- Mensaje -->
            <div class="form-group">
                <label for="mensaje" class="required">Mensaje</label>
                <textarea id="mensaje" name="mensaje" required placeholder="Por favor, describe tu consulta con más detalle..."></textarea>
            </div>
            
            <!-- Preferencias de contacto -->
            <div class="form-group">
                <label>Preferencias de contacto</label>
                <div class="checkbox-group">
                    <div class="checkbox-option">
                        <input type="checkbox" id="contacto-email" name="contacto[]" value="email" checked>
                        <label for="contacto-email">Correo electrónico</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="contacto-telefono" name="contacto[]" value="telefono">
                        <label for="contacto-telefono">Llamada telefónica</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="contacto-whatsapp" name="contacto[]" value="whatsapp">
                        <label for="contacto-whatsapp">WhatsApp</label>
                    </div>
                </div>
            </div>
            
            <button type="submit">Enviar formulario 🐶</button>
        </form>
        
        <div class="form-footer">
            <p>🌍 Todos los campos marcados con <span class="required">*</span> son obligatorios</p>
            <p>🐱‍👤 Protegemos tus datos según nuestra <a href="#">Política de Privacidad</a></p>
        </div>
    </div>
</body>
</html>