<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Crear Usuario</title>
    <link rel="stylesheet" href="../css/inicio_sesion.css">
</head>
<body>
    <form action="" method="post" class="formulario">
        <h2 class="titulo">Crear usuario</h2>
        <label for="nombre">Nombres</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="apellido">Apellidos</label>
        <input type="text" name="apellido" id="apellido" required>
        <label for="tipo_documento">Tipo de documento</label>
        <select name="tipo_documento" id="tipo_documento" required>
            <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
            <option value="Cédula extranjera">Cédula extranjera</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>        
        <label for="documento">Número de documento</label>
        <input type="text" name="documento" id="documento" required>
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" required> 
        <label for="fecha_registro">Fecha de registro</label>
        <input type="date" name="fecha_registro" id="fecha_registro" required>
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" required>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <input type="submit" value="Enviar"><br><br>
        <div>
            <a class="boton1" href="inicio_sesion2.php">Iniciar sesión</a>
            <a class="boton1" href="pagina_principal.php">Inicio</a>
        </div>
    </form>
</body>
</html>
