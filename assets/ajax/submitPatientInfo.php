<?php

include_once '../lib/maincore.php';

$hospital_id = mysql_real_escape_string($_POST["hospId"]);
$babynum = mysql_real_escape_string($_POST["babynum"]);
$pocdnum = mysql_real_escape_string($_POST["pocdnum"]);
$babyName = mysql_real_escape_string($_POST["babyName"]);
$bDate = $_POST["birthDate"];
$birthDate = convertFromSqlDate($bDate);
$babyage = mysql_real_escape_string($_POST["baby_age"]);
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
$patientId = mysql_real_escape_string($_POST["patient_id"]);


if(empty($patientId)){
    $qry_1 = "INSERT INTO `patient` (`Hospital_Name`, `Delivery_type_Name`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Caste`, `Region`, `Present_address`, `Permanent_address`, `state_id`, `district_id`,`city_id`, `Phone_number`, `Email_id`, `Income_per_month`, `Medical_history`, `Date_of_HRR_Screen`, `user_name`, `last_inserted_on`, `last_inserted_by`) VALUES('$hospital_id', '$deliveryType', '$babynum', '$babyName', '$pocdnum', '$birthDate', '$babyage', '$babygender', '$babyfather', '$babymother', '$babyreligion', '$babycaste', '$babyregion', '$preAddress', '$peraddress', '$babystate', '$babydistrict', '$babycity', '$contactNo', '$emailId', '$babysocioeco', '$medHistory', '$screenDate', '$staffName', NOW(), '".USERID."')";
    $activityLog = "Demographic detail of NBS Screen Inserted successfully";
    
}else{
    $qry_1 = "UPDATE `patient` SET `Hospital_Name` = '$hospital_id', `Delivery_type_Name` = '$deliveryType', `baby_id_num` = '$babynum', `Baby_name` = '$babyName', `POCD_No` = '$pocdnum', `Date_of_Birth` = '$birthDate', `Age` = '$babyage', `Gender` = '$babygender', `Father_name` = '$babyfather', `Mother_name` = '$babymother', `Religion` = '$babyreligion', `Caste` = '$babycaste', `Region` = '$babyregion', `Present_address` = '$preAddress', `Permanent_address` = '$peraddress', `state_id` = '$babystate', `district_id` = '$babydistrict', `city_id` = '$babycity', `Phone_number` = '$contactNo', `Email_id` = '$emailId', `Income_per_month` = '$babysocioeco', `Medical_history` = '$medHistory', `Date_of_HRR_Screen` = '$screenDate', `user_name` = '$staffName', `last_updated_on` = NOW(), `last_updated_by` = '".USERID."' WHERE `Patient_Id` = '$patientId'";

    $activityLog = "Demographic detail of NBS Screen Updated successfully";
}
mysql_query($qry_1);
//echo $qry_1;

//$patient_id = mysql_insert_id($qry_1);
$patient_id = mysql_insert_id();
//echo "Patient-".$patient_id;
//$PatientId = $patient_id;
$babyPatId = ($patient_id == 0)? "$patientId":"$patient_id";

mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'data-entry', '$activityLog')");
//$_SESSION["PatientId"] = $patient_id

echo "
   <!-- <input type='text' hidden=''  name='pat_id' id='pat_id' value='$babyPatId '>-->
    <input type='text' hidden=''  name='pat_id' id='pat_id' value='$babyPatId '>
";
if(mysql_errno()){
?>
<script>
showToast.show('Fill all fields',2000);
</script>
<?php }else{ ?>
    <script>
        showToast.show('Successfully submitted Demographic details',2000);
    </script>

<?php } ?>
