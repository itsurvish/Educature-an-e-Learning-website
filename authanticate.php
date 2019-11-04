<?php 

$con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

if(!isset($_SESSION['user_id'])){

    echo 'Your password has been reset succesfully!';
    echo" <script type='text/javascript'>
    window.location.href = 'http://localhost:8080/educature/notloggedin.php';
    </script>";  
   }


?>

