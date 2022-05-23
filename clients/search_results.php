<?php
//database config
include("../config/database.php");

if(isset($_POST['major']) && isset($_POST["discipline"])){

    //capture the search details
    $major = htmlspecialchars($_POST['major']);
    $discipline = htmlspecialchars($_POST['discipline']);

    $output = '';
    $query = "SELECT * FROM majors WHERE discipline = '".$discipline."' AND major LIKE '%".$major."%'";
    $stmt = $conn->prepare($query);

    $stmt->execute();
    $output = '<ul class="list-unstyled" style="background-color:#eee;cursor:pointer">';

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
         foreach($result as $row){
            $output .= '<li style="padding:12px;" id="'.$row["id"].'" class="li">'.$row["major"].'</li>';
        }

    } else {
        $output .= '<li > Major not available!!You should try your other choices maybe?  </li>';
    }
        $output .='</ul>';
        echo $output;
}

?>