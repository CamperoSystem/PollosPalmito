<?php
include('../../config/conexion.php'); 

if (!isset($_GET['id'])) {
    header("Location: gestion_usuarios.php");
    exit();
}

$id = $_GET['id'];
$mensaje = "";

// Obtener datos actuales del usuario
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    header("Location: gestion_usuarios.php");
    exit();
}

$usuario = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario_nombre = $_POST['usuario'];
    $rol = $_POST['rol'];

    $sql = "UPDATE usuario SET nombre = ?, usuario = ?, rol = ? WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $usuario_nombre, $rol, $id);

    if ($stmt->execute()) {
        header("Location: gestion_usuarios.php");
        exit();
    } else {
        $mensaje = "Error al actualizar usuario.";
    }
}
?>


<main class="contenido-dashboard">
    <h1>Editar Usuario</h1>
  <link rel="stylesheet" href="../assets/css/editarusuario.css">
    <?php if ($mensaje): ?>
        <div class="error"><?= $mensaje; ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="formulario">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $usuario['nombre']; ?>" required>

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?= $usuario['usuario']; ?>" required>

        <label>Rol:</label>
        <select name="rol" required>
            <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="cajero" <?= $usuario['rol'] == 'cajero' ? 'selected' : '' ?>>Cajero</option>
            <option value="cocina" <?= $usuario['rol'] == 'cocina' ? 'selected' : '' ?>>Cocina</option>
        </select>

        <button type="submit" class="btn-guardar">Actualizar</button>
        <a href="gestion_usuarios.php" class="btn-cancelar">Cancelar</a>
    </form>
</main>

<link rel="stylesheet" href="assets/css/usuarios.css">
