<?php  
// Database connection parameters
   $host = 'localhost';
   $db_name = 'ithute';
   $username = 'root';
   $password = '';
   $conn;

//Establish a database connection
  try { 
      $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $conn;
  

  