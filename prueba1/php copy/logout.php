<?php
session_start();
$_SESSION = [];
session_destroy();
header('Location: inicio_sesion2.php');
exit;
