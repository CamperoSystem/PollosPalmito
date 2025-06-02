# 🍗 Pollos Palmito

**Pollos Palmito** es un sistema web diseñado para la gestión integral de un restaurante de comida rápida. Incluye un completo panel de administración para gestionar usuarios, productos, pedidos y reportes de ventas.

---

## 🛠️ Tecnologías Usadas

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP 8.x
- **Base de Datos:** MySQL (XAMPP)
- **Servidor:** Apache
- **Control de versiones:** Git y GitHub

---

## 🧩 Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/CamperoSystem/PollosPalmito.git
Copia la carpeta en:

makefile
Copiar
Editar
C:\xampp\htdocs\PollosPalmito
Importa la base de datos:

Abre phpMyAdmin

Crea una base de datos llamada pollospalmito

Importa el archivo SQL: base_datos/pollospalmito.sql

Configura la conexión en tu archivo PHP:

php
Copiar
Editar
// Ejemplo de conexion.php
$conexion = new mysqli("localhost", "root", "", "pollospalmito");
▶️ Cómo ejecutar el sistema
Inicia Apache y MySQL desde el panel de XAMPP

Abre el navegador y accede a:

arduino
Copiar
Editar
http://localhost/PollosPalmito
📊 Panel de Administración
🔐 Login
Acceso con usuario y contraseña

🏠 Dashboard
Cards con resumen de:

Usuarios registrados

Productos activos

Pedidos realizados

Ingresos generados

Tabla de ingresos de los últimos 7 días

Gráfico de barras que muestra visualmente en qué días hubo más ventas

👥 Gestión de Usuarios
Listado de usuarios

Agregar nuevo usuario

Editar usuario existente

Eliminar usuario

📦 Gestión de Productos
Listado de productos

Agregar nuevo producto

Editar producto

Eliminar producto

📈 Gestión de Reportes
Ingresos diarios

Productos más vendidos

Reportes de ventas facturadas

👨‍💻 Autor(es)
Antoni Campero
GitHub: @CamperoSystem

