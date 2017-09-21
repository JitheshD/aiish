<?php

include_once '../lib/maincore.php';

//$testVal1 = $_POST["patient"];
$explodeMnthId = $_POST["month"];
$remark = $_POST["fupRemark"];



//echo "$testVal1";
$devideMnthId = explode(",", $explodeMnthId);
//
$patId = $devideMnthId[1];
$month = $devideMnthId[0];

$pfup = getPfupBymnth($patId,$month); 

if(empty($pfup["pfup_id"])){
    $qry_1 = "INSERT INTO `tbl_phonef_up` (`Patient_Id`, `pfup_remark`, `pfup_month`) VALUES('$patId', '$remark', '$month')";
}
else{
    $qry_1 = "UPDATE `tbl_phonef_up` SET `Patient_Id` = '$patId', `pfup_remark` = '$remark', `pfup_month` = '$month' WHERE `pfup_id` = {$pfup["pfup_id"]}";
}
 mysql_query($qry_1);

//$pfupId = mysql_insert_id();
//
//echo "<input type='text' id='pfpid' value='$pfupId'>";
//echo $pfupId;
//echo $qry_1;