<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = $1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            json_response([
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'role' => $user['role']
                ]
            ]);
        }

        json_response(['error' => 'Identifiants invalides'], 401);
    } catch(PDOException $e) {
        json_response(['error' => 'Erreur serveur'], 500);
    }
}
