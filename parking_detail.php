<!DOCTYPE html>
<html lang="fr">

<?php require_once 'includes/head.php';?>

<body>

 <?php require_once 'includes/desktop_header.php';?>

<main class="page-layout">
  <section class="results">
     <div id="results"></div>
       <template id="parking-card-template">
          <div class="parking-card">
           <img class="photo" src="" alt="" />
            <h1 class="display-name"></h1>
           <p class="city"></p>
           <p class="description"></p>
           <p><strong>Parking couvert :</strong> <span class="is-covered"></span></p>
           <p><strong>Accès handicapés :</strong> <span class="is-accessible"></span></p>
           <p><strong>Recharge éléctrique :</strong> <span class="has-ev-charging"></span></p>
           <p class="price"></p>
          </div>
       </template>
       <template id="message-template">
        <p class="message"></p>
      </template>
      <template id="reviews-template">
        <section class="reviews">
          <h2 class="reviews-title"></h2>
          <div class="reviews-list">
            <div class="review review-model">
               <p class="reviewer-name"></p>
               <p class="rating"></p>
               <p class="comment"></p>
            </div>
          </div>
        </section>
      </template>
  </section>
</main>

 <?php require_once 'includes/bottom_nav.php';?>
 
<script type="module" src="js/parking-detail.js"></script>
 <?php require_once 'includes/footer.php';?>

</body>
</html>
