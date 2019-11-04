<?php
    session_start();
    $msglogin = "";
  
	if (isset($_POST['submit'])) {
	
        $con = mysqli_connect("localhost","root","","my_educature");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }
		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);

		if ($email == "" || $password == "")
			$msglogin = "Please check your blank inputs!";
		else {
          
            $sql = "SELECT * FROM users WHERE user_email='$email' OR user_name='$email'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
			if ($row['user_id'] > 0 ) {
              
                if ($password == $row['user_password']) {
                    if ($row['is_verified'] == 0)
	                    $msglogin = "Please verify your email!";
                    else {
                        $msglogin = "You have been logged in";
                        $_SESSION["user_id"] = $row['user_id'];
                        if(isset($_SESSION['user_id'])) {
                            header('Location: index.php');
                            $_SESSION["user_name"] = $row['user_name'];
                            $_SESSION["user_email"] = $row['user_email'];
                            $_SESSION["role_id"] = $row['role_role_id'];                           
                        } 
                        else {
                            $message = "Invalid Username or Password!";
                        }  
                    }
                } else
	                $msglogin = "You entered the wrong password";
			} else {
				$msglogin = "Username or password Incorrect ";
			}
		}
	}
?>

<?php

 $con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
$status="";
if (isset($_POST['course_code']) && $_POST['course_code']!=""){
$course_code = $_POST['course_code'];
$result = mysqli_query($con,"SELECT `coursedetail`.*, `courses`.*
FROM `courses`
    LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id` WHERE `course_code`='$course_code'");
$row = mysqli_fetch_assoc($result);
$course_name = $row['course_name'];
$course_code = $row['course_code'];
$course_price = $row['course_price'];
$course_image = $row['course_image'];


    //array for cart
$cartArray = array(
	$course_code=>array(
	'course_name'=>$course_name,
	'course_code'=>$course_code,
	'course_price'=>$course_price,
	'course_image'=>$course_image)
);

    //shows msg when item is added to cart
if(empty($_SESSION["shopping_cart"])) {
    $id=$_SESSION["user_id"];
	$_SESSION["shopping_cart"] = $cartArray;   
	$status = "<div class='box'>Product is added to your cart!</div>";
     $id = "SELECT `cart_id` FROM `cart` WHERE `user_user_id`='$id'";
                        $result = mysqli_query($con,$id);
                        $row = mysqli_fetch_assoc($result);
                        $cart_id= $row['cart_id'];
    
                        $con->query("INSERT INTO `cartitem`(`course_name`, `course_image`,  `course_price`, `course_code`, `cart_cart_id`) VALUES ('$course_name','$course_image','$course_price', '$course_code', '$cart_id');"); 
    
                             
}else{
     $id=$_SESSION["user_id"];
    //shows msg if item is already in cart
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($course_code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
     $id = "SELECT `cart_id` FROM `cart` WHERE `user_user_id`='$id'";
                        $result = mysqli_query($con,$id);
                        $row = mysqli_fetch_assoc($result);
                        $cart_id= $row['cart_id'];
                        $con->query("INSERT INTO `cartitem`(`course_name`, `course_image`,  `course_price`, `course_code`, `cart_cart_id`) VALUES ('$course_name','$course_image','$course_price', '$course_code', '$cart_id');"); 
     
   }

	}
    
}

?>
<?php


$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["course_code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
             $con->query("DELETE FROM `cartitem` WHERE `course_code`='$course_code';"); 
           
		} //removes product form cart
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

?>

<!doctype html>

<html class="no-js" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Educature</title>
    <meta name="description" content="CourseWare - HTML5 Template By Jewel Theme">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- favicon -->
    <link rel="icon" href="images/favicon1.png" sizes="32x32">
    <link rel="icon" href="images/favicon2.png" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="images/favicon2.png">


    <!-- Import Template Icons CSS Files -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">

    <!-- Import Bootstrap CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Import Owl Carousel CSS File -->


    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/selectric.css">

    <!-- TimeTo Countdown CSS Files -->
    <link rel="stylesheet" href="assets/css/timeTo.css">

    <!-- WooCommerce -->
    <link rel="stylesheet" href="assets/css/woocommerce.css">


    <!-- Import Template's CSS Files -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">



    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.selectric.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM"></script>
    <script src="assets/js/educature.js"></script>

    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload {
            width: 100%;
        }

    </style>

    <script>
        $('#password, #confirmpassword').on('keyup', function() {
            if ($('#password').val() == $('#confirmpassword').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });


        function bs_input_file() {
            $(".input-file").before(
                function() {
                    if (!$(this).prev().hasClass('input-ghost')) {
                        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                        element.attr("name", $(this).attr("name"));
                        element.change(function() {
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function() {
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function() {
                            element.val(null);
                            $(this).parents(".input-file").find('input').val('');
                        });
                        $(this).find('input').css("cursor", "pointer");
                        $(this).find('input').mousedown(function() {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        return element;
                    }
                }
            );
        }
        $(function() {
            bs_input_file();
        });

    </script>

</head>


<body>


    <header class="masthead">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top-contact">
                            <div class="trggericon"><i class="fas fa-at"></i></div>
                            <div class="close"><i class="far fa-times-circle"></i></div>
                            <div class="contacts">
                                <span><i class="fas fa-phone"></i> <a href="tel:2268996424">(+1) 226-899-6424</a></span>
                                <span><i class="fas fa-envelope"></i> <a href="mailto:info.educature@gmail.com">info.educature@gmail.com</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-cart dropdown float-right">
                           


                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cart <i class="fas fa-shopping-cart"></i>
                            </a>
                         
                            <div class="dropdown-menu cart-menu">
                                <div class="widget_shopping_cart_content">
                                    <div class="cart-top">
                                    <?php
                            if($_SESSION["user_id"] || isset($_SESSION["shopping_cart"])){
                                $total_price = 0;
                                $id = $_SESSION['user_id'];
                                $lookupID = "SELECT `cart_id` FROM `cart` WHERE `user_user_id`='$id'";
                                  $result = mysqli_query($con, $lookupID);
                                  $row = mysqli_fetch_row($result);
                                  $cart_cart_id = $row[0];
                             
                               
                                $sql = $con->query("SELECT * FROM `cartitem` WHERE `cart_cart_id`='$cart_cart_id'");
                            
                          ?>
                                        <?php
                                         foreach ($sql as $value){
                                echo'
                                        <div class="item media">
                                            
                                            <div class="item-thumbnail">
                                                <img src="images/'.$value['course_image'].'" alt="Item Thimbnail">
                                            </div>
                                            <!-- /.item-thumbnail -->
                                            <div class="item-details media-body">
                                                
                                                <h4 class="item-title"><a href="#">'.$value['course_name'].'</a></h4>
                                                
                                                <div class="price">
                                                    <span class="current-price">'.$value['course_price'].'</span>
                                                   
                                                </div>
                                            </div>
                                           
                                        </div>
                                        ';}
                                       ?>
                                        <?php
  //if cart is empty
}
?>

                              

                                    </div>
                                    <!-- /.cart-top -->


                                    <!-- /.cart-middle -->

                                    <div class="cart-bottom">
                                        <a href="cart.php" class="btn float-left"><i class="icons icon-basket-loaded"></i> View Cart</a>
                                        <a href="checkout.php" class="btn float-right">Checkout</a>
                                    </div>
                                    <!-- /.cart-bottom -->
                                </div>
                                <!-- /.widget_shopping_cart_content -->
                            </div>
                        </div>


                        <?php
                            if(isset($_SESSION['user_id'])){
                                echo'
                                <div class="user-area dropdown float-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   '. $_SESSION['user_name'].'
                                </a>
                                <div class="user-menu dropdown-menu">
                                    <a class="nav-link" href="profile.php"><i class="fa fa- user"></i>My Profile</a>
                                ';
                                if($_SESSION['role_id']==1){
                                    echo ' <a class="nav-link" href="mytutorials.php"><i class="fa fa -cog"></i>My Tutorials</a>';
                                }
                                else{
                                    echo '<a class="nav-link" href="mycourses.php"><i class="fa fa -cog"></i>My Courses</a>';
                                }
                                echo '  </div>
                                </div>';  
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.header-top -->
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-md m-0">
                    <a class="navbar-brand" href="index.php"><img src="images/Untitled-1.png" alt="Logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item menu-item-has-children dropdown ">
                                <a class="dropdown-item" href="index.php">Home</a>
                                <!-- <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="index.php">Home</a> -->
                                <!-- <a class="dropdown-item" href="index.php">Demo 01</a>
                                    <a class="dropdown-item" href="index-02.php">Demo 02</a>
                                    <a class="dropdown-item" href="index-03.php">Demo 03</a>
                                    <a class="dropdown-item" href="index-04.php">Demo 04</a> -->
                                <!-- </div> -->
                            </li>
                            <li class="nav-item menu-item-has-children dropdown">
                                <a class="dropdown-item" href="courses.php">All Courses</a>
                                <!-- <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php">Home</a> -->
                                <!-- <a class="dropdown-item" href="index.php">Demo 01</a>
                                        <a class="dropdown-item" href="index-02.php">Demo 02</a>
                                        <a class="dropdown-item" href="index-03.php">Demo 03</a>
                                        <a class="dropdown-item" href="index-04.php">Demo 04</a> -->
                                <!-- </div> -->
                            </li>
                            <li class="nav-item menu-item-has-children dropdown">
                                <a class="dropdown-item" href="instructors.php">All Instructors</a>
                                <!-- <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="index.php">Home</a> -->
                                <!-- <a class="dropdown-item" href="index.php">Demo 01</a>
                                            <a class="dropdown-item" href="index-02.php">Demo 02</a>
                                            <a class="dropdown-item" href="index-03.php">Demo 03</a>
                                            <a class="dropdown-item" href="index-04.php">Demo 04</a> -->
                                <!-- </div> -->
                            </li>
                            <!-- <li class="nav-item menu-item-has-children dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Courses</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="courses.php">All Courses</a>
                                    <a class="dropdown-item" href="course-details.php">IT & Software</a>
                                    <a class="dropdown-item" href="course-details.php">Development</a>
                                    <a class="dropdown-item" href="course-details.php">Design </a>
                                    <a class="dropdown-item" href="course-details.php">Business</a>
                                    <a class="dropdown-item" href="course-details.php">Photography</a>
                                    <a class="dropdown-item" href="course-details.php">Marketing</a>
                                    <a class="dropdown-item" href="course-details.php">Art & Science</a>
                                    <a class="dropdown-item" href="course-details.php">Teaching</a>
                                </div>
                            </li>
                            <li class="nav-item menu-item-has-children dropdown">

                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Instructors</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="instructors.php">All Instructors</a>
                                    <a class="dropdown-item" href="instructor-details.php">Web Developer</a>
                                    <a class="dropdown-item" href="instructor-details.php">Designer</a>
                                    <a class="dropdown-item" href="instructor-details.php">Photographer</a>
                                    <a class="dropdown-item" href="instructor-details.php">Businessmen</a>
                                    <a class="dropdown-item" href="instructor-details.php">Professor</a>


                                </div>
                            </li> -->


                            <?php
                            if(isset($_SESSION['user_id'])){
                                echo'
                                <li class="nav-item menu-item-has-children dropdown">
                                ';
                                if($_SESSION['role_id']==1){
                                    echo'  <a class="dropdown-item" href="CreateTutorials.php">Create a Tutorails</a>    ';
                                }
                                else{
                                    echo'  <a class="dropdown-item" href="became-a-instructor.php">Become a Instructor</a>    ';
                                }
                                echo'  </li>';     
                            }
                            else{
                                echo'
                                <li class="nav-item menu-item-has-children dropdown">
                                <a class="dropdown-item" href="became-a-instructor.php">Become a Instructor</a>  
                                </li>
                                ';
                               
                            }
                        ?>


                            <?php
                            if(isset($_SESSION['user_id'])){

                                echo "
                                <li class='nav-item menu-item-has-children dropdown'>
                                    <a class='dropdown-item' href='logout.php'>Logout</a>                               
                                </li>";

                                
                            }
                            else{
                                
                                echo "
                                <li class='nav-item menu-item-has-children dropdown'>
                                <div class='menu-cart dropdown'>
                                    <a class='nav-link dropdown-toggle' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Account <i class='fas fa-user'></i>
                                    </a>
                                    <div class='dropdown-menu cart-menu'>
                                        <div class='widget_shopping_cart_content'>

                                            <div class='cart-bottom'>
                                                <a href='login.php' class='btn float-left'>Login</a>
                                                <a href='register.php' class='btn float-right'>SignUp</a>
                                            </div>
                                          
                                        </div>
                                      
                                    </div>
                                </div>                                
                            </li>";

                            }
                            ?>
                            <!-- <li class="nav-item menu-item-has-children dropdown">
                                <div class="menu-cart dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account <i class="fas fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu cart-menu">
                                        <div class="widget_shopping_cart_content">

                                            <div class="cart-bottom">
                                                <a href="login.php" class="btn float-left">Login</a>
                                                <a href="register.php" class="btn float-right">SignUp</a>
                                            </div>
                                          
                                        </div>
                                      
                                    </div>
                                </div>                                
                            </li> -->
                        </ul>
                    </div>
                </nav>

            </div>
            <!-- /.container -->
        </div>
        <!-- /.header-bottom -->
    </header>
    <!-- /.masthead -->
