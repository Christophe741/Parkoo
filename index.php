<!DOCTYPE html>
<html lang="fr">

<?php require_once 'includes/head.php';?>

 <body>

 <?php require_once 'includes/desktop_header.php';?>

<main class="hero">
  <h1 class="logo">Parkoo</h1>
  
  <section class="search_section">
    <h2 class="subtitle">Le Parking Partagé</h2>

    <div class="hero__buttons">
      <a href="search.php" class="btn btn--light">Trouver une place</a>
      <a href="#" class="btn btn--dark">Partager une place</a>
    </div>
  </section>
</main>
  <section class="about">
    <h2 class="subtitle">Parkoo, le parking simplifié entre particuliers</h2>
    <p>
      Parkoo est une plateforme qui permet de trouver et réserver facilement 
      une place de parking disponible chez des particuliers, partout en France.
      Que vous soyez conducteur à la recherche d'un stationnement ou propriétaire 
      d'une place libre, Parkoo vous connecte pour vous offrir confort et simplicité 
      au quotidien.
    </p>
  </section>
  <nav class="bottom-nav">
    <a href="#">Accueil</a>
    <a href="#">Trouver une place</a>
    <a href="#">Connexion</a>
  </nav>

  <?php require_once 'includes/bottom_nav.php';?>
  <?php require_once 'includes/footer.php';?>

</body>
</html>
