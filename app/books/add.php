<?php
require_once __DIR__ . '/../db.php';
session_start();
if (!isset($_SESSION['user_id'])){ header('Location: /login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $book_condition = $_POST['book_condition'] ?? 'used';
    $type = $_POST['type'] ?? 'lend';
    $price = $_POST['price'] ?: null;
    $description = trim($_POST['description']) ?: null;

    $imagePath = null;
    if (!empty($_FILES['image']['name'])){
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = uniqid('book_') . '.' . $ext;
        $dest = __DIR__ . '/../../uploads/' . $fname;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)){
            $imagePath = 'uploads/' . $fname;
        }
    }

    $stmt = $pdo->prepare('INSERT INTO books (title,author,book_condition,type,price,description,image,owner_id) VALUES (?,?,?,?,?,?,?,?)');
    $stmt->execute([$title,$author,$book_condition,$type,$price,$description,$imagePath,$_SESSION['user_id']]);
    header('Location: /dashboard.php'); exit;
}
?>
