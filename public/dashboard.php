<?php
require_once __DIR__ . '/../app/db.php';
session_start();
if (!isset($_SESSION['user_id'])){ header('Location: /login.php'); exit; }
$uid = $_SESSION['user_id'];

// Stats
$stmt = $pdo->prepare('SELECT COUNT(*) FROM books WHERE owner_id = ?');
$stmt->execute([$uid]);
$totalBooks = $stmt->fetchColumn();

$stmt = $pdo->prepare('SELECT SUM(price) FROM books WHERE owner_id = ? AND price IS NOT NULL');
$stmt->execute([$uid]);
$totalValue = $stmt->fetchColumn() ?: 0;

// Liste des livres
$stmt = $pdo->prepare('SELECT * FROM books WHERE owner_id = ? ORDER BY created_at DESC');
$stmt->execute([$uid]);
$mybooks = $stmt->fetchAll();

// Récupérer les infos actuelles de l'utilisateur
$stmt = $pdo->prepare('SELECT name, email, university, major, avatar FROM users WHERE id = ?');
$stmt->execute([$uid]);
$user = $stmt->fetch();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tableau de bord - Bookshare</title>
  <style>
    :root{--primary:#213e5e;--light:#ffffff;}
    *{box-sizing:border-box;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif;}
    body{background:#f5f5f5;color:#333;}
    header{background:var(--primary);color:var(--light);padding:1rem 2rem;display:flex;justify-content:space-between;align-items:center;}
    header h1{font-size:1.4rem;}
    header a{color:var(--light);text-decoration:none;font-weight:bold;}
    .container{max-width:1200px;margin:auto;padding:2rem;}
    .stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.5rem;margin-bottom:2rem;}
    .card{background:var(--light);border-radius:8px;padding:1.5rem;box-shadow:0 2px 6px rgba(0,0,0,.1);}
    .card h3{margin-bottom:.5rem;color:var(--primary);}
    .card .num{font-size:2rem;font-weight:bold;color:#222;}
    .btn{display:inline-block;background:var(--primary);color:var(--light);padding:.7rem 1.2rem;border-radius:4px;text-decoration:none;margin-bottom:2rem;}
    .btn:hover{opacity:.9;}
    .book-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.5rem;}
    .book-card{background:var(--light);border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.1);display:flex;flex-direction:column;}
    .book-card img{width:100%;height:260px;object-fit:cover;background:#ddd;}
    .book-card .info{padding:1rem;flex:1;display:flex;flex-direction:column;justify-content:space-between;}
    .book-card .title{font-weight:bold;margin-bottom:.3rem;}
    .book-card .type{font-size:.9rem;color:#555;margin-bottom:.5rem;}
    .book-card .price{font-size:1rem;color:var(--primary);}
    form{background:var(--light);border-radius:8px;padding:1.5rem;box-shadow:0 2px 6px rgba(0,0,0,.1);margin-bottom:2rem;}
    form h2{margin-bottom:1rem;color:var(--primary);}
    .form-group{margin-bottom:1rem;}
    label{display:block;margin-bottom:.3rem;font-weight:bold;}
    input,select,textarea{width:100%;padding:.6rem;border:1px solid #ccc;border-radius:4px;}
    button{background:var(--primary);color:var(--light);border:none;padding:.7rem 1.2rem;border-radius:4px;cursor:pointer;}
    button:hover{opacity:.9;}
    .msg-success{background:#d4edda;color:#155724;border:1px solid #c3e6cb;padding:1rem;border-radius:4px;margin-bottom:1rem;}
    .msg-error{background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;padding:1rem;border-radius:4px;margin-bottom:1rem;}
  </style>
</head>
<body>
  <header>
    <h1>Tableau de bord - Bonjour <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
    <a href="../public/logout.php">Déconnexion</a>
  </header>

  <div class="container">
    <!-- Statistiques -->
    <div class="stats">
      <div class="card">
        <h3>Total livres</h3>
        <div class="num"><?php echo $totalBooks; ?></div>
      </div>
      <div class="card">
        <h3>Valeur estimée</h3>
        <div class="num"><?php echo number_format($totalValue,2,',',' '); ?> Dh</div>
      </div>
    </div>

    <!-- Messages éventuels -->
    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
      <div class="msg-success">Profil modifié avec succès !</div>
    <?php endif; ?>
    <?php if (isset($_GET['bookadded']) && $_GET['bookadded'] == 1): ?>
      <div class="msg-success">Livre ajouté avec succès !</div>
    <?php endif; ?>

    <!-- Formulaire de mise à jour du profil -->
    <form action="../public/update_profile.php" method="post" enctype="multipart/form-data">
      <h2>Mettre à jour mon profil</h2>
      <div class="form-group">
        <label>Nom</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
      </div>
      <div class="form-group">
        <label>Mot de passe (laisser vide pour conserver l'actuel)</label>
        <input type="password" name="password" placeholder="Nouveau mot de passe">
      </div>
      <div class="form-group">
        <label>Université</label>
        <input type="text" name="university" value="<?php echo htmlspecialchars($user['university'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Filière</label>
        <input type="text" name="major" value="<?php echo htmlspecialchars($user['major'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Photo de profil</label>
        <input type="file" name="avatar" accept="image/*">
        <?php if (!empty($user['avatar'])): ?>
          <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar actuel" style="width:80px;height:80px;object-fit:cover;border-radius:50%;margin-top:.5rem;">
        <?php endif; ?>
      </div>
      <button type="submit" name="update_profile">Enregistrer les modifications</button>
    </form>

    <!-- Formulaire d'ajout de livre -->
    <form action="../public/add_book.php" method="post" enctype="multipart/form-data">
      <h2>Ajouter un nouveau livre</h2>
      <div class="form-group">
        <label>Titre</label>
        <input type="text" name="title" required>
      </div>
      <div class="form-group">
        <label>Auteur</label>
        <input type="text" name="author" required>
      </div>
      <div class="form-group">
        <label>Type</label>
        <select name="type" required>
          <option value="Roman">Roman</option>
          <option value="Science">Science</option>
          <option value="Histoire">Histoire</option>
          <option value="Scolaire">Scolaire</option>
          <option value="Autre">Autre</option>
        </select>
      </div>
      <div class="form-group">
        <label>État du livre</label>
        <select name="etat" required>
          <option value="Neuf">Neuf</option>
          <option value="Bon">Bon</option>
          <option value="Acceptable">Acceptable</option>
        </select>
      </div>
      <div class="form-group">
        <label>Prix (Dh)</label>
        <input type="number" step="0.01" name="price">
      </div>
      <div class="form-group">
        <label>Photo de couverture</label>
        <input type="file" name="cover" accept="image/*">
      </div>
      <button type="submit">Ajouter le livre</button>
    </form>

    <!-- Liste de tous les livres (tableau avec suppression) -->
    <h2>Tous les livres</h2> <br><br>
    <?php
    // Récupérer tous les livres avec les infos de leur propriétaire
    $stmt = $pdo->prepare('
        SELECT b.*, u.name AS owner_name
        FROM books b
        JOIN users u ON b.owner_id = u.id
        ORDER BY b.created_at DESC
    ');
    $stmt->execute();
    $allBooks = $stmt->fetchAll();
    ?>
    <?php if (count($allBooks) === 0): ?>
      <p>Aucun livre dans la base de données.</p>
    <?php else: ?>
      <table style="width:100%;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.08);border-collapse:collapse;font-family:'Segoe UI',Arial,sans-serif;">
        <thead>
          <tr style="background:#213e5e;color:#fff;">
            <th style="padding:1rem .75rem;text-align:left;font-weight:600;letter-spacing:.5px;">Titre</th>
            <th style="padding:1rem .75rem;text-align:left;font-weight:600;letter-spacing:.5px;">Auteur</th>
            <th style="padding:1rem .75rem;text-align:left;font-weight:600;letter-spacing:.5px;">Type</th>
            <th style="padding:1rem .75rem;text-align:left;font-weight:600;letter-spacing:.5px;">État</th>
            <th style="padding:1rem .75rem;text-align:left;font-weight:600;letter-spacing:.5px;">Prix</th>
            <th style="padding:1rem .75rem;text-align:left;font-weight:600;letter-spacing:.5px;">Propriétaire</th>
            <th style="padding:1rem .75rem;text-align:center;font-weight:600;letter-spacing:.5px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($allBooks as $index => $book): ?>
            <tr style="border-bottom:1px solid #f0f0f0;transition:background .2s;">
              <td style="padding:1rem .75rem;color:#222;"><?php echo htmlspecialchars($book['title']); ?></td>
              <td style="padding:1rem .75rem;color:#555;"><?php echo htmlspecialchars($book['author'] ?? ''); ?></td>
              <td style="padding:1rem .75rem;color:#555;"><?php echo htmlspecialchars($book['type']); ?></td>
              <td style="padding:1rem .75rem;color:#555;"><?php echo htmlspecialchars($book['etat'] ?? ''); ?></td>
              <td style="padding:1rem .75rem;color:#213e5e;font-weight:600;"><?php echo $book['price'] ? number_format($book['price'],2,',',' ').' Dh' : 'Gratuit'; ?></td>
              <td style="padding:1rem .75rem;color:#555;"><?php echo htmlspecialchars($book['owner_name']); ?></td>
              <td style="padding:1rem .75rem;text-align:center;">
                <form action="../public/delete_book.php" method="post" style="display:inline;">
                  <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                  <button type="submit" style="background-color: red  ;;color:#fff;border:none;padding:.5rem 1rem;border-radius:6px;cursor:pointer;font-size:.85rem;font-weight:600;transition:background .2s;" onmouseover="this.style.background='#c0392b'" onmouseout="this.style.background='#e74c3c'">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table> <br><br><br>
    <?php endif; ?>

    <!-- Liste des livres -->
    <h2>Mes livres</h2>
    <?php if (count($mybooks) === 0): ?>
      <p>Vous n'avez pas encore ajouté de livre.</p>
    <?php else: ?>
      <div class="book-grid">
        <?php foreach($mybooks as $b): ?>
          <div class="book-card">
            <img src="<?php echo !empty($b['cover_path']) && file_exists(__DIR__ . '/../' . ltrim($b['cover_path'], '/')) ? htmlspecialchars($b['cover_path']) : '/img/placeholder.png'; ?>" alt="Couverture">
            <div class="info">
              <div>
                <div class="title"><?php echo htmlspecialchars($b['title']); ?></div>
                <div class="type"><?php echo htmlspecialchars($b['type']); ?></div>
                <div class="etat"><?php echo htmlspecialchars($b['etat'] ?? ''); ?></div>
                <div class="details"><?php echo htmlspecialchars($b['author'] ?? ''); ?></div>
              </div>
              <div class="price"><?php echo $b['price'] ? number_format($b['price'],2,',',' ').' Dh' : 'Gratuit'; ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
