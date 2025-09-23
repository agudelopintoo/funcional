<?php
require_once __DIR__ . '/auth.php';
require_admin($pdo);

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: admin_users.php'); exit; }

// POST => guardar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $estado = trim($_POST['estado'] ?? 'activo');

    $upd = $pdo->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, telefono = :telefono, estado = :estado WHERE id_usuario = :id");
    $upd->execute(['nombre'=>$nombre,'apellido'=>$apellido,'telefono'=>$telefono,'estado'=>$estado,'id'=>$id]);

    header('Location: admin_users.php');
    exit;
}

// GET => obtener datos actuales
$stmt = $pdo->prepare("SELECT id_usuario, nombre, apellido, email, telefono, estado FROM usuarios WHERE id_usuario = :id LIMIT 1");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) { header('Location: admin_users.php'); exit; }
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Editar usuario</title></head>
<body>
  <h2>Editar usuario #<?= $user['id_usuario'] ?></h2>
  <form method="post">
    <label>Nombre<br><input name="nombre" value="<?=htmlspecialchars($user['nombre'])?>" required></label><br><br>
    <label>Apellido<br><input name="apellido" value="<?=htmlspecialchars($user['apellido'])?>" required></label><br><br>
    <label>Teléfono<br><input name="telefono" value="<?=htmlspecialchars($user['telefono'])?>"></label><br><br>
    <label>Estado<br>
      <select name="estado">
        <option value="activo" <?= $user['estado']=='activo' ? 'selected' : '' ?>>activo</option>
        <option value="inactivo" <?= $user['estado']=='inactivo' ? 'selected' : '' ?>>inactivo</option>
      </select>
    </label><br><br>
    <button type="submit">Guardar</button>
  </form>
  <p><a href="admin_users.php">Volver</a></p>
</body>
</html>
