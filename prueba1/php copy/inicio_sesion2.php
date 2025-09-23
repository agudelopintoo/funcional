<?php
session_start();
require_once __DIR__ . '/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['contrasena'] ?? ''; // manteniendo el mismo nombre que en registro

    // Validaciones
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Correo inválido.";
    }
    if ($password === '') {
        $errors[] = "La contraseña es obligatoria.";
    }

    if (empty($errors)) {
        // Buscar usuario
        $stmt = $pdo->prepare("SELECT id_usuario, nombre, password_hash FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Después de verificar email y contraseña
$_SESSION['user_id'] = $user['id_usuario'];
$_SESSION['user_nombre'] = $user['nombre'];

// Consultar el rol del usuario
$stmt = $pdo->prepare("
    SELECT r.nombre 
    FROM roles r
    JOIN uso_roles ur ON r.id_rol = ur.id_rol
    WHERE ur.id_usuario = ?
");
$stmt->execute([$user['id_usuario']]);
$rol = $stmt->fetchColumn();

// Guardar en sesión
$_SESSION['user_role'] = $rol;


        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_nombre'] = $user['nombre'];

            // Obtener rol del usuario
            $stmt = $pdo->prepare("
                SELECT r.nombre 
                FROM roles r
                JOIN uso_roles ur ON ur.id_rol = r.id_rol
                WHERE ur.id_usuario = :id
                LIMIT 1
            ");
            $stmt->execute(['id' => $user['id_usuario']]);
            $rol = $stmt->fetchColumn();
            $_SESSION['user_role'] = $rol ?: 'Cliente'; // rol por defecto

            // Redirigir al inicio
            header('Location: pagina_principal.php');
            exit;
        } else {
            $errors[] = "Correo o contraseña incorrectos.";
        }
    }
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/inicio_sesion.css">
</head>
<body>

<form method="post" class="formulario">
    <h2 class="titulo">Iniciar Sesión</h2>

    <?php if (!empty($errors)): ?>
        <div style="color:red;">
            <?php foreach($errors as $e) echo "<p>".htmlspecialchars($e)."</p>"; ?>
        </div>
    <?php endif; ?>
    <label for="email">Correo electrónico</label>
    <input type="email" name="email" id="email" required>
    <label for="contrasena">Contraseña</label>
    <input type="password" name="contrasena" id="contrasena" required><br>
    <input type="submit" value="Entrar"><br>
    <center><a class="boton1" href="inicio_sesion.php">Crear cuenta</a></center>
</form>
</body>
</html>
