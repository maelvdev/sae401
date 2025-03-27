<?php
require_once '../config/database.php';
require_once '../config/security.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM PRODUIT WHERE stock > 0");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur serveur']);
    }
}
?>
