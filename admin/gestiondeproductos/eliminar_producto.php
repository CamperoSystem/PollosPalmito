<?php
include('../../config/conexion.php');

$id = $_GET['id'];
mysqli_query($conexion, "DELETE FROM producto WHERE id_producto = $id");

header("Location: gestion_productos.php");
exit();
