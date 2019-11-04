<?php include "header.php" ?>

<?php

require_once('PHPMailer/PHPMailerAutoload.php');
   
    $msgrest = "";

   	if (isset($_POST['restsubmit'])) {

       

        $con = mysqli_connect("localhost","root","","my_educature");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

       
        $email = $con->real_escape_string($_POST['forgot_email']);
	
        
        


        if (!empty($email)) {        
            
                
                    $sql = "SELECT user_id FROM users WHERE user_email='$email'";
                    $result = mysqli_query($con,$sql);
                    $row = mysqli_fetch_assoc($result);

                   
                    if ( $row['user_id'] > 0 ) {
                        
                        
                            $sql = "SELECT * FROM users WHERE user_email='$email'";
                            $result = mysqli_query($con,$sql);
                            $row = mysqli_fetch_assoc($result);
                            
                            $token = $row['verification_key'];
                        
                            $mail = new PHPMailer();                           
                        
                  
                                                           
                            $mail->isSMTP();  
                            $mail->SMTPAuth = true;   
                            $mail->SMTPSecure = 'ssl';                                   
                            $mail->Host = 'smtp.gmail.com';  
                            $mail->Port = '465';                              
                            $mail->Username = 'info.educature@gmail.com';                
                            $mail->Password = 'Conestoga123';  
                            $mail->setFrom('info.educature@gmail.com');
                            $mail->Subject = 'Reset Password';
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
                                    <h2>please Reset your Password</h2>
                                  
                                </div>


                                <div class='container'>
                                <a  class='button'  href='http://localhost:8080/Educature/resetpassword.php?user_email=$email&verification_key=$token'>Click here</a>
                                </div>
                                </form>

                                </body>
                                </html>
                            

                            
                            ";
                            $mail->addAddress($email); 

                 
                           

                            if( $mail->send()){
                                $msgrest ="Reset Link has been send!! check you Mail ";
                            }                          
                            else{
                                $msgrest ="Something went Wrong";
                            }
                        
                        
                        
                       
                    } else {                     
                      

                        $msgrest = "Email address not found in  database";
        
                    }
                
            }
        }  
       


?>


    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Forgot Password</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
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

                    <h2 class="section-title">Forgot Password ?</h2>
                    <?php
                        if ($msgrest != "") echo "
                    <div class='alert alert-danger'>
                        <strong>$msgrest</strong>
                    </div>";
                    ?>
                    <form class="sign-in-form" id="sign-in-form" action="forgetpassword.php" method="post">
                        <p class="form-input">
                            <input type="text" name="forgot_email" id="forgot_email" onblur="c()" class="input" value="" placeholder="Enter the Recovery Email Address" required="">
                            <span id="p3"></span>
                        </p>

                        <p class="form-input">
                            <input type="submit" name="restsubmit" id="restsubmit" class="btn" value="Send a Reset Link">
                        </p>

                    </form>

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
                                      var n=document.getElementById("forgot_email").value;
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
                                                 
                                                  
                       </script>
    <?php include "footer.php" ?>