<!DOCTYPE HTML>
<html lang = "en-us">
   <head>
      <!-- Meta Information -->
      <title>Account Login | PHP Motors</title>
      <meta charset = "UTF-8">
      <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
      <meta name = "description" content = "Login page for PHP Motors, CSE340, Mikhail Cedras">

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
   <h1 class = "signInTitle">Sign In</h1><br>


   <?php
      if (isset($_SESSION['message'])) {
         echo $_SESSION['message'];
        }
   ?>

   <form class="loginSignUpForm" action="/phpmotors/accounts/" method="post">
   <label class = "emailLabel" for="email">Email Address:</label><br>
   <input type="email" id="clientEmail" name="clientEmail" placeholder="user@example.com" 
      <?php if (isset($clientEmail)) { echo "value='$clientEmail'";}?>
   required><br>

   <label for="password">Password:</label><br>
   <span class="passwordInfo">(Must contain at least 8 characters, 1 number, 1 capital letter, and 1 special character)</span><br>
   <input type="password" id="clientPassword" name="clientPassword" placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
   <!-- <input type="checkbox" onclick="showPassword()" id="showp"><label class="showPassword" for ="showp">Show Password</label><br> -->

   <button class="loginSignUpButton" type="submit">Login</button>
   <input type="hidden" name="action" value="Login">
   </form>

   <br><br>

   <p class="signUpP">Not a member yet? <a href = "/phpmotors/accounts/?action=register-page">Sign Up</a></p>
   <hr>
</main>

<!-- Import Footer code snippet -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>

</body>

</html>