document.addEventListener('DOMContentLoaded', () => {
    let carrito = {};

    document.querySelectorAll('.producto').forEach(p => {
        const id = p.dataset.id;

        p.querySelector('.mas').addEventListener('click', () => {
            carrito[id] = (carrito[id] || 0) + 1;
            p.querySelector('.cantidad').innerText = carrito[id];
        });

        p.querySelector('.menos').addEventListener('click', () => {
            if (carrito[id] > 0) {
                carrito[id]--;
                p.querySelector('.cantidad').innerText = carrito[id];
            }
        });
    });

    const finalizarBtn = document.getElementById('finalizar');
    if (finalizarBtn) {
        finalizarBtn.addEventListener('click', () => {
            console.log("Enviando carrito:", carrito);
            fetch('../controlador/procesar_pedido.php', {
    method: 'POST',
    body: JSON.stringify({ carrito: carrito }),
    headers: { 'Content-Type': 'application/json' }
})
.then(res => res.json())
.then(data => {
    console.log("Respuesta del servidor:", data); // 👈 Esto es importante
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
    } else {
        console.error("No se encontró el botón con id='finalizar'");
    }
});
