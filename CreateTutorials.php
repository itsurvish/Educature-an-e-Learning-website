<?php include "header.php" ?>

<?php
 require("../Educature/authorization.php");
     $fileError="";
    
  if($_SESSION['user_id']){
       $user = $_SESSION['user_id'];
       $sql ="SELECT * FROM `users` WHERE `user_id`='$user'";                                  
       $result = mysqli_query($con,$sql);

       $row = mysqli_fetch_assoc($result);    
   }
         
    
    $imagename="";
    
            if (isset($_POST['createtutorials'])) { 
                
                $user = $row['user_id'];
                
                $coursename = $con->real_escape_string($_POST['coursename']);
                $coursetag = $con->real_escape_string($_POST['coursetag']);
                $category = $con->real_escape_string($_POST['category']); 
                $description = $con->real_escape_string($_POST['description']);
                $duration = $con->real_escape_string($_POST['duration']);
                $price = $con->real_escape_string($_POST['price']); 
                
                $fileToUpload = $_FILES['fileToUpload']['name'];
                $uploadOk="0";
                   $target_dir = "../Educature/images/";
                   $target_file = $target_dir . basename($fileToUpload);
                   $imagename=  basename($_FILES["fileToUpload"]["name"]);
                   $uploadOk = 1;
                   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                  if($_FILES["fileToUpload"]["error"] === 1) {
                       $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                       if($check !== false) {
                         $fileError= "File is an image - " . $check["mime"] . ".";
                           $uploadOk = 1;
                       } else {
                        $fileError=  "File is not an image.";
                           $uploadOk = 0;
                       }
                     }

                    if ($_FILES["fileToUpload"]["size"] > 5000000) {
                        $fileError=  "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $fileError=  "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $updateProfile=  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                        } else {
                            $fileError=  "Sorry, there was an error uploading your file.";
                        }
                    }

                     $course_key = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789';
                        $course_key = str_shuffle($course_key);
                        $course_key = substr($course_key, 0, 6);
                
                   $con->query("INSERT INTO courses (course_name,coursecategory_category_id,course_tag,enroll,user_user_id, course_code)
                        VALUES ('$coursename', '$category','$coursetag','0','$user', '$course_key'); "); 
                
                
            $id = "SELECT course_id FROM courses WHERE course_code ='$course_key'";
            $result = mysqli_query($con,$id);
            $row = mysqli_fetch_assoc($result);
            $courseid= $row['course_id'];  
    
    
            $con->query("INSERT INTO coursedetail( course_description,course_duration,course_price,course_rating,course_course_id,course_image)
                            VALUES ('$description', '$duration','$price','4.5','$courseid','$imagename');
                        ");
             $fileError="$coursename is Created";
             if (!empty($fileError)){
                 echo" <script type='text/javascript'>
                                        window.location.href = 'http://localhost:8080/educature/mytutorials.php';
                                        </script>";
             }
                 else {
             $fileError="course is not Created";
        }
        }
       
   

 	

//$statusMsg = '';
//$targetDir = "uploads/";
//$fileName = basename($_FILES["file"]["name"]);
//$targetFilePath = $targetDir . $fileName;
//$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

//if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
   // $allowTypes = array('jpg','png','jpeg','gif','pdf');
   // if(in_array($fileType, $allowTypes)){
        // Upload file to server
        //if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
           // $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
//            if($insert){
//                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
//            }else{
//                $statusMsg = "File upload failed, please try again.";
//            }else{
   // $statusMsg = 'Please select a file to upload.';
// }

// Display status message
//echo $statusMsg;


?>

<script>
    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    });

</script>

<section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
    <div class="overlay">
        <div class="section-padding">
            <div class="container">
                <h2 class="section-title">Create a Course</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create a Course</li>
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
                
                    <?php
                        if ($fileError != "") echo "
                    <div class='alert alert-danger'>
                        <strong>$fileError</strong>
                    </div>";
                    ?>
                  

                <h2 class="section-title">Create a Course</h2>

                <form class="register-form" id="register-form"  enctype="multipart/form-data"  action="#" method="post">
                    <p class="form-input">
                        <input type="text" name="coursename" id="user_name" class="input " value="" placeholder="Course Title" required="">
                    </p>
                    
                    <p class="form-input">
                        <input type="text" name="coursetag" id="user_name" class="input" value="" placeholder="Course Tag" required="">
                    </p>
                    
                    <p class="form-input">

                        <textarea class=" form-control input" name="description" columns="10" placeholder="Description" required=""></textarea>
                    </p>

                    <!--
                        <p class="checkbox">
                            <select class="rememberme form-control">
                                <option value="">-- Course Type --</option>
                                <option value="male">Paid</option>
                                <option value="female">Free</option>

                            </select>
                             <input name="rememberme" type="checkbox" class="rememberme float-left" value="Remember Me"> By clicking I agree to the
                            <a href="#" class="" title="Recover Your Lost Password">Terms & Conditions</a> 
                        </p>
-->
                    <!--
                        <p class="form-input">

                            <input type="text" name="log" id="user_name" class="input " value="" placeholder="If Paid Enter The Amount" required="">
                        </p>
-->
                    <!--
                    <p class="checkbox">
                        <select class="rememberme form-control">
                            <option value="">-- Category --</option>
                            <option value="male">IT</option>
                            <option value="female">Business</option>
                            <option value="others">Web Development</option>
                        </select>
                         <input name="rememberme" type="checkbox" class="rememberme float-left" value="Remember Me"> By clicking I agree to the
                            <a href="#" class="" title="Recover Your Lost Password">Terms & Conditions</a> 
                    </p>
-->
                    <p class="checkbox">
                        <?php 
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                                }
                                $sql = $con->query("SELECT * FROM coursecategory ");
                           
                                echo '<select class="rememberme form-control"  name="category">';
                                foreach ($sql as $value) {
                                    echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
                                }
                                echo '<select>';

                                ?>
                    </p>

                    <p class="form-input">
                        <input type="text" name="duration" id="user_name" class="input" value="" placeholder="Course Duration" required="" pattern="^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$">
                    </p>

                    <p class="form-input">
                        <input type="text" name="price" id="user_name" class="input" value="" placeholder="Course Price" pattern="\d+(\.\d{2})?" required="" >*e.g(129.99)
                    </p>

<!--
                    <p class="form-input">
                        <input type="text" name="rating" id="user_name" class="input" value="" placeholder="Rating" required="">
                    </p>
                    
-->
                    <!--
                    <p class="checkbox">
                        <select class="rememberme form-control">
                            <option value="">-- Designation --</option>
                            <option value="male">IT</option>
                            <option value="female">Business</option>
                            <option value="others">Web Development</option>
                        </select>

                    </p>


-->
<!--
                    <div class="form-input">
                        <label>Upload Course Image</label>
                        
                    
                                <div class="col-md-8">
                                <input type="file"  name="fileToUpload"  id="fileToUpload">
                         
                                </div>
                        
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" name="file"  id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly style="margin-top:20px">
                        </div>
                        <img id='img-upload' />

                    </div>
-->
                       <div class="form-group">
                                <label class="col-md-3 control-label" style="color:#90a4ae">Update Image</label>
                                <div class="col-md-8">
                                <input class="userinfo" type="file" required="Image can't be blank" name="fileToUpload"  id="fileToUpload">
                         
                                </div>
                            </div>

                    <p class="form-input">
                        <input type="submit"  name="createtutorials" id="createtutorials" class="btn" value="Publish a Tutorials">
                    </p>

                </form>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section-padding -->

</section>
<!-- /.login-register -->

<?php include "footer.php" ?>
