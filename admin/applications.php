
     <form action="#">
            <table id="applications_table" class="display responsive-table">
                <thead>
                <tr>
                    <th>Discipline</th>
                    <th>Major</th>
                    <th>Level</th>
                    <th>Year</th>
                    <th>Email </th>
                    <th>Phone </th>
                    <th>Payment</th>
                    <th>Contacted</th>
                    <th>Contact</th>
                    <th>Contacted By</th>
                    <th>Feedback</th>
                    <th>Status</th>
                    <th>Update Status</th>
                    <th>Full Details</th>
                   
                </tr>
                </thead>

                <tbody>
                <?php
                //Get all applications
                $query = "SELECT *  FROM applications ";
                $stmt = $conn->prepare($query);
                //Execute query
                $stmt->execute(); 
                $result = $stmt->fetchAll();
                $i =0;
                foreach($result as $row){
                
                    $i++;

                    if($row["contacted"] == ""){

                        $contacted = "Not Contacted";
                    } else {
                        $contacted = "Contacted";
                    }
                ?>
                <tr>
                    <td><?php echo $row["discipline"]; ?></td>
                    <td><?php echo $row["major"]; ?></td>
                    <td><?php echo $row["level"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["phone"]; ?></td>
                    <td><?php echo $row["payment"];  ?></td>
                    <td><?php echo $contacted;  ?></td>
                    <?php
                    if($contacted == "Contacted"){?>
                    <td><a href="contact_applications.php?application_id=<?php echo $row["id"];?>" target="_blank" class="btn btn-small deep-purple lighten-1 " disabled>Contact</a></td>  
                    <td><?php echo $row["contacted_by"]; ?></td>                 
                    
                    <?php } else {?>
                    <td><a href="contact_applications.php?application_id=<?php echo $row["id"];?>&email=<?php echo $row["email"]; ?>" target="_blank" class="btn btn-small deep-purple lighten-1 ">Contact</a></td>
                    <td><center>--</center></td>
                   
                   
                    <?php }?>

                    <?php if($row["feedback"] !=""){?>
                        <td><?php echo $row["feedback"]; ?></td>
                       

                    <?php } else  if($row["feedback"] == "" && $contacted == "Not Contacted") {?>
                        <td><a href="feedback_applications.php?application_id=<?php echo $row["id"];?>" target="_blank" class="btn btn-small deep-purple lighten-1" disabled>Feedback</a></td>
                    
                 

                    <?php } else if($row["feedback"] == "" && $contacted == "Contacted") {?>
                        <td><a href="feedback_applications.php?application_id=<?php echo $row["id"];?>" target="_blank" class="btn btn-small deep-purple lighten-1 ">Feedback</a></td> 

                    <?php } ?> 
                    <td><?php echo $row["status"];  ?></td>
                    <td><a href="status.php?application_id=<?php echo $row["id"];?>" target="_blank" class="btn btn-small deep-purple lighten-1">Change</a></td>
                    <td><a href="full_details.php?id=<?php echo $row["id"]; ?>&client_email=<?php echo $row["email"];?>&inv_no=<?php echo $row["invoice_no"]; ?>" target="_blank" class="btn btn-small deep-purple lighten-1" >View</a></td>
               
                   
                </tr>
                <?php } ?>
        
                </tbody>
            </table>
             </form>