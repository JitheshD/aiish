<?php
include_once '../lib/maincore.php';
$patientID = mysql_real_escape_string($_POST["patientId"]);
$nbsHospital = mysql_real_escape_string($_POST["nbschkval"]);

$centers = explode("-", $nbsHospital);

$centerType = $centers[1];

if($centerType == "nbs"){
    $qry_1 = "UPDATE `patient` SET `nbs_refer` = '$centers[0]', `osc_refer` = '0', `aiish_refer` = '0' WHERE `Patient_Id` = '$patientID'";
}
if($centerType == "osc"){
    $qry_1 = "UPDATE `patient` SET `osc_refer` = '$centers[0]', `nbs_refer` = '0', `aiish_refer` = '0' WHERE `Patient_Id` = '$patientID'";
}
if($centerType == "aiish"){
    $qry_1 = "UPDATE `patient` SET `aiish_refer` = '$centers[0]', `nbs_refer` = '0', `osc_refer` = '0', WHERE `Patient_Id` = '$patientID'";
}
mysql_query($qry_1);