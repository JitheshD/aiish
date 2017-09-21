<?php
$formData = SubmitRole($_POST, $_PID);
//$count = getRoleCount();
?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Create New Role</h1>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active"><i class="fa fa-user-md"></i>create-role</li>
    </ol>
</section>
<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header form-group">
                        <button class="btn btn-default add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                            Add New Role <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Role created date</th>
                                    <th>Role created by</th>
                                    <th>Role Last updated date</th>
                                    <th>Role Last updated by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getRoleList(); ?>

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
if (!empty($_PID["create-role"])) {
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
                <h4 class="modal-title" id="myModalLabel">Role</h4>
            </div>
            <div class="modal-body">
                <form  role="form" id="createRoleSubmit" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Role Type Name</label>
                                    <input type="text" class="form-control required charOnly" name="roleName" placeholder="Role Type"  value="<?php echo $formData["role_type"]; ?>" />
                                </div>
                                
                            </div><!-- /.box-body -->
                        </div>
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            <div class="row">
                                <div class="col-xs-12"><h4><span class="label label-danger" id="createRoleRequired"></span></h4><hr /></div>
                                <div class="col-xs-12"></div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <input type="hidden" name="role_id" value="<?php echo $formData["role_id"]; ?>">
                                        <button type="submit" name="SubmitRole" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
$("document").ready(function() {
        $('#createRoleSubmit').submit(function() {
            createRoleFormSubmit();
            return false;
        });
});

function createRoleFormSubmit() {
       var errors = '';

        // Validate Metrics Date
        var role_name = $("#createRoleSubmit [name='roleName']").val();
        
        var roleId = $("#createRoleSubmit [name='role_id']").val();
        
        
        if (role_name == "") {
                errors += 'Please enter all the required fields\n';
        }
// MORE FORM VALIDATIONS
        if (errors) {
               $("#createRoleRequired").text(errors+".");
                return false;
        } else {
                // Submit our form via Ajax and then reset the form
                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitCreateRole.php',
                    data: {roleName: role_name, role_id: roleId},
                    cache: false,
                    success: function (data) {
                        $(location).attr('href', Root+'create-role');
                        
                    }
                });
//                $("#hospitalSubmit").ajaxSubmit({success:showResult}).resetForm();
                
        }

}
</script>
