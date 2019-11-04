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

                    <h2 class="section-title">Create a Course</h2>

                    <form class="register-form" id="register-form" action="#" method="post">
                        <p class="form-input">
                            <input type="text" name="log" id="user_name" class="input " value="" placeholder="Course Title" required="">
                        </p>

                        <p class="form-input">

                            <textarea class=" form-control input" columns="10" placeholder="Description" required=""></textarea>
                        </p>




                        <p class="checkbox">
                            <select class="rememberme form-control">
                                <option value="">-- Course Type --</option>
                                <option value="male">Paid</option>
                                <option value="female">Free</option>

                            </select>
                            <!-- <input name="rememberme" type="checkbox" class="rememberme float-left" value="Remember Me"> By clicking I agree to the
                            <a href="#" class="" title="Recover Your Lost Password">Terms & Conditions</a> -->
                        </p>

                        <p class="form-input">

                            <input type="text" name="log" id="user_name" class="input " value="" placeholder="If Paid Enter The Amount" required="">
                        </p>

                        <p class="checkbox">
                            <select class="rememberme form-control">
                                <option value="">-- Category --</option>
                                <option value="male">IT</option>
                                <option value="female">Business</option>
                                <option value="others">Web Development</option>
                            </select>
                            <!-- <input name="rememberme" type="checkbox" class="rememberme float-left" value="Remember Me"> By clicking I agree to the
                            <a href="#" class="" title="Recover Your Lost Password">Terms & Conditions</a> -->
                        </p>



                        <p class="form-input">
                            <input type="text" name="log" id="user_name" class="input" value="" placeholder="InstructorFirstname" required="">
                        </p>
                        <p class="form-input">
                            <input type="text" name="log" id="user_name" class="input" value="" placeholder="InstructorLastname" required="">
                        </p>

                        <p class="checkbox">
                            <select class="rememberme form-control">
                                <option value="">-- Designation --</option>
                                <option value="male">IT</option>
                                <option value="female">Business</option>
                                <option value="others">Web Development</option>
                            </select>

                        </p>


                        <div class="form-input">
                            <label>Upload Course Image</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="imgInp">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly style="margin-top:20px">
                            </div>
                            <img id='img-upload' />

                        </div>
        


                        <p class="form-input">
                            <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Publish">
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