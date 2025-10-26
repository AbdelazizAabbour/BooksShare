<?php
session_start();
require_once __DIR__ . '/../app/db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer les données de l'utilisateur
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Traiter la mise à jour du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = trim($_POST['email']);
    $university = isset($_POST['university']) ? trim($_POST['university']) : '';
    $major = isset($_POST['major']) ? trim($_POST['major']) : '';
    // Validation simple
    if (empty($name) || empty($email)) {
        $error = "Nom et email sont requis.";
    } else {
        // Mise à jour dans la base de données
        $updateStmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, university = ?, major = ? WHERE id = ?");
        if ($updateStmt->execute([$name, $email, $university, $major, $user_id])) {
            $_SESSION['success'] = "Profil mis à jour avec succès.";
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Erreur lors de la mise à jour du profil.";
        }
    }
}
?>
