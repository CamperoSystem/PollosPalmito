<?php
ob_start();

require("../../config/conexion.php");
require("../../libreria/fpdf/fpdf.php");

// Verificar si llegaron los datos
if (!isset($_POST['id_pedido'], $_POST['nit_cliente'], $_POST['razon_social'])) {
    echo json_encode(['error' => 'Faltan datos del formulario.']);
    exit;
}

$id_pedido = intval($_POST['id_pedido']);
$nit = trim($_POST['nit_cliente']);
$razon = trim($_POST['razon_social']);

// Obtener el total del pedido
$stmt_total = $conexion->prepare("SELECT total FROM pedido WHERE id_pedido = ?");
$stmt_total->bind_param("i", $id_pedido);
$stmt_total->execute();
$resultado = $stmt_total->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode(['error' => 'Pedido no encontrado.']);
    exit;
}

$row = $resultado->fetch_assoc();
$total = $row['total'];
$stmt_total->close();

// Insertar en la tabla factura
$stmt_insertar = $conexion->prepare("INSERT INTO factura (id_pedido, fecha, nit_cliente, razon_social, total) VALUES (?, NOW(), ?, ?, ?)");
$stmt_insertar->bind_param('issd', $id_pedido, $nit, $razon, $total);

if (!$stmt_insertar->execute()) {
    echo "Error al generar factura: " . $stmt_insertar->error;
    exit;
}
$stmt_insertar->close();

// Obtener detalle del pedido desde la BD
$stmt_detalles = $conexion->prepare("
    SELECT p.nombre, dp.cantidad, dp.precio_unitario, dp.subtotal
    FROM detalle_pedido dp
    JOIN producto p ON dp.id_producto = p.id_producto
    WHERE dp.id_pedido = ?
");

if (!$stmt_detalles) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt_detalles->bind_param("i", $id_pedido);
$stmt_detalles->execute();
$resultado_detalle = $stmt_detalles->get_result();

$productos = [];
while ($fila = $resultado_detalle->fetch_assoc()) {
    $productos[] = $fila;
}
$stmt_detalles->close();
$conexion->close();

// ==================== PDF ====================
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// ENCABEZADO
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 10, 'Pollos Palmito - FACTURA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, 'Av. Principal, Santa Cruz - Bolivia', 0, 1, 'C');
$pdf->Cell(0, 8, 'Tel: 123-456-789 | www.pollospalmito.com', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(8);

// DATOS DEL CLIENTE
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Datos del Cliente', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 8, 'Pedido N°: ' . $id_pedido, 0, 0);
$pdf->Cell(90, 8, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 1);
$pdf->Cell(100, 8, 'NIT Cliente: ' . $nit, 0, 0);
$pdf->Cell(90, 8, 'Razon Social: ' . $razon, 0, 1);
$pdf->Ln(5);

// DETALLE DE PRODUCTOS
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 10, 'Detalle de Pedido', 0, 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(90, 8, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Precio Unit.', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Subtotal', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);

foreach ($productos as $prod) {
    $pdf->Cell(90, 8, $prod['nombre'], 1);
    $pdf->Cell(30, 8, $prod['cantidad'], 1, 0, 'C');
    $pdf->Cell(35, 8, 'Bs ' . number_format($prod['precio_unitario'], 2), 1, 0, 'R');
    $pdf->Cell(35, 8, 'Bs ' . number_format($prod['subtotal'], 2), 1, 1, 'R');
}

$pdf->Ln(5);

// TOTAL
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(155, 8, 'TOTAL:', 1, 0, 'R', true);
$pdf->Cell(35, 8, 'Bs ' . number_format($total, 2), 1, 1, 'R', true);

// PIE DE PÁGINA
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 8, 'Gracias por su compra en Pollos Palmito', 0, 1, 'C');
$pdf->Cell(0, 8, 'Factura generada electrónicamente - No requiere firma.', 0, 1, 'C');

// GENERAR PDF
$pdf->Output('D', 'factura_' . $id_pedido . '.pdf');

exit;



?>
