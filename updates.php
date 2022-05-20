<?php
session_name("clients");
session_start();
session_regenerate_id();


//Database Config
include("config/database.php");
?>
<!DOCTYPE html>
<html>

<!-- Document Head -->
<?php include "includes/header.php";?>

<body>
  <!-- Header -->
   <?php include("includes/navbar.php");?>
  <!-- Section: Signup -->
  <section class="section section-signup">
    <div class="container">
      <div class="row">
        <div class="col s12">
        <ul class="collection with-header ">
        <li class="collection-header purple-text text-darken-1 center"><h4>News and Updates</h4></li>
        <?php
         $get_updates = "SELECT *  FROM news ORDER BY id DESC";
          // Prepare statement
          $stmt = $conn->prepare($get_updates);
          //Execute query
          $stmt->execute(); 

          //Return results as an array and loop through them
          while($row_news = $stmt->fetch(PDO::FETCH_ASSOC)){

          $id = $row_news['id'];
          $title = $row_news['title'];
          $text= $row_news['info'];
               
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

  

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.carousel.carousel-slider').carousel({ fullWidth: true });
      $('.button-collapse').sideNav();
      $('.modal').modal();
      $('select').material_select();
    });
  </script>
</body>

</html>