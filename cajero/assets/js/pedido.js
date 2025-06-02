document.addEventListener('DOMContentLoaded', () => {
    let carrito = {};
    const listaCarrito = document.getElementById('lista-carrito');
    const carritoFlotante = document.getElementById('carrito-flotante');
    const btnMinimizar = document.getElementById('minimizar-carrito');

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

        fetch(window.location.href, {
            method: 'POST',
            body: JSON.stringify(datosPedido),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
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
    const tipoEntrega = document.getElementById('tipo_entrega').value;
    document.getElementById("metodo_pago").addEventListener("change", function () {
        const metodo = this.value;
        const qrContainer = document.getElementById("qr-container");
        const qrImage = document.getElementById("qr-image");

        if (metodo === "qr") {
            const textoQR = "Pago pedido #" + new Date().getTime();
            qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(textoQR)}`;
            qrContainer.style.display = "block";
        } else {
            qrContainer.style.display = "none";
        }
    });

    // DRAG & DROP
    let offsetX, offsetY, isDragging = false;

    carritoFlotante.addEventListener('mousedown', (e) => {
        isDragging = true;
        offsetX = e.clientX - carritoFlotante.getBoundingClientRect().left;
        offsetY = e.clientY - carritoFlotante.getBoundingClientRect().top;
    });

    document.addEventListener('mousemove', (e) => {
        if (isDragging) {
            carritoFlotante.style.left = (e.clientX - offsetX) + 'px';
            carritoFlotante.style.top = (e.clientY - offsetY) + 'px';
            carritoFlotante.style.right = 'auto';
            carritoFlotante.style.bottom = 'auto';
        }
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
    });

    // BOTÓN MINIMIZAR
    btnMinimizar.addEventListener('click', () => {
        const visible = listaCarrito.style.display !== 'none';
        listaCarrito.style.display = visible ? 'none' : 'block';
        document.getElementById('metodo_pago').style.display = visible ? 'none' : 'block';
        document.getElementById('finalizar').style.display = visible ? 'none' : 'inline-block';
        document.getElementById('cancelar').style.display = visible ? 'none' : 'inline-block';
        btnMinimizar.textContent = visible ? '+' : '–';
    });
});
