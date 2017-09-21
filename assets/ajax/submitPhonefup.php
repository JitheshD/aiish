<?php

include_once '../lib/maincore.php';

//$explodeMnthId = mysql_real_escape_string($_POST["month"]);
$remark = mysql_real_escape_string($_POST["mnthRemark"]);

echo "$remark";

//$devideMnthId = explode(",", $explodeMnthId);
//
//$patId = $devideMnthId[1];
//$month = $devideMnthId[0];

//$qry_1 = "INSERT INTO `tbl_phonef_up` (`Patient_Id`, `pfup_remark`, `pfup_month`) VALUES('$patId', '$remark', '$month')";
//mysql_query($qry_1);

//$pfupId = mysql_insert_id();

//echo $pfupId;
//echo $qry_1;