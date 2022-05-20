<?php
//Sessions
include("includes/clients_sessions.php");

//Database Config
include("config/database.php");

?>
<!DOCTYPE html>
<html>

<!-- Document Head -->
<?php include ("includes/header.php");?>

<body>
  <!-- Header -->
   <?php include("includes/navbar.php");?>
  <!-- Section: Signup -->
  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12 m6">
          <h4>IMPORTANT TIPS</h4>
          <p class="purple-text">Please make sure the number you provide can be reached by both whatsapp and call.</p>
          <p class="purple-text">Please make sure your write +267 before you write your phone number.</p>
          <p class="purple-text">Please make sure you select a strong password combination.</p>
          
        </div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <form method="Post" action="signup.php">
              <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
              </div>
               <div class="input-field">
                <input type="email" id="secondary_email" name="secondary_email" required>
                <label for="secondary_email">Secondary Email</label>
              </div>
               <div class="input-field">
                <input type="tel" id="phone_number" name="phone" required>
                <label for="phone_number">Phone Number</label>
              </div>
             
              <div class="input-field">
                <input type="password" id="password" name="password" min="10" required>
                <label for="password">Password</label>
              </div>
              <div class="input-field">
                <input type="password" id="cpassword" name="cpassword" min="10" required>
                <label for="cpassword">Confirm Password</label>
              </div>
              <p class="center">By signing up you agree to our <a href="terms.php" target="_blank">terms and conditioins</a>  </p>
              <input type="submit" value="Signup" name="signup" id="submit" class="btn btn-large purple btn-extend">
              <p class="center">Or</p>
               <a href="login.php" class="btn btn-large purple btn-extend grey">
                <i class="fa fa-sync"></i>  Login
              </a>
            </form>
            <?php

            if (isset($_POST["signup"])){
                $email = $_POST["email"];
                $secondary_email = $_POST["secondary_email"];
                $phone = $_POST["phone"];
                $password = $_POST["password"];
                $cpassword = $_POST["cpassword"];

                $query = "SELECT *  FROM customers WHERE primary_email = '$email'";
                $stmt = $conn->prepare($query);
                //Execute query
                $stmt->execute(); 
                
                //Count Returned users
                $count_users = $stmt->rowCount();
                
                if($count_users > 0){
                    echo "<script> alert('User already Exists');</script>";
                    exit();
                }
            
                // hash the password before storing it in the  DB
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                          
                //Clean data first before saving to DB
                ///Capitalize first character of inputs before saving to DB
                $userData = array(
                ":email" => htmlspecialchars(strip_tags($email)),
                ":secondary_email" => htmlspecialchars(strip_tags($secondary_email)),
                ":phone" => htmlspecialchars(strip_tags($phone)),
                ":password" => $hashed_password
                );
              //DB insert query
              $query = "INSERT INTO customers(primary_email,secondary_email,phone,password)
              VALUES (:email,:secondary_email,:phone,:password)";

              //Sanitize the data
              $stmt = $conn->prepare($query);

              //Save all details to the DB
              if($stmt->execute($userData)){
              //All required files initialization
                $infoData = array(
                ":email" => htmlspecialchars(strip_tags($email))
                );

                //DB insert query
              $query = "INSERT INTO personal_info(email)VALUES (:email)";

              //Sanitize the data
              $stmt = $conn->prepare($query);
              $stmt->execute($infoData);

                //DB insert query
              $query = "INSERT INTO history(email)VALUES (:email)";

              //Sanitize the data
              $stmt = $conn->prepare($query);
              $stmt->execute($infoData);

                //DB insert query
              $query = "INSERT INTO documents(email)VALUES (:email)";

              //Sanitize the data
              $stmt = $conn->prepare($query);
              $stmt->execute($infoData);

              //DB insert query
              $query = "INSERT INTO languages(email)VALUES (:email)";

              //Sanitize the data
              $stmt = $conn->prepare($query);
              $stmt->execute($infoData);

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
      $('.button-collapse').sideNav();

      //verify no duplicate emails entered.
      $("#secondary_email").change(function(){
        if($("#email").val() == $("#secondary_email").val()){
          alert("Primary email and secondary email cannot be the same email address.Please input a different secondary email.");
          $("#submit").attr( "disabled", "disabled" );
        } else {
          $("#submit").removeAttr("disabled");
        }
      });
     
    });
  </script>
</body>

</html>