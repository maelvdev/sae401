<?php
require_once './config/database.php';

try {
    if ($pdo) {
        echo "La connexion à la base de données woody est opérationnelle.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
