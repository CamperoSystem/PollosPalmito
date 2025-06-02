<?php
// Puedes manejar lógica PHP aquí si lo necesitas
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pollos Palmito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../cliente/assets/css/index.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../cliente/assets/imagenes/logo.jpeg" alt="Logo" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#menu">Menú</a></li>
        <li class="nav-item"><a class="nav-link" href="#historia">Nuestra Historia</a></li>
        <li class="nav-item"><a class="nav-link" href="#trabaja">Trabaja con Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Carrusel -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../cliente/assets/imagenes/carru1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../cliente/assets/imagenes/carru2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../cliente/assets/imagenes/carru3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Menú -->
<section id="menu" class="py-5 text-center">
  <div class="container">
    <h2>Menú</h2>
    <p>Conoce nuestras especialidades con el mejor pollo frito.</p>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
      <div class="col">
        <div class="card">
          <img src="../cliente/assets/imagenes/arroz.png" class="card-img-top" alt="Arroz">
          <div class="card-body">
            <h5 class="card-title">Arroz Especial</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="../cliente/assets/imagenes/comboking.png" class="card-img-top" alt="Combo King">
          <div class="card-body">
            <h5 class="card-title">Combo King</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="../cliente/assets/imagenes/comboqueen.png" class="card-img-top" alt="Combo Queen">
          <div class="card-body">
            <h5 class="card-title">Combo Queen</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Historia -->
<section id="historia" class="section-image">
  <img src="../cliente/assets/imagenes/Nuestrahistoria.png" alt="Nuestra Historia">
  <div class="overlay-text">Nuestra Historia</div>
</section>

<!-- Trabaja con nosotros -->
<section id="trabaja" class="section-image">
  <img src="../cliente/assets/imagenes/trabajaconnosotros.png" alt="Trabaja con Nosotros">
  <div class="overlay-text">Trabaja con Nosotros</div>
</section>

<!-- Contacto -->
<footer class="footer" id="contacto">
  <div class="container text-center text-md-start">
    <div class="row">
      <div class="col-md-4">
        <h5>Pollos Palmito</h5>
        <p>&copy; 2025 Todos los derechos reservados.</p>
      </div>
      <div class="col-md-4">
        <p><strong>Call Center:</strong> <a href="tel:+59179705986">+591 79706986</a></p>
        <p><strong>Email:</strong> <a href="mailto:contacto@pollospalmito.com">contacto@pollospalmito.com</a></p>
      </div>
      <div class="col-md-4">
        <p>Síguenos:</p>
        <a href="https://www.facebook.com/pollospalmito" target="_blank"><i class="fab fa-facebook-f me-2"></i></a>
        <a href="https://www.instagram.com/pollospalmito" target="_blank"><i class="fab fa-instagram me-2"></i></a>
        <a href="https://wa.me/59175573110" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>
</footer>

<!-- Botón de pedido flotante -->
<button class="fixed-button" onclick="mostrarOpciones()">🛒</button>

<div id="opcionesPedido" class="opciones-pedido">
  <p><strong>¿Cómo deseas tu pedido?</strong></p>
  <button onclick="redirigir('domicilio')" class="opcion-btn">🚚 Enviar a domicilio</button>
  <button onclick="redirigir('local')" class="opcion-btn">🏬 Recoger en local</button>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../cliente/assets/js/index.js"></script>
</body>
</html>
