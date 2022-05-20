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
            <form method="Post" action="index.php">
              <div class="input-field">
                <input type="email" id="email" name="email">
                <label for="email">Email</label>
              </div> 
              <div class="input-field">
                <input type="password" id="password" name="password">
                <label for="password">Password</label>
              </div>
              
              <input type="submit" value="Login" name="login" class="btn btn-large purple btn-extend">
                <p class="center">Or</p>
               <a href="signup.php" class="btn btn-large purple btn-extend grey">
                       Sign Up</a>
            </form>
            <?php

        if(isset($_POST["login"])){

            $email = $_POST["email"];
            $password = $_POST["password"];

            $query = "SELECT *  FROM admins WHERE email = '$email'";

            $stmt = $conn->prepare($query);
            //Execute query
            $stmt->execute(); 
            //Fetch all corresponding accounts
            $count_users = $stmt->rowCount();

            if($count_users == 0){

                echo "<script> alert('Password or Username incorrect');</script>";
                exit();

            } else {
                    $result = $stmt->fetchAll();
                    foreach($result as $row){
                        //verify passwords
                            if(password_verify($password, $row["password"])){
                              
                                $_SESSION["admin_session"] = $email;

                                //fetch employee file
                                $query = "SELECT *  FROM employees WHERE email = '$email'";

                                $stmt = $conn->prepare($query);
                                //Execute query
                                $stmt->execute(); 
                                 //Return results as an array 
                                 $row_employee = $stmt->fetch(PDO::FETCH_ASSOC);

                                 $_SESSION["employee_names"] = $row_employee["firstname"] . " " . $row_employee["lastname"];
                                
                                echo "<script> window.open('dashboard.php','_self')</script>";
                          
                            }
                        //Incorrect password
                        else {

                            echo "<script> alert('Please verify your login credentials');</script>";
                            exit();
                        }

                }



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
     
    });
  </script>
</body>

</html>