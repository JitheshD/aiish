<?php
$formData = SubmitDistrict($_POST, $_PID);
//$count = getDistrictCount();
?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Add new District</h1>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active"><i class="fa fa-user-md"></i>add-district</li>
    </ol>
</section>
<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header form-group">
                        <button class="btn btn-default add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                            Add New District <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>District name</th>
                                    <th>State name</th>
                                    <th>District created date</th>
                                    <th>District created by</th>
                                    <th>District last updated date</th>
                                    <th>District last updated by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getDistrictList(); ?>

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
if (!empty($_PID["add-district"])) {
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
                <h4 class="modal-title" id="myModalLabel">Add new district</h4>
            </div>
            <div class="modal-body">
                <form  role="form" id="districtSubmit" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>District name</label>
                                    <input type="text" class="form-control required charOnly" name="distname" placeholder="District name"  value="<?php echo $formData["distname"]; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>State name</label>
                                    <select class="form-control" name="state" id="state">
                                        <option disabled selected="">Select State</option>
                                        <?php echo getStateSelectList($formData["state_id"]) ?>
                                    </select>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            <div class="row">
                                <div class="col-xs-12"><h4><span class="label label-danger" id="AddDistrictRequired"></span></h4><hr /></div>
                                <div class="col-xs-12"></div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <input type="hidden" name="district_id" value="<?php echo $formData["dist_id"]; ?>">
                                        <button type="submit" name="submitDistInfo" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
        $('#districtSubmit').submit(function() {
            addDistrictFormSubmit();
            return false;
        });
});

function addDistrictFormSubmit() {
       var errors = '';

        // Validate Metrics Date
        var district = $("#districtSubmit [name='distname']").val();
        var stateId = $("#districtSubmit [name='state']").val();
        var districtId = $("#districtSubmit [name='district_id']").val();
        
        
        if (district == "" || stateId == "") {
                errors += 'Please enter all the required fields\n';
        }
// MORE FORM VALIDATIONS
        if (errors) {
               $("#AddDistrictRequired").text(errors+".");
                return false;
        } else {
                // Submit our form via Ajax and then reset the form
                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitAddDistrict.php',
                    data: {districtName: district,state_id: stateId, district_id: districtId},
                    cache: false,
                    success: function (data) {
                        $(location).attr('href', Root+'add-district');
                        
                    }
                });
//                $("#hospitalSubmit").ajaxSubmit({success:showResult}).resetForm();
                
        }

}
</script>