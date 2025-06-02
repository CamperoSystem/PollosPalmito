<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Factura</title>
    <link rel="stylesheet" href="assets/css/factura.css">
</head>
<body>

<form method="POST" action="controlador/generar_factura.php" class="form-factura">
    <input type="hidden" name="id_pedido" value="<?php echo htmlspecialchars($_GET['id_pedido']); ?>">

    <div class="form-group">
        <label for="nit_cliente">NIT del Cliente</label>
        <input type="text" id="nit_cliente" name="nit_cliente" placeholder="Ej: 12345678" required>
    </div>

    <div class="form-group">
        <label for="razon_social">Razón Social</label>
        <input type="text" id="razon_social" name="razon_social" placeholder="Ej: Empresa XYZ SRL" required>
    </div>

    <button type="submit" class="btn-facturar">Generar Factura</button>
    <button type="button" onclick="history.back()" class="btn-volver">Volver Atrás</button>


</form>

</body>
</html>
