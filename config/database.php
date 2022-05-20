<?php

// Database connection parameters
define("DB_HOST","localhost");
define("DB_NAME","ithute");
define("DB_USERNAME","root");
define("DB_PASSWORD","");


//Establish a database connection
try { 
  $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(PDOException $e) {
    echo 'Connection Error: ' . $e->getMessage();
  }
  

  