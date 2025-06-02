<?php
include '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pedido = $_POST['id_pedido'];

    $sql = "UPDATE pedido SET estado = 'entregado' WHERE id_pedido = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_pedido);

    if ($stmt->execute()) {
        header("Location: pedidos.php"); // Redirige de nuevo a la vista
        exit();
    } else {
        echo "Error al actualizar el estado.";
    }
}
?>
