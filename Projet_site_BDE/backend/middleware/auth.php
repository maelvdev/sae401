<?php
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Non autorisé']);
        exit;
    }
}

function checkRole($requiredRole) {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $requiredRole) {
        http_response_code(403);
        echo json_encode(['error' => 'Accès interdit']);
        exit;
    }
}
?>
