<?php
include './config/db.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    try {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $query = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result ?: ["message" => "Usuario no encontrado"]);
        } else {
            $query = $pdo->query("SELECT * FROM usuarios");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                echo json_encode(["message" => "No hay usuarios en la base de datos"]);
            } else {
                echo json_encode($result);
            }
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error en la base de datos: " . $e->getMessage()]);
    }
}
?>