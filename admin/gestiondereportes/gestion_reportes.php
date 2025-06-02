<?php
include('../../config/conexion.php');
include('../includes/header.php');
include('../includes/sidebar.php');
?>

<div class="contenido-dashboard">
    <h1>Gestión de Reportes</h1>
    <link rel="stylesheet" href="../assets/css/gestionreportes.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">

    <!-- Ingresos diarios -->
    <section class="reporte-seccion">
        <h2>Ingresos Diarios</h2>
        <div class="tabla-scroll">
        <table class="tabla-reportes">
            <tr>
                <th>Fecha</th>
                <th>Total Ingresos</th>
            </tr>
            <?php
            $ingresos_diarios = mysqli_query($conexion, "SELECT * FROM ingresos_diarios");
            while($row = mysqli_fetch_assoc($ingresos_diarios)) {
                echo "<tr><td>{$row['dia']}</td><td>Bs/ " . number_format($row['total_ingresos'], 2) . "</td></tr>";
            }
            ?>
        </table>
        </div>
    </section>

    <!-- Productos más vendidos -->
    <section class="reporte-seccion">
        <h2>Productos Más Vendidos</h2>
        <div class="tabla-scroll">
        <table class="tabla-reportes">
            <tr>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
            </tr>
            <?php
            $productos_mas_vendidos = mysqli_query($conexion, "SELECT * FROM productos_mas_vendidos");
            while($row = mysqli_fetch_assoc($productos_mas_vendidos)) {
                echo "<tr><td>{$row['nombre']}</td><td>{$row['total_vendidos']}</td></tr>";
            }
            ?>
        </table>
        </div>
    </section>

    <!-- Reporte de ventas con NIT -->
    <section class="reporte-seccion">
        <h2>Reporte de Ventas Facturadas</h2>
        <div class="tabla-scroll">
        <table class="tabla-reportes">
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Tipo Pedido</th>
                <th>Entrega</th>
                <th>Pago</th>
                <th>Total</th>
                <th>NIT</th>
                <th>Razón Social</th>
            </tr>
            <?php
            $reporte_venta = mysqli_query($conexion, "SELECT * FROM reporte_venta");
            while($row = mysqli_fetch_assoc($reporte_venta)) {
                echo "<tr>
                        <td>{$row['id_pedido']}</td>
                        <td>{$row['fecha']}</td>
                        <td>{$row['tipo_pedido']}</td>
                        <td>{$row['tipo_entrega']}</td>
                        <td>{$row['metodo_pago']}</td>
                        <td>S/ " . number_format($row['total'], 2) . "</td>
                        <td>{$row['nit_cliente']}</td>
                        <td>{$row['razon_social']}</td>
                    </tr>";
            }
            ?>
        </table>
        </div>
    </section>
</div>
