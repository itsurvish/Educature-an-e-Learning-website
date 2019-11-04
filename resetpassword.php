<?php include "header.php" ?>



    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Reset Password</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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

                    <h2 class="section-title">Reset Password</h2>

                    <?php
                        
                        $reset="";
                        function redirect() {
                            header('Location: login.php');
                            exit();
                        }

                        if (!isset($_GET['user_email']) || !isset($_GET['verification_key'])) {
                            
                          $reset="You come from Wrong Link";
                            
                        } else {
                            
                            
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                                }


                            $token = $con->real_escape_string($_GET['verification_key']);
                            $email = $con->real_escape_string($_GET['user_email']);
                            
                            	if (isset($_POST['resetsubmitbtn'])) {
                                    
                                  $email = $con->real_escape_string($_GET['user_email']);
                                    $newpassword =  $con->real_escape_string($_POST['newpassword']);
                                 

                                    $sql = "SELECT user_id FROM users WHERE user_email='$email' AND verification_key='$token'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);

                                    if ( $row['user_id'] > 0 ) {
                                        $id= $row['user_id'];
                                        $con->query("UPDATE users SET user_password='$newpassword' WHERE user_id='$id'");
                                        echo 'Your password has been reset succesfully!';
                                        echo" <script type='text/javascript'>
                                        window.location.href = 'http://localhost:8080/educature/login.php';
                                        </script>";
                                     
                                    } else                          
                                        echo 'Your password has been already Reset before ! Try Login';
                                
                            }
                          
                        }


                           
                    ?>
                    
                      <?php
                        if ($reset != "") echo "
                    <div class='alert alert-danger'>
                        <strong>$reset</strong>
                    </div>";
                    ?>
                    <form class="sign-in-form" id="sign-in-form" action="#" method="post">
                        <p class="form-input">
                            <input type="text" name="newEmail" id="newEmail"  class="input" value="<?php if(!isset($email)){echo"";}else{ echo "$email";}  ?>" placeholder="Email" required="">
                        </p>
                        <p class="form-input">
                            <input type="password" name="newpassword" id="newpassword" class="input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" value="" placeholder="New Password" required=""> *Use 8 or more characters with a mix of letters,numbers and atleast one upper and lower case
                        </p>
                        <p class="form-input">
                            <input type="password" name="confirmpassword" id="confirmpassword" class="input" value="" placeholder="Confirm Password" required="">
                            <span id="message"></span>
                        </p>
                        <p class="form-input">
                            <input type="submit" name="resetsubmitbtn" id="resetsubmitbtn" class="btn" value="Reset">
                        </p>

                    </form>
  <script type="text/javascript">
    
            $('#newpassword, #confirmpassword').on('keyup', function () {
            if ($('#newpassword').val() == $('#confirmpassword').val()) {
                $('#message').html('');
            } else 
                $('#message').html('Not Matching').css('color', 'red');
            });                        
                                
     </script>
                </div>
                <!-- /.contents -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.login-register -->

    <?php include "footer.php" ?>