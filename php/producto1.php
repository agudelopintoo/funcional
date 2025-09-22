<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Ropa - MiTienda</title>
<link href="../css/modalunicool.css" rel="stylesheet">
</head>
<body>
<header>
    <a class="moda" href="modalunicol.php"><div><strong>MiTienda</strong></div></a>
    <nav>
        <a href="#banner">Inicio</a>
        <a href="#categorias">Categorías</a>
        <a href="#productos">Productos</a>
        <a href="#comentario">Comentar</a>
        <a href="#footer">Contacto</a>
        <a href="inicio_sesion2.php">Iniciar sesión</a>

    </nav>
    <div style="cursor:pointer;" onclick="toggleCart()">Carrito: <span id="cart-count">0</span></div>
</header>

<div class="banner" id="banner">
    <h2>¡Descuentos de hasta 50% por tiempo limitado!</h2>
    <button onclick="scrollToSection('productos')">Ver ofertas</button>
</div>

<div class="categorias" id="categorias">
    <h3>Categorías</h3>
    <a href="producto1.php"><div>Camisas</div></a>
    <a href="producto2.php"><div>Ropa</div></a>
    <a href="producto3.php"><div>Hogar</div></a>
    <a href="producto4.php"><div>Belleza</div></a>
</div>

<div class="productos" id="productos">
    <h3>Ropa</h3>
    <div class="item">
        <img src="../imagenes/c1.jpeg" alt="Camiseta básica" width="100%">
        <h4>Deadpool</h4>
        <p>$35000</p>
        <button onclick="addToCart('Deadpool', 35000)">Agregar al carrito</button>
    </div>
    <div class="item">
        <img src="../imagenes/c2.jpeg" alt="Jeans" width="100%">
        <h4>ACDC</h4>
        <p>$35000</p>
        <button onclick="addToCart('ACDC', 35000)">Agregar al carrito</button>
    </div>
    <div class="item">
        <img src="../imagenes/c3.jpeg" alt="Chaqueta" width="100%">
        <h4>Eren</h4>
        <p>$35000</p>
        <button onclick="addToCart('Eren', 35000)">Agregar al carrito</button>
    </div>
    <div class="item">
        <img src="../imagenes/c4.jpeg" alt="Vestido" width="100%">
        <h4>Megadeth</h4>
        <p>$35000</p>
        <button onclick="addToCart('megadeth', 35000)">Agregar al carrito</button>
    </div>
    <div class="item">
        <img src="../imagenes/c5.jpeg" alt="Vestido" width="100%">
        <h4>One Piece</h4>
        <p>$35000</p>
        <button onclick="addToCart('One Piece', 35000)">Agregar al carrito</button>
    </div>
</div>

<div class="boletin" id="comentario">
    <h4>Haz tu comentario</h4><br>
    <input type="text" id="text" placeholder="Tu correo electrónico">
    <button onclick="subscribe()">Comentar</button>
</div>

<footer id="footer">
    <div>
        <h4>Información de contacto</h4>
        <p>Email: contacto@mitienda.com</p>
        <p>Tel: 123-456-789</p>
    </div>
    <div>
        <h4>Enlaces rápidos</h4>
        <p><a href="#">Política de privacidad</a></p>
        <p><a href="#">Devoluciones</a></p>
    </div>
</footer>

<div id="cart-details">
    <h4>Carrito</h4>
    <div id="cart-items"></div>
    <div id="cart-total">Total: $0</div>
    <button id="pay-btn" onclick="pagar()">Pagar</button>
</div>

<script>
    let cart = [];

    window.onload = function () {
        const storedCart = localStorage.getItem("cart");
        if (storedCart) {
            cart = JSON.parse(storedCart);
        }
        document.getElementById("cart-count").textContent = cart.length;
        renderCart();
    };

    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    function addToCart(product, price) {
        const button = event.target;
        button.disabled = true;
        button.textContent = "Añadido ✔";
        setTimeout(() => {
            button.disabled = false;
            button.textContent = "Agregar al carrito";
        }, 1000);

        cart.push({ product, price });
        saveCart();
        document.getElementById("cart-count").textContent = cart.length;
        renderCart();
    }

    function renderCart() {
        const itemsContainer = document.getElementById("cart-items");
        const totalDisplay = document.getElementById("cart-total");
        itemsContainer.innerHTML = "";
        let total = 0;
        cart.forEach((item) => {
            total += item.price;
            const p = document.createElement("p");
            p.textContent = `• ${item.product} - $${item.price}`;
            itemsContainer.appendChild(p);
        });
        totalDisplay.textContent = `Total: $${total}`;
    }

    function toggleCart() {
        const cartBox = document.getElementById("cart-details");
        cartBox.style.display = cartBox.style.display === "none" || cartBox.style.display === "" ? "block" : "none";
    }

    function pagar() {
        if (cart.length === 0) {
            alert("El carrito está vacío.");
        } else {
            alert("Gracias por tu compra. Total pagado: $" + cart.reduce((acc, item) => acc + item.price, 0));
            cart = [];
            saveCart();
            document.getElementById("cart-count").textContent = 0;
            renderCart();
            toggleCart();
        }
    }

    function subscribe() {
        const email = document.getElementById('email').value;
        if (email.includes("@")) {
            alert("¡Gracias por suscribirte con " + email + "!");
            document.getElementById('email').value = '';
        } else {
            alert("Por favor, introduce un correo válido.");
        }
    }

    function scrollToSection(id) {
        const el = document.getElementById(id);
        if (el) {
            el.scrollIntoView({ behavior: "smooth" });
        }
    }
</script>
</body>
</html>