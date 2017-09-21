<?php

include_once '../lib/maincore.php';

$patID = mysql_real_escape_string($_POST["patient_Id"]);
$babysubscribe = mysql_real_escape_string($_POST["babysubscribe"]);
$babyssubscribe = mysql_real_escape_string($_POST["babyssubscribe"]);

//$teCheck = mysql_real_escape_string($_POST["teCheck"]);
$oaeCheck = mysql_real_escape_string($_POST["oaeCheck"]);
$oaeRtScreen1Chk = ($oaeCheck == 1 || $oaeCheck == 2)?"".mysql_real_escape_string($_POST["oaeRtScreen1"])."":"";
$oaeLtScreen1Chk = ($oaeCheck == 1 || $oaeCheck == 2)?"".mysql_real_escape_string($_POST["oaeltScreen1"])."":"";
//$oaerightpass = mysql_real_escape_string($_POST["oaerightpass"]);
//$oaeleftpass = mysql_real_escape_string($_POST["oaeleftpass"]);
//$oaerightrefer = mysql_real_escape_string($_POST["oaerightrefer"]);
//$oaeleftrefer = mysql_real_escape_string($_POST["oaeleftrefer"]);
//$oaerightcnt = mysql_real_escape_string($_POST["oaerightcnt"]);
//$oaeleftcnt = mysql_real_escape_string($_POST["oaeleftcnt"]);
$oaenotcorperation = mysql_real_escape_string($_POST["oaenotcorperation"]);

$oaecheck2 = mysql_real_escape_string($_POST["oaecheck2"]);
//echo $oaecheck2;
//$oaerightpass2 = mysql_real_escape_string($_POST["oaerightpass2"]);
//$oaeleftpass2 = mysql_real_escape_string($_POST["oaeleftpass2"]);
//$oaerightrefer2 = mysql_real_escape_string($_POST["oaerightrefer2"]);
//$oaeleftrefer2 = mysql_real_escape_string($_POST["oaeleftrefer2"]);
//$oaerightcnt2 = mysql_real_escape_string($_POST["oaerightcnt2"]);
//$oaeleftcnt2 = mysql_real_escape_string($_POST["oaeleftcnt2"]);
$oaeRtScreen2 = ($oaecheck2 == 1 || $oaecheck2 == 2)?"".mysql_real_escape_string($_POST["oaeRtScreen2"])."":"";
$oaeLtScreen2 = ($oaecheck2 == 1 || $oaecheck2 == 2)?"".mysql_real_escape_string($_POST["oaeLtScreen2"])."":"";
$oaenotcorperation2 = ($oaecheck2 == 1 || $oaecheck2 == 2)?"".mysql_real_escape_string($_POST["oaenotcorperation2"])."":"";

$aabrcheck = mysql_real_escape_string($_POST["aabrcheck"]);
$aabrrightpass = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrrightpass"])."":"";
$aabrleftpass = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrleftpass"])."":"";
$aabrrightrefer = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrrightrefer"])."":"";
$aabrleftrefer = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrleftrefer"])."":"";
$aabrrightcnt = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrrightcnt"])."":"";
$aabrleftcnt = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrleftcnt"])."":"";
$aabrnotcorperation = ($aabrcheck == 1)?"".mysql_real_escape_string($_POST["aabrnotcorperation"])."":"";

$nbn500passone = mysql_real_escape_string($_POST["nbn500passone"]);
$nbn500referone = mysql_real_escape_string($_POST["nbn500referone"]);
$nbn500passtwo = mysql_real_escape_string($_POST["nbn500passtwo"]);
$nbn500refertwo = mysql_real_escape_string($_POST["nbn500refertwo"]);
$nbn4000passone = mysql_real_escape_string($_POST["nbn4000passone"]);
$nbn4000referone = mysql_real_escape_string($_POST["nbn4000referone"]);
$nbn4000passtwo = mysql_real_escape_string($_POST["nbn4000passtwo"]);
$nbn4000refertwo = mysql_real_escape_string($_POST["nbn4000refertwo"]);
$whitenoisypassone = mysql_real_escape_string($_POST["whitenoisypassone"]);
$whitenoisyreferone = mysql_real_escape_string($_POST["whitenoisyreferone"]);
$whitenoisypasstwo = mysql_real_escape_string($_POST["whitenoisypasstwo"]);
$whitenoisyrefertwo = mysql_real_escape_string($_POST["whitenoisyrefertwo"]);

$acanalNormal = mysql_real_escape_string($_POST["acanalNormal"]);
$acanalabnormal = mysql_real_escape_string($_POST["acanalabnormal"]);

$moroPresent = mysql_real_escape_string($_POST["moroPresent"]);
$moroAbsent = mysql_real_escape_string($_POST["moroAbsent"]);
$rootingPresent = mysql_real_escape_string($_POST["rootingPresent"]);
$rootingAbsent = mysql_real_escape_string($_POST["rootingAbsent"]);
$suckPresent = mysql_real_escape_string($_POST["suckPresent"]);
$suckAbsent = mysql_real_escape_string($_POST["suckAbsent"]);
$tonicPresent = mysql_real_escape_string($_POST["tonicPresent"]);
$tonicAbsent = mysql_real_escape_string($_POST["tonicAbsent"]);
$palmarPresent = mysql_real_escape_string($_POST["palmarPresent"]);
$palmarAbsent = mysql_real_escape_string($_POST["palmarAbsent"]);
$plantarPresent = mysql_real_escape_string($_POST["plantarPresent"]);
$planterAbsent = mysql_real_escape_string($_POST["planterAbsent"]);
$babinskiPresent = mysql_real_escape_string($_POST["babinskiPresent"]);
$babinskiAbsent = mysql_real_escape_string($_POST["babinskiAbsent"]);

$screen1Id = mysql_real_escape_string($_POST["screen1Id"]);
$screen2_Id = mysql_real_escape_string($_POST["screen2Id"]);
$boa_id = mysql_real_escape_string($_POST["boa_id"]);
$primRef_id = mysql_real_escape_string($_POST["primRef_id"]);
$cryAnal_id = mysql_real_escape_string($_POST["cryAnal_id"]);
$aabr_screenId = mysql_real_escape_string($_POST["aabrScreen_id"]);
//$aabr_id = mysql_real_escape_string($_POST["aabr_id"]);

if(empty($screen1Id)){
//    $qry_6 = "INSERT INTO `screening_test_1` (`Patient_Id`, `screen1_type`, `rt_pass`, `lt_pass`, `rt_refer`, `lt_refer`, `rt_cnt_noisy`, `lt_cnt_noisy`, `lt_cnt_ntco_op`, `rt_cnt_ntco_op`) VALUES('$patID', '$oaeCheck', '$oaerightpass', '$oaeleftpass', '$oaerightrefer', '$oaeleftrefer', '$oaerightcnt', '$oaeleftcnt', '$oaenotcorperation', '$oaenotcorperation' )";
    $qry_6 = "INSERT INTO `screening_test_1` (`Patient_Id`, `screen1_type`, `rt_screen1`, `lt_screen1`, `rt_cnt_ntco_op`) VALUES('$patID', '$oaeCheck', '$oaeRtScreen1Chk', '$oaeLtScreen1Chk', '$oaenotcorperation' )";
    $screening1msg = "1st Screening test is inserted with Id-";
}else{
    $qry_6 = "UPDATE `screening_test_1` SET `Patient_Id` = '$patID', `screen1_type` = '$oaeCheck', `rt_screen1` = '$oaeRtScreen1Chk', `lt_screen1` = '$oaeLtScreen1Chk', `rt_cnt_ntco_op` = '$oaenotcorperation' WHERE `screen_one_id` = '$screen1Id'";

    $screening1msg = "1st Screening test data are updated to Id-";
}
mysql_query($qry_6);
//echo $qry_6;

$screenid1 = mysql_insert_id();
$screen_id1 = ($screenid1 == 0)?"$screen1Id":"$screenid1";

//if(empty($screen2Id)){
if(empty($screen2_Id)){
    $qry_7 = "INSERT INTO `screening_test_2` (`Patient_Id`, `screen2_type`, `rt_screen2`, `lt_screen2`, `lt_cnt_ntco_op_two`) VALUES('$patID', '$oaecheck2', '$oaeRtScreen2', '$oaeLtScreen2' , '$oaenotcorperation2')";
    $screening2msg = "2nd Screening test data are inserted with Id-";
}else{
    $qry_7 = "UPDATE `screening_test_2` SET `Patient_Id` = '$patID', `screen2_type` = '$oaecheck2', `rt_screen2` = '$oaeRtScreen2', `lt_screen2` = '$oaeLtScreen2', `rt_cnt_ntco_op_two` = '$oaenotcorperation2' WHERE `screen_two_id` = '$screen2_Id'";

    $screening2msg = "2nd Screening test data are updated to Id-";
}
//echo $qry_7;
//echo $qry_6-$qry_7;
//if($screen2Id == ""){
//    $qry_7 = "INSERT INTO `screening_test_2` (`Patient_Id`, `rt_two_pass`, `lt_two_pass`, `rt_two_refer`, `lt_two_refer`, `rt_cnt_two_noisy`, `lt_cnt_two_noisy`, `lt_cnt_ntco_op_two`) VALUES('$patID', '$oaerightpass2', '$oaeleftpass2', '$oaerightrefer2', '$oaeleftrefer2', '$oaerightcnt2', '$oaeleftcnt2', '$oaenotcorperation2')";
//}else{
//    $qry_7 = "UPDATE `screening_test_2` SET `Patient_Id` = '$patID', `rt_two_pass` = '$oaerightpass2', `lt_two_pass` = '$oaeleftpass', `rt_two_refer` = '$oaerightrefer2', `lt_two_refer` = '$oaeleftrefer2', `rt_cnt_two_noisy` = '$oaerightcnt2', `lt_cnt_two_noisy` = '$oaeleftcnt2', `rt_cnt_ntco_op_two` = '$oaenotcorperation2' WHERE `screen_two_id` = '$screen2Id'";
//}
mysql_query($qry_7);
$screenid2 = mysql_insert_id();
$screen_id2 = ($screenid2 == 0)?"$screen2_Id":"$screenid2";

if(empty($aabr_screenId)){
    $qry_8 = "INSERT INTO `aabr_screen` (`Patient_Id`, `aabr_chk`, `aabr_rt_pass`, `aabr_lt_pass`, `aabr_rt_refer`, `aabr_lt_refer`, `aabr_rt_cnt_noisy`, `aabr_lt_cnt_noisy`, `aabr_rt_cnt_ntco_op`) VALUES('$patID', '$aabrcheck', '$aabrrightpass', '$aabrleftpass', '$aabrrightrefer', '$aabrleftrefer', '$aabrrightcnt', '$aabrleftcnt', '$aabrnotcorperation')";

    $aabrmsg = "AABR Screening data are inserted with Id-";
}else{
    $qry_8 = "UPDATE `aabr_screen` SET `Patient_Id` = '$patID', `aabr_chk` = '$aabrcheck', `aabr_rt_pass` = '$aabrrightpass', `aabr_lt_pass` = '$aabrleftpass', `aabr_rt_refer` = '$aabrrightrefer', `aabr_lt_refer` = '$aabrleftrefer', `aabr_rt_cnt_noisy` = '$aabrrightcnt', `aabr_lt_cnt_noisy` = '$aabrleftcnt', `aabr_rt_cnt_ntco_op` = '$aabrnotcorperation' WHERE `aabr_screen_id` = '$aabr_screenId'";
    $aabrmsg = "AABR Screening data are updated to Id-";
    
}
//echo $qry_8;
mysql_query($qry_8);
$aabrid = mysql_insert_id();

$aabr_ID = ($aabrid == 0)?"$aabr_screenId":"$aabrid";

if(empty($boa_id)){
    $qry_9 = "INSERT INTO `behavioral_obs_audiometry` (`Patient_Id`, `fivehz_80dBHL_pass`, `fivehz_50dBHL_pass`, `fivehz_80dBHL_refer`, `fivehz_50dBHL_refer`, `fourhz_80dBHL_pass`, `fourhz_50dBHL_pass`, `fourhz_80dBHL_refer`, `fourhz_50dBHL_refer`, `whitenoise_80dBHL_pass`, `whitenoise_50dBHL_pass`, `whitenoise_80dBHL_refer`, `whitenoise_50dBHL_refer`) VALUES('$patID', '$nbn500passone', '$nbn500passtwo', '$nbn500referone', '$nbn500refertwo', '$nbn4000passone', '$nbn4000passtwo', '$nbn4000referone', '$nbn4000refertwo', '$whitenoisypassone', '$whitenoisypasstwo', '$whitenoisyreferone', '$whitenoisyrefertwo')";

    $boamsg = "BOA data are inserted with Id-";
}
else{
    $qry_9 = "UPDATE `behavioral_obs_audiometry` SET `Patient_Id` = '$patID', `fivehz_80dBHL_pass` = '$nbn500passone', `fivehz_50dBHL_pass` = '$nbn500passtwo', `fivehz_80dBHL_refer` = '$nbn500referone', `fivehz_50dBHL_refer` = '$nbn500refertwo', `fourhz_80dBHL_pass` = '$nbn4000passone', `fourhz_50dBHL_pass` = '$nbn4000passtwo', `fourhz_80dBHL_refer` = '$nbn4000referone', `fourhz_50dBHL_refer` = '$nbn4000refertwo', `whitenoise_80dBHL_pass` = '$whitenoisypassone', `whitenoise_50dBHL_pass` = '$whitenoisypasstwo', `whitenoise_80dBHL_refer` = '$whitenoisyreferone', `whitenoise_50dBHL_refer` = '$whitenoisyrefertwo' WHERE `boa_id` = '$boa_id'";

    $boamsg = "BOA data are updated to Id-";
}
    mysql_query($qry_9);
    $boaID = mysql_insert_id();
    
    $behaveObsAud_id = ($boaID == 0)? "$boa_id":"$boaID";

if(empty($cryAnal_id)){
    $qry_10 = "INSERT INTO `acoustic_analysis` (`Patient_Id`, `normal_val`, `abnormal_val`) VALUES('$patID', '$acanalNormal', '$acanalabnormal' )";

    $acanalmsg = "Acoustic analysis data are inserted with Id-";
}
else{
    $qry_10 = "UPDATE `acoustic_analysis` SET `Patient_Id` = '$patID', `normal_val` = '$acanalNormal', `abnormal_val` = '$acanalabnormal' WHERE `aco_id` = '$cryAnal_id'";

    $acanalmsg = "Acoustic analysis data are updated to Id-";
}
    mysql_query($qry_10);
    $acAnalID = mysql_insert_id(); 
    
    $acAnal_id = ($acAnalID == 0)? "$cryAnal_id":"$acAnalID";

if(empty($primRef_id)){
    $qry_11 = "INSERT INTO `primitive_reflex`(`Patient_Id`, `moro_pre`, `moro_abs`, `root_pre`, `root_abs`, `suck_pre`, `suck_abs`, `tonicneck_pre`, `tonicneck_abs`, `palmar_pre`, `palmar_abs`, `plantar_pre`, `plantar_abs`, `babinski_pre`, `babinski_abs`) VALUES('$patID', '$moroPresent', '$moroAbsent', '$rootingPresent', '$rootingAbsent', '$suckPresent', '$suckAbsent', '$tonicPresent', '$tonicAbsent', '$palmarPresent', '$palmarAbsent', '$plantarPresent', '$planterAbsent', '$babinskiPresent', '$babinskiAbsent')";

    $primRefMsg = "Primitive Reflexes data are inserted with Id-";
}else{
    $qry_11 = "UPDATE `primitive_reflex` SET `Patient_Id` = '$patID', `moro_pre` = '$moroPresent', `moro_abs` = '$moroAbsent', `root_pre` = '$rootingPresent', `root_abs` = '$rootingAbsent', `suck_pre` = '$suckPresent', `suck_abs` = '$suckAbsent', `tonicneck_pre` = '$tonicPresent', `tonicneck_abs` = '$tonicAbsent', `palmar_pre` = '$palmarPresent', `palmar_abs` = '$palmarAbsent', `plantar_pre` = '$plantarPresent', `plantar_abs`= '$planterAbsent', `babinski_pre` = '$babinskiPresent', `babinski_abs` = '$babinskiAbsent' WHERE `primitive_id` = '$primRef_id'";

    $primRefMsg = "Primitive Reflexes data are updated to Id-";
}

    mysql_query($qry_11);
    $primReflex_id = mysql_insert_id();
    $primReflex = ($primReflex_id == 0)? "$primRef_id":"$primReflex_id";
  
 
$qryOAELog = "INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'data-entry(OAE Screen)', '$screening1msg $screen_id1 && $screening2msg $screen_id2 & $boamsg $behaveObsAud_id & $primRefMsg & $aabrmsg $aabr_ID & $acanalmsg $acAnal_id')";    
echo "

    <input type='text' name='screen1_id' id='screen1_id' hidden=''  value='$screen_id1'>
    <input type='text' name='screening2_id' id='screening2_id' hidden=''  value='$screen_id2 '>
    <input type='text' name='boa_id' id='boa_id' hidden=''  value='$behaveObsAud_id'>
    <input type='text' name='primReflex_id' id='primReflex_id' hidden=''  value='$primReflex'>
    <input type='text' name='cryAnal_id' id='cryAnal_id' hidden=''  value='$acAnal_id'>
    <input type='text' name='aabr_id' id='aabr_id' hidden=''   value='$aabr_ID'>  

<div id='inner2'>
    ".getImpressionStatus($patID,$babyssubscribe)."
</div> 

";


?>



<script>
    function getnbsList(chknbs){
        var nbs_list = document.getElementById("nbsList");
        nbs_list.style.display = chknbs.checked ? "block" : "none";
    }
    function getoscList(chkosc){
        var osc_list = document.getElementById("oscList");
        osc_list.style.display = chkosc.checked ? "block" : "none";
    }
    function getaiishList(chkaiish){
        var aiish_list = document.getElementById("aiishList");
        aiish_list.style.display = chkaiish.checked ? "block" : "none";
    }
</script>

<script type="text/javascript">
    $('#nbscentr').click(function(){
        $("#nbsDV").toggle(this.checked);
        $("#oscDV").hide();
        $("#aiishDV").hide();
//        $("#oscDV").style.display = 'none';
        
            
    });
    $('#osccentr').click(function(){
        $("#oscDV").toggle(this.checked);
        $("#nbsDV").hide();
        $("#aiishDV").hide();
//         $("#nbsDV").style.display = 'none';   
    });
    
    $('#aiishcentr').click(function(){
        $("#aiishDV").toggle(this.checked);
        $("#nbsDV").hide();
        $("#oscDV").hide();
//         $("#nbsDV").style.display = 'none';   
    });
    
</script>    