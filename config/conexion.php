
<?php
$host = "localhost";
$usuario = "root";
$contrasena = "Campero7970.";
$base_datos = "broasterpalmito";

// Usar $conexion en lugar de $conn
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Opcional para pruebas:
// echo "Conexión exitosa a la base de datos.";
?>
