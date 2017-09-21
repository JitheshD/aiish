<?php
$formData = SubmitTaluk($_POST, $_PID);
//$count = getDistrictCount();
?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Add new Taluk</h1>
            </div>
        </div>
    </div>
</div>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active"><i class="fa fa-user-md"></i>add-taluk</li>
    </ol>
</section>
<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header form-group">
                        <button class="btn btn-default add-row" data-toggle="modal" data-target=".bs-example-modal-left" onclick="$('input').val('')">
                            Add New Taluk <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-hover table-bordered results">
                            <thead>
                                <tr>
                                    <th>Taluk name</th>
                                    <th>State name</th>
                                    <th>District name</th>
                                    <th>Taluk created date</th>
                                    <th>Taluk created by</th>
                                    <th>Taluk last updated date</th>
                                    <th>Taluk last updated by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getTalukList(); ?>

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
if (!empty($_PID["add-taluk"])) {
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
                <h4 class="modal-title" id="myModalLabel">Add new taluk</h4>
            </div>
            <div class="modal-body">
                <form  role="form" id="talukSubmit" action="<?php echo HostRoot . $page_name; ?>" method="POST" onsubmit="return validate()">
                    <div class="row">    
                        <div class="col-md-10">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Taluk name</label>
                                    <input type="text" class="form-control required charOnly" name="talqname" placeholder="Taluk name"  value="<?php echo $formData["cityname"]; ?>" />
                                </div>
                                <div class="form-group">
                                    <label>State name</label>
                                    <select class="form-control" name="state" id="state" onChange="getState(this.value)">
                                        <option disabled selected value>Select State</option>
                                        <?php echo getStateSelectList($formData["state_id"]) ?>
                                    </select>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                        
                        <div class="col-md-10">
                            <!--<div class="form-group">-->
                            <label class="control-label">District</label>
                            <div id="statediv"><select class="form-control" name='district' id='district' >
                                    <?php $district = !empty($formData["dist_id"])? "".getDistrictSelectList($formData["dist_id"])."":"<option disabled selected value>Select District</option>"; 
                                        echo $district;
                                    ?>
                                </select></div>
                        </div> 
                        

                        <div class="box-footer">
                            <!--<hr />-->
                            <div class="row">
                                <div class="col-xs-12"><h4><span class="label label-danger" id="AddTalqRequired"></span></h4><hr /></div>
                                <div class="col-xs-12"></div>
                                <div class="col-md-5">
                                    <div class="pull-right">
                                        <input type="hidden" name="talq_id" value="<?php echo $formData["city_id"]; ?>">
                                        <button type="submit" name="submitTalqInfo" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
$("document").ready(function() {
        $('#talukSubmit').submit(function() {
            addTalukFormSubmit();
            return false;
        });
});

function addTalukFormSubmit() {
       var errors = '';

        // Validate Metrics Date
        var talq_name = $("#talukSubmit [name='talqname']").val();
        var state_id = $("#talukSubmit [name='state']").val();
        var districtId = $("#talukSubmit [name='district']").val();
        var talqId = $("#talukSubmit [name='talq_id']").val();
        
        
        if (talq_name == "" || state_id == "" || districtId == ""  ) {
                errors += 'Please enter all the required fields\n';
        }
// MORE FORM VALIDATIONS
        if (errors) {
               $("#AddTalqRequired").text(errors+".");
                return false;
        } else {
                // Submit our form via Ajax and then reset the form
                $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitAddTaluk.php',
                    data: {talqName: talq_name, stateId: state_id, district_id: districtId, talq_id: talqId},
                    cache: false,
                    success: function (data) {
                        $(location).attr('href', Root+'add-taluk');
                        
                    }
                });
//                $("#hospitalSubmit").ajaxSubmit({success:showResult}).resetForm();
                
        }

}
</script>

<!--<script>
    function getState(countryId) {
        var strURL = Root + "assets/ajax/findState.php?country=" + countryId;
        var req = getXMLHTTP();
        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    
                    if (req.status == 200) {
                        document.getElementById('statediv').innerHTML = req.responseText;

                    } else {
                        alert("Problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }

    function getXMLHTTP() { //fuction to return the xml http object
            var xmlhttp = false;
            try {
                xmlhttp = new XMLHttpRequest();
            } catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e1) {
                        xmlhttp = false;
                    }
                }
            }

            return xmlhttp;
        }
</script>-->
