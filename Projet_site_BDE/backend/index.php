<?php
session_start();

header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require_once './config/database.php';
require_once './includes/functions.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    exit(0);
}

// Simple router
$routes = [
    '/api/auth/login' => 'controllers/auth/login.php',
    '/api/auth/logout' => 'controllers/auth/logout.php',
    '/api/events' => 'controllers/events.php',
    '/api/products' => 'controllers/products.php',
    '/api/orders' => 'controllers/orders.php'
];

if (isset($routes[$request])) {
    require __DIR__ . '/' . $routes[$request];
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}
?>
