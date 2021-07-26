<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Account Registration | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Registration page for PHP Motors, CSE340, Mikhail Cedras">

      <!-- Imported CSS Stylesheets -->
      <link rel = "stylesheet" href = "../css/small.css">
      <link rel = "stylesheet" media = "screen and (min-width: 600px)" href = "../css/medium.css">
      <link rel = "stylesheet" media = "screen and (min-width: 900px)" href = "../css/large.css">

      <script src="../js/scripts.js"></script>
   </head>

<body>

<!-- Import Header code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>

<!-- Import Navigation code snippet -->
<nav><?php //require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php'; 
echo $navList; ?></nav>

<main>
   <h1 class = "signInTitle">Register</h1><br>

   <?php
      if (isset($message)) {
         echo $message;
      }
   ?>
   
   <form class = "loginSignUpForm" action="/phpmotors/accounts/index.php" method="post">
   <p class = "fieldRequire">All fields are required*</p>

   <!-- Sticky form input with client-side validation -->
   <label for="firstName">First Name:</label><br>
   <input type="text" id="clientFirstname" name="clientFirstname" placeholder="E.g. Bob" 
      <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>
   required><br>

   <label for="lastName">Last Name:</label><br>
   <input type="text" id="clientLastname" name="clientLastname" placeholder="E.g. Ross" 
      <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>
   required><br>

   <label for="email">Email Address:</label><br>
   <input type="email" id="clientEmail" name="clientEmail" placeholder="E.g. user@example.com" 
      <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
   required><br>

   <label for="password">Enter Password: <br></label><br>
   <span class="passwordInfo">(Must contain at least 8 characters, 1 number, 1 capital letter, and 1 special character)</span><br>
   <input type="password" id="clientPassword" name="clientPassword" placeholder="Enter Password"  pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>

   <!--  <input type="checkbox" onclick="showPassword()" id="showp"><label class="showPassword" for ="showp">Show Password</label> -->

   <button class="loginSignUpButton" type="submit" name="submit" id="regbtn" value="Register">Register</button>
   <input type="hidden" name="action" value="register">
   </form>

   <br><br>

   <hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>

</html>