<?php
include('../../config/conexion.php');
include('../includes/header.php');
include('../includes/sidebar.php');

$query = "SELECT p.*, c.nombre AS categoria 
          FROM producto p 
          JOIN categoria_producto c ON p.id_categoria = c.id_categoria";
$resultado = mysqli_query($conexion, $query);
?>

<div class="contenido-dashboard">
    <h1>Gestión de Productos</h1>
    <a class="btn-crear" href="crear_producto.php">+ Nuevo Producto</a>
       <link rel="stylesheet" href="../assets/css/gestionproductos.css">
       <link rel="stylesheet" href="../assets/css/dashboard.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="tabla-contenedor">
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th>
                    <th>Tipo</th><th>Categoría</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?= $fila['id_producto'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['descripcion'] ?></td>
                    <td>Bs<?= number_format($fila['precio'], 2) ?></td>
                    <td><?= $fila['tipo'] ?></td>
                    <td><?= $fila['categoria'] ?></td>
                    <td>
                        <a class="btn-editar" href="editar_producto.php?id=<?= $fila['id_producto'] ?>">Editar</a>
                        <a class="btn-eliminar" href="eliminar_producto.php?id=<?= $fila['id_producto'] ?>" onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
