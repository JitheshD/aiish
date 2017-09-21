<?php

include_once '../lib/maincore.php';

$patID = mysql_real_escape_string($_POST["patient_ID"]);

$babysubscribe = mysql_real_escape_string($_POST["babysubscribe"]);



//$babyssubscribe = mysql_real_escape_string($_POST["babyssubscribe"]);
$prenatalHrr = mysql_real_escape_string($_POST["prenatalHrr"]);
$natalHrr = mysql_real_escape_string($_POST["natalHrr"]);
$postNatal = mysql_real_escape_string($_POST["postNatal"]);
$babyother = mysql_real_escape_string($_POST["babyother"]);

//echo "HRR Val= $prenatalHrr-$natalHrr-$postNatal-$other";

$exVomit = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["exVomit"])."":"";
$eldPreg = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["eldPreg"])."":"";
$babybp = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["babybp"])."":"";
$bloodSugar = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["bloodSugar"])."":"";
$babyabortion = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["babyabortion"])."":"";
$babyrh = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["babyrh"])."":"";
$viralInfection = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["viralInfection"])."":"";
$infection = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["infect"])."":"";
$otoMedication = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["otoMedication"])."":"";
$chemFume = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["chemFume"])."":"";
$babyalcohol = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["babyalcohol"])."":"";
$babysmoke = ($prenatalHrr == 1)?"".mysql_real_escape_string($_POST["babysmoke"])."":"";

$weightLess = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["weightLess"])."":"";
$birth_wt = ($natalHrr == 1 && $weightLess == 1)?"".mysql_real_escape_string($_POST["birthWt"])."":"";
//echo $birth_wt;
$babyjaundice = ($natalHrr == 1)? "".mysql_real_escape_string($_POST["babyjaundice"])."":"";
$bilLevel = ($natalHrr == 1 && $babyjaundice == 1)? "".mysql_real_escape_string($_POST["bilLevel"])."":"";
$birthcrychk = ($natalHrr == 1)? "".mysql_real_escape_string($_POST["birthcrychk"])."":"";
$babybirthcry = ($natalHrr == 1 && $birthcrychk ==1)?"".mysql_real_escape_string($_POST["babybirthcry"])."":"";
$prematuredelchk = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["pdeliverychck"])."":"";
$prematuredel = ($natalHrr == 1 && $prematuredelchk ==1)? "".mysql_real_escape_string($_POST["prematureDelivery"])."":"";
$birthAsphyxia = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["birthAsphyxia"])."":"";
$fetalDistress = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["fetalDistress"])."":"";
$babyaaf = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["babyaaf"])."":"";
$babynicuchk = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["nicu_chk"])."":"";
$babynicu = ($natalHrr == 1 && $babynicuchk == 1)?"".mysql_real_escape_string($_POST["babynicu"])."":"";
$apgArone = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["apgArone"])."":"";
$apgarFive = ($natalHrr == 1)?"".mysql_real_escape_string($_POST["apgarFive"])."":"";

$cranioFacial = ($postNatal == 1)?"".mysql_real_escape_string($_POST["cranioFacial"])."":"";
$coGenital = ($postNatal == 1)?"".mysql_real_escape_string($_POST["coGenital"])."":"";
$deGenerative = ($postNatal == 1)?"".mysql_real_escape_string($_POST["deGenerative"])."":"";
$viralInfect = ($postNatal == 1)?"".mysql_real_escape_string($_POST["viralInfect"])."":"";
$babyconvulsions = ($postNatal == 1)?"".mysql_real_escape_string($_POST["babyconvulsions"])."":"";
$babyotitis = ($postNatal == 1)?"".mysql_real_escape_string($_POST["babyotitis"])."":"";
$babytrauma = ($postNatal == 1)?"".mysql_real_escape_string($_POST["babytrauma"])."":"";

//Other HRR
$babyConsanguinity = ($babyother == 1)?"".mysql_real_escape_string($_POST["babyConsanguinity"])."":"";

$consposchkval = ($babyConsanguinity == 1 && $babyother == 1)?"1":"";
$consnegchkval = ($babyConsanguinity == 2 && $babyother == 1)?"1":"";

$other1 = mysql_real_escape_string($_POST["babyhrr1"]);
$babyhrr1 = ($babyother == 1)?"$other1":"";
$other2 = mysql_real_escape_string($_POST["babyhrr2"]);
$babyhrr2 = ($babyother == 1)?"$other2":"";
$other3 = mysql_real_escape_string($_POST["babyhrr3"]);
$babyhrr3 = ($babyother == 1)?"$other3":"";

$famHist = mysql_real_escape_string($_POST["familyHistory"]);
$familyHistory = ($babyother == 1)?"$famHist":"";

$famposchk = ($familyHistory == 1 && $babyother == 1)?"1":"";
$famnegchk = ($familyHistory == 2 && $babyother == 1)?"1":"";

$maternal = mysql_real_escape_string($_POST["babymaternal"]);
$babymaternal = ($familyHistory == 1 && $babyother == 1)?"$maternal":"";
$paternal = mysql_real_escape_string($_POST["babypaternal"]);
$babypaternal = ($familyHistory == 1 && $babyother == 1)?"$paternal":"";
$babyHi = ($familyHistory == 1 && $babyother == 1)?"".mysql_real_escape_string($_POST["babyhi"])."":"";
$babysp = ($familyHistory == 1 && $babyother == 1)? "".mysql_real_escape_string($_POST["babysp"])."":"";
$babylg = ($familyHistory == 1 && $babyother == 1)? "".mysql_real_escape_string($_POST["babylg"])."":"";
$babymd = ($familyHistory == 1 && $babyother == 1)? "".mysql_real_escape_string($_POST["babymd"])."":"";
$otherBaby = ($familyHistory == 1 && $babyother == 1)? "".mysql_real_escape_string($_POST["othrBaby"])."":"";

$HrrType = mysql_real_escape_string($_POST["hrr_id"]);
$prenatlid = mysql_real_escape_string($_POST["prenatl_Id"]);
$natalid = mysql_real_escape_string($_POST["natal_Id"]);
$postNatalid = mysql_real_escape_string($_POST["postNatal_Id"]);
$otherid = mysql_real_escape_string($_POST["other_Id"]);

//echo "HRR ID: $prenatlid-$natalid-$postNatalid-$otherid";
if(empty($HrrType)){
    $hrrID = "INSERT INTO `tbl_hrr` (`hrr_type`, `Patient_Id`) VALUES('$babysubscribe', '$patID')";
    $hrrmsg1 = ($babysubscribe == 1)?"Presence of HRR selected":"Absence of HRR Selected";

}
else{
    $hrrID = "UPDATE `tbl_hrr` SET `hrr_type` = '$babysubscribe', `Patient_Id` = '$patID' WHERE `hrr_id` = '$HrrType'";
    $hrrmsg1 = ($babysubscribe == 1)?"Presence of HRR selected":"Absence of HRR Selected";
}

//echo $hrrID;
mysql_query($hrrID);
$hrrchk = mysql_insert_id();
$hrr_Id  = ($hrrchk == 0)?"$HrrType":"$hrrchk";
//echo "HRR last inserted ID: $hrrchk";
    
//if($babysubscribe == 1){
    $qry_2 = empty($prenatlid)?"INSERT INTO `pre_natal_hrr` (`Patient_Id`, `prenatal_hrr`, `excessive_vomiting`, `elderly_pregnanacy`, `highlow_bp`, `blood_sugar`, `ho_abortions`, `rh_incompatitlibility`, `viralbacterial_infections`, `oto_tox_med`, `chem_fum`, `alcohol`, `smoking`) VALUES('$patID', '$prenatalHrr', '$exVomit', '$eldPreg', '$babybp', '$bloodSugar', '$babyabortion', '$babyrh', '$viralInfection', '$otoMedication', '$chemFume', '$babyalcohol', '$babysmoke' )":"UPDATE `pre_natal_hrr` SET `Patient_Id` = '$patID', `prenatal_hrr` = '$prenatalHrr', `excessive_vomiting` = '$exVomit', `elderly_pregnanacy` = '$eldPreg', `highlow_bp` = '$babybp', `blood_sugar` = '$bloodSugar', `ho_abortions` = '$babyabortion', `rh_incompatitlibility` = '$babyrh', `viralbacterial_infections` = '$viralInfection', `oto_tox_med` = '$otoMedication', `chem_fum` = '$chemFume', `alcohol` = '$babyalcohol', `smoking` = '$babysmoke' WHERE `prenatal_id` = '$prenatlid'";
    if(empty($prenatlid)){
        $hrrmsg1 = "Prenatal HRR is inserted with ID-";
       // $qry_2 = "INSERT INTO `pre_natal_hrr` (`Patient_Id`, `excessive_vomiting`, `elderly_pregnanacy`, `highlow_bp`, `blood_sugar`, `ho_abortions`, `rh_incompatitlibility`, `viralbacterial_infections`, `oto_tox_med`, `chem_fum`, `alcohol`, `smoking`) VALUES('$patID', '$exVomit', '$eldPreg', '$babybp', '$bloodSugar', '$babyabortion', '$babyrh', '$viralInfection', '$otoMedication', '$chemFume', '$babyalcohol', '$babysmoke' )";
    }else{
        $hrrmsg1 = "Prenatal HRR is Updated with ID-";
        //$qry_2 = "UPDATE `pre_natal_hrr` SET `Patient_Id` = '$patID', `excessive_vomiting` = '$exVomit', `elderly_pregnanacy` = '$eldPreg', `highlow_bp` = '$babybp', `blood_sugar` = '$bloodSugar', `ho_abortions` = '$babyabortion', `rh_incompatitlibility` = '$babyrh', `viralbacterial_infections` = '$viralInfection', `oto_tox_med` = '$otoMedication', `chem_fum` = '$chemFume', `alcohol` = '$babyalcohol', `smoking` = '$babysmoke' WHERE `prenatal_id` = '$prenatlid'";
    }
   // echo $qry_2;
    mysql_query($qry_2);
    $preNatId = mysql_insert_id();

    $preNatalId = ($preNatId == 0)? "$prenatlid": "$preNatId";

    $qry_3 = empty($natalid)?"INSERT INTO `natal_hrr` (`Patient_Id`, `lbw`, `nj`, `ba`, `fd`, `as_1min`, `as_5min`, `natal_hrr`, `birth_wt`, `bilrubin_level`, `delayed_birth_cry`, `birthcrysec`, `premature_delivery_week`, `premature_delivery_val`, `aspiration_of_fluid_days`, `nicu`, `nicu_val`) VALUES('$patID', '$weightLess', '$babyjaundice', '$birthAsphyxia', '$fetalDistress', '$apgArone', '$apgarFive', '$natalHrr', '$birth_wt', '$bilLevel', '$birthcrychk', '$babybirthcry', '$prematuredelchk', '$prematuredel', '$babyaaf', '$babynicuchk', '$babynicu')":"UPDATE `natal_hrr` SET `Patient_Id` = '$patID', `lbw` = '$weightLess', `nj` = '$babyjaundice', `ba` = '$birthAsphyxia', `fd` = '$fetalDistress', `as_1min` = '$apgArone', `as_5min` = '$apgarFive', `natal_hrr` = '$natalHrr', `birth_wt` = '$birth_wt', `bilrubin_level` = '$bilLevel', `delayed_birth_cry` = '$birthcrychk', `birthcrysec` = '$babybirthcry', `premature_delivery_week` = '$prematuredelchk', `premature_delivery_val` = '$prematuredel', `aspiration_of_fluid_days` = '$babyaaf', `nicu` = '$babynicuchk', `nicu_val` = '$babynicu' WHERE `natal_id` = '$natalid'";
    if(empty($natalid)){
        $hrrmsg2 = "Natal HRR is inserted with ID-";
        //$qry_3 = "INSERT INTO `natal_hrr` (`Patient_Id`, `lbw`, `nj`, `ba`, `fd`, `as_1min`, `as_5min`, `natal_hrr`, `birth_wt`, `bilrubin_level`, `delayed_birth_cry`, `birthcrysec`, `premature_delivery_week`, `premature_delivery_val`, `aspiration_of_fluid_days`, `nicu`, `nicu_val`) VALUES('$patID', '$weightLess', '$babyjaundice', '$birthAsphyxia', '$fetalDistress', '$apgArone', '$apgarFive', '$natalHrr', '$birth_wt', '$bilLevel', '$birthcrychk', '$babybirthcry', '$prematuredelchk', '$prematuredel', '$babyaaf', '$babynicuchk', '$babynicu')";
    }
    else{
        $hrrmsg2 = "Natal HRR is updated with ID-";
        //$qry_3 = "UPDATE `natal_hrr` SET `Patient_Id` = '$patID', `lbw` = '$weightLess', `nj` = '$babyjaundice', `ba` = '$birthAsphyxia', `fd` = '$fetalDistress', `as_1min` = '$apgArone', `as_5min` = '$apgarFive', `natal_hrr` = '$natalHrr', `birth_wt` = '$birth_wt', `bilrubin_level` = '$bilLevel', `delayed_birth_cry` = '$birthcrychk', `birthcrysec` = '$babybirthcry', `premature_delivery_week` = '$prematuredelchk', `premature_delivery_val` = '$prematuredel', `aspiration_of_fluid_days` = '$babyaaf', `nicu` = '$babynicuchk', `nicu_val` = '$babynicu' WHERE `natal_id` = '$natalid'";
    }
    mysql_query($qry_3);
   // echo $qry_3;

    $nat_id = mysql_insert_id();

    $natal_id = ($nat_id == 0)? "$natalid":"$nat_id";

    $qry_4 = empty($postNatalid)?"INSERT INTO `post_natal_hrrr`(`postnatal_hrr`, `csa`, `ca`, `dd`, `vbf`, `cnv`, `omwe`, `thn`, `Patient_Id`) VALUES('$postNatal', '$cranioFacial', '$coGenital', '$deGenerative', '$viralInfect', '$babyconvulsions', '$babyotitis', '$babytrauma', '$patID' )":"UPDATE `post_natal_hrrr` SET `Patient_Id` = '$patID', `postnatal_hrr` = '$postNatal', `csa` = '$cranioFacial', `ca` = '$coGenital', `dd` = '$deGenerative', `vbf` = '$viralInfect', `cnv` = '$babyconvulsions', `omwe` = '$babyotitis', `thn` = '$babytrauma' WHERE `postnatal_id` = '$postNatalid'";
    if(empty($postNatalid)){
        $hrrmsg3 = "PostNatal HRR is inserted with ID-";
        //$qry_4 = "INSERT INTO `post_natal_hrrr`(`csa`,`ca`, `dd`, `vbf`, `cnv`, `omwe`, `thn`, `Patient_Id`) VALUES('$cranioFacial', '$coGenital', '$deGenerative', '$viralInfect', '$babyconvulsions', '$babyotitis', '$babytrauma', '$patID' )";
    }else{
        $hrrmsg3 = "PostNatal HRR is updated with ID-";
        //$qry_4 = "UPDATE `post_natal_hrrr` SET `Patient_Id` = '$patID', `csa` = '$cranioFacial', `ca` = '$coGenital', `dd` = '$deGenerative', `vbf` = '$viralInfect', `cnv` = '$babyconvulsions', `omwe` = '$babyotitis', `thn` = '$babytrauma' WHERE `postnatal_id` = '$postNatalid'";
    }
    //echo $qry_4;
    mysql_query($qry_4);
    $postNat_id = mysql_insert_id();

    $postNatal_id = ($postNat_id == 0)?"$postNatalid":"$postNat_id";

    $qry_5 = empty($otherid)?"INSERT INTO `other_hrr` (`Patient_Id`, `other_hrr`, `cons_pos_val`, `cons_neg_val`, `conspos1`, `conspos2`, `conspos3`,  `fam_his_pos`, `fam_his_neg`, `fam_his_mat`, `fam_his_pat`, `fam_his_hi`, `fam_his_sp`, `fam_his_lg`, `fam_his_md`, `fam_his_oth`) VALUES('$patID', '$babyother', '$consposchkval', '$consnegchkval', '$babyhrr1', '$babyhrr2', '$babyhrr3', '$famposchk', '$famnegchk', '$babymaternal', '$babypaternal', '$babyHi', '$babysp', '$babylg', '$babymd', '$otherBaby' )":"UPDATE `other_hrr` SET `Patient_Id` = '$patID', `other_hrr` = '$babyother', `cons_pos_val` = '$consposchkval', `cons_neg_val` = '$consnegchkval', `conspos1` = '$babyhrr1', `conspos2` = '$babyhrr2', `conspos3` = '$babyhrr3', `fam_his_pos` = '$famposchk', `fam_his_neg` = '$famnegchk', `fam_his_mat` = '$babymaternal', `fam_his_pat` = '$babypaternal', `fam_his_hi` = '$babyHi', `fam_his_sp` = '$babysp', `fam_his_lg` = '$babylg', `fam_his_md` = '$babymd', `fam_his_oth` = '$otherBaby' WHERE `other_id` = '$otherid'";
    if(empty($otherid)){
        $hrrmsg4 = "Other HRR is inserted with ID-";
        //$qry_5 = "INSERT INTO `other_hrr` (`Patient_Id`, `cons_pos_val`, `cons_neg_val`, `conspos1`, `conspos2`, `conspos3`,  `fam_his_pos`, `fam_his_neg`, `fam_his_mat`, `fam_his_pat`, `fam_his_hi`, `fam_his_sp`, `fam_his_lg`, `fam_his_md`, `fam_his_oth`) VALUES('$patID', '$consposchkval', '$consnegchkval', '$babyhrr1', '$babyhrr2', '$babyhrr3', '$famposchk', '$famnegchk', '$babymaternal', '$babypaternal', '$babyHi', '$babysp', '$babylg', '$babymd', '$otherBaby' )";
    }
    else{
        $hrrmsg4 = "Other HRR is updated with ID-";
        //$qry_5 = "UPDATE `other_hrr` SET `Patient_Id` = '$patID', `cons_pos_val` = '$consposchkval', `cons_neg_val` = '$consnegchkval', `conspos1` = '$babyhrr1', `conspos2` = '$babyhrr2', `conspos3` = '$babyhrr3', `fam_his_pos` = '$famposchk', `fam_his_neg` = '$famnegchk', `fam_his_mat` = '$babymaternal', `fam_his_pat` = '$babypaternal', `fam_his_hi` = '$babyHi', `fam_his_sp` = '$babysp', `fam_his_lg` = '$babylg', `fam_his_md` = '$babymd', `fam_his_oth` = '$otherBaby' WHERE `other_id` = '$otherid'";
    }
    //echo $qry_5;
    mysql_query($qry_5);
    
    
    $othId = mysql_insert_id();

    //echo "otherID:$othId";

    $otherId = ($othId == 0)? "$otherid":"$othId";

    //echo "Queries- $qry_2 - $qry_3 - $qry_4 - $qry_4";
    if($babysubscribe == 2){
        $qry_hrrLog = "INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'data-entry', '$hrrmsg1')";
    }
    else{
        $qry_hrrLog = "INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'data-entry', '$hrrmsg1$preNatalId & $hrrmsg2$natal_id & $hrrmsg3 $postNatal_id & $hrrmsg4 $otherId')";
    }
    mysql_query($qry_hrrLog);
    
//}
echo "
        <input type='text' name='hrr_id' id='hrr_id' hidden='' value='$hrr_Id'>
        <input type='text' name='prenatal_id' id='prenatal_idval' hidden=''  value='$preNatalId'>
        <input type='text' name='natal_idval' id='natal_idval' hidden=''  value=' $natal_id'>
        <input type='text' name='postNatal_id'  id='postNatal_id' hidden=''   value=' $postNatal_id'>
        <input type='text' name='other_id' id='other_idval' hidden=''  value='$otherId '>
    ";

?>