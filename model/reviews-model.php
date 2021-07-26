<?php

// Add Review
function addClientReview ($clientId, $invId, $reviewText) {
   $db = phpmotorsConnect();
   $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

// Get Reviews By invId
function getReviewsByInventory($invId){
   $db = phpmotorsConnect();
   $sql = 'SELECT r.reviewText, r.reviewDate, c.clientFirstname, c.clientLastname FROM reviews r INNER JOIN clients c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY r.reviewDate DESC';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $reviewInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviewInfo;
  }

// Get Reviews By clientId
function getReviewsByClient($clientId){
   $db = phpmotorsConnect();
   $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, i.invMake, i.invModel, r.clientId FROM reviews r INNER JOIN inventory i ON r.invId = i.invId WHERE clientId = :clientId ORDER BY r.reviewDate DESC';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $vehicles;
  }

// Get Specific Review
function getReviewsById($reviewId){
   $db = phpmotorsConnect();
   $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.reviewDate, i.invMake, i.invModel, r.clientId FROM reviews r INNER JOIN inventory i ON r.invId = i.invId WHERE reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviewInfo;
  }

// Update Review
function updateReview($reviewText, $reviewId, $reviewDate) {
      $db = phpmotorsConnect();
      $sql =  'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate WHERE reviewId = :reviewId';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
      $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
      $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
      $stmt->execute();
      $rowsChanged = $stmt->rowCount();
      $stmt->closeCursor();
      return $rowsChanged;
   }


// Delete Review
function deleteReview($reviewId) {
   $db = phpmotorsConnect();
      $sql =  'DELETE FROM reviews WHERE reviewId = :reviewId';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
      $stmt->execute();
      $rowsChanged = $stmt->rowCount();
      $stmt->closeCursor();
      return $rowsChanged;
}

?>