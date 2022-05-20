<?php
session_name("admins");
session_start();
session_regenerate_id();



if(isset($_SESSION["admin_session"])){
     echo "<script> window.open('dashboard.php','_self')</script>";

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
</head>

<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
  <!-- Section: Signup -->
  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12 m3">
          
          
        </div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <form method="Post" action="signup.php">
              <div class="input-field">
                <input type="email" id="email" name="email">
                <label for="email">Email</label>
                <p class="center-align red-text">Please use your Ithute Motswana email </p>
              </div> 
              <div class="input-field">
                <input type="password" id="password" name="password">
                <label for="password">Password</label>
              </div>
              <div class="input-field">
                <input type="password" id="cpassword" name="cpassword">
                <label for="cpassword"> Confirm Password</label>
              </div>
              
              <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-large purple btn-extend" disabled>
                <p class="center">Or</p>
               <a href="index.php" class="btn btn-large purple btn-extend grey">
                       Login</a>
            </form>
            <?php

                if (isset($_POST["signup"])){
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $cpassword = $_POST["cpassword"];
                    $role = "Admin";

                    $query = "SELECT *  FROM employees WHERE email = '$email'";

                    $stmt = $conn->prepare($query);
                    //Execute query
                    $stmt->execute(); 
                    
                    //Count Returned Employees
                    $count_employees = $stmt->rowCount();
                    
                    if($count_employees == 0){

                        echo "<script> alert('Employee not found.Please contact admin');</script>";
                        exit();

                    }


                    // hash the password before storing it in the  DB
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                
                    //Clean data first before saving to DB
                    ///Capitalize first character of inputs before saving to DB
                    $adminData = array(
                    ":email" => htmlspecialchars(strip_tags($email)),
                    ":role" => htmlspecialchars(strip_tags($role)),
                    ":password" => $hashed_password
                    );
                    //DB insert query
                    $query = "INSERT INTO admins(email,password,role)
                    VALUES (:email,:password,:role)";

                    //Sanitize the data
                    $stmt = $conn->prepare($query);

                    //Save all details to the DB
                    if($stmt->execute($adminData)){
                    //redirect admin to login page
                    echo "<script> window.open('index.php','_self')</script>";
                    }

                }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

 
  

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {

       //verify that passwords match
      $("#cpassword").change(function(){
       
       if($("#password").val() == $("#cpassword").val()){
        $("#submit").removeAttr("disabled");

        
       } else {
        alert("Your passwords do not match");
         $("#submit").attr( "disabled", "disabled" );
       }

     });
     
    });
  </script>
</body>

</html>