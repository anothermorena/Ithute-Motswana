<?php
//Sessions
session_name("clients");
session_start();
//thwarts session fixation attacks
session_regenerate_id();


//cross site request forgery protection
$_SESSION["token"] = bin2hex(random_bytes(32));

//sets the expiry dime for the token
$_SESSION["token-expire"] = time() + 3600; // 1 hour = 3600 secs

//Database Config
include("config/database.php");

?>

<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="css/main.css" />

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ithute Motswana</title>
</head>
