<?php
// PDO connection
$config = require __DIR__ . '/config.php';
try {
    $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}


// $config = require __DIR__ . '/config.php';

// try {
//     $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";
//     $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     ]);
//     echo "✅ Connexion réussie à la base de données !";
// } catch (Exception $e) {
//     die('❌ Database connection failed: ' . $e->getMessage());
// }
