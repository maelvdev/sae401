<?php
require_once './config/database.php';

try {
    if ($pdo) {
        echo json_encode(['status' => 'success', 'message' => 'API opérationnelle']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
