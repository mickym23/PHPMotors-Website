<?php

# This file contains PHP functions used in the PHPMotors website.

// This function validates an email parameter and returns a relevant boolean
function checkEmail($clientEmail) {
   $validation = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
   return $validation;
}

// This function checks a password if it matches the required pattern
function checkPassword($clientPassword) {
   $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
   return preg_match($pattern, $clientPassword);
}

// This function validates an integer and returns a relevant boolean
function checkVarInt($int) {
   $validation = filter_var($int, FILTER_VALIDATE_INT);
   return $validation;
}

// This function validates a float and returns a relevant boolean
function checkVarFloat($float) {
   $validation = filter_var($float, FILTER_VALIDATE_FLOAT);
   return $validation;
}

// This function builds a navigation list using the database array as a parameter
function printNavList($classifications) {
   $navList = '<ul>';

   $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
  
   foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
    .urlencode($classification['classificationName']).
    "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .='</ul>';

  return $navList;
}

// This function builds the car classification dropdown list using the database array as the parameter
function carClassDropDownList($classifications) {
   $classificationList = '<select class="dropdownList" name="classificationId" id="classificationList">'; 
   $classificationList .= "<option>Choose a Classification</option>"; 
   foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
   } 
   $classificationList .= '</select>'; 
   return $classificationList; 
}

// Builds the classification interface for the appropiate vehicles
function buildVehiclesDisplay($vehicles){
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<a title='Go to vehicle details' href='/phpmotors/vehicles/?action=vehicleInfo&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on PHPMotors Website'></a>";

    $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInfo&invId=".urlencode($vehicle['invId'])."'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
    $dv .= "<span>$".number_format($vehicle['invPrice'])."</span>";
    $dv .= '<hr class="addHrPad">';
    $dv .= '</li>';
   }
   $dv .= '</ul></div>';
   return $dv;
  }

// Builds the Vehicle Details section based on inventory data
  function buildVehicleDetails ($invData) {
      $details = "<div class='detailImages'><div class='descContainer'>";
     foreach($invData as $data) {
      $details .= "<div class='leftDesc'><img class='descImg' src='$data[invImage]' alt='Image of the $data[invMake] $data[invModel] vehicle.'><br>
      <p>$".number_format($data['invPrice'])."</p></div>";
      $details .= "<div class='rightDesc'><p>$data[invMake] $data[invModel] Description</p><br>";
      $details .= "<p>$data[invDescription]</p></div>";
     }
     $details .="</div>";
     return $details;
   }

   /* * ********************************
*  Functions for working with images
* ********************************* */

   // Adds "-tn" designation to file name
function makeThumbnailName($image) {
   $i = strrpos($image, '.');
   $image_name = substr($image, 0, $i);
   $ext = substr($image, $i);
   $image = $image_name . '-tn' . $ext;
   return $image;
  }

  // Build images display for image management view
function buildImageDisplay($imageArray) {
   $id =  '<div class="upImgDiv">';
   $id .= '<ul class="upImg" id="image-display">';
   foreach ($imageArray as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
    $id .= "<p><a class = 'delPicBut' href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete <em>$image[imgName]</em></a></p>";
    $id .= '</li>';
  }
   $id .= '</ul></div>';
   return $id;
  }

  // Build the vehicles select list
function buildVehiclesSelect($vehicles) {
   $prodList = '<select name="invId" id="invId">';
   $prodList .= "<option>Choose a Vehicle</option>";
   foreach ($vehicles as $vehicle) {
    $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
   }
   $prodList .= '</select>';
   return $prodList;
  }

  // Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
   // Gets the paths, full and local directory
   global $image_dir, $image_dir_path;
   if (isset($_FILES[$name])) {
    // Gets the actual file name
    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
     return;
    }
   // Get the file from the temp folder on the server
   $source = $_FILES[$name]['tmp_name'];
   // Sets the new path - images folder in this directory
   $target = $image_dir_path . '/' . $filename;
   // Moves the file to the target folder
   move_uploaded_file($source, $target);
   // Send file for further processing
   processImage($image_dir_path, $filename);
   // Sets the path for the image for Database storage
   $filepath = $image_dir . '/' . $filename;
   // Returns the path where the file is stored
   return $filepath;
   }
}

   // Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
   // Set up the variables
   $dir = $dir . '/';
  
   // Set up the image path
   $image_path = $dir . $filename;
  
   // Set up the thumbnail image path
   $image_path_tn = $dir.makeThumbnailName($filename);
  
   // Create a thumbnail image that's a maximum of 200 pixels square
   resizeImage($image_path, $image_path_tn, 200, 200);
  
   // Resize original to a maximum of 500 pixels square
   resizeImage($image_path, $image_path, 500, 500);
  }
  

  // Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
   // Get image type
   $image_info = getimagesize($old_image_path);
   $image_type = $image_info[2];
  
   // Set up the function names
   switch ($image_type) {
   case IMAGETYPE_JPEG:
    $image_from_file = 'imagecreatefromjpeg';
    $image_to_file = 'imagejpeg';
   break;
   case IMAGETYPE_GIF:
    $image_from_file = 'imagecreatefromgif';
    $image_to_file = 'imagegif';
   break;
   case IMAGETYPE_PNG:
    $image_from_file = 'imagecreatefrompng';
    $image_to_file = 'imagepng';
   break;
   default:
    return;
  } // ends the swith
  
   // Get the old image and its height and width
   $old_image = $image_from_file($old_image_path);
   $old_width = imagesx($old_image);
   $old_height = imagesy($old_image);
  
   // Calculate height and width ratios
   $width_ratio = $old_width / $max_width;
   $height_ratio = $old_height / $max_height;
  
   // If image is larger than specified ratio, create the new image
   if ($width_ratio > 1 || $height_ratio > 1) {
  
    // Calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);
  
    // Create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);
  
    // Set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
     $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
     imagecolortransparent($new_image, $alpha);
    }
  
    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
     imagealphablending($new_image, false);
     imagesavealpha($new_image, true);
    }
  
    // Copy old image to new image - this resizes the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
  
    // Write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // Free any memory associated with the new image
    imagedestroy($new_image);
    } else {
    // Write the old image to a new file
    $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
  } // ends resizeImage function


  // Building Vehicle Thumbnail(s) Function
  function buildDetailThumbnails($thumbs) {
      $details = '<div class="leftThumbs">';
      $details .= "<h2 class='mobileThumbHead'>Additional Images of the ". $thumbs[0]['invMake']. ' '. $thumbs[0]['invModel'];
            $details .= '</h2><ul>';
      foreach ($thumbs as $thumb) {
         
         $details .= "<li><img class='thumbnailImages' src='$thumb[invThumbnail]' alt='Thumbnail image of the $thumb[invMake] $thumb[invModel] vehicle.'></li>";
      }
      $details .= "</ul></div></div>";
      return $details;
  }
  
  function buildAdminReviews($reviews) {
     $output = '<div><ul class="adminRevDisplay">';
     foreach ($reviews as $review) {
        $date = $review["reviewDate"];
        $output .= "<li><span class='reviewManage'> $review[invMake] $review[invModel] (Reviewed on ".date_format(new DateTime($date), 'F d, Y').")</span> <span class='adminRevLinks'><a href='/phpmotors/reviews/?action=editReview&reviewId=$review[reviewId]'>Edit</a> <a href='/phpmotors/reviews/?action=delReview&reviewId=$review[reviewId]'>Delete</a></span></li>";
     }
     $output .= "</ul></div>";
     return $output;
  }

  function buildReviewEdit($reviewInfo) {
      $date = $reviewInfo['reviewDate'];
      $output = '<form action = "/phpmotors/reviews/" method="post">';
      $output .= '<div class="reviewSection"><p class="updateReviewDate">Reviewed on '.date_format(new DateTime($date), 'F d, Y').'</p><div class="writeReview"><p class="embeddedReviewName">Review Text</p><textarea id="updateReviewText" name = "updateReviewText" class="vDetReviewsArea" required>'.$reviewInfo['reviewText'].'</textarea>'; 
      $output .= '<button type="submit" name="submitReviewUpdate" class="loginSignUpButton reviewButton">Update Review</button></div></div>';
      $output .= "<input type = 'hidden' name='reviewId' value ='$reviewInfo[reviewId]'>";
      $output .= '<input type="hidden" name="action" value="updateReview"></form>';
      return $output;
  }

  function buildReviewDeleteView($reviewInfo) {
   $date = $reviewInfo['reviewDate'];
      $output = '<form action = "/phpmotors/reviews/" method="post">';
      $output .= '<div class="reviewSection"><p class="updateReviewDate">Reviewed on '.date_format(new DateTime($date), 'F d, Y').'</p><div class="writeReview"><p class="embeddedReviewName">Review Text</p><textarea id="updateReviewText" name = "updateReviewText" class="vDetReviewsArea" readonly>'.$reviewInfo['reviewText'].'</textarea>'; 
      $output .= '<button type="submit" name="submitReviewUpdate" class="loginSignUpButton reviewButton">Delete Review</button></div></div>';
      $output .= "<input type = 'hidden' name='reviewId' value ='$reviewInfo[reviewId]'>";
      $output .= '<input type="hidden" name="action" value="confirmRevDel"></form>';
      return $output;
  }

  function buildInventoryReviews($invReviews) {
   $output = '<div><ul class="invReviewDisplay">';
   foreach ($invReviews as $review) {
      $date = $review["reviewDate"];
      $output .= "<li class='reviewInv'>".substr( $review['clientFirstname'],0,1).$review['clientLastname']." wrote on ".date_format(new DateTime($date), 'F d, Y').":<p class='reviewText'><em>".$review['reviewText']."</em></p></li>";
   }
   $output .= "</ul></div>";
   return $output;
  }

?>