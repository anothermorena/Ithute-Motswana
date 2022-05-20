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

            </div>
            <!-- Page Column -->



            <div class="col s12 m6">
                <div class="input-field col s12">
                    <select id="discipline">
                        <option value="" disabled selected>Choose your Descipline</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Economics">Economics</option>
                        <option value="Education">Education</option>
                        <option value="Engineering">Engineering</option>
                        <option value="History">History</option>
                        <option value="Law">Law</option>
                        <option value="Literature">Literature</option>
                        <option value="Management">Management</option>
                        <option value="Management Science">Management Science</option>
                        <option value="Medicine">Medicine</option>
                        <option value="Natural Science">Natural Science</option>
                        <option value="Philosophy">Philosophy</option>
                    </select>
                    <label>Select Discipline</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">search</i>
                    <input type="text" id="major_search" name="major">
                    <div id="major_list"></div>
                    <label for="major_search">Search for major here</label>
                    <p class="grey-text center">*If your search does not show anything then the major you are searching
                        for is not available </p>
                </div>

            </div>




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




    });
    </script>
</body>

</html>