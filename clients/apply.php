<?php
session_name("clients");
session_start();
session_regenerate_id();

//redirect user to login page if login session is not set
if(!isset($_SESSION["customer_session"])){
    echo "<script> window.open('../login.php','_self')</script>";
  
  }
//Database Config
include("../config/database.php");

$email = $_SESSION["customer_session"];


//get application number counter
   $get_applications = "SELECT *  FROM applications WHERE email='$email'";
   // Prepare statement
   $stmt = $conn->prepare($get_applications);
   //Execute query
   $stmt->execute(); 
   $result = $stmt->fetchAll();
   $ap_count = $stmt->rowCount();


  

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/main.css" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ithute Motswana</title>

    <style>
    ul.dropdown-content.select-dropdown li:not(.disabled) span {
        color: #7e57c2;
    }

    /* label color */
    .input-field label {
        color: #7e57c2;
    }


    /* valid color */
    .input-field input[type=text].valid {
        border-bottom: 1px solid #7e57c2;
        box-shadow: 0 1px 0 0 #7e57c2;
    }

    /* invalid color */
    .input-field input[type=text].invalid {
        border-bottom: 1px solid #000;
        box-shadow: 0 1px 0 0 #000;
    }

    /* icon prefix focus color */
    .input-field .prefix.active {
        color: #7e57c2;
    }

    input:not([type]):focus:not([readonly]),
    input[type="text"]:not(.browser-default):focus:not([readonly]),
    input[type="password"]:not(.browser-default):focus:not([readonly]),
    input[type="email"]:not(.browser-default):focus:not([readonly]),
    input[type="url"]:not(.browser-default):focus:not([readonly]),
    input[type="time"]:not(.browser-default):focus:not([readonly]),
    input[type="date"]:not(.browser-default):focus:not([readonly]),
    input[type="datetime"]:not(.browser-default):focus:not([readonly]),
    input[type="datetime-local"]:not(.browser-default):focus:not([readonly]),
    input[type="tel"]:not(.browser-default):focus:not([readonly]),
    input[type="number"]:not(.browser-default):focus:not([readonly]),
    input[type="search"]:not(.browser-default):focus:not([readonly]),
    textarea.materialize-textarea:focus:not([readonly]) {
        border-bottom: 1px solid #7e57c2;
        -webkit-box-shadow: 0 1px 0 0 #7e57c2;
        box-shadow: 0 1px 0 0 #7e57c2;
    }
    input[name="from1"].invalid~label:after {
      content: attr(data-error);
      color: #F44336;
      opacity: 1;
    }
    input[name="from1"]:focus~label:after,
    input[name="from1"]~label:after {
      display: block;
      content: "";
      position: absolute;
      top: 36px;
      opacity: 0;
      white-space: pre;
      transition: .2s opacity ease-out, .2s color ease-out;
    }
    input[name="to1"].invalid~label:after {
      content: attr(data-error);
      color: #F44336;
      opacity: 1;
    }
    input[name="to1"]:focus~label:after,
    input[name="to1"]~label:after {
      display: block;
      content: "";
      position: absolute;
      top: 36px;
      opacity: 0;
      white-space: pre;
      transition: .2s opacity ease-out, .2s color ease-out;
    }
    input[name="workfrom"].invalid~label:after {
      content: attr(data-error);
      color: #F44336;
      opacity: 1;
    }
    input[name="workfrom"]:focus~label:after,
    input[name="workfrom"]~label:after {
      display: block;
      content: "";
      position: absolute;
      top: 36px;
      opacity: 0;
      white-space: pre;
      transition: .2s opacity ease-out, .2s color ease-out;
    }
    input[name="workto"].invalid~label:after {
      content: attr(data-error);
      color: #F44336;
      opacity: 1;
    }
    input[name="workto"]:focus~label:after,
    input[name="workto"]~label:after {
      display: block;
      content: "";
      position: absolute;
      top: 36px;
      opacity: 0;
      white-space: pre;
      transition: .2s opacity ease-out, .2s color ease-out;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include("navbar.php");?>

    <!-- Page Container -->
    <div class="container-fluid">
        <!-- Page Row -->
        <div class="row" style="position:relative;top:100px;">

            <div class="col s12 m3">
                <?php include("includes/sidebar.php") ?>
            </div>
            <!-- Page Column -->

            <!-- Different Page Display -->
            <div class="col s12 m8">
                <?php 
            if(!isset($_GET["new_application"]) && !isset($_GET["personal_info"]) 
            && !isset($_GET["our_contacts"]) && !isset($_GET["bank_details"]) && !isset($_GET["language"]) 
            && !isset($_GET["edu_n_history"]) && !isset($_GET["my_applications"]) && !isset($_GET["documents"])
            ){
              include("my_applications.php");     
            }
              //user clicks on new application
              if (isset($_GET["new_application"])){

                include("new_application.php");     
              } 
              
              //user clicks on my application
              if (isset($_GET["my_applications"])){

                include("my_applications.php");     
              } 
              //user clicks on personal info
              if (isset($_GET["personal_info"])){

                include("personal_info.php");     
              } 
               
              
              //user clicks on our contacts
              if (isset($_GET["our_contacts"])){

                include("contacts.php");     
              } 
              //user clicks on banking details
              if (isset($_GET["bank_details"])){

                include("bank_details.php");     
              } 

              //user clicks on language Proficiency
              if (isset($_GET["language"])){

                include("language.php");     
              } 
              //user clicks on supporting documents
              if (isset($_GET["documents"])){

                include("documents.php");     
              } 
              
            
            ?>

            </div>
            <!-- /. Different Page Display -->




            <!-- ./ Page Column -->

        </div>
        <!-- ./ Page Row -->

    </div>
    <!-- ./ Page Container -->







    <!-- Footer -->
    <?php include("footer.php");?>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {

         //side nav init
         $('.button-collapse').sideNav();

        $('select').material_select();

        //Date Picker
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 2000, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true, // Close upon selecting a date,
            container: undefined, // ex. 'body' will append picker to body,
            format: 'yyyy-mm-dd'
        });

        $('.datepicker').on('mousedown',function(event){ 
          event.preventDefault();
          });

        //major search and filtering
        $("#major_search").keyup(function() {

           


            var discipline = $('select#discipline').val();
            var major = $(this).val();

            if (major != "") {

                $.ajax({
                    url: "search_results.php",
                    method: "POST",
                    data: {
                        major: major,
                        discipline: discipline
                    },
                    success: function(data) {
                        $("#major_list").fadeIn();
                        $("#major_list").html(data);
                    }
                });

                $(document).on('click', '.li', function() {
                    $("#major_search").val($(this).text());
                    $("#major_list").fadeOut();


                });


            } else {
                $("#major_list").fadeOut();
            }
        });

        //Required first 2 date options enforce
        function checkDate() {
          if ($('#from1').val() == '') {

            $('#from1').addClass('invalid');
            alert("Please Fill the From date field in your education history");

          }
           else if ($('#to1').val() == '') {
            $('#to1').addClass('invalid');
            alert("Please fill the To date field your education history");

          } 
           else if ($('#workfrom').val() == '') {
            $('#workfrom').addClass('invalid');
            alert("Please fill the From date field in your employment history");

          } 
           else if ($('#workto').val() == '') {
            $('#workto').addClass('invalid');
            alert("Please fill the To date field your in employment history");

          } else {
            $('#from1').removeClass('invalid')
            $('#to1').removeClass('invalid')
            $('#workfrom').removeClass('invalid')
            $('#workto').removeClass('invalid')
            $('form').submit();
          }
        }

        $('form').submit(function() {
          checkDate();
          return false;
        });

        $('#form1').change(function() {
          checkDate();
        });
        $('#to1').change(function() {
          checkDate();
        });
        $('#workfrom').change(function() {
          checkDate();
        });
        $('#workto').change(function() {
          checkDate();
        });


      



    });
    </script>
</body>

</html>