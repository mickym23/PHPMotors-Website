<?php 

// Main Controller

// Create / access a session
session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

// Get DB Connection file
 require_once 'library/connections.php';

 // Get PHP Motors Model 
 require_once 'model/main-model.php';

 require_once 'library/functions.php';

 // Get DB data array
 $classifications = getClassifications();

 // Calling the NavList Function
 $navList = printNavList($classifications);

if (isset($_COOKIE['firstname'])) {
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

 switch ($action) {
   case 'template':
     include 'view/template.php';
     break;
     default: 
     include 'view/home.php';
     break;
}

?>