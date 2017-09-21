<?php 
include_once '../lib/maincore.php';

$osc_name =  mysql_real_escape_string($_POST['oscName']);
$aiish_id =  mysql_real_escape_string($_POST['aiishId']);
$districtId =  mysql_real_escape_string($_POST['district_id']);
$state_id = mysql_real_escape_string($_POST['stateId']);
$osc_id = mysql_real_escape_string($_POST['oscId']);



    $qry_1 = (empty($osc_id))?"INSERT INTO `tbl_osc_centers` (`osc_names`, `aiish_id`, `osc_state_id`, `osc_district_id`, `osc_created_on`, `osc_created_by`) VALUES('$osc_name', '$aiish_id', '$state_id', '$districtId', NOW(), '".USERAUTH."')":
                                  "UPDATE `tbl_osc_centers` SET `osc_names` = '$osc_name', `aiish_id` = '$aiish_id', `osc_state_id` = '$state_id', `osc_district_id` = '$districtId', `osc_updated_on` = NOW(), `osc_updated_by` = '".USERAUTH."' WHERE `osc_id` = '$osc_id' ";
    $message = "OSC Center added successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            
            $newOSCId = mysql_insert_id();
            if(empty($osc_id)){
                $oscAddLogMsg = "New OSC center added with osc_id - $newOSCId";
            }
            else{
               $oscAddLogMsg = "add-osc updated to osc_id - $osc_id"; 
            }
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-osc', '$oscAddLogMsg')");
            $_SESSION["su"] = "$message";       
        }


?>

