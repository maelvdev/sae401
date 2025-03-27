<?php
require_once '../config/database.php';
require_once '../config/security.php';
require_once '../middleware/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification CSRF
    if (!validateCSRFToken($_POST['csrf_token'])) {
        http_response_code(403);
        echo json_encode(['error' => 'Token CSRF invalide']);
        exit;
    }

    // Vérification authentification
    checkAuth();

    // Validation et assainissement des données
    $idUtilisateur = filter_var($_POST['userId'], FILTER_VALIDATE_INT);
    $dateCommande = date('Y-m-d H:i:s');
    
    if (!$idUtilisateur) {
        http_response_code(400);
        echo json_encode(['error' => 'ID utilisateur invalide']);
        exit;
    }

    try {
        $pdo->beginTransaction();

        // Vérification du stock avant commande
        $stmt = $pdo->prepare("SELECT stock FROM PRODUIT WHERE id = ?");
        $stmt->execute([$_POST['produitId']]);
        $produit = $stmt->fetch();

        if (!$produit || $produit['stock'] < $_POST['quantite']) {
            throw new Exception('Stock insuffisant');
        }

        // Créer la commande avec prepared statements
        $stmt = $pdo->prepare("INSERT INTO COMMANDE (idUtilisateur, dateCommande) VALUES (?, ?)");
        $stmt->execute([$idUtilisateur, $dateCommande]);
        $commandeId = $pdo->lastInsertId();

        // Mettre à jour le stock
        $stmt = $pdo->prepare("UPDATE PRODUIT SET stock = stock - ? WHERE id = ?");
        $stmt->execute([$_POST['quantite'], $_POST['produitId']]);

        $pdo->commit();
        
        // Log de la commande
        error_log("Nouvelle commande #$commandeId par utilisateur #$idUtilisateur");
        
        echo json_encode(['success' => true, 'id' => $commandeId]);
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
