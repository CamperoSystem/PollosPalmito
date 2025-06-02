<?php
session_start();
include('../../config/conexion.php');         // Sube 2 carpetas: desde gestiondeusuarios a admin, luego a PollosPalmito
include('../includes/header.php');            // Sube 1 carpeta: desde gestiondeusuarios a admin, luego entra a includes
include('../includes/sidebar.php');

// Obtener usuarios desde la base de datos
$sql = "SELECT * FROM usuario";
$resultado = mysqli_query($conexion, $sql);
?>
<link rel="stylesheet" href="../assets/css/gestionusuario.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<main class="contenido-dashboard">
    <h1>Gestión de Usuarios</h1>
    
    <div class="acciones">
        <a href="usuario_nuevo.php" class="btn-agregar">+ Agregar Usuario</a>
    </div>

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?= $fila['id_usuario']; ?></td>
                <td><?= $fila['nombre']; ?></td>
                <td><?= $fila['usuario']; ?></td>
                <td><?= ucfirst($fila['rol']); ?></td>
                <td>
                    <a href="usuario_editar.php?id=<?= $fila['id_usuario']; ?>" class="btn-editar">Editar</a>
                    <a href="usuario_eliminar.php?id=<?= $fila['id_usuario']; ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</main>

<link rel="stylesheet" href="assets/css/usuarios.css">
