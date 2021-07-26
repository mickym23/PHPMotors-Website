<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information & Title -->
      <title>Home | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Home page for PHP Motors, CSE340, Mikhail Cedras">

      <!-- Imported Local CSS Stylesheets -->
      <link rel = "stylesheet" href = "/phpmotors/css/small.css">
      <link rel = "stylesheet" media = "screen and (min-width: 600px)" href = "/phpmotors/css/medium.css">
      <link rel = "stylesheet" media = "screen and (min-width: 900px)" href = "/phpmotors/css/large.css">
   </head>

<body>

<!-- Import Header code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>

<!-- Import Navigation code snippet -->
<nav><?php //require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php'; 
 echo $navList; ?></nav>

<main>
   <h1 class = "welcomePhrase">Welcome to PHP Motors!</h1>
  
   <!-- Delorean Description, Image, and Order Button -->
   <div class= "deloreanSpecial">
      <p class = "deloreanDescription"><span class = "delorean">DMC Delorean</span><br>
      3 Cup holders<br>
      Superman doors<br>
      Fuzzy dice!</p>
   
      <img class= "deloreanImage" src = "/phpmotors/images/vehicles/delorean.jpg" alt="Image of Delorean Car">
      <a href="#"><img class= "ownToday" src= "/phpmotors/images/site/own_today.png" alt = "Button Image to Own a Delorean Today"></a>
   </div>

   <!-- Grid Containers -->
   <section class = "grid">
      <div class = "grid-container">
         <div class = "grid=item1">
            <div class= "reviews">
               <h2 class = "reviewsTitle">DMC Delorean Reviews</h2>
               <ul class="reviewsList">
                  <li>"So fast its almost like traveling in time." (4/5)</li>
                  <li>"Coolest ride on the road." (4/5)</li>
                  <li>"I'm feeling Marty McFly!" (5/5)</li>
                  <li>"The most futuristic ride of our day." (4.5/5)</li>
                  <li>"80's livin and I love it!"</li>
               </ul>
            </div>
         </div>
   

         <div class = "grid-item2">
            <h2 class = "upgradesTitle">Delorean Upgrades</h2>
         <!-- Flexbox for the Upgrades section -->
         <div class="upgrades">
            <div class="row">
               <div class="column">
                  <div class = "fluxCap">
                     <img src="/phpmotors/images/upgrades/flux-cap.png" alt = "Image of Flux Cap">
                     <a href = "#"><p>Flux Capacitor</p></a>
                  </div>
               </div>

               <div class="column">
                  <div class = "flameCol">
                     <img class= "flameIMG" src="/phpmotors/images/upgrades/flame.jpg" alt = "Image of Flame Decal">
                     <p><a href = "#">Flames Decals</a></p>
                  </div>
               </div>
            </div>


            <div class="row">
               <div class= "column">
                  <div class = "bumperSticker">
                     <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt = "Image of Bumper sticker">
                     <a href = "#"><p>Bumper Stickers</p></a>
                  </div>
               </div>

            <div class="column">
               <div class = "hubCap">
                  <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt = "Image of Hub Cap">
                  <a href = "#"><p>Hub Caps</p></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</section> 

<!-- Horizontal Line -->
<br><hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>

</html>

