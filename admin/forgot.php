<?php
session_name("clients");
session_start();
session_regenerate_id();

if(isset($_SESSION["admins_session"])){
     echo "<script> window.open('admin/dashboard.php','_self')</script>";

}
//Database Config
include("config/database.php");

?>

<!DOCTYPE html>
<html>

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

<body>
  <!-- Header -->
   <?php include("includes/navbar.php");?>
  <!-- Section: Signup -->
  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12 m3">
          
          
        </div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <form method="Post" action="forgot.php">
             <h5>Enter your email below we will send you your new password</h5>
              <div class="input-field">
                <input type="email" id="email" name="email">
                <label for="email">Email</label>
              </div> 
             
              <input type="submit" value="Send New Password" name="reset" class="btn btn-large purple btn-extend">
                <p class="center">Or</p>
               <a href="login.php" class="btn btn-large purple btn-extend grey">
                     <i class="fa fa-sync"></i>  Login</a>
            </form>
            <?php

        if(isset($_POST["reset"])){

            $email = $_POST["email"];
            
            $query = "SELECT *  FROM admins WHERE email = '$email'";

            $stmt = $conn->prepare($query);
            //Execute query
            $stmt->execute(); 
            //Fetch all corresponding accounts
           $row_customer = $stmt->fetch(PDO::FETCH_ASSOC);
        
           $adminemail = $row_customer["email"];
           $password = $row_customer["password"];
            //Count Returned users
            $count_users = $stmt->rowCount();
             if($count_users == 0){

                echo "<script> alert('Sorry We do not have your email');</script>";
                exit();

            } else {
              $message = "
              
              <h1 align='center'>Your password has ben sent to your email </h1>
              <h2 align='center'>ATT Admin: $adminemail</h2>
              <h3 align='center'>
                Your new password is : <span> <b>$password </b> </span>
              </h3>
              <h3 align='center'> <a href='localhost:8080/ithute/login.php'> Click here to login into your account </a> </h3>
              ";

              $from = "onalepeloo@live.com";
              $subject = "Your Password";
              $headers = "From:$from\r\n";
              $headers .= "Content-type: text/html\r\n";

              mail($email,$subject,$message,$headers);
              echo "<script> alert('Your Password have been sent to your email'); </script>";
              echo "<script> window.open('login.php','_self')</script>";
            }
            

      

            }



            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
    <?php include("includes/footer.php");?>

  

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.carousel.carousel-slider').carousel({ fullWidth: true });
      $('.button-collapse').sideNav();
      $('.modal').modal();
      $('select').material_select();
    });
  </script>
</body>

</html>