<?php

if (!isset($_SESSION['usuario_id'])) {
    session_destroy();
    header("Location: index.php?msg=acceso_no_autorizado");
    exit();
}
session_start();
session_destroy();
header("Location: Index.php");
exit();
?>
