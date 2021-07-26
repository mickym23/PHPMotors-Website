<?php
if (!$_SESSION['loggedin']) {
   header('Location: /phpmotors');
}
if (isset($_SESSION['message'])) {
  // $message = $_SESSION['message'];

}
?>
<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Admin | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Admin page for PHP Motors, CSE340, Mikhail Cedras">

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

<!-- Personalized Header -->
   <h1 class="adminHeader">
   <?php 
      $firstname = $_SESSION['clientData']['clientFirstname']; 
      $lastname = $_SESSION['clientData']['clientLastname'];
      
      echo $firstname, ' ', $lastname;
         ?>
   </h1>

    <!-- Display Message -->
    <?php
      if (isset($_SESSION['message'])) {
         echo $_SESSION['message']; unset($_SESSION['message']);
      }
   ?>

   <!-- Logged in Message --->
   <p class="adminMessage">You are logged in.</p>

      <!-- Listing User's Details -->
      <ul class="dataList">
         <li class="adminList">First name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
         <li class="adminList">Last name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
         <li class="adminList">Email address: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
      </ul>

      <!-- Account Update Section -->
      <div class = "updateAccInfo">
         <h2 class="vManH2">Update Account Information</h2>
         <p class="adDescrip">Use this link to enter account update options:</p>
         <p class="adminP"><a class="adUpAcc" href="/phpmotors/accounts/?action=showClientUpdate">Update Account</a></p>
      </div>

      <div class="manageReviews">
         <h2 class="vManH2">Manage Reviews</h2>
         
         <?php if (empty($clientReviews)) {
            echo '<p class="noReviews"><em>You have not reviewed any cars.</em></p>';
         } else {
            echo $displayReviews;
         }
         ?>


      </div>

      <br>

      <!-- Vehicle Management Section for Admin -->
      <?php 
         if ($_SESSION['clientData']['clientLevel'] > 1) {
            echo "<h2 class='vManH2'>Vehicle Management</h2>";
            echo "<p class='adDescrip'>Use this link to access vehicle management options:</p>";
            echo "<p class = 'adminP'><a class='vManagement' href='/phpmotors/vehicles/'>Manage Vehicles</a></p>";
         }
      ?>

      
   <hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>