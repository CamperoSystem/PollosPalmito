<?php
// Mostrar errores de PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../config/conexion.php');

// Si es una petición POST tipo JSON (procesar pedido)
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

      session_start();
      $id_usuario = $_SESSION['id_usuario'] ?? 1; // Cajero logueado, debes asegurarte que este dato exista

// Si el cliente ID es nulo, el pedido es 'en_local', sino es 'en_linea'
     $tipo_pedido = ($cliente_id === "NULL") ? 'en_local' : 'en_linea';

// Si es en_local, el tipo de entrega no aplica, ponemos NULL
      $tipo_entrega = ($tipo_pedido === 'en_local') ? "NULL" : "'" . mysqli_real_escape_string($conexion, $data['tipo_entrega'] ?? 'recoger') . "'";

// Método de pago debe venir desde el frontend
      $metodo_pago = mysqli_real_escape_string($conexion, $data['metodo_pago'] ?? 'efectivo');

// Estado puede ser también enviado (por ejemplo: 'pendiente', 'pagado')
      $estado = mysqli_real_escape_string($conexion, $data['estado'] ?? 'pendiente');

// Construir query con valores dinámicos
     $query_pedido = "INSERT INTO pedido (id_cliente, id_usuario, fecha, tipo_pedido, tipo_entrega, metodo_pago, estado, total, facturado)
VALUES ($cliente_id, $id_usuario, NOW(), '$tipo_pedido', $tipo_entrega, '$metodo_pago', '$estado', 0, 0)";

    
    if (!mysqli_query($conexion, $query_pedido)) {
        echo json_encode(["error" => "Error al insertar pedido: " . mysqli_error($conexion)]);
        http_response_code(500);
        exit;
    }

    $id_pedido = mysqli_insert_id($conexion);
    $total = 0;

    // 2. Insertar detalle del pedido
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

    // 3. Actualizar total
    mysqli_query($conexion, "UPDATE pedido SET total = $total WHERE id_pedido = $id_pedido");

    echo json_encode(["id_pedido" => $id_pedido]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Pedido</title>
    <style>
        .producto {
            display: inline-block;
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            text-align: center;
            width: 150px;
        }
        .producto img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .producto p {
            margin: 5px 0;
        }
        .cantidad {
            display: inline-block;
            width: 20px;
        }
    </style>
</head>
<body>
<h1>Selecciona tus productos</h1>

<?php
// Mostrar productos
$query = "SELECT * FROM producto";
$resultado = mysqli_query($conexion, $query);
while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<div class='producto' data-id='{$row['id_producto']}'>";
 $nombreImagen = preg_replace('/[^A-Za-z0-9_\-]/', '', $row['nombre']); // quita caracteres raros
echo "<img src='assets/imagenes/{$nombreImagen}.png' alt='{$row['nombre']}' />";

    echo "<p>{$row['nombre']}<br>Bs {$row['precio']}</p>";
    echo "<button class='menos'>-</button>";
    echo "<span class='cantidad'>0</span>";
    echo "<button class='mas'>+</button>";
    echo "</div>";
}
?>
<br><br>
<label for="metodo_pago">Método de pago:</label>
<select id="metodo_pago">
    <option value="efectivo">Efectivo</option>
    <option value="tarjeta">Tarjeta</option>
    <option value="transferencia">Transferencia</option>
</select>
<br><br>
<button id="finalizar">Finalizar Pedido</button>
<br><br>
<div id="vista-carrito">
    <h2>Carrito</h2>
    <ul id="lista-carrito"></ul>
</div>


<button id="cancelar">Cancelar Pedido</button>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let carrito = {};
    const listaCarrito = document.getElementById('lista-carrito');

    function actualizarVistaCarrito() {
        listaCarrito.innerHTML = '';
        for (let id in carrito) {
            if (carrito[id] > 0) {
                const producto = document.querySelector(`.producto[data-id="${id}"]`);
                const nombre = producto.querySelector('p').innerText;
                const li = document.createElement('li');
                li.textContent = `${nombre}: ${carrito[id]}`;
                listaCarrito.appendChild(li);
            }
        }
    }

    document.querySelectorAll('.producto').forEach(p => {
        const id = p.dataset.id;

        p.querySelector('.mas').addEventListener('click', () => {
            carrito[id] = (carrito[id] || 0) + 1;
            p.querySelector('.cantidad').innerText = carrito[id];
            actualizarVistaCarrito();
        });

        p.querySelector('.menos').addEventListener('click', () => {
            if (carrito[id] > 0) {
                carrito[id]--;
                p.querySelector('.cantidad').innerText = carrito[id];
                actualizarVistaCarrito();
            }
        });
    });

    document.getElementById('finalizar').addEventListener('click', () => {
    if (Object.keys(carrito).length === 0 || Object.values(carrito).every(val => val === 0)) {
        alert("El carrito está vacío.");
        return;
    }

    const metodoPago = document.getElementById('metodo_pago').value;

    const datosPedido = {
        carrito: carrito,
        metodo_pago: metodoPago,
        tipo_pedido: 'en_local',
        estado: 'pendiente'
    };

    console.log("Enviando pedido:", datosPedido);

    fetch(window.location.href, {
        method: 'POST',
        body: JSON.stringify(datosPedido),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(res => res.json())
    .then(data => {
        console.log("Respuesta del servidor:", data);
        if (data.error) {
            alert("Error del servidor: " + data.error);
            return;
        }
        alert("Pedido guardado. ID: " + data.id_pedido);
        window.location.href = `facturar.php?id_pedido=${data.id_pedido}`;
    })
    .catch(error => {
        console.error("Error al procesar pedido:", error);
        alert("Ocurrió un error al guardar el pedido.");
    });
});


    document.getElementById('cancelar').addEventListener('click', () => {
        carrito = {};
        document.querySelectorAll('.producto .cantidad').forEach(span => span.innerText = '0');
        listaCarrito.innerHTML = '';
    });
});
</script>

</body>
</html>
