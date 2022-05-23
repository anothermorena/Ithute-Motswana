<?php

$email = $_SESSION["customer_session"];

//Get customer acamedic history information
$query = "SELECT *  FROM history WHERE email = '$email'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
//Return results as an array 
$row_customer = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $row_customer["id"];
$institute1 = $row_customer["institute1"];
$field1 = $row_customer["field1"];
$qualification1 = $row_customer["qualification1"];
$from1 = $row_customer["from1"];
$to1 = $row_customer["to1"];
$institute2 = $row_customer["institute2"];
$field2 = $row_customer["field2"];
$qualification2 = $row_customer["qualification2"];
$from2 = $row_customer["from2"];
$to2 = $row_customer["to2"];
$institute3 = $row_customer["institute3"];
$field3 = $row_customer["field3"];
$qualification3 = $row_customer["qualification3"];
$from3 = $row_customer["from3"];
$to3 = $row_customer["to3"];
$employer = $row_customer["employer"];
$work = $row_customer["work"];
$position = $row_customer["position"];
$workfrom = $row_customer["workfrom"];
$workto = $row_customer["workto"];


?>

<center>
    <h5>Education & Employment History</h5>
    <p>Please input your education and employment information below</p>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="row">
            <!-- Education Background -->
            <div class="row">
                <h6>Education History</h6>
                <div class="input-field col s12 m4">
                    <input id="institutename1" type="text" class="validate" name="institute1" value="<?php echo htmlspecialchars($institute1);?>" required>
                    <label for="institutename1">Institute Name</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="fieldofstudy1" type="text" class="validate" name="field1" value="<?php echo htmlspecialchars($field1);?>" required>
                    <label for="fieldofstudy1">Field Of Study</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="qualification1" type="text" class="validate" name="qualification1" value="<?php echo htmlspecialchars($qualification1);?>" required>
                    <label for="qualification1">Qualification (e.g BA,BSc)</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="from1" type="text" class="datepicker" name="from1" value="<?php echo htmlspecialchars($from1);?>" required>
                    <label for="from1" data-error="fill in date" data-success="right">From</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="to1" type="text" class="datepicker" name="to1" value="<?php echo htmlspecialchars($to1);?>" required>
                    <label for="to1" data-error="fill in date" data-success="right">To</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="institutename2" type="text" class="validate" name="institute2" value="<?php echo htmlspecialchars($institute2);?>">
                    <label for="institutename2">Institute Name</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="fieldofstudy2" type="text" class="validate" name="field2" value="<?php echo htmlspecialchars($field2);?>">
                    <label for="fieldofstudy2">Field Of Study</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="qualification2" type="text" class="validate" name="qualification2" value="<?php echo htmlspecialchars($qualification2);?>">
                    <label for="qualification2">Qualification (e.g BA,BSc)</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="from2" type="text" class="datepicker" name="from2" value="<?php echo htmlspecialchars($from2);?>">
                    <label for="from2">From</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="to2" type="text" class="datepicker" name="to2" value="<?php echo htmlspecialchars($to2);?>">
                    <label for="to2">To</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m4">
                    <input id="institutename3" type="text" class="validate" name="institute3" value="<?php echo htmlspecialchars($institute3);?>">
                    <label for="institutename3">Institute Name</label>
                </div>


                <div class="input-field col s12 m4">
                    <input id="fieldofstudy3" type="text" class="validate" name="field3" value="<?php echo htmlspecialchars($field3);?>">
                    <label for="fieldofstudy3">Field Of Study</label>
                </div>


                <div class="input-field col s12 m4">
                    <input id="qualification3" type="text" class="validate" name="qualification3" value="<?php echo htmlspecialchars($qualification3);?>">
                    <label for="qualification3">Qualification (e.g BA,BSc)</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="from3" type="text" class="datepicker" name="from3" value="<?php echo htmlspecialchars($from3);?>">
                    <label for="from3">From</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="to3" type="text" class="datepicker" name="to3" value="<?php echo htmlspecialchars($to3);?>">
                    <label for="to3">To</label>
                </div>
            </div>

            <!-- /. Education Background -->

            <!-- Employment Background -->
            <div class="row">
                <h6>Employment History</h6>
                <div class="input-field col s12 m4">
                    <input id="employer" type="text" class="validate" name="employer" value="<?php echo htmlspecialchars($employer);?>" required>
                    <label for="employer">Employer</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="work1" type="text" class="validate" name="work" value="<?php echo htmlspecialchars($work);?>" required>
                    <label for="work">Work Engaged</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="position" type="text" class="validate" name="position" value="<?php echo htmlspecialchars($position);?>" required>
                    <label for="position">Title & Position </label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="workfrom" type="text" class="datepicker" name="workfrom" value="<?php echo htmlspecialchars($workfrom);?>">
                    <label for="workfrom" data-error="fill in date" data-success="right">From</label>
                </div>

                <div class="input-field col s12 m4">
                    <input id="workto" type="text" class="datepicker" name="workto" value="<?php echo htmlspecialchars($workto);?>" required>
                    <label for="workto" data-error="fill in date" data-success="right">To</label>
                </div>

                <div class="input-field col s12 m4">
                    <button class="btn waves-effect waves-light deep-purple lighten-1" type="submit" name="update">Save Changes
                        <i class="material-icons right">check</i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <?php
    if(isset($_POST["update"])){

     $update_id = $id;
     $institute1 = $_POST["institute1"];
     $field1 = $_POST["field1"];
     $qualification1 = $_POST["qualification1"];
     $from1 = $_POST["from1"];
     $to1 = $_POST["to1"];
     $institute2 = $_POST["institute2"];
     $field2 = $_POST["field2"];
     $qualification2 = $_POST["qualification2"];
     $from2 = $_POST["from2"];
     $to2 = $_POST["to2"];
     $institute3 = $_POST["institute3"];
     $field3 = $_POST["field3"];
     $qualification3 = $_POST["qualification3"];
     $from3 = $_POST["from3"];
     $to3 = $_POST["to3"];
     $employer = $_POST["employer"];
     $work = $_POST["work"];
     $position = $_POST["position"];
     $workfrom = $_POST["workfrom"];
     $workto = $_POST["workto"];

       //Update customer education and employment history details
        $query = "UPDATE history SET 
        institute1 = :institute1,
        field1 = :field1,
        qualification1 = :qualification1,
        from1 = :from1,
        to1 = :to1,
        institute2 = :institute2,
        field2 = :field2,
        qualification2 = :qualification2,
        from2 = :from2,
        to2 = :to2,
        institute3 = :institute3,
        field3 = :field3,
        qualification3 = :qualification3,
        from3 = :from3,
        to3 = :to3,
        employer = :employer,
        work = :work,
        position = :position,
        workfrom = :workfrom,
        workto = :workto
        WHERE id = :update_id";

         $updateData = array(
         ":institute1" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($institute1)))),
         ":field1" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($field1)))),
          ":qualification1" => htmlspecialchars(strip_tags(ucfirst(strtolower($qualification1)))),
          ":from1" => htmlspecialchars(strip_tags(ucfirst(strtolower($from1)))),
          ":to1" =>  htmlspecialchars(strip_tags($to1)),
         ":institute2" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($institute2)))),
         ":field2" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($field2)))),
          ":qualification2" => htmlspecialchars(strip_tags(ucfirst(strtolower($qualification2)))),
          ":from2" => htmlspecialchars(strip_tags(ucfirst(strtolower($from2)))),
          ":to2" =>  htmlspecialchars(strip_tags($to2)),
         ":institute3" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($institute3)))),
         ":field3" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($field3)))),
          ":qualification3" => htmlspecialchars(strip_tags(ucfirst(strtolower($qualification3)))),
          ":from3" => htmlspecialchars(strip_tags(ucfirst(strtolower($from3)))),
          ":to3" =>  htmlspecialchars(strip_tags($to3)),
          ":employer" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($employer)))),
          ":work" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($work)))),
          ":position" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($position)))),
          ":workfrom" =>  htmlspecialchars(strip_tags($workfrom)),
          ":workto" =>  htmlspecialchars(strip_tags($workto)),
          ":update_id" =>  htmlspecialchars(strip_tags($id))
         );

        $stmt = $conn->prepare($query);
        //Update the DB
        if($stmt->execute($updateData)){

          echo "<script>alert('Your education and employment information have been updated successfully'); </script>";
          echo "<script>window.open('apply.php?edu_n_history','_self')</script>";
        }
    }

    ?>
</center>