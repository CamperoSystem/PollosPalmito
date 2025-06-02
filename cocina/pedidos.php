<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pedidos en Cocina</title>
    <link rel="stylesheet" type="text/css" href="pedidos.css">
</head>
<body>
    <div class="header">
        <h1>Despacho</h1>
        <div class="user-info">
            <span>Usuario: <?= htmlspecialchars($usuario) ?></span>
            <a href="../login/logout.php" class="logout-btn">Cerrar sesión</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Tipo de Pedido</th>
                <th>Tipo de Entrega</th>
                <th>Método de Pago</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="contenido-pedidos">
            <!-- Se cargará por AJAX -->
        </tbody>
    </table>

    <script>
        function cargarPedidos() {
            fetch("pedidos_contenido.php")
                .then(res => res.text())
                .then(html => {
                    document.getElementById("contenido-pedidos").innerHTML = html;
                });
        }

        setInterval(cargarPedidos, 5000); // cada 5 segundos
        cargarPedidos(); // primera carga
    </script>
</body>
</html>
