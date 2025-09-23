<?php
session_start();
require_once __DIR__ . '/db.php';

// Verificar que sea Administrador
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Administrador') {
    die("Acceso denegado");
}

// Verificar ID de usuario
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Usuario no especificado");
}

// Consultar usuario con su rol
$stmt = $pdo->prepare("
    SELECT u.id_usuario, u.nombre, u.email, r.id_rol, r.nombre AS rol
    FROM usuarios u
    JOIN uso_roles ur ON u.id_usuario = ur.id_usuario
    JOIN roles r ON ur.id_rol = r.id_rol
    WHERE u.id_usuario = ?
");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    die("Usuario no encontrado");
}

// Obtener todos los roles
$roles = $pdo->query("SELECT * FROM roles")->fetchAll();

// Guardar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $rol = $_POST['rol'];

    if ($nombre && $email && $rol) {
        // Actualizar datos en usuarios
        $update = $pdo->prepare("UPDATE usuarios SET nombre=?, email=? WHERE id_usuario=?");
        $update->execute([$nombre, $email, $id]);

        // Actualizar rol en uso_roles
        $updateRol = $pdo->prepare("UPDATE uso_roles SET id_rol=? WHERE id_usuario=?");
        $updateRol->execute([$rol, $id]);

        header("Location: lista_usuarios.php?msg=Usuario actualizado correctamente");
        exit;
    } else {
        $error = "Todos los campos son obligatorios";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Editar Usuario</h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nombre:
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>">
        </label><br><br>

        <label>Email:
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">
        </label><br><br>

        <label>Rol:
            <select name="rol">
                <?php foreach ($roles as $r): ?>
                    <option value="<?= $r['id_rol'] ?>" <?= $usuario['id_rol']==$r['id_rol']?'selected':'' ?>>
                        <?= htmlspecialchars($r['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br><br>

        <button type="submit">Guardar cambios</button>
    </form>

    <p><a href="lista_usuarios.php">Volver a la lista</a></p>
</body>
</html>
