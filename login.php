<?php
//Sessions
include("includes/clients_sessions.php");
//Database Config
include("config/database.php");

?>

<!DOCTYPE html>
<html>
<!-- Document Head -->
<?php include "includes/header.php";?>

<body>
  <!-- Header -->
   <?php include("includes/navbar.php");?>
  <!-- Section: Signup -->
  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12 m3"> </div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <form method="Post" action="login.php">
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
               <a href="forgot.php" class="btn btn-large purple btn-extend grey">
                     <i class="fa fa-sync"></i>  Reset Password</a>
            </form>
            <?php

        if(isset($_POST["login"])){

            $email = $_POST["email"];
            $password = $_POST["password"];

            $query = "SELECT *  FROM customers WHERE primary_email = '$email'";

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
                              
                                $_SESSION["customer_session"] = $email;
                                //fetch customer number
                                 $query = "SELECT phone  FROM customers WHERE primary_email = '$email'";

                                 $stmt = $conn->prepare($query);
                                 //Execute query
                                 $stmt->execute(); 
                                 //Return results as an array 
                                 $row_customer = $stmt->fetch(PDO::FETCH_ASSOC);

                                 $_SESSION["customer_phone"] = $row_customer["phone"];
                   
                                echo "<script> window.open('clients/home.php','_self')</script>";
                          
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

  <!-- Footer -->
    <?php include("includes/footer.php");?> 

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.button-collapse').sideNav();
    });
  </script>
</body>

</html>