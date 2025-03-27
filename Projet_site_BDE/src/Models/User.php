<?php
namespace App\Models;

class User {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function authenticate($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = $1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    public function register($userData) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO utilisateur (email, mot_de_passe, nom, prenom, role) 
             VALUES ($1, $2, $3, $4, $5) RETURNING id"
        );
        return $stmt->execute([
            $userData['email'],
            password_hash($userData['password'], PASSWORD_DEFAULT),
            $userData['nom'],
            $userData['prenom'],
            'membre'
        ]);
    }
}
