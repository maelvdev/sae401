<?php
require_once __DIR__ . '/../config/database.php';

try {
    $stmt = $pdo->query('SELECT * FROM produit WHERE stock > 0');
    echo json_encode($stmt->fetchAll());
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
