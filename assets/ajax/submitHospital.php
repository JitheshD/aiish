<?php 
include_once '../lib/maincore.php';

$hospital=  mysql_real_escape_string($_POST['hospName']);
$hospitalAbbr=mysql_real_escape_string($_POST['hospAbbr']);
$aiishId = mysql_real_escape_string($_POST["aiish_Center"]);
$stateId=mysql_real_escape_string($_POST['state']);
$distId=mysql_real_escape_string($_POST['dist']);
$hospitalId=mysql_real_escape_string($_POST['hospId']);

//$con = mysqli_connect('localhost', 'root', ''); 
//if (!$con) {
//    die('Could not connect: ' . mysql_error());
//}
//mysqli_select_db($con,'aiish1');
 $query="SELECT `hosp_id` FROM `tbl_hospital` WHERE `hosp_abbr` LIKE '$hospitalAbbr'"; 
$result=mysql_query($query);
$rw = mysql_fetch_assoc($result);

if(mysql_num_rows($result) > 0 && empty($hospitalId)){
    echo "error";
}
elseif(mysql_num_rows($result) > 0 && $rw["hosp_id"] != $hospitalId){
    echo "error";
}
else{
    $qry_1 = (empty($hospitalId))?"INSERT INTO `tbl_hospital` (`hosp_name`, `hosp_abbr`, `aiish_id`, `hosp_state_id`, `hosp_dist_id`, `hosp_created_on`, `hosp_created_by`) VALUES('$hospital', '$hospitalAbbr', '$aiishId', '$stateId', '$distId', NOW(), '".USERAUTH."')":
                                  "UPDATE `tbl_hospital` SET `hosp_name` = '$hospital', `hosp_abbr` = '$hospitalAbbr', `aiish_id` = '$aiishId', `hosp_state_id` = '$stateId', `hosp_dist_id` = '$distId', `hosp_updated_on` = NOW(), `hosp_updated_by` = '".USERAUTH."' WHERE `hosp_id` = '$hospitalId' ";
    $message = "Hospital added successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            
            $newHospitalId = mysql_insert_id();
            if(empty($hospitalId)){
                $hospitalAddLogMsg = "New Hospital added with hosp_id - $newHospitalId";
            }
            else{
               $hospitalAddLogMsg = "add-hospital updated to hosp_id - $hospitalId"; 
            }
            
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-hospital', '$hospitalAddLogMsg')");
            
            $_SESSION["su"] = "$message";       
        }
}

?>

