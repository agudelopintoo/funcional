<?php
// php/db.php

$host = "localhost";
$dbname = "bogartestudio";  // ⚠️ Cambia por el nombre real de tu base de datos
$user = "root";         // Usuario por defecto en XAMPP
$pass = "";             // Contraseña por defecto en XAMPP es vacía

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
