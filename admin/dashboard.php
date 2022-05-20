<?php
session_name("admins");
session_start();
session_regenerate_id();
//Database Config
include("../config/database.php");

if(!isset($_SESSION["admin_session"])){
      echo "<script> window.open('index.php','_self')</script>";

} else {

    $email = $_SESSION["admin_session"];
}

//get total number of registered clients
   $get_clients = "SELECT *  FROM customers";
   // Prepare statement
   $stmt = $conn->prepare($get_clients);
   //Execute query
   $stmt->execute(); 
   $result = $stmt->fetchAll();
   $clients_count = $stmt->rowCount();

//get total number of applications
   $get_applications = "SELECT *  FROM applications";
   // Prepare statement
   $stmt = $conn->prepare($get_applications);
   //Execute query
   $stmt->execute(); 
   $result = $stmt->fetchAll();
   $applications_count = $stmt->rowCount();
?>

<!DOCTYPE html>
<html>

<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ithute Motswana</title>

  <style>
    ul.dropdown-content.select-dropdown li:not(.disabled) span { 
        color: #7e57c2; 
    }

    /* label color */
   .input-field label {
     color: #7e57c2;
   }

 
   /* valid color */
   .input-field input[type=text].valid {
     border-bottom: 1px solid #7e57c2;
     box-shadow: 0 1px 0 0 #7e57c2;
   }
   /* invalid color */
   .input-field input[type=text].invalid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #7e57c2;
   }

   input:not([type]):focus:not([readonly]), input[type="text"]:not(.browser-default):focus:not([readonly]), input[type="password"]:not(.browser-default):focus:not([readonly]), input[type="email"]:not(.browser-default):focus:not([readonly]), input[type="url"]:not(.browser-default):focus:not([readonly]), input[type="time"]:not(.browser-default):focus:not([readonly]), input[type="date"]:not(.browser-default):focus:not([readonly]), input[type="datetime"]:not(.browser-default):focus:not([readonly]), input[type="datetime-local"]:not(.browser-default):focus:not([readonly]), input[type="tel"]:not(.browser-default):focus:not([readonly]), input[type="number"]:not(.browser-default):focus:not([readonly]), input[type="search"]:not(.browser-default):focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly]) {
    border-bottom: 1px solid #7e57c2;
    -webkit-box-shadow: 0 1px 0 0 #7e57c2;
    box-shadow: 0 1px 0 0 #7e57c2;
}
  </style>
</head>

<body>
 

    <!-- Navbar -->
    <?php include("includes/navbar.php");?>

  <!-- Page Container -->
  <div class="container-fluid">
     <!-- Page Row -->
    <div class="row" style="position:relative;top:100px;">

 
       <!-- Page Column -->
   
              <!-- Different Page Display -->
            <div class="col s12">
            <?php 
            if(!isset($_GET["all_clients"]) && !isset($_GET["all_applications"]) 
            && !isset($_GET["news"]) && !isset($_GET["new_user"])
            ){
              include("clients.php");     
            }
              //admin clicks on all applications
              if (isset($_GET["all_applications"])){

                include("applications.php");  
              } 
              
              //admin clicks on all clients
              if (isset($_GET["all_clients"])){

                include("clients.php");     
              } 
              //admin clicks on news
              if (isset($_GET["news"])){

                include("news.php");     
              } 
           
         
              
            
            ?>
            
          </div>
          <!-- /. Different Page Display -->


       

         <!-- ./ Page Column -->
        
    </div>
       <!-- ./ Page Row -->
  
  </div>
   <!-- ./ Page Container -->








  <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
    
    //side nav init
    $('.button-collapse').sideNav();

       $('select').material_select();

       $('#clients_table').DataTable({
          "lengthChange": false
        });

       $('#applications_table').DataTable({
          "lengthChange": false
        });
    
     
    });
    
  </script>
</body>

</html>