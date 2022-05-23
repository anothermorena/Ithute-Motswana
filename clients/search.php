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
</head>

<body>

    <!-- Navbar -->
    <?php include("navbar.php");?>

    <div class="container-fluid">
        <div class="row" style="margin-bottom:300px; margin-top:148px;">
            <div class="col s12 m3"></div>
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
                    <p class="grey-text center">*If your search does not show anything then the major you are searching for is not available </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include("../includes/footer.php");?>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/util.js"></script>
    <script>
    $(document).ready(function() {
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