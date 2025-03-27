<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Credentials: true');

require_once './config/database.php';

try {
    // Test de la connexion
    if ($pdo) {
        // Test simple de requête
        $stmt = $pdo->query('SELECT CURRENT_TIMESTAMP');
        $time = $stmt->fetch(PDO::FETCH_COLUMN);
        
        echo json_encode([
            'status' => 'success',
            'message' => 'API opérationnelle',
            'timestamp' => $time,
            'database' => 'connectée'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
