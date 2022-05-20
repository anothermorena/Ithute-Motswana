<style>
  th, td {
    border: 1px solid purple;
    padding: 10px;
    text-align: left;
  }
</style>
<?php
require("../config/database.php");
//client email
$email = $_GET["client_email"];
//client id
$id = $_GET["id"];

$inv_no = $_GET["inv_no"];

echo "<center><h1>Applicants Full Information </h1></center>";


//display applicants information per table

//proof of payment display
$query = "SELECT *  FROM payments WHERE email = '$email' AND invoice_no = '$inv_no'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
$result = $stmt->fetchAll();

//check if papyment record for application exists
$pay_count = $stmt->rowCount();

echo "
<center>
<h4>Application Payment Information</h4>
</center>
<table>
<thead>
<tr>
    <th>Invoice No</th>
    <th>Amount Paid(P)</th>
    <th>Date & Time Paid</th>
    <th>Proof Of Payment</th>
</tr>
</thead>
";

if($pay_count > 0){
foreach($result as $row){

        $invoice_no = $row["invoice_no"];
        $amount = $row["amount"];
        $pop = $row["pop"];
        $date = $row["date"];
    
echo"
    <tbody>    
        <tr>
            <td>$invoice_no </td>
            <td>$amount</td>
            <td>$date</td>
            <td><a target='_blank' href='../clients/uploads/payments/$pop'>$pop</a></td>
           
        </tr>
    </tbody>
    </table>
";

}
} else {
    $pop = "Not uploaded";
    $amount = "To be paid";
    $date = "N/a";
    $invoice_no = $inv_no;

    echo"
    <tbody>    
        <tr>
            <td>$invoice_no </td>
            <td>$amount</td>
            <td>$date</td>
            <td>$pop</td>
        </tr>
    </tbody>
    </table>
";
}


//personal info table
$query = "SELECT *  FROM personal_info WHERE email = '$email'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
$result = $stmt->fetchAll();

echo "
<center>
<h4>Personal Info</h4>
</center>
<p style='color:red;'>**Get all the other personal infomation from the applicants Passport**</p>
<p style='color:red;'>**Get the Employement and Education history from the CV  and other uploaded documents**</p>
<table>
<thead>
<tr>
    <th>Full Names</th>
    <th>Postal Address</th>
    <th>Fax</th>
    <th>Native Language</th>
    <th>Marital Status</th>
</tr>
</thead>
";

foreach($result as $row){

    $names = $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"];
    $fax = $row["fax"];
    $native_language = $row["native_language"];
    $postal_address = $row["postal_address"];
    $marital_status = $row["marital_status"];
echo"
    <tbody>    
        <tr>
            <td>$names </td>
            <td>$postal_address</td>
            <td>$fax</td>
            <td>$native_language</td>
            <td>$marital_status</td>
        </tr>
    </tbody>
    </table>
";

}



//show current major
$query = "SELECT *  FROM applications WHERE id = '$id'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
$result = $stmt->fetchAll();

echo "
<center>
<h4>Major Applied For Details</h4>
</center>
<table>
<thead>
<tr>
    <th>Discipline</th>
    <th>Major</th>
    <th>Level</th>
    <th>Year</th>
    <th>Email </th>
    <th>Phone </th>
    <th>Invoice No </th>
    <th>Payment Status </th>
</tr>
</thead>
";

foreach($result as $row){

    $disclipline = $row["discipline"];
    $major = $row["major"];
    $level = $row["level"];
    $date = $row["date"];
    $email = $row["email"];
    $phone = $row["phone"];
    $status = $row["payment"];
    $invoice_no = $row["invoice_no"];
echo"
    <tbody>    
        <tr>
            <td>$disclipline </td>
            <td>$major</td>
            <td>$level</td>
            <td>$date</td>
            <td>$email</td>
            <td>$phone</td>
            <td>$invoice_no</td>
            <td>$status</td>
        </tr>
    </tbody>
    </table>
";

}





//language proficiency table
$query = "SELECT *  FROM languages WHERE email = '$email'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
$result = $stmt->fetchAll();

echo "
<center>
<h4>Language Proficiencies</h4>
</center>
<table>
<thead>
<tr>
    <th>Chinese</th>
    <th>HSK Certificate(If uploaded)</th>
    <th>English</th>
    <th>English Certificate(If uploaded)</th>
    <th>Ever Studied or Worked In China?</th>
    <th>Got Chinese Scholarship Before?</th>
</tr>
</thead>
";

foreach($result as $row){
    $hsk = $row["chinese"];
    $eng = $row["english"];
    $hsk_cert = $row["hsk_cert"];
    $eng_cert = $row["eng_cert"];
    $worked_or_studied = $row["work"];
    $scholarship = $row["school"];

    if($hsk_cert == "") {
        $hsk_cert = "Not uploaded";
    } else {
        $hsk_cert = "<a target='_blank' href='../clients/uploads/languages/$hsk_cert'>$hsk_cert</a>";
    }

    if($eng_cert == ""){
        $eng_cert = "Not uploaded";
    } else { 
        $eng_cert = "<a target='_blank' href='../clients/uploads/languages/$eng_cert'>$eng_cert</a>";
    }
echo"
    <tbody>    
        <tr>
            <td>$hsk </td>
            <td>$hsk_cert</td>
            <td>$eng</td>
            <td>$eng_cert</td>
            <td>$worked_or_studied</td>
            <td>$scholarship</td>
        </tr>
    </tbody>
    </table>
";

}

//supporting documents display
$query = "SELECT *  FROM documents WHERE email = '$email'";
$stmt = $conn->prepare($query);
//Execute query
$stmt->execute(); 
$result = $stmt->fetchAll();

echo "
<center>
<h4>All Supporting Documents</h4>
</center>
<table>
<thead>
<tr>
    <th>Photo</th>
    <th>Passport</th>
    <th>Degree</th>
    <th>Transcript</th>
    <th>Personal Statement</th>
    <th>Refferences</th>
    <th>CV</th>
    <th>Tests</th>
    <th>Papers Published</th>
    <th>Art Work</th>
    <th>Others</th>
</tr>
</thead>
";

foreach($result as $row){
    $photo = $row["photo"];
    $passport = $row["passport"];
    $degree = $row["degree"];
    $transcript = $row["transcript"];
    $personal_statement = $row["study_plan"];
    $refs = $row["refferences"];
    $cv = $row["cv"];
    $tests = $row["tests"];
    $papers = $row["papers_published"];
    $art = $row["art"];
    $other = $row["other"];

    if($photo == "") {
        $photo = "Not uploaded";
    } else {
        $photo = "<a target='_blank' href='../clients/uploads/documents/$photo'>$photo</a>";
    }
    if($passport == "") {
        $passport = "Not uploaded";
    } else {
        $passport = "<a target='_blank' href='../clients/uploads/documents/$passport'>$passport</a>";
    }
    if($degree == "") {
        $degree = "Not uploaded";
    } else {
        $degree = "<a target='_blank' href='../clients/uploads/documents/$degree'>$degree</a>";
    }
    if($transcript == "") {
        $transcript = "Not uploaded";
    } else {
        $transcript = "<a target='_blank' href='../clients/uploads/documents/$transcript'>$transcript</a>";
    }
    if($personal_statement == "") {
        $personal_statement = "Not uploaded";
    } else {
        $personal_statement = "<a target='_blank' href='../clients/uploads/documents/$personal_statement'>$personal_statement</a>";
    }
    if($refs == "") {
        $refs = "Not uploaded";
    } else {
        $refs = "<a target='_blank' href='../clients/uploads/documents/$refs'>$refs</a>";
    }
    if($cv == "") {
        $cv = "Not uploaded";
    } else {
        $cv = "<a target='_blank' href='../clients/uploads/documents/$cv'>$cv</a>";
    }
    if($tests == "") {
        $tests = "Not uploaded";
    } else {
        $tests = "<a target='_blank' href='../clients/uploads/documents/$tests'>$tests</a>";
    }
    if($papers == "") {
        $papers = "Not uploaded";
    } else {
        $papers = "<a target='_blank' href='../clients/uploads/documents/$papers'>$papers</a>";
    }
    if($art == "") {
        $art = "Not uploaded";
    } else {
        $art = "<a target='_blank' href='../clients/uploads/documents/$art'>$art</a>";
    }
    if($other == "") {
        $other = "Not uploaded";
    } else {
        $other = "<a target='_blank' href='../clients/uploads/documents/$other'>$other</a>";
    }

   
echo"
    <tbody>    
        <tr>
            <td>$photo </td>
            <td>$passport</td>
            <td>$degree</td>
            <td>$transcript</td>
            <td>$personal_statement</td>
            <td>$refs</td>
            <td>$cv</td>
            <td>$tests</td>
            <td>$papers</td>
            <td>$art</td>
            <td>$other</td>
        </tr>
    </tbody>
    </table>
";

}


