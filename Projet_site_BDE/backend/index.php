<?php
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once './config/database.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    exit(0);
}

switch($request) {
    case '/api/articles':
        require __DIR__ . '/routes/articles.php';
        break;
    case '/api/users':
        require __DIR__ . '/routes/users.php';
        break;
    case '/api/commande':
        require __DIR__ . '/routes/commande.php';
        break;
    case '/api/events':
        require __DIR__ . '/routes/events.php';
        break;
    case '/api/products':
        require __DIR__ . '/routes/products.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
        break;
}
?>
