<?php
session_start();
require_once __DIR__ . '/db.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $tipo_documento = trim($_POST['tipo_documento'] ?? '');
    $documento = trim($_POST['documento'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $fecha_registro = $_POST['fecha_registro'] ?? date('Y-m-d');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['contrasena'] ?? '';

    // Validaciones
    if ($nombre === '' || $apellido === '' || $tipo_documento === '' || $documento === '' || $telefono === '') {
        $errors[] = "Todos los campos son obligatorios.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email inválido.";
    }
    if (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener mínimo 6 caracteres.";
    }

    if (empty($errors)) {
        // Validar que el correo no exista
        $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $errors[] = "Ya existe un usuario registrado con ese correo.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = $pdo->prepare("
                INSERT INTO usuarios (nombre, apellido, tipo_documento, documento, telefono, fecha_registro, estado, email, password_hash)
                VALUES (:nombre, :apellido, :tipo_documento, :documento, :telefono, :fecha_registro, 'activo', :email, :password_hash)
            ");
            $insert->execute([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'tipo_documento' => $tipo_documento,
                'documento' => $documento,
                'telefono' => $telefono,
                'fecha_registro' => $fecha_registro,
                'email' => $email,
                'password_hash' => $password_hash
            ]);

            $user_id = $pdo->lastInsertId();
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_nombre'] = $nombre;

            header('Location: inicio_sesion2.php');
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registro de usuario</title>
  <link rel="stylesheet" href="../css/inicio_sesion.css">
</head>
<body>

<?php if (!empty($errors)): ?>
  <div style="color:red;">
    <?php foreach($errors as $e) echo "<p>".htmlspecialchars($e)."</p>"; ?>
  </div>
<?php endif; ?>

<form action="" method="post" class="formulario">
    <h2 class="titulo">Crear usuario</h2>
    <label for="nombre">Nombres</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="apellido">Apellidos</label>
    <input type="text" name="apellido" id="apellido" required>
    <label for="tipo_documento">Tipo de documento</label>
    <select name="tipo_documento" id="tipo_documento" required>
        <option value=""></option>
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
    <div class="botones">
        <a class="boton1" href="inicio_sesion2.php">Iniciar sesión</a>
        <a class="boton1" href="pagina_principal.php">Inicio</a>
    </div>
</form>
</body>
</html>
