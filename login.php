<!DOCTYPE html>
<html>
<!-- Document Head -->
<?php 
include "includes/header.php";

if(isset($_SESSION["customer_session"])){
  echo "<script> window.open('clients/home.php','_self')</script>";
}
?>
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
            <!-- php self can be used for xss -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <div class="input-field">
                <input type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>">
                <label for="email">Email</label>
              </div> 
              <div class="input-field">
                <input type="password" id="password" name="password">
                <label for="password">Password</label>
              </div>
              
              <input type="submit" value="Login" name="login" class="btn btn-large purple btn-extend">
                <p class="center">Or</p>
               <a href="forgot.php" class="btn btn-large purple btn-extend grey"><i class="fa fa-sync"></i>  Reset Password</a>
            </form>
            <?php

              if(isset($_POST["login"])){

                  $email = htmlspecialchars($_POST["email"]);
                  $password = htmlspecialchars($_POST["password"]);

                  $loginCredentials = array(
                    ":email" =>  $email
                    );

                  $query = "SELECT primary_email,phone,password FROM customers WHERE primary_email = :email";

                  $stmt = $conn->prepare($query);
                  //Execute query
                  $stmt->execute($loginCredentials); 
                  //Fetch all corresponding accounts
                  $countUsers = $stmt->rowCount();

                  if($countUsers <= 0){

                      echo "<script>alert('Password or Username incorrect. Please verify your login credentials.');</script>";

                  } else {
                      $result = $stmt->fetchAll();
                      foreach($result as $row){
                        //verify passwords
                          if(password_verify($password, $row["password"])){
                              //set customer sessions
                              $_SESSION["customer_session"] = $email;  
                              $_SESSION["customer_phone"] = $row["phone"];

                              //redirect the customer to the dashboard
                              echo "<script> window.open('clients/home.php','_self')</script>";
                          }

                          //Incorrect password
                          else {
                            echo "<script> alert('Password or Username incorrect. Please verify your login credentials');</script>";
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

  <!--Import jQuery, materialize.js and the helper functions-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/util.js"></script>

</body>
</html>