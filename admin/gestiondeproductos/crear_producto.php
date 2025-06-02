<?php
include('../../config/conexion.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $id_categoria = $_POST['id_categoria'];

    $sql = "INSERT INTO producto (nombre, descripcion, precio, tipo, id_categoria) 
            VALUES ('$nombre', '$descripcion', '$precio', '$tipo', $id_categoria)";
    mysqli_query($conexion, $sql);
    header("Location: gestion_productos.php");
    exit();
}

$categorias = mysqli_query($conexion, "SELECT * FROM categoria_producto");
?>

<div class="contenido-dashboard">
    <h1>Registrar nuevo producto</h1>
 <link rel="stylesheet" href="../assets/css/crearproducto.css">
    <form method="POST" class="formulario">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion">

        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" required>

        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo">
            <option value="Pollo">Pollo</option>
            <option value="Bebida">Bebida</option>
            <option value="Extra">Extra</option>
        </select>

        <label for="id_categoria">Categoría:</label>
        <select name="id_categoria" id="id_categoria">
            <?php while($cat = mysqli_fetch_assoc($categorias)): ?>
                <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit" class="btn-guardar">Guardar</button>
        <a href="gestion_productos.php" class="btn-cancelar">Cancelar</a>
    </form>
</div>
