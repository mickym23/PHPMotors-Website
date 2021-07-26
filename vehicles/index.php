<?php 

//This is the Vehicles Controller

// Create / access a session
session_start();


// Get DB Connection file
require_once '../library/connections.php';

// Get PHP Motors Model 
require_once '../model/main-model.php';

//Add Vehicles Model
require_once '../model/vehicles-model.php';

// Get PHP functions file
require_once '../library/functions.php';

require_once '../model/uploads-model.php';

require_once '../model/reviews-model.php';

// Get DB data array
$classifications = getClassifications();

// Calling the NavList Function
$navList = printNavList($classifications);

// Call the Drop Down List Function
$classificationList = carClassDropDownList($classifications);

 // Filters the action request 
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_URL);
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_URL);
}

// Switch case statement containing the various action requests
switch ($action) {

   // Show Add Car Classification Page
   case 'showClassification':
     include '../view/add-classification.php';
     break;

   // Show Add Vehicle Page
   case 'showVehicle':
     include '../view/add-vehicle.php';
     break;

   // Run Form Data and add to DB
   case 'addClassification':
      $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
  
      // Checks if data provided is empty
      if(empty($classificationName)){
        $message = '<p class="message2">Please enter a classification name.</p>';
        include '../view/add-classification.php';
        exit; 
      }
       
       // Sends filtered data to DB
       $regOutcome = insertCarClassification($classificationName);
  
       // Checks if DB addition was successful
      if($regOutcome === 1){
            header('Location: /phpmotors/vehicles/');
        exit;
       } else {
        $message = "<p class='message2'>Sorry, New Car Classification: $classificationName failed.</p>";
        include '../view/add-classification.php';
        exit;
       }
       break;

   // Run Form Data and add to DB    
   case 'addVehicle':
      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
      $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
      $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));

      
      if (empty($classificationId)) {
         echo 'Empty';
      } else {
         echo $classificationId;
      }

      // Runs server-side validation
      $classificationId = checkVarInt($classificationId);
      $invStock = checkVarInt($invStock);
      $invPrice = checkVarFloat($invPrice);

      if (empty($classificationId)) {
         echo 'Empty';
      } else {
         echo $classificationId;
      }

      // Checks if data provided is empty
      if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription)
         || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock)
         || empty($invColor)){
        $message = '<p class="message2">Please complete all fields.</p>';
        include '../view/add-vehicle.php';
        exit; 
       }
  
       // Sends filtered data to DB
       $regOutcome = insertNewVehicle($classificationId, $invMake, $invModel, $invDescription,
                        $invImage, $invThumbnail, $invPrice, $invStock, $invColor);
  
      // Checks if DB addition was successful
      if($regOutcome === 1){
         $message = "<p class='message'>Successfully added vehicle to inventory.</p>";
         $_SESSION['message'] = $message;
         header('Location: /phpmotors/vehicles/');
        exit;
       } else {
        $message = "<p class='message2'>Sorry, vehicle inventory addition failed.</p>";
        include '../view/add-vehicle.php';
        exit;
       }
       break;

   case 'getInventoryItems':
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $inventoryArray = getInventoryByClassification($classificationId); 
      echo json_encode($inventoryArray);
      break;

   case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
         $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      exit;
      break;

   case 'updateVehicle':
      $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
      $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING));
      $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
      $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
      $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));

      // Runs server-side validation
      $classificationId = checkVarInt($classificationId);
      $invStock = checkVarInt($invStock);
      $invPrice = checkVarFloat($invPrice);

      // Checks if data provided is empty
      if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription)
         || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock)
         || empty($invColor)){
        $message = '<p class="message2">Please complete all information for the updated item.</p>';
        include '../view/vehicle-update.php';
        exit; 
       }
  
       // Sends filtered data to DB
       $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription,
                        $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
  
      // Checks if DB addition was successful
      if($updateResult){
         $message = "<p class='message'>$invMake $invModel was modified successfully.</p>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
        exit;
       } else {
        $message = "<p class='message2'>Sorry, vehicle inventory addition failed.</p>";
        include '../view/vehicle-update.php';
        exit;
       }
      break;
   
   case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
         $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-delete.php';
      exit;
      break;

   case 'deleteVehicle':
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
  
      $deleteResult = deleteVehicle($invId);
  
      // Checks if DB addition was successful
      if($deleteResult){
         $message = "<p class='message'>$invMake $invModel was successfully deleted.</p>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/vehicles/');
        exit;
       } else {
        $message = "<p class='message2'>Sorry, $invMake $invModel deletion failed.</p>";
        $_SESSION['message'] = $message;
	      header('location: /phpmotors/vehicles/');
        exit;
       }

      break;

   case 'classification':
      $classificationName = trim(filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING));

      $vehicles  = getVehiclesByClassification($classificationName);

      if (!count($vehicles)) {
         $message = "<p class = message2> Sorry, no $classificationName vehicles could be found.</p>";
      } else {
         $vehiclesDisplay  = buildVehiclesDisplay($vehicles);
      }

      // echo $vehiclesDisplay;
      // exit;

      include '../view/classification.php';
      break;

      case 'vehicleInfo':
         $invId = trim(filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT));

         $invData = getInventoryByID($invId);
         $thumbs = getThumbnailsByInvId($invId);

         if (!count($invData) || !(count($thumbs))) {
            $message = "<p class = message2> Sorry, vehicle could be found.</p>";
            include '../view/classification.php';
         } else { 
            $displayThumbs = buildDetailThumbnails($thumbs);
            $displayDetails = buildVehicleDetails($invData);
         }

         $getInvReviews = getReviewsByInventory($invId);

         $_SESSION['invReviews'] = $getInvReviews;
         
         $displayReviews = buildInventoryReviews($_SESSION['invReviews']);
         
         include '../view/vehicle-detail.php';
         break;
   // Default: Management Page    
   default:
      $classificationList = carClassDropDownList($classifications);
      include '../view/vehicle-management.php';
      break;
   }

?>