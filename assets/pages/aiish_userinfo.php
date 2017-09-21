<?php
$_PID = "";
$formData = ToDoUserForm($_POST, $_PID, $_FILES);
//$count = getUserCount();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            User Info
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>   
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        
                        <div class="box-header">
                            <button class="btn btn-green add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                                Add New <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <?php echo getSessionMsg() ?>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo getUserList(); ?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
    </section>
</div>
<!-- /.content-wrapper -->

<?php 
    if(!empty($_PID["user"])){
        echo "<script>
                jQuery('document').ready(function (){
                    $('.bs-example-modal-left').modal('show');
                });
            </script>";
    }

?>

<div class="modal fade modal-aside horizontal left bs-example-modal-left"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">User Profile Detail</h4>
            </div>
            <div class="modal-body">
                <form  role="form" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <div class="row">    
                        <div class="col-md-10">
                            <div class="box-body">
                                <?php echo getSessionMsg(); ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control required" name="name" placeholder="User Name"  value="<?php echo $formData["userName"]; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control required" name="email" placeholder="User Email : " value="<?php echo $formData["userEmail"]; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control required" name="password" placeholder="Password"  value="<?php echo (!empty($formData["user_password"])) ? decode($formData["user_password"]) : ""; ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>User role</label>
                                    <select class="form-control required" name="user_role" > <?php echo getAuthSelectList($formData["userRole"]); ?></select>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            <div class="row">
                                <div class="col-xs-12"><hr /></div>
                                <div class="col-md-5">
                                    <div class="pull-right">
                                        <input type="hidden" name="user_id" value="<?php echo $formData["userId"]; ?>">
                                        <button type="submit" name="SubmitUser" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
