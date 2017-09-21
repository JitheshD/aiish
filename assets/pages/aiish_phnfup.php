<?php
    $patient = $_PID["phonefup"];
    $patientInfo = getPatient($patient);
    //echo $patientInfo["Baby_name"];
?>
<section class="section-large">
    <div class="container">
        <div class='col-md-12'>
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
                        <td class='text-center'><label class="checkbox "><input type="checkbox" id="first_mnth" name="pfupmonth" value="1 month">1 Month</label></td>
                        <td >
                            <div class="col-md-8"id="firstDV" style="display: none">
                                <input type="text" hidden="" id="pid" value="<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="firstRemark" ></textarea></p>
                                <p><button class="btn btn-default pull-right saveRemark" name="savefirstmnth" id="savefirstmnth">Save</button></p>
                            </div>
                            
                        </td>
                    </tr>
<!--                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="second_mnth" name="pfupmonth" value="">2 Month</label></td>
                        <td>
                            <div class="col-md-8" id="secondDV" style="display: none">
                                <input type="text" hidden="" value="2nd month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control"  id="secondRemark"></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveSecondmnth"  id="saveSecondmnth" >Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="third_mnth" name="pfupmonth" value="">3 Month</label></td>
                        <td><div class="col-md-8" id="thirdDV" style="display: none">
                                <input type="text" hidden="" value="3rd month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="thirdRemark" ></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savethirdmnth" id="savethirdmnth">Save</button></p>
                            
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="fourth_mnth" name="pfupmonth" value="">4 Month</label></td>
                        <td><div class="col-md-8" id="fourthDV" style="display: none">
                                <input type="text" hidden="" value="4th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="fourthRemark"></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savefourthmnth" id="savefourthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="fifth_mnth" name="pfupmonth" value="">5 Month</label></td>
                        <td><div class="col-md-8" id="fifthDV" style="display: none">
                                <input type="text" hidden="" value="5th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="fifthRemark"></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savefifthmnth" id="savefifthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="sixth_mnth" name="pfupmonth" value="">6 Month</label></td>
                        <td><div class="col-md-8"id="sixthDV" style="display: none">
                                <input type="text" hidden="" value="6th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="sixthRemark" ></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savesixthmnth" id="savesixthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="seventh_mnth" name="pfupmonth" value="">7 Month</label></td>
                        <td><div class="col-md-8" id="seventhDV" style="display: none">
                                <input type="text" hidden="" value="7th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="seventhRemark" ></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveseventhmnth" id="saveseventhmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="eigth_mnth" name="pfupmonth" value="">8 Month</label></td>
                        <td><div class="col-md-8"id="eigthDV" style="display: none">
                                <input type="text" hidden="" value="8th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="eigthRemark" ></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveeigthmnth" id="saveeigthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="ninth_mnth" name="pfupmonth" value="">9 Month</label></td>
                        <td><div class="col-md-8" id="ninthDV" style="display: none">
                                <input type="text" hidden="" value="9th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="ninthRemark"></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveninthmnth" id="saveninthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="tenth_mnth" name="pfupmonth" value="">10 Month</label></td>
                        <td><div class="col-md-8" id="tenthDV" style="display: none">
                                <input type="text" hidden="" value="10th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="tenthRemark" ></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savetenthmnth" id="savetenthmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="leventh_mnth" name="pfupmonth" value="">11 Month</label></td>
                        <td><div class="col-md-8" id="leventhDV" style="display: none">
                                <input type="text" hidden="" value="11th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="leventhRemark"></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="saveleventhmnth" id="saveleventhmnth">Save</button></p>
                            </div></td>
                    </tr>
                    <tr>
                        <td class='text-center'><label class="checkbox"><input type="checkbox" id="twelth_mnth" name="pfupmonth" value="">12 Month</label></td>
                        <td><div class="col-md-8" id="twelthDV" style="display: none">
                                <input type="text" hidden="" value="12th month,<?php echo $patient ?>">
                                <p><textarea name="remark" class="form-control" id="twelthRemark"></textarea></p>
                                <p><button class="btn btn-default pull-right btn-save" name="savetwelthmnth" id="savetwelthmnth">Save</button></p>
                            </div></td>
                    </tr>-->
                </tbody>
            </table>    
        </div>
    </div>
</section>
<script src="<?php echo HostRoot ?>js/submission/submitscreen.js"></script>
<script>
    function saveFirstRemark(){
        var month = $("#first_mnth").val();
        var p_Id = $("#pid").val();
        var remark = $("#firstRemark").val();
        
        $.ajax({
            type: "POST",
            URL:Root+'assets/ajax/savePfup.php',
            data: {refrmonth: month, refrPid:p_Id, refrRemark: remark},
            cache: false,
            success:function (data) {
                   alert(data); 
                  
               },
               
            });
    }
    </script>
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

</script>

<script>
    
    $(document).ready(function(){
    $('.saveRemark').click(function (e) {
        var refermnth=$(this).closest('div').find('input').val();
         var remark=$(this).closest('div').find('textarea').val();
         alert(refermnth+remark);
         e.preventDefault();
           $.ajax({
            type: "POST",
            URL:Root+'assets/ajax/submitPhonefup.php',
            data: {month: refermnth, mnthRemark: remark},
            cache: false,
            success:function (response) {
                   alert(response); 
                  
               },
               

            });
        
    });

       
    });
</script>