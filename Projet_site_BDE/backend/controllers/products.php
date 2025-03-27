<?php
require_once __DIR__ . '/../config/database.php';

try {
    $stmt = $pdo->query('SELECT * FROM PRODUIT WHERE stock > 0');
    $products = $stmt->fetchAll();
    
    echo json_encode($products);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erreur lors de la récupération des produits',
        'details' => $e->getMessage()
    ]);
}
