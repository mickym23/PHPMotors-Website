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

?>
<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Add Classification | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Add Classification page for PHP Motors, CSE340, Mikhail Cedras">

      <!-- Imported CSS Stylesheets -->
      <link rel = "stylesheet" href = "/phpmotors/css/small.css">
      <link rel = "stylesheet" media = "screen and (min-width: 600px)" href = "/phpmotors/css/medium.css">
      <link rel = "stylesheet" media = "screen and (min-width: 900px)" href = "/phpmotors/css/large.css">

      
   </head>

<body>
<script src="/phpmotors/js/scripts.js"></script>
<!-- Import Header code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>

<!-- Import Navigation code snippet -->
<nav><?php //require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php'; 
echo $navList; ?></nav>

<main>
   <h1 class = "vManH">Add Classification</h1><br>

   <!-- Display Server Message -->
   <?php
      if (isset($message)) {
         echo $message;
      }
   ?>
   
   <!-- Get Form Data for new classification name -->
   <form class = "loginSignUpForm" action = "/phpmotors/vehicles/index.php" method = "post">

   <!-- Sticky form input with client-side validation -->   
   <label for="classificationName">Classification Name</label><br>
   <input type  ="text" id="classificationName" name="classificationName" placeholder="Please enter a new classification name" 
   <?php if(isset($classificationName)){echo "value='$classificationName'";}?> 
   required><br>
   
   <button class = "loginSignUpButton" type="submit" name="enterClassification">Add</button>
   <input type = "hidden" name="action" value ="addClassification">
   </form>

   
   <br><hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>