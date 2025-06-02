<?php
// caja.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Caja de Ventas</title>
  <link rel="stylesheet" href="assets/css/productos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <header class="header">
    <div class="usuario">
      <i class="fa-solid fa-user fa-xl"></i>
      <span>CAJA & VENTAS</span>
    </div>
    <div class="acciones-superiores">
      <button class="boton-superior" onclick="cambiarTipo('Pollo')">CHIKEN</button>
      <button class="boton-superior" onclick="cambiarTipo('Bebida')">BEBIDAS</button>
      <button class="boton-superior" onclick="cambiarTipo('Extra')">EXTRAS</button>
      <button class="boton-superior" onclick="guardarPedido()">TERMINAR</button>
    </div>
  </header>

  <main class="contenedor-productos" id="contenedor-productos">
    <!-- Cada producto -->
    <div class="producto">
      <img src="assets/imagenes/cuartopollo.png" alt="Cuarto Pollo">
      <h3>CUARTO POLLO</h3>
      <p class="precio">Bs.30</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/mediopollo.png" alt="Medio Pollo">
      <h3>MEDIO POLLO</h3>
      <p class="precio">Bs.51</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/comboqueen.png" alt="Combo Queen">
      <h3>COMBO QUEEN</h3>
      <p class="precio">Bs.36</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/comboking.png" alt="Combo King">
      <h3>COMBO KING</h3>
      <p class="precio">Bs.57</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/solocuarto.png" alt="solo cuarto">
      <h3>SOLO CUARTO</h3>
      <p class="precio">Bs.30</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/solomedio.png" alt="solo medio">
      <h3>SOLO MEDIO</h3>
      <p class="precio">Bs.36</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div> <!-- Productos dinámicos aquí -->
  </main>

  <footer>
    <button class="cerrar-caja" onclick="guardarPedido()">CERRAR CAJA</button>
  </footer>

  <script src="scripts.js"></script>
</body>
</html>
