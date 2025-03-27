<?php
namespace App\Controllers;

class AuthController {
    private $userModel;
    private $twig;
    
    public function __construct($pdo, $twig) {
        $this->userModel = new \App\Models\User($pdo);
        $this->twig = $twig;
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->authenticate(
                $_POST['email'],
                $_POST['password']
            );
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                return json_encode(['success' => true]);
            }
            
            return json_encode(['error' => 'Identifiants invalides']);
        }
        
        return $this->twig->render('auth/login.html.twig');
    }
}
