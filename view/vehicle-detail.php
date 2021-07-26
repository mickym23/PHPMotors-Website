<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title><?php echo $invData[0]['invMake']." ".$invData[0]['invModel']; ?> | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Vehicle Detail page for PHP Motors, CSE340, Mikhail Cedras">

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

<main class='vDetail'>
   <h1 class='adminHeader'><?php echo $invData[0]['invMake']." ".$invData[0]['invModel']; ?></h1><br>

   <?php if(isset($message)){
 echo $message; }
 ?>
   
   <?php  echo $displayDetails; echo $displayThumbs;?>
   

   <form action = "/phpmotors/reviews/" method="post">
      <h2 class="vManH2 vDetH2">Customer Reviews</h2>

      <?php 
      if (isset($_SESSION['loggedin'])) {
      if(isset($_SESSION['messageReview'])) {echo $_SESSION['messageReview']; unset($_SESSION['messageReview']);}
      echo '<div class="reviewSection customerReviews"><div class="writeReview"><p class="embeddedReviewName">'.substr( $_SESSION['clientData']['clientFirstname'],0,1).$_SESSION['clientData']['clientLastname'].'</p><label for="reviewText" class="reviewTextForm">ReviewText</label><textarea id="reviewText" name = "reviewText" class="vDetReviewsArea"></textarea>'; 
      echo '<button type="submit" name="submitReview" class="loginSignUpButton reviewButton">Add Review</button>';
      echo '<input type="hidden" name="action" value="addReview">';
      echo '<input type = "hidden" name="invId" value ="'; if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                                                      elseif(isset($invId)){ echo $invId; } echo '">';
      echo '<input type = "hidden" name="clientId" value ="'; if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                                                      elseif(isset($clientId)){ echo $clientId; } echo '"></div></div>';

      } else { echo '<p class="loginReview"><a href = "/phpmotors/accounts/?action=login">Log into your account</a> to write a review!</p>'; }?>

      <br>

      <?php if (empty($getInvReviews)) {
          echo '<p class="noReviews firstRev"><em>Be the first to review this car!</em></p>';
      } else {
         echo $displayReviews;
      }
      ?>
   </form>

      <br><br><br>
   <hr class="detailsHR">


</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>

</html>