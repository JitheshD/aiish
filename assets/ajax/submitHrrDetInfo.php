<?php

include_once '../lib/maincore.php';

$patID = mysql_real_escape_string($_POST["patient_Id"]);

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
$birth_wt = mysql_real_escape_string($_POST["birthWt"]);
$babyjaundice = mysql_real_escape_string($_POST["babyjaundice"]);
$bilLevel = mysql_real_escape_string($_POST["bilLevel"]);
$birthcrychk = mysql_real_escape_string($_POST["birthcrychk"]);
$babybirthcry = mysql_real_escape_string($_POST["babybirthcry"]);
$prematuredel = mysql_real_escape_string($_POST["prematureDelivery"]);
$birthAsphyxia = mysql_real_escape_string($_POST["birthAsphyxia"]);
$fetalDistress = mysql_real_escape_string($_POST["fetalDistress"]);
$babyaaf = mysql_real_escape_string($_POST["babyaaf"]);
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

$prenatlid = mysql_real_escape_string($_POST["prenatl_Id"]);
$natalid = mysql_real_escape_string($_POST["natal_Id"]);
//echo $natalid;
$postNatalid = mysql_real_escape_string($_POST["postNatal_Id"]);
$otherid = mysql_real_escape_string($_POST["other_Id"]);


if(empty($prenatlid)){
    $qry_2 = "INSERT INTO `pre_natal_hrr` (`Patient_Id`, `excessive_vomiting`, `elderly_pregnanacy`, `highlow_bp`, `blood_sugar`, `ho_abortions`, `rh_incompatitlibility`, `viralbacterial_infections`, `oto_tox_med`, `chem_fum`, `alcohol`, `smoking`) VALUES('$patID', '$exVomit', '$eldPreg', '$babybp', '$bloodSugar', '$babyabortion', '$babyrh', '$viralInfection', '$otoMedication', '$chemFume', '$babyalcohol', '$babysmoke' )";

}
else{
   $qry_2 = "UPDATE `pre_natal_hrr` SET `Patient_Id` = '$patID', `excessive_vomiting` = '$exVomit', `elderly_pregnanacy` = '$eldPreg', `highlow_bp` = '$babybp', `blood_sugar` = '$bloodSugar', `ho_abortions` = '$babyabortion', `rh_incompatitlibility` = '$babyrh', `viralbacterial_infections` = '$viralInfection', `oto_tox_med` = '$otoMedication', `chem_fum` = '$chemFume', `alcohol` = '$babyalcohol', `smoking` = '$babysmoke' WHERE `prenatal_id` = '$prenatlid'"; 
}
mysql_query($qry_2);
$preNatalId = mysql_insert_id();

if(empty($natalid)){
    $qry_3 = "INSERT INTO `natal_hrr` (`Patient_Id`, `lbw`, `nj`, `ba`, `fd`, `as_1min`, `as_5min`, `natal_hrr`, `birth_wt`, `bilrubin_level`, `delayed_birth_cry`, `birthcrysec`, `premature_delivery_week`, `aspiration_of_fluid_days`, `nicu`)VALUES('$patID', '$weightLess', '$babyjaundice', '$birthAsphyxia', '$fetalDistress', '$apgArone', '$apgarFive', '$natalHrr', '$birth_wt', '$bilLevel', $birthcrychk, '$babybirthcry', '$prematuredel', '$babyaaf', '$babynicu')";
}
else{
    $qry_3 = "UPDATE `natal_hrr` SET `Patient_Id` = '$patID', `lbw` = '$weightLess', `nj` = '$babyjaundice', `ba` = '$birthAsphyxia', `fd` = '$fetalDistress', `as_1min` = '$apgArone', `as_5min` = '$apgarFive', `natal_hrr` = '$natalHrr', `birth_wt` = '$birth_wt', `bilrubin_level` = '$bilLevel', `delayed_birth_cry` = '$birthcrychk', `birthcrysec` = '$babybirthcry' `premature_delivery_week` = '$prematuredel', `aspiration_of_fluid_days` = '$babyaaf', `nicu` = '$babynicu' WHERE `natal_id` = '$natalid'";
}
mysql_query($qry_3);

//echo "$qry_3";
$natal_id = mysql_insert_id();
if(empty($postNatalid)){
    $qry_4 = "INSERT INTO `post_natal_hrrr`(`csa`,`ca`, `dd`, `vbf`, `cnv`, `omwe`, `thn`, `Patient_Id`) VALUES('$cranioFacial', '$coGenital', '$deGenerative', '$viralInfect', '$babyconvulsions', '$babyotitis', '$babytrauma', '$patID' )";
}else{
    $qry_4 = "UPDATE `post_natal_hrrr` SET `Patient_Id` = '$patID', `csa` = '$cranioFacial', `ca` = '$coGenital', `dd` = '$deGenerative', `vbf` = '$viralInfect', `cnv` = '$babyconvulsions', `omwe` = '$babyotitis', `thn` = '$babytrauma' WHERE `postnatal_id` = '$postNatalid'";
}
mysql_query($qry_4);
$postNatal_id = mysql_insert_id();

if(empty($otherid)){
    $qry_5 = "INSERT INTO `other_hrr` (`Patient_Id`, `cons_pos_val`, `cons_neg_val`, `conspos1`, `conspos2`, `conspos3`,  `fam_his_pos`, `fam_his_neg`, `fam_his_mat`, `fam_his_pat`, `fam_his_hi`, `fam_his_sp`, `fam_his_lg`, `fam_his_md`, `fam_his_oth`) VALUES('$patID', '$babyConsanguinity', '$babyConsanguinity', '$babyhrr1', '$babyhrr2', '$babyhrr3', '$familyHistory', '$familyHistory', '$babymaternal', '$babypaternal', '$babyHi', '$babysp', '$babylg', '$babymd', '$otherBaby' )";
}else{
    $qry_5 = "UPDATE `other_hrr` SET `Patient_Id` = '$patID', `cons_pos_val` = '$babyConsanguinity', `cons_neg_val` = '$babyConsanguinity', `conspos1` = '$babyhrr1', `conspos2` = '$babyhrr2', `conspos3` = '$babyhrr3', `fam_his_pos` = '$familyHistory', `fam_his_neg` = '$familyHistory', `fam_his_mat` = '$babymaternal', `fam_his_pat` = '$babypaternal', `fam_his_hi` = '$babyHi', `fam_his_sp` = '$babysp', `fam_his_lg` = '$babylg', `fam_his_md` = '$babymd', `fam_his_oth` = '$otherBaby' WHERE `other_id` = '$otherid'";
}
mysql_query($qry_5);

$otherId = mysql_insert_id($qry_5);


//echo "$qry_2 - $qry_3 - $qry_4 - $qry_4";

echo "
    <input type='text' name='prenatal_id' id='prenatal_id' hidden='' value='$preNatalId'>
    <input type='text' name='natal_id' id='natal_id' hidden='' value=' $natal_id'>
    <input type='text' name='postNatal_id' id='postNatal_id' hidden='' value=' $postNatal_id'>
    <input type='text' name='other_id' id='other_id' hidden='' value=' $otherId '>
";

?>