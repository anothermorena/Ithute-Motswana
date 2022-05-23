<?php
$email = $_SESSION["customer_session"];

//Get customer's uploaded documents
$query = "SELECT *  FROM documents WHERE email = '$email'";
$stmt = $conn->prepare($query);
$stmt->execute(); 
$row_customer = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $row_customer["id"];
$email = $row_customer["email"];
$photo = $row_customer["photo"];
$passport = $row_customer["passport"];
$degree = $row_customer["degree"];
$transcript = $row_customer["transcript"];
$plan = $row_customer["study_plan"];
$refferences = $row_customer["refferences"];
$tests = $row_customer["tests"];
$art = $row_customer["art"];
$other = $row_customer["other"];
$papers = $row_customer["papers_published"];
$cv = $row_customer["cv"];

?>

<center>
    <h5>Required Supporting Documents</h5>
    <p>For documents which are in more than one document please combine / merge them into a single PDF file</p>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row">
        <!-- Supporting Documents -->
            <div class="row">
                <?php if(!empty($photo)) {?>
                <div class="col s8" >
                        <p> Passport / Visa Style Photo: <a href="uploads/documents/<?php echo htmlspecialchars($photo); ?>" target="_blank"> <?php echo htmlspecialchars($photo);?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red" type="submit" name="delete_photo"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                
                <?php } else {?>
                    <div class="file-field input-field col s12">
                        <div class="btn deep-purple lighten-1">
                            <span>Passport / Visa Style Photo</span>
                            <input type="file" name="photo" id="upload_photo"   value="<?php echo htmlspecialchars($photo);?>">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="photo" id="upload_photo" value="<?php echo htmlspecialchars($photo);?>">
                        </div>
                    </div>
                <?php } if(!empty($degree)) {?>
                <div class="col s8" >
                        <p> Certificates Of Highest Education(Notarized): <a href="uploads/documents/<?php echo htmlspecialchars($degree); ?>" target="_blank"> <?php echo htmlspecialchars($degree);?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red" name="delete_degree"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else {?>
                    <div class="file-field input-field col s12">
                        <div class="btn deep-purple lighten-1">
                            <span>Certificates Of Highest Education(Notarized)</span>
                            <input type="file" name="degree">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="degree" value="<?php echo htmlspecialchars($degree);?>">
                        </div>
                    </div>
                <?php }  if(!empty($transcript)) {?>
                <div class="col s8" >
                        <p> Transcripts Of Highest Education(Notarized): <a href="uploads/documents/<?php echo htmlspecialchars($transcript); ?>" target="_blank"> <?php echo htmlspecialchars($transcript);?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_transcript"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else {?>
                    <div class="file-field input-field col s12 ">
                        <div class="btn deep-purple lighten-1">
                        <span>Transcripts Of Highest Education(Notarized)</span>
                            <input type="file" name="transcript">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="transcript" value="<?php echo htmlspecialchars($transcript);?>">
                        </div>
                    </div>

                <?php } if(!empty($plan)) {?>
                <div class="col s8" >
                        <p> Personal Statement (A brief introduction about you) <a href="uploads/documents/<?php echo htmlspecialchars($plan); ?>" target="_blank"> <?php echo htmlspecialchars($plan);?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_plan"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else {?>      
            </div>
            <div class="row">
                    <div class="file-field input-field col s12">
                        <div class="btn deep-purple lighten-1">
                            <span>Personal Statement</span>
                            <input type="file" name="plan" >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="plan" value="<?php echo $plan;?>">
                        </div>
                    </div>

                <?php }  if(!empty($refferences)) {?>
                <div class="col s8" >
                        <p> Two Recommendation Letters: <a href="uploads/documents/<?php echo $refferences; ?>" target="_blank"> <?php echo $refferences;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_refferences"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else {?>  
                    <div class="file-field input-field col s12">
                        <div class="btn deep-purple lighten-1">
                            <span>Two Recommendation Letters</span>
                            <input type="file" name="refferences" >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="refferences" value="<?php echo $refferences;?>">
                        </div>
                    </div>

                <?php } if(!empty($passport)) {?>
                <div class="col s8" >
                        <p> Passport Home Page (Page 2): <a href="uploads/documents/<?php echo $passport; ?>" target="_blank"> <?php echo $passport;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_passport"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else {?>   
                    <div class="file-field input-field col s12">
                        <div class="btn deep-purple lighten-1">
                            <span>Passport Home Page (Page 2)</span>
                            <input type="file" name="passport" >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="passport" value="<?php echo $passport;?>">
                        </div>
                    </div>
                <?php }  ?>
            </div>
        
            <div class="row">
            <?php  if(!empty($tests)) {?>
                <div class="col s8" >
                        <p> Physical Examination Record for Foreigner: <a href="uploads/documents/<?php echo $tests; ?>" target="_blank"> <?php echo $tests;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_tests"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else { ?> 

                <div class="file-field input-field col s12">
                            <div class="btn deep-purple lighten-1">
                                <span>Physical Examination Record for Foreigner</span>
                                <input type="file" name="tests">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" name="tests" value="<?php echo $tests;?>">
                            </div>
                        </div>

                <?php }
                if(!empty($cv)) {?>
                    <div class="col s8" >
                        <p> Curriculum Vitae (CV): <a href="uploads/documents/<?php echo $cv; ?>" target="_blank"> <?php echo $cv;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_cv"><i class="material-icons">delete</i></button>
                        </p>
                    </div>
                <?php } else { ?> 
    
                <div class="file-field input-field col s12">
                    <div class="btn deep-purple lighten-1">
                        <span>Curriculum Vitae (CV)</span>
                        <input type="file" name="cv" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="cv" value="<?php echo $cv;?>">
                    </div>
                </div>

                <?php } 
                if(!empty($papers)) {?>
                <div class="col s8" >
                        <p> Papers or Articles Published or to be Published: <a href="uploads/documents/<?php echo $papers; ?>" target="_blank"> <?php echo $papers;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_papers"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else { ?> 
                <div class="file-field input-field col s12">
                    <div class="btn deep-purple lighten-1">
                        <span>Papers or Articles Published or to be Published</span>
                        <input type="file" name="papers">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="papers" value="<?php echo $papers;?>">
                    </div>
                </div>
                 <?php } ?>
                </div>
            
               <div class="row">
                <?php  if(!empty($art)) {?>
                <div class="col s8" >
                        <p> Example Of Art(6 color pictures) And Music Work (1 CD): <a href="uploads/documents/<?php echo $art; ?>" target="_blank"> <?php echo $art;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_art"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else { ?> 

                <div class="file-field input-field col s12">
                    <div class="btn deep-purple lighten-1">
                        <span>Example Of Art(6 color pictures) And Music Work (1 CD)</span>
                        <input type="file" name="art" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="art" value="<?php echo $art;?>">
                    </div>
                </div>
                <?php }  if(!empty($other)) {?>
                <div class="col s8" >
                        <p> Other Supporting Documents: <a href="uploads/documents/<?php echo $other; ?>" target="_blank"> <?php echo $other;?> </a>
                        <button class="btn-floating btn-large waves-effect waves-light red"  name="delete_other"><i class="material-icons">delete</i></button>
                        </p>
                </div>
                <?php } else { ?> 

                <div class="file-field input-field col s12">
                    <div class="btn deep-purple lighten-1">
                        <span>Other Supporting Documents</span>
                        <input type="file" name="other" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="other" value="<?php echo $other;?>">
                    </div>
                </div>

                <?php } 
                
                if(empty($photo) || empty($passport) || empty($degree) || empty($transcript) || empty($plan) || empty($refferences) || empty($tests) || empty($art) || empty($other) || empty($papers) || empty($cv)){ ?>
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light deep-purple lighten-1" type="submit" name="update">Save Changes
                    <i class="material-icons right">check</i>
                    </button>
                </div>
                <?php } ?>
            </div>
        <!-- /. Supporting Documents -->  
        </div>
    </form>
    <?php
    if(isset($_POST["update"])){

      $update_id = $id;

      //Get all posted files
      $photo = $_FILES["photo"];
      $passport = $_FILES["passport"];
      $degree = $_FILES["degree"];
      $transcript = $_FILES["transcript"];
      $plan = $_FILES["plan"];
      $refferences = $_FILES["refferences"];
      $tests = $_FILES["tests"];
      $art = $_FILES["art"];
      $papers = $_FILES["papers"];
      $other = $_FILES["other"];
      $cv = $_FILES["cv"];

      //prevent empty form submissions erasing already uploaded files
      if(isset($_FILES["photo"]) && $_FILES["photo"]["name"] != "" ){

         //get file extension
         $photoext = ".".pathinfo($photo["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newphotoname =  uniqid(true);
         $photoname = $newphotoname.$photoext;
      
       
      } else {
          $photoname = $row_customer["photo"];
      }

      if(isset($_FILES["passport"]) && $_FILES["passport"]["name"] != "" ){
         //get file extension
         $passportext = ".".pathinfo($passport["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newpassportname =  uniqid(true);
         $passportname = $newpassportname.$passportext;
      } else {
          $passportname = $row_customer["passport"];
      }
      if(isset($_FILES["degree"]) && $_FILES["degree"]["name"] != "" ){
          //get file extension
         $degreeext = ".".pathinfo($degree["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newdegreename = uniqid(true);
         $degreename = $newdegreename.$degreeext;
   
      } else {
          $degreename = $row_customer["degree"];
      }
      if(isset($_FILES["transcript"]) && $_FILES["transcript"]["name"] != "" ){
       //get file extension
       $transcriptext = ".".pathinfo($transcript["name"], PATHINFO_EXTENSION);
       //give a random name to the file   
       $newtranscriptname =  uniqid(true);
       $transcriptname = $newtranscriptname.$transcriptext;
      } else {
          $transcriptname = $row_customer["transcript"];
      }
      if(isset($_FILES["plan"]) && $_FILES["plan"]["name"] != "" ){
       //get file extension
       $planext = ".".pathinfo($plan["name"], PATHINFO_EXTENSION);
       //give a random name to the file   
       $newplanname =  uniqid(true);
       $planname = $newplanname.$planext;
      } else {
          $planname = $row_customer["study_plan"];
      }
      if(isset($_FILES["refferences"]) && $_FILES["refferences"]["name"] != "" ){

        //get file extension
        $refferencesext = ".".pathinfo($refferences["name"], PATHINFO_EXTENSION);
        //give a random name to the file   
        $newrefferencesname =  uniqid(true);
        $refferencesname = $newrefferencesname.$refferencesext;
    
      } else {
          $refferencesname = $row_customer["refferences"];
      }
      if(isset($_FILES["tests"]) && $_FILES["tests"]["name"] != ""){
          //get file extension
          $testsext = ".".pathinfo($tests["name"], PATHINFO_EXTENSION);
          //give a random name to the file   
          $newtestsname =  uniqid(true);
          $testsname = $newtestsname.$testsext;
      
      } else {
          $testsname = $row_customer["tests"];
      }
      
      if(isset($_FILES["art"]) && $_FILES["art"]["name"] != ""){
         //get file extension
         $artext = ".".pathinfo($art["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newartname =  uniqid(true);
         $artname = $newartname.$artext;
      } else {
          $artname = $row_customer["art"];
      }
      if(isset($_FILES["papers"]) && $_FILES["papers"]["name"] != ""){
         //get file extension
         $papersext = ".".pathinfo($papers["name"], PATHINFO_EXTENSION);
         //give a random name to the file   
         $newpapersname =  uniqid(true);rand();
         $papersname = $newpapersname.$papersext;
      } else {
          $papersname = $row_customer["papers_published"];
      }
      if(isset($_FILES["other"]) && $_FILES["other"]["name"] != ""){
          //get file extension
          $otherext = ".".pathinfo($other["name"], PATHINFO_EXTENSION);
          //give a random name to the file   
          $newothername =  uniqid(true);
          $othername = $newothername.$otherext;
      } else {
          $othername = $row_customer["other"];
      }
      if(isset($_FILES["cv"]) && $_FILES["cv"]["name"] != ""){
          //get file extension
          $cvext = ".".pathinfo($cv["name"], PATHINFO_EXTENSION);
          //give a random name to the file   
          $newcvname =  uniqid(true);
          $cvname = $newcvname.$cvext;
      } else {
          $cvname = $row_customer["cv"];
      }
      
      $temp_name1 = $photo["tmp_name"];
      $temp_name2 = $passport["tmp_name"];
      $temp_name3 = $degree["tmp_name"];
      $temp_name4 = $transcript["tmp_name"];
      $temp_name5 = $plan["tmp_name"];
      $temp_name6 = $refferences["tmp_name"];
      $temp_name7 = $tests["tmp_name"];
      $temp_name8 = $art["tmp_name"];
      $temp_name9 = $papers["tmp_name"];
      $temp_name10 = $other["tmp_name"];
      $temp_name11 = $cv["tmp_name"];

      move_uploaded_file($temp_name1, 'uploads/documents/'.$photoname);
      move_uploaded_file($temp_name2, 'uploads/documents/'.$passportname);
      move_uploaded_file($temp_name3, 'uploads/documents/'.$degreename);
      move_uploaded_file($temp_name4, 'uploads/documents/'.$transcriptname);
      move_uploaded_file($temp_name5, 'uploads/documents/'.$planname);
      move_uploaded_file($temp_name6, 'uploads/documents/'.$refferencesname);
      move_uploaded_file($temp_name7, 'uploads/documents/'.$testsname);
      move_uploaded_file($temp_name8, 'uploads/documents/'.$artname);
      move_uploaded_file($temp_name9, 'uploads/documents/'.$papersname);
      move_uploaded_file($temp_name10, 'uploads/documents/'.$othername);
      move_uploaded_file($temp_name11, 'uploads/documents/'.$cvname);

       //Update applicant documents
        $query = "UPDATE documents SET 
        photo = :photo,
        passport = :passport,
        degree = :degree,
        transcript = :transcript,
        study_plan = :plan,
        refferences = :refferences,
        tests = :tests,
        papers_published = :papers,
        art = :art,
        other = :other,
        cv = :cv
        WHERE id = :update_id";

         $updateData = array(
         ":photo" =>  htmlspecialchars(strip_tags($photoname)),
         ":passport" =>  htmlspecialchars(strip_tags($passportname)),
          ":degree" => htmlspecialchars(strip_tags($degreename)),
          ":transcript" => htmlspecialchars(strip_tags($transcriptname)),
          ":refferences" => htmlspecialchars(strip_tags($refferencesname)),
          ":plan" => htmlspecialchars(strip_tags($planname)),
          ":tests" => htmlspecialchars(strip_tags($testsname)),
          ":papers" => htmlspecialchars(strip_tags($papersname)),
          ":art" => htmlspecialchars(strip_tags($artname)),
          ":other" => htmlspecialchars(strip_tags($othername)),
          ":cv" => htmlspecialchars(strip_tags($cvname)),
          ":update_id" =>  htmlspecialchars(strip_tags($update_id))
         );

        $stmt = $conn->prepare($query);
        if($stmt->execute($updateData)){
          echo "<script>alert('Your information have been updated successfully'); </script>";
          echo "<script>window.open('apply.php?documents','_self')</script>";
        }

    }

    //one by one deletion of uploaded files
    if(isset($_POST["delete_photo"])){

         //Update applicants photo
         $query = "UPDATE documents SET 
         photo = :photo
         WHERE email = :email";
          $updateData = array(
          ":photo" =>  "",
           ":email" =>  htmlspecialchars(strip_tags($email))
          );

         $stmt = $conn->prepare($query);
 
         //Update to the DB
         if($stmt->execute($updateData)){

           // remove file from server
           unlink("uploads/documents/".$photo);
 
           echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
           echo "<script>window.open('apply.php?documents','_self')</script>";
         }


    }
    if(isset($_POST["delete_degree"])){

         //Update applicant degrees
         $query = "UPDATE documents SET 
         degree = :degree
         WHERE email = :email";
 
          $updateData = array(
          ":degree" =>  "",
           ":email" =>  htmlspecialchars(strip_tags($email))
          );

         $stmt = $conn->prepare($query);
         //Update to the DB
         if($stmt->execute($updateData)){
           //remove file from server
           unlink("uploads/documents/".$degree);
           echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
           echo "<script>window.open('apply.php?documents','_self')</script>";
         }
    }

    if(isset($_POST["delete_transcript"])){
         //Update applicant transcript
         $query = "UPDATE documents SET 
         transcript = :transcript
         WHERE email = :email";
 
          $updateData = array(
          ":transcript" =>  "",
           ":email" =>  htmlspecialchars(strip_tags($email))
          );
         $stmt = $conn->prepare($query);
 
         //update the DB
         if($stmt->execute($updateData)){
           // remove file from server
           unlink("uploads/documents/".$transcript);
           echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
           echo "<script>window.open('apply.php?documents','_self')</script>";
         }


    }
    if(isset($_POST["delete_plan"])){

        //Update applicant study plan
        $query = "UPDATE documents SET 
        study_plan = :plan
        WHERE email = :email";

         $updateData = array(
         ":plan" =>  "",
          ":email" =>  htmlspecialchars(strip_tags($email))
         );

        $stmt = $conn->prepare($query);
        //Update to the DB
        if($stmt->execute($updateData)){

          // remove file from server
          unlink("uploads/documents/".$plan);
          echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
          echo "<script>window.open('apply.php?documents','_self')</script>";
        }
   }

   if(isset($_POST["delete_refferences"])){

    //Update applicant refs
    $query = "UPDATE documents SET 
    refferences = :refferences
    WHERE email = :email";

     $updateData = array(
     ":refferences" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );

    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){   
      // remove file from server
      unlink("uploads/documents/".$refferences);
      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
    }
   }

   if(isset($_POST["delete_passport"])){
    //Update applicant passport
    $query = "UPDATE documents SET 
    passport = :passport
    WHERE email = :email";

     $updateData = array(
     ":passport" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );

    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){
      // remove file from server
      unlink("uploads/documents/".$passport);

      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
    }


}
   if(isset($_POST["delete_tests"])){
    //Update applicant medical tests
    $query = "UPDATE documents SET 
    tests = :tests
    WHERE email = :email";

     $updateData = array(
     ":tests" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );

    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){
      // remove file from server
      unlink("uploads/documents/".$tests);

      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
    }
 }

   if(isset($_POST["delete_cv"])){
    //Update applicant cv
    $query = "UPDATE documents SET 
    cv = :cv
    WHERE email = :email";

     $updateData = array(
     ":cv" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );

    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){
      // remove file from server
      unlink("uploads/documents/".$cv);

      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
    }
 }
   if(isset($_POST["delete_papers"])){

    //Update applicant authored papers
    $query = "UPDATE documents SET 
    papers_published = :papers_published
    WHERE email = :email";

     $updateData = array(
     ":papers_published" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );

    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){
      // remove file from server
      unlink("uploads/documents/".$papers);

      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
    }
 }

   if(isset($_POST["delete_art"])){

    //Update applicant artistic documents
    $query = "UPDATE documents SET 
    art = :art
    WHERE email = :email";

     $updateData = array(
     ":art" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );
    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){
      // remove file from server
      unlink("uploads/documents/".$art);

      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
    }

}

   if(isset($_POST["delete_other"])){

    //Update applicant other documents
    $query = "UPDATE documents SET 
    other = :other
    WHERE email = :email";

     $updateData = array(
     ":other" =>  "",
      ":email" =>  htmlspecialchars(strip_tags($email))
     );
    $stmt = $conn->prepare($query);
    //Update to the DB
    if($stmt->execute($updateData)){

      // remove file from server
      unlink("uploads/documents/".$other);

      echo "<script>alert('Your file was deleted, please re-upload it.'); </script>";
      echo "<script>window.open('apply.php?documents','_self')</script>";
     }
 }

?>
</center>