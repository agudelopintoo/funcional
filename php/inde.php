<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mansoku</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>

    <p>administrador</p>

<header>
    <div class="menu container">
        <nav class="navbar">
        <div class="menu-1">
            <ul>
            <li><a class="btn-11" href="sesionpagina2.php">iniciar sesion</a></li>
            </ul>
        </div>
        <img class="logo-2" src="" alt="">
        <div class="menu-2">
            <ul>
            <li><a class="btn-11" href="carrito.php">car</a></li>
            </ul>
            <div class="socials"></div>
        </div>
        </nav>
    </div>

    <div class="header-content container">
        <div class="swiper mySwiper-1">

        <div class="slider">
            <div class="slider-txt">
            <h1>Apolo GYM</h1>
            <p>En nuestra página web encontrarás información detallada sobre cómo iniciar tu propio emprendimiento, desde la validación de la idea de negocio hasta la creación de un modelo sostenible, incluyendo ejemplos prácticos, casos reales y asesoramiento paso a paso.</p>
            <div class="botones">
                <a href="catalogo.php" class="btn-1">servicios</a>
            </div>
        </div>

        <div class="carousel">
            <div class="slides" id="slides">
                <div class="slide"><img src="../imagenes/imgym1.jpeg"></div>
                <div class="slide"><img src="../imagenes/imgym2.webp"></div>
                <div class="slide"><img src="../imagenes/imgym3.avif"></div>
            </div>
            <div class="nav">
                <button onclick="prevSlide()">⟨</button>
                <button onclick="nextSlide()">⟩</button>
            </div>
        </div>

        <div class="swiper-pagination"></div>
        </div>
    </div>
    </div>
</header>

<main class="productos"></main>

<section class="info container">
    <div class="info-img">
        <img src="../imagenes/apologym.jpeg" alt="">
    </div>

    <div class="info-txt" id="boton1">
        <h2>informacion</h2>
        <p>Ofrecemos un portafolio completo de servicios para emprendedores, donde podrás conocer y contratar mentorías personalizadas, capacitaciones virtuales, diseño de marca, y asesoría legal y financiera, todo pensado para ayudarte a crecer con una base sólida.</p>
        <a href="terminos y condiciones.php" class="btn-1">Mas Información</a>
    </div>
</section>

<section class="horario">
    <div class="horario-info container">
        <h2>horario</h2>
    <div class="horario-txt">
        <div class="txt">
            <h4>direccion</h4>
            <p>CL 32 Bsur #19-34</p>
            <p>transversal 18jbis#71-14 sur</p>
        </div>
        <div class="txt">
            <h4>horario</h4>
            <p>lunes a viernes : 8am a 9pm</p>
            <p>sabado y domingo : 10am y 6pm</p>
        </div>
        <div class="txt">
            <h4>telefono</h4>
            <p>3183919003</p>
            <p>3125656485</p>
        </div>
        <div class="txt">
            <h4>Redes Sociales</h4>
        <div class="socials">
            <a href=""><div class="social"><img class="imagenes" src="" alt=""></div></a>
            <a href=""><div class="social"><img class="imagenes" src="" alt=""></div></a>
            <a href=""><div class="social"><img class="imagenes" src="" alt=""></div></a>
        </div>
        </div>
    </div>
    </div>
</section>

<section>
    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254508.51141489705!2d-74.107807!3d4.64829755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2zQm9nb3TDoQ!5e0!3m2!1ses-419!2sco!4v1728487560454!5m2!1ses-419!2sco" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<footer class="footer container">
    <img class="logo-2" src="Captura de pantalla 2024-10-09 145322.png" alt="">
    <div class="links">
        <h4>servicio al cliente</h4>
    <ul>
        <li><a href="#">3183919003</a></li>
        <li><a href="#">3125656485</a></li>
        <li><a href="#">pipelonxd1993@gmail.com</a></li>
        <li><a href="#">elian.alexpollo@gmail.com</a></li>
    </ul>
    </div>
    <div class="links">
        <h4>contactos</h4>
    <ul>
        <li><a href="#">3183919003</a></li>
        <li><a href="#">3125656485</a></li>
        <li><a href="#">3004519631</a></li>
        <li><a href="#">3452232178</a></li>
    </ul>
    </div>
    <div class="links">
        <h4><a href="informacion.html">informacion</a></h4>
    <ul>
        <li><a href="#">microempresa</a></li>
        <li><a href="#">domicilios</a></li>
        <li><a href="#">servicios</a></li>
        <li><a href="#">ayuda</a></li>
    </ul>
    </div>
    <div class="links">
    <h4>conocenos</h4>
    <div class="socials">
        <a href=""><div class="social"><img src="s1.svg" alt=""></div></a>
        <a href=""><div class="social"><img src="s2.svg" alt=""></div></a>
        <a href=""><div class="social"><img src="s3.svg" alt=""></div></a>
    </div>
    </div>
</footer>

<script>
    const slides = document.getElementById('slides');
    const totalSlides = slides.children.length;
    let index = 0;

    function showSlide(i) {
        index = (i + totalSlides) % totalSlides;
        slides.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
        showSlide(index + 1);
    }

    function prevSlide() {
        showSlide(index - 1);
    }


</script>

    <script src="mansoku.js"></script>

</body>
</html>
