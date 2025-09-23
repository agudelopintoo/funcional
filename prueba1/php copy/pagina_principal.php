<?php
session_start();

// Redirigir si no hay usuario logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: inicio_sesion2.php');
    exit;
}

// Asignar rol seguro por defecto
$rol = $_SESSION['user_role'] ?? 'Cliente';
$nombre_usuario = $_SESSION['user_nombre'] ?? 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaEmprende</title>
    <link rel="stylesheet" href="../css/pagina_principal.css">
</head>
<body>

<header>
    <div class="div1">
        <img class="imagen1" src="../imagenes/bogarte.jpeg" alt="Logo">
        <h1 class="logo">ConectaEmprende</h1>
    </div>

    <div class="usuario">
        <p>Bienvenido, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong> 👋</p>
    </div>

    <nav>
        <ul>
            <li><a href="inicio_sesion.php">Inicio</a></li>
            <li><a href="#nosotros">Sobre Nosotros</a></li>
            <li><a href="#servicios">Emprendimientos</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#ubicacion">Ubicación</a></li>

<?php if ($rol === 'Administrador'): ?>
    <li><a href="lista_usuarios.php">Gestionar Usuarios</a></li>
<?php endif; ?>

            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </nav>
</header>

<section id="inicio" class="banner">
    <h2>Apoyamos a emprendedores conectándolos contigo</h2>
</section>

<section id="nosotros">
    <h2>Sobre Nosotros</h2>
    <p class="texto1">Somos una plataforma dedicada a visibilizar y apoyar emprendimientos, facilitando su crecimiento mediante el acceso digital y la conexión directa con clientes.</p>
</section>

<section id="servicios">
    <h2>Emprendimientos</h2>
    <div class="emprendimientos">
        <div class="card">
            <img src="../imagenes/modalunicool.jpeg" alt="Moda Lunuicool">
            <h3>Moda Lunuicool</h3>
            <a href="modalunicol.php" target="_blank">Visitar sitio</a>
        </div>
        <div class="card">
            <img src="../imagenes/apologym.jpeg" alt="Apolo Gym">
            <h3>Apolo Gym</h3>
            <a href="inde.php" target="_blank">Visitar sitio</a>
        </div>
        <div class="card">
            <img src="../imagenes/empresa3.webp" alt="Artesanías Luna">
            <h3>Artesanías Luna</h3>
            <a href="404.php" target="_blank">Visitar sitio</a>
        </div>
    </div>
</section>

<section id="contacto">
    <h2>Contacto</h2>
    <form>
        <input type="text" placeholder="Nombre">
        <input type="email" placeholder="Correo">
        <textarea placeholder="Mensaje"></textarea>
        <button type="submit">Enviar</button>
    </form>
</section>

<section id="ubicacion">
    <h2>¿Dónde nos ubicamos?</h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254508.51141489705!2d-74.107807!3d4.64829755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2zQm9nb3TDoQ!5e0!3m2!1ses-419!2sco!4v1728487560454!5m2!1ses-419!2sco" width="100%" height="300" style="border:0;" allowfullscreen></iframe>
</section>

<footer>
    <p>© 2025 ConectaEmprende</p>
    <div class="redes">
        <a href="#">Facebook</a> |
        <a href="#">Instagram</a> |
        <a href="#">Twitter/X</a>
    </div>
</footer>

</body>
</html>
