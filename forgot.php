<?php
//Sessions
include("includes/client_sessions.php");

//Database Config
include("config/database.php");

// Import PHPMailer classes into the global namespace

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
            <form method="Post" action="forgot.php">
             <h5>Enter your email below. We will send you a password reset link. </h5>
              <div class="input-field">
                <input type="email" id="email" name="email">
                <label for="email">Email</label>
              </div> 
             
              <input type="submit" value="Reset Password" name="reset" class="btn btn-large purple btn-extend">
                <p class="center">Or</p>
               <a href="login.php" class="btn btn-large purple btn-extend grey">
                     <i class="fa fa-sync"></i>  Login</a>
            </form>
            <?php

        if(isset($_POST["reset"])){

            $email = $_POST["email"];

            //generate random unique code
            $code = uniqid(true);

            $resetData = array(
              ":code" =>  htmlspecialchars(strip_tags($code)),
              ":email" => htmlspecialchars(strip_tags($email))
              );
            //DB insert query
            $query = "INSERT INTO reset_passwords(code,email) VALUES (:code,:email)";
             
            //Sanitize the data
            $stmt = $conn->prepare($query);
            
            //Save all details to the DB
            if(!$stmt->execute($resetData)){
              exit("Could not generate password reset code");
            }
            
           // Instantiation and passing `true` enables exceptions
              $mail = new PHPMailer(true);

              try {
                  //Server settings
                  $mail->isSMTP();                                            // Send using SMTP
                  $mail->Host       = ' smtp.zoho.com';                        // Set the SMTP server to send through
                  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                  $mail->Username   = 'service@ithutemotswana.com';                     // SMTP username
                  $mail->Password   = 'Ithutechina123@';                               // SMTP password
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                  $mail->Port       = 587;                                    // TCP port to connect to

                  //Recipients
                  $mail->setFrom('service@ithutemotswana.com', 'Ithute Motswana');
                  $mail->addAddress($email);     // Add a recipient
                  $mail->addReplyTo('no-reply@ithutemotswana.com', 'No reply');          
                


                  // Content
                  $url = "https://www.ithutemotswana.com/reset_password.php?code=$code";
                  $mail->isHTML(true);                                  // Set email format to HTML
                  $mail->Subject = 'Your password reset link';
                  $mail->Body    = "<h1>You requested a password reset </h1>
                                  Click <a href='$url'> this link</a>  to do so.   
                                  ";
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  $mail->send();
                  echo "<script> alert('Reset password link have been sent to your email');</script>";
              } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }
              exit();

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