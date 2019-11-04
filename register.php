<?php include "header.php" ?>

<?php

require_once('PHPMailer/PHPMailerAutoload.php');
   
    $msgregister = "";

   	if (isset($_POST['registersubmit'])) {       

        $con = mysqli_connect("localhost","root","","my_educature");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
            }
           
        $username = $con->real_escape_string($_POST['username']);
        $firstname = $con->real_escape_string($_POST['firstname']);
        $lastname = $con->real_escape_string($_POST['lastname']);
        $str = strtolower($_POST['email']);
        $email = $con->real_escape_string($str);
		$password = $con->real_escape_string($_POST['password']);
        $cPassword = $con->real_escape_string($_POST['confirmpassword']);
        $role = $con->real_escape_string($_POST['role']);


        if (!empty($username)) {

            $sql = "SELECT user_id FROM users WHERE user_name='$username'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            if ( $row['user_id'] > 0 ) {
                $msgregister ="Username Already Taken";
            }
            else{
                
                    $sql = "SELECT user_id FROM users WHERE user_email='$email'";
                    $result = mysqli_query($con,$sql);
                    $row = mysqli_fetch_assoc($result);

                   
                    if ( $row['user_id'] > 0 ) {
                        
                        $msgregister = "Email already exists in the database!";
                    } else {
                        $verification_key = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
                        $verification_key = str_shuffle($verification_key);
                        $verification_key = substr($verification_key, 0, 10);
                        
                        $today = date("Y-m-d");  
                        
        
                        $con->query("INSERT INTO users (user_name,user_email,user_password,role_role_id,verification_key,is_verified,date_created,is_active)
                            VALUES ('$username', '$email', '$password','$role','$verification_key','0','$today','1');"); 
                        
                        $sql = "SELECT user_id FROM users WHERE user_email='$email'";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $id= $row['user_id'];

                        $con->query("INSERT INTO `cart`(`active`, `user_user_id`) VALUES ('1','$id');");
                        $mail = new PHPMailer();                                                   
                  
                                                           
                            $mail->isSMTP();  
                            $mail->SMTPAuth = true;   
                            $mail->SMTPSecure = 'ssl';                                   
                            $mail->Host = 'smtp.gmail.com';  
                            $mail->Port = '465';                              
                            $mail->Username = 'info.educature@gmail.com';                
                            $mail->Password = 'Conestoga123';  
                            $mail->setFrom('info.educature@gmail.com');
                            $mail->Subject = 'Please verify your account';
                            $mail->isHTML(true);  
                            $mail->Body    = "
                            

                                                            <html>
                                <style  >
                                body {font-family: Arial, Helvetica, sans-serif;}

                                form {
                                border: 3px solid #f1f1f1;
                                font-family: Arial;
                                }

                                .container {
                                padding: 20px;
                                background-color: #f1f1f1;
                                }

                                input[type=text], input[type=submit] {
                                width: 100%;
                                padding: 12px;
                                margin: 8px 0;
                                display: inline-block;
                                border: 1px solid #ccc;
                                box-sizing: border-box;
                                }
                                .button {
                                    background-color: #4CAF50;
                                    border: none;
                                    color: white;
                                    padding: 15px 32px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    margin: 4px 2px;
                                    cursor: pointer;
                                  }
                                input[type=checkbox] {
                                margin-top: 16px;
                                }

                                input[type=submit] {
                                background-color: #4CAF50;
                                color: white;
                                border: none;
                                }

                                input[type=submit]:hover {
                                opacity: 0.8;
                                }
                                </style>
                                <body>
                              

                                <div class='container'>
                                    <h2>please Verify Your Account</h2>
                                  
                                </div>


                                <div class='container'>
                                <a  class='button'  href='http://localhost:8080/Educature/confirm.php?user_email=$email&verification_key=$verification_key'>Click here</a>
                                </div>
                                </form>

                                </body>
                                </html>
                        
                            
                            ";
                            $mail->addAddress($email); 

                 
                            if( $mail->send()){
                                $msgregister ="Your Account has been created Please Check your Email to verify it !! ";

                            }                          
                            else{
                                $msgregister ="Something went Wrong";
                            }

                        $id = "SELECT user_id FROM users WHERE user_email ='$email'";
                        $result = mysqli_query($con,$id);
                        $row = mysqli_fetch_assoc($result);
                        $userid= $row['user_id'];
                   
                        
                        $con->query("INSERT INTO userdetails (first_name,last_name,image,user_user_id)
                        VALUES ('$firstname', '$lastname', '1.jpg', '$userid');
                        "); 
        
                    }
                }
            }
        }    
?>

    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Register</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
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

                    <h2 class="section-title">Register</h2>

                    <?php
                        if ($msgregister != "") echo "
                    <div class='alert alert-danger'>
                        <strong>$msgregister</strong>
                    </div>";
                    ?>
                  

                    <form class="register-form" id="register-form" action="register.php" method="post">
                        <p class="form-input">
                            <input type="text" name="username" id="user_username" class="input " value="" placeholder="Username" required="">
                        </p>
                        <p class="form-input">
                            <input type="text" name="firstname" id="user_firstname" class="input" value="" placeholder="Firstname" required="">
                        </p>
                        <p class="form-input">
                            <input type="text" name="lastname" id="user_lastname" class="input" value="" placeholder="Lastname" required="">
                        </p>
                        <p class="form-input">
                            <input type="email" name="email" id="user_email" onblur="c()" class="input" value="" placeholder="Email" required="">
                            <span id="p3"></span>
                        </p>

                        <p class="form-input">
                            <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" class="input" value="" placeholder="Password" required="">*Use 8 or more characters with a mix of letters,numbers and atleast one upper and lower case
                        </p>
 
                        <p class="form-input">
                            <input type="password" name="confirmpassword" id="confirmpassword" class="input" value="" placeholder="Confirm Password" required="">
                            <span id="message"></span>
                        </p>

                        <p class="checkbox">
                                <?php 
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                                }
                                $sql = $con->query("SELECT * FROM role ");
                           
                                echo '<select class="rememberme form-control"  name="role">';
                                foreach ($sql as $value) {
                                    echo '<option value="'.$value['role_id'].'">'.$value['role_name'].'</option>';
                                }
                                echo '<select>';

                                ?>

                         </p> 
                      

                            <!-- <select class="rememberme form-control">
                                <option value="">-- Select Role --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select> -->
                     
<!-- 
                        <p class="checkbox">

                            <select class="rememberme form-control">
                                <option value="">-- Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                          
                        </p>  -->

                        <p class="form-input">
                          
                            <input type="submit" name="registersubmit" id="submit"  value="Register" class="btn">
                        </p>

                    </form>

                    <!-- <div class="login-social">
                        <h2 class="section-title">Or Sign up using</h2>
                        <button class="btn facebook"><i class="fab fa-facebook"></i> Facebook</button>
                        <button class="btn twitter"><i class="fab fa-twitter"></i> Twitter</button>
                        <button class="btn google"><i class="fab fa-google-plus"></i> Google</button>
                    </div> -->
                    <!-- /.login-social -->

                    <p class="register">
                        Already have an account? <a href="login.php">Log In</a>
                    </p>
                </div>
                <!-- /.contents -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.login-register -->
    <script type="text/javascript">
                          
        function c()
            {
                    var n=document.getElementById("user_email").value;
                    var exp = /^[\w\-\.\+]+\@[gmail|GMAIL\.\-]+\.[com\COM]{3}$/;
                    if( exp.test( n ) )
                    {
                    document.getElementById("p3").innerHTML="";
                        
                    }
                    else
                    {
                    document.getElementById("p3").innerHTML="Please enter valid email";
                        document.getElementById("p3").style.color="red";
                    }
            }
            $('#password, #confirmpassword').on('keyup', function () {
            if ($('#password').val() == $('#confirmpassword').val()) {
                $('#message').html('');
            } else 
                $('#message').html('Not Matching').css('color', 'red');
            });                        
    
        
     </script>


    <?php include "footer.php" ?>
register.php
Displaying register.php.