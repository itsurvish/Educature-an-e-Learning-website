<?php include "header.php" ?>

<div class="error-contents text-center">

<div class="section-padding gray-bg">
    <a class="error-logo" href="index.php"><img src="images/tick7.png" alt="Logo"></a>

    <h1>
    <?php
	function redirect() {
		header('Location: register.php');
		exit();
	}

	if (!isset($_GET['user_email']) || !isset($_GET['verification_key'])) {
		redirect();
	} else {
	
        $con = mysqli_connect("localhost","root","","my_educature");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
            }


		$email = $con->real_escape_string($_GET['user_email']);
        $token = $con->real_escape_string($_GET['verification_key']);
        
        $sql = "SELECT user_id FROM users WHERE user_email='$email' AND verification_key='$token' AND is_verified =0";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        if (!$result)
        {
            header('Location: login.php');
        }
      

		if ( $row['user_id'] > 0 ) {

			$con->query("UPDATE users SET is_verified=1 WHERE user_email='$email'");
			echo 'Your Account has been verified!';
		} else
       // header('Location: login.php');
       echo 'Your Account is already verified before ! Try Login';
    }
?>
    </h1>
    <a href="login.php" class="btn btn-lg mt-4">Login now</a>
</div>
</div>



<?php include "footer.php" ?>