
<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}


include('../../config/conexion.php');
include('../includes/header.php');
include('../includes/sidebar.php');

// Consulta de resumen real de la tabla pedido
$q_total_usuarios = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM usuario");
$q_total_productos = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM producto");
$q_total_pedidos = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM pedido");
$q_ingresos = mysqli_query($conexion, "SELECT SUM(total) AS ingresos FROM pedido WHERE estado = 'entregado'");

$total_usuarios = mysqli_fetch_assoc($q_total_usuarios)['total'];
$total_productos = mysqli_fetch_assoc($q_total_productos)['total'];
$total_pedidos = mysqli_fetch_assoc($q_total_pedidos)['total'];
$total_ingresos = number_format(mysqli_fetch_assoc($q_ingresos)['ingresos'] ?? 0, 2);

// Pedidos por fecha (últimos 7 días)
$labels = [];
$totales = [];
$resultado = mysqli_query($conexion, "
    SELECT DATE(fecha) AS fecha, SUM(total) AS total
    FROM pedido
    WHERE estado = 'entregado'
    GROUP BY DATE(fecha)
    ORDER BY fecha DESC
    LIMIT 7
");
while ($row = mysqli_fetch_assoc($resultado)) {
    $labels[] = $row['fecha'];
    $totales[] = $row['total'];
}
$labels = array_reverse($labels);
$totales = array_reverse($totales);
?>

<main class="contenido-dashboard">
    <h1>Dashboard del Administrador</h1>

    <!-- Contenido principal -->
    <main class="contenido-dashboard">
        
        <link rel="stylesheet" href="../assets/css/dashboard.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      

        <div class="cards">
            <div class="card red">
                <h3>Usuarios</h3>
                <p><?= $total_usuarios ?></p>
            </div>
            <div class="card orange">
                <h3>Productos</h3>
                <p><?= $total_productos ?></p>
            </div>
            <div class="card blue">
                <h3>Pedidos</h3>
                <p><?= $total_pedidos ?></p>
            </div>
            <div class="card green">
                <h3>Ingresos</h3>
                <p>Bs/ <?= $total_ingresos ?></p>
            </div>
        </div>

        <section class="grafico">
            <h2>Ingresos últimos 7 días</h2>
            <canvas id="graficoVentas"></canvas>
        </section>
    </main>

    <script>
        const ctx = document.getElementById('graficoVentas').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Ingresos diarios',
                    data: <?= json_encode($totales) ?>,
                    borderColor: 'rgba(75,192,192,1)',
                    backgroundColor: 'rgba(75,192,192,0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

</main>


