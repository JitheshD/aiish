<?php
$formData = SubmitUser($_POST, $_PID);
//$count = getUserCount();
?>
<style>
    .toggler-ico {
            border: none;
        background: none;
        padding: 0px 16px;
        width: 32px;
        position: absolute;
        right: -7px;
        top: 299px;
      }
    
</style>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Add new user</h1>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active"><i class="fa fa-user-md"></i>add-user</li>
    </ol>
</section>
<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <div class="box-header form-group">
                        <button class="btn btn-default add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                            Add New User <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>User name</th>
                                    <th>User role</th>
                                    <th>User email</th>
                                    <th>AIISH Center</th>
<!--                                    <th>User State</th>
                                    <th>User District</th>-->
                                    <th>User created date</th>
                                    <th>User created by</th>
                                    <th>User last updated date</th>
                                    <th>User last updated by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getUserList(); ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </div>
</section><!-- end section -->

<?php
if (!empty($_PID["add-user"])) {
    echo "<script>
            jQuery('document').ready(function (){
                $('.bs-example-modal-left').modal('show');
            });
        </script>";
}
?>

<div class="modal fade modal horizontal bs-example-modal-left"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">User Profile Detail</h4>
            </div>
            <div class="modal-body">
                <form  role="form" id="userSubmit" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <div class="row">    
                        <div class="col-md-11">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Username<span class="color_required">*</span></label>
                                    <input type="text" class="form-control required charOnly" name="username" placeholder="Username"  value="<?php echo $formData["user_name"]; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>User role<span class="color_required">*</span></label>
                                    <select class="form-control" name="user_role" id="user_role">
                                        <option disabled="">Select user role</option>
                                        <?php echo getRoleSelectList($formData["role_id"]) ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>User email<span class="color_required">*</span></label>
                                    <input type="email" class="form-control required" name="useremail" placeholder="User email"  value="<?php echo $formData["user_email"]; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>User Password<span class="color_required">*</span></label>
                                    <div class="">
                                        <input type="password" class="form-control pwdonly required" name="userpassword" id="password" placeholder="User password"  value="<?php echo decode($formData["user_password"]); ?>">
                                        <button id="toggleBtn" class="fa fa-eye toggler-ico" type="button">&nbsp;</button>
                                    </div>

                                </div>
                                <div class="box-body">
                                <div class="form-group">
                                    <label>AIISH Center<span class="color_required">*</span></label>
                                    <select class="form-control" id="aiishId" name="aiishId"><option disabled selected value>Select AIISH Center</option><?php echo getAIISHSelectList($formData["aiish_id"]) ?></select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Hospital State<span class="color_required">*</span></label>
                                    <select id="stateId" class="form-control required" name="stateId" onChange="getState(this.value)"><option disabled selected value>Select District</option><?php echo getStateSelectList($formData["state_id"]) ?></select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Hospital District<span class="color_required">*</span></label>
                                    <div id="statediv"><select class="form-control" name='district' id='district' >
                                    <?php $district = !empty($formData["district_id"])? "".getDistrictSelectList($formData["district_id"])."":"<option disabled selected value>Select District</option>"; 
                                        echo $district;
                                    ?>
                                </select></div>
                                </div>
                            </div>
                            </div><!-- /.box-body -->
                        </div>
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            <div class="row">
                                <div class="col-xs-12"><h4><span class="label label-danger" id="AddUserRequired"></span></h4><hr /></div>
                                <div class="col-md-5">
                                    <div class="pull-right">
                                        <input type="hidden" name="user_id" value="<?php echo $formData["user_id"]; ?>">
                                        <button type="submit" name="submitUsrInfo" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                                </div>
                            </div>
                        </div><!-- /.box-footer -->
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>


<script>
    var open = 'fa-eye';
    var close = 'fa-eye-slash';
    var ele = document.getElementById('password');

    document.getElementById('toggleBtn').onclick = function() {
            if( this.classList.contains(open) ) {
            ele.type="text";
        this.classList.remove(open);
        this.className += ' '+close;
      } else {
            ele.type="password";
        this.classList.remove(close);
        this.className += ' '+open;
      }
    };
</script>

<script>
$("document").ready(function() {
        $('#userSubmit').submit(function() {
            userFormSubmit();
            return false;
        });
});

function userFormSubmit() {
       var errors = '';

        // Validate Metrics Date
        var userName = $("#userSubmit [name='username']").val();
        var useRole = $("#userSubmit [name='user_role']").val();
        var userEmail = $("#userSubmit [name='useremail']").val();
        var userPassword = $("#userSubmit [name='userpassword']").val();
        var aiishcenter = $("#userSubmit [name='aiishId']").val();
        var stateId = $("#userSubmit [name='stateId']").val();
        var distId = $("#userSubmit [name='district']").val();
        var userId = $("#userSubmit [name='user_id']").val();
        
        if (userName == "" || useRole == "" || userEmail == "" || userPassword == "" || aiishcenter == null || stateId == null || distId == null) {
                errors += 'Please enter all the required fields\n';
        }
// MORE FORM VALIDATIONS
        if (errors) {
               $("#AddUserRequired").text(errors+".");
                return false;
        } else {
                // Submit our form via Ajax and then reset the form
                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitAddUser.php',
                    data: {user_name: userName, user_role: useRole, user_email: userEmail, user_password: userPassword, aiish_center: aiishcenter, state: stateId, dist: distId, user_id: userId},
                    cache: false,
                    success: function (data) {
                        $(location).attr('href', Root+'add-user');
                        
                    }
                });
//                $("#hospitalSubmit").ajaxSubmit({success:showResult}).resetForm();
                
        }

}
</script>