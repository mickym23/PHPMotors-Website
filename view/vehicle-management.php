<?php

if ((isset($_SESSION['loggedin'])) && ($_SESSION['clientData']['clientLevel'] > 1)) {
} else {
   header('Location: /phpmotors/');
   exit;
}

if ($_SESSION['clientData']['clientLevel'] < 2) {
   header('location: /phpmotors/');
   exit;
}

if (isset($_SESSION['message'])) {
   $message = $_SESSION['message'];
}

?>
<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Vehicle Management | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Vehicle Management page for PHP Motors, CSE340, Mikhail Cedras">

      <!-- Imported CSS Stylesheets -->
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
   <h1 class = "vManH">Vehicle Management</h1>

   <!-- Display Message -->
   <?php
      if (isset($message)) {
         echo $message;
      }
   ?>
   <noscript>
      <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
   </noscript>

   
   <!-- Unordered to display two management options -->
   <ul>
      <li><a class=  "vMan" href = "/phpmotors/vehicles/?action=showClassification">Add Classification</a></li>
      <li><a class = "vMan" href = "/phpmotors/vehicles/?action=showVehicle">Add Vehicle</a></li>
   </ul>

   <?php    
   if (isset($classificationList)) { 
      echo '<h2 class="vClassH2">Vehicles By Classification</h2>'; 
      echo '<p class="vClassP">Choose a classification to see those vehicles</p>'; 
      echo $classificationList; 
   }
  ?>
   <div class="vTableDiv">
   <table id = "inventoryDisplay" class = "vTable"></table>
   </div>
   <hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

<script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>