<?php 

// This is the Account Model 

// Site Registrations function
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
   $db = phpmotorsConnect();
   $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) 
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
   $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
   $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
   $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

// Check for an existing email
function checkDuplicateEmail ($clientEmail) {
   $db = phpmotorsConnect();
   $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
   $stmt->execute();
   $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
   $stmt->closeCursor();
   if (empty($matchEmail)) {return 0;exit;
   } else {return 1;exit;
   }
}

// Get client data based on an email address
function getClient($clientEmail){
   $db = phpmotorsConnect();
   $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
   $stmt->execute();
   $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $clientData;
  }

// Client Password Update Function
function updateClientPassword ($clientPassword, $clientId) {
   $db = phpmotorsConnect();
   $sql =  'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount(); 
   $stmt->closeCursor();
   return $rowsChanged;
  }

// Client Details Update Function
function updateClient ($clientFirstname, $clientLastname, $clientEmail, $clientId) {
   $db = phpmotorsConnect();
   $sql =  'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
   $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
   $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
  }

// Retrieve Client Data Based on Client ID
function getUpdatedClient($clientId){
   $db = phpmotorsConnect();
   $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $clientData;
  }
?>