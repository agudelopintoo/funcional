<?php
require_once __DIR__ . '/auth.php';
require_admin($pdo);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin_users.php'); exit;
}

$id = (int)($_POST['id_usuario'] ?? 0);
$self = $_SESSION['user_id'];
if ($id === $self) {
    $_SESSION['flash_error'] = "No puedes eliminar tu propia cuenta.";
    header('Location: admin_users.php'); exit;
}

// eliminar uso_roles y usuario
$pdo->beginTransaction();
try {
    $del1 = $pdo->prepare("DELETE FROM uso_roles WHERE id_usuario = :id");
    $del1->execute(['id'=>$id]);

    $del2 = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
    $del2->execute(['id'=>$id]);

    $pdo->commit();
    $_SESSION['flash_success'] = "Usuario eliminado.";
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['flash_error'] = "Error al eliminar usuario.";
}
header('Location: admin_users.php');
exit;
