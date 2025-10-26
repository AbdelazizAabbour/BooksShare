<?php
$host = 'localhost';
$db   = 'bookshare_php';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}


// Traitement de l'ajout de livre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $book_condition = $_POST['book_condition'] ?? 'used';
    $type = $_POST['type'] ?? 'lend';
    $price = $_POST['price'] ? (float)$_POST['price'] : null;
    $description = $_POST['description'] ?? '';

    // Gestion de l'upload de l'image
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid('book_') . '.' . $ext;
        $imagePath = 'uploads/' . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    // Récupération de l'ID de l'utilisateur connecté (exemple via session)
    session_start();
    $owner_id = $_SESSION['user_id'] ?? null;

    // Insertion dans la base de données
    $sql = "INSERT INTO books (title, author, book_condition, type, price, description, image, owner_id, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $author, $book_condition, $type, $price, $description, $imagePath, $owner_id]);

    // Redirection ou message de succès
    header("Location: /index.php?success=1");
    exit;
}
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>إضافة كتاب</title><link rel="stylesheet" href="/css/style.css"></head>
<body>
  <main class="form-card">
    <h2>إضافة كتاب</h2>
    <form method="post" action="/add_book.php" enctype="multipart/form-data">
      <label>العنوان<br><input type="text" name="title" required></label>
      <label>المؤلف<br><input type="text" name="author"></label>
      <label>الحالة<br>
        <select name="book_condition">
          <option value="new">جديد</option>
          <option value="good">جيد</option>
          <option value="used" selected>مستعمل</option>
          <option value="worn">متهالك</option>
        </select>
      </label>
      <label>النوع<br>
        <select name="type">
          <option value="lend">إعارة</option>
          <option value="exchange">تبادل</option>
          <option value="sell">بيع</option>
        </select>
      </label>
      <label>الثمن (إن كان للبيع)<br><input type="number" step="0.01" name="price"></label>
      <label>الوصف<br><textarea name="description"></textarea></label>
      <label>صورة الغلاف<br><input type="file" name="image" accept="image/*"></label>
      <button type="submit">نشر</button>
    </form>
  </main>
</body>
</html>
