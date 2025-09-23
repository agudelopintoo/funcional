<?php
session_start();
require_once __DIR__ . '/db.php';

// Verificar que sea Administrador
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Administrador') {
    die("Acceso denegado");
}

// Consultar todos los usuarios con su rol
$stmt = $pdo->query("
    SELECT u.id_usuario, u.nombre, u.email, r.nombre AS rol
    FROM usuarios u
    JOIN uso_roles ur ON u.id_usuario = ur.id_usuario
    JOIN roles r ON ur.id_rol = r.id_rol
");
$usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Usuarios Registrados</h1>

    <?php if (isset($_GET['msg'])): ?>
        <p style="color:green;"><?= htmlspecialchars($_GET['msg']) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id_usuario'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['rol']) ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $u['id_usuario'] ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
