

    <footer class="site-footer">
        <div class="footer-top light-black">
            <div class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="widget widget_about_us">
                                <!--  <h4>Courseware</h4> -->
                                <img class="footer-logo" src="images/Untitled-2.png" alt="Site Logo">
                                <div class="widget-details">
                                    <p>
                                        We are a team of different geeks that believe in producing top-quality courses and category based on best videos.
                                    </p>
                                    <ul>
                                        <li> <i class="fa fa-phone-square"></i><a href="tel:2268996424">(+1) 226-899-6424</a></li>
                                        <li> <i class="fa fa-envelope-square"></i><a href="mailto:info.educature@gmail.com">info.educature@gmail.com</a></li>
                                    </ul>
                                    <div class="widget-social text-center">
                                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                                    </div>
                                    <!-- /.widget-social -->
                                </div>
                                <!-- /.widget-details -->
                            </div>
                            <!-- /.widget -->
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="widget widget_nav_menu">
                                <h4>Quick Links</h4>
                                <div class="widget-details">
                                    <ul class="menu">
                                        <li class="menu-item"><a href="courses.php"><i class="fa fa-angle-double-right"></i> Courses</a></li>
                                        <li class="menu-item"><a href="instructors.php"><i class="fa fa-angle-double-right"></i> Instructor</a></li>
                                        <li class="menu-item"><a href="about.php"><i class="fa fa-angle-double-right"></i> About Us</a></li>
                                        <li class="menu-item"><a href="contact.php"><i class="fa fa-angle-double-right"></i> Contact</a></li>
                            <?php

                            if(isset($_SESSION['user_id'])){
                                echo'
                                 <li class="menu-item">
                                ';
                                if($_SESSION['role_id']==1){
                                    echo' <a href="CreateTutorials.php"><i class="fa fa-angle-double-right"></i>Create a Tutorials</a> ';
                                }
                                else{
                                    echo'  <a href="became-a-instructor.php"><i class="fa fa-angle-double-right"></i>Become a Instructor</a>   ';
                                }
                                echo'  </li>';     
                            }
                            else{
                                echo'
                                <li class="menu-item">
                                <a href="became-a-instructor.php"><i class="fa fa-angle-double-right"></i>Become a Instructor</a> 
                                </li>
                                ';
                               
                            }
                        ?>
                                     

                                    </ul>
                                </div>
                                <!-- /.widget-details -->
                            </div>
                            <!-- /.widget -->
                        </div>


                        <div class="col-lg-5 col-md-6">
                            <div class="widget widget_nav_menu">
                                <h4>Subscribe Weekly Newsletter </h4>
                                <div class="widget-details">
                                    <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-1971 bm8 " method="post" data-id="1971" data-name="Mail Form">
                                        <input class="subscribe-email" type="email" id="subscribe-email" name="EMAIL" placeholder="Enter Email Address Here" required="">
                                        <input class="btn btn-lg mt-2 banner-btn" type="submit" id="subscribe-submit" name="submit" value="Subscribe now">
                                    </form>
                                    <!-- <ul class="menu">
                                        <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> FAQ</a></li>
                                         <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Documentation</a></li>
                                        <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Forums</a></li> 
                                        <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Career</a></li>
                                        <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Community</a></li>
                                        <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Management</a></li> -->
                                    <!--                                    </ul> -->-->
                                </div>
                                <!-- /.widget-details -->
                            </div>
                            <!-- /.widget -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.section-padding -->
        </div>
        <!-- /.footer-top -->

        <div class="footer-bottom black-bg">
            <div class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copy-right text-center">
                                <span> Copyright © 2019 <a href="#" target="_blank" rel="nofollow">Educature</a>, All rights reservsed </span>
                            </div>
                            <!-- /.copy-right -->
                        </div>

                    </div>



                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
        <!--        </div>-->
        <!-- /.footer-bottom -->
    </footer>
    <!-- /.site-footer -->








</body>

</html>
