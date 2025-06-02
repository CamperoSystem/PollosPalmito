<?php
include '../config/conexion.php';

$sql = "SELECT id_pedido, fecha, tipo_pedido, tipo_entrega, metodo_pago, estado, total 
        FROM pedido 
        WHERE estado IN ('pendiente', 'en_preparacion') 
        ORDER BY fecha ASC";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $row['id_pedido'] ?></td>
    <td><?= $row['fecha'] ?></td>
    <td><?= $row['tipo_pedido'] ?></td>
    <td><?= $row['tipo_entrega'] ?></td>
    <td><?= $row['metodo_pago'] ?></td>
    <td><?= $row['estado'] ?></td>
    <td>Bs<?= number_format($row['total'], 2) ?></td>
    <td>
        <?php if ($row['estado'] !== 'entregado'): ?>
            <form action="actualizar_estado.php" method="POST">
                <input type="hidden" name="id_pedido" value="<?= $row['id_pedido'] ?>">
                <input type="submit" name="cambiar_estado" value="Marcar como Entregado">
            </form>
        <?php else: ?>
            Entregado
        <?php endif; ?>
    </td>
</tr>
<tr>
    <td colspan="8">
        <strong>Productos:</strong>
        <ul>
        <?php
        $id_pedido = $row['id_pedido'];
        $sql_productos = "
            SELECT p.nombre, dp.cantidad
            FROM detalle_pedido dp
            JOIN producto p ON dp.id_producto = p.id_producto
            WHERE dp.id_pedido = $id_pedido
        ";
        $productos = $conexion->query($sql_productos);
        if ($productos->num_rows > 0):
            while($prod = $productos->fetch_assoc()):
        ?>
            <li><?= $prod['cantidad'] ?> x <?= $prod['nombre'] ?></li>
        <?php endwhile; else: ?>
            <li>No hay productos para este pedido.</li>
        <?php endif; ?>
        </ul>
    </td>
</tr>
<?php
    endwhile;
} else {
    echo "<tr><td colspan='8'>No hay pedidos pendientes o en preparación.</td></tr>";
}
?>
