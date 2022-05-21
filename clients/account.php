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
  <!-- Navbar -->
  <?php include("navbar.php");?> 

  <div class="container" style="margin-bottom: 300px; margin-top:220px;">
      <div class="row" >
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
      </div>
    </div>
    
    <?php
        if(isset($_POST["submit"])){
            
            $email = $_SESSION["customer_session"];

            $oldPass = htmlspecialchars($_POST["current_password"]);
            $newPass = htmlspecialchars($_POST["new_password"]);
            $cnewPass = htmlspecialchars($_POST["cnew_password"]);

            $customerEmail = array(
              ":email" =>  $email
              );

            //Get customers old password
            $query = "SELECT password FROM customers WHERE primary_email = :email";
            $stmt = $conn->prepare($query);
            //Execute query
            $stmt->execute($customerEmail); 
            $customerOldPass = $stmt->fetch(PDO::FETCH_ASSOC);

            $oldPassFromDb = $customerOldPass["password"];
          
            //check if user password match with the one in our DB
            if(!password_verify($oldPass,$oldPassFromDb)){
                  echo "<script>alert('Your current password is not valid,please try again'); </script>";
                  echo "<script>window.open('account.php','_self')</script>";
                  exit();
            }
            //check if new password and confirm password match
            if($newPass != $cnewPass){
                echo "<script>alert('Your new passwords do not match.Please try again'); </script>";
                echo "<script>window.open('account.php','_self')</script>";
                exit();
            } 
            //check if user is not setting the current password as the new password
            if($newPass == $oldPass){
              echo "<script>alert('You cannot use your old password as your new password.Please try again'); </script>";
              echo "<script>window.open('account.php','_self')</script>";
              exit();
          } 
        
            //hash the new password first
            $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);

            //Update customer password
            $query = "UPDATE customers SET password = :new_password WHERE primary_email = :email";

            $updateData = array(
            ":new_password" =>  $hashed_password,
              ":email" => $email
            );

            $stmt = $conn->prepare($query);

            //Save all details to the DB
            if($stmt->execute($updateData)){
              echo "<script>alert('Your password have been updated, please login again'); </script>";
              echo "<script>window.open('logout.php','_self')</script>";
              exit();
            }
        }
    ?>


   <!-- Footer -->
  <?php include("../includes/footer.php");?> 

  <!--Import jQuery, materialize.js and the helper functions-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/util.js"></script>

</body>

</html>