<center>
    <h5>My Applications</h5>
    <p>Your applications in one place</p>
   
     <form action="#">
            <table class="highlight centered responsive-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Level</th>
                    <th>Discipline</th>
                    <th>Major</th>
                    <th>Year</th>
                    <th>Invoice No</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Confirm</th>
                    <th>Delete</th>
                   
                </tr>
                </thead>

                <tbody>
                <?php
                $email = $_SESSION["customer_session"];
                
                //Get all current user applications
                $query = "SELECT *  FROM applications WHERE email = '$email'";
                $stmt = $conn->prepare($query);
                //Execute query
                $stmt->execute(); 
                $result = $stmt->fetchAll();
                $i =0;
                foreach($result as $row){
                
                    $i++;

                    if($row["payment"] == "Pending"){

                        $payment_status = "Unpaid";
                    } else {
                        $payment_status = "Paid";
                    }
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["level"]; ?></td>
                    <td><?php echo $row["discipline"]; ?></td>
                    <td><?php echo $row["major"]; ?></td>
                    <td><?php echo substr($row["date"],0,11); ?></td>
                    <td><?php echo $row["invoice_no"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><?php echo $payment_status;  ?></td>
                    
                 <?php if($payment_status == "Paid"){?>
                 <td> Payment Confirmed </td> 
                 <td><a href="delete_application.php?application_id=<?php echo $row["id"];?>" target="_blank" class="btn btn-small red lighten-1 " disabled>Delete</a></td>
                 
                 <?php } else {?>
                   <td><a href="confirm.php?application_id=<?php echo $row["id"];?>&inv_no=<?php echo $row["invoice_no"] ?>" target="_blank" class="btn btn-small deep-purple lighten-1 ">Pay</a></td>
                   <td><a href="delete_application.php?application_id=<?php echo $row["id"];?>" target="_blank" class="btn btn-small red lighten-1 ">Delete</a></td>

                 <?php }?>
                   
                </tr>
                <?php } ?>
        
                </tbody>
            </table>
             </form>

</center>