<?php
include './config/db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    
    try {
   
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = :nombre AND apellido = :apellido");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            echo json_encode(['mensaje' => 'Autenticacion satisfactoria.', 'usuario' => $usuario]);
        } else {
            echo json_encode(["error" => "Error en la autenticacion"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error en la base de datos: " . $e->getMessage()]);
    }
}
?>
