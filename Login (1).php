<?php
   $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "registration";

   //Database connection

   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);


      $Email = $_POST['Email'];
      $pword=$_POST['pword'];
     
      $result=mysqli_query($conn,"SELECT * FROM register WHERE Email= '$Email' and pword= '$pword'");
      $test=mysqli_fetch_array($result);
      $rows=mysqli_num_rows( $result);
      if($rows>0){
      
         echo 'You have logged in successfully';
         header('Location:./index.html');
         
         
      } 
      else{
        echo 'You have entered invalid username or password';
         exit();
        }
?> 