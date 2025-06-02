<?php
// Mostrar errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../config/conexion.php');

// Mover session_start() arriba para que esté disponible en todo momento
session_start();

// Procesar pedido si es JSON POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data || !isset($data['carrito']) || empty($data['carrito'])) {
        echo json_encode(["error" => "Carrito no recibido o vacío."]);
        http_response_code(400);
        exit;
    }

    $carrito = $data['carrito'];
    $cliente_id = isset($data['cliente_id']) && $data['cliente_id'] !== '' ? $data['cliente_id'] : "NULL";

    $id_usuario = $_SESSION['id_usuario'] ?? 2;

    $tipo_pedido = ($cliente_id === "NULL") ? 'en_local' : 'en_linea';
    $tipo_entrega = ($tipo_pedido === 'en_local') ? "NULL" : "'" . mysqli_real_escape_string($conexion, $data['tipo_entrega'] ?? 'recoger') . "'";
    $metodo_pago = mysqli_real_escape_string($conexion, $data['metodo_pago'] ?? 'efectivo');
    $estado = mysqli_real_escape_string($conexion, $data['estado'] ?? 'pendiente');

    $query_pedido = "INSERT INTO pedido (id_cliente, id_usuario, fecha, tipo_pedido, tipo_entrega, metodo_pago, estado, total, facturado)
    VALUES ($cliente_id, $id_usuario, NOW(), '$tipo_pedido', $tipo_entrega, '$metodo_pago', '$estado', 0, 0)";

    if (!mysqli_query($conexion, $query_pedido)) {
        echo json_encode(["error" => "Error al insertar pedido: " . mysqli_error($conexion)]);
        http_response_code(500);
        exit;
    }

    $id_pedido = mysqli_insert_id($conexion);
    $total = 0;

    foreach ($carrito as $id_producto => $cantidad) {
        $id_producto = (int)$id_producto;
        $cantidad = (int)$cantidad;

        if ($cantidad <= 0) continue;

        $resultado = mysqli_query($conexion, "SELECT precio FROM producto WHERE id_producto = $id_producto");
        if (!$resultado || mysqli_num_rows($resultado) == 0) {
            echo json_encode(["error" => "Producto no encontrado: $id_producto"]);
            http_response_code(400);
            exit;
        }

        $row = mysqli_fetch_assoc($resultado);
        $precio = $row['precio'];
        $subtotal = $precio * $cantidad;
        $total += $subtotal;

        $query_detalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal)
        VALUES ($id_pedido, $id_producto, $cantidad, $precio, $subtotal)";

        if (!mysqli_query($conexion, $query_detalle)) {
            echo json_encode(["error" => "Error al insertar detalle: " . mysqli_error($conexion)]);
            http_response_code(500);
            exit;
        }
    }

    mysqli_query($conexion, "UPDATE pedido SET total = $total WHERE id_pedido = $id_pedido");

    echo json_encode(["id_pedido" => $id_pedido]);
    exit;
}
?>


<!-- HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pedido</title>
    <link rel="stylesheet" href="assets/css/cajero.css">
</head>
<body>
    
      <header class="header">
    <h1>Realiza tu pedido</h1>
    <div class="usuario-info">
        <?php if (isset($_SESSION['usuario'])): ?>
            <span>Bienvenido, <?php echo $_SESSION['usuario']; ?></span>
            <a href="../login/logout.php" class="btn-salir">Cerrar sesión</a>
        <?php endif; ?>
    </div>
    </header>


    <?php
    $query = "SELECT * FROM producto";
    $resultado = mysqli_query($conexion, $query);
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<div class='producto' data-id='{$row['id_producto']}'>";
        $nombreImagen = preg_replace('/[^A-Za-z0-9_\-]/', '', $row['nombre']);
        echo "<img src='assets/imagenes/{$nombreImagen}.png' alt='{$row['nombre']}' />";
        echo "<p>{$row['nombre']}<br>Bs {$row['precio']}</p>";
        echo "<button class='menos'>-</button>";
        echo "<span class='cantidad'>0</span>";
        echo "<button class='mas'>+</button>";
        echo "</div>";
    }
    ?>

    <div id="carrito-flotante">
        <button id="minimizar-carrito" style="float: right;">–</button>
        

    <h2>Carrito</h2>
    <ul id="lista-carrito"></ul>
    <label for="tipo_entrega">Tipo de entrega:</label>
<select id="tipo_entrega">
    <option value="">Selecciona una opción</option>
    <option value="en_local">En el local</option>
    <option value="para_llevar">Para llevar</option>
    
</select>


    <label for="metodo_pago">Método de pago:</label>
    <select id="metodo_pago">
        <option value="">Selecciona una opción</option>
        <option value="efectivo">Efectivo</option>
        
        <option value="qr">QR</option>
    </select>

    <div id="qr-container" style="display:none; text-align:center; margin-top:10px;">
        <img id="qr-image" src="" alt="Código QR de pago" width="150">
        <p>Escanea para pagar</p>
    </div>

    <button id="finalizar">Finalizar Pedido</button>
    <button id="cancelar">Cancelar Pedido</button>
</div>

    <script src="assets/js/pedido.js"></script>
</body>
</html>
