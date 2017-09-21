<?php
$formData = SubmitHospital($_POST, $_PID);
?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Add new Hospital</h1>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active"><i class="fa fa-user-md"></i>add-hospital</li>
    </ol>
</section>
<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header form-group">
                        <button class="btn btn-default add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                            Add New Hospital <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>Hospital Name</th>
                                    <th>Hospital Abbreviation</th>
                                    <th>AIISH Center</th>
                                    <th>Hospital State</th>
                                    <th>Hospital District</th>
                                    <th>Hospital created by</th>
                                    <th>Hospital created on</th>
                                    <th>Hospital updated by</th>
                                    <th>Hospital updated on</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getHospitalList(); ?>

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
if (!empty($_PID["add-hospital"])) {
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
                <h4 class="modal-title" id="myModalLabel">Add new Hospital</h4>
            </div>
            <div class="modal-body">
                <form  role="form" id="hospitalSubmit" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <fieldset>
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Hospital Name<span class="color_required">*</span></label>
                                    <input type="text" class="form-control required charOnly " name="hospitalName" placeholder="Hospital Name"  value="<?php echo $formData["hosp_name"]; ?>" />
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Hospital Abbreviation<span class="color_required">*</span></label>
                                    <input type="text" class="form-control required abbrChar" minlength="3" maxlength="4" title="Capital character only" onchange="chkDublicateHospAbbr(this.value)" name="hospAbb" placeholder="Hospital Abbreviation"  value="<?php echo $formData["hosp_abbr"]; ?>" />
                                    <span class="fa fa-info color_info">.Capital letter only</span>
                                    <p><span id="errorWarning" class="error"></span></p>
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
                                    <select id="stateId" class="form-control required" name="stateId" onChange="getState(this.value)"><option disabled selected value>Select District</option><?php echo getStateSelectList($formData["hosp_state_id"]) ?></select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Hospital District<span class="color_required">*</span></label>
                                    <div id="statediv"><select class="form-control" name='district' id='district' >
                                    <?php $district = !empty($formData["hosp_dist_id"])? "".getDistrictSelectList($formData["hosp_dist_id"])."":"<option disabled selected value>Select District</option>"; 
                                        echo $district;
                                    ?>
                                </select></div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            
                            <div class="row">
                                
                                <div class="col-md-12"><h4><span class="label label-danger" id="HospitalRequired"></span></h4><hr /></div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <input type="text" name="hospID" hidden="" value="<?php echo $formData["hosp_id"]; ?>">
                                        <button type="submit" name="submitHospitalInfo" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                                </div>
                            </div>
                        </div><!-- /.box-footer -->
                    </div>
                    </fieldset>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
$("document").ready(function() {
        $('#hospitalSubmit').submit(function() {
            checkDublicateResult();
            return false;
        });
});

function checkDublicateResult() {
       var errors = '';

        // Validate Metrics Date
        var hospitalName = $("#hospitalSubmit [name='hospitalName']").val();
        var hospitalAbbr = $("#hospitalSubmit [name='hospAbb']").val();
        var aiishcenter = $("#hospitalSubmit [name='aiishId']").val();
        var stateId = $("#hospitalSubmit [name='stateId']").val();
        var distId = $("#hospitalSubmit [name='district']").val();
        var hospitalId = $("#hospitalSubmit [name='hospID']").val();
        
        if (hospitalName == "" || hospitalAbbr == "" || stateId == null || distId == null) {
                errors += 'Please enter all the required fields\n';
        }
// MORE FORM VALIDATIONS
        if (errors) {
               $("#HospitalRequired").text(errors+".");
                return false;
        } else {
                // Submit our form via Ajax and then reset the form
                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitHospital.php',
                    data: {hospName: hospitalName, hospAbbr: hospitalAbbr, aiish_Center: aiishcenter, state: stateId, dist: distId, hospId: hospitalId},
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        //alert(data);
                        if ($.trim(data) === "error") {
                                $("#errorWarning").text("Abbreviation already exists.");
//                                alert("Abbreviation already exists.");
                                return false;
                        }
                        else{
                           
                          $(location).attr('href', Root+'add-hospital');
                            //return false;
                        }
                    }
                });
//                $("#hospitalSubmit").ajaxSubmit({success:showResult}).resetForm();
                
        }

}
</script>