<?php
require("../config/database.php");

//search for academic disciplines
if(isset($_POST["discipline"])){

    $discipline = $_POST["discipline"];
    $majorArray = array();

    $disciplineSearch = array(
        ":discipline" =>  htmlspecialchars(strip_tags($discipline))
     );
    //Fetch majors from the database
    $query = "SELECT major  FROM majors WHERE discipline = :discipline ";
    $stmt = $conn->prepare($query);
    //Execute query
    $stmt->execute($disciplineSearch); 
    //Return results as an array and loop through them
    while($rowMajor = $stmt->fetch(PDO::FETCH_ASSOC)){
        $majorArray[] = $rowMajor;
    }

    //encode it to json
    echo json_encode($majorArray);

}



