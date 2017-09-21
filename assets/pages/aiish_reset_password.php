<?php
    //$formData = ToDoUserForm($_POST)
?>
<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Reset Password</h1>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div><!-- end ui-title-page -->


<div class="border_btm">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0);"><i class="icon icon-home color_primary"></i></a></li>
                    <li class="active">Change password</li>
                </ol>
            </div>
        </div>
    </div>
</div><!-- end breadcrumb -->


<main class="main-content">
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <img src="media/1170x300/1.jpg" height="300" width="1170" alt="Foto">
                    <div class="ui-subtitle-block ui-subtitle-block_form">Please fill-in the form below to make Registration</div>
                    <i class="decor-brand"></i>
                </div>
            </div><!-- end row -->
            <div id="regMsg"></div>
            <form class="form-appointment ui-form" id="myRegister" method="post">
                <div class="">
                    <div class="col-md-2 col-md-offset-1"></div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="required" name="name" id="name" placeholder="Employee Name">
                        </div>
<!--                        <div class="input-group">
                            <input type="file" placeholder="Choose image to upload">
                        </div>-->
<!--                        <div role="select" class="jelect">
                            <div tabindex="0" role="button" class="jelect-current">Select Office Name</div>
                            <ul class="jelect-options">
                                <?php echo getAuthSelection($formData["userRole"]) ?>
                                    <li data-val='0' tabindex="0" role="option" class="jelect-option jelect-option_state_active">Office 1</li>
                                <li data-val='1' tabindex="0" role="option" class="jelect-option">Office 2</li>
                                <li data-val='2' tabindex="0" role="option" class="jelect-option">Office 3</li>
                            </ul>
                        </div>-->
                        <div role="select" class="jelect">
                            <input id="jelect" name="role" value="" data-text="imagemin" type="text" class="jelect-input required">
                            <div tabindex="0" role="button" class="jelect-current">Select Role</div>
                            
                            <ul class="jelect-options" name="role">
                                <?php echo getAuthSelection($formData["userRole"]) ?>
<!--                                <li data-val='0' tabindex="0" role="option" class="jelect-option jelect-option_state_active">Role 1</li>
                                <li data-val='1' tabindex="0" role="option" class="jelect-option">Role 2</li>
                                <li data-val='2' tabindex="0" role="option" class="jelect-option">Role 3</li>-->
                            </ul>
                        </div>
                        <div class="input-group">
                            <input type="email" id="email" name="email" placeholder="Email Address">
                        </div>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Password">
                        </div>

<!--                        <div class="input-group">
                            <input class="datetimepicker" type="text" placeholder="Date Of Birth">
                            <i class="icon icon-calendar"></i>
                        </div>-->
                        <!--<button class="btn bg-color_primary" name="regsubmit" type="submit">Register</button>-->
                        <input type="submit" name="SubmitUser" class="btn bg-color_primary" value="Register" >
                    </div>
                </div><!-- end row -->
            </form><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->
    
    
    <script src="<?php echo HostRoot ?>js/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            
        // Setup form validation on the #register-form element
            $("#myRegister").validate({
                // Specify the validation rules
                rules: {
                    name: "required",
                    
                    role: "required",
//                    umobile: {
//                       required: true,
//                       minlength: 10,
//                       number: true
//                    },

                    email: {
                        required: true,
                        email: true
                    },
                    
                    password: {
                        required: true,
                        minlength: 5
                    }
//                    uconfirmpass: {
//                        equalTo: "#upassword"
//                    },
//                    agree_term: {
//                         required : true
//                      }


                },
        //        
                // Specify the validation error messages
                messages: {
                    name: "Please enter name",
                    role: "Select role",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
//                    uconfirmpass: "Confirm password must be same as password",
//                    umobile: {
//                        required: "Please enter your mobile number",
//                        minlength: "Enter valid mobile number",
//                        number : "Enter mobile number only"
//                    },
                    email: "Please enter a valid email address",
//                    agree_term: "Please accept our policy"
                },
                
                submitHandler: function() {
                    var username = $("#name").val();
                    var user_email = $("#email").val();
                    var user_role = $("#jelect").val();
                    var user_pwd = $("#password").val();
//                    var user_password = $("#upassword").val();
                   $.ajax({
                       type: "POST",
                       url: Root+"assets/ajax/todoRegister.php",
       //                type: form.method,
                       data: {usrname: username, usremail: user_email, usrrole: user_role, usrpwd: user_pwd},
                       cache: false,
                       success: function(data) {
                           alert(data);
                           if(data.trim() !== '1'){ 
                               document.getElementById('regMsg').innerHTML = data;
                               $('#regMsg').slideDown('slow');

                           }
                           else{
                               window.location(Root+"registration");
                           }
       //                    alert(result);

                       }            
                   });
               }
                
            });
        });
        
        
    </script>
    