function mostrarOpciones() {
  const opciones = document.getElementById('opcionesPedido');
  opciones.style.display = opciones.style.display === 'none' ? 'block' : 'none';
}

function redirigir(opcion) {
  if (opcion === 'domicilio') {
    window.location.href = 'enviodomicilio.php';
  } else if (opcion === 'local') {
    window.location.href = 'recogerlocal.php';
  }
}
