<?php
session_start();

header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once __DIR__ . '/config/database.php';

$request = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Routes simplifiées
switch($request) {
    case '/test_api':
        echo json_encode(['status' => 'success', 'message' => 'API opérationnelle']);
        break;
        
    case '/api/products':
        require __DIR__ . '/controllers/products.php';
        break;
        
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
}
?>
