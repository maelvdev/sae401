<?php
require_once '../config/database.php';
require_once '../config/security.php';
require_once '../middleware/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    checkAuth();
    try {
        $stmt = $pdo->prepare("SELECT id, nom, prenom, email, role FROM UTILISATEUR");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur serveur']);
    }
}
?>
