<?php include "header.php" ?>
<?php
require("../Educature/authorization.php");
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

            $("#imgInp1").change(function() {
                readURL(this);
            });
        });

    </script>

    <script>
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
<?php
 $courseUpdated="";
   if($_SESSION['user_id']){
           $con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
       $user = $_SESSION['user_id'];
       $course_detail_id=$_GET['course_detail_id'];
       $sql ="SELECT `coursedetail`.*, `courses`.*, `users`.*
FROM `courses`
    LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id`
    LEFT JOIN `users` ON `courses`.`user_user_id` = `users`.`user_id`
where course_detail_id='$course_detail_id'";                                  
       $result = mysqli_query($con,$sql);

       $row = mysqli_fetch_assoc($result);    
       
       $course_id=$row['course_id'];
       
         if(isset($_POST['createtutorials']) && isset($_FILES["fileToUpload"]["tmp_name"])) {
       
        $coursename = $con->real_escape_string($_POST['coursename']);
        $coursetag = $con->real_escape_string($_POST['coursetag']);
        $category = $con->real_escape_string($_POST['category']); 
        $description = $con->real_escape_string($_POST['description']);
        $duration = $con->real_escape_string($_POST['duration']);
        $price = $con->real_escape_string($_POST['price']); 

       $uploadOk="0";
       $target_dir = "../Educature/video/";
       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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

       if ($_SESSION['user_id']) {  
           
           $userpro = $_SESSION['user_id'];
           
        if(!empty($imagename)){
             $con->query(" UPDATE `courses` SET `course_name`='$coursename',`coursecategory_category_id`='$category',`course_tag`='$coursetag',`enroll`='0' WHERE course_id='$course_id'");
            
            $con->query(" UPDATE `coursedetail` SET `course_description`='$description',`course_duration`='$duration',`course_image`='$imagename',`course_price`='$price' WHERE course_detail_id='$course_detail_id'");
            $courseUpdated="course details are updated";
           
        }
           else{
                $con->query(" UPDATE `courses` SET `course_name`='$coursename',`coursecategory_category_id`='$category',`course_tag`='$coursetag',`enroll`='0' WHERE course_id='$course_id'");
               
                $con->query(" UPDATE `coursedetail` SET `course_description`='$description',`course_duration`='$duration',`course_price`='$price' WHERE course_detail_id='$course_detail_id'");
                $courseUpdated="course details are updated";
           }                      
     }
             
         }
       
       
             
   }       
?>

    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Mitchel Margaret</h2>
                    <span class="designation">Professional App Developer</span>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.section-padding -->
        </div>
        <!-- /.overlay -->
    </section>
    <!-- /.page-name -->

    <section class="instructor-details">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 pr-5">
                        <div class="avatar text-center"><img alt="Avatar Image" src="images/<?php echo $row['course_image']; ?>"></div>
<!--
                        <div class="social text-center">
                            <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook-f"></i></a> <a href="#"><i class="fab fa-pinterest"></i></a> <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div> /.social 
-->
                    </div>
                    <div class="col-md-8 pl-4">
                        <?php
                        if ($courseUpdated != "") echo "
                    <div class='alert alert-danger'>
                        <strong>$courseUpdated</strong>
                    </div>";
                    ?>
                        <div class="course-single-details">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a aria-controls="description" aria-selected="true" class="nav-item nav-link active" data-toggle="tab" href="#description" id="nav-3" role="tab">Course Detail</a> <!-- <a class="nav-item nav-link active" id="nav-2" data-toggle="tab" href="#curriculum" role="tab" aria-controls="curriculum" aria-selected="false">Curriculum</a> -->
                                <!-- <a class="nav-item nav-link " id="nav-3" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="true">Instructor</a> -->
                                <a aria-controls="reviews" aria-selected="false" class="nav-item nav-link" data-toggle="tab" href="#reviews" id="nav-4" role="tab">Videos</a>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div aria-labelledby="description" class="tab-pane fade show active" id="description" role="tabpanel">
                                    <section class="login-register">
                                        <div class="section-padding">
                                            <!--
                                            <div class="container">
                                                <div class="contents text-center">
--> 
                                            <h2 class="section-title">Create a Course</h2>
                                         <form class="register-form" id="register-form"  enctype="multipart/form-data"  action="#" method="post">
                    <p class="form-input">
                        <input type="text" name="coursename" id="user_name" class="input " value="<?php echo $row['course_name']; ?>" placeholder="Course Title" required="">
                    </p>
                    
                    <p class="form-input">
                        <input type="text" name="coursetag" id="user_name" class="input" value="<?php echo $row['course_tag']; ?>" placeholder="Course Tag" required="">
                    </p>
                    
                    <p class="form-input">

                        <textarea class=" form-control input" name="description" value="" rows="7" columns="10" placeholder="Description" required=""><?php echo $row['course_description']; ?></textarea>
                    </p>

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
                        <input type="text" name="duration" id="user_name" class="input" value="<?php echo $row['course_duration']; ?>" placeholder="Course Duration" required="" pattern="^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$">
                    </p>

                    <p class="form-input">
                        <input type="text" name="price" id="user_name" class="input" value="<?php echo $row['course_price']; ?>" placeholder="Course Price" pattern="\d+(\.\d{2})?" required="" >*e.g(129.99)
                    </p>

                       <div class="form-group">
                                <label class="col-md-3 control-label" style="color:#90a4ae">Update Image</label>
                                <div class="col-md-8">
                                <input class="userinfo" type="file"  name="fileToUpload"  id="fileToUpload">
                         
                                </div>
                            </div>

                    <p class="form-input">
                        <input type="submit"  name="createtutorials" id="createtutorials" class="btn" value="Publish a Tutorials">
                    </p>

                </form>
                </div>
                </section>
                                </div>
                                
                                
                                <?php
                                
                                $fileerror ="";
                                $con = mysqli_connect("localhost","root","","my_educature");
                                if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                                }
                                $videolink="";
                                
                                $course_detail_id=$_GET['course_detail_id'];
       $sql ="SELECT `coursedetail`.*, `courses`.*
FROM `courses`
    LEFT JOIN `coursedetail` ON `coursedetail`.`course_course_id` = `courses`.`course_id`
where course_detail_id='$course_detail_id'";                                  
       $result = mysqli_query($con,$sql);

       $row = mysqli_fetch_assoc($result);    
       
       $course_id=$row['course_course_id'];
                                
                                
                                    if(isset($_POST['uploadvideo']))  {
                                    $videoname= $con->real_escape_string($_POST['videoname']);
                                        
                                   $uploadOk="0";
                                   $target_dir = "../Educature/images/";
                                   $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                   $videolink=  basename($_FILES["fileToUpload"]["name"]);
                                   $uploadOk = 1;
                                   $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
                
                            $id = "SELECT course_detail_id FROM coursedetail WHERE course_course_id ='$course_id'";
                            $result = mysqli_query($con,$id);
                            $row = mysqli_fetch_assoc($result);
                            $coursedetailid= $row['course_detail_id']; 
                
              // Insert record
                              $con->query("INSERT INTO video(video_name, video_link, coursedetail_course_detail_id)
                                        VALUES ('$videoname', '$videolink', '$coursedetailid'); ");
                                        
                                    }
                                                       
                                    ?>
                                
                                <div aria-labelledby="reviews" class="tab-pane fade" id="reviews" role="tabpanel">
                                    <h3 class="title">Upload Your Videos Here</h3>
                                        <div class="col-md-8 col-md-offset-2">
                                            <form action="#" enctype="multipart/form-data" method="post">
                                                <!-- COMPONENT START -->
<!--
                                                <input type='file' name='file' />
                                                <input type='submit' value='Upload' name='but_upload'>
-->
                                                <!-- COMPONENT END -->
                                                
                                                <p class="form-input">

                                                <input class=" form-control input" name="videoname" columns="10" placeholder="Video Name" required="">
                                                </p>
<!--
                                                <p class="form-input">
                                                <input class=" form-control input" name="vduration" columns="10" placeholder="Video Duration" required="" pattern="^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$">
                                                </p>
-->
                                                <div class="form-group">
                                                <div class="col-md-8">
                                                <input class="userinfo" type="file" required="Image can't be blank" name="fileToUpload"  id="fileToUpload">
                         
                                                </div>
                                                </div>

                                                <p class="form-input">
                                                    <input type="submit"  name="uploadvideo" id="uploadvideo" class="btn" value="Upload Video">
                                                </p>
                                            </form>
                                        </div>


                                        <?php
$con = mysqli_connect("localhost","root","","my_educature");
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
$course_detail_id=$_GET['course_detail_id'];

$user_user_id=$_GET['user_user_id'];


$sql = $con->query("SELECT `video`.*, `coursedetail`.*, `users`.*, `userdetails`.*
FROM `coursedetail`
    LEFT JOIN `video` ON `video`.`coursedetail_course_detail_id` = `coursedetail`.`course_detail_id`
    LEFT JOIN `courses` ON `coursedetail`.`course_course_id` = `courses`.`course_id`
    LEFT JOIN `users` ON `courses`.`user_user_id` = `users`.`user_id`
    LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id`
    WHERE coursedetail.course_detail_id='$course_detail_id' and users.user_id='$user_user_id';");
       
foreach ($sql as $value) {

    if(empty($value['video_link'])){
        echo'
        <div class="info">
        <ul class="info-list">

            <li>
                NO video Available
            </li>
        </ul>
    </div>       
        ';
    }
    else{
        echo'
   
        <div class="info">
            <ul class="info-list">

                <li style="list-style: none;">
              
                    <div class="course-img">
                        <a type="button" href="" class="video-btn" data-backdrop="static" data-keyboard="false" data-controls-modal="modal" data-toggle="modal" data-src="video/'.$value['video_link'].'" data-target="#myModal">
                            <img src="images/single.jpg" width="120px" height="120px" />
                            <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                        </a>
                    </div>
                    <div class="course-video-details">
                        <span class="course-name">'.$value['video_name'].'</span>
                        <span class="course-owner">'.$value['first_name'].' '.$value['last_name'].'</span>
                        <span class="course-duration">'.$value['video_duration'].'</span>
                    </div>
                    <div class="course-video-details float-right">
                    <a href="delete.php?del_id='.$value['video_id'].'&course_detail_id='.$value['course_detail_id'].'&user_user_id='.$value['user_user_id'].'"><i class="fas fa-trash-alt" style="color:red;"></i></a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
';
    }   
}

?>
                                </div>
                                
                            </div>
                        </div>
                    </div><!-- /.container -->
                </div><!-- /.section-padding -->
            </div>
        </div>
    </section>
    <!-- /.instructor-details -->



    <?php include "footer.php" ?>