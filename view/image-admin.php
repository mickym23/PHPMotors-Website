<?php
   if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
     }
?>
<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Image Management | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Template page for PHP Motors, CSE340, Mikhail Cedras">

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

<main class="uploadMain">
   <h1>Image Management</h1><br>

   <h2 class="uploadH2">Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <div class="vUploadDropdown"><label for="invItem">Vehicle Selection</label><br>
	<?php echo $prodSelect; ?></div>
	<fieldset class="radioField">
		<label>Is this the main image for the vehicle?</label><br>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
   <div class = "uploadFileDiv">
 <span><label class="uploadLabel">Upload Image:</label>
 <input class="chooseFile" type="file" name="file1"></span><br>
 <input class="uploadButton" type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
   </div>
</form>

   <hr>

   <h2 class="uploadH2">Existing Images</h2>
<p class="message2 warning" >If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>

 
</main>

<hr>
<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>

</html>
<?php unset($_SESSION['message']); ?>