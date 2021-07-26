<header id="head">

<a href ='/phpmotors/'><img class = "logo" src = "/phpmotors/images/site/logo.png" alt = "PHP Motors logo"></a>

<?php
if (isset($_SESSION['loggedin'])) {
   echo "<a class  = 'accountButton' href = '/phpmotors/accounts/?action=Logout'>Logout</a>";
   echo "<p class='welcomeFirstname'><a class = 'welcomeLink' href='/phpmotors/accounts/'>Welcome, ", $_SESSION['clientData']['clientFirstname'], "</a></p>";
} else {
   echo '<a class  = "accountButton" href = "/phpmotors/accounts/?action=login">My Account</a>';
}

 ?> 

</header>