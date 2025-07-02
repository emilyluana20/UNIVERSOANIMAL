<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "universoanimal");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT m.*, u.nombre AS nombre_usuario 
FROM mascotas_perdidas m
LEFT JOIN usuarios u ON m.usuario_id = u.id
ORDER BY m.fecha DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Feed | Universo Animal</title>
    <link rel="stylesheet" href="/UNIVERSOANIMAL/estilos/diseño.css">
</head>
<body>

    <header class="Encabezado">
        <div class="logo-container">
            <img src="/UNIVERSOANIMAL/img/logo.png">
        </div>
        <nav class="menu">
            <a href="/UNIVERSOANIMAL/index.php" class="styled-link">Inicio</a>
            <a href="pages/" class="styled-link">Búsqueda</a>
            <a href="/UNIVERSOANIMAL/datos.php" class="styled-link">Datos</a>
            <a href="pages/" class="styled-link">Reencuentros</a>
            <a href="/UNIVERSOANIMAL/contacto.php" class="styled-link">Contacto</a>
            <button class="boton"><a href="/UNIVERSOANIMAL/Registro/Index.php">Iniciar sesión</a></button>
        </nav>
        <button class="menu-hamburguesa" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

<br><br>

    <h1>Subi a tu mascota perdida</h1>

    <div class="contenedor">
    <?php while($fila = $resultado->fetch_assoc()): ?>
        <div class="publicacion">
            <strong>Publicado por: <?php echo htmlspecialchars($fila['nombre_usuario']); ?></strong>
            <h2><?php echo htmlspecialchars($fila['nombre']); ?></h2>
            <img src="<?php echo $fila['foto']; ?>" alt="Foto de la mascota">
            <p><?php echo nl2br(htmlspecialchars($fila['descripcion'])); ?></p>
            <small>Publicado el: <?php echo $fila['fecha']; ?></small>

            <div class="comentarios">
                <h4>Comentarios:</h4>
                <?php
                $comentarios_sql = "SELECT c.texto, c.fecha, u.nombre 
                                    FROM comentarios c 
                                    JOIN usuarios u ON c.usuario_id = u.id 
                                    WHERE c.publicacion_id = ? 
                                    ORDER BY c.fecha ASC";
                $comentarios_stmt = $conexion->prepare($comentarios_sql);
                $comentarios_stmt->bind_param("i", $fila['id']);
                $comentarios_stmt->execute();
                $comentarios_resultado = $comentarios_stmt->get_result();
                ?>

                <?php while($coment = $comentarios_resultado->fetch_assoc()): ?>
                    <div class="comentario">
                        <strong><?php echo htmlspecialchars($coment['nombre']); ?>:</strong>
                        <?php echo htmlspecialchars($coment['texto']); ?>
                        <small><?php echo $coment['fecha']; ?></small>
                    </div>
                <?php endwhile; ?>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <form class="form-comentario" action="comentar.php" method="POST">
                        <input type="hidden" name="publicacion_id" value="<?php echo $fila['id']; ?>">
                        <textarea name="texto" rows="2" required></textarea>
                        <br>
                        <button type="submit">Comentar</button>
                    </form>
                <?php else: ?>
                    <small>Inicia sesión para comentar.</small>
                <?php endif; ?>
            </div>

            <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $fila['usuario_id']): ?>
                <a class="editar-btn" href="editar.php?id=<?php echo $fila['id']; ?>">Editar publicación</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<br><br><br>

<div class="footerContainer">
        <div class="logos">
            <li><ion-icon name="logo-instagram"></ion-icon></li>
            <li><ion-icon name="logo-facebook"></ion-icon></li>
            <li><ion-icon name="logo-twitter"></ion-icon></li>
        </div>
        <div class="footerNav">
           <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Busqueda</a></li>
            <li><a href="">Datos</a></li>
            <li><a href="">Feed</a></li>
            <li><a href="">Reencuentros</a></li>
           </ul>
        </div>
        <div class="footerBotton">
            <p>Copyright &copy;2025 | Derechos reservados a Universo Animal</p>
        </div>

    <script  type = "module"  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js "></script> 
    <script  nomodule  src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js "></script>

</body>
</html>

<?php $conexion->close(); ?>
