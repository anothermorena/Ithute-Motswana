<?php 
session_name("clients");
session_start();
session_regenerate_id();


if(!isset($_SESSION["customer_session"])){

   echo "<script>window.open('../login.php','_self')</script>";

} else {
//includes
include("../config/database.php");

$application_id = $_GET["application_id"];
$inv_no = $_GET["inv_no"];




?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />


    <title>Ithute Motswana</title>

    <style>
    .nav-position {
        position: relative;
        top: -20px;
    }

    .btn {
        text-transform: none;
    }

    .slider .indicators .indicator-item.active {
        background-color: #0d47a1;
    }

    /* label color */
    .input-field label {
        color: #1565c0;
    }

    /* label focus color */
    .input-field input[type=text]:focus+label {
        color: #1565c0;
    }

    /* label underline focus color */
    .input-field input[type=text]:focus {
        border-bottom: 1px solid #1565c0;
        box-shadow: 0 1px 0 0 #1565c0;
    }

    /* valid color */
    .input-field input[type=text].valid {
        border-bottom: 1px solid #1565c0;
        box-shadow: 0 1px 0 0 #1565c0;
    }

    /* invalid color */
    .input-field input[type=text].invalid {
        border-bottom: 1px solid #000;
        box-shadow: 0 1px 0 0 #000;
    }

    /* icon prefix focus color */
    .input-field .prefix.active {
        color: #1565c0;
    }

    .picker__date-display,
    .picker__weekday-display {
        background-color: rgba(66, 133, 244, 0.79);
    }

    div.picker__day.picker__day--infocus.picker__day--selected.picker__day--highlighted {
        background-color: rgba(66, 133, 244, 0.79);
    }

    button.picker__today,
    button.picker__close {
        color: rgba(66, 133, 244, 0.79);
    }
    </style>

</head>

<body>

    <!-- Navigation -->
    <?php include("navbar.php"); ?>
    <!-- /. Navigation Ends -->





    <div class="row">
        <!-- Side Menu -->

        <div class="col s12 m3">
            <br>
            <br>
            <br>
            <br>

        </div>
        <!-- /.Side Menu-->

        <br>
        <br>
        <br>

        <!-- Confirm Application Payment Form-->
        <div class="col s12 m8 center-align ">
            <form action="confirm.php" method="post" enctype="multipart/form-data">
                <h5 class="left-align">Please confirm your payment</h5>
                <p class="grey-text left-align">Attach screen shots, deposit slips or any proof of payment you have.</p>
                <div class="row">
                    <div class="input-field col s12 m4">

                        <input id="invoice_no" type="hidden" class="validate" name="invoice_no" value="<?php echo $inv_no; ?>">
                        <input id="invoice_no" type="text" class="validate" value="<?php echo $inv_no; ?>" disabled>
                        <input type="hidden" class="validate" name="update_id" value="<?php echo $application_id; ?>">
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
                        <button class="btn center" type="submit" name="confirm_payment">Confirm Payment <i
                                class="material-icons right">check</i> </button>
                    </div>

                </div>

                <div class="row">

                </div>


        </div>

        </form>
        <?php
      if(isset($_POST["confirm_payment"])){

        //Capture posted data
        $update_id = $_POST["update_id"];
        $invoice_no = $_POST["invoice_no"];
        $amount = $_POST["amount"];
        $email = $_SESSION["customer_session"];
        $paymemt_status = "Paid";

        $pop = $_FILES["pop"];

         //get file extension
         $popext = ".".pathinfo($pop["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newpopname = rand();
         $popname = $newpopname.$popext;
        //Get the uploaded file and upload it into the server
      
        $temp_name1 = $pop["tmp_name"];
        move_uploaded_file($temp_name1, 'uploads/payments/'.$popname);
       
       
        //Payment Details
        //Clean data first before saving to DB
        $paymentData = array(
        ":invoice_no" => htmlspecialchars(strip_tags($invoice_no)),
        ":amount" => htmlspecialchars(strip_tags($amount)),
        ":email" => htmlspecialchars(strip_tags($email)),
        ":pop" => htmlspecialchars(strip_tags($popname))
        );

 


        //Insert Proof of Payment
        $query = "INSERT INTO payments(invoice_no,amount,pop,email)
        VALUES (:invoice_no,:amount,:pop,:email)";

        //Sanitize the data
        $stmt = $conn->prepare($query);

        //Save all details to the DB
        $stmt->execute($paymentData);

   
        //Update payment status
      $query = "UPDATE applications SET payment = :payment_status WHERE id = :update_id";

         $paymentUpdate = array(
        ":payment_status" =>  htmlspecialchars(strip_tags($paymemt_status)),
        ":update_id" =>  htmlspecialchars(strip_tags($update_id))
         );

        //Sanitize the data
        $stmt = $conn->prepare($query);

        //Save all details to the DB
        if($stmt->execute($paymentUpdate)){

          echo "<script>alert('Your payment have been recieved.Your Application will now be processed'); </script>";
          echo "<script>window.open('apply.php?my_applicatons','_self')</script>";
        }


      }

    ?>

    </div>
    <!-- /. Confirm Order Payment Form -->



    </div>





    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <!-- Include Footer -->
    <?php include("../includes/footer.php");?>





    <!-- Compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {


        //Selectt
        $('select').formSelect();

        //Date Picker
        $('.datepicker').datepicker();
    });
    </script>
</body>

</html>
<?php } ?>