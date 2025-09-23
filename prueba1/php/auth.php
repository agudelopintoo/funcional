<?php
// auth.php
session_start();
require_once __DIR__ . '/db.php';

// Obliga login. Uso: require_login();
function require_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: inicio_sesion2.php');
        exit;
    }
}

// Devuelve true si el usuario tiene rol admin
function is_admin(PDO $pdo, $user_id) : bool {
    if (!$user_id) return false;
    $stmt = $pdo->prepare("
        SELECT 1 FROM uso_roles ur
        JOIN roles r ON ur.id_rol = r.id_rol
        WHERE ur.id_usuario = :uid AND r.nombre = 'admin' LIMIT 1
    ");
    $stmt->execute(['uid' => $user_id]);
    return (bool) $stmt->fetchColumn();
}

// Requerir admin (uso en páginas admin)
function require_admin(PDO $pdo) {
    $uid = $_SESSION['user_id'] ?? null;
    if (!is_admin($pdo, $uid)) {
        header('HTTP/1.1 403 Forbidden');
        echo "Acceso denegado. Solo administradores.";
        exit;
    }
}

// Cuenta admins actuales
function count_admins(PDO $pdo) : int {
    $stmt = $pdo->query("
        SELECT COUNT(DISTINCT ur.id_usuario) FROM uso_roles ur
        JOIN roles r ON ur.id_rol = r.id_rol
        WHERE r.nombre = 'admin'
    ");
    return (int) $stmt->fetchColumn();
}

