

<?php include "header.php" ?>


    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Log In</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
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





    <section class="login-register">
        <div class="section-padding">
            <div class="container">
                <div class="contents text-center">

                    <h2 class="section-title">Log in to your account</h2>
                    
                    <?php
                        if ($msglogin != "") echo "
                    <div class='alert alert-danger'>
                        <strong>$msglogin</strong>
                    </div>";
                    ?>
                    <form class="sign-in-form" id="sign-in-form" action="login.php" method="post">
                        <p class="form-input">
                            <input type="text" name="email" id="user_login" class="input" value="" placeholder="Username / Email" required="">
                        </p>

                        <p class="form-input">
                            <input type="password" name="password" id="user_pass" class="input" value="" placeholder="Password" required="">
                        </p>

                        <p class="checkbox">
                            <input name="rememberme" type="checkbox" class="rememberme float-left" value="Remember Me"> Remember Me
                            <a href="forgetpassword.php" class="float-right" title="Recover Your Lost Password">Forgot password?</a>
                        </p>

                        <p class="form-input">
                            <input type="submit" name="submit" id="submit" class="btn" value="Sign In">
                        </p>

                    </form>
                    <!-- 
                    <div class="login-social">
                        <h2 class="section-title">Or login using</h2>
                        <button class="btn facebook"><i class="fab fa-facebook"></i> Facebook</button>
                        <button class="btn twitter"><i class="fab fa-twitter"></i> Twitter</button>
                        <button class="btn google"><i class="fab fa-google-plus"></i> Google</button>
                    </div> -->
                    <!-- /.login-social -->

                    <p class="register">
                        Don’t have an account? <a href="register.php">Register now</a>
                    </p>
                </div>
                <!-- /.contents -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.login-register -->



    <?php include "footer.php" ?>