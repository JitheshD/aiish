<?php
    $formData = ToDoRequisitionForm($_POST, $_PID, $_FILES);
?>
<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Department of POCD</h1>
                <div class="ui-subtitle-page">Online Requisition Form </div>
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
                    <li>Department</li>
                    <li class="active">Online Requisition Form </li>
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
                    <img src="<?php echo HostRoot ?>media/1170x300/1.jpg" height="300" width="1170" alt="Foto">
                    <div class="ui-subtitle-block ui-subtitle-block_form">Requisition form</div>
                    <i class="decor-brand"></i>
                </div>
            </div><!-- end row -->
            <div id="regMsg"></div>
            <?php echo getSessionMsg() ?>
            <form class="form-appointment ui-form" id="myRequisition" method="post">
                <div class="">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="required" name="org_name" id="org_name" placeholder="Organisation Name" value="<?php echo $formData["organization_name"] ?>">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="required" name="contact_persn" id="contact_persn" placeholder="COnatct Person Name" value="<?php echo $formData["contact_person"] ?>">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="required" name="contact_no" id="contact_no" placeholder="Contct number" value="<?php echo $formData["contact_no"] ?>">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="required" name="emailid" id="emailid" placeholder="Email Id" value="<?php echo $formData["emailid"] ?>">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <textarea name="address" id="address" placeholder="Address" required rows="10"><?php echo $formData["address"] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="required" name="fax" id="fax" placeholder="Fax" value="<?php echo $formData["fax"] ?>">
                        </div>
                        <div class="input-group">
                            <input type="text" class="required" name="pay_atten" id="pay_atten" placeholder="Paying attention on" value="<?php echo $formData["paying_attention_for"] ?>">
                        </div>
                        <div class="input-group">
                            <input type="text" class="required" name="screening_prog" id="screening_prog" placeholder="Screening Program" value="<?php echo $formData["screening_program"] ?>">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input class="datetimepicker"  id="program_date" name="program_date" type="text" placeholder="Screening Date">
                            <i class="icon icon-calendar"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <input class=""  id="program_time" name="program_time" type="text" placeholder="Screening Time in 24 hr">
                            <i class="icon icon-clock"></i>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="input-group">
                            <textarea name="abt_org" id="abt_org" placeholder="About organisation" required rows="10"><?php echo $formData["about_organization"] ?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-md-offset-1"></div>
                    <div class="col-md-4 col-md-offset-1">
                        <input type="submit" name="SubmitRequisitn" class="btn bg-color_primary" value="Submit" >
                    </div>
                </div><!-- end row -->
            </form><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->
    
    
    <script src="<?php echo HostRoot ?>js/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            
        // Setup form validation on the #register-form element
            $("#myRequisition").validate({
                // Specify the validation rules
                rules: {
                    org_name: "required",
                    
                    contact_no:{
                        required: true,
                       minlength: 10,
                       number: true
                    },


                    emailid: {
                        required: true,
                        email: true
                    },
                    
                    program_date: {
                        required: true,
                        //date: true
                    },
                    program_time: {
                        required: true,
                        time24: true
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
                    org_name: "Please enter organisation name",
                    contact_no:{
                      required:"Contact number required", 
                      minlength: "Enter valid mobile number",
                        number : "Enter mobile number only"
                    }, 
                   
//                    uconfirmpass: "Confirm password must be same as password",
//                    umobile: {
//                        required: "Please enter your mobile number",
//                        minlength: "Enter valid mobile number",
//                        number : "Enter mobile number only"
//                    },
                    emailid: "Please enter a valid email address",
                    program_date:{
                        required: "This field is required",
                        //date: "Date format invalid"
                    },
                    program_time: {
                        required: "Required",
                        time24: "Incorrect time format "
                    }
//                    agree_term: "Please accept our policy"
                },
                
//                submitHandler: function() {
//                    var username = $("#name").val();
//                    var user_email = $("#email").val();
//                    var user_role = $("#jelect").val();
//                    var user_pwd = $("#password").val();
//                    var user_id = $("#userid").val();
////                    var user_password = $("#upassword").val();
//                   $.ajax({
//                       type: "POST",
//                       url: Root+"assets/ajax/todoRegister.php",
//       //                type: form.method,
//                       data: {usrname: username, usremail: user_email, usrrole: user_role, usrpwd: user_pwd, usrid: user_id},
//                       cache: false,
//                       success: function(data) {
//                           alert(data);
//                           if(data.trim() !== '1'){ 
//                               document.getElementById('regMsg').innerHTML = data;
//                               $('#regMsg').slideDown('slow');
//
//                           }
//                           else{
//                               window.location(Root+"registration");
//                           }
//       //                    alert(result);
//
//                       }            
//                   });
//               }
                
            });
        });
        
        
    </script>
    