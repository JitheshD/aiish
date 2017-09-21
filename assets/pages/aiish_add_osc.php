<?php
$formData = SubmitOSCenter($_POST, $_PID);
?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Add new OS Center</h1>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active"><i class="fa fa-user-md"></i>add-OSC</li>
    </ol>
</section>
<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header form-group">
                        <button class="btn btn-default add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                            Add New OS Centers <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>OSC Name</th>
                                    <th>AIISH Center</th>
                                    <th>OSC State</th>
                                    <th>OSC District</th>
                                    <th>OSC created by</th>
                                    <th>OSC created on</th>
                                    <th>OSC updated by</th>
                                    <th>OSC updated on</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getOSCenterList(); ?>

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
if (!empty($_PID["add-osc"])) {
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
                <h4 class="modal-title" id="myModalLabel">Add new OS Center</h4>
            </div>
            <div class="modal-body">
                <form  role="form" id="oscSubmit" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>OS Center Name</label>
                                    <input type="text" class="form-control required charOnly" name="oscName" placeholder="OSC Center"  value="<?php echo $formData["osc_names"]; ?>" />
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>AIISH Center</label>
                                    <select id="aiishID" name="aiishID" class="form-control"><option disabled selected value> Select AIISH Center</option><?php echo getAIISHSelectList($formData["aiish_id"]) ?></select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>OSC State</label>
                                    <select id="stateId" class="form-control required" name="stateId" onChange="getState(this.value)"><option disabled selected value>Select State</option><?php echo getStateSelectList($formData["osc_state_id"]) ?></select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>OSC District</label>
                                    <div id="statediv"><select class="form-control" name='district' id='district' >
                                    <?php $district = !empty($formData["osc_district_id"])? "".getDistrictSelectList($formData["osc_district_id"])."":"<option disabled selected value>Select District</option>"; 
                                        echo $district;
                                    ?>
                                </select></div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            <div class="row">
                                <div class="col-xs-12"><h4><span class="label label-danger" id="AddOSCRequired"></span></h4><hr /></div>
                                <div class="col-xs-12"></div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <input type="text" name="oscId" hidden="" value="<?php echo $formData["osc_id"]; ?>">
                                        <button type="submit" name="submitOSCInfo" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
        $('#oscSubmit').submit(function() {
            addOSCFormSubmit();
            return false;
        });
});

function addOSCFormSubmit() {
       var errors = '';

        // Validate Metrics Date
        var osc_name = $("#oscSubmit [name='oscName']").val();
        var aiish_id = $("#oscSubmit [name='aiishID']").val();
        var state_id = $("#oscSubmit [name='stateId']").val();
        var districtId = $("#oscSubmit [name='district']").val();
        var osc_id = $("#oscSubmit [name='oscId']").val();
        
        
        if (osc_name == "" ||aiish_id == "" || state_id == "" || districtId == "" ) {
                errors += 'Please enter all the required fields\n';
        }
// MORE FORM VALIDATIONS
        if (errors) {
               $("#AddOSCRequired").text(errors+".");
                return false;
        } else {
                // Submit our form via Ajax and then reset the form
                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitAddOSC.php',
                    data: {oscName: osc_name, aiishId: aiish_id, stateId: state_id, district_id: districtId, oscId: osc_id},
                    cache: false,
                    success: function (data) {
                        $(location).attr('href', Root+'add-osc');
                        
                    }
                });
//                $("#hospitalSubmit").ajaxSubmit({success:showResult}).resetForm();
                
        }

}
</script>