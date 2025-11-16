<?php
session_start();
include "Conexion.php";

// === Validación de acceso ===
if (!isset($_SESSION['usuario']) || ($_SESSION['rol'] ?? '') !== 'admin') {
    header("Location: index.php");
    exit();
}
if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}

$mensaje = "";
$exito = false;

// === Procesamiento del formulario ===
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $lugar = $_POST["lugar"];
    $horario = $_POST["horario"];

    $stmt = $conn->prepare("INSERT INTO campanias (titulo, descripcion, lugar, horario) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $titulo, $descripcion, $lugar, $horario);

    if ($stmt->execute()) {
        $mensaje = "¡Campaña creada con éxito!";
        $exito = true;
    } else {
        $mensaje = "Error al crear la campaña: " . $stmt->error;
    }

    $stmt->close();
}

// 🔹 Definir el rol y si es admin
$rol = $_SESSION['rol'] ?? 'usuario';
$isAdmin = ($rol === 'admin');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Campaña</title>
    <link rel="stylesheet" href="Estilo/admin.css">
    <style>
        .message {
            margin: 15px 0;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            animation: fadeIn 0.4s ease;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Ajustes mínimos del menú */
        header.Encabezado {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f8f6fc;
            padding: 10px 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        header .logo-container img {
            height: 60px;
        }
        .navbar {
            position: relative;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
        }
        .nav-links a {
            text-decoration: none;
            color: #424874;
            font-weight: 600;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #6c63ff;
        }
        .dropdown .submenu {
            display: none;
            position: absolute;
            background-color: #fff;
            padding: 10px 0;
            list-style: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .dropdown:hover .submenu {
            display: block;
        }
        .submenu li a {
            display: block;
            padding: 8px 20px;
            color: #444;
        }
        .submenu li a:hover {
            background-color: #f0f0f0;
        }
        .logout {
            color: crimson;
        }
    </style>
</head>
<body>
    <!-- 🔹 MENÚ SUPERIOR -->
    <header class="Encabezado">
        <div class="logo-container">
            <a href="pagina.php"><img src="../img/logo.png " alt="Logo"></a>
        </div>

        <nav class="navbar">
            <div class="nav-container">
                <button class="menu-toggle" id="menuToggle">☰</button>

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

    <!-- 🔹 CONTENIDO PRINCIPAL -->
    <div class="container">
        <h1>Crear nueva campaña</h1>

        <!-- Mensaje dinámico -->
        <?php if (!empty($mensaje)): ?>
            <div class="message <?= $exito ? 'success' : 'error' ?>">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form method="POST" action="">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" required></textarea>

            <label for="lugar">Lugar</label>
            <input type="text" name="lugar" id="lugar" required>

            <label for="horario">Horario</label>
            <input type="text" name="horario" id="horario" required placeholder="Ej: Lunes a Viernes - 09:00 a 13:30 hs">

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar campaña</button>
                <a href="../callamulloproyecto/index.php" class="btn btn-edit">Volver</a>
            </div>
        </form>
    </div>

    <!-- 🔥 Script para ocultar el mensaje -->
    <?php if (!empty($mensaje)): ?>
    <script>
        setTimeout(() => {
            const msg = document.querySelector('.message');
            if (msg) msg.style.display = 'none';
        }, 4000);
    </script>
    <?php endif; ?>

    <!-- 🔹 Script para menú responsive -->
    <script>
        const toggle = document.getElementById("menuToggle");
        const menu = document.getElementById("navMenu");
        toggle.addEventListener("click", () => {
            menu.classList.toggle("active");
        });
    </script>
</body>
</html>
