<?php

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conn->query("DELETE FROM usuarios WHERE id=$id");

    if ($conn->affected_rows > 0) {
        header("Location: tabla.php?mensaje=ok");
        exit;
    }
}

?>