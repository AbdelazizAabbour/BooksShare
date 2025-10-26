<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookShare - News</title>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="icon" href="../pics/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Reset & base */
    *{box-sizing:border-box;margin:0;padding:0;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif}
    body{
      background:#FFFFFF;
     
    }
    main{
      flex:1;
      display:flex;
      align-items:center;
      justify-content:center;
    }

 
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 72px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      z-index: 1000;
      background-color: #213e5e;
      color: #fff;
    }

    #branding {
      font-size: 24px;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--soft-white);
    }

    #main-menu {
      display: flex;
      align-items: center;
      gap: 24px;
    }
    #main-menu a {
      color: var(--soft-white);
      text-decoration: none;
      font-size: 18px;
      transition: color 0.2s;
    }

    #main-menu a:hover {
      color: var(--accent);
    }

    /* Floating books background animation */
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
<body>
  <!-- Floating books background -->
  <div class="floating-books" id="floatingBooks"></div>

  <!-- Header -->
  <header>
    <div id="branding">BookShare | CMC</div>
    <nav id="main-menu">
      <div style="display:flex; justify-content:center; gap:24px;">
        <a href="../public/index.php" style="color:var(--soft-white); text-decoration:none; font-size:18px; transition:color 0.2s;">Home</a>
        <a href="../public/books.php"
        style="color:var(--soft-white); text-decoration:none; font-size:18px; transition:color 0.2s;">Books</a>
        <a href="#" style="color:var(--soft-white); text-decoration:none; font-size:18px; transition:color 0.2s;">News</a>
      </div>
      <a href="#" aria-label="Langue" title="Langue" style="color:#fff; font-size:18px;"><i class="fa-solid fa-globe"></i></a>
    </nav>
  </header>

  <!-- Main content -->
  <main>
    <section class="news-section">
      <h1 class="news-title">Nouveautés & Actualités</h1>

      <!-- Filter tabs -->
      <div class="news-filters">
        <button class="filter-btn active" data-filter="all">Tout</button>
        <button class="filter-btn" data-filter="event">Événements</button>
        <button class="filter-btn" data-filter="release">Nouveautés</button>
        <button class="filter-btn" data-filter="partnership">Partenariats</button>
      </div>

      <!-- News grid -->
      <div class="news-grid" id="newsGrid">
        <!-- Card 1 -->
        <article class="news-card" data-category="release">
          <div class="card-img">
            <img src="https://cdn.pixabay.com/photo/2016/03/26/22/21/books-1281581_960_720.jpg" alt="Nouvelle collection">
          </div>
          <div class="card-body">
            <span class="card-tag">Nouveauté</span>
            <h2 class="card-title">Nouvelle collection Science-Fiction</h2>
            <p class="card-text">Découvrez notre sélection de romans SF récemment ajoutés, disponibles dès maintenant en échange.</p>
            <time class="card-date">12 juin 2024</time>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="news-card" data-category="event">
          <div class="card-img">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKgGdcSEuCMIDEJk8PibXD2umAMR2doCpsXwbDGRgdQIU6mu3jsIZ9SQODxPMk-plW0PY&usqp=CAU" alt="Salon du livre">
          </div>
          <div class="card-body">
            <span class="card-tag">Événement</span>
            <h2 class="card-title">Salon du livre étudiant</h2>
            <p class="card-text">Rejoignez-nous le 28 juin pour notre premier salon dédié au partage littéraire entre étudiants.</p>
            <time class="card-date">28 juin 2024</time>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="news-card" data-category="partnership">
          <div class="card-img">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1qpEBausS_rGi46GkxOi1rmj6MoWTK3a0xuGJtrfxVNEd9T2jYfE_hI7PYYTFoMpUKf0&usqp=CAU" alt="Partenariat">
          </div>
          <div class="card-body">
            <span class="card-tag">Partenariat</span>
            <h2 class="card-title">Partenariat avec la librairie Le Passeur</h2>
            <p class="card-text">Bénéficiez de 10 % de réduction sur les cafés littéraires grâce à notre nouveau partenaire.</p>
            <time class="card-date">5 juillet 2024</time>
          </div>
        </article>

        <!-- Card 4 -->
        <article class="news-card" data-category="release">
          <div class="card-img">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsCtdDsj1PCkpWAzYU9narU2HkigJjRvMU_Q&s" alt="Revues">
          </div>
          <div class="card-body">
            <span class="card-tag">Nouveauté</span>
            <h2 class="card-title">Revues scientifiques en accès libre</h2>
            <p class="card-text">Des centaines de revues universitaires sont désormais consultables sans contrepartie.</p>
            <time class="card-date">10 juillet 2024</time>
          </div>
        </article>
      </div>
    </section>
  </main>

  <style>
    :root {
      --accent: #ff7f50;
      --soft-white: #f5f7fa;
      --dark-blue: #213e5e;
    }

    .news-section {
      width: 90%;
      max-width: 1200px;
      margin: 120px auto 80px;
      color: #333;
    }

    .news-title {
      font-size: 2.5rem;
      margin-bottom: 2rem;
      text-align: center;
      color: var(--dark-blue);
    }

    /* Filters */
    .news-filters {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 3rem;
      flex-wrap: wrap;
    }

    .filter-btn {
      padding: 0.6rem 1.2rem;
      border: 2px solid var(--dark-blue);
      background: transparent;
      color: var(--dark-blue);
      border-radius: 30px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s, color 0.3s;
    }

    .filter-btn.active,
    .filter-btn:hover {
      background: var(--dark-blue);
      color: #fff;
    }

    /* Grid */
    .news-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
    }

    /* Card */
    .news-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .news-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .card-img img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-body {
      padding: 1.2rem 1.5rem 1.5rem;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .card-tag {
      align-self: flex-start;
      background: var(--accent);
      color: #fff;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      margin-bottom: 0.75rem;
    }

    .card-title {
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
      color: var(--dark-blue);
    }

    .card-text {
      font-size: 0.95rem;
      line-height: 1.5;
      margin-bottom: 1rem;
      flex: 1;
    }

    .card-date {
      font-size: 0.8rem;
      color: #777;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .news-title {
        font-size: 2rem;
      }
      .news-filters {
        gap: 0.5rem;
      }
      .filter-btn {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
      }
    }
  </style>

  <script>
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const newsCards = document.querySelectorAll('.news-card');

    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        // Update active button
        filterButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.getAttribute('data-filter');

        newsCards.forEach(card => {
          if (filter === 'all' || card.getAttribute('data-category') === filter) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  </script>





<!-- ===== NOUVEAUTÉS & ACTUALITÉS LIVRES / ROMANS ===== -->
<section class="new-books-section" id="newBooks">
  <div class="container">
    <h2 class="section-title">Nouveautés Livres & Romans</h2>

    <!-- Carousel / Grid switcher -->
    <div class="view-toggle">
      <button class="toggle-btn active" data-view="grid"><i class="fa-solid fa-grip"></i> Grille</button>
      <button class="toggle-btn" data-view="carousel"><i class="fa-solid fa-film"></i> Carousel</button>
    </div>

    <!-- Books grid -->
    <div class="books-grid" id="booksGrid">
      <!-- Card 1 -->
      <article class="book-card" data-synopsis="Un thriller psychologique haletant qui plonge dans les méandres de la mémoire humaine.">
        <div class="book-cover">
          <img src="../pics/88.jpeg" alt="Couverture Le Silence des étoiles">
          <div class="overlay">
            <button class="quick-add" aria-label="Ajouter à ma liste"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="book-info">
          <h3 class="book-title">Le Silence des étoiles</h3>
          <p class="book-author">par A. Delacroix</p>
          <span class="book-tag">Thriller</span>
        </div>
      </article>

      <!-- Card 2 -->
      <article class="book-card" data-synopsis="Une saga familiale poignante qui traverse trois générations.">
        <div class="book-cover">
          <img src="../pics/77.jpg" alt="Couverture Les Jardins de cendre">
          <div class="overlay">
            <button class="quick-add" aria-label="Ajouter à ma liste"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="book-info">
          <h3 class="book-title">Les Jardins de cendre</h3>
          <p class="book-author">par M. El-Hassan</p>
          <span class="book-tag">Roman historique</span>
        </div>
      </article>

      <!-- Card 3 -->
      <article class="book-card" data-synopsis="Un roman feel-good qui réchauffe le cœur en hiver.">
        <div class="book-cover">
          <img src="../pics/44.jpg" alt="Couverture L'Atelier des souvenirs">
          <div class="overlay">
            <button class="quick-add" aria-label="Ajouter à ma liste"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="book-info">
          <h3 class="book-title">L'Atelier des souvenirs</h3>
          <p class="book-author">par C. Martin</p>
          <span class="book-tag">Feel-good</span>
        </div>
      </article>

      <!-- Card 4 -->
      <article class="book-card" data-synopsis="Une plongée vertigineuse dans les start-ups parisiennes.">
        <div class="book-cover">
          <img src="../pics/55.webp" alt="Couverture Startup Underground">
          <div class="overlay">
            <button class="quick-add" aria-label="Ajouter à ma liste"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="book-info">
          <h3 class="book-title">Startup Underground</h3>
          <p class="book-author">par J. Rousseau</p>
          <span class="book-tag">Contemporain</span>
        </div>
      </article>


       <!-- Card 5 -->
       <article class="book-card" data-synopsis="Un roman feel-good qui réchauffe le cœur en hiver.">
        <div class="book-cover">
          <img src="../pics/33.webp" alt="Couverture L'Atelier des souvenirs">
          <div class="overlay">
            <button class="quick-add" aria-label="Ajouter à ma liste"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="book-info">
          <h3 class="book-title">L'Atelier des souvenirs</h3>
          <p class="book-author">par C. Martin</p>
          <span class="book-tag">Feel-good</span>
        </div>
      </article>

       <!-- Card 2 -->
       <article class="book-card" data-synopsis="Une saga familiale poignante qui traverse trois générations.">
        <div class="book-cover">
          <img src="../pics/22.webp" alt="Couverture Les Jardins de cendre">
          <div class="overlay">
            <button class="quick-add" aria-label="Ajouter à ma liste"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="book-info">
          <h3 class="book-title">Les Jardins de cendre</h3>
          <p class="book-author">par M. El-Hassan</p>
          <span class="book-tag">Roman historique</span>
        </div>
      </article>

    </div>

     

    <!-- Carousel wrapper -->
    <div class="books-carousel" id="booksCarousel">
      <button class="carousel-btn prev" aria-label="Précédent"><i class="fa-solid fa-chevron-left"></i></button>
      <div class="carousel-track">
        <!-- Clones via JS -->
      </div>
      <button class="carousel-btn next" aria-label="Suivant"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    <!-- Modal quick-view -->
    <div class="modal" id="quickViewModal">
      <div class="modal-content">
        <button class="close-modal" aria-label="Fermer"><i class="fa-solid fa-xmark"></i></button>
        <div class="modal-grid">
          <img id="modalCover" src="" alt="">
          <div>
            <h3 id="modalTitle"></h3>
            <p id="modalAuthor"></p>
            <p id="modalSynopsis"></p>
            <button class="cta-btn">Demander en échange</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* ---------- NOUVEAUTÉS SECTION ---------- */
.new-books-section {
  padding: 80px 0;
  position: relative;
  overflow: hidden;
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: 0 auto;
}

.section-title {
  text-align: center;
  font-size: 2.4rem;
  color: var(--dark-blue);
  margin-bottom: 2.5rem;
  position: relative;
  display: inline-block;
  left: 50%;
  transform: translateX(-50%);
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: var(--accent);
  border-radius: 2px;
}

/* View toggle */
.view-toggle {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 2.5rem;
}

.toggle-btn {
  background: #fff;
  border: 2px solid var(--dark-blue);
  color: var(--dark-blue);
  padding: 0.5rem 1.2rem;
  border-radius: 30px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s;
}

.toggle-btn.active,
.toggle-btn:hover {
  background: var(--dark-blue);
  color: #fff;
}

/* Grid */
.books-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 2rem;
}

.book-card {
  background: #fff;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
  transition: transform 0.4s cubic-bezier(.25, .8, .25, 1), box-shadow 0.4s;
  position: relative;
}

.book-card:hover {
  transform: translateY(-8px) scale(1.02);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
}

.book-cover {
  position: relative;
  height: 280px;
  overflow: hidden;
}

.book-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s;
}

.book-card:hover .book-cover img {
  transform: scale(1.1);
}

.overlay {
  position: absolute;
  inset: 0;
  background: rgba(33, 62, 94, 0.75);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.4s;
}

.book-card:hover .overlay {
  opacity: 1;
}

.quick-add {
  background: #fff;
  color: var(--dark-blue);
  border: none;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1.2rem;
  transition: background 0.3s, color 0.3s;
}

.quick-add:hover {
  background: var(--accent);
  color: #fff;
}

.book-info {
  padding: 1rem 1.2rem 1.4rem;
}

.book-title {
  font-size: 1.1rem;
  margin-bottom: 0.3rem;
  color: var(--dark-blue);
}

.book-author {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 0.8rem;
}

.book-tag {
  display: inline-block;
  background: var(--accent);
  color: #fff;
  padding: 0.25rem 0.7rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
}

/* Carousel */
.books-carousel {
  display: none;
  position: relative;
  align-items: center;
  gap: 1rem;
}

.books-carousel.active {
  display: flex;
}

.carousel-track {
  display: flex;
  gap: 1.5rem;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding: 1rem 0.2rem;
  flex: 1;
}

.carousel-track::-webkit-scrollbar {
  height: 6px;
}

.carousel-track::-webkit-scrollbar-thumb {
  background: var(--dark-blue);
  border-radius: 3px;
}

.carousel-btn {
  background: #fff;
  border: 2px solid var(--dark-blue);
  color: var(--dark-blue);
  width: 44px;
  height: 44px;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s;
}

.carousel-btn:hover {
  background: var(--dark-blue);
  color: #fff;
}

/* Modal */
.modal {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2000;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s;
}

.modal.show {
  opacity: 1;
  pointer-events: auto;
}

.modal-content {
  background: #fff;
  border-radius: 16px;
  max-width: 700px;
  width: 90%;
  padding: 2rem;
  position: relative;
  animation: popIn 0.4s cubic-bezier(.25, .8, .25, 1);
}

@keyframes popIn {
  from {
    transform: scale(0.9);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

.close-modal {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: var(--dark-blue);
}

.modal-grid {
  display: grid;
  grid-template-columns: 200px 1fr;
  gap: 2rem;
  align-items: start;
}

.modal-grid img {
  width: 100%;
  border-radius: 8px;
}

.cta-btn {
  margin-top: 1rem;
  background: var(--accent);
  color: #fff;
  border: none;
  padding: 0.7rem 1.4rem;
  border-radius: 30px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s;
}

.cta-btn:hover {
  background: #ff6a3c;
}

/* Responsive */
@media (max-width: 600px) {
  .section-title {
    font-size: 2rem;
  }
  .modal-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<script>
/* ---------- NOUVEAUTÉS SCRIPT ---------- */
const viewToggles = document.querySelectorAll('.toggle-btn');
const gridView = document.getElementById('booksGrid');
const carouselView = document.getElementById('booksCarousel');
const track = carouselView.querySelector('.carousel-track');
const modal = document.getElementById('quickViewModal');
const bookCards = document.querySelectorAll('.book-card');

// Toggle grid / carousel
viewToggles.forEach(btn => {
  btn.addEventListener('click', () => {
    viewToggles.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    if (btn.dataset.view === 'carousel') {
      gridView.style.display = 'none';
      carouselView.classList.add('active');
      populateCarousel();
    } else {
      gridView.style.display = 'grid';
      carouselView.classList.remove('active');
    }
  });
});

// Populate carousel
function populateCarousel() {
  track.innerHTML = '';
  bookCards.forEach(card => {
    const clone = card.cloneNode(true);
    clone.classList.add('carousel-card');
    track.appendChild(clone);
  });
}

// Carousel nav
document.querySelector('.carousel-btn.next').addEventListener('click', () => {
  track.scrollBy({ left: 240, behavior: 'smooth' });
});
document.querySelector('.carousel-btn.prev').addEventListener('click', () => {
  track.scrollBy({ left: -240, behavior: 'smooth' });
});

// Quick view modal
bookCards.forEach(card => {
  card.addEventListener('click', e => {
    if (e.target.closest('.quick-add')) return;
    const img = card.querySelector('img').src;
    const title = card.querySelector('.book-title').textContent;
    const author = card.querySelector('.book-author').textContent;
    const synopsis = card.dataset.synopsis;

    document.getElementById('modalCover').src = img;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalAuthor').textContent = author;
    document.getElementById('modalSynopsis').textContent = synopsis;
    modal.classList.add('show');
  });
});

modal.querySelector('.close-modal').addEventListener('click', () => modal.classList.remove('show'));
modal.addEventListener('click', e => {
  if (e.target === modal) modal.classList.remove('show');
});
</script>

<!-- Footer Section -->
<footer style="background:#213e5e; color:#ffffff; padding:60px 0 40px; font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;">
  <div style="max-width:1200px; margin:0 auto; display:flex; flex-wrap:wrap; gap:40px; justify-content:space-between;">

    <!-- Brand & About -->
    <div style="flex:1 1 250px;">
      <h3 style="margin-bottom:16px; font-size:22px; letter-spacing:1px;">BookShare | CMC</h3>
      <p style="font-size:14px; line-height:1.6; opacity:.9;">
        La plateforme étudiante pour partager, découvrir et redonner vie aux livres. 
        Ensemble, cultivons la lecture sans contraintes.
      </p>
    </div>

    <!-- Quick Links -->
    <div style="flex:1 1 180px;">
      <h4 style="margin-bottom:16px; font-size:18px;">Navigation</h4>
      <ul style="list-style:none; padding:0;">
        <li style="margin-bottom:8px;"><a href="/" style="color:#ffffff; text-decoration:none; opacity:.85; transition:opacity .2s;">Accueil</a></li>
        <li style="margin-bottom:8px;"><a href="/catalogue.php" style="color:#ffffff; text-decoration:none; opacity:.85; transition:opacity .2s;">Catalogue</a></li>
        <li style="margin-bottom:8px;"><a href="/publish.php" style="color:#ffffff; text-decoration:none; opacity:.85; transition:opacity .2s;">Publier un livre</a></li>
        <li style="margin-bottom:8px;"><a href="/contact.php" style="color:#ffffff; text-decoration:none; opacity:.85; transition:opacity .2s;">Contact</a></li>
      </ul>
    </div>

    <!-- Payment Methods -->
    <div style="flex:1 1 220px;">
      <h4 style="margin-bottom:16px; font-size:18px;">Moyens de paiement</h4>
      <div style="display:flex; gap:12px; align-items:center;">
        <!-- Payment method images -->
        <img src="https://www.workker.fr/img/cms/logo-stripe%20(1).png" alt="Visa" style="height:65px;">
      
      </div>

      <p style="margin-top:12px; font-size:12px; opacity:.7;">Paiement sécurisé & crypté SSL 256-bit</p>
    </div>

    <!-- Social & Legal -->
    <div style="flex:1 1 220px;">
      <h4 style="margin-bottom:16px; font-size:18px;">Suivez-nous</h4>
      <div style="display:flex; gap:12px; margin-bottom:20px;">
        <a href="#" aria-label="Facebook" style="color:#ffffff; font-size:20px;"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram" style="color:#ffffff; font-size:20px;"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" aria-label="Twitter" style="color:#ffffff; font-size:20px;"><i class="fa-brands fa-twitter"></i></a>
        <a href="#" aria-label="LinkedIn" style="color:#ffffff; font-size:20px;"><i class="fa-brands fa-linkedin-in"></i></a>
      </div>
      <ul style="list-style:none; padding:0; font-size:12px; opacity:.7;">
        <li style="margin-bottom:6px;"><a href="/terms.php" style="color:#ffffff; text-decoration:none;">Conditions d'utilisation</a></li>
        <li style="margin-bottom:6px;"><a href="/privacy.php" style="color:#ffffff; text-decoration:none;">Politique de confidentialité</a></li>
        <li><a href="/cookies.php" style="color:#ffffff; text-decoration:none;">Gestion des cookies</a></li>
      </ul>
    </div>
  </div>

  <!-- Bottom line -->
  <div style="text-align:center; margin-top:40px; padding-top:20px; border-top:1px solid rgba(255,255,255,.2); font-size:12px; opacity:.7;">
    © <?= date('Y') ?> BookShare CMC. Tous droits réservés.
  </div>
</footer>

<!-- Back-to-top button -->
<a href="#top" aria-label="Retour en haut" style="position:fixed; bottom:24px; right:24px; width:44px; height:44px; background:#c7581c; color:#ffff; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 12px rgba(0,0,0,.15); transition:transform .2s, background .2s; text-decoration:none; z-index:999;" onclick="window.scrollTo({top:0, behavior:'smooth'}); return false;">
  <i class="fa-solid fa-arrow-up"></i>
</a>


</html>

