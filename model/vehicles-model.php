<?php

// This is the Vehicle Model

// Add Classification Name Function
function insertCarClassification ($classificationName) {
   $db = phpmotorsConnect();
   $sql = 'INSERT INTO carclassification (classificationName) 
            VALUES (:classificationName)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

// Add Vehicle to Inventory Function
function insertNewVehicle ($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor) {
   $db = phpmotorsConnect();
   $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor) 
            VALUES (:classificationId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
   $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
   $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
   $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
   $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
   $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
   $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
   $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
   $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

// Get vehicle information by invId
function getInvItemInfo($invId){
   $db = phpmotorsConnect();
   $sql = 'SELECT * FROM inventory WHERE invId = :invId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $invInfo;
  }

// Update Vehicle Inventory Function
function updateVehicle ($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId) {
     $db = phpmotorsConnect();
     $sql =  'UPDATE inventory SET classificationId = :classificationId, invMake = :invMake, invModel = :invModel, 
     invDescription = :invDescription, invImage = :invImage, 
     invThumbnail = :invThumbnail, invPrice = :invPrice, 
     invStock = :invStock, invColor = :invColor 
      WHERE invId = :invId';
     $stmt = $db->prepare($sql);
     $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
     $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
     $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
     $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
     $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
     $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
     $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
     $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
     $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
     $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
     $stmt->execute();
     $rowsChanged = $stmt->rowCount();
     $stmt->closeCursor();
     return $rowsChanged; 
  }

// Delete Vehicle From Inventory
function deletevehicle ($invId) {
     $db = phpmotorsConnect();
     $sql = 'DELETE FROM inventory WHERE invId = :invId';
     $stmt = $db->prepare($sql);
     $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
     $stmt->execute();
     $rowsChanged = $stmt->rowCount(); 
     $stmt->closeCursor();
     return $rowsChanged;
 } 

// Retrieves vehicles based on classification name
function getVehiclesByClassification($classificationName){
   $db = phpmotorsConnect();
   $sql = 'SELECT i.invId, i.invMake, i.invModel, i.invPrice, img.imgPath AS "invThumbnail", i.invDescription, i.invColor, i.invStock, i.classificationId FROM inventory i LEFT JOIN images img ON i.invId = img.invId AND img.imgPath LIKE "%-tn%" AND img.imgPrimary = 1 WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
   $stmt->execute();
   $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $vehicles;
  }

  //   Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
   $db = phpmotorsConnect(); 
   $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
   $stmt = $db->prepare($sql); 
   $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
   $stmt->execute(); 
   $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
   $stmt->closeCursor(); 
   return $inventory; 
  }


// Get vehicles by inventoryId 
function getInventoryByID($invId){ 
   $db = phpmotorsConnect(); 
   $sql = 'SELECT i.invId, i.invMake, i.invModel, i.invPrice, img.imgPath AS "invImage", i.invDescription, i.invColor, i.invStock, i.classificationId FROM inventory i LEFT JOIN images img ON i.invId = img.invId AND img.imgPath NOT LIKE "%-tn%" AND img.imgPrimary = 1 WHERE i.invId = :invId'; 
   $stmt = $db->prepare($sql); 
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
   $stmt->execute(); 
   $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
   $stmt->closeCursor(); 
   return $inventory; 
  }

  // Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

?>