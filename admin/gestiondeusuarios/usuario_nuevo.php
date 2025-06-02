<?php
include('../../config/conexion.php'); 

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $sql = "INSERT INTO usuario (nombre, usuario, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $usuario, $password, $rol);

    if ($stmt->execute()) {
        header("Location: gestion_usuarios.php");
        exit();
    } else {
        $mensaje = "Error al registrar usuario.";
    }
}
?>


<main class="contenido-dashboard">
    <h1>Agregar Nuevo Usuario</h1>
    <link rel="stylesheet" href="../assets/css/crearusuario.css">

    <?php if ($mensaje): ?>
        <div class="error"><?= $mensaje; ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="formulario">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Usuario:</label>
        <input type="text" name="usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <label>Rol:</label>
        <select name="rol" required>
            <option value="">Seleccione un rol</option>
            <option value="admin">Administrador</option>
            <option value="cajero">Cajero</option>
            <option value="cocina">Cocina</option>
        </select>

        <button type="submit" class="btn-guardar">Guardar</button>
        <a href="gestion_usuarios.php" class="btn-cancelar">Cancelar</a>
    </form>
</main>

<link rel="stylesheet" href="assets/css/usuarios.css">
