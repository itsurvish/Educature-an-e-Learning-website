<?php include"header.php"; ?>

    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Contact us</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
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





    <section class="contact text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="item">
                            <div class="item-icon">
                                <i class="icon icon-call-out"></i>
                            </div>
                            <!-- /.item-icon -->
                            <h3 class="item-title">Phone</h3>
                            <!-- /.item-title -->
                            <span tel:2268996424>(+1226)-899-6424</span>
                        </div>
                        <!-- /.item -->
                    </div>
                    <!-- /.col-md-4 -->

                    <div class="col-md-4">
                        <div class="item">
                            <div class="item-icon">
                                <i class="icon icon-location-pin"></i>
                            </div>
                            <!-- /.item-icon -->
                            <h3 class="item-title">Address</h3>
                            <!-- /.item-title -->
                            <span>12 King Street, Toronto 3000, Canada</span>
                        </div>
                        <!-- /.item -->
                    </div>
                    <!-- /.col-md-4 -->

                    <div class="col-md-4">
                        <div class="item">
                            <div class="item-icon">
                                <i class="icon icon-envelope-open"></i>
                            </div>
                            <!-- /.item-icon -->
                            <h3 class="item-title">Email</h3>
                            <!-- /.item-title -->
                            <span> <a href="mailto:info.educature@gmail.com">info.educature@gmail.com</a></span>
                        </div>
                        <!-- /.item -->
                    </div>
                    <!-- /.col-md-4 -->
                </div>
                <!--/.row-->


                <form action="email.php" class="wpcf7-form" method="post">
                    <input type="text" class="form-control" name="name" placeholder="Your Name*" required>
                    <input type="email" class="form-control" name="email" placeholder="Your Email*" required>
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    <textarea name="message" class="form-control" cols="30" rows="7" placeholder="Your Message"></textarea>
                    <input type="submit" class="btn" value="Send Message">
                </form>

                <div id="googleMaps" class="google-map-container"></div>

            </div>
            <!--/.container-->
        </div>
        <!-- /.section-padding -->
    </section>
    <!--/.contact-->



<?php include "footer.php" ?>