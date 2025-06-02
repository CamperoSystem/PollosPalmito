<?php
session_start();
include('../config/conexion.php');

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Preparar consulta segura
$stmt = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ?");
if (!$stmt) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    // Comparar en texto plano
    if ($password === $fila['password']) {
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];

        // Redirección según el rol
        if ($fila['rol'] == 'admin') {
            header("Location: ../admin/dashboard/dashboard.php");
        } elseif ($fila['rol'] == 'cajero') {
            header("Location: ../cajero/realizar_pedido.php");
        } elseif ($fila['rol'] == 'cocina') {
            header("Location: ../cocina/pedidos.php");
        }
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

$stmt->close();
$conexion->close();
?>
