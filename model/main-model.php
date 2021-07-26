<?php

// This is the Main PHP Motors Model
function getClassifications () {

   // PDO connection function call
   $db  = phpmotorsConnect();

   //SQL Query
   $sql = 'SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC';

   // Create prepared statement
   $stmt = $db->prepare($sql);

   // Run prepared statement
   $stmt->execute();

   // Stores database data in an array
   $classifications = $stmt->fetchAll();

   // Close database connection
   $stmt->closeCursor();

   // Return data array
   return $classifications;
}

?>