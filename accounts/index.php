<?php 

// This is the Accounts Controller

// Create / access a session
session_start();


// Get DB Connection file
 require_once '../library/connections.php';

 // Get PHP Motors Model 
 require_once '../model/main-model.php';

 // Get the Accounts Model
 require_once '../model/accounts-model.php';

 // Get the Custom Functions file
 require_once '../library/functions.php';

 require_once '../model/reviews-model.php';

 // Get DB data array
 $classifications = getClassifications();

 // Calling the NavList Function
 $navList = printNavList($classifications);

 // Filters the action request 
 $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
 }

 // Switch case statement containing the various action requests
 switch ($action) {
   // Redirect to registration page
   case 'register-page':
     include '../view/register.php';
     break;

   // Redirect to login page
   case 'login':
     include '../view/login.php';
     break;

  // Form action from register.php
   case 'register':
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

    // Runs server-side validation
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    $existingEmail = checkDuplicateEmail($clientEmail);

    // Check for existing email address in the table
    if($existingEmail){
        $message = '<p class="message2">That email address already exists. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
    }

    // Checks if data provided is empty
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p class = "message2">Please provide information for all empty form fields.</p>';
      include '../view/register.php';
      exit; 
     }

     // Hashes password before sending to DB
     $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

     // Sends filtered data to DB
     $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

     // Checks if DB addition was successful
    if($regOutcome === 1){
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p class = 'message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
     } else {
      $message = "<p class = 'message' >Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
     }
     break;

     // Form action from login.php
     case 'Login':
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      // Runs server-side validation
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
  
      // Checks in data provided is empty
      if (empty($clientEmail) || empty($checkPassword)) {
        $message = '<p class = "message2" >Please fill all required fields.</p>';
        include '../view/login.php';
        exit;
      }

      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);

      // If the email address is not found in database, an appropiate message is shown (redirecting to the login page)
      if($clientData===FALSE) {
        $_SESSION['message'] = '<p class="message2">Please check your email address and try again.</p>';
        include '../view/login.php';
        exit;
      }
 
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
          $_SESSION['message'] = '<p class="message2">Please check your password and try again.</p>';
          include '../view/login.php';
          exit;
      }

      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;

      // Remove the password from the array
      array_pop($clientData);

      // Store the array into the session
      $_SESSION['clientData'] = $clientData;

      // Send them to the admin view
      $clientId = $_SESSION['clientData']['clientId'];

      $clientReviews = getReviewsByClient($clientId);

      $displayReviews = buildAdminReviews($clientReviews);

      include '../view/admin.php';
      exit;
      break;

    // Log Out and End Session 
    case 'Logout':
        session_unset();
        header('Location: /phpmotors');
      break;

    // Redirect to Client Update view action  
    case 'showClientUpdate':
      include '../view/client-update.php';
      exit;
      break;

    // Update Account Details Action
    case 'updateAccount':

      // Filter Data
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

      // Server-side checks
      $clientEmail = checkEmail($clientEmail);

      // Checks whether the entered email exists in DB
      $existingEmail = checkDuplicateEmail($clientEmail);

      // Throw error if email exists and if it is different from the current session's email
      if(($existingEmail) && ($_SESSION['clientData']['clientEmail'] != $clientEmail)){
        $message = '<p class="message2">That email address already exists.</p>';
        include '../view/client-update.php';
        exit;
      }

      // Checks if data provided is empty / Server-side checks
      if (empty($clientFirstname) || empty($clientEmail) || empty($clientLastname)) {
        $message = '<p class = "message2" >Error: Please complete all input fields.</p>';
        include '../view/client-update.php';
        exit;
      }

      // Call model function to update DB with filtered data
      $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

      // Checks if DB client detail change was successful
      if($updateOutcome === 1){

          // call function to retrive updated data array
         $clientData = getUpdatedClient($clientId);

          // Remove the password from the array
          array_pop($clientData);

          // Store the array into the session
          $_SESSION['clientData'] = $clientData;

          $message = "<p class = 'message'>Your account was successfully updated.</p>";
          $_SESSION['message'] = $message;
          header('Location: /phpmotors/accounts/');
          exit;
      } else {
          $messageP = "<p class = 'message2' >Sorry, your account was not updated.</p>";
          $_SESSION['message'] = $messageP;
          header('Location: /phpmotors/accounts/');
          exit;
      }
      break;
    
    // Update Password
    case 'updatePassword':

      // Filter Data
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
      $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

      // Server-side checks
      $checkPassword = checkPassword($clientPassword);

      // Server-side checks
      if (empty($checkPassword)) {
        $messageP = '<p class = "message2" >Please make sure password matches criteria.</p>';
        include '../view/client-update.php';
        exit;
      }

      // Hash password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Sends filtered data to DB model function
      $passwordOutcome = updateClientPassword($hashedPassword, $clientId);

      // Checks if DB password change was successful
      if($passwordOutcome === 1){
        $message = "<p class = 'message'>Your password was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('Location: /phpmotors/accounts/');
        exit;
      } else {
          $messageP = "<p class = 'message2' >Sorry, your password update failed.</p>";
          $_SESSION['message'] = $messageP;
          header('Location: /phpmotors/accounts/');
          exit;
      }
      break;

      // Default
      default: 
      $clientId = $_SESSION['clientData']['clientId'];

      $clientReviews = getReviewsByClient($clientId);

      $displayReviews = buildAdminReviews($clientReviews);
     
        include '../view/admin.php';
      break;
}
?>