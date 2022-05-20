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
    ul.dropdown-content.select-dropdown li:not(.disabled) span {
        color: #7e57c2;
    }

    /* label color */
    .input-field label {
        color: #7e57c2;
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
            <form action="status.php" method="post">
                <h5 class="center-align">Client Application Status</h5>
                <p class="center-align">Update Application Status Below</p>

                <div class="row">
                    <div class="row">
                    <div class="input-field col s12">
                    <input type="hidden" class="validate" name="application_id"
                            value="<?php echo $application_id; ?>">

                        <select name="status" required>
                        <option value="" disabled selected>Choose application status</option>
                        <option value="In Review">In Review</option>
                        <option value="Reviewed">Reviewed</option>
                        <option value="Processed">Processed</option>
                        <option value="In Process">In Process</option>
                        <option value="Admitted">Admitted</option>
                        <option value="Apply Again">Apply Again</option>
                        </select>
                        <label>Select Application Status</label>
                    </div>
                    </div>
 
                </div>
               
                    <div class="col s12">
                    <button class="btn waves-effect waves-light deep-purple" type="submit" name="update_status">Update Status
                        </button>
                       
                    </div>
                </div>


        </div>

        </form>
        <?php
      if(isset($_POST["update_status"])){

       $application_id = $_POST["application_id"];
       $status = $_POST["status"];

          //Update contacted  status and contacted by
          $query = "UPDATE applications SET 
          status = :status
          WHERE id = :id";
  
          $updateData = array(
          ":status" =>  $status,
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
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {


        //Selectt
        $('select').material_select();

       
    });
    </script>
</body>

</html>
<?php } ?>