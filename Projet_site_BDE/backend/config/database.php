<?php
define('DB_HOST', 'woody');
define('DB_PORT', '5432');
define('DB_NAME', 'cn230854'); // Remplacer par votre identifiant IUT
define('DB_USER', 'cn230854'); // Remplacer par votre identifiant IUT
define('DB_PASS', '28022005'); // Mettre votre mot de passe IUT

try {
    $dsn = "pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
