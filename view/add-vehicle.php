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
      <title>Add Vehicle | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Add Vehicle page for PHP Motors, CSE340, Mikhail Cedras">

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
   <h1 class=  "vManH">Add Vehicle</h1><br>
   
   <!-- Display Message -->
   <?php
      if (isset($message)) {
         echo $message;
      }
   ?>

<!-- Get Form Data for new vehicle addition -->
<form class = "loginSignUpForm" action = "/phpmotors/vehicles/index.php" method = "post">

   <!-- Drop Down List -->
   <label for = "classificationId">Choose Car Classification: </label><br>
   <?php 
    $classifList = '<select class="dropdownList2" name="classificationId" id="classificationId">';
    foreach ($classifications as $classification) {
     $classifList .= "<option value='$classification[classificationId]'";
     if(isset($classificationId)){
      if($classification['classificationId'] === $classificationId){
       $classifList .= ' selected ';
      }
     } elseif(isset($invInfo['classificationId'])){
     if($classification['classificationId'] === $invInfo['classificationId']){
      $classifList .= ' selected ';
     }
    }
    $classifList .= ">$classification[classificationName]</option>";
    }
    $classifList .= '</select>';
    
    echo $classifList;
   ?><br>

    <!-- Sticky form input with client-side validation -->   
   <label for="invMake">Make</label><br>
   <input type  ="text" id="invMake" name="invMake" placeholder="Enter Make: " 
      <?php if(isset($invMake)){echo "value='$invMake'";}?>
   required><br>
   
   <label for="invModel">Model</label><br>
   <input type  ="text" id="invModel" name="invModel" placeholder="Enter Model: " 
      <?php if(isset($invModel)){echo "value='$invModel'";}?>
   required><br>

   <label for="invDescription">Description</label><br>
   <textarea class="textBoxVehicle" id="invDescription" name="invDescription" cols="25" rows="10" placeholder="Enter Description: " 
   required><?php if(isset($invDescription)){echo$invDescription;}?></textarea><br>

   <label for="invImage">Image Path</label><br>
   <input type  ="text" id="invImage" name="invImage" placeholder="Enter Image Path: " value="/phpmotors/images/no-image.png" 
   <?php if(isset($invImage)){echo "value='$invImage'";}?>
   required><br>
   
   <label for="invThumbnail">Thumbnail Path</label><br>
   <input type  ="text" id="invThumbnail" name="invThumbnail" placeholder="Enter Thumbnail Path: " value="/phpmotors/images/no-image.png" 
   <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}?>
   required><br>

   <label for="invPrice">Price</label><br>
   <input type  ="text" id="invPrice" name="invPrice" placeholder="Enter Price: " 
   <?php if(isset($invPrice)){echo "value='$invPrice'";}?>
   required><br>

   <label for="invStock"># In Stock</label><br>
   <input type  ="text" id="invStock" name="invStock" placeholder="Enter Stock Amount: " 
   <?php if(isset($invStock)){echo "value='$invStock'";}?>
   required><br>

   <label for="invColor">Color</label><br>
   <input type  ="text" id="invColor" name="invColor" placeholder="Enter Color: " 
   <?php if(isset($invColor)){echo "value='$invColor'";}?>
   required><br>

   <button class = "loginSignUpButton" type="submit" name="enterInventory">Add Vehicle</button>
   <input type = "hidden" name="action" value ="addVehicle">
</form>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>