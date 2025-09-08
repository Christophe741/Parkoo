<!DOCTYPE html>
<html lang="fr">

<?php require_once 'includes/head.php';?>

<body>

 <?php require_once 'includes/desktop_header.php';?>

<main class="page-layout">
  <h1 class="logo">Parkoo</h1>
    
  <section class="search-hero">
   <h1 class="title">Trouvez une place</h1>
   <form id="search-form" class="search-form">
     <input class="search-input" type="text" name="city" placeholder="Rechercher par ville">
     <button class="search-button" type="submit">Rechercher</button>
   </form>
  </section>
  
  <section class="results">
     <div id="results"></div>
       <template id="parking-card-template">
          <div class="parking-card">
           <img class="photo" src="" alt="" />
           <p class="city"></p>
           <p class="display-name"></p>
           <p class="description"></p>
           <p class="price"></p>
          </div>
       </template>
       <template id="message-template">
        <p class="message"></p>
      </template>
  </section>
</main>

 <?php require_once 'includes/bottom_nav.php';?>
 
 <script type="module" src="js/search.js"></script>
 <?php require_once 'includes/footer.php';?>

</body>
</html>
