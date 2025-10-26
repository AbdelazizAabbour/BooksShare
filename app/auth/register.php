<?php
require_once __DIR__ . '/../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    if (!$name || !$email || !$password){
        $error = ' 3amer kolchi ';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()){
            $error = 'deja hade email kayen ';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
            $stmt->execute([$name,$email,$hash]);
            header('Location: /login.php'); exit;
        }
    }
}
?>
