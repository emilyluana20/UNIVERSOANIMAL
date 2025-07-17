<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloS/contacto.css?v=<?php echo time(); ?>">
    <title>Contacto | Universo Animal</title>
</head>

<header>
   <nav class="navbar">
    <div class="nav-container">
        <div class="logo-container">
            <span class="logo">
                <img src="img/logo.png" alt="Logo" class="logo-img"> Universo Animal
            </span>
        </div>
        <div class="nav-links">
            <a href="pagina.php" class="nav-link">
                <span class="link-icon"></span>Inicio</a>
            <a href="baños.php" class="nav-link">
                <span class="link-icon"></span>Cuidados</a>
            <a href="callamulloproyecto/index.php" class="nav-link">
                <span class="link-icon"></span>Campañas</a>
            <a href="redsocial/ver.php" class="nav-link">
                <span class="link-icon"></span>Perdidos</a>
            <a href="Registro/logout.php" class="nav-link">
                <span class="link-icon"></span>Cerrar sesión</a>
        </div>
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
            
            <!-- Tipo de consulta -->
            <div class="form-group">
                <label for="consulta" class="required">Tipo de consulta</label>
                <select id="consulta" name="consulta" required>
                    <option value="" selected disabled>-- Seleccione una opción --</option>
                    <option value="adopcion">Adopción de animales</option>
                    <option value="donacion">Donación o apadrinamiento</option>
                    <option value="voluntariado">Voluntariado</option>
                    <option value="eventos">Eventos y actividades</option>
                    <option value="pregunta">Pregunta general</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            
            <!-- Preferencias animales -->
            <div class="form-group">
                <label>Animal de interés (selecciona los dos si lo deseas)</label>
                <div class="animal-selection">
                    <div class="animal-option">
                        <input type="checkbox" id="animal-perro" name="animales[]" value="perro">
                        <label for="animal-perro" alt="Perro"> Perros</label>
                    </div>
                    <div class="animal-option">
                        <input type="checkbox" id="animal-gato" name="animales[]" value="gato">
                        <label for="animal-gato" alt="Gato"> Gatos</label>
                    </div>
                </div>
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