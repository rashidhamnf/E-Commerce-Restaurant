<?php
    $fname = $_POST['fname'];
    $Uname = $_POST['Uname'];
    $Email = $_POST['Email'];
    $Pnumber = $_POST['Pnumber'];
    $pword = $_POST['pword'];
    $Confirmpw = $_POST['Confirmpw'];
    $gender = $_POST['gender'];

    
if (!empty($fname) || !empty($Uname) || !empty($Email) || !empty($Pnumber) || !empty($pword) || !empty($Confirmpw) || !empty($gender)) 
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "registration";

    //Database connection

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

    if(mysqli_connect_error()){
        die('Connect error: ' . mysqli_connect_errno().') '. mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT Email FROM register WHERE Email = ? Limit 1";
        $INSERT = "INSERT Into register ( fname, Uname, Email, Pnumber, pword, Confirmpw, gender)
         values ( ?, ?, ?, ?, ?, ?, ?)";
    
    //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
    
        if ($rnum==0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssisss", $fname, $Uname, $Email, $Pnumber, $pword, $Confirmpw, $gender);
            $stmt->execute();
            echo "Register sucessfully...";
            header("Location:./Login.html");

            $alert = "<script>alert('Register sucessfully<br>Now Login to your account');</script>";
            echo $alert;
           } else {
            echo "Someone already register using this email";
           }
            $stmt->close();
            $conn->close();

    }
} else {
    echo "All field are required";
    die();
   }   

?>