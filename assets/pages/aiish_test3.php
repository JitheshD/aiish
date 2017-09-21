<?php
//$formData1 = getScreeningProgramData($_POST);
//$formData = toDoSubmitScreening($_POST,$_GET,$_PID);
$patientId = $_PID["data-entry"];

//$formData = getPatientInfo($patientId);
$formData = getPatientInfo($_POST, $_PID);
$formData1 = getStep2Info($_POST, $_PID);
$formData2 = getStep3Info($_POST, $_PID);
$patientStatus = $formData["patient_status"];
if(!empty($patientId) && $patientStatus != "1"){
    redirect(HostRoot."screening-list");
}


?>


<style type="text/css">

    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
</style>


<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
<?php if (USERAUTH == 1) { ?><h1>Administrator home</h1><?php } else { ?><h1>Medical Officer Page</h1><?php } ?>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">
        <div class="stepwizard col-md-offset-1">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Demographic Details</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>HRR Details</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Screening Test</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p>Impression</p>
                </div>
            </div>
        </div>
        <form role="form" name="birthday" action="" method="post">
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12 col-md-offset-1">

                    <div class="col-md-12 ">
                        <h3> 1. Demographic Details:</h3>
                        <div class="col-md-3 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">Hospital name</label>
                            <select name="hospital" id="jelectHosp" size="1" class="form-control" onchange="copyValue()">
                                <?php echo HospitalSelectOption($formData["Hospital_Name"]);?>
                            </select>
                        </div>   
                        <div id="autogen">
                            <div class="col-md-3 col-md-offset-1" id="bid">
                                <!--<div class="form-group">-->
                                <label class="control-label">Baby identification no.</label>
                                <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                                <?php
                                if (!empty($patientId)) {
                                    //$a = $_SESSION['baby_id'];
                                    //                            echo $a;

                                    echo "<input type='text' size='10' name='baby_id_num' class='form-control'  readonly='' id='baby_id_num' value='{$formData["baby_id_num"]}' >";
                                } else {
                                    echo '<input type="text"  size="10" readonly="" name="baby_id_num" class="form-control"  id="baby_id_num">';
                                }
                                ?>
                                <!--</div>-->
                            </div>  
                            <div class="col-md-3 col-md-offset-1">
                                <!--<div class="form-group">-->
                                <label class="control-label">POCD</label>
                                <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                                <input type="text" size="10" name="pocd_no" class="form-control" readonly=""  id="pocd_no" value="<?php echo $formData["POCD_No"] ?>"  required>
                                <!--</div>-->
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="col-md-3 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">Baby Name:</label>
                            <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                            <input type="text" size="10" name="babyName" class="form-control" id="babyName" value="<?php echo $formData["Baby_name"] ?>"  required>
                            <!--</div>-->
                        </div>
                        
                        <div class="col-md-3 col-md-offset-1">
                            <label class="control-label">Birth Date</label>
                            <input type="text" class="form-control datetimepicker" name="birthdate" id="birthdate" onchange="getAgeByBirthDate(this.value)" value="<?php echo $formData["Date_of_Birth"] ?>">
                        </div>
                        
                        

                        <div class="col-md-3 col-md-offset-1" id="age">
                            <label  name="age">Age</label>
                            <?php //$age = !empty($patientId)? "<input name='age' id='age' class='form-control' size='40' readonly='' value='{$formData["Age"]}'>":"<input name='age' id='age' class='form-control' size='40' readonly='' value=''>"; 
                             // echo $age;  
                             ?>
                            <input name="age" class="form-control" id="baby_age" size="40" readonly="" value="<?php echo $formData["Age"]; ?>">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">Father Name</label>
                            <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                            <input type="text" size="10" name="father" class="form-control"  id="father" value="<?php echo $formData["Father_name"] ?>"  required>
                            <!--</div>-->
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">Mother Name</label>
                            <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                            <input type="text" size="10" name="mother" class="form-control" id="mother" value="<?php echo $formData["Mother_name"]  ?>" required>
                            <!--</div>-->
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">Conatct no.</label>
                            <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                            <input type="text" size="10" name="contact_no" class="form-control" id="contact_no" value="<?php echo $formData["Phone_number"] ?>"  required>
                            <!--</div>-->
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">Email ID</label>
                            <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                            <input type="email" size="10" name="email" class="form-control" id="email" value="<?php echo $formData["Email_id"] ?>" required>
                            <!--</div>-->
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4 col-md-offset-1 form-group ">
                            <!--<div class="form-group">-->
                            <label class="control-label">Gender</label><br>
                            <!--<input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />-->
                            <?php if(!empty($patientId)){ 
                                $male = ($formData["Gender"] == "male")?"<label class='control-label radio-inline'><input type='radio' size='' name='gender' class=' ' id='male' value='male' checked='' >Male</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='gender' class=' ' id='male' value='male'  >Male</label>";
                                echo $male;
                                $female = ($formData["Gender"] == "female")?"<label class='control-label radio-inline'><input type='radio' size='' name='gender' class='' id='female' checked='' value='female'  >Female</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='gender' class='' id='female' value='female'  >Female</label>";
                                echo $female;
                                $transgender = ($formData["Gender"] == "transgender")?"<label class='control-label radio-inline'><input type='radio' size='' name='gender' class='' id='transgender' checked='' value='transgender' >Transgender</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='gender' class='' id='transgender' value='transgender' >Transgender</label>";
                            }
                            else{?>
                            <label class="control-label radio-inline"><input type="radio" size="" name="gender" class=" " id="male" value="male"  >Male</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="gender" class="" id="female" value="female"  >Female</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="gender" class="" id="transgender" value="transgender" >Transgender</label>
                            <?php } ?>
                            <!--</div>-->
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">State</label>
                            <select class="form-control" name='state' id='state' onChange="getState(this.value)">
                                <?php echo getStateSelectList($formData["state_id"]) ?>
                            </select>
                        </div> 
                        <div class="col-md-2 col-md-offset-1">
                            <!--<div class="form-group">-->
                            <label class="control-label">District</label>
                            <div id="statediv"><select class="form-control" name='state_up' id='district' onchange='getCity(<?php $formData["district_id"] ?>,this.value)' >
                                    <?php $district = !empty($formData["district_id"])? "".getDistrictSelectList($formData["district_id"])."":"<option>Select District</option>"; 
                                        echo $district;
                                    ?>
                                </select></div>
                        </div> 
                        <div class="col-md-2 col-md-offset-1">
                            <label class="control-label">Taluk</label>

                            <div id="citydiv">
                                <select class="form-control" name="city" id="city" >
                                    <?php $city = !empty($formData["city_id"])? "".getCitySelectList($formData["city_id"])."":"<option>Select Taluk</option>"; ?>
                                    <?php echo $city; ?>
                                    <!--<option value="">-----Select-----</option>-->

                                </select>
                            </div>

                        </div>


                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-offset-1">
                            <label class="control-label">Present Address</label>
                            <textarea class="form-control" name="pre_address" id="pre_address" rows="4"><?php echo $formData["Present_address"] ?></textarea>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3 col-md-offset-1">
                            <label class="checkbox"><input class="" id="sameadd" name="sameadd" type="checkbox" value="Sameadd" onchange="CopyAdd();"/>Check if Same as Present Address<br/></label>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <label class="control-label">Permanent Address</label>
                            <textarea class="form-control" name="per_address" id="per_address" rows="4"><?php echo $formData["Permanent_address"] ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-offset-1">
                            <label  name="">Hospital Name</label>
                            <input name="hospname" id="hospname" class="form-control" size="40" readonly="" value="<?php echo getHospitalNameById($formData["Hospital_Name"] )?>">

                        </div>
                        <div class="col-md-4 col-md-offset-1 form-group ">
                            <!--<div class="form-group">-->
                            <label class="control-label">Delivery Type</label><br>
                            <?php if(!empty($formData["Delivery_type_Name"])){ ?>
                                <?php 
                                    $delnormal = ($formData["Delivery_type_Name"] == "normal")?"<label class='control-label radio-inline'><input type='radio' size='' name='deltype' class=' ' checked='' id='normal' value='normal'>Normal</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='deltype' class=' ' id='normal' value='normal'>Normal</label>";
                                    $cesarean = ($formData["Delivery_type_Name"] == "cesarean")?"<label class='control-label radio-inline'><input type='radio' size='' name='deltype' class=' ' checked='' id='cesarean' checked='' value='cesarean'>Cesarean</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='deltype' class=' ' id='cesarean' value='cesarean'>Cesarean</label>";
                                    $home = ($formData["Delivery_type_Name"] == "home")?"<label class='control-label radio-inline'><input type='radio' size='' name='deltype' class=' ' checked='' id='home' checked='' value='home'>Home</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='deltype' class=' '  id='home' value='home'>Home</label>";
                                    echo $delnormal;
                                    echo $cesarean;
                                    echo $home;
                                ?>
                            <?php }else{ ?>
                                <label class="control-label radio-inline"><input type="radio" size="" name="deltype" class=" " checked="" id="normal" value="normal">Normal</label>
                                <label class="control-label radio-inline"><input type="radio" size="" name="deltype" class="" id="cesarean"  value="cesarean">Cesarean</label>
                                <label class="control-label radio-inline"><input type="radio" size="" name="deltype" class="" id="home" value="home">Home</label>
                            <?php } ?>
                                <!--</div>-->
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group ">
                            <label class="control-label">Region</label><br>
                            <?php 
                                if(!empty($formData["Region"])){
                                    $urban = ($formData["Region"] == "Urban")?"<label class='control-label radio-inline'><input type='radio' size='' name='region' checked='' class=' ' value='Urban' id='urban'>Urban</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='region' class='' value='Urban' id='urban'>Urban</label>";
                                    $rural = ($formData["Region"] == "Rural")?"<label class='control-label radio-inline'><input type='radio' size='' name='region' checked = '' class=' ' id='rural' value='Rural' >Rural</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='region' class='' id='rural' value='Rural' >Rural</label>";
                                    echo $urban;
                                    echo $rural;
                                            
                                    
                                }else{?>
                            
                                
                            <!--<div class="form-group">-->
                            
                            <label class="control-label radio-inline"><input type="radio" size="" name="region" checked="" class=" " value="Urban" id="urban">Urban</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="region" class=" " id="rural" value="Rural" >Rural</label>
                            <!--</div>-->
                                <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4 col-md-offset-1 form-group ">
                            <!--<div class="form-group">-->
                            <label class="control-label">Religion</label><br>
                            <?php 
                            if(!empty($formData["Religion"])){
                                $hindu = ($formData["Religion"] == "Hindu")?"<label class='control-label radio-inline'><input type='radio' size='' name='religion' checked='' class=' ' id='hindu' value='hindu'>Hindu</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='religion' class=' ' id='hindu' value='hindu'>Hindu</label>";
                                $muslim = ($formData["Religion"] == "Muslims")?"<label class='control-label radio-inline'><input type='radio' size='' name='religion' checked='' class=' ' id='muslim' value='muslim' >Muslim</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='religion' class=' ' id='muslim' value='muslim' >Muslim</label>";
                                $christian = ($formData["Religion"] == "Christian")?"<label class='control-label radio-inline'><input type='radio' size='' name='religion' checked='' class=' ' id='christian' value='christian' >Christian</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='religion' class=' ' id='christian' value='christian' >Christian</label>";
                                $other = ($formData["Religion"] == "Others")?"<label class='control-label radio-inline'><input type='radio' size='' name='religion' class=' ' checked='' id='others' value='other'>Others</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='religion' class=' ' id='others' value='other'>Others</label>";
                            
                                echo $hindu;
                                echo $muslim;
                                echo $christian;
                                echo $other;
                            }
                            else{
                            ?>
                            <label class="control-label radio-inline"><input type="radio" size="" name="religion" checked="" class=" " id="hindu" value="hindu">Hindu</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="religion" class=" " id="muslim" value="muslim" >Muslim</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="religion" class=" " id="christian" value="christian" >Christian</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="religion" class=" " id="others" value="other">Others</label>
                            <?php } ?>
                            <!--</div>-->
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group ">
                            <!--<div class="form-group">-->
                            
                            <label class="control-label">Caste</label><br>
                            <?php 
                                if(!empty($formData["Caste"])){
                                    $sc = ($formData["Caste"] == "SC")?"<label class='control-label radio-inline'><input type='radio' size='' name='caste' checked='' class=' ' id='st' value='st'>SC</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='caste' class=' ' id='st' value='st'>ST</label>";
                                    $st = ($formData["Caste"] == "ST")?"<label class='control-label radio-inline'><input type='radio' size='' name='caste' checked='' class=' ' id='sc' value='sc' >ST</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='caste' class=' ' id='sc' value='sc' >SC</label>";
                                    $obc = ($formData["Caste"] == "OBC")?"<label class='control-label radio-inline'><input type='radio' size='' name='caste' checked='' class=' ' id='obc' value='obc' >OBC</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='caste' class=' ' id='obc' value='obc' >OBC</label>";
                                    $gm = ($formData["Caste"] == "GM")?"<label class='control-label radio-inline'><input type='radio' size='' name='caste' checked='' class=' ' id='gm' value='gm' >GM</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='caste' class=' ' id='gm' value='gm' >GM</label>";
                                
                                    echo $sc;
                                    echo $st;
                                    echo $obc;
                                    echo $gm;
                                }
                                else{
                            
                            ?>
                            <label class="control-label radio-inline"><input type="radio" size="" name="caste" checked="" class=" " id="st" value="st">ST</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="caste" class=" " id="sc" value="sc" >SC</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="caste" class=" " id="obc" value="obc" >OBC</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="caste" class=" " id="gm" value="gm">GM</label>
                                <?php } ?>
                            <!--</div>-->
                        </div>
                        <div class="col-md-3 col-md-offset-1 form-group ">
                            <!--<div class="form-group">-->
                            <label class="control-label">Socio-Economic status</label><br>
                            <?php
                                echo "Income per month-{$formData["Income_per_month"]}";
                                if(!empty($formData["Income_per_month"])){ 
                                $leser10k = ($formData["Income_per_month"] == "< 10K")?"<label class='control-label radio-inline'><input type='radio' size='' name='socioeco' class=' ' checked='' id='tenk' value='< 10K' >< 10K</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='socioeco' class=' ' id='tenk' value='< 10K' >< 10K</label>";
                                $tento20 = ($formData["Income_per_month"] == "10K to 20K")?"<label class='control-label radio-inline'><input type='radio' size='' name='socioeco' class=' ' checked='' id='tentotwenty' value='10K to 20K' >10K to 20K</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='socioeco' class=' ' id='tentotwenty' value='10K to 20K' >10K to 20K</label>";
                                $greater20k = ($formData["Income_per_month"] == "> 20K")?"<label class='control-label radio-inline'><input type='radio' size='' name='socioeco' class=' ' checked='' id='greatertwenty' value='>20K' >>20K</label>":"<label class='control-label radio-inline'><input type='radio' size='' name='socioeco' class=' ' id='greatertwenty' value='> 20K' >>20K</label>";
                                echo $leser10k;
                                echo $tento20;
                                echo $greater20k;
                            }
                            else{    ?>                          
                            <label class="control-label radio-inline"><input type="radio" size="" name="socioeco" class=" " checked="" id="tenk" value="< 10K" >< 10K</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="socioeco" class=" " id="tentotwenty" value="10K to 20K" >10K to 20K</label>
                            <label class="control-label radio-inline"><input type="radio" size="" name="socioeco" class=" " id="greatertwenty" value=">20K" >>20K</label>
                            <?php } ?>
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-offset-1 form-group ">
                            <label class="control-label">Any Medical History</label>
                            <label class="checkbox"><input class="" id="medhistory" name="medhistory" type="checkbox" value="Sameadd" onclick="ShowHideDiv(this)"/>If present check<br/></label>
                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <label  name=""><strong>Staff Name</strong></label>
                            <input name="staffname" id="staffname" class="form-control" size="40" readonly="" value="<?php echo USERFULLNAME ?>">

                        </div>
                        <div class="col-md-3 col-md-offset-1">
                            <label  name="">Date of Screening</label>
                            <input name="screendate" id="screendate" class="form-control datetimepicker" size="40" value="<?php echo $formData["Date_of_HRR_Screen"] ?>">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3 col-md-offset-1 form-group " id="dvPassport" style="display: none">
                            <textarea class="form-control" name="med_history" id="med_history" rows="4"><?php echo $formData["Medical_history"] ?></textarea>
                        </div>
                    </div>
                    <div id="patUniqId">
                        <input type="text" hidden="" name="pat_id" id="pat_id" value="<?php echo $patientId ?>">
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" onclick="submitPatientDetails()" type="button" >Next</button>
                </div>
                <!--</div>-->
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-12 col-md-offset-1">
                    <div class="col-md-12">
                        <h3> Screening Test1</h3>
                        <div class="col-md-12">
                            <?php// if(!empty($formData["prenatal_id"]) || !empty($formData["natal_id"]) || !empty($formData["postnatal_id"]) || !empty($formData["other_id"])){ ?>
                            <?php if(!empty($patientId) && $formData1["hrr_type"] == 1){ ?>
                                <div class="col-md-5 col-md-offset-1 form-group ">
                                    <label class="control-label radio hrr1"><input type="radio" size="" name="subscribe" checked="" class="subscribe " value="1" id="pesenceid" >Presence of HRR</label>
                                </div>
                            <?php }else{ ?>
                            <div class="col-md-5 col-md-offset-1 form-group ">
                                <label class="control-label radio hrr1"><input type="radio" size="" name="subscribe" class="subscribe " value="1" id="pesencehrr" >Presence of HRR</label>
                            </div>
                            <?php } 
                            //if(empty($formData["prenatal_id"])&& empty($formData["natal_id"]) && empty($formData["postnatal_id"]) && empty($formData["other_id"])){
                            if(!empty($patientId) && $formData1["hrr_type"] == 2){
                            ?>
                            <div class="col-md-5 col-md-offset-1 form-group pull-right ">
                                <label class="control-label radio-inline hrr2"><input type="radio" size="" name="subscribe" class="ssubscribe" checked="" value="2" id="absencehrr" >Absence of HRR</label>
                            </div>
                            <?php }else{ ?>
                            <div class="col-md-5 col-md-offset-1 form-group pull-right ">
                                    <label class="control-label radio-inline hrr2"><input type="radio" size="" name="subscribe" class="ssubscribe" value="2" id="absenceid" >Absence of HRR</label>
                            </div>
                            <?php } ?>
                        </div>
                        <?php $conditionally_load = ($formData1["hrr_type"] == 2 )? "conditionally-loaded":" " ?>
                        <div class="col-md-12 <?php echo $conditionally_load ?>" id="prenatalDv">
                            <div class="col-md-2 col-md-offset-1 " style="background-color: rgba(0, 178, 0, 0.3)">
                                <?php $preNatal = (!empty($formData1["prenatal_id"]))?"<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe1' class=' ' checked='' id='prenatalhrr' value='1' >Pre Natal HRR</label>":"<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe1' class=' '  id='prenatalhrr' value='1' >Pre Natal HRR</label>"; 
                                      echo $preNatal;  
                                ?>
                            </div>
                            <div class="col-md-2 col-md-offset-1 " style="background-color: rgba(22, 91, 168, 0.35);">
                                <?php $natal = (!empty($formData1["natal_id"]))? "<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe2' class=' '  id='natalhrr' checked='' value='1' > Natal HRR</label>":"<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe2' class=' '  id='natalhrr' value='1' > Natal HRR</label>"; 
                                echo $natal;
                                ?>
                                <!--<label class="control-label checkbox-inline hrr1"><input type="checkbox" size="" name="subscribe2" class=" "  id="natalhrr" value="1" > Natal HRR</label>-->
                            </div>
                            <div class="col-md-3 col-md-offset-1 " style="background-color: rgba(245, 59, 38, 0.42);">
                                <?php $post_natal = (!empty($formData1["postnatal_id"]))? "<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe3' class=' ' checked='' id='postnatal' value='1' >Post Natal HRR</label>":"<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe3' class=' '  id='postnatal' value='1' >Post Natal HRR</label>"; 
                                     echo $post_natal;   
                                ?> 
                                <!--<label class="control-label checkbox-inline hrr1"><input type="checkbox" size="" name="subscribe3" class=" "  id="postnatal" value="1" >Post Natal HRR</label>-->
                            </div>
                            <div class="col-md-2 col-md-offset-1 " style="background-color: rgba(255, 255, 0, 0.49);">
                                <?php $otherNatal = (!empty($formData1["other_id"]))?"<label class='control-label checkbox-inline hrr1'><input type='checkbox' checked='' size='' name='subscribe4' class=' '  id='other' value='1' >Others HRR</label>":"<label class='control-label checkbox-inline hrr1'><input type='checkbox' size='' name='subscribe4' class=' '  id='other' value='1' >Others HRR</label>";
                                        echo $otherNatal;
                                ?>
                                <!--<label class="control-label checkbox-inline hrr1"><input type="checkbox" size="" name="subscribe4" class=" "  id="other" value="1" >Others HRR</label>-->
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <?php $conditionallyLoad1 = ($formData1["hrr_type"] == 2  )?"conditionally-loaded1":"" ?>
                            <div class="col-md-2 col-md-offset-1 <?php echo $conditionallyLoad1 ?>" style="background-color: rgba(0, 178, 0, 0.3)" >
                                <div class="col-md-12">
                                    <?php $excVomit = ($formData1["excessive_vomiting"] == 1)? "<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='exvomit' class=' ' checked=''  id='exvomit' value='1' >Excessive Vomiting</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='exvomit' class=' '  id='exvomit' value='1' >Excessive Vomiting</label>";  
                                          echo $excVomit;  
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="exvomit" class=" "  id="exvomit" value="1" >Excessive Vomiting</label>-->
                                    <?php $eld_pregnancy = ($formData1["elderly_pregnanacy"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='eldpreg' class=' ' checked = '' id='eldpreg' value='1' >Elderly Pregnancy</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='eldpreg' class=' '  id='eldpreg' value='1' >Elderly Pregnancy</label>" ;
                                            echo $eld_pregnancy;
                                            ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="eldpreg" class=" "  id="eldpreg" value="1" >Elderly Pregnancy</label>-->
                                    <?php $highLowBp = ($formData1["highlow_bp"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='bp' class=' ' checked=''  id='bp' value='1'>High/Low B.P</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='bp' class=' '  id='bp' value='1'>High/Low B.P</label>"; 
                                        echo $highLowBp;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="bp" class=" "  id="bp" value="1">High/Low B.P</label>-->
                                    <?php $bloodSugr = ($formData1["blood_sugar"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='bloodsugar' class=' '  id='bloodsugar' checked='' value='1'>Blood sugar</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='bloodsugar' class=' '  id='bloodsugar' value='1'>Blood sugar</label>"; 
                                        echo $bloodSugr;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="bloodsugar" class=" "  id="bloodsugar" value="1">Blood sugar</label>-->
                                    <?php $ho_abortions = ($formData1["ho_abortions"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='abortion' class=' '  id='abortion' checked=''  value='1'>H/O abortion</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='abortion' class=' '  id='abortion'  value='1'>H/O abortion</label>"; 
                                        echo $ho_abortions;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="abortion" class=" "  id="abortion"  value="1">H/O abortion</label>-->
                                    <?php $rh_incompatitlibility = ($formData1["rh_incompatitlibility"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='rh' class=' '  id='rh' checked='' value='1' >Rh Incompatibility</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='rh' class=' '  id='rh' value='1' >Rh Incompatibility</label>"; 
                                        echo $rh_incompatitlibility;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="rh" class=" "  id="rh" value="1" >Rh Incompatibility</label>-->
                                    <?php $viralbacterial_infections = ($formData1["viralbacterial_infections"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='viralinfection' class=' '  id='viralinfection' checked='' value='1' >Viral/Bacterial Infections</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='viralinfection' class=' '  id='viralinfection' value='1' >Viral/Bacterial Infections</label>"; 
                                        echo $viralbacterial_infections;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="viralinfection" class=" "  id="viralinfection" value="1" >Viral/Bacterial Infections</label>-->
                                    <?php $infections = ($formData1["infection"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='inection' class=' '  id='infection' checked='' value='1' >Infection</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='inection' class=' '  id='infection' value='1' >Infection</label>"; 
                                        echo $infections;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="inection" class=" "  id="infection" value="1" >Infection</label>-->
                                    <?php $oto_tox_med = ($formData1["oto_tox_med"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='otomedication' checked='' class=''  id='otomedication' value='1' >Oto toxic medications</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='otomedication' class=''  id='otomedication' value='1' >Oto toxic medications</label>"; 
                                        echo $oto_tox_med;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="otomedication" class=" "  id="otomedication" value="1" >Oto toxic medications</label>-->
                                    <?php $chem_fum = ($formData1["chem_fum"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='chemfume' class=' '  id='chemfume' checked='' value='1'>Chemical fumes </label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='chemfume' class=' '  id='chemfume' value='1'>Chemical fumes </label>"; 
                                        echo $chem_fum;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="chemfume" class=" "  id="chemfume" value="1">Chemical fumes </label>-->
                                    <?php $alcohol = ($formData1["alcohol"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='alcohol' class=' '  id='alcohol' checked='' value='1' >Alcohol</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='alcohol' class=' '  id='alcohol' value='1' >Alcohol</label>"; 
                                        echo $alcohol;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="alcohol" class=" "  id="alcohol" value="1" >Alcohol</label>-->
                                    <?php $smoking = ($formData1["smoking"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='smoke' class=' '  id='smoke' checked='' value='1' >Smoking </label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='smoke' class=' '  id='smoke' value='1' >Smoking </label>"; 
                                        echo $smoking;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="smoke" class=" "  id="smoke" value="1" >Smoking </label>-->
                                </div>
                            </div>
                            <?php $conditionallyLoad2 = ($formData1["hrr_type"] == 2)?"conditionally-loaded2":"" ?>
                            <div class="col-md-2 col-md-offset-1 <?php echo $conditionallyLoad2 ?>" style="background-color: rgba(22, 91, 168, 0.35);">
                                <div class="col-md-12">
                                    <?php $lbw = ($formData1["lbw"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='weightless' class='group_ctrl' data-group='group_a'  id='weightless' checked='' value='1'>Low Birth Weight<1.5kgs</label>
                                    <p>Birth Weight<input type='text' name='birth_wt' id='birth_wt' style='width:50px' class='group_a' value='{$formData1["birth_wt"]}'>&nbsp; Kg</p> ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='weightless' class='group_ctrl' data-group='group_a'  id='weightless' value='1'>Low Birth Weight<1.5kgs</label>
                                    <p>Birth Weight<input type='text' name='birth_wt' class='group_a' id='birth_wt' style='width:50px' disabled='' value=''>&nbsp; Kg</p> "; 
                                        echo $lbw;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="weightless" class=" "  id="weightless" value="1">Low Birth Weight<1.5kgs</label>
                                    <p>Birth Weight<input type="text" name="birth_wt" id="birth_wt" style="width:50px" value="">&nbsp; Kg</p> -->
                                    <?php $nj = ($formData1["nj"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='jaundice' id='jaundice' checked='' class='group_ctrl' data-group='group_b' value='1' >Neonatal Jaundice</label>
                                    <p>Bilrubin Level<input type='text' style='width:50px' name='bil_level' id='bil_level' class='group_b' value='{$formData1["bilrubin_level"]}'></p> ":
                                        "<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='jaundice' id='jaundice' class='group_ctrl' data-group='group_b' value='1' >Neonatal Jaundice</label>
                                    <p>Bilrubin Level<input type='text' style='width:50px' name='bil_level'  id='bil_level' class='group_b' disabled='' value=''></p> 
                                    <!--<p>Delayed birth Cry<input type='text' name='birthcry' id='birthcry' style='width:50px' value=''>&nbsp;Sec</p> 
                                    <p>Premature Delivery<input type='text' name='prematuredel' id='prematuredel' style='width:50px' value=''>&nbsp;Week</p> -->";
                                        echo $nj;
                                    ?>
                                    
                                    <?php $delayBirthCry = (!empty($formData1["delayed_birth_cry"]))?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='dbcrychk' class='group_ctrl' data-group='group_c'  id='dbcrychk' checked='' value='1'>Delayed birth Cry</label>
                                    <p><input type='text' name='birthCry' id='birthCry' style='width:50px' class='group_c' value='{$formData1["delayed_birth_cry"]}'>&nbsp; Sec</p> ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='dbcrychk' class='group_ctrl' data-group='group_c'  id='dbcrychk' value='1'>Delayed birth Cry</label>
                                    <p><input type='text' name='birthCry' class='group_c' id='birthCry' style='width:50px' disabled='' value=''>&nbsp; Sec</p> "; 
                                        echo $delayBirthCry;
                                    ?>
                                    <?php $prematureDel = (!empty($formData1["premature_delivery_week"]))?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='pdwchk' class='group_ctrl' data-group='group_d'  id='pdwchk' checked='' value='1'>Premature delivery</label>
                                    <p><input type='text' name='prematuredel' id='prematuredel' style='width:50px' class='group_d' value='{$formData1["premature_delivery_week"]}'>&nbsp; Week</p> ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='pdwchk' class='group_ctrl' data-group='group_d'  id='pdwchk' value='1'>Premature Delivery</label>
                                    <p><input type='text' name='prematuredel' class='group_d' id='prematuredel' style='width:50px' disabled='' value=''>&nbsp; Week</p> "; 
                                        echo $prematureDel;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="jaundice" class=" "  id="jaundice" value="1" >Neonatal Jaundice</label>
                                    <p>Bilrubin Level<input type="text" style="width:50px" name="bil_level" id="bil_level" value=""></p> 
                                    <p>Delayed birth Cry<input type="text" name="birthcry" id="birthcry" style="width:50px" value="">&nbsp;Sec</p> 
                                    <p>Premature Delivery<input type="text" name="prematuredel" id="prematuredel" style="width:50px" value="">&nbsp;Week</p> -->
                                    <?php $ba = ($formData1["ba"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='birthasphyxia' class=''  id='birthasphyxia' checked=''  value='1' > Birth asphyxia </label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='birthasphyxia' class=''  id='birthasphyxia' value='1' > Birth asphyxia </label>"; 
                                        echo $ba;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="birthasphyxia" class=""  id="birthasphyxia" value="1" > Birth asphyxia </label>-->
                                    <?php $fd = ($formData1["fd"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='fetaldistress' class=''  id='fetaldistress' checked='' value='1' > Fetal Distress </label>
                                     ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='fetaldistress' class=''  id='fetaldistress' value='1' > Fetal Distress </label> "; 
                                        echo $fd;
                                    ?>
                                    <?php $aaf = ($formData1["aspiration_of_fluid_days"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='aafchk' class=''  id='aafchk' checked='' value='1' > Aspirations of amniotic fluid  </label>
                                     ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='aafchk' class=''  id='aafchk' value='1' >Aspirations of amniotic fluid  </label> "; 
                                        echo $aaf;
                                    ?>
                                    
                                    <?php $nicu = (!empty($formData1["nicu"]))?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='nicuchk' class='group_ctrl' data-group='group_e'  id='nicuchk' checked='' value='1'>NICU</label>
                                    <p><input type='text' name='nicu' id='nicu' style='width:50px' class='group_e' value='{$formData1["nicu"]}'>&nbsp; Week</p> ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='nicuchk' class='group_ctrl' data-group='group_e'  id='nicuchk' value='1'>NICU</label>
                                    <p><input type='text' name='nicu' class='group_e' id='nicu' style='width:50px' disabled='' value=''>&nbsp; Week</p> "; 
                                        echo $nicu;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="fetaldistress" class=""  id="fetaldistress" value="1" > Fetal Distress </label>
                                    <p>Aspirations of amniotic fluid NICU<input type="text" style="width:50px" name="nicu" id="nicu" value=""> days</p>-->
                                    <?php $as_1min = ($formData1["as_1min"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='' class='' name='apgarone' id='apgarone' checked='' value='1' > APGAR Score:0-4@ 1min </label> ":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='' class='' name='apgarone' id='apgarone' value='1' > APGAR Score:0-4@ 1min </label> "; 
                                        echo $as_1min;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="" class="" name="apgarone" id="apgarone" value="1" > APGAR Score:0-4@ 1min </label>-->
                                    <?php $as_5min = ($formData1["as_5min"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='apgarfive' class=''  id='apgarfive' checked='' value='1' > APGAR Score:0-6@ 5mins </label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='apgarfive' class=''  id='apgarfive' value='1' > APGAR Score:0-6@ 5mins </label>"; 
                                        echo $as_5min;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="apgarfive" class=""  id="apgarfive" value="1" > APGAR Score:0-6@ 5mins </label>-->
                                </div>
                            </div>
                            <?php $conditionallyLoad3 = ($formData1["hrr_type"] == 2)?"conditionally-loaded3":"" ?>
                            <div class="col-md-3 col-md-offset-1 <?php echo $conditionallyLoad3 ?>" style="background-color: rgba(245, 59, 38, 0.42);">
                                <div class="col-md-12">
                                    <?php $csa = ($formData1["csa"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='craniofacial' class=' '  id='craniofacial' checked='' value='1' >Craniofacial/structural anamolies</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='craniofacial' class=' '  id='craniofacial' value='1' >Craniofacial/structural anamolies</label>"; 
                                        echo $csa;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="craniofacial" class=" "  id="craniofacial" value="1" >Craniofacial/structural anamolies</label>-->
                                    <?php $ca = ($formData1["ca"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='cogenital' class=' '  id='cogenital' checked='' value='1' >Cogenital anomalies</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='cogenital' class=' '  id='cogenital' value='1' >Cogenital anomalies</label>"; 
                                        echo $ca;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="cogenital" class=" "  id="cogenital" value="1" >Cogenital anomalies</label>-->
                                    <?php $dd = ($formData1["dd"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='degenerative' class=' '  id='degenerative' checked='' value='1' >Degenerative Diseases</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='degenerative' class=' '  id='degenerative' value='1' >Degenerative Diseases</label>"; 
                                        echo $dd;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="degenerative" class=" "  id="degenerative" value="1" >Degenerative Diseases</label>-->
                                    <?php $vbf = ($formData1["vbf"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='viralinfect' class=' '  id='viralinfect' checked='' value='1' >Viral/Bacterial Infections</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='viralinfect' class=' '  id='viralinfect' value='1' >Viral/Bacterial Infections</label>"; 
                                        echo $vbf;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="viralinfect" class=" "  id="viralinfect" value="1" >Viral/Bacterial Infections</label>-->
                                    <?php $cnv = ($formData1["cnv"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='convulsions' class=' '  id='convulsions' cheked=''  value='1'>Convulsions</label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='convulsions' class=' '  id='convulsions'  value='1'>Convulsions</label>"; 
                                        echo $cnv;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="convulsions" class=" "  id="convulsions"  value="1">Convulsions</label>-->
                                    <?php $omwe = ($formData1["omwe"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='otitis' class=' '  id='otitis' checked='' value='1' >Otitis Media with effusion </label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='otitis' class=' '  id='otitis' value='1' >Otitis Media with effusion </label>"; 
                                        echo $omwe;
                                    ?>
                                    <!--<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="otitis" class=" "  id="otitis" value="1" >Otitis Media with effusion </label>-->
                                    <?php $thn = ($formData1["thn"] == 1)?"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='trauma' class=' '  id='trauma' cheked='' value='1'>Trauma_of_head_or_neck </label>":"<label class='control-label checkbox hrr1'><input type='checkbox' size='' name='trauma' class=' '  id='trauma' value='1'>Trauma_of_head_or_neck </label>"; 
                                        echo $thn;
                                    ?>
<!--                                    <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="trauma" class=" "  id="trauma" value="1">Trauma_of_head_or_neck </label>-->
                                </div>
                            </div>
                            <?php $conditionallyLoad4 = ($formData1["hrr_type"] == 2)?"conditionally-loaded4":"" ?>
                            <div class="col-md-2 col-md-offset-1 conditionally-loaded4" style="background-color: rgba(255, 255, 0, 0.49);">
                                <div class="col-md-12">
                                    <h5>Consanguinity</h5>
                                    
                                    <p class="">
                                        <?php $cons_pos_val = ($formData1["cons_pos_val"] == 1)?"<input type='radio' size='' name='pos1' id='posRadio' checked='' value='1'>Poositive &nbsp ":"<input type='radio' size='' name='pos1' id='posRadio' onchange='ShowHideHrr()' value='1'>Poositive &nbsp"; 
                                            echo $cons_pos_val;
                                        ?>
                                        <?php $cons_neg_val = ($formData1["cons_neg_val"] == 1)?"<input type='radio' size='' name='pos1' id='negRadio' checked='' value='2'  >Negative</p> ":"<input type='radio' size='' name='pos1' id='negRadio' value='2' onclick='ShowHideHrr()'  >Negative</p>"; 
                                            echo $cons_neg_val;
                                        ?>
<!--                                        <input type="radio" size="" name="pos1" id="posRadio" onchange="ShowHideHrr()" value="1">Poositive &nbsp 
                                        <input type="radio" size="" name="pos1" id="negRadio" onclick="ShowHideHrr()" value="1"  >Negative</p>-->
                                    <?php if($formData1["cons_pos_val"] == 1){ 
                                        $oneChk = ($formData1["conspos1"] == 1)?"checked=''":"";     
                                        $twoChk = ($formData1["conspos2"] == 1)?"checked=''":"";     
                                        $threeChk = ($formData1["conspos3"] == 1)?"checked=''":"";     
                                    ?>
                                    <p id="poscheck" style="">(<input type="checkbox" name="hrr" class="" <?php echo $oneChk ?> id="hrr1" value="1" >1, <input type="checkbox" class="" <?php echo $twoChk ?> name="hrr2" id="hrr2" value="1" >2, <input type="checkbox" class="" <?php echo $threeChk; ?> value="1" name="hrr3" id="hrr3" >3 degree)</p>
                                    <?php }else{ ?>    
                                    <p id="poscheck" style="display: none">(<input type="checkbox" name="hrr" id="hrr1" value="1" >1, <input type="checkbox" name="hrr2" id="hrr2" value="1" >2, <input type="checkbox" value="1" name="hrr3" id="hrr3" >3 degree)</p>
                                    <?php } ?>
                                    <h5>Family History</h5>
                                    <p class="">
                                        <?php $family_his_poschk = ($formData1["fam_his_pos"] == 1)?"<input type='radio' size='' name='pos2' value='1' id='posRadioFamily' checked=''>Poositive &nbsp":"<input type='radio' size='' name='pos2' value='1' id='posRadioFamily' onchange='ShowHideFamily()'>Poositive &nbsp "; 
                                            echo $family_his_poschk;
                                        ?>
                                        <?php $family_his_negchk = ($formData1["fam_his_pos"] == 1)?"<input type='radio' size='' name='pos2' value='2' id='negRadioFamily' checked='' >Negative":"<input type='radio' size='' name='pos2' value='2' id='negRadioFamily' onclick='ShowHideFamily()'  >Negative"; 
                                            echo $family_his_negchk;
                                        ?>
<!--                                        <input type="radio" size="" name="pos2" value="1" id="posRadioFamily" onchange="ShowHideFamily()">Poositive &nbsp -->
                                        <!--<input type="radio" size="" name="pos2" value="1" id="negRadioFamily" onclick="ShowHideFamily()"  >Negative-->
                                    </p>
                                    
                                    <?php if($formData1["fam_his_pos"] == 1){ 
                                        $fam_his_mat = ($formData1["fam_his_mat"] == 1)?"checked=''":"";     
                                        $fam_his_pat = ($formData1["fam_his_pat"] == 1)?"checked=''":"";     
                                        $fam_his_hi = ($formData1["fam_his_hi"] == 1)?"checked=''":"";     
                                        $fam_his_sp = ($formData1["fam_his_sp"] == 1)?"checked=''":"";     
                                        $fam_his_lg = ($formData1["fam_his_lg"] == 1)?"checked=''":"";     
                                        $fam_his_md = ($formData1["fam_his_md"] == 1)?"checked=''":"";     
                                        $fam_his_oth = ($formData1["fam_his_oth"] == 1)?"checked=''":"";     
                                    ?>
                                    <p id="poscheckFamily" style="">(<input type="checkbox" <?php echo $fam_his_mat ?> name="maternal" id="maternal" value="1" >Maternal, <input type="checkbox" value="1" <?php echo $fam_his_pat; ?> name="paternal" id="paternal" >Paternal)<br>(<input type="checkbox" name="hi" id="hi" <?php echo $fam_his_hi; ?> value="1" >HI, <input type="checkbox" name="sp" <?php echo $fam_his_sp ?> id="sp" value="1" > Sp, <input type="checkbox" <?php echo $fam_his_lg ?> value="1" name="lg" id="lg" > Lg, <input type="checkbox" name="md" id="md" <?php echo $fam_his_md ?> value="1" > MD, <input type="checkbox" name="other" id="other" <?php echo $fam_his_oth ?> value="1" > Other)</p>
                                    <?php } else{ ?>
                                    <p id="poscheckFamily" style="display: none">(<input type="checkbox" name="maternal" id="maternal" value="1" >Maternal, <input type="checkbox" value="1" name="paternal" id="paternal" >Paternal)<br>(<input type="checkbox" name="hi" id="hi" value="1" >HI, <input type="checkbox" name="sp" id="sp" value="1" > Sp, <input type="checkbox" value="1" name="lg" id="lg" > Lg, <input type="checkbox" name="md" id="md" value="1" > MD, <input type="checkbox" name="other" id="other" value="1" > Other)</p>
                                    <?php  } ?>
                                </div>

<!--                                <label class="control-label checkbox hrr1"><input type="checkbox" size="" name="" class=" "  id="" >Pre Natal HRR</label>
<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="" class=" "  id="" >Pre Natal HRR</label>
<label class="control-label checkbox hrr1"><input type="checkbox" size="" name="" class=" "  id="" >Pre Natal HRR</label>-->
                            </div>
                        </div>
                        <div id="hrrdet">
                            <input type='text' name='hrr_id' id='hrr_id' value='<?php echo $formData1["hrr_type"] ?>'>
                            <input type='text' name='prenatal_id' id='prenatal_id' hidden='' value='<?php echo $formData1["prenatal_id"] ?>'>
                            <input type="text" name="natal_idval" id="natal_idval" hidden='' value="<?php echo $formData1["natal_id"] ?>">
                            <!--<input type='text' name='natal_id' id='natal_idval' hidden="" value='<?php echo $formData1["natal_id"] ?> '>-->
                            <input type='text' name='postNatal_id' id='postNatal_id'  hidden=''  value='<?php echo $formData1["postnatal_id"] ?>'>
                            <input type='text' name='other_id' id='other_id' hidden='' value='<?php echo $formData1["other_id"] ?>'>
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" onclick="hrrscreen();" >Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-4">
                <div class="col-xs-12 col-md-offset-1">
                    <h5>Impression</h5>
                    <div class="col-md-12" id="impresn">
                        <div id="screeningtwo">
                            <input type='text' name='screen1_id' id='screen1_id' hidden='' value='<?php echo $formData2["screen_one_id"] ?>'>
                            <input type="text" name="screening2_id" id="screening2_id" hidden=''  value="<?php echo $formData2["screen_two_id"] ?>"
                            <!--<input type='text' name='screen2_id' id='screen2_id' value='<?php echo $formData2["screen_two_id"] ?> '>-->
                            <input type='text' name='boa_id' id='boa_id' hidden='' value='<?php echo $formData2["boa_id"] ?>'>
                            <input type='text' name='primReflex_id' id='primReflex_id' hidden='' value='<?php echo $formData2["primitive_id"] ?>'>
                            <input type='text' name='cryAnal_id' id='cryAnal_id' hidden='' value='<?php echo $formData2["aco_id"] ?>'>
                            <!--<input type="text" name="aabrID" id="aabrID"  value="<?php echo $formData2["aabr_screen_id"] ?>">-->
                            <input type='text' name='aabr_id' id='aabr_id' hidden='' value='<?php echo $formData2["aabr_screen_id"] ?>'>
                        </div>
                        
                    </div>
            </div>
        </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-12 col-md-offset-1">
                    <div class="col-md-12">

                        <h3>OAE Screening</h3>
                        <div class="row">
                            <div class="col-md-5 " style="background-color: rgba(0, 221, 28, 0.39);;">
                                <div class="col-md-12 col-md-offset-1">
                                    <h4 class="">1st Screening Test</h4>
                                    <?php $firstScreenCheck = (!empty($formData2["screen_one_id"]))?"checked=''":"" ;
                                           $display1Screen = (!empty($formData2["screen_one_id"]))?"":"display: none"; 
                                           $rtpasschk = ($formData2["rt_pass"] == 1)?"checked=''":"";
                                           $rtrefrchk = ($formData2["rt_refer"] == 1)?"checked=''":"";
                                           $rtcntchk = ($formData2["rt_cnt_noisy"] == 1)?"checked=''":"";
                                           $ltpasschk = ($formData2["lt_pass"] == 1)?"checked=''":"";
                                           $ltrefrchk = ($formData2["lt_refer"] == 1)?"checked=''":"";
                                           $ltcntchk = ($formData2["lt_cnt_noisy"] == 1)?"checked=''":"";
                                           
                                    ?>
                                    <strong class="control-label checkbox"><input type="checkbox" size="" onclick="ShowhideTeDp1()" name="oae" class=" " <?php echo $firstScreenCheck; ?>  id="techk" value="1" >TEOAE</strong>
                                    <table class="footer__table" id="tedp" style="<?php echo $display1Screen; ?>">
                                        <tbody>
                                            <tr>
                                                <th><h5>Rt ear</h5></th>
                                                <th></th>
                                                <th><h5>Lt ear</h5></th>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="oaertear" value="1" class=" " <?php echo $rtpasschk ?>  id="oaertpass" >Pass</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="oaeltear" class=" "  id="oaeltpass" <?php echo $ltpasschk ?> value="1" >Pass</label></td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="oaertear" class=" "  id="oaertrefer" <?php echo $rtrefrchk ?> value="1" >Refer</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="oaeltear" class=" "  id="oaeltrefer" <?php echo $ltrefrchk ?> value="1">Refer</label></td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="oaertear" id="oaertcnt" class=" " <?php echo $rtcntchk ?>  id="" value="1" >CNT</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" name="oaeltear" size="" class=" "  id="oaeltcnt" <?php echo $ltcntchk ?> value="1" >CNT</label></td>
                                            </tr>
                                            <tr colspan="">
                                                <td colspan="3"><p>(Noisy&nbsp; &nbsp;<input type="checkbox" size="" name="oaenotcorp" class=" "  id="oaenotcorp" value="1" >Not cooperative)</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php $secondScreenCheck = (!empty($formData2["screen_two_id"]))?"checked=''":"" ;
                                   $display2Screen = (!empty($formData2["screen_two_id"]))?"":"display: none"; 
                                    $rtpasschk2 = ($formData2["rt_two_pass"] == 1)?"checked=''":"";
                                    $rtrefrchk2 = ($formData2["rt_two_refer"] == 1)?"checked=''":"";
                                    $rtcntchk2 = ($formData2["rt_cnt_two_noisy"] == 1)?"checked=''":"";
                                    $ltpasschk2 = ($formData2["lt_two_pass"] == 1)?"checked=''":"";
                                    $ltrefrchk2 = ($formData2["lt_two_refer"] == 1)?"checked=''":"";
                                    $ltcntchk2 = ($formData2["lt_cnt_two_noisy"] == 1)?"checked=''":"";
                                            
                                    ?>
                            <div class="col-md-5 " style="background-color: rgba(23, 143, 229, 0.22);;">
                                <div class="col-md-12 col-md-offset-1" >
                                    <div id="tedpchk2" >
                                        <h4 class="">2nd Screening Test</h4>
                                        <strong class="control-label checkbox"  id=""><input type="checkbox" size="" onclick="ShowhideTeDp2()" name="techk2" class=" "  id="techk2" <?php echo $secondScreenCheck; ?> value="1">TEOAE</strong>
                                    </div>
                                    <table class="footer__table" id="tedp2" style="<?php echo $display2Screen ; ?>">
                                        <tbody>
                                            <tr>
                                                <th><h5>Rt ear</h5></th>
                                                <th></th>
                                                <th><h5>Lt ear</h5></th>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="oaertear2" class=" "  id="oaertpass2" <?php echo $rtpasschk2; ?> value="1" >Pass</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="oaeltear2" class=" "  id="oaeltpass2" <?php echo $ltpasschk2; ?> value="1" >Pass</label></td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="oaertear2" class=" "  id="oaertrefer2" <?php echo $rtrefrchk2; ?> value="1" >Refer</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="oaeltear2" class=" "  id="oaeltrefer2" <?php echo $ltrefrchk2; ?> value="1">Refer</label></td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="oaertear2" class=" "  id="oaertcnt2" <?php echo $rtcntchk2; ?> value="1" >CNT</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="oaeltear2" class=" "  id="oaeltcnt2" <?php echo $ltcntchk2; ?> value="1" >CNT</label></td>
                                            </tr>
                                            <tr colspan="">
                                                <td colspan="3"><p>(Noisy&nbsp; &nbsp;<input type="checkbox" size="" name="oaenotcorp2" class=" "  id="oaenotcorp2" value="1" >Not cooperative)</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php 
                                    $fivehz_80dBHL_pass = ($formData2["fivehz_80dBHL_pass"] == 1)?"checked=''":"";
                                    $fivehz_50dBHL_pass = ($formData2["fivehz_50dBHL_pass"] == 1)?"checked=''":"";
                                    $fivehz_80dBHL_refer = ($formData2["fivehz_80dBHL_refer"] == 1)?"checked=''":"";
                                    $fivehz_50dBHL_refer = ($formData2["fivehz_50dBHL_refer"] == 1)?"checked=''":"";
                                    $fourhz_80dBHL_pass = ($formData2["fourhz_80dBHL_pass"] == 1)?"checked=''":"";
                                    $fourhz_50dBHL_pass = ($formData2["fourhz_50dBHL_pass"] == 1)?"checked=''":"";
                                    $fourhz_80dBHL_refer = ($formData2["fourhz_80dBHL_refer"] == 1)?"checked=''":"";
                                    $fourhz_50dBHL_refer = ($formData2["fourhz_50dBHL_refer"] == 1)?"checked=''":"";
                                    $whitenoise_80dBHL_pass = ($formData2["whitenoise_80dBHL_pass"] == 1)?"checked=''":"";
                                    $whitenoise_50dBHL_pass = ($formData2["whitenoise_50dBHL_pass"] == 1)?"checked=''":"";
                                    $whitenoise_80dBHL_refer = ($formData2["whitenoise_80dBHL_refer"] == 1)?"checked=''":"";
                                    $whitenoise_50dBHL_refer = ($formData2["whitenoise_50dBHL_refer"] == 1)?"checked=''":"";
                                            
                                    ?>
                        <div class="row">
                            <div class="col-md-5" style="background-color: rgba(181, 84, 187, 0.33)">
                                <div class="col-md-offset-1">
                                    <div>
                                        <h4>Behavioral Observation Audiometry</h4>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center"><h5>Stimulus</h5></th>
                                                    <th class="text-center" colspan="2"><h5>Intensity</h5></th>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center"><h6>80dBHL</h6></td>
                                                    <td class="text-center"><h6>50dBHL</h6></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><h6>500Hz Warble tones/NBN</h6></td>
                                                    <td class="text-center">
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="500nbn" <?php echo $fivehz_80dBHL_pass ?> class=" "  id="nbn500pass1" value="1" >Pass</label></p>
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="500nbn" <?php echo $fivehz_80dBHL_refer  ?> class=" "  id="nbn500refer1" value="1" >Refer</label></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="nbn500" class=" " <?php echo $fivehz_50dBHL_pass  ?>  id="nbn500pass2" value="1" >Pass</label></p>
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="nbn500" class=" " <?php echo $fivehz_50dBHL_refer  ?>  id="nbn500refer2" value="1" >Refer</label></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><h6>4000Hz Warable tones/NBN</h6></td>
                                                    <td class="text-center">
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="nbn4000" class=" "  id="nbn4000pass1" <?php echo $fourhz_80dBHL_pass ?> value="1" >Pass</label></p>
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="nbn4000" class=" "  id="nbn4000refer1" <?php echo $fourhz_80dBHL_refer ?> value="1" >Refer</label></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="4000nbn" class=" "  id="nbn4000pass2" <?php echo $fourhz_50dBHL_pass ?> value="1" >Pass</label></p>
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="4000nbn" class=" "  id="nbn4000refer2" <?php echo $fourhz_50dBHL_refer ?> value="1" >Refer</label></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><h6>White Noise</h6></td>
                                                    <td class="text-center">
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="whitenose1" class=" "  id="whitenoisypass1" <?php echo $whitenoise_80dBHL_pass ?> value="1" >Pass</label></p>
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="whitenose1" class=" "  id="whitenoisyrefer1" <?php echo $whitenoise_80dBHL_refer ?> value="1" >Refer</label></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="whitenose2" class=" "  id="whitenoisypass2" <?php echo $whitenoise_50dBHL_pass ?> value="1" >Pass</label></p>
                                                        <p><label class="control-label checkbox"><input type="radio" size="" name="whitenose2" class=" "  id="whitenoisyrefer2" <?php echo $whitenoise_50dBHL_refer ?> value="1" >Refer</label></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $moro_pre = ($formData2["moro_pre"] == 1)?"checked=''":"";
                                $moro_abs = ($formData2["moro_abs"] == 1)?"checked=''":"";
                                $root_pre = ($formData2["root_pre"] == 1)?"checked=''":"";
                                $root_abs = ($formData2["root_abs"] == 1)?"checked=''":"";
                                $suck_pre = ($formData2["suck_pre"] == 1)?"checked=''":"";
                                $suck_abs = ($formData2["suck_abs"] == 1)?"checked=''":"";
                                $tonicneck_pre = ($formData2["tonicneck_pre"] == 1)?"checked=''":"";
                                $tonicneck_abs = ($formData2["tonicneck_abs"] == 1)?"checked=''":"";
                                $palmar_pre = ($formData2["palmar_pre"] == 1)?"checked=''":"";
                                $palmar_abs = ($formData2["palmar_abs"] == 1)?"checked=''":"";
                                $plantar_pre = ($formData2["plantar_pre"] == 1)?"checked=''":"";
                                $plantar_abs = ($formData2["plantar_abs"] == 1)?"checked=''":"";
                                $babinski_pre = ($formData2["babinski_pre"] == 1)?"checked=''":"";
                                $babinski_abs = ($formData2["babinski_abs"] == 1)?"checked=''":"";
                            ?>
                            <div class="col-md-5 " style="background-color: rgba(245, 172, 39, 0.35);">
                                <div class="col-md-offset-1">
                                    <div>
                                        <h4>Primitive Reflexes</h4>
                                        <table class="footer__table">
                                            <tbody>
                                                <tr>
                                                    <td><h6>Moro/Startle</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="mororadio" class=" "  id="moropresent" <?php echo $moro_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="mororadio" class=" " <?php echo $moro_abs ?>  id="moroabsent" value="1" >Absent</label></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Rooting</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="rootingradio" class=" "  id="rootingpresent" <?php echo $root_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="rootingradio" class=" "  id="rootingabsent" <?php echo $root_abs ?> value="1" >Absent</label></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Sucking</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="suckradio" class=" "  id="suckpresent" <?php echo $suck_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="suckradio" class=" "  id="suckabsent" <?php echo $suck_abs  ?> value="1" >Absent</label></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Tonic neck</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="tonicradio" class=" "  id="tonicpresent" <?php echo $tonicneck_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="tonicradio" class=" "  id="tonicabsent" <?php echo $tonicneck_abs ?> value="1" >Absent</label></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Palmar</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="palmarradio" class=" "  id="palmarpresent" <?php echo $palmar_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="palmarradio" class=" "  id="palmarabsent" <?php echo $palmar_abs ?> value="1" >Absent</label></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Plantar</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="plantarradio" class=" "  id="plantarpresent" <?php echo $plantar_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="plantarradio" class=" "  id="planterabsent" <?php echo $plantar_abs ?> value="1" >Absent</label></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Babinski</h6></td>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="babinskiradio" class=" "  id="babinskipresent" <?php echo $babinski_pre ?> value="1" >Present</label></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="babinskiradio" class=" "  id="babinskiabsent" <?php echo $babinski_abs ?> value="1" >Absent</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $normal_val = ($formData2["normal_val"] == 1)?"checked=''":"";
                                $abnormal_val = ($formData2["abnormal_val"] == 1)?"checked=''":"";
                            ?>
                            <div class="col-md-5 " style="background-color: rgba(255, 195, 0, 0.42)"> 
                                <div class="col-md-offset-1">
                                    <div>
                                        <h4>Acoustic Analysis(Infant cry Analysis)</h4>

                                        <table class="footer__table">
                                            <tbody>
                                                <tr>
                                                    <td><label class="control-label checkbox"><input type="radio" size="" name="infantcryananlysis" class=" "  id="acanalnormal" <?php echo $normal_val ?> value="1" >Normal</label></td>
                                                    <td></td>
                                                    <td class=""><label class="control-label checkbox"><input type="radio" size="" name="infantcryananlysis" class=" "  id="acanalabnormal" <?php echo $abnormal_val ?> value="1" >Abnormal</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php $aabr_screen_chk = (!empty($formData2["aabr_screen_id"]))?"checked=''":"" ;
                                $aabrDisplay = (!empty($formData2["aabr_screen_id"]))?"":"display: none"; 
                                $aabr_rt_pass = ($formData2["aabr_rt_pass"] == 1)?"checked=''":"";
                                $aabr_lt_pass = ($formData2["aabr_lt_pass"] == 1)?"checked=''":"";
                                $aabr_rt_refer = ($formData2["aabr_rt_refer"] == 1)?"checked=''":"";
                                $aabr_lt_refer = ($formData2["aabr_lt_refer"] == 1)?"checked=''":"";
                                $aabr_rt_cnt_noisy = ($formData2["aabr_rt_cnt_noisy"] == 1)?"checked=''":"";
                                $aabr_lt_cnt_noisy = ($formData2["aabr_lt_cnt_noisy"] == 1)?"checked=''":"";
                         ?>
                        <div class="row">
                            <div class="col-md-5 " style="background-color: rgba(255, 76, 0, 0.25);">
                                <div class=" col-md-offset-1">
                                    <div id="aabr">
                                        <h4 class="">Automated Auditory brain stem response (AABR) Screening</h4>
                                        <strong class="control-label checkbox"  id=""><input type="checkbox" size="" onclick="ShowhideAabr()" name="aabrchk" class=" " <?php echo $aabr_screen_chk ?>  id="aabrchk" >AABR</strong>
                                    </div>
                                    <table class="footer__table" id="aabrsc" style="<?php echo $aabrDisplay?>">
                                        <tbody>
                                            <tr>
                                                <th><h5>Rt ear</h5></th>
                                                <th></th>
                                                <th><h5>Lt ear</h5></th>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="aabrrtear" class=" "  id="aabrrtpass" <?php echo $aabr_rt_pass ?> value="1" >Pass</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="aabrltear" class=" "  id="aabrltpass" <?php echo $aabr_lt_pass ?> value="1" >Pass</label></td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="aabrrtear" class=" "  id="aabrrtrefer" <?php echo $aabr_rt_refer ?> value="1" >Refer</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="aabrltear" class=" "  id="aabrltrefer" <?php echo $aabr_lt_refer ?> value="1" >Refer</label></td>
                                            </tr>
                                            <tr>
                                                <td><label class="control-label checkbox"><input type="radio" size="" name="aabrrtear" class=" "  id="aabrrtcnt" <?php echo $aabr_rt_cnt_noisy ?> value="1" >CNT</label></td>
                                                <td></td>
                                                <td class=""><label class="control-label checkbox"><input type="radio" size="" name="aabrltear" class=" "  id="aabrltcnt" <?php echo $aabr_lt_cnt_noisy ?> value="1" >CNT</label></td>
                                            </tr>
                                            <tr colspan="">
                                                <td colspan="3"><p>(Noisy&nbsp; &nbsp;<input type="checkbox" size="" name="aabrnotcorp" class=""  id="aabrnotcorp" value="1" >Not cooperative)</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        

                        
                        <div class="col-md-12">
                            <!--<button class="btn btn-success btn-lg pull-right" name="submit_screening" onclick="submitScreening()" type="submit">Submit</button>-->
                            <button class="btn btn-primary nextBtn btn-lg pull-right" name="submit_screening" onclick="submitScreeningTest(<?php echo $patientId ?>)" type="button">Submit</button>
                        </div>
                        
                        
                    </div >
                </div>
            </div>
            
        </form>
    </div>
</section>

<script src="<?php echo HostRoot ?>js/submission/submitscreen.js"></script>

<script type="text/javascript">
    function copyValue() {
        var Hospvalue = $('#jelectHosp option:selected').text();
        document.getElementById('hospname').value = Hospvalue;
        $hospid = $('#hospanme').val();
        var dropboxvalue = $("#jelectHosp").val();
        $.ajax({
            url: Root + 'assets/ajax/getEmp.php',
            data: {hospid: dropboxvalue},
            cache: false,
            success: function (data) {
                if (data) {
                    $('#autogen').fadeOut('fast', function () {
                        $('#autogen').fadeIn('fast').html(data);
                    });

                } 

            }


        });
    }
    
    



    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea]"),
                    isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });





///////////////


</script>

<!--States By country Select-->
<script>
    
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
        
        
        
        function getAgeByBirthDate(bdate)
            {
                var dob = bdate;
//                var scName = subcatName;
                $.ajax({
                   type: "POST",
                   url: Root+'assets/ajax/getAge.php',
                   data: {birthday:dob},
                   cache: false,
                   success:function (data) {
                        $('#age').fadeOut('slow', function(){
                            $('#age').fadeIn('slow').html(data);
                      });
                    }              
                   });

             }
        

    
    function getState(countryId) {
        var strURL = Root + "assets/ajax/findState.php?country=" + countryId;
        var req = getXMLHTTP();

        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('statediv').innerHTML = req.responseText;
                        document.getElementById('citydiv').innerHTML = '<select name="city" class="form-control">' +
                                '<option>Select City</option>' +
                                '</select>';
                    } else {
                        alert("Problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }
    function getCity(countryId, stateId) {
        var strURL = Root + "assets/ajax/findCity.php?country=" + countryId + "&state=" + stateId;
        var req = getXMLHTTP();

        if (req) {

            req.onreadystatechange = function () {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById('citydiv').innerHTML = req.responseText;
                    } else {
                        alert("Problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }

    }
    
//   Copy permanent address
    function CopyAdd() {

        var cb1 = document.getElementById('sameadd');
        var a1 = document.getElementById('pre_address');
        var al1 = document.getElementById('per_address');


        if (cb1.checked) {
            al1.value = a1.value;


        } else {
            al1.value = '';


        }
    }
    
    function ShowHideDiv(chkPassport) {
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = chkPassport.checked ? "block" : "none";
    }
    
    
</script>
<script type="text/javascript">
    $('#first_mnth').click(function(){
        $("#firstDV").toggle(this.checked);
   
    });

    function ShowHideHrr() {
        var chkYes = document.getElementById("posRadio");
        var chkNo = document.getElementById("negRadio");
        
        //alert(chkYes);
        var dvPassport = document.getElementById("poscheck");
        if (chkYes.checked)
            dvPassport.style.display = chkYes.checked ? "block" : "none";
        if (chkNo.checked)
            dvPassport.style.display = "none";
    }
    function ShowHideFamily() {
        var chkYes = document.getElementById("posRadioFamily");
        var chkNo = document.getElementById("negRadioFamily");
        //alert(chkYes);
        var dvPassport = document.getElementById("poscheckFamily");
        if (chkYes.checked)
            dvPassport.style.display = chkYes.checked ? "block" : "none";
        if (chkNo.checked)
            dvPassport.style.display = "none";
    }

    function ShowhideTeDp1() {
        var chkTedp = document.getElementById("techk");
        var tablTedp = document.getElementById("tedp");
        var tedpchk2 = document.getElementById("tedpchk2");
        tablTedp.style.display = chkTedp.checked ? "block" : "none";
        //tedpchk2.style.display = chkTedp.checked ? "block" : "none";
    }
    function ShowhideTeDp2() {
        var chkTedp2 = document.getElementById("techk2");
        var tablTedp2 = document.getElementById("tedp2");
        var aabr = document.getElementById("aabr");
        tablTedp2.style.display = chkTedp2.checked ? "block" : "none";
       // aabr.style.display = chkTedp2.checked ? "block" : "none";
    }
    function ShowhideAabr() {
        var chkAabr = document.getElementById("aabrchk");
        var tablAabr = document.getElementById("aabrsc");
        var boa = document.getElementById("boa");
        tablAabr.style.display = chkAabr.checked ? "block" : "none";
        //boa.style.display = chkAabr.checked ? "block":"none";
    }
    
    $(document).ready(function() {
    $('.group_ctrl').change(function () {
        $("." + $(this).data("group")).prop('disabled', !this.checked);
    });
    });
    

</script>


<script>
    
    
//    function submitScreening(){
//        //alert("test");
//        var hospid = $("#jelectHosp").val();
//        var babyno = $("#baby_id_num").val();
//        var pocdno = $("#pocd_no").val();
//        var baby_name = $("#babyName").val();
//        var birth_date = $("#birthdate").val();
//        var age = $("#age").val();
//        var father = $("#father").val();
//        var mother = $("#mother").val();
//        var contact_no = $("#contact_no").val();
//        var email_id = $("#email").val();
//        var gender = $("input[name=gender]:checked").val();
//        var state = $("#state").val();
//        var district = $("#district").val();
//        var city = $("#city").val();
//        var preaddress = $("#pre_address").val();
//        var peraddress = $("#per_address").val();
//        var hosp_name = $("#hospname").val();
//        var delivery_type = $("input[name=deltype]:checked").val();
//        var region = $("input[name=region]:checked").val();
//        var religion = $("input[name=religion]:checked").val();
//        var caste = $("input[name=caste]:checked").val();
//        var socioeco = $("input[name=socioeco]:checked").val();
//        var staff_name = $("#staffname").val();
//        var screen_date = $("#screendate").val();
//        var med_history = $("#med_history").val();
//        
//        var subscribe = $("input[name=subscribe]:checked").val();
//        var ssubscribe = $("input[name=ssubscribe]:checked").val();
//        var prenatalhrr = $("#prenatalhrr:checked").val();
//        var natalhrr = $("#natalhrr:checked").val();
//        var postnatal = $("#postnatal:checked").val();
//        var other = $("#other:checked").val();
//        
////        prenat
//        var exvomit = $("#exvomit:checked").val();
//        var eldpreg = $("#eldpreg:checked").val();
//        var bp = $("#bp:checked").val();
//        var bloodsugar = $("#bloodsugar:checked").val();
//        var abortion = $("#abortion:checked").val();
//        var rh = $("#rh:checked").val();
//        var viralinfection = $("#viralinfection:checked").val();
//        var infection = $("#infection:checked").val();
//        var otomedication = $("#otomedication:checked").val();
//        var chemfume = $("#chemfume:checked").val();
//        var alcohol = $("#alcohol:checked").val();
//        var smoke = $("#smoke:checked").val();
//        
////        natal
//        var weightless = $("#weightless:checked").val();
//        var birth_wt = $("#birth_wt").val();
//        var jaundice = $("#jaundice:checked").val();
//        var bil_level = $("#bil_level").val();
//        var birthcry = $("#birthcry").val();
//        var prematuredel = $("#prematuredel").val();
//        var birthasphyxia = $("#birthasphyxia:checked").val();
//        var fetaldistress = $("#fetaldistress:checked").val();
//        var nicu = $("#nicu").val();
//        var apgarone = $("#apgarone:checked").val();
//        var apgarfive = $("#apgarfive:checked").val();
//
////        post natal
//        var craniofacial = $("#craniofacial:checked").val();
//        var cogenital = $("#cogenital:checked").val();
//        var degenerative = $("#degenerative:checked").val();
//        var viralinfect = $("#viralinfect:checked").val();
//        var convulsions = $("#convulsions:checked").val();
//        var otitis = $("#otitis:checked").val();
//        var trauma = $("#trauma:checked").val();
//        
////        Other
//        var Consanguinity = $("input[name=pos1]:checked").val();
//        var hrr1 = $("#hrr1:checked").val();
//        var hrr2 = $("#hrr2:checked").val();
//        var hrr3 = $("#hrr3:checked").val();
//        
//        var familyhistory = $("input[name=pos2]:checked").val();
//        var maternal = $("#maternal:checked").val();
//        var paternal = $("#paternal:checked").val();
//        var hi = $("#hi:checked").val();
//        var sp = $("#sp:checked").val();
//        var lg = $("#lg:checked").val();
//        var md = $("#md:checked").val();
//        var other = $("#other:checked").val();
//        
////        OAE screening
//        var techk = $("#techk:checked").val();
//        var oaertpass = $("#oaertpass:checked").val();
//        var oaeltpass = $("#oaeltpass:checked").val();
//        var oaertrefer = $("#oaertrefer:checked").val();
//        var oaeltrefer = $("#oaeltrefer:checked").val();
//        var oaertcnt = $("#oaertcnt:checked").val();
//        var oaeltcnt = $("#oaeltcnt:checked").val();
//        var oaenoisy = $("#oaenoisy:checked").val();
//        var oaenotcorp = $("#oaenotcorp:checked").val();
//        
//        var techk2 = $("#techk2:checked").val();
//        var oaertpass2 = $("#oaertpass2:checked").val();
//        var oaeltpass2 = $("#oaeltpass2:checked").val();
//        var oaertrefer2 = $("#oaertrefer2:checked").val();
//        var oaeltrefer2 = $("#oaeltrefer2:checked").val();
//        var oaertcnt2 = $("#oaertcnt2:checked").val();
//        var oaeltcnt2 = $("#oaeltcnt2:checked").val();
//        var oaenoisy2 = $("#oaenoisy2:checked").val();
//        var oaenotcorp2 = $("#oaenotcorp2:checked").val();
//        
//        var aabrchk = $("#aabrchk:checked").val();
//        var aabrrtpass = $("#aabrrtpass:checked").val();
//        var aabrltpass = $("#aabrltpass:checked").val();
//        var aabrrtrefer = $("#aabrrtrefer:checked").val();
//        var aabrltrefer = $("#aabrltrefer:checked").val();
//        var aabrrtcnt = $("#aabrrtcnt:checked").val();
//        var aabrltcnt = $("#aabrltcnt:checked").val();
//        var aabrnoisy = $("#aabrnoisy:checked").val();
//        var aabrnotcorp = $("#aabrnotcorp:checked").val();
//        
//        var nbn500pass1 = $("#nbn500pass1:checked").val();
//        var nbn500refer1 = $("#nbn500refer1:checked").val();
//        var nbn500pass2 = $("#nbn500pass2:checked").val();
//        var nbn500refer2 = $("#nbn500refer2:checked").val();
//        var nbn4000pass1 = $("#nbn4000pass1:checked").val();
//        var nbn4000refer1 = $("#nbn4000refer1:checked").val();
//        var nbn4000pass2 = $("#nbn4000pass2:checked").val();
//        var nbn4000refer2 = $("#nbn4000refer2:checked").val();
//        var whitenoisypass1 = $("#whitenoisypass1:checked").val();
//        var whitenoisyrefer1 = $("#whitenoisyrefer1:checked").val();
//        var whitenoisypass2 = $("#whitenoisypass2:checked").val();
//        var whitenoisyrefer2 = $("#whitenoisyrefer2:checked").val();
//        
//        var acanalnormal = $("#acanalnormal:checked").val();
//        var acanalabnormal = $("#acanalabnormal:checked").val();
//        
//        var moropresent = $("#moropresent:checked").val();
//        var moroabsent = $("#moroabsent:checked").val();
//        var rootingpresent = $("#rootingpresent:checked").val();
//        var rootingabsent = $("#rootingabsent:checked").val();
//        var suckpresent = $("#suckpresent:checked").val();
//        var suckabsent = $("#suckabsent:checked").val();
//        var tonicpresent = $("#tonicpresent:checked").val();
//        var tonicabsent = $("#tonicabsent:checked").val();
//        var palmarpresent = $("#palmarpresent:checked").val();
//        var palmarabsent = $("#palmarabsent:checked").val();
//        var plantarpresent = $("#plantarpresent:checked").val();
//        var planterabsent = $("#planterabsent:checked").val();
//        var babinskipresent = $("#babinskipresent:checked").val();
//        var babinskiabsent = $("#babinskiabsent:checked").val();
//        $.ajax({
//                   type: "POST",
//                   url: Root+'assets/ajax/submitScreening.php',
//                   data: {hospId: hospid, babynum: babyno, pocdnum: pocdno, babyName: baby_name, birthDate: birth_date, babyage: age, babyfather: father, babymother: mother, contactNo: contact_no, emailId: email_id, babygender: gender, babystate: state, babydistrict: district, babycity: city, preAddress: preaddress, peraddress: peraddress, hospName: hosp_name, deliveryType: delivery_type, babyregion: region, babyreligion: religion, babycaste: caste, babysocioeco: socioeco, staffName: staff_name, screenDate: screen_date, medHistory: med_history, babysubscribe: subscribe, babyssubscribe: ssubscribe, prenatalHrr: prenatalhrr, natalHrr: natalhrr, postNatal: postnatal, babyother: other, exVomit: exvomit, eldPreg: eldpreg, babybp: bp, bloodSugar: bloodsugar, babyabortion: abortion, babyrh: rh, viralInfection: viralinfection, infect: infection, otoMedication: otomedication, chemFume: chemfume, babyalcohol: alcohol, babysmoke: smoke, weightLess: weightless, birthWt : birth_wt, babyjaundice: jaundice, bilLevel: bil_level, babybirthcry: birthcry, prematureDelivery: prematuredel, birthAsphyxia: birthasphyxia, fetalDistress: fetaldistress, babynicu: nicu, apgArone: apgarone, apgarFive: apgarfive, cranioFacial: craniofacial, coGenital: cogenital, deGenerative: degenerative, viralInfect: viralinfect, babyconvulsions: convulsions, babyotitis: otitis, babytrauma: trauma, babyConsanguinity: Consanguinity, babyhrr1: hrr1, babyhrr2: hrr2, babyhrr3: hrr3, familyHistory: familyhistory, babymaternal: maternal, babypaternal: paternal, babyhi: hi, babysp: sp, babylg: lg, babymd: md, otherBaby: other, teCheck: techk, oaerightpass: oaertpass, oaeleftpass: oaeltpass, oaerightrefer: oaertrefer, oaeleftrefer: oaeltrefer, oaerightcnt: oaertcnt, oaeleftcnt: oaeltcnt, oaeNoisy: oaenoisy, oaenotcorperation: oaenotcorp, babytechk2: techk2, oaerightpass2: oaertpass2, oaeleftpass2: oaeltpass2, oaerightrefer2: oaertrefer2, oaeleftrefer2: oaeltrefer2, oaerightcnt2: oaertcnt2, oaeleftcnt2: oaeltcnt2, oaeNoisy2: oaenoisy2, oaenotcorperation2: oaenotcorp2, aabrcheck: aabrchk, aabrrightpass: aabrrtpass, aabrleftpass: aabrltpass, aabrrightrefer: aabrrtrefer, aabrleftrefer: aabrltrefer, aabrrightcnt: aabrrtcnt, aabrleftcnt: aabrltcnt, aabrNoisy: aabrnoisy, aabrnotcorperation: aabrnotcorp, nbn500passone: nbn500pass1, nbn500referone: nbn500refer1, nbn500passtwo: nbn500pass2, nbn500refertwo: nbn500refer2, nbn4000passone: nbn4000pass1, nbn4000referone: nbn4000refer1, nbn4000passtwo: nbn4000pass2, nbn4000refertwo: nbn4000refer2, whitenoisypassone: whitenoisypass1, whitenoisyreferone: whitenoisyrefer1, whitenoisypasstwo: whitenoisypass2, whitenoisyrefertwo: whitenoisyrefer2, acanalNormal: acanalnormal, acanalabnormal: acanalabnormal, moroPresent: moropresent, moroAbsent: moroabsent, rootingPresent: rootingpresent, rootingAbsent: rootingabsent, suckPresent: suckpresent, suckAbsent: suckabsent, tonicPresent: tonicpresent, tonicAbsent: tonicabsent, palmarPresent: palmarpresent, palmarAbsent: palmarabsent, plantarPresent: plantarpresent, planterAbsent: planterabsent, babinskiPresent: babinskipresent, babinskiAbsent: babinskiabsent},
//                   cache: false,
//                   success:function (data) {
//                       alert("Data Submitted");
//                       if (data) {
//                    $('#impresn').fadeOut('fast', function () {
//                        $('#impresn').fadeIn('fast').html(data);
//                    });
//
//                }
//            }
//                //else
//                    //alert('test');
//                       //alert(data);
//                    
//                });
//                                  
//            }
               

</script>



<!--<script type="text/javascript">
    var startyear = "1950";
    var endyear = "2050";
    var dat = new Date();
    var curday = dat.getDate();
    var curmon = dat.getMonth() + 1;
    var curyear = dat.getFullYear();
    function checkleapyear(datea)
    {
        if (datea.getYear() % 4 == 0)
        {
            if (datea.getYear() % 10 != 0)
            {
                return true;
            } else
            {
                if (datea.getYear() % 400 == 0)
                    return true;
                else
                    return false;
            }
        }
        return false;
    }
    function DaysInMonth(Y, M) {
        with (new Date(Y, M, 1, 12)) {
            setDate(0);
            return getDate();
        }
    }
    function datediff(date1, date2) {
        var y1 = date1.getFullYear(), m1 = date1.getMonth(), d1 = date1.getDate(),
                y2 = date2.getFullYear(), m2 = date2.getMonth(), d2 = date2.getDate();
        if (d1 < d2) {
            m1--;
            d1 += DaysInMonth(y2, m2);
        }
        if (m1 < m2) {
            y1--;
            m1 += 12;
        }
        return [y1 - y2, m1 - m2, d1 - d2];
    }
    function calage() {

        var calday = document.birthday.day.options[document.birthday.day.selectedIndex].value;
        var calmon = document.birthday.month.options[document.birthday.month.selectedIndex].value;
        var calyear = document.birthday.year.options[document.birthday.year.selectedIndex].value;
//alert(calday+calmon+calyear);
        if (curday == "" || curmon == "" || curyear == "" || calday == "" || calmon == "" || calyear == "")
        {
            alert("please fill all the values and click go -");
        } else
        {
            var curd = new Date(curyear, curmon - 1, curday);
            var cald = new Date(calyear, calmon - 1, calday);
            var diff =
                    Date.UTC(curyear, curmon, curday, 0, 0, 0) - Date.UTC(calyear, calmon, calday, 0, 0, 0);
            var dife = datediff(curd, cald);
            document.birthday.age.value = dife[0] + " years, " + dife[1] + " months, and " + dife[2] + " days";
            var monleft = (dife[0] * 12) + dife[1];
            var secleft = diff / 1000 / 60;
            var hrsleft = secleft / 60;
            var daysleft = hrsleft / 24;
            document.birthday.months.value = monleft + " Month since your birth";

            document.birthday.daa.value = daysleft + " days since your birth";

            document.birthday.hours.value = hrsleft + " hours since your birth";
            document.birthday.min.value = secleft + " minutes since your birth";
            var as = parseInt(calyear) + dife[0] + 1;
            var diff =
                    Date.UTC(as, calmon, calday, 0, 0, 0) - Date.UTC(curyear, curmon, curday, 0, 0, 0);
            var datee = diff / 1000 / 60 / 60 / 24;
            document.birthday.nbday.value = datee + " days left for your next birthday";

        }
    }


//    function submitScreeningTest(){
//        var babyno = $("#baby_id_num").val();
//        var pocdno = $("#pocd_no").val();
//        var baby_name = $("#babyName").val();
//        var birth_date = $("#birthdate").val();
//        var age = $("#age").val();
//        var father = $("#father").val();
//        var mother = $("#mother").val();
//        var contact_no = $("#contact_no").val();
//        var email_id = $("#email").val();
//        var gender = $("input[name=gender]:checked").val();
//        var state = $("#state").val();
//        var district = $("#district").val();
//        var city = $("#city").val();
//        var preaddress = $("#pre_address").val();
//        var peraddress = $("#per_address").val();
//        var hosp_name = $("#hospname").val();
//        var delivery_type = $("input[name=deltype]:checked").val();
//        var region = $("input[name=region]:checked").val();
//        var religion = $("input[name=religion]:checked").val();
//        var caste = $("input[name=caste]:checked").val();
//        var socioeco = $("input[name=socioeco]:checked").val();
//        var staff_name = $("#staffname").val();
//        var screen_date = $("#screendate").val();
//        var med_history = $("#med_history").val();
//        var subscribe = $("input[name=subscribe]:checked").val();
//        var ssubscribe = $("input[name=ssubscribe]:checked").val();
//        var prenatalhrr = $("#prenatalhrr:checked").val();
//        var natalhrr = $("#natalhrr:checked").val();
//        var postnatal = $("#postnatal:checked").val();
//        var other = $("#other:checked").val();
//        
////        prenat
//        var exvomit = $("#exvomit:checked").val();
//        var eldpreg = $("#eldpreg:checked").val();
//        var bp = $("#bp:checked").val();
//        var bloodsugar = $("#bloodsugar:checked").val();
//        var abortion = $("#abortion:checked").val();
//        var rh = $("#rh:checked").val();
//        var viralinfection = $("#viralinfection:checked").val();
//        var otomedication = $("#otomedication:checked").val();
//        var chemfume = $("#chemfume:checked").val();
//        var alcohol = $("#alcohol:checked").val();
//        var smoke = $("#smoke:checked").val();
//        
////        natal
//        var weightless = $("#weightless:checked").val();
//        var birth_wt = $("#birth_wt").val();
//        var jaundice = $("#jaundice:checked").val();
//        var bil_level = $("#bil_level").val();
//        var birthcry = $("#birthcry").val();
//        var prematuredel = $("#prematuredel").val();
//        var birthasphyxia = $("#birthasphyxia:checked").val();
//        var fetaldistress = $("#fetaldistress:checked").val();
//        var nicu = $("#nicu").val();
//        var apgarone = $("#apgarone:checked").val();
//        var apgarfive = $("#apgarfive:checked").val();
//
////        post natal
//        var craniofacial = $("#craniofacial:checked").val();
//        var cogenital = $("#cogenital:checked").val();
//        var degenerative = $("#degenerative:checked").val();
//        var viralinfect = $("#viralinfect:checked").val();
//        var convulsions = $("#convulsions:checked").val();
//        var otitis = $("#otitis:checked").val();
//        var trauma = $("#trauma:checked").val();
//        
////        Other
//        var Consanguinity = $("input[name=pos1]:checked").val();
//        var hrr1 = $("#hrr1:checked").val();
//        var hrr2 = $("#hrr2:checked").val();
//        var hrr3 = $("#hrr3:checked").val();
//        
//        var familyhistory = $("input[name=pos2]:checked").val();
//        var maternal = $("#maternal:checked").val();
//        var paternal = $("#paternal:checked").val();
//        var hi = $("#hi:checked").val();
//        var sp = $("#sp:checked").val();
//        var lg = $("#lg:checked").val();
//        var md = $("#md:checked").val();
//        var other = $("#other:checked").val();
//        
////        OAE screening
//        var techk = $("#techk:checked").val();
//        var oaertpass = $("#oaertpass:checked").val();
//        var oaeltpass = $("#oaeltpass:checked").val();
//        var oaertrefer = $("#oaertrefer:checked").val();
//        var oaeltrefer = $("#oaeltrefer:checked").val();
//        var oaertcnt = $("#oaertcnt:checked").val();
//        var oaeltcnt = $("#oaeltcnt:checked").val();
//        var oaenoisy = $("#oaenoisy:checked").val();
//        var oaenotcorp = $("#oaenotcorp:checked").val();
//        
//        var techk2 = $("#techk2:checked").val();
//        var oaertpass2 = $("#oaertpass2:checked").val();
//        var oaeltpass2 = $("#oaeltpass2:checked").val();
//        var oaertrefer2 = $("#oaertrefer2:checked").val();
//        var oaeltrefer2 = $("#oaeltrefer2:checked").val();
//        var oaertcnt2 = $("#oaertcnt2:checked").val();
//        var oaeltcnt2 = $("#oaeltcnt2:checked").val();
//        var oaenoisy2 = $("#oaenoisy2:checked").val();
//        var oaenotcorp2 = $("#oaenotcorp2:checked").val();
//        
//        var aabrchk = $("#aabrchk:checked").val();
//        var aabrrtpass = $("#aabrrtpass:checked").val();
//        var aabrltpass = $("#aabrltpass:checked").val();
//        var aabrrtrefer = $("#aabrrtrefer:checked").val();
//        var aabrltrefer = $("#aabrltrefer:checked").val();
//        var aabrrtcnt = $("#aabrrtcnt:checked").val();
//        var aabrltcnt = $("#aabrltcnt:checked").val();
//        var aabrnoisy = $("#aabrnoisy:checked").val();
//        var aabrnotcorp = $("#aabrnotcorp:checked").val();
//        
//        var nbn500pass1 = $("#nbn500pass1:checked").val();
//        var nbn500refer1 = $("#nbn500refer1:checked").val();
//        var nbn500pass2 = $("#nbn500pass2:checked").val();
//        var nbn500refer2 = $("#nbn500refer2:checked").val();
//        var nbn4000pass1 = $("#nbn4000pass1:checked").val();
//        var nbn4000refer1 = $("#nbn4000refer1:checked").val();
//        var nbn4000pass2 = $("#nbn4000pass2:checked").val();
//        var nbn4000refer2 = $("#nbn4000refer2:checked").val();
//        var whitenoisypass1 = $("#whitenoisypass1:checked").val();
//        var whitenoisyrefer1 = $("#whitenoisyrefer1:checked").val();
//        var whitenoisypass2 = $("#whitenoisypass2:checked").val();
//        var whitenoisyrefer2 = $("#whitenoisyrefer2:checked").val();
//        
//        var acanalnormal = $("#acanalnormal:checked").val();
//        var acanalabnormal = $("#acanalabnormal:checked").val();
//        
//        var moropresent = $("#moropresent:checked").val();
//        var moroabsent = $("#moroabsent:checked").val();
//        var rootingpresent = $("#rootingpresent:checked").val();
//        var rootingabsent = $("#rootingabsent:checked").val();
//        var suckpresent = $("#suckpresent:checked").val();
//        var suckabsent = $("#suckabsent:checked").val();
//        var tonicpresent = $("#tonicpresent:checked").val();
//        var tonicabsent = $("#tonicabsent:checked").val();
//        var palmarpresent = $("#palmarpresent:checked").val();
//        var palmarabsent = $("#palmarabsent:checked").val();
//        var plantarpresent = $("#plantarpresent:checked").val();
//        var planterabsent = $("#planterabsent:checked").val();
//        var babinskipresent = $("#babinskipresent:checked").val();
//        var babinskiabsent = $("#babinskiabsent:checked").val();
//        $.ajax({
//                   type: "POST",
//                   url: Root+'assets/ajax/submitScreening.php',
//                   data: {babynum: babyno, pocdnum: pocdno, babyName: baby_name, birthDate: birth_date, babyage: age, babyfather: father, babymother: mother, contactNo: contact_no, emailId: email_id, babygender: gender, babystate: state, babydistrict: district, babycity: city, preAddress: preaddress, peraddress: peraddress, hospName: hosp_name, deliveryType: delivery_type, babyregion: region, babyreligion: religion, babycaste: caste, babysocioeco: socioeco, staffName: staff_name, screenDate: screen_date, medHistory: med_history, babysubscribe: subscribe, babyssubscribe: ssubscribe, prenatalHrr: prenatalhrr, natalHrr: natalhrr, postNatal: postnatal, babyother: other, exVomit: exvomit, eldPreg: eldpreg, babybp: bp, bloodSugar: bloodsugar, babyabortion: abortion, babyrh: rh, viralInfection: viralinfection, otoMedication: otomedication, chemFume: chemfume, babyalcohol: alcohol, babysmoke: smoke, weightLess: weightless, birthWt : birth_wt, babyjaundice: jaundice, bilLevel: bil_level, babybirthcry: birthcry, prematureDelivery: prematuredel, birthAsphyxia: birthasphyxia, fetalDistress: fetaldistress, babynicu: nicu, apgArone: apgarone, apgarFive: apgarfive, cranioFacial: craniofacial, coGenital: cogenital, deGenerative: degenerative, viralInfect: viralinfect, babyconvulsions: convulsions, babyotitis: otitis, babytrauma: trauma, babyConsanguinity: consanguinity, babyhrr1: hrr1, babyhrr2: hrr2, babyhrr3: hrr3, familyHistory: familyhistory, babymaternal: maternal, babypaternal: paternal, babyhi: hi, babysp: sp, babylg: lg, babymd: md, otherBaby: other, teCheck: techk, oaerightpass: oaertpass, oaeleftpass: oaeltpass, oaerightrefer: oaertrefer, oaeleftrefer: oaeltrefer, oaerightcnt: oaertcnt, oaeleftcnt: oaeltcnt, oaeNoisy: oaenoisy, oaenotcorperation: oaenotcorp, babytechk2: techk2, oaerightpass2: oaertpass2, oaeleftpass2: oaeltpass2, oaerightrefer2: oaertrefer2, oaeleftrefer2: oaeltrefer2, oaerightcnt2: oaertcnt2, oaeleftcnt2: oaeltcnt2, oaeNoisy2: oaenoisy2, oaenotcorperation2: oaenotcorp2, aabrcheck: aabrchk, aabrrightpass: aabrrtpass, aabrleftpass: aabrltpass, aabrrightrefer: aabrrtrefer, aabrleftrefer: aabrltrefer, aabrrightcnt: aabrrtcnt, aabrleftcnt: aabrltcnt, aabrNoisy: aabrnoisy, aabrnotcorperation: aabrnotcorp, nbn500passone: nbn500pass1, nbn500referone: nbn500refer1, nbn500passtwo: nbn500pass2, nbn500refertwo: nbn500refer2, nbn4000passone: nbn4000pass1, nbn4000referone: nbn4000refer1, nbn4000passtwo: nbn4000pass2, nbn4000refertwo: nbn4000refer2, whitenoisypassone: whitenoisypass1, whitenoisyreferone: whitenoisyrefer1, whitenoisypasstwo: whitenoisypass2, whitenoisyrefertwo: whitenoisyrefer2, acanalNormal: acanalnormal, acanalabnormal: acanalAbnormal, moroPresent: moropresent, moroAbsent: moroabsent, rootingPresent: rootingpresent, rootingAbsent: rootingabsent, suckPresent: suckpresent, suckAbsent: suckabsent, tonicPresent: tonicpresent, tonicAbsent: tonicabsent, palmarPresent: palmarpresent, palmarAbsent: palmarabsent, plantarPresent: plantarpresent, planterAbsent: planterabsent, babinskiPresent: babinskipresent, babinskiAbsent: babinskiabsent},
//                   cache: false,
//                   success:function (data) {
//                        alert(data);
//                      };
//                                  
//                   });
//               }


//    function getAgeByBirthDate(date){
//        alert(date);
//        var dob = date;
//        $.ajax({
//            type: "POST",
//            url: Root + 'assets/ajax/getAge.php',
//            data:{birthday:dob},
//            cache: false,
//            success: function (data) {
//                alert(data);
//                $('#age').fadeOut('fast', function()){
//                    $('#age').fadeIn('fast').html(data);
//                }
//            }
//        });
//    }    


var $conditionalInput = $('#input.conditionally-loaded');
//    var $conditionalInput1 = $('#conditionally-loaded1');
//    var $conditionalInput2 = $('#conditionally-loaded2');
//    var $conditionalInput3 = $('#conditionally-loaded3');
//    var $conditionalInput4 = $('#conditionally-loaded4');
//    var $conditionalInput4 = $('#conditionally-loaded4');
//    var $subscribe1 = $('#subscribe1');
//    var $subscribe2 = $('#subscribe2');
//    var $subscribe3 = $('#subscribe3');
//    var $subscribe4 = $('#subscribe4');
//    var $conditionalInput = $('div.conditionally-loaded');
//
//    var $subscribeInput = $('input[name="subscribe"]');
//    //var $ssubscribeInput = $('input[name="ssubscribe"]');
//
//    $conditionalInput.hide();
//    $subscribeInput.on('change', function () {
//        if ($(this).is(':checked')) {
//            $ssubscribeInput.prop("checked", false);
//            $conditionalInput.show();
//
//        } else {
//            $subscribeInput.prop("checked", false);
//            $conditionalInput.hide();
//
//        }
//    });
//
//    $ssubscribeInput.on('change', function () {
//        if ($(this).is(':checked')) {
//            $subscribeInput.prop("checked", false);
//            $subscribe1.prop("checked", false);
//            $conditionalInput.hide();
//            $conditionalInput1.prop("checked", false);
//            $subscribe2.prop("checked", false);
//            $conditionalInput1.hide();
//            $conditionalInput2.prop("checked", false);
//            $subscribe3.prop("checked", false);
//            $conditionalInput2.hide();
//            $conditionalInput3.prop("checked", false);
//            $conditionalInput3.hide();
//            $conditionalInput4.prop("checked", false);
//            $subscribe4.prop("checked", false);
//            $conditionalInput4.hide();
//
//        }
//    });
//
//    var $conditionalInput1 = $('input.conditionally-loaded1');
//    var $conditionalInput1 = $('div.conditionally-loaded1');
//
//    var $subscribeInput1 = $('input[name="subscribe1"]');
//
//    $conditionalInput1.hide();
//    $subscribeInput1.on('click', function () {
//        if ($(this).is(':checked'))
//            $conditionalInput1.show();
//        else
//            $conditionalInput1.hide();
//    });
//
//    var $conditionalInput2 = $('input.conditionally-loaded2');
//    var $conditionalInput2 = $('div.conditionally-loaded2');
//
//    var $subscribeInput2 = $('input[name="subscribe2"]');
//
//    $conditionalInput2.hide();
//    $subscribeInput2.on('click', function () {
//        if ($(this).is(':checked'))
//            $conditionalInput2.show();
//        else
//            $conditionalInput2.hide();
//    });
//
//    var $conditionalInput3 = $('input.conditionally-loaded3');
//    var $conditionalInput3 = $('div.conditionally-loaded3');
//
//    var $subscribeInput3 = $('input[name="subscribe3"]');
//
//    $conditionalInput3.hide();
//    $subscribeInput3.on('click', function () {
//        if ($(this).is(':checked'))
//            $conditionalInput3.show();
//        else
//            $conditionalInput3.hide();
//    });
//
//    var $conditionalInput4 = $('input.conditionally-loaded4');
//    var $conditionalInput4 = $('div.conditionally-loaded4');
//
//    var $subscribeInput4 = $('input[name="subscribe4"]');
//
//    $conditionalInput4.hide();
//    $subscribeInput4.on('click', function () {
//        if ($(this).is(':checked'))
//            $conditionalInput4.show();
//        else
//            $conditionalInput4.hide();
//    });

<!--                        <div id="screeningtwo">
                            <input type='text' name='screen1_id' id='screen1_id' hidden='' value='<?php echo $formData2["screen_one_id"] ?>'>
                            <input type="text" name="screening2_id" id="screening2_id" hidden='' value="<?php echo $formData2["screen_two_id"] ?>"
                            <input type='text' name='screen2_id' id='screen2_id' value='<?php echo $formData2["screen_two_id"] ?> '>
                            <input type='text' name='boa_id' id='boa_id' hidden='' value='<?php echo $formData2["boa_id"] ?>'>
                            <input type='text' name='primReflex_id' id='primReflex_id' hidden='' value='<?php echo $formData2["primitive_id"] ?>'>
                            <input type='text' name='cryAnal_id' id='cryAnal_id' hidden='' value='<?php echo $formData2["aco_id"] ?>'>
                            <input type="text" name="aabrID" id="aabrID"  hidden='' value="<?php echo $formData2["aabr_screen_id"] ?>">
                            <input type='text' name='aabr_id' id='aabr_id' value='<?php echo $formData2["aabr_screen_id"] ?>'>
                        </div>-->
</script>-->       


<!--                        <div class="col-md-1 col-md-offset-1">
                            <div class="form-group">
                            <label class="control-label">Date:</label>
                            <div class="col-md-2 col-md-offset-1 ">
                            <select name="day" size="1" class="form-control">
                                <script type="text/javascript">
                                    for(var j=1;j<32;j++)document.write("<option value="+j+">"+j+"</option>");
                                </script>
                            </select> 

                        </div>
                        <div class="col-md-1 col-md-offset-1">
                            <label >Month</label>
                            <select name="month" size="1" class="form-control">
                                <script type="text/javascript">for (var i = 1; i < 13; i++)
                                        document.write("<option value=" + i + ">" + i + "</option>");</script>
                            </select> 

                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <label >Year</label>
                            <select name="year" size="1" onchange="calage()" class="form-control">
                                <script type="text/javascript">for (var k = startyear; k < endyear; k++)
                                        document.write("<option value=" + k + ">" + k + "</option>");</script>
                            </select> 

                        </div>-->

<!--                            <div role="select" class="jelect">
                                <input id="jelectHosp"  name="screen_program" data-text="imagemin" type="text" onchange="copyValue()" class="jelect-input required" value="">
                                <div tabindex="0" role="button" class="jelect-current"><?php echo $formData1["screening_program"] ?></div>

                                <ul class="jelect-options" name="role">
                                <?php echo getHospitalSelectList() ?>
                                </ul>
                            </div>-->
                            <!--</div>-->
                            
                            