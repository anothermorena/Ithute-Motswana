<?php 
session_name("admins");
session_start();
session_regenerate_id();


if(!isset($_SESSION["admin_session"])){

    echo "<script> window.open('index.php','_self')</script>";


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

        <!-- Confirm Client Contact Form-->
        <div class="col s12 m6 center-align ">
            <form action="feedback_applications.php" method="post">
                <h5 class="center-align">Client Contacted</h5>
                <p class="center-align">Okay, client was contacted, A reng? *Eye Roll*</p>

                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                        <input type="hidden" class="validate" name="application_id"
                            value="<?php echo $application_id; ?>">
                        <textarea id="feedback" class="materialize-textarea" name="feedback" required></textarea>
                        <label for="feedback">Feedback</label>
                        </div>
                    </div>
 
                </div>
               
                    <div class="col s12">
                    <button class="btn waves-effect waves-light deep-purple" type="submit" name="client_feedback">Save Feedback
                        </button>
                       
                    </div>
                </div>


        </div>

        </form>
        <?php
      if(isset($_POST["client_feedback"])){

       $application_id = $_POST["application_id"];
       $feedback = $_POST["feedback"];

          //Update contacted  status and contacted by
          $query = "UPDATE applications SET 
          feedback = :feedback
          WHERE id = :id";
  
          $updateData = array(
          ":feedback" =>  $feedback,
          ":id" =>  htmlspecialchars(strip_tags($application_id))
          );
  
          //Sanitize the data
          $stmt = $conn->prepare($query);
  
          //Save all details to the DB
          if($stmt->execute($updateData)){
           echo "<script>window.open('dashboard.php?all_applications','_self')</script>";
  
           
          }
      }
  

  
      ?>

    </div>




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