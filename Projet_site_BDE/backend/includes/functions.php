<?php
function render_template($template_path, $data = []) {
    ob_start();
    extract($data);
    include $template_path;
    return ob_get_clean();
}

function is_authenticated() {
    return isset($_SESSION['user_id']);
}

function require_auth() {
    if (!is_authenticated()) {
        http_response_code(401);
        echo json_encode(['error' => 'Non authentifié']);
        exit;
    }
}

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function json_response($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

function isAdhérent() {
    return isset($_SESSION['user_id']) && isset($_SESSION['is_adherent']) && $_SESSION['is_adherent'] === true;
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
