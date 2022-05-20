
     <form action="#">
            <table id="clients_table" class="display responsive-table">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Phone </th>
                    <th>Applied</th>
                    <th>Contacted</th>
                    <th>Contact</th>
                    <th>Contacted By</th>
                    <th>Feedback</th>
                   
                </tr>
                </thead>

                <tbody>
                <?php
                //Get all users
                $query = "SELECT *  FROM customers ";
                $stmt = $conn->prepare($query);
                //Execute query
                $stmt->execute(); 
                $result = $stmt->fetchAll();
                $i =0;
                foreach($result as $row){
                
                    $i++;

                    if($row["applied"] == ""){

                        $applied = "Didnt Apply";
                    } else {
                        $applied = "Applied";
                    }
                    if($row["contacted"] == ""){

                        $contacted = "Not Contacted";
                    } else {
                        $contacted = "Contacted";
                    }
                ?>
                <tr>
                    <td><?php echo $row["primary_email"]; ?></td>
                    <td><?php echo $row["phone"]; ?></td>
                    <td><?php echo $applied;  ?></td>
                    <td><?php echo $contacted;  ?></td>
                    <?php
                    if($contacted == "Contacted"){?>
                    <td><a href="contact.php?client_email=<?php echo $row["primary_email"];?>" target="_blank" class="btn btn-small deep-purple lighten-1 " disabled>Contact</a></td>  
                    <td><?php echo $row["contacted_by"]; ?></td>                 
                    
                    <?php } else {?>
                    <td><a href="contact.php?client_email=<?php echo $row["primary_email"];?>" target="_blank" class="btn btn-small deep-purple lighten-1 ">Contact</a></td>
                    <td><center>--</center></td>
                   
                   
                    <?php }?>

                    <?php if($row["feedback"] !=""){?>
                        <td><?php echo $row["feedback"]; ?></td>
                       

                    <?php } else  if($row["feedback"] == "" && $contacted == "Not Contacted") {?>
                        <td><a href="feedback.php?client_email=<?php echo $row["primary_email"];?>" target="_blank" class="btn btn-small deep-purple lighten-1" disabled>Feedback</a></td>
                    
                 

                    <?php } else if($row["feedback"] == "" && $contacted == "Contacted") {?>
                        <td><a href="feedback.php?client_email=<?php echo $row["primary_email"];?>" target="_blank" class="btn btn-small deep-purple lighten-1 ">Feedback</a></td> 

                    <?php } ?> 
                   
                </tr>
                <?php } ?>
        
                </tbody>
            </table>
             </form>