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


    <section class="instructors text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">

                        <?php 

                        $con = mysqli_connect("localhost","root","","my_educature");
                        if (mysqli_connect_errno()){
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            die();
                        }

                            $sql = $con->query("SELECT `users`.`role_role_id`, `userdetails`.*, `userdesignation_has_user`.*, `userdesignation`.*
                            FROM `users` 
                                LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation_has_user` ON `userdesignation_has_user`.`user_user_id` = `users`.`user_id` 
                                LEFT JOIN `userdesignation` ON `userdesignation_has_user`.`UserDesignation_designation` = `userdesignation`.`designation_id` WHERE users.role_role_id='1' ;");
                           
                            foreach ($sql as $value) {
                                echo' <div class="col-md-3 col-sm-6">
                                <div class="instructor">
                                    <div class="avatar radius">';
                                echo '  <a href="instructor-details.php?user_detail_id='.$value['user_detail_id'].'"><img src="images/'.$value['image'].'" alt="Avatar Image"></a>';
                                echo '</div>';
                                echo'<div class="instructor-details">';
                                echo '<h3 class="name"><a href="instructor-details.php?user_detail_id='.$value['user_detail_id'].'">'.$value['first_name'].' '. $value['last_name'].'</a></h3>';
                                echo' <span class="designation">'.$value['designation_title'].'</span>';
                                echo'</div></div></div>';
                            }                       

                        ?>
                </div>
                <!-- /.row -->

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
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.instructors -->


    <?php include "footer.php" ?>