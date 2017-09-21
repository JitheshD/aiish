


<?php 
    $patient = $_PID["test"];
    $patientInfo = getPatient($patient);
?>


<style>
    .results tr[visible='false'],
    .no-result{
      display:none;
    }

    .results tr[visible='true']{
      display:table-row;
    }

    .counter{
      padding:8px; 
      color:#ccc;
    }
    
    
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type='text/css' media='all' />
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php if(USERAUTH == 2){ ?><h1>Medical Officer Page</h1><?php } ?>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">
        
        <div class='col-md-12'>
            <?php 
            $testString = "admin";
            $encodetestString = encode($testString);
            $decodetestString = decode($encodetestString);
            echo "Encode:". $encodetestString; 
            echo "Decode:". $decodetestString; 
            
            
            ?>
            
            <table class='table'>
                <tbody>
                    <tr>
                        <th class='text-center'>POCD no.</th>
                        <th class='text-center'>Baby id</th>
                        <th class='text-center'>Baby name</th>
                        <th class='text-center'>Date of exam</th>
                        <th class='text-center'>Contact Number</th>
                        <th class='text-center'>Impression</th>
                    </tr>

                    <tr>
                        <td class='text-center'><?php echo $patientInfo["POCD_No"]; ?></td>

                        <td class='text-center'><?php echo $patientInfo["baby_id_num"]; ?></td>

                        <td class='text-center'><?php echo $patientInfo["baby_id_num"]; ?></td>

                        <td class='text-center'><?php echo $patientInfo["Date_of_HRR_Screen"]; ?></td>
                        <td class='text-center'><?php echo $patientInfo["Phone_number"]; ?></td>

                        <td class='text-center'><?php echo getImpressionByID($patientInfo["test_impression"]); ?></td>
                    </tr>
                </tbody>
            </table>    
        </div>
        
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr>
                        <th class='text-center'>Month</th>
                        <th class=''>Test Remarks</th>
                    </tr>

                    <tr>
                        
                        <?php 
                        $month="1st month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $firstCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?>
                        
                        <td class='text-center'><label class="checkbox "><input type="checkbox" id="first_mnth" name="pfupmonth" <?php echo $firstCheck ?> value="1 month">1 Month</label></td>
                        <td >
                            <?php $firstDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8"id="firstDV" style="<?php echo $firstDiv ?>">
                                <input type="text" hidden="" id="pid" value="1st month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="firstRemark" ><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savefirstmnth" id="savefirstmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="2nd month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $secondCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="second_mnth" name="pfupmonth" <?php echo $secondCheck ?> value="">2 Month</label></td>
                        <td>
                            <?php $secondDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="secondDV" style="<?php echo $secondDiv ?>">
                                <input type="text" hidden="" value="2nd month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control"  id="secondRemark"><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveSecondmnth"  id="saveSecondmnth" >Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                       <?php 
                        $month="3rd month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $thirdCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="third_mnth" name="pfupmonth" <?php echo $thirdCheck ?> value="">3 Month</label></td>
                        <td>
                            <?php $thirdDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="thirdDV" style="<?php echo $thirdDiv ?>">
                                <input type="text" hidden="" value="3rd month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="thirdRemark" ><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savethirdmnth" id="savethirdmnth">Save</button></p>
                            
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <?php 
                        $month="4th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $fourthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="fourth_mnth" name="pfupmonth" <?php echo $fourthCheck ?> value="">4 Month</label></td>
                        <td>
                            <?php $fourthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="fourthDV" style="<?php echo $fourthDiv ?>">
                                <input type="text" hidden="" value="4th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="fourthRemark"><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savefourthmnth" id="savefourthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="5th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $fifthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="fifth_mnth" name="pfupmonth" <?php echo $fifthCheck ?> value="">5 Month</label></td>
                        <td>
                            <?php $fifthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="fifthDV" style="<?php echo $fifthDiv ?>">
                                <input type="text" hidden="" value="5th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="fifthRemark"><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savefifthmnth" id="savefifthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="6th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $sixthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="sixth_mnth" name="pfupmonth" <?php  echo $sixthCheck ?> value="">6 Month</label></td>
                        <td>
                            <?php $sixthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8"id="sixthDV" style="<?php echo $sixthDiv ?>">
                                <input type="text" hidden="" value="6th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="sixthRemark" ><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savesixthmnth" id="savesixthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="7th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $seventhCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="seventh_mnth" name="pfupmonth" <?php echo $seventhCheck ?> value="">7 Month</label></td>
                        <td>
                            <?php $seventhDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="seventhDV" style="<?php echo $seventhDiv ?>">
                                <input type="text" hidden="" value="7th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="seventhRemark" ><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveseventhmnth" id="saveseventhmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="8th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $eigthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="eigth_mnth" name="pfupmonth" <?php echo $eigthCheck ?> value="">8 Month</label></td>
                        <td>
                            <?php $eigthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8"id="eigthDV" style="<?php echo $eigthDiv ?>">
                                <input type="text" hidden="" value="8th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="eigthRemark" ><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveeigthmnth" id="saveeigthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="9th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $ninthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?> 
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="ninth_mnth" name="pfupmonth" <?php echo $ninthCheck ?> value="">9 Month</label></td>
                        <td>
                            <?php $ninthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="ninthDV" style="<?php echo $ninthDiv ?>">
                                <input type="text" hidden="" value="9th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="ninthRemark"><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveninthmnth" id="saveninthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="10th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $tenthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="tenth_mnth" name="pfupmonth" <?php echo $tenthCheck ?> value="">10 Month</label></td>
                        <td>
                            <?php $tenthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="tenthDV" style="<?php echo $tenthDiv ?>">
                                <input type="text" hidden="" value="10th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="tenthRemark" ><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savetenthmnth" id="savetenthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="11th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $leventhCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="leventh_mnth" name="pfupmonth" <?php echo $leventhCheck ?> value="">11 Month</label></td>
                        <td>
                            <?php $leventhDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="leventhDV" style="<?php echo $leventhDiv ?>">
                                <input type="text" hidden="" value="11th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="leventhRemark"><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveleventhmnth" id="saveleventhmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <?php 
                        $month="12th month";
                        $pfup = getPfupBymnth($patient,$month); 
                        $twelthCheck = (!empty($pfup["pfup_id"]))?"checked=''":"";        
                        ?>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="twelth_mnth" name="pfupmonth" <?php echo $twelthCheck ?> value="">12 Month</label></td>
                        <td>
                            <?php $twelthDiv = (!empty($pfup["pfup_id"]))?"display: block":"display: none";  ?>
                            <div class="col-md-8" id="twelthDV" style="<?php echo $twelthDiv ?>">
                                <input type="text" hidden="" value="12th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="twelthRemark"><?php echo $pfup["pfup_remark"] ?></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savetwelthmnth" id="savetwelthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        
        
        
        
        
        
        
        

    </div>
</section><!-- end section -->

<script>


    $('#first_mnth').click(function(){
        $("#firstDV").toggle(this.checked);
   
    });
    
    $('#second_mnth').click(function(){
        $("#secondDV").toggle(this.checked);
   
    });
    $('#third_mnth').click(function(){
        $("#thirdDV").toggle(this.checked);
   
    });
    $('#fourth_mnth').click(function(){
        $("#fourthDV").toggle(this.checked);
   
    });
    $('#fifth_mnth').click(function(){
        $("#fifthDV").toggle(this.checked);
   
    });
    $('#sixth_mnth').click(function(){
        $("#sixthDV").toggle(this.checked);
   
    });
    $('#seventh_mnth').click(function(){
        $("#seventhDV").toggle(this.checked);
   
    });
    $('#eigth_mnth').click(function(){
        $("#eigthDV").toggle(this.checked);
   
    });
    $('#ninth_mnth').click(function(){
        $("#ninthDV").toggle(this.checked);
   
    });
    $('#tenth_mnth').click(function(){
        $("#tenthDV").toggle(this.checked);
   
    });
    $('#leventh_mnth').click(function(){
        $("#leventhDV").toggle(this.checked);
   
    });
    $('#twelth_mnth').click(function(){
        $("#twelthDV").toggle(this.checked);
   
    });

    
    $('.btn-save').click(function (e) {
        var refermnth=$(this).closest('div').find('input').val();
         var remark=$(this).closest('div').find('textarea').val();
         //alert(refermnth+remark);
         
           $.ajax({
                type: "POST",
                url: Root + 'assets/ajax/submitTest.php',
                data: { month: refermnth, fupRemark: remark},
                cache: false,
                success: function (data) {
                    alert(data);
                    $('#patUniqId').fadeIn('fast').html(data);    
                }

            });
        
    });








//function submitPatientTest(){
//    //alert("test");
//    var hospid = $("#jelectHosp").val();
//    
//    var baby_name = $("#babyName").val();
//    var birth_date = $("#birthdate").val();
//    
//    
//    $.ajax({
//        type: "POST",
//        url: Root + 'assets/ajax/submitTest.php',
//        data: {hospId: hospid, babyName: baby_name, birthDate: birth_date},
//        cache: false,
//        success: function (data) {
//            alert(data);
//            
//        }
//        
//    });
//}
//function saveFirstRemark(){
//    var patId = $("#pid").val();
//    var mnth = $("#first_mnth").val();
//    var remark = $("#firstRemark").val();
//    alert("test");
//    $.ajax({
//        type: "POST",
//        url: Root + 'assets/ajax/submitTest.php',
//        data: {patient: patId, month: mnth, fupRemark: remark},
//        cache: false,
//        success: function (data) {
//            alert(data);
//            
//        }
//        
//    });
//}



//function savTest(){
//    var test = $("#testval").val();
//    alert(test);
//    $.ajax({
//        type: "POST",
//        url: Root + 'assets/ajax/submitTest.php',
//        data: {hospId: test},
//        cache: false,
//        success: function (data) {
//            alert(data);
//            
//        }
//        
//    });
//}
    </script>
    
    
    <!--        <div class="row setup-content" id="step-1">
                <div class="col-xs-12 col-md-offset-1">

                    <div class="col-md-12 ">
                        <h3> 1. Demographic Details:</h3>
                        <div class="col-md-3 col-md-offset-1">
                            <div class="form-group">
                            <label class="control-label">Hospital name</label>
                            <select name="hospital" id="jelectHosp" size="1" class="form-control">
                                <?php echo HospitalSelectOption($formData["Hospital_Name"]);?>
                            </select>
                            


                        </div>   
                        
                    </div>
                    <div class="col-md-12 ">
                        <div class="col-md-3 col-md-offset-1">
                            <div class="form-group">
                            <label class="control-label">Baby Name:</label>
                            <input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" value="<?php echo $formData1["batch_no"] ?>"  />
                            <input type="text" size="10" name="babyName" class="form-control" id="babyName" value="<?php echo $formData["Baby_name"] ?>"  required>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-md-offset-1">
                            <label class="control-label">Birth Date</label>
                            <input type="text" class="form-control datetimepicker" name="birthdate" id="birthdate" value="<?php echo $formData["Date_of_Birth"] ?>">
                        </div>
                        
                        

                        
                    </div>
                    
                    <button class="btn btn-primary nextBtn btn-lg pull-right" onclick="submitPatientTest()" type="button" >Next</button>
                    <input type="text" id="testval" value="">
                    <button onclick="savTest()">SavTest</button>
                </div>
            
                </div>
            </div>-->