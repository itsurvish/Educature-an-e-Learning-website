<?php

$con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
if(isset($_GET['del_id'])){
    $id =  $_GET['del_id'];
    $course_detail_id=$_GET['course_detail_id'];
    $user_id=$_GET['user_user_id'];
    $con->query("DELETE FROM `video` WHERE video_id='$id';");
    header('Location: TutorialsDetails.php?course_detail_id='.$course_detail_id.'&user_user_id='.$user_id.'');   
}

?>