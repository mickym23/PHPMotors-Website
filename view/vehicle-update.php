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
	      echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	   elseif(isset($invMake) && isset($invModel)) { 
		   echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
	echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
	echo "Modify $invMake $invModel"; }?></h1><br>
  
   <!-- Display Message -->
   <?php
      if (isset($message)) {
         echo $message;
      }
   ?>

<!-- Get Form Data for new vehicle addition -->
<form class = "loginSignUpForm" action = "/phpmotors/vehicles/index.php" method = "post">

   <!-- Drop Down List -->
   <?php // Build the classifications option list
$classifList = '<select class="dropdownList2" name="classificationId" id="classificationId">';
$classifList .= "<option>Choose a Car Classification</option>";
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
?>

    <!-- Sticky form input with client-side validation -->   
   <br><label for="invMake">Make</label><br>
   <input type  ="text" id="invMake" name="invMake" placeholder="Modify Make: " 
      <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>
   readonly><br>
   
   <label for="invModel">Model</label><br>
   <input type  ="text" id="invModel" name="invModel" placeholder="Modify Model: " 
      <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>
   readonly><br>

   <label for="invDescription">Description</label><br>
   <textarea class="textBoxVehicle" id="invDescription" name="invDescription" cols="25" rows="10" placeholder="Modify Description: " 
   readonly><?php if(isset($invDescription)){echo$invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

   <label for="invImage">Image Path</label><br>
   <input type  ="text" id="invImage" name="invImage" placeholder="Modify Image Path: " 
   <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>
   required><br>
   
   <label for="invThumbnail">Thumbnail Path</label><br>
   <input type  ="text" id="invThumbnail" name="invThumbnail" placeholder="Modify Thumbnail Path: " 
   <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>
   required><br>

   <label for="invPrice">Price</label><br>
   <input type  ="text" id="invPrice" name="invPrice" placeholder="Modify Price: " 
   <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>
   required><br>

   <label for="invStock"># In Stock</label><br>
   <input type  ="text" id="invStock" name="invStock" placeholder="Modify Stock Amount: " 
   <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>
   required><br>

   <label for="invColor">Color</label><br>
   <input type  ="text" id="invColor" name="invColor" placeholder="Modify Color: " 
   <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>
   required><br>

   <button class = "loginSignUpButton" type="submit" name="updateInventory">Update Vehicle</button>
   <input type="hidden" name="action" value="updateVehicle">
   <input type = "hidden" name="invId" value ="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                                                      elseif(isset($invId)){ echo $invId; } ?>">
                                                       
</form>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>