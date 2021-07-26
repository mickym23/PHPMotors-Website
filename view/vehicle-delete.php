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
      <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	      echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	   elseif(isset($invMake) && isset($invModel)) { 
		   echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
<h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
	echo "Delete $invMake $invModel"; }?></h1><br>

<p class="deletionMessage">Confirm Vehicle Deletion. The delete is permanent.</p>
   
   <!-- Display Message -->
   <?php
      if (isset($message)) {
         echo $message;
      }
   ?>

<!-- Get Form Data for new vehicle addition -->
<form class = "loginSignUpForm" action = "/phpmotors/vehicles/index.php" method = "post">

    <!-- Sticky form input with client-side validation -->   
   <br><label for="invMake">Make</label><br>
   <input type  ="text" id="invMake" name="invMake" placeholder="Modify Make: " 
      <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>
   required><br>
   
   <label for="invModel">Model</label><br>
   <input type  ="text" id="invModel" name="invModel" placeholder="Modify Model: " 
      <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>
   required><br>

   <label for="invDescription">Description</label><br>
   <textarea class="textBoxVehicle" id="invDescription" name="invDescription" cols="25" rows="10" placeholder="Modify Description: " 
   required><?php if(isset($invDescription)){echo$invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

   <button class = "loginSignUpButton" type="submit" name="updateInventory">Delete Vehicle</button>
   <input type="hidden" name="action" value="deleteVehicle">
   <input type = "hidden" name="invId" value ="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
                                                       
</form>

<br><br><hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>