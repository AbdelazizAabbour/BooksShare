<?php
require_once __DIR__ . '/../db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: ../public/dashboard.php'); exit;
    } else {
        $error = 'Emmmmmmm hadechi ma howach a3echri ';
    }
}
?>
