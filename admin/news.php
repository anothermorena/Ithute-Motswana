<div class="col s12 m3">
            <br>
            <br>
            <br>
            <br>

        </div>
       

   
        <!-- Breaking news form-->
        <div class="col s12 m6 center-align ">
            <form action="" method="post">
                <h5 class="center-align">Breaking News</h5>

                <div class="row">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="title" type="text" name="title" class="validate" required>
                            <label for="title">Title</label>
                        </div>
                        <div class="input-field col s12">
                        <textarea id="feedback" class="materialize-textarea" name="info" required></textarea>
                        <label for="feedback">Textarea</label>
                        </div>
                    </div>
 
                </div>
               
                    <div class="col s12">
                    <button class="btn waves-effect waves-light deep-purple" type="submit" name="break_news">Break the news
                        </button>
                       
                    </div>
                </div>


        </div>

        </form>

        <?php
            if(isset($_POST["break_news"])){
           
            //capture submitted data
            $title = $_POST["title"];
            $info = $_POST["info"];
            $author =  $_SESSION["employee_names"];          
          

            $newsData = array(
            ":title" =>  htmlspecialchars(strip_tags(ucfirst(strtolower($title)))),
            ":info" => htmlspecialchars(strip_tags(ucfirst(strtolower($info)))),
            ":author" => htmlspecialchars(strip_tags(ucfirst($author)))
            );
            //DB insert query
            $query = "INSERT INTO news (title,info,published_by) VALUES (:title,:info,:author)";

            //Sanitize the data
            $stmt = $conn->prepare($query);

            //Save all details to the DB

            if($stmt->execute($newsData)){
                 echo "<script>alert('Your post have been published'); </script>";
                 echo "<script>window.open('dashboard.php?news','_self')</script>";

            }

        }

        
        ?>