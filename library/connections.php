<?php

function phpmotorsConnect(){
 $server = 'localhost';
 $dbname= 'phpmotors';
 $username = 'iClient';
 $password = 'KqKW*rjD4OCfK9@7';
 $dsn = "mysql:host=$server;dbname=$dbname";
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 
 // Try PDO Connection, Catch Error (Display Server Error)
 try {
  $link = new PDO($dsn, $username, $password, $options);
  return $link;
 } catch(PDOException $e) {
  require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/500.php';
  exit;
 }
}

// Function Call
phpmotorsConnect();

?>