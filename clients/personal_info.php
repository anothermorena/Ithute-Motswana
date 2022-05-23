<?php
$customerEmail = array(
  ":email" =>  $_SESSION["customer_session"]
  );

//Get customer personal information
$query = "SELECT *  FROM personal_info WHERE email = :email";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute($customerEmail); 
//Return results as an array 
$row_customer_personal_info = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $row_customer_personal_info["id"];
$firstname = $row_customer_personal_info["firstname"];
$middlename = $row_customer_personal_info["middlename"];
$lastname = $row_customer_personal_info["lastname"];
$chinesename = $row_customer_personal_info["chinese_name"];
$dob = $row_customer_personal_info["dob"];
$gender = $row_customer_personal_info["gender"];
$marital_status = $row_customer_personal_info["marital_status"];
$country = $row_customer_personal_info["country_of_birth"];
$city = $row_customer_personal_info["city_of_birth"];
$religion = $row_customer_personal_info["religion"];
$nationality = $row_customer_personal_info["nationality"];
$native_language = $row_customer_personal_info["native_language"];
$passport_no = $row_customer_personal_info["passport_no"];
$passport_exp = $row_customer_personal_info["date_of_expiration"];
$fax = $row_customer_personal_info["fax"];
$postal = $row_customer_personal_info["postal_address"];
?>
<center>
  <h5>Personal Information</h5>
  <p>Please input your personal information below</p>
  <form method="POST" action="">
      <div class="row">
        <div class="input-field col s12 m4">
          <input id="firstname" type="text" class="validate" name="firstname" value="<?php echo htmlspecialchars($firstname);?>" required>
          <label for="firstname">First Name</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="middlename" type="text" class="validate" name="middlename" value="<?php echo htmlspecialchars($middlename);?>" required>
          <label for="middlename">Middle Name</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="lastname" type="text" class="validate" name="lastname" value="<?php echo htmlspecialchars($lastname);?>" required>
          <label for="lastname">Last Name</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="chinesename" type="text" class="validate" name="chinesename" value="<?php echo htmlspecialchars($chinesename);?>">
          <label for="chinesename">Chinese Name</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="dob" type="text" class="datepicker" name="dob" value="<?php echo htmlspecialchars($dob);?>" required>
          <label for="dob">Date Of Birth</label>
        </div>

         <div class="input-field col s12 m4">
            <select name="gender" required>
                <option value="<?php echo $gender;?>"><?php echo htmlspecialchars($gender);?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other :)</option>      
            </select>
            <label>Gender</label>
        </div>

         <div class="input-field col s12 m4">
            <select name="marital_status" required>
                <option value="<?php echo $marital_status;?>"><?php echo htmlspecialchars($marital_status);?></option>
                <option value="Single">Single</option>
                <option value="In a Relationship">In a Relationship</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="widow">Widow</option>     
            </select>
            <label>Marital Status</label>
        </div>

       <div class="input-field col s12 m4">
          <input id="country" type="text" class="validate" name="country" value="<?php echo htmlspecialchars($country);?>" required>
          <label for="country">Country Of Birth</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="city" type="text" class="validate" name="city" value="<?php echo htmlspecialchars($city);?>" required>
          <label for="city">City Of Birth</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="religion" type="text" class="validate" name="religion" value="<?php echo htmlspecialchars($religion);?>" required>
          <label for="religion">Religion</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="nationality" type="text" class="validate" name="nationality" value="<?php echo htmlspecialchars($nationality);?>" required>
          <label for="nationality">Nationality</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="language" type="text" class="validate" name="language" value="<?php echo htmlspecialchars($native_language);?>" required>
          <label for="language">Native Lanaguage</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="passport" type="text" class="validate" name="passport" value="<?php echo htmlspecialchars($passport_no);?>" required>
          <label for="passport">Passport No</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="pass_expiry_date" type="text" class="datepicker" name="pass_expiry_date" value="<?php echo htmlspecialchars($passport_exp);?>" required>
          <label for="pass_expiry_date">Date Of Expiry</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="fax" type="text" class="validate" name="fax" value="<?php echo htmlspecialchars($fax);?>" required>
          <label for="fax">Fax</label>
        </div>

        <div class="input-field col s12 m4">
          <input id="postal" type="text" class="validate" name="postal" value="<?php echo htmlspecialchars($postal);?>" required>
          <label for="postal">Postal Address</label>
        </div>

        <div class="input-field col s12 m4">
           <button class="btn waves-effect waves-light deep-purple lighten-1" type="submit" name="update">Save Changes
            <i class="material-icons right">check</i>
            </button>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST["update"])){

      $update_id = $id;
      $customer_id = $row_customer["id"];
      $firstname = $_POST["firstname"];
      $middlename = $_POST["middlename"];
      $lastname = $_POST["lastname"];
      $chinesename = $_POST["chinesename"];
      $dob = $_POST["dob"];
      $gender = $_POST["gender"];
      $marital_status = $_POST["marital_status"];
      $country = $_POST["country"];
      $city = $_POST["city"];
      $religion = $_POST["religion"];
      $nationality = $_POST["nationality"];
      $native_language = $_POST["language"];
      $passport_no = $_POST["passport"];
      $passport_exp = $_POST["pass_expiry_date"];
      $fax = $_POST["fax"];
      $postal = $_POST["postal"];

       //Update customer personal information
        $query = "UPDATE personal_info SET 
        firstname = :firstname,
        middlename = :middlename,
        lastname = :lastname,
        chinese_name = :chinesename,
        dob = :dob,
        gender = :gender,
        marital_status = :marital_status,
        country_of_birth = :country,
        city_of_birth = :city,
        religion = :religion,
        nationality = :nationality,
        native_language = :native_language,
        passport_no = :passport_no,
        date_of_expiration = :passport_exp,
        fax = :fax,
        email = :email,
        postal_address = :postal
        WHERE id = :update_id";

         $updateData = array(
         ":firstname" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($firstname)))),
         ":middlename" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($middlename)))),
          ":lastname" => htmlspecialchars(strip_tags(ucfirst(strtolower($lastname)))),
          ":chinesename" => htmlspecialchars(strip_tags(ucfirst(strtolower($chinesename)))),
          ":dob" =>  htmlspecialchars(strip_tags($dob)),
          ":gender" => htmlspecialchars(strip_tags($gender)),
          ":marital_status" => htmlspecialchars(strip_tags($marital_status)),
          ":country" => htmlspecialchars(strip_tags(ucfirst(strtolower($country)))),
          ":city" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($city)))),
          ":religion" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($religion)))),
          ":nationality" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($nationality)))),
          ":native_language" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($native_language)))),
          ":passport_no" =>  htmlspecialchars(strip_tags($passport_no)),
          ":passport_exp" =>  htmlspecialchars(strip_tags($passport_exp)),
          ":fax" =>  htmlspecialchars(strip_tags($fax)),
          ":email" =>  htmlspecialchars(strip_tags($email)),
          ":postal" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($postal)))),
          ":update_id" =>  htmlspecialchars(strip_tags($id))
         );
        $stmt = $conn->prepare($query);
        //Update the DB
        if($stmt->execute($updateData)){
          echo "<script>alert('Your personal information have been updated successfully'); </script>";
          echo "<script>window.open('apply.php?personal_info','_self')</script>";
        }
      }  
    
    ?>
</center>