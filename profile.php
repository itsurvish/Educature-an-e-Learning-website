<?php include "header.php" ?>
<?php

   require("../Educature/authanticate.php");
 

   if($_SESSION['user_id']){
       $user = $_SESSION['user_id'];
       $sql ="SELECT `users`.*, `userdetails`.*, `userdesignation_has_user`.*
       FROM `users` 
           LEFT JOIN `userdetails` ON `userdetails`.`user_user_id` = `users`.`user_id` 
           LEFT JOIN `userdesignation_has_user` ON `userdesignation_has_user`.`user_user_id` = `users`.`user_id` WHERE
       user_id ='$user'";                                  
       $result = mysqli_query($con,$sql);

       $row = mysqli_fetch_assoc($result);    
   }

    $updateProfile = "";


    $imagename="";


    if(isset($_POST['updatesubmit'])) {
      
        $fileError="";
      
       $firstname = $con->real_escape_string($_POST['first_name']);
       $lastname = $con->real_escape_string($_POST['last_name']);                            
       $Designation = $con->real_escape_string($_POST['role']); 
       $Facebook = $con->real_escape_string($_POST['facebook_link']);
       $Linkedin = $con->real_escape_string($_POST['linkedin_link']);
       $github = $con->real_escape_string($_POST['github_link']);

       $uploadOk="0";
       $target_dir = "../Educature/images/";
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
             $con->query("UPDATE `userdetails` SET `first_name`='$firstname',`last_name`='$lastname',`image`='$imagename',`facebook_link`='$Facebook',`linkedin_link`='$Linkedin',`github_link`='$github' WHERE user_user_id ='$userpro'");
            
        }
           else{
               $con->query("UPDATE `userdetails` SET `first_name`='$firstname',`last_name`='$lastname',`facebook_link`='$Facebook',`linkedin_link`='$Linkedin',`github_link`='$github' WHERE user_user_id ='$userpro'");
           }
                 
        
         

           if($row['user_user_id'] == 0){
               $con->query("INSERT INTO `userdesignation_has_user`(`UserDesignation_designation`, `user_user_id`) VALUES ('$Designation','$userpro')");
               $updateProfile="$firstname Your Profile is Updated";
           }
           else{
               $con->query(" UPDATE `userdesignation_has_user` SET `UserDesignation_designation`='$Designation' WHERE  user_user_id='$userpro'");
               $updateProfile="$firstname Your Profile is Updated";                         
     }
   }
}      

?>
    <section class="page-name background-bg" data-image-src="images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <h2 class="section-title">Public Profile</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
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

    <section class="courses ">
        <div class="section-profile-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-content">
                            <div class="float-left left-content">
                                <h2 class="section-title">Profile</h2>
                                <input type="button" id="editbtn" class="btn save text-center" value="Edit profile" onclick="enableButtons()">
                                <hr>
                            </div>

                            <!-- /.left-content -->
                        </div>
                  
                        <?php
                        if ($updateProfile != "") echo "
                            <div class='alert alert-success'>
                                <strong>$updateProfile</strong>
                            </div>";
                        ?>
                  
                        <h3 class="profile">Personal info</h3>

                     

                        <form class="form-horizontal" id="profile-form" action="profile.php" method="post"  enctype="multipart/form-data" role="form">
                        <div class="col-md-2">
                        <aside class="sidebar">
                            <div class="text-center input-group ">
                                <div class="row">
                                    <div class="small-12 medium-2 large-2 columns">
                                        <div class="circle input-group">
                                            <!-- User Profile Image -->
                                            <img id='img-upload' class="profile-pic" src="../Educature/images/<?php echo $row['image']; ?>">

                                            <!-- Default Image -->
                                            <!-- <i class="fa fa-user fa-5x"></i> -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </aside>
                        <!-- /.sidebar -->
                    </div>
                       <br>
                    <div class="form-group">
                                <label class="col-md-3 control-label" style="color:#90a4ae">Update Image</label>
                                <div class="col-md-8">
                                <input class="userinfo" type="file" disabled="disabled" name="fileToUpload"  id="fileToUpload">
                         
                                </div>
                            </div>
                        <br>
                           
<!-- 
                        <div class="form-input form-group">
                            <label>Upload Course Image</label>
                            <div class="input-group col-md-8">
                                <input class="userinfo" disabled="disabled"  type="file" id="fileToUpload" name="fileToUpload">
                            </div>
                           
                        </div> -->

                            <div class="form-group">
                                <label class="col-md-3 control-label" style="color:#90a4ae">Username</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_name" disabled="disabled" type="text" value="<?php echo $row['user_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" style="color:#90a4ae">First name</label>
                                <div class="col-lg-8">
                                    <input class="form-control userinfo" name="first_name" disabled="disabled" type="text" value="<?php echo $row['first_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"  style="color:#90a4ae">Last name</label>
                                <div class="col-lg-8">
                                    <input class="form-control userinfo" name="last_name" disabled="disabled" type="text" value="<?php echo $row['last_name']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label" style="color:#90a4ae">Designation</label>
                                <div  class="col-lg-8">
                            <?php 
                            $con = mysqli_connect("localhost","root","","my_educature");
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                die();
                                }
                                $sql = $con->query("SELECT * FROM userdesignation");
                            

                                

                                echo '<select class="rememberme form-control userinfo" disabled="disabled"   name="role">';
                                foreach ($sql as $value) {
                                    echo '<option value="'.$value['designation_id'].'">'.$value['designation_title'].'</option>';
                                }
                                echo '<select>';

                                ?>
      
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"   style="color:#90a4ae">Email</label>
                                <div class="col-lg-8">
                                    <input class="form-control" name="user_email"  disabled="disabled" type="text" value="<?php echo $row['user_email']; ?>">
                                </div>
                            </div>

                            <h3 class="profile">Web links</h3>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" style="color:#90a4ae">Facebook</label>
                                <div class="col-lg-8">
                                    <input class="form-control userinfo" name="facebook_link" disabled="disabled" type="text" value="<?php echo $row['facebook_link']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" style="color:#90a4ae">Linkedin</label>
                                <div class="col-lg-8">
                                    <input class="form-control userinfo" name="linkedin_link" disabled="disabled" type="text" value="<?php echo $row['linkedin_link']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" style="color:#90a4ae">github</label>
                                <div class="col-lg-8">
                                    <input class="form-control userinfo" name="github_link" disabled="disabled" type="text" value="<?php echo $row['github_link']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <input type="submit" name="updatesubmit" id="updatesubmit"  class="btn save userinfo" disabled="disabled" value="Save Changes">
                                    <span></span>
                                    <input type="reset" class="btn save userinfo" disabled="disabled" id="disablebtn" onclick="disableButtons()" value="Cancel">
                                </div>
                            </div>
                         
                        </form>

                  


                    </div>


               
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.courses -->



    <?php include "footer.php" ?>