<?php

$email = $_SESSION["customer_session"];

//Get customer personal information
$query = "SELECT *  FROM languages WHERE email = '$email'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
//Return results as an array 
$row_customer = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $row_customer["id"];
$chinese = $row_customer["chinese"];
$english = $row_customer["english"];
$hsk_cert = $row_customer["hsk_cert"];
$eng_cert = $row_customer["eng_cert"];
$work = $row_customer["work"];
$school = $row_customer["school"];

?>

<center>
    <h5>Language Proficiency</h5>
    <p>How is your English and Chinese? </p>

    <form method="POST" action="" enctype="multipart/form-data">

        <div class="row">
            <!-- Chinese Proficiency -->
            <div class="row">
                <div class="input-field col s12 m4">
                    <select name="chinese" required>
                        <option value="<?php echo $chinese;?>"><?php echo $chinese;?></option>
                        <option value="Bad">Bad</option>
                        <option value="Good">Good</option>
                        <option value="Excellent">Excellent</option>

                    </select>
                    <label>Chinese Proficiency</label>
                </div>

                <div class="file-field input-field col s12 m8">
                    <div class="btn deep-purple lighten-1">
                        <span>HSK Certificate</span>
                        <input type="file" name="hsk_cert">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="hsk_cert" value="<?php echo $hsk_cert;?>">
                    </div>
                </div>

            </div>
            <!-- /. Chinese Proficiency -->

            <!-- English Proficiency -->
            <div class="row">
                <div class="input-field col s12 m4">
                    <select name="english" required>
                        <option value="<?php echo $english;?>"><?php echo $english;?></option>
                        <option value="Bad">Bad</option>
                        <option value="Good">Good</option>
                        <option value="Excellent">Excellent</option>

                    </select>
                    <label>English Proficiency</label>
                </div>

                <div class="file-field input-field col s12 m8">
                    <div class="btn deep-purple lighten-1">
                        <span>English Certificate</span>
                        <input type="file" name="eng_cert">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="eng_cert" value="<?php echo $eng_cert;?>">
                    </div>
                </div>

            </div>
            <!-- /. English Proficiency -->
            <!-- Work And School -->
            <div class="row">
                <div class="input-field col s12 m4">
                    <select name="work" required>
                        <option value="<?php echo $work;?>"><?php echo $work;?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <label>Ever studied or worked in China</label>
                </div>
                <div class="input-field col s12 m4">
                    <select name="school" required>
                        <option value="<?php echo $school;?>"><?php echo $school;?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <label>Ever studied in China under a Chinese Government Scholarship</label>
                </div>

                <div class="input-field col s12 m4">
                    <button class="btn waves-effect waves-light deep-purple lighten-1" type="submit" name="update">Save
                        Changes
                        <i class="material-icons right">check</i>
                    </button>
                </div>
            </div>
            <!-- /. Work And School-->




        </div>

    </form>
    <?php
    if(isset($_POST["update"])){

      $update_id = $id;
      $chinese = $_POST["chinese"];
      $english = $_POST["english"];
      $work = $_POST["work"];
      $school = $_POST["school"];

      $hsk_cert = $_FILES["hsk_cert"];
      $eng_cert = $_FILES["eng_cert"];


       //prevent empty form submisions erasing already uploaded files
       if(!empty($_FILES["hsk_cert"]) && $_FILES["hsk_cert"]["name"] != ""){
        //get file extension
       $hskcertext = ".".pathinfo($hsk_cert["name"], PATHINFO_EXTENSION);
       //give a random name to the file   
       $hsk_certnewname =  uniqid(true);
       $hsk_certname = $hsk_certnewname.$hskcertext;
       
      } else {
          $hsk_certname = $row_customer["hsk_cert"];
      }

      if(isset($_FILES["eng_cert"]) && $_FILES["eng_cert"]["name"] != ""){
        //get file extension
       $engcertext = ".".pathinfo($eng_cert["name"], PATHINFO_EXTENSION);
       //give a random name to the file   
       $eng_certnewname =  uniqid(true);
       $eng_certname = $eng_certnewname.$engcertext;
      
      } else {
          $eng_certname = $row_customer["eng_cert"];
      }

      $temp_name1 = $hsk_cert["tmp_name"];
      $temp_name2 = $eng_cert["tmp_name"];    
     

      move_uploaded_file($temp_name1, 'uploads/languages/'.$hsk_certname);
      move_uploaded_file($temp_name2, 'uploads/languages/'.$eng_certname);
      


       //Update customer account details
        $query = "UPDATE languages SET 
        chinese = :chinese,
        english = :english,
        hsk_cert = :hsk_cert,
        eng_cert = :eng_cert,
        work = :work,
        school = :school
        WHERE id = :update_id";

         $updateData = array(
         ":chinese" =>  htmlspecialchars(strip_tags($chinese)),
         ":english" =>  htmlspecialchars(strip_tags($english)),
          ":hsk_cert" => htmlspecialchars(strip_tags($hsk_certname)),
          ":eng_cert" => htmlspecialchars(strip_tags($eng_certname)),
          ":work" => htmlspecialchars(strip_tags($work)),
          ":school" => htmlspecialchars(strip_tags($school)),
          ":update_id" =>  htmlspecialchars(strip_tags($update_id))
         );

        //Sanitize the data
        $stmt = $conn->prepare($query);

        //Save all details to the DB
        if($stmt->execute($updateData)){

          echo "<script>alert('Your information have been updated successfully'); </script>";
          echo "<script>window.open('apply.php?language','_self')</script>";
        }

    }


    ?>

</center>