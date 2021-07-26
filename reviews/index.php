<?php

// This is the Reviews Controller

// Create / access a session
session_start();

// Get DB Connection file
 require_once '../library/connections.php';

 // Get PHP Motors Model 
 require_once '../model/main-model.php';

 // Get the Custom Functions file
 require_once '../library/functions.php';

 // Get the Review Model file
 require_once '../model/reviews-model.php';

 // 
 require_once '../model/vehicles-model.php';

 //
 require_once '../model/uploads-model.php';


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

  case 'addReview':
    $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
    $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));

    if (empty($reviewText)) {
      $messageReview = '<p class="message2">Please enter a valid review.</p>';
      $_SESSION['messageReview'] = $messageReview;
      header("Location: /phpmotors/vehicles/?action=vehicleInfo&invId=$invId");
      exit;
    }

    $reviewSuccess = addClientReview($clientId, $invId, $reviewText);

    if ($reviewSuccess === 1) {
      $messageReview = '<p class="message">Review was successfully added.</p>';
      $_SESSION['messageReview'] = $messageReview;
      
      $invData = getInventoryByID($invId);
      $thumbs = getThumbnailsByInvId($invId);

    if (!count($invData) || !(count($thumbs))) {
       $message = "<p class = message2> Sorry, vehicle could be found.</p>";
       include '../view/vehicle-detail.php';
    } else {
       $displayThumbs = buildDetailThumbnails($thumbs);
       $displayDetails = buildVehicleDetails($invData);
    }
    header("Location: /phpmotors/vehicles/?action=vehicleInfo&invId=$invId");
    exit;
    } else {
      $messageReview = '<p class="message2">Review addition failed.</p>'; 
      $_SESSION['messageReview'] = $messageReview;
      header("Location: /phpmotors/vehicles/?action=vehicleInfo&invId=$invId");
      exit;
    }
      break;
  
  case 'editReview':
    $reviewId=trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

    $clientId = $_SESSION['clientData']['clientId'];
    
    $clientReviews = getReviewsByClient($clientId);

    $reviewInfo = getReviewsById($reviewId);

    $displayReviewUpdate = buildReviewEdit($reviewInfo);
    
    include '../view/update-review.php';
    break;

  case 'updateReview':
    $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
    $reviewText = trim(filter_input(INPUT_POST, 'updateReviewText', FILTER_SANITIZE_STRING));

    // Checks if data provided is empty
    if(empty($reviewText)){
      $_SESSION['message'] = '<p class="message2">Please provide your review to be updated.</p>';
      header('Location: /phpmotors/accounts/');
      exit;
    } 
     
    $updatedReviewDate = date("Y-m-d H:i:s", time());

    $reviewUpdateSuccess = updateReview($reviewText, $reviewId, $updatedReviewDate);

    if ($reviewUpdateSuccess === 1) {
      $_SESSION['message'] = "<p class='message'>Your review was successfully updated.</p>";
      header('Location: /phpmotors/accounts/');
     } else {
      $_SESSION['message'] = "<p class='message2'>Unfortunately, your review update has failed.</p>";
      header('Location: /phpmotors/accounts/');
      exit;
      }

    break;
  
  case 'delReview':
    $reviewId=trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

    $reviewInfo = getReviewsById($reviewId);

    $displayReviewDeletion = buildReviewDeleteView($reviewInfo);
    include '../view/delete-review.php';
    break;
  
  case 'confirmRevDel':
    $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

    $deleteReview = deleteReview($reviewId);

    if ($deleteReview === 1) {
      $_SESSION['message'] = "<p class='message'>Your review was successfully deleted.</p>";
      header('Location: /phpmotors/accounts/');
    } else {
      $_SESSION['message'] = "<p class='message2'>Unfortunately, your review deletion has failed.</p>";
      header('Location: /phpmotors/accounts/');
      exit;
      }
    break;

   default:

   $clientId = $_SESSION['clientData']['clientId'];
    
   $clientReviews = getReviewsByClient($clientId);
   echo $clientReviews;

   $displayReviews = buildAdminReviews($clientReviews);

    include '../view/admin.php';
    exit;
   break;
 }



?>