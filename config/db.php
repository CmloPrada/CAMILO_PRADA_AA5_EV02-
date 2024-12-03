<?php
$host = 'localhost';
$dbname = 'evidencia_api';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se puede conectar a la base de datos: " . $e->getMessage());
}
?>
