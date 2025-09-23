<?php
require_once __DIR__ . '/auth.php';
require_admin($pdo);

// obtener todos los usuarios con sus roles (concatenados)
$stmt = $pdo->query("
    SELECT u.id_usuario, u.nombre, u.apellido, u.email, u.telefono, u.estado,
           GROUP_CONCAT(r.nombre SEPARATOR ', ') AS roles
    FROM usuarios u
    LEFT JOIN uso_roles ur ON u.id_usuario = ur.id_usuario
    LEFT JOIN roles r ON ur.id_rol = r.id_rol
    GROUP BY u.id_usuario
    ORDER BY u.id_usuario DESC
");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// obtener lista de roles para select
$rstmt = $pdo->query("SELECT id_rol, nombre FROM roles ORDER BY id_rol");
$roles = $rstmt->fetchAll(PDO::FETCH_ASSOC);

$current_admin_count = count_admins($pdo);
$self_id = $_SESSION['user_id'];
?>

<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Administrador') {
    header("Location: pagina_principal.php");
    exit;
}
// Después de verificar que el email y la contraseña son correctos...
$_SESSION['user_id'] = $user['id_usuario'];
$_SESSION['user_nombre'] = $user['nombre'];

// Consultar el rol del usuario
$stmt = $pdo->prepare("
    SELECT r.nombre 
    FROM roles r
    JOIN uso_roles ur ON ur.id_rol = r.id_rol
    WHERE ur.id_usuario = :id
    LIMIT 1
");
$stmt->execute(['id' => $user['id_usuario']]);
$rol = $stmt->fetchColumn();

// Guardar rol en la sesión
$_SESSION['user_role'] = $rol ?: 'Cliente'; // Si no tiene rol, por defecto Cliente

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Administrar usuarios</title>
  <link rel="stylesheet" href="../css/pagina_principal.css">
  <style>
    table{width:100%;border-collapse:collapse}
    th,td{padding:8px;border:1px solid #ddd}
    .small{font-size:0.9rem}
    .btn{padding:6px 10px;background:#2d89ef;color:#fff;text-decoration:none;border-radius:4px}
    .danger{background:#e74c3c}
  </style>
</head>
<body>
  <h2>Panel de administración — Usuarios</h2>
  <p>Admin logueado: <strong><?=htmlspecialchars($_SESSION['user_nombre'])?></strong></p>

  <table>
    <thead>
      <tr>
        <th>ID</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Estado</th><th>Roles</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($users as $u): ?>
      <tr>
        <td><?= $u['id_usuario'] ?></td>
        <td><?= htmlspecialchars($u['nombre'].' '.$u['apellido']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['telefono']) ?></td>
        <td class="small"><?= htmlspecialchars($u['estado']) ?></td>
        <td class="small"><?= htmlspecialchars($u['roles'] ?? '—') ?></td>
        <td>
          <a class="btn" href="edit_user.php?id=<?= $u['id_usuario'] ?>">Editar</a>

          <?php if ($u['id_usuario'] != $self_id): // no permitir borrarse a sí mismo ?>
            <form style="display:inline" method="post" action="delete_user.php" onsubmit="return confirm('Eliminar usuario?')">
              <input type="hidden" name="id_usuario" value="<?= $u['id_usuario'] ?>">
              <button class="btn danger" type="submit">Eliminar</button>
            </form>
          <?php else: ?>
            <span class="small">(Tu cuenta)</span>
          <?php endif; ?>

          <!-- formulario para cambiar rol principal -->
          <form style="display:inline" method="post" action="toggle_role.php">
            <input type="hidden" name="id_usuario" value="<?= $u['id_usuario'] ?>">
            <select name="id_rol" required>
              <?php foreach($roles as $r): ?>
                <option value="<?= $r['id_rol'] ?>"><?= htmlspecialchars($r['nombre']) ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn" type="submit">Asignar rol</button>
          </form>

        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <p><a href="pagina_principal.php">Volver al inicio</a></p>
</body>
</html>
