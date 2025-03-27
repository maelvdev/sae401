<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'bde_database');
define('DB_USER', 'postgres');
define('DB_PASS', 'your_password');

try {
    $dsn = "pgsql:host=".DB_HOST.";dbname=".DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
