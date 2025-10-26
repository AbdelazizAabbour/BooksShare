<?php
// Connexion à la base de données
require_once __DIR__ . '/../config/database.php';
// Vérifier si l'ID du livre est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $book_id = intval($_GET['id']);

    // Préparer et exécuter la requête de suppression
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->bindParam(':id', $book_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Rediriger vers la liste des livres avec un message de succès
        header("Location: list_books.php?message=deleted");
        exit();
    } else {
        echo "Erreur lors de la suppression du livre.";
    }
} else {
    echo "ID du livre invalide.";
}
?>
