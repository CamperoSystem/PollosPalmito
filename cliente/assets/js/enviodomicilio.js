const carrito = {};

document.querySelectorAll('.producto').forEach(p => {
    const id = p.dataset.id;
    const precio = parseFloat(p.dataset.precio);
    carrito[id] = { cantidad: 0, precio: precio };

    p.querySelector('.mas').addEventListener('click', () => {
        carrito[id].cantidad++;
        p.querySelector('.cantidad').innerText = carrito[id].cantidad;
        actualizarResumen();
    });

    p.querySelector('.menos').addEventListener('click', () => {
        if (carrito[id].cantidad > 0) {
            carrito[id].cantidad--;
            p.querySelector('.cantidad').innerText = carrito[id].cantidad;
            actualizarResumen();
        }
    });
});

function actualizarResumen() {
    let productos = [], cantidades = [], precios = [], total = 0;

    for (let id in carrito) {
        if (carrito[id].cantidad > 0) {
            productos.push(id);
            cantidades.push(carrito[id].cantidad);
            precios.push(carrito[id].precio);
            total += carrito[id].cantidad * carrito[id].precio;
        }
    }

    total += 15;

    document.getElementById("productos").value = JSON.stringify(productos);
    document.getElementById("cantidades").value = JSON.stringify(cantidades);
    document.getElementById("precios").value = JSON.stringify(precios);

    new QRious({
        element: document.getElementById("codigoQR"),
        size: 200,
        value: "Total a pagar: Bs " + total.toFixed(2)
    });

    document.getElementById("detalleCosto").innerHTML = `
        <p>Costo de envío: <strong>Bs 15.00</strong></p>
        <p>Total a pagar: <strong>Bs ${total.toFixed(2)}</strong></p>
    `;
}

function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const ubicacionTexto = lat + ", " + lon;
            document.getElementById("ubicacion").value = ubicacionTexto;

            const enlace = `https://www.google.com/maps/@${lat},${lon},18z`;
            document.getElementById("linkGPS").innerHTML = `<a href="${enlace}" target="_blank">Ver ubicación en Google Maps (satélite)</a>`;
        }, function() {
            alert("No se pudo obtener la ubicación.");
        });
    } else {
        alert("Tu navegador no soporta geolocalización.");
    }
}

function cancelarPedido() {
    if (confirm("¿Seguro que deseas cancelar el pedido?")) {
        document.querySelector("form").reset();
        for (let id in carrito) {
            carrito[id].cantidad = 0;
        }
        document.querySelectorAll(".cantidad").forEach(el => el.innerText = "0");
        document.getElementById("detalleCosto").innerHTML = "";
        document.getElementById("productos").value = "";
        document.getElementById("cantidades").value = "";
        document.getElementById("precios").value = "";
        document.getElementById("codigoQR").getContext("2d").clearRect(0, 0, 200, 200);
        document.getElementById("linkGPS").innerHTML = "";
    }
}

function validarEnvio() {
    let totalCantidad = 0;
    for (let id in carrito) {
        totalCantidad += carrito[id].cantidad;
    }

    if (totalCantidad === 0) {
        alert("Selecciona al menos un producto.");
        return false;
    }

    const ahora = new Date();
    const hora = ahora.getHours();

    if (hora < 8 || hora >= 23) {
        alert("Los pedidos solo se pueden realizar entre las 14:00 y las 22:00.");
        return false;
    }

    return true;
}
