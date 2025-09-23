<?php
require_once __DIR__ . '/auth.php';
require_admin($pdo);

$actor_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin_users.php');
    exit;
}

$id_usuario = (int) ($_POST['id_usuario'] ?? 0);
$id_rol = (int) ($_POST['id_rol'] ?? 0);

// validar inputs
if (!$id_usuario || !$id_rol) {
    $_SESSION['flash_error'] = "Datos inválidos.";
    header('Location: admin_users.php'); exit;
}

// ver nombre del rol
$r = $pdo->prepare("SELECT nombre FROM roles WHERE id_rol = :id");
$r->execute(['id' => $id_rol]);
$rol_row = $r->fetch(PDO::FETCH_ASSOC);
if (!$rol_row) { $_SESSION['flash_error'] = "Rol no válido."; header('Location: admin_users.php'); exit; }
$rol_nombre = $rol_row['nombre'];

// si quieren asignar admin, validar límite de 4
if ($rol_nombre === 'admin') {
    $count = count_admins($pdo);
    // si usuario ya es admin no se incrementa: revisar si ya tiene ese rol
    $check = $pdo->prepare("SELECT 1 FROM uso_roles WHERE id_usuario = :uid AND id_rol = :rid LIMIT 1");
    $check->execute(['uid'=>$id_usuario,'rid'=>$id_rol]);
    if (!$check->fetch() && $count >= 4) {
        $_SESSION['flash_error'] = "Ya existen 4 administradores. Primero remueve uno antes de asignar.";
        header('Location: admin_users.php'); exit;
    }
}

// remover roles previos de esa relación (opcional) o permitir múltiples roles.
// Aquí elegimos: eliminar todos los roles y solo asignar el seleccionado (modo simple).
$pdo->beginTransaction();
try {
    $del = $pdo->prepare("DELETE FROM uso_roles WHERE id_usuario = :uid");
    $del->execute(['uid' => $id_usuario]);

    $ins = $pdo->prepare("INSERT INTO uso_roles (id_rol, id_usuario) VALUES (:rid, :uid)");
    $ins->execute(['rid' => $id_rol, 'uid' => $id_usuario]);

    $pdo->commit();
    $_SESSION['flash_success'] = "Rol asignado correctamente.";
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['flash_error'] = "Error al asignar rol.";
}

header('Location: admin_users.php');
exit;
