<?php
include('../../config/conexion.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuario WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: gestion_usuarios.php?mensaje=Usuario eliminado correctamente");
    } else {
        header("Location: gestion_usuarios.php?mensaje=Error al eliminar el usuario");
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: gestion_usuarios.php");
}
