<?php
require("../config/database.php");

if(isset($_POST["discipline"])){
    $discipline = $_POST["discipline"];
    $major_array = array();

    //Fetch majors from the database
    $query = "SELECT major  FROM majors WHERE discipline = '$discipline'";
    // Prepare statement
    $stmt = $conn->prepare($query);
    //Execute query
    $stmt->execute(); 
    //Return results as an array and loop through them
    while($row_major = $stmt->fetch(PDO::FETCH_ASSOC)){
        $major_array[] = $row_major;
    }

    //encode it to json
    echo json_encode($major_array);

}



