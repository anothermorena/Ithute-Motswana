<?php
//loaad the configuration file
require_once dirname(__DIR__)."/config.php";

//Database connection parameters
define("DB_HOST", $_ENV["DB_HOST"]);
define("DB_NAME", $_ENV["DB_NAME"]);
define("DB_USERNAME", $_ENV["DB_USERNAME"]);
define("DB_PASSWORD", $_ENV["DB_PASSWORD"]);


//Establish a database connection
try { 
  $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(PDOException $e) {
    echo 'Connection Error: ' . $e->getMessage();
  }
  

  