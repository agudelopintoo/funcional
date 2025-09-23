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
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($nombre === '' || $apellido === '' || $tipo_documento === '' || $documento === '' || $telefono === '') {
        $errors[] = "Todos los campos son obligatorios.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email inválido.";
    }
    if (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener mínimo 6 caracteres.";
    }
    if ($password !== $password2) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $errors[] = "Ya existe un usuario registrado con ese correo.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("
                INSERT INTO usuarios (nombre, apellido, tipo_documento, documento, telefono, fecha_registro, estado, email, password_hash)
                VALUES (:nombre, :apellido, :tipo_documento, :documento, :telefono, NOW(), 'activo', :email, :password_hash)
            ");
            $insert->execute([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'tipo_documento' => $tipo_documento,
                'documento' => $documento,
                'telefono' => $telefono,
                'email' => $email,
                'password_hash' => $password_hash
            ]);

            $user_id = $pdo->lastInsertId();
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_nombre'] = $nombre;
            header('Location: index.php');
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
</head>
<body>
<h2>Crear cuenta</h2>

<?php if (!empty($errors)): ?>
  <div style="color:red;">
    <?php foreach($errors as $e) echo "<p>".htmlspecialchars($e)."</p>"; ?>
  </div>
<?php endif; ?>

<form method="post" action="">
  <label>Nombre:<br><input type="text" name="nombre" required></label><br><br>
  <label>Apellido:<br><input type="text" name="apellido" required></label><br><br>
  <label>Tipo de documento:<br>
    <select name="tipo_documento" required>
      <option value="">Seleccione...</option>
      <option value="CC">Cédula de ciudadanía</option>
      <option value="TI">Tarjeta de identidad</option>
      <option value="CE">Cédula de extranjería</option>
      <option value="PEP">PEP</option>
    </select>
  </label><br><br>
  <label>Número de documento:<br><input type="text" name="documento" required></label><br><br>
  <label>Teléfono:<br><input type="text" name="telefono" required></label><br><br>
  <label>Email:<br><input type="email" name="email" required></label><br><br>
  <label>Contraseña:<br><input type="password" name="password" required></label><br><br>
  <label>Repetir contraseña:<br><input type="password" name="password2" required></label><br><br>
  <button type="submit">Registrar</button>
</form>

<p><a href="login.php">¿Ya tienes cuenta? Inicia sesión</a></p>
</body>
</html>
