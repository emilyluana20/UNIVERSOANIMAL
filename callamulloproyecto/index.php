<?php
session_start();

// Configuración de la base de datos
$db = "universoanimal";
$conn = new mysqli("localhost", "root", "", $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar que haya sesión activa
if (!isset($_SESSION['rol'])) {
    $_SESSION['rol'] = 'usuario';
}
$rol = $_SESSION['rol'];

$editadaId = $_GET['editada'] ?? null;

// Traer campañas desde la base de datos
$sql = "SELECT * FROM campanias ORDER BY fecha_creacion DESC";
$resultado = $conn->query($sql);
$campanias = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Campañas | Universo Animal</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
    <div class="logoo">
        <a href="/UNIVERSOANIMAL/pagina.php"><img src="../img/logo.png"></a>
    </div>
    <div class="logo">Universo Animal</div>
    <button class="hamburger" aria-label="Abrir menú">&#9776;</button>
    <nav class="nav">
        <a href="/UNIVERSOANIMAL/baños.php">Cuidados</a>
        <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="../Registro/crear_campañias.php">+ Crear campaña</a>
        <?php endif; ?>
        <a href="../redsocial/ver.php">Perdidos</a>
        <a href="/UNIVERSOANIMAL/contacto.php">Contacto</a>
        <a href="../Registro/logout.php">Cerrar Sesión</a>
    </nav>
</header>

<?php if ($editadaId): ?>
    <div id="mensaje-exito" style="background-color:#d4edda; color:#155724; padding: 1rem; border-radius: 8px; max-width: 480px; margin: 1rem auto; text-align: center; font-weight: bold;">
        ✅ Campaña actualizada correctamente.
    </div>
<?php endif; ?>
<?php if (isset($_GET['eliminada']) && $_GET['eliminada'] === 'ok'): ?>
    <div style="background: #d4edda; color: #155724; padding: 1rem; margin: 1rem auto; border-radius: 8px; max-width: 480px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        ✅ La campaña fue eliminada correctamente.
    </div>
<?php endif; ?>

<section class="search-section">
    <h2>Buscar Lugares, Fechas y Horarios</h2>
    <input type="text" id="searchInput" placeholder="Escribí para buscar...">
    <ul id="resultsList" class="list">
        <?php foreach ($campanias as $campania): 
            $claseResaltado = ($campania['id'] == $editadaId) ? 'resaltado' : '';
        ?>
            <li class="list-item <?= $claseResaltado ?>" data-lugar="<?= strtolower($campania['lugar']) ?>"
                data-fecha="<?= $campania['fecha_creacion'] ?>"
                data-horario="<?= $campania['horario'] ?>">
                <div class="place"><?= htmlspecialchars($campania['lugar']) ?></div>
                <div class="datetime"><?= htmlspecialchars($campania['horario']) ?> · <?= date("d/m/Y", strtotime($campania['fecha_creacion'])) ?></div>
                <div class="descripcion"><?= htmlspecialchars($campania['descripcion']) ?></div>
                <?php if ($rol === 'admin'): ?>
                    <a href="../Registro/editarcam.php?id=<?= $campania['id'] ?>" class="btn-principal">Editar</a>
                    <a href="../Registro/eliminarcam.php?id=<?= $campania['id'] ?>" class="btn-secundario" onclick="return confirm('¿Estás segur@ que querés eliminar esta campaña?')">Eliminar</a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<script>
    const searchInput = document.getElementById('searchInput');
    const listItems = document.querySelectorAll('.list-item');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();

        listItems.forEach(item => {
            const lugar = item.dataset.lugar;
            const fecha = item.dataset.fecha;
            const horario = item.dataset.horario;

            const coincide = lugar.includes(query) || fecha.includes(query) || horario.includes(query);
            item.style.display = coincide ? 'block' : 'none';
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
        const mensaje = document.getElementById('mensaje-exito');
        if (mensaje) {
            setTimeout(() => {
                mensaje.style.transition = 'opacity 0.5s ease';
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.remove(), 500);
            }, 5000); // 5 segundos
        }
    });
</script>
<script>
    // Script para el menú hamburguesa
    document.querySelector('.hamburger').addEventListener('click', function() {
        document.querySelector('.nav').classList.toggle('active');
    });
</script>
</body>
</html>