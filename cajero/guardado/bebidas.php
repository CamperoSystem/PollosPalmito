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
       <a href="extras.php" class="boton-superior">TERMINAR</a>
     <a href="extras.php" class="boton-superior">EXTRAS</a>
     <a href="bebidas.php" class="boton-superior">BEBIDAS</a>
     <a href="ventas.php" class="boton-superior">CHIKEN</a>
    </div>
  </header>

  <main class="contenedor-productos">
    <!-- Cada producto -->
    <div class="producto">
      <img src="assets/imagenes/jugofrutilla.png" alt="Jugo de frutilla">
      <h3>JUGO DE FRUTILLA</h3>
      <p class="precio">Bs.10</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/jugomango.png" alt="Jugo de mango">
      <h3>JUGO DE MANGO</h3>
      <p class="precio">Bs.51</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    <div class="producto">
      <img src="assets/imagenes/jugomaracuya.png" alt="Jugo de mango">
      <h3>JUGO DE MANGO</h3>
      <p class="precio">Bs.16</p>
      <div class="cantidad">
        <button onclick="restar(this)">-</button>
        <span class="contador">0</span>
        <button onclick="sumar(this)">+</button>
      </div>
    </div>

    
  </main>

  <footer>
    <button class="cerrar-caja">CERRAR CAJA</button>
  </footer>

  <script>
    function sumar(btn) {
      const contador = btn.parentElement.querySelector('.contador');
      contador.textContent = parseInt(contador.textContent) + 1;
    }

    function restar(btn) {
      const contador = btn.parentElement.querySelector('.contador');
      let valor = parseInt(contador.textContent);
      if (valor > 0) contador.textContent = valor - 1;
    }
  </script>

</body>
</html>
