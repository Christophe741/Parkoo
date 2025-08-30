<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parkoo</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

  <header class="desktop-header">
  <a href="index.php" class="logo">Parkoo</a>
  <nav class="desktop-nav">
    <a href="search.php">Trouver une place</a>
    <a href="#">Partager une place</a>
    <a href="#">Se connecter</a>
  </nav>
</header>

<main class="hero">
  <h1 class="logo">Parkoo</h1>
    <section class="results">
     <h2 class="subtitle">Résultats de recherche</h2>
     <div id="results">
       <template id="parking-card">
         <p>test</p>
       </template>
     </div>
   </section>
</main>

  <nav class="bottom-nav">
    <a href="#">Accueil</a>
    <a href="#">Trouver une place</a>
    <a href="#">Connexion</a>
  </nav>

  <footer class="footer">
    <div class = "footer-container">
      <p>&copy; 2025 Parkoo. Tous droits réservés.</p>
      <a href="#" class="legal">Mentions légales</a>
    </div>
</footer>

</body>
</html>
