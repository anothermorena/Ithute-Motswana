<center>

    <form action="" method="POST">
        <div class="input-field col s12 m2">
            <select name="level" required>
                <option value="" disabled selected>Choose your option</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Master">Master</option>
                <option value="PHD">PHD</option>
            </select>
            <label>Select Level</label>
        </div>


        <div class="input-field col s12 m3">
            <select id="discipline" name="discipline" required>
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


        <div class="input-field col s12 m6">
            <input type="text" id="major_search" name="major">
            <label for="major_search">Select Major</label>
            <div id="major_list"></div>
        </div>


        <div class="input-field col s12 m1">
            <button class="btn btn-small deep-purple ligthen-1" type="submit" name="create_application">Apply</button>
        </div>
    </form>

    <?php
if(isset($_POST["create_application"])){
  $email = $_SESSION["customer_session"];
  //capture submitted data
  $level = $_POST["level"];
  $discipline = $_POST["discipline"];
  $major = $_POST["major"];
  $date = date("Y");
  $payment = "Pending";
  $status = "Submitted";
  $invoice_no = "IM-".uniqid(true);
  $phone = $_SESSION["customer_phone"];

  $applicationData = array(
  ":level" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($level)))),
  ":discipline" => htmlspecialchars(strip_tags(ucfirst(strtolower($discipline)))),
  ":major" => htmlspecialchars(strip_tags(ucfirst(strtolower($major)))),
  ":email" => htmlspecialchars(strip_tags($email)),
  ":date" => htmlspecialchars(strip_tags($date)),
  ":invoice_no" => htmlspecialchars(strip_tags($invoice_no)),
  ":payment" => htmlspecialchars(strip_tags($payment)),
  ":phone" => $phone,
  ":status" => htmlspecialchars(strip_tags($status))
  );
//DB insert query
$query = "INSERT INTO applications(level,discipline,major,email,phone,date,invoice_no,payment,status)
VALUES (:level,:discipline,:major,:email,:phone,:date,:invoice_no,:payment,:status)";

//Sanitize the data
$stmt = $conn->prepare($query);

//Save all details to the DB

  if($stmt->execute($applicationData)){

     //Update applied status
     $query = "UPDATE customers SET 
     applied = :applied
     WHERE primary_email = :email";

      $updateData = array(
      ":applied" =>  "applied",
       ":email" =>  htmlspecialchars(strip_tags($email))
      );

     //Sanitize the data
     $stmt = $conn->prepare($query);

     //Save all details to the DB
     $stmt->execute($updateData);

          echo "<script>alert('Your application have been created successfully'); </script>";
          echo "<script>window.open('apply.php?my_applications','_self')</script>";
    }

}

?>

</center>