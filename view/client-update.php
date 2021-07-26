<?php
   if (!$_SESSION['loggedin']) {
      header('Location: /phpmotors');
   }
?>
<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Client Update | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Client Update page for PHP Motors, CSE340, Mikhail Cedras">

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
   <h1>Client Update</h1><br>

   <!-- Account Update Section -->
   <div class="updateBorder">
   <h2 class="vManH2 updateH2">Account Update</h2>

    <!-- Display Message -->
    <?php
      if (isset($message)) {
         echo $message;
      }
   ?>

   <form class="loginSignUpForm formBorder" method="POST" action="/phpmotors/accounts/">

   <label for="clientFirstname">First Name</label><br>
   <input type  ="text" id="clientFirstname" name="clientFirstname" placeholder="Enter First Name: " 
      <?php  $clientFirstname = $_SESSION['clientData']['clientFirstname']; if(isset($clientFirstname)){echo "value='$clientFirstname'";}?>
   required><br>

   <label for="clientLastname">Last Name</label><br>
   <input type  ="text" id="clientLastname" name="clientLastname" placeholder="Enter Last Name: " 
      <?php $clientLastname = $_SESSION['clientData']['clientLastname']; if(isset($clientLastname)){echo "value='$clientLastname'";}?>
   required><br>

   <label for="clientEmail">Email Address</label><br>
   <input type  ="email" id="clientEmail" name="clientEmail" placeholder="Enter Email Address: " 
      <?php  $clientEmail = $_SESSION['clientData']['clientEmail']; if(isset($clientEmail)){echo "value='$clientEmail'";}?>
   required><br>

   <button class = "loginSignUpButton updateButton" type="submit" name="upAccount">Update Account</button>
   <input type="hidden" name="action" value="updateAccount">
   <input type = "hidden" name="clientId" value ="<?php $clientId = $_SESSION['clientData']['clientId']; if(isset($clientId)){ echo $clientId;} ?>">
   </form>
   </div> <!-- End of Account Update Section -->


   <!-- Password Update Section -->
   <div class="updateBorder">
   <h2 class="vManH2 updateH2">Update Password</h2>

   <!-- Display Message -->
   <?php
      if (isset($messageP)) {
         echo $messageP;
      }
   ?>
   
   <form class="loginSignUpForm formBorder" method="POST" action="/phpmotors/accounts/">
   <p class="adDescrip updateP2">Note* your original password will be changed.</p>
   
   <label for="clientPassword">Enter New Password: <br></label><br>
   <span class="passwordInfo updateP">(Must contain at least 8 characters, 1 number, 1 capital letter, and 1 special character)</span><br>
   <input type="password" id="clientPassword" name="clientPassword" placeholder="Enter Password"  pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>

   <button class = "loginSignUpButton updateButton" type="submit" name="upPass">Update Password</button>
   <input type="hidden" name="action" value="updatePassword">
   <input type = "hidden" name="clientId" value ="<?php $clientId = $_SESSION['clientData']['clientId']; if(isset($clientId)){ echo $clientId;} ?>">
   </form>
   </div> <!-- End of Password Update section -->

   <hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
</body>
</html>