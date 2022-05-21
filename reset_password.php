<!DOCTYPE html>
<html>
<!-- Document Head -->
<?php include "includes/header.php";

//check if user has a password reset code
if(!isset($_GET["code"])){
  exit("Cant find the requested page");
} else {
  $code = htmlspecialchars($_GET["code"]);
}


$resetCode = array(
  ":code" =>  $code
  );

//verify if the user's password reset code is not a sham 🤨
$query = "SELECT email  FROM reset_passwords WHERE code = :code";

$stmt = $conn->prepare($query);
//Execute query
$stmt->execute($resetCode); 
$countEmails = $stmt->rowCount();

if($countEmails == 0){
    echo "<script> alert('Cant find the requested page');</script>";
    exit();
} else {
  //users code is valid, get their email and use it for resetting their password
  $rowEmail = $stmt->fetch(PDO::FETCH_ASSOC);
  $email = $rowEmail["email"];
}

?>

<body>
  <!-- Header -->
   <?php include("includes/navbar.php");?>

  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12 m3"></div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <form method="Post" action="reset_password.php?code=<?php echo htmlspecialchars($code); ?>">
             <h5>Create a new password below </h5>
              <div class="input-field">
                <input type="password" id="password" name="password">
                <input type="hidden" id="code" name="code" value="<?php echo htmlspecialchars($code); ?>">
                <input type="hidden" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <label for="password">New Password</label>
              </div> 
              <input type="submit" value="Update Password" name="update"  class="btn btn-large purple btn-extend">
            </form>
            <?php

        if(isset($_POST["password"])){
            $password = htmlspecialchars($_POST["password"]);
            $code = htmlspecialchars($_POST["code"]);
            $email = htmlspecialchars($_POST["email"]);

             // hash the password before storing it in the  DB
             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

             //Update users password
             $query = "UPDATE customers SET password = :password WHERE primary_email = :email";
 
             $updateData = array(
              ":password" => $hashed_password ,
              ":email" =>  $email
            );
    
            //Sanitize the data
            $stmt = $conn->prepare($query);
    
            //Save all details to the DB
            if($stmt->execute($updateData)){
                //delete request from reset passwords table
                $query = "DELETE FROM reset_passwords WHERE code = :code";
      
                $deleteRequest = array(
                   ":code" =>  $code
                   );
          
                $stmt = $conn->prepare($query);
          
                $stmt->execute($deleteRequest);
                echo "<script> alert(Password updated,please login);</script>";
                echo "<script> window.open('login.php','_self')</script>";
            } else {
                echo "<script> alert(Something went wrong. Let us try to reset the password again!);</script>";
                echo "<script> window.open('forgot.php','_self')</script>";
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