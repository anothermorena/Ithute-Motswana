<!DOCTYPE html>
<html>
<!-- Document Head -->
<?php 

include_once("config.php");
include_once("includes/header.php");

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


?>
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
              <!-- php self can be used for xss -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h5>Enter your email below. We will send you a password reset link. </h5>
                  <div class="input-field">
                    <input type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "" ?>">
                    <input type="hidden" name="token" value="<?=$_SESSION["token"]?>"/>
                    <label for="email">Email</label>
                  </div> 
                
                  <input type="submit" value="Reset Password" name="reset" class="btn btn-large purple btn-extend">
                    <p class="center">Or</p>
                  <a href="login.php" class="btn btn-large purple btn-extend grey"><i class="fa fa-sync"></i>  Login</a>
            </form>
            <?php
            
              if(isset($_POST["reset"])){
           
                    $email = htmlspecialchars($_POST["email"]);

                    $customerEmail = array(
                      ":email" => $email  
                      );
    
                    $query = "SELECT primary_email FROM customers WHERE primary_email = :email";
    
                    $stmt = $conn->prepare($query);
                    //Execute query
                    $stmt->execute($customerEmail); 
                    //Fetch all corresponding accounts
                    $countUsers = $stmt->rowCount();
    
    
                    if($countUsers <= 0){
                      //user not found Do not tell that to the user incase its a hacker and can keep trying different email accounts
                      echo "<script> alert('Something went wrong. Please contact customer support to help you with your account problems');</script>";
    
                    } else {
                        //account found, proceed with the password reset process.
    
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
                      
                        //Instantiation and passing `true` enables exceptions
                        $mail = new PHPMailer(true);
    
                        try {
                            //Server settings
                            $mail->isSMTP();                                            // Send using SMTP
                            $mail->Host       = ' smtp.zoho.com';                       // Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                            $mail->Username   = $_ENV['SMTP_USER'];                     // SMTP username
                            $mail->Password   = $_ENV['SMTP_PASSWORD'];                 // SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                            $mail->Port       = 587;                                    // TCP port to connect to
    
                            //Recipients
                            $mail->setFrom('service@ithutemotswana.com', 'Ithute Motswana');
                            $mail->addAddress($email);     // Add a recipient
                            $mail->addReplyTo('no-reply@ithutemotswana.com', 'No reply');          
    
                            // Content
                            $url = "https://www.anothermorena.com/reset_password.php?code=$code";
                            $mail->isHTML(true);           // Set email format to HTML
                            $mail->Subject = 'Your password reset link';
                            $mail->Body    = "<h1>You requested a password reset </h1>Click <a href='$url'> this link</a>  to do so.";
                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                            $mail->send();
                            
                            echo "<script> alert('Reset password link have been sent to your email');</script>";
                            //redirect the customer to the index page
                            echo "<script> window.open('index.php','_self')</script>";

                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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