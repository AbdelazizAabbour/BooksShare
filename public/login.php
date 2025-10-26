<?php
require_once __DIR__ . '/../app/auth/login.php';

// Si l'utilisateur est déjà connecté, rediriger vers le dashboard
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../public/dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookShare - Connexion</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="../pics/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .floating-books {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
      z-index: 1;
    }
    .floating-book {
      position: absolute;
      font-size: 40px;
      color: rgba(33,62,94,0.08);
      animation: float 20s infinite linear;
      transform-origin: center;
    }
    @keyframes float {
      0% {
        transform: translateY(110vh) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(-110vh) rotate(360deg);
        opacity: 0;
      }
    }
  </style>
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen overflow-x-hidden">

  <!-- Floating books background -->
  <div class="floating-books" id="floatingBooks"></div>

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full h-[72px] flex items-center justify-between px-10 z-50 bg-[#213e5e] text-white">
    <div id="branding" class="text-2xl font-bold tracking-widest">BookShare | CMC</div>
    <nav id="main-menu" class="flex items-center gap-6">
      <div class="flex gap-6">
        <a href="../public/index.php" class="text-white hover:text-blue-300 transition">Home</a>
        <a href="../public/news.php" class="text-white hover:text-blue-300 transition">News</a>
      </div>
      <a href="../public/register.php" aria-label="Inscription" title="Inscription" class="text-white text-lg"><i class="fa-solid fa-user-plus"></i></a>
      <a href="#" aria-label="Langue" title="Langue" class="text-white text-lg"><i class="fa-solid fa-globe"></i></a>
    </nav>
  </header>

  <main class="flex-1 flex items-center justify-center py-52">
    <section class="bg-white p-10 rounded-xl shadow-lg w-full max-w-md animate-fadeIn relative z-10">
      <h2 class="text-2xl font-semibold text-center text-[#213e5e] mb-6">Se connecter</h2>

      <?php
      // Connexion à la base de données
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

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          try {
              $pdo = new PDO($dsn, $user, $pass, $options);

              $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
              $password = $_POST['password'] ?? '';

              if (!$email || !$password) {
                  $error = 'Veuillez remplir tous les champs.';
              } else {
                  $stmt = $pdo->prepare('SELECT id, password, role FROM users WHERE email = ?');
                  $stmt->execute([$email]);
                  $user = $stmt->fetch();

                  if ($user) {
                      if (password_verify($password, $user['password'])) {
                          session_start();
                          $_SESSION['user_id'] = $user['id'];
                          $_SESSION['user_role'] = $user['role'];
                          // Redirection vers le dashboard admin ou user
                          header('Location: ../public/dashboard.php');
                          exit;
                      } else {
                          $error = 'Mot de passe incorrect.';
                      }
                  } else {
                      $error = 'Aucun utilisateur trouvé avec cet email.';
                  }
              }
          } catch (PDOException $e) {
              $error = 'Erreur de connexion à la base de données.';
          }
      }
      ?>

      <?php if (!empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form id="loginForm" method="post" action="" novalidate class="space-y-4">
        <label class="block text-sm font-medium">Email
          <input type="email" name="email" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#213e5e]">
        </label>
        <label class="block text-sm font-medium">Mot de passe
          <input type="password" name="password" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#213e5e]">
        </label>
        <button type="submit" class="w-full bg-[#213e5e] text-white py-2 rounded-lg hover:bg-[#1a324d] transition">Se connecter</button>
      </form>
      <p class="text-center text-sm mt-4">Pas encore inscrit ? <a href="../public/register.php" class="text-[#213e5e] font-semibold">Créer un compte</a></p>
    </section>
  </main>

<!-- Footer Section -->
<footer class="bg-[#213e5e] text-white py-12">
  <div class="max-w-5xl mx-auto flex flex-wrap gap-10 justify-between px-6">

    <!-- Brand & About -->
    <div class="flex-1 min-w-[250px]">
      <h3 class="text-xl font-bold mb-4 tracking-wider">BookShare | CMC</h3>
      <p class="text-sm leading-relaxed opacity-90">
        La plateforme étudiante pour partager, découvrir et redonner vie aux livres. 
        Ensemble, cultivons la lecture sans contraintes.
      </p>
    </div>

    <!-- Quick Links -->
    <div class="flex-1 min-w-[180px]">
      <h4 class="text-lg font-semibold mb-4">Navigation</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="/" class="text-white opacity-85 hover:opacity-100">Accueil</a></li>
        <li><a href="/catalogue.php" class="text-white opacity-85 hover:opacity-100">Catalogue</a></li>
        <li><a href="/publish.php" class="text-white opacity-85 hover:opacity-100">Publier un livre</a></li>
        <li><a href="/contact.php" class="text-white opacity-85 hover:opacity-100">Contact</a></li>
      </ul>
    </div>

    <!-- Payment Methods -->
    <div class="flex-1 min-w-[220px]">
      <h4 class="text-lg font-semibold mb-4">Moyens de paiement</h4>
      <div class="flex gap-3 items-center">
        <img src="https://www.workker.fr/img/cms/logo-stripe%20(1).png" alt="Stripe" class="h-16">
      </div>
      <p class="text-xs opacity-70 mt-2">Paiement sécurisé & crypté SSL 256-bit</p>
    </div>

    <!-- Social & Legal -->
    
  </div>

  <!-- Bottom line -->
  <div class="text-center mt-10 pt-5 border-t border-white/20 text-xs opacity-70">
    © <?= date('Y') ?> BookShare CMC. Tous droits réservés.
  </div>
</footer>


</body>
</html>
