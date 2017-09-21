<?php
include_once '../lib/maincore.php';
ob_start();
session_start();
$hospital_id = $_REQUEST['hospid'];

//echo "$hospital_id";

//echo $hospital_id;
$sql_hos = "SELECT hosp_abbr  FROM  tbl_hospital  WHERE hosp_id ='" . $hospital_id. "' ";  

$rstest_hos = mysql_query($sql_hos);
$myrow_hos = mysql_fetch_array($rstest_hos);
$hosp_abbr = $myrow_hos['hosp_abbr'];
$sql = "SELECT count(*) as hoscnt FROM  patient  WHERE Hospital_Name ='" . $hospital_id . "' ";  
$rstest = mysql_query($sql);
$myrow = mysql_fetch_array($rstest);
$mycnt = $myrow['hoscnt'];


$sql_pocd = "SELECT count(*) as pocdcnt FROM  patient ";
//echo $sql_pocd;
$rstest_pocd = mysql_query($sql_pocd);
$myrow_pocd = mysql_fetch_array($rstest_pocd);
$pocdcnt = $myrow_pocd['pocdcnt'];
$pocdcntt = $pocdcnt + 1;
$_SESSION["pocd123"] = "NPOCD" . str_repeat("0", 4 - strlen($pocdcntt)) . $pocdcntt;
//echo $pocd123;

if ($mycnt == 0) {
    $cntvar = 1;
    $bid = "N".$hosp_abbr . "0001";
    //echo $bid.','.$pocd123;
    $_SESSION['baby_id'] = $bid;

} else {

    $sql1 = "SELECT count(*)+1 as hoscntt FROM  patient  WHERE Hospital_Name = '" . $hospital_id . "' "; 
    $rstest1 = mysql_query($sql1);
    $myrow1 = mysql_fetch_array($rstest1);
    $mycnt1 = $myrow1['hoscntt'];
    $bid = "N".$hosp_abbr . str_repeat("0", 4 - strlen($mycnt1)) . $mycnt1;
    
//    echo $bid.','.$pocd123;
    $_SESSION['baby_id'] = $bid;
}

echo "
    
    <div class='col-md-4' id='bid'>
    <label class='control-label'>Baby identification no.</label>
        <input type='text' size='10' name='baby_id_num' class='form-control' readonly=''  id='baby_id_num' value='{$_SESSION['baby_id']}' >
    </div>  
    
    <div class='col-md-4'>
        <label class='control-label'>POCD</label>
        <input type='text' size='10' name='pocd_no' class='form-control'  id='pocd_no' readonly='' value='{$_SESSION["pocd123"]}'  required>
    </div>
";

//echo $pocd123;
?>









