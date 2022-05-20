<?php
session_name("clients");
session_start();
session_regenerate_id();

//redirect user to login page if login session is not set
if(!isset($_SESSION["customer_session"])){
  echo "<script> window.open('../login.php','_self')</script>";

}
//Database Config
include("../config/database.php");

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
  <?php include("navbar.php");?> 

  <!-- Page Container -->
  <div class="container">
     <!-- Page Row -->
     <br>
     <br>
     <br>
     <br>
     <br>
     <br>
    <div class="row" >

 
       <!-- Page Column -->
   

 <form action="" method="post">

    <h5 class="deep-purple-text center">Please change your password below</h5>

      <div class="input-field col s12 m3">
        
          <input id="password" type="password" class="validate" name="current_password" required>
          <label for="password">Current Password</label>
     </div>

      <div class="input-field col s12 m3">
      
          <input id="newpassword" type="password" class="validate" name="new_password" required>
          <label for="newpassword">New Password</label>
     </div>

      <div class="input-field col s12 m3">
        
          <input id="cnewpassword" type="password" class="validate" name="cnew_password" required>
          <label for="cnewpassword">Confirm New Password</label>
     </div>

          <div class="input-field col s12 m3">
           <button class="btn waves-effect waves-light deep-purple lighten-1" type="submit" name="submit">Save Changes
            <i class="material-icons right">check</i>
            </button>
        </div>

 

    </form>
    <?php
        if(isset($_POST["submit"])){
        
        $email = $_SESSION["customer_session"];

        $old_pass = $_POST["current_password"];
        $new_pass = $_POST["new_password"];
        $cnew_pass = $_POST["cnew_password"];

        //Get customers old password
        $query = "SELECT *  FROM customers WHERE primary_email = '$email'";
        $stmt = $conn->prepare($query);
        //Execute query
        $stmt->execute(); 

        $customer_old_pass = $stmt->fetch(PDO::FETCH_ASSOC);

        $old_pass_from_db = $customer_old_pass["password"];
       
        if(!password_verify($old_pass,$old_pass_from_db)){
              echo "<script>alert('Your current password is not valid,please try again'); </script>";
              exit();

        }
        if($new_pass != $cnew_pass){

             echo "<script>alert('Your new passwords do not match'); </script>";
              exit();

        } 
       

        //hash the new password first
        $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

        //Update customer password
        $query = "UPDATE customers SET password = :new_password WHERE primary_email = :email";

         $updateData = array(
         ":new_password" =>  $hashed_password,
          ":email" => htmlspecialchars(strip_tags($email))
         );

        //Sanitize the data
        $stmt = $conn->prepare($query);

        //Save all details to the DB
        if($stmt->execute($updateData)){

          echo "<script>alert('Your password have been updated, please login again'); </script>";
          echo "<script>window.open('logout.php','_self')</script>";
        }


        }


    ?>

       

         <!-- ./ Page Column -->
        
    </div>
       <!-- ./ Page Row -->
  
  </div>
   <!-- ./ Page Container -->







   <!-- Footer -->
  <?php include("footer.php");?> 

  <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
    
   
     //side nav init
     $('.button-collapse').sideNav();
     
    });
    
  </script>
</body>

</html>