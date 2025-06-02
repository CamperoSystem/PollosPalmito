<?php
include('../config/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $ubicacion = $_POST['ubicacion'];
    $nit = $_POST['nit'];
    $productos = json_decode($_POST['productos']);
    $cantidades = json_decode($_POST['cantidades']);
    $precios = json_decode($_POST['precios']);
    $metodo_pago = 'qr';

    // Insertar cliente
    $stmtCliente = $conexion->prepare("INSERT INTO cliente (nombre, telefono, direccion, ubicacion_gps) VALUES (?, ?, ?, ?)");
    $stmtCliente->bind_param("ssss", $nombre, $telefono, $direccion, $ubicacion);
    $stmtCliente->execute();
    $id_cliente = $stmtCliente->insert_id;

    $id_usuario = 1;
    $fecha = date('Y-m-d H:i:s');
    $tipo_pedido = 'en_linea';
    $tipo_entrega = 'domicilio';
    $estado = 'pendiente';

    $total_productos = 0;
    for ($i = 0; $i < count($productos); $i++) {
        $total_productos += $cantidades[$i] * $precios[$i];
    }
    $total_final = $total_productos + 15;

    // Insertar pedido
    $stmtPedido = $conexion->prepare("INSERT INTO pedido (id_cliente, id_usuario, fecha, tipo_pedido, tipo_entrega, metodo_pago, estado, total, facturado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)");
    $stmtPedido->bind_param("iisssssd", $id_cliente, $id_usuario, $fecha, $tipo_pedido, $tipo_entrega, $metodo_pago, $estado, $total_final);
    $stmtPedido->execute();
    $id_pedido = $stmtPedido->insert_id;

    // Insertar detalles del pedido
    for ($i = 0; $i < count($productos); $i++) {
        $subtotal = $cantidades[$i] * $precios[$i];
        $stmtDetalle = $conexion->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmtDetalle->bind_param("iiidd", $id_pedido, $productos[$i], $cantidades[$i], $precios[$i], $subtotal);
        $stmtDetalle->execute();
    }

    // Insertar factura
    $razon_social = $nombre;
    $stmtFactura = $conexion->prepare("INSERT INTO factura (id_pedido, fecha, nit_cliente, razon_social, total) VALUES (?, ?, ?, ?, ?)");
    $stmtFactura->bind_param("isssd", $id_pedido, $fecha, $nit, $razon_social, $total_final);
    $stmtFactura->execute();

    // Prepara mensaje para WhatsApp
   // Enviar mensaje por WhatsApp
$numeroWhatsapp = '59175573110'; // sin "+" ni espacios
$mensaje = "🚨 *Nuevo Pedido* 🚨\n";
$mensaje .= "🧾 Pedido #: $id_pedido\n";
$mensaje .= "👤 Nombre: $nombre\n";
$mensaje .= "📞 Teléfono: $telefono\n";
$mensaje .= "📍 Dirección: $direccion\n";
$mensaje .= "🌐 GPS: $ubicacion\n";
$mensaje .= "💰 Total: Bs $total_final";


$factura_url = "../cliente/?id={$id_pedido}";
$whatsapp_url = "https://wa.me/{$numeroWhatsapp}?text=" . urlencode($mensaje);

echo "<script>
    alert('Pedido enviado con éxito');
    var factura = confirm('¿Deseas imprimir la factura?');
    if (factura) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'http://localhost/PollosPalmito/cliente/controlador/generar_factura.php';
        form.target = '_blank';

        var id = document.createElement('input');
        id.type = 'hidden';
        id.name = 'id_pedido';
        id.value = '{$id_pedido}';
        form.appendChild(id);

        var nit = document.createElement('input');
        nit.type = 'hidden';
        nit.name = 'nit_cliente';
        nit.value = '{$nit}'; // Asegúrate de definir $nit antes en PHP
        form.appendChild(nit);

        var razon = document.createElement('input');
        razon.type = 'hidden';
        razon.name = 'razon_social';
        razon.value = '{$nombre}'; // Asegúrate de definir $razon antes en PHP
        form.appendChild(razon);

        document.body.appendChild(form);
        form.submit();
    }

    window.location.href = 'https://wa.me/{$numeroWhatsapp}?text=" . urlencode($mensaje) . "';
</script>";

exit();

}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido a Domicilio</title>
    <link rel="stylesheet" href="../cliente/assets/css/enviodomicilio.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>
<body class="bg-dark text-light">
<div class="container py-4">
    <h2 class="text-center mb-4 titulo-naranja">Formulario de Pedido a Domicilio</h2>


    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-danger" type="button" onclick="cancelarPedido()">Cancelar</button>
        <button class="btn btn-secondary" type="button" onclick="window.history.back()">Retroceder</button>
    </div>

    <form method="POST" onsubmit="return validarEnvio()">
        <div class="card p-4 bg-black text-light mb-4" style="border: 2px solid #ff4500;">

            <h4>Datos para la factura</h4>
            <input type="text" name="nombre" class="form-control my-2" placeholder="Tu nombre o razón social" required>
            <input type="text" name="telefono" class="form-control my-2" placeholder="Teléfono" required>
            <input type="text" name="direccion" class="form-control my-2" placeholder="Dirección" required>
            <input type="text" name="nit" class="form-control my-2" placeholder="NIT" required>
            <div class="input-group my-2">
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" placeholder="Ubicación GPS" readonly>
                <button type="button" class="btn btn-outline-light" onclick="obtenerUbicacion()">Obtener GPS</button>
            </div>
            <div id="linkGPS" class="mt-2"></div>
        </div>

        <div class="row" id="productosContainer">
            <?php
            $query = "SELECT * FROM producto";
            $resultado = mysqli_query($conexion, $query);
            while ($row = mysqli_fetch_assoc($resultado)) {
                $id = $row['id_producto'];
                $nombreProducto = htmlspecialchars($row['nombre']);
                $precio = $row['precio'];
                $imagen = "imagenes/" . preg_replace('/[^A-Za-z0-9_\-]/', '', $nombreProducto) . ".png";
                echo "
                <div class='col-6 col-md-4 col-lg-3 mb-4'>
                    <div class='card h-100 text-dark producto' data-id='$id' data-precio='$precio'>
                        <img src='$imagen' class='card-img-top' alt='$nombreProducto'>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>$nombreProducto</h5>
                            <p class='card-text'>Bs $precio</p>
                            <div class='btn-group contador' role='group'>
                                <button type='button' class='btn btn-outline-danger menos'>-</button>
                                <span class='btn btn-outline-light cantidad'>0</span>
                                <button type='button' class='btn btn-outline-success mas'>+</button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>

        <div class="card bg-black text-light border-success p-4 mb-4">
            <h4>Resumen del pedido</h4>
            <div id="detalleCosto"></div>
            <canvas id="codigoQR" class="my-3"></canvas>
            <h5>Método de pago: <strong class="text-success">QR</strong></h5>
            <p>Escanea el código QR y luego presiona OK.</p>
            <button type="submit" class="btn btn-success">OK</button>
        </div>

        <input type="hidden" name="productos" id="productos">
        <input type="hidden" name="cantidades" id="cantidades">
        <input type="hidden" name="precios" id="precios">
    </form>
</div>

<script src="../cliente/assets/js/enviodomicilio.js"></script>
</body>
</html>
