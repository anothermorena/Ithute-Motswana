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
          <p class="purple-text">Please make sure your write +267 before you write your phone number. <br> The complete number should be like: +26772280095</p>
          <p class="purple-text">Please make sure you select a strong password combination.</p>
        </div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <!-- php self can be used for xss -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <div class="input-field">
                <input type="email" id="email" name="email" required>
                <label for="email">Email</label>
              </div>
               <div class="input-field">
                <input type="email" id="secondaryEmail" name="secondary_email" required>
                <label for="secondary_email">Secondary Email</label>
              </div>
               <div class="input-field">
                <input type="tel" id="phone_number" name="phone" required>
                <label for="phone_number">Phone Number</label>
              </div>
              <div class="input-field">
                <input type="password" id="password" name="password" minlength="8" required>
                <label for="password">Password</label>
              </div>
              <div class="input-field">
                <input type="password" id="cpassword" name="cpassword" minlength="8" required disabled>
                <label for="cpassword">Confirm Password</label>
              </div>
              <p class="center">By signing up you agree to our <a href="terms.php" target="_blank">terms and conditions</a>  </p>
              <input type="submit" value="Signup" name="signup" id="signup" class="btn btn-large purple btn-extend" disabled>
              <p class="center">Or</p>
               <a href="login.php" class="btn btn-large purple btn-extend grey">
                <i class="fa fa-sync"></i>  Login
              </a>
            </form>
            <?php

            if (isset($_POST["signup"])){
                  $email = htmlspecialchars($_POST["email"]);
                  $secondaryEmail = htmlspecialchars($_POST["secondary_email"]);
                  $phone = htmlspecialchars($_POST["phone"]);
                  $password = htmlspecialchars($_POST["password"]);
                  $cpassword = htmlspecialchars($_POST["cpassword"]);

                  $customerEmail = array(
                    ":email" =>  $email
                    );

                  //check if user does not exist already
                  $query = "SELECT primary_email FROM customers WHERE primary_email = :email";
                  $stmt = $conn->prepare($query);
                  //execute query
                  $stmt->execute($customerEmail); 
                  //count Returned users
                  $countUsers = $stmt->rowCount();
                  
                  if($countUsers > 0){
                      echo "<script> alert('User with those credentials already exists. Please login instead');</script>";
                  }
              
                  //hash the password before storing it in the  DB
                  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);        
                
                  $userData = array(
                  ":email" => $email,
                  ":secondary_email" => $secondaryEmail,
                  ":phone" => $phone,
                  ":password" => $hashedPassword
                  );

                //DB insert  user/customer query
                $query = "INSERT INTO customers(primary_email,secondary_email,phone,password)
                VALUES (:email,:secondary_email,:phone,:password)";

                $stmt = $conn->prepare($query);

                //Save all details to the DB
                if($stmt->execute($userData)){

                  //All required files or user information initialization
                  $initData = array(
                  ":email" => $email
                  );

                  //Personal Info Init
                  $query = "INSERT INTO personal_info(email)VALUES (:email)";
                  $stmt = $conn->prepare($query);
                  $stmt->execute($initData);

                  //History Info Init
                  $query = "INSERT INTO history(email)VALUES (:email)";

                  $stmt = $conn->prepare($query);
                  $stmt->execute($initData);

                  //Documents Info Init
                  $query = "INSERT INTO documents(email)VALUES (:email)";
                  $stmt = $conn->prepare($query);
                  $stmt->execute($initData);

                  //Languages Info Init
                  $query = "INSERT INTO languages(email)VALUES (:email)";
                  $stmt = $conn->prepare($query);
                  $stmt->execute($initData);

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

  <!--Import jQuery, materialize.js and the helper functions-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/util.js"></script>
  <script>
    $(document).ready(function () {

      //verify that no duplicate emails were entered for the emails fields.
      $("#secondaryEmail").change(function(){
        if($("#email").val() == $("#secondaryEmail").val()){
          Materialize.toast("Primary email and secondary email cannot be the same email address.Please input a different secondary email.", 10000, 'purple');
        } 
      });
      
      //check password strength
      $("#password").change(function(){
        check_password_strength();
      });

      //passwords match verification and create account button activation
      $("#cpassword").focusout(function(){
          var password = $("#password").val();
          var cpassword = $("#cpassword").val();

          if(password != cpassword) {
            Materialize.toast('Your passwords do not match', 10000, 'red');
            $("#signup").attr( "disabled", "disabled" );
          } 
          else {
            Materialize.toast('Your passwords match', 10000, 'green');
            $("#signup").removeAttr("disabled");
          }
        });

      //function to check password strength  
      function check_password_strength() {

        var passwordVal = document.getElementById("password").value;
        var no=0;

        if(passwordVal!=""){
            $("#cpassword").removeAttr("disabled");

            // If the password length is less than or equal to 8
            if(passwordVal.length<=8) no=1;

            // If the password length is greater than 8 and contain any lowercase alphabet or any number or any special character
            if(passwordVal.length>8 && (passwordVal.match(/[a-z]/) || passwordVal.match(/\d+/) || passwordVal.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no=2;

            // If the password length is greater than 8 and contain alphabet,number,special character respectively
            if(passwordVal.length>8 && ((passwordVal.match(/[a-z]/) && passwordVal.match(/\d+/)) || (passwordVal.match(/\d+/) && passwordVal.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (passwordVal.match(/[a-z]/) && passwordVal.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) no=3;

            // If the password length is greater than 8 and must contain alphabets,numbers and special characters
            if(passwordVal.length>8 && passwordVal.match(/[a-z]/) && passwordVal.match(/\d+/) && passwordVal.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) no=4;

            if(no==1){
              Materialize.toast('Your password is very weak,please choose a strong one!', 10000, 'purple');
            }

            if(no==2){
              Materialize.toast('Your password is weak,please choose a strong one!', 10000, 'purple');
            }

            if(no==3){
              Materialize.toast('Your password is quite strong ey!', 10000, 'purple');
            }

            if(no==4) {
              Materialize.toast('Greeeat Password!Its very strong 😃!', 10000, 'purple');
            }
         }
        }
     
    });
  </script>
</body>

</html>