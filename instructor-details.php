<?php include "header.php" ?>
<?php
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                            }
                            $user_detail_id=$_GET['user_detail_id'];
                            $sql = $con->query("SELECT `users`.`role_role_id`, `userdetails`.*, `userdesignation_has_user`.*, `userdesignation`.*
                            FROM `users` 
                                LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation_has_user` ON `userdesignation_has_user`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation` ON `userdesignation_has_user`.`UserDesignation_designation` = `userdesignation`.`designation_id`  WHERE userdetails.user_detail_id='$user_detail_id' ;");
                         foreach ($sql as $value) {

                            echo'
                            <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
                            <div class="overlay">
                                <div class="section-padding">
                                    <div class="container">
                    
                                        <h2 class="section-title">'.$value['first_name'].' '. $value['last_name'].'</h2>
                                        <span class="designation">'.$value['designation_title'].'</span>
                                    </div>
                                 
                                </div>
                             
                            </div>
                      
                        </section>
                            ';
                         }



?>
  
  


    <section class="instructor-details">
        <div class="section-padding">
            <div class="container">
                <div class="row">

                    <?php
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                            }
                            $user_detail_id=$_GET['user_detail_id'];
                            $sql = $con->query("SELECT `users`.`role_role_id`, `userdetails`.*, `userdesignation_has_user`.*, `userdesignation`.*
                            FROM `users` 
                                LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation_has_user` ON `userdesignation_has_user`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation` ON `userdesignation_has_user`.`UserDesignation_designation` = `userdesignation`.`designation_id`  WHERE userdetails.user_detail_id='$user_detail_id' ;");
                            
                            foreach ($sql as $value) {
                                
                                echo' <div class="col-md-4 pr-5">
                                    <div class="avatar text-center">';
                                echo '<img src="images/'.$value['image'].'" alt="Avatar Image"></a>';
                                echo '</div>';
                                echo'  <div class="social text-center">';
                                echo'  <a href="'.$value['facebook_link'].' target="_blank"><i class="fab fa-facebook-f"></i></a>';
                                echo'  <a href="'.$value['github_link'].'" target="_blank"><i class="fab fa-github"></i></a>';
                                echo'  <a href="'.$value['linkedin_link'].'" target="_blank"><i class="fab fa-linkedin"></i></a>';
                               
                                echo'</div></div>';
                                echo'<div class="col-md-8 pl-4">
                                <div class="course-single-details">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-3" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>                               
                                        <a class="nav-item nav-link" id="nav-4" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                                    </div>
        
                                    <div class="tab-content" id="nav-tabContent">
        
                                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description">
                                            <div class="author-bio">
                                                <h3 class="title">About the Instructor</h3>
                                                <div class="author-contents media">                                         
                                                    <div class="author-details media-body">';
                                                    echo'<h3 class="name">'.$value['first_name'].' '. $value['last_name'].'</h3>
                                                    <span>'.$value['designation_title'].'</span>
                                                    <p>'.$value['designation_description'].'</p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div> ';
                                    echo'
                                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews">
                                        <h3 class="title">Student Reviews</h3>
    
                                        <div class="course-reviews">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="average-rating text-center">
                                                        <div class="rating">
                                                            <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="4.5" data-fractions="5" />
                                                        </div>
                                                    
                                                        <span>Average Rating</span>
                                                    </div>
                                                 
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
                                                     
                                                    </div>
                                                  
    
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
                                                     
                                                    </div>
                                                 
    
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
                                                     
                                                    </div>
                                                   
    
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
                                                       
                                                    </div>
                                                   
    
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
                                                       
                                                    </div>
                                                  
                                                </div>
                                            </div>    
                                        </div>    
                                    </div>';  
                            }
                    ?>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.instructor-details -->
    <?php
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                            }
                            $user_detail_id=$_GET['user_detail_id'];
                            $sql = $con->query("SELECT `users`.`role_role_id`, `userdetails`.*, `userdesignation_has_user`.*, `userdesignation`.*
                            FROM `users` 
                                LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation_has_user` ON `userdesignation_has_user`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation` ON `userdesignation_has_user`.`UserDesignation_designation` = `userdesignation`.`designation_id`  WHERE userdetails.user_detail_id='$user_detail_id' ;");
                         foreach ($sql as $value) {

                            echo'

                            <section class="instructor-taught gray-bg">
                            <div class="section-padding">
                                <div class="container">
                                    <div class="top-content text-center">
                                        <h2 class="section-title">Courses Taught by '.$value['first_name'].' '. $value['last_name'].'</h2>
                                    </div>
                                  
                                    <div class="course-items">
                                        <div class="row">



                           
                            ';
                         }



?>


<?php 
  $con = mysqli_connect("localhost","root","","my_educature");
  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      die();
  }
  $user_detail_id=$_GET['user_detail_id'];
 
  
  $lookupID = "SELECT `userdetails`.`user_user_id` FROM `userdetails` WHERE user_detail_id='$user_detail_id'";
  $result = mysqli_query($con, $lookupID);
  $row = mysqli_fetch_row($result);
  $id = $row[0];
 
 
  $sql = $con->query("SELECT `courses`.*, `coursedetail`.*, `userdetails`.* FROM `courses` LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id` , `userdetails` WHERE courses.user_user_id='$id' and userdetails.user_detail_id='$user_detail_id' ");
  if (is_array($sql) || is_object($sql))
{
    foreach ($sql as $value) {
        echo'
        <div class="col-lg-3 col-md-6">
        <div class="item">
            <div class="item-thumb">
                <a href="course-details.php?course_detail_id='.$value['course_detail_id'].'&user_user_id='.$value['user_user_id'].'"><img src="images/'.$value['course_image'].'" alt="Item Thumbnail" style="width: 100%;"></a>
            </div>
            <!-- /.item-thumb -->
            <div class="item-details">
                <h3 class="item-title"><a href="course-details.php?course_detail_id='.$value['course_detail_id'].'&user_user_id='.$value['user_user_id'].'">'.$value['course_name'].'</a></h3>
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

              </div>
           
          </div>
       
      </div>
   
  </section>
   
<!-- <nav aria-label="Page navigation example">
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
                    </nav> -->



    <?php include "footer.php" ?>