<?php
//Sessions
include("includes/client_sessions.php");
//Database Config
include("config/database.php");

if(!isset($_GET["code"])){
  exit("Cant find the requested page");

}

$code = $_GET["code"];
$query = "SELECT email  FROM reset_passwords WHERE code = '$code'";

$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
//Fetch all corresponding accounts
$count_emails = $stmt->rowCount();
//Return results as an array 
$row_email = $stmt->fetch(PDO::FETCH_ASSOC);
$email = $row_email["email"];
if($count_emails == 0){

    echo "<script> alert('Cant find the requested page');</script>";
    exit();

}

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
        <div class="col s12 m3"></div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-4 grey-text text-darken-4 z-depth-0">
            <form method="Post" action="reset_password.php?code=<?php echo $code; ?>">
             <h5>Create a new password below </h5>
              <div class="input-field">
                <input type="password" id="password" name="password">
                <input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
                <input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
                <label for="password">New Password</label>
              </div> 
    
              <input type="submit" value="Update Password" name="update"  class="btn btn-large purple btn-extend">
               
            </form>
            <?php

        if(isset($_POST["password"])){
            $password = $_POST["password"];
            $code = $_POST["code"];
            $email = $_POST["email"];

             // hash the password before storing it in the  DB
             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

             //Update users password
             $query = "UPDATE customers SET password = :password WHERE primary_email = :email";
 
             $updateData = array(
            ":password" => $hashed_password ,
            ":email" =>  htmlspecialchars(strip_tags($email))
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
                echo "<script> alert(Something went wrong);</script>";
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