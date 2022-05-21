<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <title>Ithute Motswana</title>
</head>
<body>
    <!-- Navigation -->
    <?php include("navbar.php"); 
        $applicationId = $_GET["application_id"];
        $invNo = $_GET["inv_no"];
    ?>
    <!-- /. Navigation Ends -->
    <div class="row" style="margin-bottom: 230px; margin-top:121px;">
        <div class="col s12 m3"></div>
            <div class="col s12 m8 center-align ">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <h5 class="left-align">Please confirm your payment</h5>
                    <p class="grey-text left-align">Attach screen shots, deposit slips or any proof of payment you have.</p>
                    <div class="row">
                        <div class="input-field col s12 m4">
                            <input id="invoice_no" type="hidden" class="validate" name="invoice_no" value="<?php echo $inv_no; ?>">
                            <input id="invoice_no" type="text" class="validate" value="<?php echo htmlspecialchars($invNo); ?>" disabled>
                            <input type="hidden" class="validate" name="update_id" value="<?php echo htmlspecialchars($applicationId); ?>">
                            <label for="invoice_no">Invoice No</label>
                        </div>

                        <div class="input-field col s12 m4">
                            <input id="amount" type="number" class="validate" name="amount" required>
                            <label for="amount">Amount Sent (P)</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="file-field input-field col s12 m4">
                            <div class="btn deep-purple lighten-1">
                                <span>Proof of Payment</span>
                                <input type="file" name="pop" required>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" name="pop">
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <button class="btn center" type="submit" name="confirm_payment">Confirm Payment <i class="material-icons right">check</i> </button>
                        </div>
                    </div>
               </div>
           </form>
        <?php
      if(isset($_POST["confirm_payment"])){
        //Capture posted data
        $updateId = $_POST["update_id"];
        $invoiceNo = $_POST["invoice_no"];
        $amount = $_POST["amount"];
        $email = $_SESSION["customer_session"];
        $paymentStatus = "Paid";

        $pop = $_FILES["pop"];

         //get file extension
         $popext = ".".pathinfo($pop["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newpopname = rand();
         $popname = $newpopname.$popext;
        //Get the uploaded file and upload it into the server
        $tempName1 = $pop["tmp_name"];
        move_uploaded_file($tempName1, 'uploads/payments/'.$popname);
       
        //Payment Details
        //sanitize data first before saving to DB
        $paymentData = array(
        ":invoice_no" => htmlspecialchars(strip_tags($invoiceNo)),
        ":amount" => htmlspecialchars(strip_tags($amount)),
        ":email" => htmlspecialchars(strip_tags($email)),
        ":pop" => htmlspecialchars(strip_tags($popname))
        );

        //save Proof of Payment
        $query = "INSERT INTO payments(invoice_no,amount,pop,email) VALUES (:invoice_no,:amount,:pop,:email)";
        $stmt = $conn->prepare($query);
        //Save all details to the DB
        $stmt->execute($paymentData);

        //Update payment status
        $query = "UPDATE applications SET payment = :payment_status WHERE id = :update_id";

         $paymentUpdate = array(
            ":payment_status" =>  htmlspecialchars(strip_tags($paymentStatus)),
            ":update_id" =>  htmlspecialchars(strip_tags($updateId))
         );

        $stmt = $conn->prepare($query);
        if($stmt->execute($paymentUpdate)){
          echo "<script>alert('Your payment have been received.Your Application will now be processed'); </script>";
          echo "<script>window.open('apply.php?my_applications','_self')</script>";
        }
      }
    ?>
    </div>
</div>

<!-- Include Footer -->
<?php include("../includes/footer.php");?>

<!--Import jQuery, materialize.js and the helper functions-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/util.js"></script>

</body>
</html>
