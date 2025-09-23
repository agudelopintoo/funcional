<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/carrito.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Mansoku</h1>
            </div>
            <ul class="nav-links">
                <li><a href="inde.php">Inicio</a></li>
            </ul>
            <div class="cart">
            </div>
        </nav>
    </header>

    <section class="carrito">
        <h1>carrito</h1>
        <table class="tabla-carrito">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody id="cart-body">
                <tr>
                    <td class="producto">
                        <img src="../imagenes/mancuerna.webp" alt="Producto 1">
                        <span>Mancuernas ajustables</span>
                    </td>
                    <td class="price">$320.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/barra.jpg" alt="Producto 2">
                        <span>Barras olímpicas</span>
                    </td>
                    <td class="price">$350.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/discos.jpg" alt="Producto 3">
                        <span>Discos de peso</span>
                    </td>
                    <td class="price">$280.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/bancopesas.webp" alt="Producto 4">
                        <span>Banco de pesas</span>
                    </td>
                    <td class="price">$380.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/Kettlebells.webp" alt="Producto 5">
                        <span>Kettlebells</span>
                    </td>
                    <td class="price">$365.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/cuerda.webp" alt="Producto 6">
                        <span>Cuerda para saltar</span>
                    </td>
                    <td class="price">$410.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/bandas.webp" alt="Producto 7">
                        <span>Bandas elásticas de resistencia</span>
                    </td>
                    <td class="price">$380.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/esterilla.webp" alt="Producto 8">
                        <span>Esterilla de yoga o entrenamiento</span>
                    </td>
                    <td class="price">$220.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/Ruedaabdominales.webp" alt="Producto 9">
                        <span>Rueda para abdominales</span>
                    </td>
                    <td class="price">$280.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/maquinapolea.jpg" alt="Producto 10">
                        <span>Máquina de poleas</span>
                    </td>
                    <td class="price">$410.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/chaleco.jpg" alt="Producto 11">
                        <span>Chaleco lastrado</span>
                    </td>
                    <td class="price">$280.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/guantes.webp" alt="Producto 12">
                        <span>Guantes de entrenamiento</span>
                    </td>
                    <td class="price">$410.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td class="producto">
                        <img src="../imagenes/gym.webp" alt="Producto 13">
                        <span>Botella shaker para proteína</span>
                    </td>
                    <td class="price">$350.000</td>
                    <td>
                        <input type="number" value="0" min="1" class="quantity">
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="resumen">
            <h2>Total del Pedido</h2>
            <p>Total: <span id="total">$130.000</span></p>
            <button class="checkout" id="finalizar-compra">Finalizar Compra</button>
        </div>

        <div id="checkout-section" style="display: none;">
            <h2>Información de Compra</h2>
            <form id="checkout-form">
                <div class="input-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" required>
                </div>
                <div class="input-group">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" required>
                </div>
                <div class="input-group">
                    <label for="metodo-pago">Método de Pago:</label>
                    <select id="metodo-pago" required>
                        <option value="tarjeta">Tarjeta de Crédito</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia Bancaria</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="info-pago">Direccion de residencia:</label>
                    <textarea id="info-pago" rows="3" placeholder="Especifica detalles del método de pago..."></textarea>
                </div>
                <button type="submit">Confirmar Compra</button>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mi Tienda Online. Todos los derechos reservados.</p>
    </footer>

    <script>
        function updateTotal() {
            const rows = document.querySelectorAll('#cart-body tr');
            let total = 0;

            rows.forEach(row => {
                const price = parseInt(row.querySelector('.price').textContent.replace(/\./g, '').replace('$', ''));
                const quantity = parseInt(row.querySelector('.quantity').value);
                total += price * quantity;
            });

            document.getElementById('total').textContent = `$${total.toLocaleString()}`;
        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('eliminar')) {
                const row = event.target.closest('tr');
                row.remove();
                updateTotal();
            }
        });

        document.addEventListener('input', function(event) {
            if (event.target.classList.contains('quantity')) {
                updateTotal();
            }
        });

        document.getElementById('finalizar-compra').addEventListener('click', function() {
            document.getElementById('checkout-section').style.display = 'block';
        });

        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Compra confirmada. ¡Gracias por tu compra!');
            document.getElementById('checkout-section').style.display = 'none';
        });

        updateTotal();
    </script>
</body>

</html>