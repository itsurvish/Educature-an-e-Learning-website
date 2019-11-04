<?php include "header.php" ?>

<section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
    <div class="overlay">
        <div class="section-padding">
            <div class="container">
                <h2 class="section-title">All Course</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
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
<section class="courses">
    <div class="section-padding">
        <div class="container">
            <div class="row">

<?php 
 $con = mysqli_connect("localhost","root","","my_educature");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
 }
 $course_detail_id=$_GET['course_detail_id'];

 $user_user_id=$_GET['user_user_id'];
 
 
$sql = $con->query("SELECT `courses`.*, `coursedetail`.*, `coursecategory`.*, `userdesignation`.*, `users`.*, `userdetails`.* 
FROM `coursecategory` 
LEFT JOIN `courses` ON `courses`.`coursecategory_category_id` = `coursecategory`.`category_id` 
LEFT JOIN `users` ON `courses`.`user_user_id` = `users`.`user_id` 
LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id` 
LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id` 
LEFT JOIN `userdesignation_has_user` ON `userdesignation_has_user`.`user_user_id` = `users`.`user_id` 
LEFT JOIN `userdesignation` ON `userdesignation_has_user`.`UserDesignation_designation` = `userdesignation`.`designation_id` 
WHERE coursedetail.course_detail_id='$course_detail_id' and users.user_id='$user_user_id';");

        
foreach ($sql as $value) {

    echo'

                <div class="col-md-8">
                    <h2 class="course-title">'.$value['course_name'].'</h2>
                    <!-- /.course-title -->
                    <div class="course-meta">
                        <span class="meta-details">
                            <img class="rounded-circle float-left" src="images/'.$value['image'].'" alt="Avatar">

                            <span class="meta-id">Instructor</span>
                            <a class="name" href="#">'.$value['first_name'].' '.$value['last_name'].'</a>
                        </span>
                        <span class="meta-details">
                            <span class="meta-id">Category</span>
                            <span>'.$value['category_name'].'</span>
                        </span>
                        <span class="meta-details">
                            <span class="meta-id">Reviews</span>
                            <span class="rating">
                                <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="'.$value['course_rating'].'" data-fractions="5" />
                               
                            </span>
                            <!-- /.rating -->
                        </span>
                    </div>
                    <img class="radius" src="images/'.$value['course_image'].'" alt="Course Image" width="600" heigth="100">

                    <div class="course-single-details">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-1" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                            <!-- <a class="nav-item nav-link" id="nav-2" data-toggle="tab" href="#curriculum" role="tab" aria-controls="curriculum" aria-selected="false">Curriculum</a> -->
                            <a class="nav-item nav-link" id="nav-3" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">Instructor</a>
                            <a class="nav-item nav-link" id="nav-4" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description">
                                <h4 class="title">Course description</h4>
                                <p>
                                '.$value['course_description'].'
                                </p>

                            </div>
                            
                          
                            <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor">
                                <div class="author-bio">
                                    <h3 class="title">About the Instructor</h3>
                                    <div class="author-contents media">
                                        
                                        <!-- /.author-avatar -->
                                        <div class="author-details media-body">
                                            <h3 class="name"> '.$value['first_name'].'  '.$value['last_name'].'</h3>
                                            <span> '.$value['designation_title'].' </span>
                                            <p>
                                            '.$value['designation_description'].'
                                            </p>
                                            <a href="instructor-details.php?user_detail_id='.$value['user_detail_id'].'" class="load-more">Learn more <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews">
                                <h3 class="title">Student Reviews</h3>

                                <div class="course-reviews">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="average-rating text-center">
                                                <div class="rating">
                                                    <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="4.5" data-fractions="5" />
                                                </div>
                                                <!-- /.rating -->
                                                <span>Average Rating</span>
                                            </div>
                                            <!-- /.average-rating -->
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 54%" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="rating-icons">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="rating-value">54%</span>
                                                <!-- /.rating-value -->
                                            </div>
                                            <!-- /.rating-icons -->

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="rating-icons">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star-o"></i>
                                                <span class="rating-value">30%</span>
                                                <!-- /.rating-value -->
                                            </div>
                                            <!-- /.rating-icons -->

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="rating-icons">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star-o"></i>
                                                <i class="far fa-star-o"></i>
                                                <span class="rating-value">12%</span>
                                                <!-- /.rating-value -->
                                            </div>
                                            <!-- /.rating-icons -->

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 3%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="rating-icons">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star-o"></i>
                                                <i class="far fa-star-o"></i>
                                                <i class="far fa-star-o"></i>
                                                <span class="rating-value">3%</span>
                                                <!-- /.rating-value -->
                                            </div>
                                            <!-- /.rating-icons -->

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="rating-icons">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star-o"></i>
                                                <i class="far fa-star-o"></i>
                                                <i class="far fa-star-o"></i>
                                                <i class="far fa-star-o"></i>
                                                <span class="rating-value">1%</span>
                                                <!-- /.rating-value -->
                                            </div>
                                            <!-- /.rating-icons -->
                                        </div>
                                    </div>

                                </div>

                                <!-- /.btn-container -->
                            </div>
                        </div>
                    </div>
                    <!-- /.course-single-details -->
                 
                </div>
    
    ';

}

?>
 <div class="col-md-4">
                    <aside class="sidebar">
                      
<?php
$con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
$course_detail_id=$_GET['course_detail_id'];

$user_user_id=$_GET['user_user_id'];
                       
                        
                        
                        $lookupID = "SELECT `coursedetail`.`course_course_id`
FROM `coursedetail`
where course_detail_id='$course_detail_id'";
  $result = mysqli_query($con, $lookupID);
  $row = mysqli_fetch_row($result);
  $id = $row[0];
 
                        
     echo '<a href="cart.php?course_id='.$id.'"> <button class="btn btn-lg enroll-btn">Add to cart</button></a>';
                        
?>                          
                       

<?php
$con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
$course_detail_id=$_GET['course_detail_id'];

$user_user_id=$_GET['user_user_id'];


$sql = $con->query("SELECT `video`.*, `coursedetail`.*, `users`.*, `userdetails`.*
FROM `coursedetail`
    LEFT JOIN `video` ON `video`.`coursedetail_course_detail_id` = `coursedetail`.`course_detail_id`
    LEFT JOIN `courses` ON `coursedetail`.`course_course_id` = `courses`.`course_id`
    LEFT JOIN `users` ON `courses`.`user_user_id` = `users`.`user_id`
    LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id`
    WHERE coursedetail.course_detail_id='$course_detail_id' and users.user_id='$user_user_id';");
       
foreach ($sql as $value) {

    if(empty($value['video_link'])){
        echo'
        <div class="info">
        <ul class="info-list">

            <li>
                NO video Available
            </li>
        </ul>
    </div>       
        ';
    }
    else{
        echo'
   
        <div class="info">
            <ul class="info-list">

                <li>
                    <div class="course-img">
                        <a type="button" href="" class="video-btn" data-backdrop="static" data-keyboard="false" data-controls-modal="modal" data-toggle="modal" data-src="video/'.$value['video_link'].'" data-target="#myModal">
                            <img src="images/single.jpg" width="120px" height="120px" />
                            <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                        </a>
                    </div>
                    <div class="course-video-details">
                        <span class="course-name">'.$value['video_name'].'</span>
                        <span class="course-owner">'.$value['first_name'].' '.$value['last_name'].'</span>
                        <span class="course-duration">'.$value['video_duration'].'</span>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
';
    }   
}

?>

</aside>
                    <!-- /.sidebar -->
                </div>
</div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section-padding -->
</section>
<!-- /.courses -->

<?php include "footer.php" ?>
