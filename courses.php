
<?php include "header.php" ?>

    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <form action="#" class="course-search-form">
                        <input type="text" name="search" id="search" class="search" placeholder="Find a course or tutorial ">
                        <input type="submit" name="submit" id="search-submit" class="sreach-submit">
                    </form>
                    <!-- /.course-search-form -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.section-padding -->
        </div>
        <!-- /.overlay -->
    </section>
    <!-- /.page-name -->


    <section class="faq courses">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content">

                     
                            <div class="tab-pane fade show active" id="content-1" role="tabpanel" aria-labelledby="nav-1">
                                <div class="filters">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="float-left">Sort by:</span>

                                            <select class="filter-select" name="text">

                                                <option value="" selected>Top paid</option>
                                                <option value="free">Top free</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="layout-switcher">
                                                <span class="grid"><i class="fa fa-th"></i></span>
                                                <span class="list"><i class="fa fa-list"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <div style="clear:both;"></div>
                            <div class="message_box" style="margin:10px 0px;">
                            <?php echo $status; ?>
                            </div>
                                <div class="course-items">
                                    <div class="row">
                                    <?php 
                                            
                                            $con = mysqli_connect("localhost","root","","my_educature");
                                            if (mysqli_connect_errno()){
                                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                                die();
                                            }
                
                                            $sql = $con->query("SELECT `courses`.*, `coursedetail`.*, `userdetails`.*
                                            FROM `courses` 
                                                LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id`,`userdetails` WHERE userdetails.user_user_id = courses.user_user_id ORDER BY courses.course_id ASC");
                                            foreach($sql as $value){
                                                echo' 
                                                <div class="col-lg-4 col-md-6">
                                                  <form method="post" action="">
                                                    <div class="item">
                                                        <div class="item-thumb">
                                                            <a href="course-details.php?course_detail_id='.$value['course_detail_id'].'&user_user_id='.$value['user_user_id'].'"><img src="images/'.$value['course_image'].'" alt="Item Thumbnail" style="width: 100%;"></a>
                                                        </div>
                                                        <div class="item-details">
                                                            <h3 class="item-title"><a href="course-details.php?course_detail_id='.$value['course_detail_id'].'&user_user_id='.$value['user_user_id'].'">'.$value['course_name'].'</a></h3>
                                                        
                                                            <span class="instructor"><a href="instructor-details.php?user_detail_id='.$value['user_detail_id'].'">'.$value['first_name'].' '. $value['last_name'].'
                                                            </a></span>
                                                        
                                                            <div class="details-bottom">
                                                                <div class="rating float-left">
                                                                    <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="'.$value['course_rating'].'" data-fractions="5" />
                                                                </div>
                                                                <div class="rating float-right">
                                                                   <div class="course-price "><span class="currency">$</span><span class="price">'.$value['course_price'].'</span></div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="course_code" value="'.$value['course_code'].'" />
                                                            <div class="text-center">
                                                                <div class="course-price ">
                                                               
                                                                <button type="submit" class="btn btn-lg enroll-btn">Add to cart</button>
                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      </form>
                                                </div> 
                                                ';
                                            }
                                    ?>
                                                                      
                                    </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
<!-- 
                    <div class="col-md-4">
                        <aside class="sidebar">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                            <?php 
                                
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                            }

                            $sql = $con->query("SELECT * FROM `coursecategory`");
                            foreach($sql as $value){
                                echo'  <a class="nav-item nav-link" id="'.$value['category_id'].'" data-toggle="tab" href="#'.$value['category_id'].'" role="tab" aria-controls="'.$value['category_id'].'" aria-selected="true">'.$value['category_name'].'</a>';
                            }
                             ?>
                                </div>
                        </aside>
                     
                    </div> -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.faq -->


 <?php include "footer.php" ?>   