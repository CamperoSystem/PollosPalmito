<?php
include('../../config/conexion.php');


$id = $_GET['id'];

// Obtener datos del producto
$consulta = mysqli_query($conexion, "SELECT * FROM producto WHERE id_producto = $id");
$producto = mysqli_fetch_assoc($consulta);

// Obtener categorías
$categorias = mysqli_query($conexion, "SELECT * FROM categoria_producto");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "UPDATE producto SET 
                nombre = '$nombre', 
                descripcion = '$descripcion',
                precio = '$precio', 
                tipo = '$tipo', 
                id_categoria = $id_categoria 
            WHERE id_producto = $id";
    mysqli_query($conexion, $sql);
    header("Location: gestion_productos.php");
    exit();
}
?>

<div class="contenido-dashboard">
    <h1>Editar Producto</h1>
 <link rel="stylesheet" href="../assets/css/editarproducto.css">
    <form method="POST" class="formulario">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>

        <label>Descripción:</label>
        <input type="text" name="descripcion" value="<?= $producto['descripcion'] ?>">

        <label>Precio:</label>
        <input type="text" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>

        <label>Tipo:</label>
        <select name="tipo">
            <option value="Pollo" <?= $producto['tipo'] == 'Pollo' ? 'selected' : '' ?>>Pollo</option>
            <option value="Bebida" <?= $producto['tipo'] == 'Bebida' ? 'selected' : '' ?>>Bebida</option>
            <option value="Extra" <?= $producto['tipo'] == 'Extra' ? 'selected' : '' ?>>Extra</option>
        </select>

        <label>Categoría:</label>
        <select name="id_categoria">
            <?php while($cat = mysqli_fetch_assoc($categorias)): ?>
                <option value="<?= $cat['id_categoria'] ?>" <?= $cat['id_categoria'] == $producto['id_categoria'] ? 'selected' : '' ?>>
                    <?= $cat['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" class="btn-guardar">Actualizar</button>
        <a href="gestion_productos.php" class="btn-cancelar">Cancelar</a>
    </form>
</div>
