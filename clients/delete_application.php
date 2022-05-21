<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"  integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <title>Ithute Motswana</title>
    <style>
        .btn {
            text-transform: none;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include("navbar.php"); 
         $applicationId = $_GET["application_id"];
    
    ?>
    <div class="row" style="margin-top:219px; margin-bottom:300px;">
        <div class="col s12 m3"></div>
        <!-- Confirm Application Deletion  Form-->
        <div class="col s12 m6 center-align ">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <h5 class="center-align">Delete Application</h5>
                <p class="center-align">Are you sure you want to delete this application?</p>
                <div class="row">
                    <div class="col s12 m4 offset-m2">
                        <input type="hidden" class="validate" name="application_id" value="<?php echo htmlspecialchars($applicationId); ?>">
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

            $applicationId = $_POST["application_id"];

            //delete selected application
            $query = "DELETE FROM applications WHERE id = :application_id";
            
            $deleteApplication = array(
                ":application_id" =>  $applicationId
                );

            $stmt = $conn->prepare($query);

            if($stmt->execute($deleteApplication)){

                //get total number of applications remaining
                $getApplications = "SELECT *  FROM applications where email = :email";
                $applications = array(
                    ":email" =>  $email
                );

                $stmt = $conn->prepare($getApplications);
                $stmt->execute($applications); 
                $result = $stmt->fetchAll();
                $applicationsCount = $stmt->rowCount();

                if($applicationsCount == 0){
                    $applied = "";
                } else {
                    $applied = "Applied";
                }

                //Update applied status
                $query = "UPDATE customers SET applied = :applied WHERE primary_email = :email";
                $updateData = array(
                ":applied" =>  $applied,
                ":email" =>  htmlspecialchars(strip_tags($email))
                );

                $stmt = $conn->prepare($query);
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
</div>
<!-- Include Footer -->
<?php include("../includes/footer.php");?>

<!--Import jQuery, materialize.js and the helper functions-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/util.js"></script>

</body>
</html>
