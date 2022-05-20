<!DOCTYPE html>
<html>
<!-- Document Head -->
<?php include "includes/header.php";?>

<body>
  <!-- Header -->
   <?php include("includes/navbar.php");?>
  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <ul class="collection with-header ">
            <li class="collection-header purple-text text-darken-1 center"><h4>News and Updates</h4></li>
              <?php
                $getUpdates = "SELECT *  FROM news ORDER BY id DESC";
                // Prepare statement
                $stmt = $conn->prepare($getUpdates);
                //Execute query
                $stmt->execute(); 
                //Return results as an array and loop through them
                while($rowNews = $stmt->fetch(PDO::FETCH_ASSOC)){
                  $id = $rowNews['id'];
                  $title = $rowNews['title'];
                  $text= $rowNews['info'];   
                ?> 
              <li class="collection-item"><a href="#" class="purple-text"><h5><b><?php echo $title;  ?><b></h5> <br><?php echo $text; ?></a> </li>  

                <?php  } ?>
          </ul>    
       </div>
      </div>
    </div>
  </section>

<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Import jQuery, materialize.js and the helper functions-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/util.js"></script>

</body>

</html>