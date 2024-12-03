<?php
include './config/db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = ?");
    $stmt->execute([$nombre]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo json_encode(["error" => "El usuario ya existe"]);
    } else {
        
        try {
            // Insertar el usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido) VALUES (?, ?)");
            $stmt->execute([$nombre, $apellido]);
            
            echo json_encode(["message" => "Usuario registrado con exito"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error en el registro: " . $e->getMessage()]);
        }
    }
}
?>
