<?php

include_once '../lib/maincore.php';

$hospital_id = mysql_real_escape_string($_POST["hospId"]);
$babynum = mysql_real_escape_string($_POST["babynum"]);
$pocdnum = mysql_real_escape_string($_POST["pocdnum"]);
$babyName = mysql_real_escape_string($_POST["babyName"]);
$birthDate = mysql_real_escape_string($_POST["birthDate"]);
$babyage = mysql_real_escape_string($_POST["babyage"]);
$babyfather = mysql_real_escape_string($_POST["babyfather"]);
$babymother = mysql_real_escape_string($_POST["babymother"]);
$contactNo = mysql_real_escape_string($_POST["contactNo"]);
$emailId = mysql_real_escape_string($_POST["emailId"]);
$babygender = mysql_real_escape_string($_POST["babygender"]);
$babystate = mysql_real_escape_string($_POST["babystate"]);
$babydistrict = mysql_real_escape_string($_POST["babydistrict"]);
$babycity = mysql_real_escape_string($_POST["babycity"]);
$preAddress = mysql_real_escape_string($_POST["preAddress"]);
$peraddress = mysql_real_escape_string($_POST["peraddress"]);
$hospName = mysql_real_escape_string($_POST["hospName"]);
$deliveryType = mysql_real_escape_string($_POST["deliveryType"]);
$babyregion = mysql_real_escape_string($_POST["babyregion"]);
$babyreligion = mysql_real_escape_string($_POST["babyreligion"]);
$babycaste = mysql_real_escape_string($_POST["babycaste"]);
$babysocioeco = mysql_real_escape_string($_POST["babysocioeco"]);
$staffName = mysql_real_escape_string($_POST["staffName"]);
$screenDate = mysql_real_escape_string($_POST["screenDate"]);
$medHistory = mysql_real_escape_string($_POST["medHistory"]);
$babysubscribe = mysql_real_escape_string($_POST["babysubscribe"]);
$babyssubscribe = mysql_real_escape_string($_POST["babyssubscribe"]);
$prenatalHrr = mysql_real_escape_string($_POST["prenatalHrr"]);
$natalHrr = mysql_real_escape_string($_POST["natalHrr"]);
$postNatal = mysql_real_escape_string($_POST["postNatal"]);
$babyother = mysql_real_escape_string($_POST["babyother"]);
$exVomit = mysql_real_escape_string($_POST["exVomit"]);
$eldPreg = mysql_real_escape_string($_POST["eldPreg"]);
$babybp = mysql_real_escape_string($_POST["babybp"]);
$bloodSugar = mysql_real_escape_string($_POST["bloodSugar"]);
$babyabortion = mysql_real_escape_string($_POST["babyabortion"]);
$babyrh = mysql_real_escape_string($_POST["babyrh"]);
$viralInfection = mysql_real_escape_string($_POST["viralInfection"]);
$infection = mysql_real_escape_string($_POST["infect"]);
$otoMedication = mysql_real_escape_string($_POST["otoMedication"]);
$chemFume = mysql_real_escape_string($_POST["chemFume"]);
$babyalcohol = mysql_real_escape_string($_POST["babyalcohol"]);
$babysmoke = mysql_real_escape_string($_POST["babysmoke"]);
$weightLess = mysql_real_escape_string($_POST["weightLess"]);
$birth_wt = mysql_real_escape_string($_POST["birth_wt"]);
$babyjaundice = mysql_real_escape_string($_POST["jaundice"]);
$bilLevel = mysql_real_escape_string($_POST["bilLevel"]);
$prematuredel = mysql_real_escape_string($_POST["prematuredel"]);
$babybirthcry = mysql_real_escape_string($_POST["babybirthcry"]);
$prematureDelivery = mysql_real_escape_string($_POST["prematureDelivery"]);
$birthAsphyxia = mysql_real_escape_string($_POST["birthAsphyxia"]);
$fetalDistress = mysql_real_escape_string($_POST["fetalDistress"]);
$babynicu = mysql_real_escape_string($_POST["babynicu"]);
$apgArone = mysql_real_escape_string($_POST["apgArone"]);
$apgarFive = mysql_real_escape_string($_POST["apgarFive"]);
$cranioFacial = mysql_real_escape_string($_POST["cranioFacial"]);
$coGenital = mysql_real_escape_string($_POST["coGenital"]);
$deGenerative = mysql_real_escape_string($_POST["deGenerative"]);
$viralInfect = mysql_real_escape_string($_POST["viralInfect"]);
$babyconvulsions = mysql_real_escape_string($_POST["babyconvulsions"]);
$babyotitis = mysql_real_escape_string($_POST["babyotitis"]);
$babytrauma = mysql_real_escape_string($_POST["babytrauma"]);
$babyConsanguinity = mysql_real_escape_string($_POST["babyConsanguinity"]);
$babyhrr1 = mysql_real_escape_string($_POST["babyhrr1"]);
$babyhrr2 = mysql_real_escape_string($_POST["babyhrr2"]);
$babyhrr3 = mysql_real_escape_string($_POST["babyhrr3"]);
$familyHistory = mysql_real_escape_string($_POST["familyHistory"]);
$babymaternal = mysql_real_escape_string($_POST["babymaternal"]);
$babypaternal = mysql_real_escape_string($_POST["babypaternal"]);
$babyHi = mysql_real_escape_string($_POST["babyhi"]);
$babysp = mysql_real_escape_string($_POST["babysp"]);
$babylg = mysql_real_escape_string($_POST["babylg"]);
$babymd = mysql_real_escape_string($_POST["babymd"]);
$otherBaby = mysql_real_escape_string($_POST["otherBaby"]);
$teCheck = mysql_real_escape_string($_POST["teCheck"]);
$oaerightpass = mysql_real_escape_string($_POST["oaerightpass"]);
$oaeleftpass = mysql_real_escape_string($_POST["oaeleftpass"]);
$oaerightrefer = mysql_real_escape_string($_POST["oaerightrefer"]);
$oaeleftrefer = mysql_real_escape_string($_POST["oaeleftrefer"]);
$oaerightcnt = mysql_real_escape_string($_POST["oaerightcnt"]);
$oaeleftcnt = mysql_real_escape_string($_POST["oaeleftcnt"]);
$oaeNoisy = mysql_real_escape_string($_POST["oaeNoisy"]);
$oaeNoisy = mysql_real_escape_string($_POST["oaeNoisy"]);
$oaenotcorperation = mysql_real_escape_string($_POST["oaenotcorperation"]);
$babytechk2 = mysql_real_escape_string($_POST["babytechk2"]);
$oaerightpass2 = mysql_real_escape_string($_POST["oaerightpass2"]);
$oaeleftpass2 = mysql_real_escape_string($_POST["oaeleftpass2"]);
$oaerightrefer2 = mysql_real_escape_string($_POST["oaerightrefer2"]);
$oaeleftrefer2 = mysql_real_escape_string($_POST["oaeleftrefer2"]);
$oaerightcnt2 = mysql_real_escape_string($_POST["oaerightcnt2"]);
$oaeleftcnt2 = mysql_real_escape_string($_POST["oaeleftcnt2"]);
$oaeNoisy2 = mysql_real_escape_string($_POST["oaeNoisy2"]);
$oaenotcorperation2 = mysql_real_escape_string($_POST["oaenotcorperation2"]);
$aabrcheck = mysql_real_escape_string($_POST["aabrcheck"]);
$aabrrightpass = mysql_real_escape_string($_POST["aabrrightpass"]);
$aabrleftpass = mysql_real_escape_string($_POST["aabrleftpass"]);
$aabrrightrefer = mysql_real_escape_string($_POST["aabrrightrefer"]);
$aabrleftrefer = mysql_real_escape_string($_POST["aabrleftrefer"]);
$aabrrightcnt = mysql_real_escape_string($_POST["aabrrightcnt"]);
$aabrleftcnt = mysql_real_escape_string($_POST["aabrleftcnt"]);
$aabrNoisy = mysql_real_escape_string($_POST["aabrNoisy"]);
$aabrnotcorperation = mysql_real_escape_string($_POST["aabrnotcorperation"]);
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

$qry_1 = "INSERT INTO `patient` (`Hospital_Name`, `Delivery_type_Name`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Caste`, `Region`, `Present_address`, `Permanent_address`, `Phone_number`, `Email_id`, `Income_per_month`, `Medical_history`, `Date_of_HRR_Screen`, `user_name`) VALUES('$hospital_id', '$deliveryType', '$babynum', '$babyName', '$pocdnum', '$dateOfBirth', '$babyage', '$babygender', '$babyfather', '$babymother', '$babyreligion', '$babycaste', '$babyregion', '$preAddress', '$peraddress', '$contactNo', '$emailId', '$babysocioeco', '$medHistory', '$screenDate', '$staffName')";
mysql_query($qry_1);
//echo $qry_1;
//$patient_id = mysql_insert_id($qry_1);
$patient_id = mysql_insert_id();

//echo $patient_id."-".$patient_id2;

$qry_2 = "INSERT INTO `pre_natal_hrr` (`Patient_Id`, `baby_id_num`, `POCD_No`, `excessive_vomiting`, `elderly_pregnanacy`, `highlow_bp`, `blood_sugar`, `ho_abortions`, `rh_incompatitlibility`, `viralbacterial_infections`, `oto_tox_med`, `chem_fum`, `alcohol`, `smoking`) VALUES('$patient_id', '$babynum', '$pocdnum', '$exVomit', '$eldPreg', '$babybp', '$bloodSugar', '$babyabortion', '$babyrh', '$viralInfect', '$otoMedication', '$chemFume', '$babyalcohol', '$babysmoke' )";
mysql_query($qry_2);
$preNatalId = mysql_insert_id($qry_2);

$qry_3 = "INSERT INTO `natal_hrr` (`Patient_Id`, `lbw`, `nj`, `ba`, `fd`, `as_1min`, `as_5min`, `natal_hrr`, `birth_wt`, `bilrubin_level`, `delayed_birth_cry`, `premature_delivery_week`, `aspiration_of_fluid_days`, `baby_id_num`, `POCD_No`) "
        . "VALUES('$patient_id', '$weightLess', '$babyjaundice', '$birthAsphyxia', '$fetalDistress', '$apgArone', '$apgarFive', '$natalHrr', '$birth_wt', '$bilLevel', '$$babybirthcry', '$prematureDelivery', '$babynicu', '$babynum', '$pocdnum');";

mysql_query($qry_3);

$natal_id = mysql_insert_id($qry_3);

$qry_4 = "INSERT INTO `post_natal_hrrr`(`csa`,`ca`, `dd`, `vbf`, `cnv`, `omwe`, `thn`, `baby_id_num`, `POCD_No`, `Patient_Id`) "
        . "VALUES('$cranioFacial', '$coGenital', '$deGenerative', '$viralInfect', '$babyconvulsions', '$babyotitis', '$babytrauma', '$babynum', '$pocdnum', '$patient_id' )";

mysql_query($qry_4);
$postNatal_id = mysql_insert_id($qry_4);

$qry_5 = "INSERT INTO `other_hrr` (`Patient_Id`, `baby_id_num`, `POCD_No`, `cons_pos_val`, `cons_neg_val`, `conspos1`, `conspos2`, `conspos3`,  `fam_his_pos`, `fam_his_neg`, `fam_his_mat`, `fam_his_pat`, `fam_his_hi`, `fam_his_sp`, `fam_his_lg`, `fam_his_md`, `fam_his_oth`) VALUES('$patient_id', '$babynum', '$pocdnum', '$babyConsanguinity', '$babyConsanguinity', '$babyhrr1', '$babyhrr2', '$babyhrr3', '$familyHistory', '', '$babymaternal', '$babypaternal', '$babyHi', '$babysp', '$babylg', '$babymd', '$otherBaby' )";
mysql_query($qry_5);

$otherId = mysql_insert_id($qry_5);

$qry_6 = "INSERT INTO `screening_test_1` (`Patient_Id`, `baby_id_num`, `POCD_No`, `rt_pass`, `lt_pass`, `rt_refer`, `lt_refer`, `rt_cnt_noisy`, `lt_cnt_noisy`, `lt_cnt_ntco_op`, `rt_cnt_ntco_op`) VALUES('$patient_id', '$babynum', '$pocdnum', '$oaerightpass', '$oaeleftpass', '$oaerightrefer', '$oaeleftrefer', '$oaerightcnt', '$oaeleftcnt', '$oaenotcorperation', '$oaenotcorperation' )";


mysql_query($qry_6);

$screen_id1 = mysql_insert_id($qry_6);

$qry_7 = "INSERT INTO `screening_test_2` (`Patient_Id`, `baby_id_num`, `POCD_No`, `rt_pass`, `lt_pass`, `rt_refer`, `lt_refer`, `rt_cnt_noisy`, `lt_cnt_noisy`, `lt_cnt_ntco_op`, `rt_cnt_ntco_op`) VALUES('$patient_id', '$babynum', '$pocdnum', '$oaerightpass2', '$oaeleftpass2', '$oaerightrefer2', '$oaeleftrefer2', '$oaerightcnt2', '$oaeleftcnt2', '$oaenotcorperation2', '$oaenotcorperation2');";
mysql_query($qry_7);

$qry_8 = "INSERT INTO `aabr_screen` (`Patient_Id`, `baby_id_num`, `POCD_No`, `rt_pass`, `lt_pass`, `rt_refer`, `lt_refer`, `rt_cnt_noisy`, `lt_cnt_noisy`, `lt_cnt_ntco_op`, `rt_cnt_ntco_op`) "
        . " VALUES('$patient_id', '$babynum', '$pocdnum', '$aabrrightpass', '$aabrleftpass', '$aabrrightrefer', '$aabrleftrefer', '$aabrrightcnt', '$aabrleftcnt', '$aabrnotcorperation', '$aabrnotcorperation')";
mysql_query($qry_8);

$qry_9 = "INSERT INTO `behavioral_obs_audiometry` (`Patient_Id`, `baby_id_num`, `POCD_No`, `fivehz_80dBHL_pass`, `fivehz_50dBHL_pass`, `fivehz_80dBHL_refer`, `fivehz_50dBHL_refer`, `fourhz_80dBHL_pass`, `fourhz_50dBHL_pass`, `fourhz_80dBHL_refer`, `fourhz_50dBHL_refer`, `whitenoise_80dBHL_pass`, `whitenoise_50dBHL_pass`, `whitenoise_80dBHL_refer`, `whitenoise_50dBHL_refer`) VALUES('$patient_id', '$babynum', '$pocdnum', '$nbn500passone', '$nbn500passtwo', '$nbn500referone', '$nbn500refertwo', '$nbn4000passone', '$nbn4000passtwo', '$nbn4000referone', '$nbn4000refertwo', '$whitenoisypassone', '$whitenoisypasstwo', '$whitenoisyreferone', '$whitenoisyrefertwo')";
mysql_query($qry_9);

$qry_10 = "INSERT INTO `acoustic_analysis` (`Patient_Id`, `baby_id_num`, `POCD_No`, `normal_val`, `abnormal_val`) VALUES('$patient_id', '$babynum', '$pocdnum', '$acanalNormal', '$acanalabnormal' )";
mysql_query($qry_10);

$qry_11 = "INSERT INTO `primitive_reflex`(`Patient_Id`, `baby_id_num`, `POCD_No`, `moro_pre`, `moro_abs`, `root_pre`, `root_abs`, `suck_pre`, `suck_abs`, `tonicneck_pre`, `tonicneck_abs`, `palmar_pre`, `palmar_abs`, `plantar_pre`, `plantar_abs`, `babinski_pre`, `babinski_abs`) VALUES('$patient_id', '$babynum', '$pocdnum', '$moroPresent', '$moroAbsent', '$rootingPresent', '$rootingAbsent', '$suckPresent', '$suckAbsent', '$tonicPresent', '$tonicAbsent', '$palmarPresent', '$palmarAbsent', '$plantarPresent', '$planterAbsent', '$babinskiPresent', '$babinskiAbsent')";
mysql_query($qry_11);


if ($babyssubscribe == '1' && $oaerightpass = '1' || $oaeleftpass = '1'  && $nbn500passone == '1' || $nbn500passtwo == '1' && $nbn4000passone == '1' || $nbn4000passtwo == '1' && $whitenoisypassone == '1' || $whitenoisypasstwo == '1' && $acanalNormal == '1' && $moroPresent == '1' || $rootingPresent == '1' || $suckPresent == '1' || $tonicPresent == '1' || $palmarPresent == '1' || $plantarPresent == '1' || $babinskiPresent == '1') {
    $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='1' ";
    $q1 = mysql_query($s1);
    $r1 = mysql_fetch_assoc($q1);
    $msg1 = $r1['imp_name'];
    
    $updatenorisk = "UPDATE `patient` SET `test_impression` ='1' WHERE `Patient_Id` = '$patient_id'";
    mysql_query($updatenorisk);
//        echo "<h2><font color=green size='14pt'>$msg1</h2>"; exit;
    echo "<div class='row'>
            <div class='col-md-12'>
                <div class='col-md-6'>
                    <h3><span class='label label-success' >$msg1</span></h3>
                </div>
                <div class='col-md-5'>
                    <select class='form-control' name='impresn'>
                        ".getImpresionSelectList()."
                    </select> 
                </div>
            </div>
        ";
    
    $absensehrr = !empty($babyssubscribe)?"Absense of HRR - ":"";
    $oaeRightPass = !empty($oaerightpass)?"OAE Rt ear Pass - ":"";
    $oaeLeftPass = !empty($oaeleftpass)?"OAE Left ear Pass - ":"";
    $oaeRightPassTwo = !empty($oaerightpass2)?"OAE Left ear Pass -":"";
    $oaeLeftPassTwo = !empty($oaeleftpass2)?"OAE Left ear Pass - ":"";
    $nbn500PassOne = !empty($nbn500passone)?"5000Hz warable Tone-Intensity 80dBHL Pass - ":"";
    $nbn500PassTwo = !empty($nbn500passtwo)?"5000Hz warable Tone-Intensity 50dBHL Pass - ":"";
    $nbn4000PassOne = !empty($nbn4000passone)?"4000Hz warable Tone-Intensity 80dBHL Pass - ":"";
    $nbn4000PassTwo = !empty($nbn4000passtwo)?"4000Hz warable Tone-Intensity 50dBHL Pass - ":"";
    $whiteNoisyPassOne = !empty($whitenoisypassone)?"White noise-Intensity80dBHL Pass - ":"";
    $whiteNoisyPassTwo = !empty($whitenoisypasstwo)?"White noise-50dBHL Pass - ":"";
    $AcANormal = !empty($acanalNormal)?" Acounstic Analysis Normal - ":"";
    $Moro_Present = !empty($moroPresent)?"Moro Present - ":"";
    $Rooting_Present = !empty($rootingPresent)?"Rooting Present - ":"";
    $suckingPresent = !empty($suckPresent)?"Rooting Present - ":"";
    $tonic_Present = !empty($tonicPresent)?"Tonic Present - ":"";
    $palmar_Present = !empty($palmarPresent)?"Palmar Present - ":"";
    $plantar_Present = !empty($plantarPresent)?"Plantar Present - ":"";
    $babinski_Present = !empty($babinskiPresent)?"Baninski Present - ":"";
    
    
    $impresnRemark = "$absensehrr $oaeRightPass $oaeLeftPass $oaeRightPassTwo $oaeLeftPassTwo $nbn500PassOne $nbn500PassTwo"
            . "$nbn4000PassOne $nbn4000PassTwo $whiteNoisyPassOne $whiteNoisyPassTwo $AcANormal $Moro_Present"
            . "$Rooting_Present $suckingPresent $tonic_Present $tonic_Present $palmar_Present $plantar_Present $babinski_Present";
            
    $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient_id'";
    mysql_query($updateImprRemark);
    echo "<p><h4>Impression Remark</h4><label>$impresnRemark</label></p>";
    
}

elseif (($exVomit == 1 || $eldPreg == 1 || $babybp == 1 || $bloodSugar == 1 || $babyabortion == 1 || $babyrh == 1 || $viralInfection == 1 || $otoMedication == 1 || $chemFume == 1 || $babyalcohol == 1 || $babysmoke == 1) &&
        ($weightLess == 1 || $fetalDistress == 1 || $birthAsphyxia == 1 || $babyjaundice == 1 || $apgArone == 1 || $apgarFive == 1 || $birth_wt != NULL || $bilLevel != NULL || $babybirthcry != NULL || $babynicu != NULL) &&
        ($cranioFacial == 1 || $coGenital == 1 || $deGenerative == 1 || $viralInfect == 1 || $babyconvulsions == 1 || $babyotitis == 1 || $babytrauma == 1) &&
        ($nbn500referone == 1 || $nbn500refertwo == 1 || $nbn4000referone == 1 || $nbn4000refertwo == 1 || $whitenoisyreferone == 1 || $whitenoisyrefertwo == 1) &&
        ($oaerightrefer == 1 || $oaeleftrefer == 1 || $oaerightrefer2 == 1 || $oaeleftrefer2 == 1) &&
        ($whitenoisyrefertwo == 1 && $acanalabnormal == 1 && $moroAbsent == 1 || $rootingAbsent == 1 || $suckAbsent == 1 || $tonicAbsent == 1 || $palmarAbsent == 1 || $planterAbsent == 1 || $babinskiAbsent == 1)) {

    $s12 = "select `imp_name` from `tbl_impression` where `imp_id`='2' ";
    $q12 = mysql_query($s12);
    $r12 = mysql_fetch_assoc($q12);
    $msg12 = $r12['imp_name'];
    
       
    $ex_Vomit = !empty($exVomit)?"Excessive vomiting - ":"";
    $eld_Preg = !empty($eldPreg)?"Elderly Pregnancy - ":"";
    $baby_bp = !empty($babybp)?"High/Low BP - ":"";
    $blood_Sugar = !empty($bloodSugar)?"Blood Sugar -":"";
    $baby_Abortion = !empty($babyabortion)?"H/O Abortion - ":"";
    $baby_rh = !empty($babyrh)?"Rh Incompatibility - ":"";
    $viral_Infection = !empty($viralInfection)?"Viral Bacterial infection - ":"";
    $oto_Medication = !empty($otoMedication)?"Oto toxic medication - ":"";
    $chem_Fume = !empty($chemFume)?"Chemical fumes - ":"";
    $baby_alcohol = !empty($babyalcohol)?"Alcohol - ":"";
    $baby_smoke = !empty($babysmoke)?"Smoking - ":"";
    $weight_Less = !empty($weightLess)?" Low Birth weight>105kg - ":"";
    $fetal_Distress = !empty($fetalDistress)?"Fetal distress - ":"";
    $birth_Asphyxia = !empty($birthAsphyxia)?"birth asphyxia - ":"";
    $baby_jaundice = !empty($babyjaundice)?"Neonatak Jaundice - ":"";
    $apg_Arone = !empty($apgArone)?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
    $apgarFive = !empty($apgarFive)?"APGAR Score: 0-6@ 5min - ":"";
    $birth_weigt = !empty($birth_wt)?"Birth weight $birth_wt - ":"";
    $bil_Level = !empty($bilLevel)?"Bilirubin Level $bilLevel - ":"";
    $baby_birthcry = !empty($babybirthcry)?"Delayed birt cry $babybirthcry sec - ":"";
    $baby_nicu = !empty($babynicu)?"NIU $babynicu days - ":"";
    $cranio_Facial = !empty($cranioFacial)?"Craniofacial - ":"";
    $co_Genital = !empty($coGenital)?"Congential anomalies - ":"";
    $de_Generative = !empty($deGenerative)?"Degenerative diseas - ":"";
    $viral_Infect = !empty($viralInfect)?"Viral/bacterial infection - ":"";
    $baby_convulsions = !empty($babyconvulsions)?"Convilsions - ":"";
    $baby_otitis = !empty($babyotitis)?"Otitis Media with effusion - ":"";
    $baby_trauma = !empty($babytrauma)?"Trauma of heador neck - ":"";
    $nbn500_referone = !empty($nbn500referone)?"5000Hz warable Tone-Intensity 80dBHL Refer - ":"";
    $nbn500_refertwo = !empty($nbn500_refertwo)?"5000Hz warable Tone-Intensity 50dBHL refer -  - ":"";
    $nbn4000_referone = !empty($nbn4000referone)?"4000 warable Tone-Intensity 80dBHL Refer -  - ":"";
    $nbn4000_refertwo = !empty($nbn4000refertwo)?"5000Hz warable Tone-Intensity 50dBHL Refer -  - ":"";
    $whitenoisy_referone = !empty($whitenoisyreferone)?"White noise-Intensity80dBHL Refer - ":"";
    $whitenoisy_refertwo = !empty($whitenoisyrefertwo)?"White noise-Intensity50dBHL Refer- ":"";
    $oaeright_refer = !empty($oaerightrefer)?"Screening 1 OAE Rt ear Refer - ":"";
    $oaeleft_refer = !empty($oaeleftrefer)?"Screening 1 OAE Left ear Refer- ":"";
    $oaeright_refer2 = !empty($oaerightrefer2)?"Screening 2 OAE Rt ear Refer - ":"";
    $oaeleft_refer2 = !empty($oaeleftrefer2)?"Screening 2 OAE Left ear Refer - ":"";
    $acanal_abnormal = !empty($acanalabnormal)?"Acounstic analysis Normal - ":"";
    $moro_Absent = !empty($moroAbsent)?"Moro absent - ":"";
    $rooting_Absent = !empty($rootingAbsent)?"Rootin absent - ":"";
    $suck_Absent = !empty($suckAbsent)?"sucking absent - ":"";
    $tonic_Absent = !empty($tonicAbsent)?"tonic neck absent - ":"";
    $palmar_Absent = !empty($palmarAbsent)?"palmar absent - ":"";
    $planter_Absent = !empty($planterAbsent)?"plantar absent - ":"";
    $babinski_Absent = !empty($babinskiAbsent)?"babinski absent - ":"";
    
    $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_referone $nbn500_refertwo $nbn4000_referone $nbn4000_refertwo $whitenoisy_referone"
            . "$whitenoisy_refertwo $oaeright_refer $oaeleft_refer $oaeright_refer2 $oaeleft_refer2 $acanal_abnormal"
            . "$moro_Absent $rooting_Absent $suck_Absent $tonic_Absent $palmar_Absent $planter_Absent $babinski_Absent" ;
    
    
            
    $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient_id'";
    mysql_query($updateImprRemark);
    
    
    $updateatrisk1 = "UPDATE `patient` SET `test_impression` ='2' WHERE `Patient_Id` = '$patient_id'";
    echo "
        <div class='row'>
            <div class='col-md-12'>
                <div class='col-md-6'>
                    <h3><span class='label label-success' >$msg12</span></h3>
                </div>
                <div class='col-md-5'>
                    <select class='form-control' name='impresn'>
                        ".getImpresionSelectList()."
                    </select> 
                </div>
            </div>
        
         ";
    echo "<p><h4>Impression Remark</h4><label>$impresnRemark</label></p>";
    mysql_query($updateatrisk1);
    
    
    $nbslist = getNbsList();
//    $osclist = getOSCList();
    
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-5 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-5 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' class='osccentr'>OSC center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-5 col-md-offset-1 form-group nbslistload' id='nbsDV' style='display:none'>
                     $nbslist
                </div>
            
                <div class='col-md-5 col-md-offset-6 form-group osclistload' id='oscDV' style='display:none'>
                    ".getOSCList()."
                </div>
                <div class='col-md-3 col-md-offset-3 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
        </div>
            
        ";
            
    
}

//elseif ($exVomit == '1' || $eldPreg == '1' || $babybp == '1' || $bloodSugar == '1' || $babyabortion == '1' || $babyrh == '1' || $viralInfection == '1' || $otoMedication == '1' || $chemFume == '1' || $babyalcohol == '1' || $babysmoke == '1' &&
//        $weightLess == '1' || $fetalDistress == '1' || $birthAsphyxia == '1' || $babyjaundice == '1' || $apgArone == '1' || $apgarFive == '1' || $birth_wt != NULL || $bilLevel != NULL || $babybirthcry != NULL || $babynicu != NULL &&
//        $cranioFacial == '1' || $coGenital == '1' || $deGenerative == '1' || $viralInfect == '1' || $babyconvulsions == '1' || $babyotitis == '1' || $babytrauma == '1' &&
//        $oaerightpass == 1 || $oaeleftpass == 1 || $oaerightpass2 == 1 || $oaeleftpass2 == 1 || $aabrrightpass == 1 || $aabrleftpass == 1 &&
//        $nbn500passone == '1' || $nbn500passtwo == '1' || $nbn4000passone == '1' || $nbn4000passtwo == '1' || $whitenoisypassone == '1' || $whitenoisypasstwo == '1' &&
//        $acanalNormal == '1' || $moroPresent == '1' || $rootingPresent == '1' || $suckPresent == '1' || $tonicPresent == '1' || $palmarPresent == '1' || $plantarPresent == '1' || $babinskiPresent == '1'
//        ) {
//            echo "<script type='text/javascript'>alert('KMK0001;POCD0003');</script>";
else{    
    $s123 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
    $q123 = mysql_query($s123);
    $r123 = mysql_fetch_assoc($q123);
    $msg123 = $r123['imp_name'];
    
    $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient_id'";
    mysql_query($updateatrisk2);
    
    $ex_Vomit = !empty($exVomit)?"Excessive vomiting - ":"";
    $eld_Preg = !empty($eldPreg)?"Elderly Pregnancy - ":"";
    $baby_bp = !empty($babybp)?"High/Low BP - ":"";
    $blood_Sugar = !empty($bloodSugar)?"Blood Sugar -":"";
    $baby_Abortion = !empty($babyabortion)?"H/O Abortion - ":"";
    $baby_rh = !empty($babyrh)?"Rh Incompatibility - ":"";
    $viral_Infection = !empty($viralInfection)?"Viral Bacterial infection - ":"";
    $oto_Medication = !empty($otoMedication)?"Oto toxic medication - ":"";
    $chem_Fume = !empty($chemFume)?"Chemical fumes - ":"";
    $baby_alcohol = !empty($babyalcohol)?"Alcohol - ":"";
    $baby_smoke = !empty($babysmoke)?"Smoking - ":"";
    $weight_Less = !empty($weightLess)?" Low Birth weight>105kg - ":"";
    $fetal_Distress = !empty($fetalDistress)?"Fetal distress - ":"";
    $birth_Asphyxia = !empty($birthAsphyxia)?"birth asphyxia - ":"";
    $baby_jaundice = !empty($babyjaundice)?"Neonatak Jaundice - ":"";
    $apg_Arone = !empty($apgArone)?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
    $apgarFive = !empty($apgarFive)?"APGAR Score: 0-6@ 5min - ":"";
    $birth_weigt = !empty($birth_wt)?"Birth weight $birth_wt - ":"";
    $bil_Level = !empty($bilLevel)?"Bilirubin Level $bilLevel - ":"";
    $baby_birthcry = !empty($babybirthcry)?"Delayed birt cry $babybirthcry sec - ":"";
    $baby_nicu = !empty($babynicu)?"NIU $babynicu days - ":"";
    $cranio_Facial = !empty($cranioFacial)?"Craniofacial - ":"";
    $co_Genital = !empty($coGenital)?"Congential anomalies - ":"";
    $de_Generative = !empty($deGenerative)?"Degenerative diseas - ":"";
    $viral_Infect = !empty($viralInfect)?"Viral/bacterial infection - ":"";
    $baby_convulsions = !empty($babyconvulsions)?"Convilsions - ":"";
    $baby_otitis = !empty($babyotitis)?"Otitis Media with effusion - ":"";
    $baby_trauma = !empty($babytrauma)?"Trauma of heador neck - ":"";
    
    $nbn500_passone = !empty($nbn500passone)?"5000Hz warable Tone-Intensity 80dBHL Pass - ":"";
    $nbn500_passtwo = !empty($nbn500passtwo)?"5000Hz warable Tone-Intensity 50dBHL pass -  - ":"";
    $nbn4000_passone = !empty($nbn4000passone)?"4000 warable Tone-Intensity 80dBHL pass -  - ":"";
    $nbn4000_passtwo = !empty($nbn4000passtwo)?"5000Hz warable Tone-Intensity 50dBHL pass -  - ":"";
    $whitenoisy_passone = !empty($whitenoisypassone)?"White noise-Intensity80dBHL pass - ":"";
    $whitenoisy_passtwo = !empty($whitenoisypasstwo)?"White noise-Intensity50dBHL pass- ":"";
    
    $oaeright_pass = !empty($oaerightpass)?"Screening 1 OAE Rt ear pass - ":"";
    $oaeleft_pass = !empty($oaeleftpass)?"Screening 1 OAE Left ear pass- ":"";
    $oaeright_pass2 = !empty($oaerightpass2)?"Screening 2 OAE Rt ear pass - ":"";
    $oaeleft_pass2 = !empty($oaeleftpass2)?"Screening 2 OAE Left ear pass - ":"";
    
    $acanal_normal = !empty($acanalNormal)?"Acounstic analysis Normal - ":"";
    
    $moro_Present = !empty($moroPresent)?"Moro present - ":"";
    $rooting_Present = !empty($rootingPresent)?"Rootin present - ":"";
    $suck_Present = !empty($suckPresent)?"sucking present - ":"";
    $tonic_Present = !empty($tonicPresent)?"tonic neck present - ":"";
    $palmar_Present = !empty($palmarPresent)?"palmar present - ":"";
    $planter_Present = !empty($planterPresent)?"plantar present - ":"";
    $babinski_Present = !empty($babinskiPresent)?"babinski present - ":"";
    
    $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "<h3><span class='label label-warning' >$msg123</span></h3>";
    
    echo "<p><h4>Impression Remark</h4><label>$impresnRemark</label></p>";
     $nbslist = getNbsList();
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-5 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-5 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' class='osccentr'>OSC center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-5 col-md-offset-1 form-group nbslistload' id='nbsDV' style='display:none'>
                     $nbslist
                </div>
            
                <div class='col-md-5 col-md-offset-6 form-group osclistload' id='oscDV' style='display:none'>
                    ".getOSCList()."
                </div>
                <div class='col-md-3 col-md-offset-3 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
            <div class='col-md-12 '>
                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up'>Phonr F/up</a>
            </div>
        </div>
            
        ";
    
    echo "
            <!--<div class='col-md-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>POCD no.</th>
                            <th>Baby id</th>
                            <th>Baby name</th>
                            <th>Date of exam</th>
                        </tr>
                    
                        <tr>
                            <td class='text-center'>$pocdnum</td>
                        
                            <td class='text-center'>$babynum</td>
                        
                            <td class='text-center'>$babyName</td>
                        
                            <td class='text-center'>$screenDate</td>
                        </tr>
                    </tbody>
                </table>    
            </div>-->
        ";


//        echo "<h2><font color=red size='14pt'>$msg123<h2>"; exit;
}


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