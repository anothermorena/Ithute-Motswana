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

        <!-- Confirm Application Deletion  Form-->
        <div class="col s12 m6 center-align ">
            <form action="delete_application.php" method="post">
                <h5 class="center-align">Delete Application</h5>
                <p class="center-align">Are you sure you want to delete this application?</p>

                <div class="row">
                    <div class="col s12 m4 offset-m2">
                        <input type="hidden" class="validate" name="application_id"
                            value="<?php echo $application_id; ?>">
                        <button class="btn waves-effect waves-light red " type="submit"
                            name="delete_application">Yes!Delete Application
                            <i class="material-icons right">delete</i>
                        </button>
                    </div>
                    <div class="col s12 m4">
                        <button class="btn waves-effect waves-light " type="submit" name="keep_application">No!Keep
                            Application
                            <i class="material-icons right">check</i>
                        </button>
                    </div>
                </div>


        </div>

        </form>
        <?php

    if(isset($_POST["delete_application"])){

      $email = $_SESSION["customer_session"];

      $application_id = $_POST["application_id"];

      $query = "DELETE FROM applications WHERE id = :application_id";
      
      $deleteApplication = array(
         ":application_id" =>  $application_id
         );

      $stmt = $conn->prepare($query);

      if($stmt->execute($deleteApplication)){

        //get total number of applications remaining
        $get_applications = "SELECT *  FROM applications where email = :email";

        $applications = array(
            ":email" =>  $email
            );
        // Prepare statement
        $stmt = $conn->prepare($get_applications);
        //Execute query
        $stmt->execute($applications); 
        $result = $stmt->fetchAll();
        $applications_count = $stmt->rowCount();

        if($applications_count == 0){
            $applied = "";
        } else {
            $applied = "Applied";
        }

        //Update applied status
        $query = "UPDATE customers SET 
        applied = :applied
        WHERE primary_email = :email";

        $updateData = array(
        ":applied" =>  $applied,
        ":email" =>  htmlspecialchars(strip_tags($email))
        );

        //Sanitize the data
        $stmt = $conn->prepare($query);

        //Save all details to the DB
        $stmt->execute($updateData);
        
          echo "<script>alert('Application Deleted'); </script>";
           echo "<script>window.open('apply.php?my_applications','_self')</script>";
        }
    }

    if(isset($_POST["keep_application"])){
       echo "<script>window.open('apply.php?my_applications','_self')</script>";

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