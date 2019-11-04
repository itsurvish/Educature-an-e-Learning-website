<?php include "header.php" ?>
<?php

require("../Educature/authanticate.php");

?>
    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">My Courses</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Courses</li>
                        </ol>
                    </nav>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.section-padding -->
        </div>
        <!-- /.overlay -->
    </section>
    <!-- /.page-name -->

    <section class="instructor-taught gray-bg">
        <div class="section-padding">
            <div class="container">

                <!-- /.top-content -->

                <div class="course-items">
                    <div class="row">
                        
                        <?php 
  $con = mysqli_connect("localhost","root","","my_educature");
  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      die();
  }
  $user_id=$_SESSION['user_id'];
 
  
  $lookupID = "SELECT user_detail_id
FROM `users`
    LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id`
where user_id='$user_id'";
  $result = mysqli_query($con, $lookupID);
  $row = mysqli_fetch_row($result);
  $id = $row[0];
 
 
  $sql = $con->query("SELECT `courses`.*, `coursedetail`.*, `userdetails`.* FROM `courses` LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id` , `userdetails` WHERE courses.user_user_id='$user_id' and userdetails.user_detail_id='$id' ");
  if (is_array($sql) || is_object($sql))
{
    foreach ($sql as $value) {
        echo'
                   <div class="col-lg-3 col-md-6">
        <div class="item">
            <div class="item-thumb">
                <a href="TutorialsDetails.php?course_detail_id='.$value['course_detail_id'].'&user_user_id='.$value['user_user_id'].'"><img src="../Educature/images/'.$value['course_image'].'" alt="Item Thumbnail" style="width: 100%;"></a>
            </div>
            <!-- /.item-thumb -->
            <div class="item-details">
                <h3 class="item-title"><a href="course-details.php">'.$value['course_name'].'</a></h3>
                <!-- /.item-title -->
                <span class="instructor"><a href="instructor-details.php">'.$value['first_name'].' '. $value['last_name'].'</a></span>
                <!-- /.instructor -->
                <div class="details-bottom">
                    <div class="course-price float-left"><span class="currency">$</span><span class="price">'.$value['course_price'].'</span></div>
                    <!-- /.course-price -->
                    <div class="rating float-right">
                        <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="4.5" data-fractions="2" />
                    </div>
                    <!-- /.rating -->
                </div>
                <!-- /.details-bottom -->
            </div>
            <!-- /.item-details -->
        </div>
        <!-- /.item -->
    </div>
';

  }

}
 
?>

                       

                   
                    </div>
                    <!-- /.row -->

<!--
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
-->
                </div>
                <!-- /.course-items -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.instructor-taught -->

    <?php include "footer.php" ?>