<?php 
include_once '../lib/maincore.php';

$aiish_Name =  mysql_real_escape_string($_POST['aiishName']);
$state_id = mysql_real_escape_string($_POST['stateId']);
$district_id = mysql_real_escape_string($_POST['district_id']);
$aiish_id = mysql_real_escape_string($_POST["aiishId"]);



    $qry_1 = (empty($aiish_id))?"INSERT INTO `tbl_aiish` (`aiish_name`, `aiish_state_id`, `aiish_district_id`, `aiish_created_by`, `aiish_created_on`) VALUES('$aiish_Name', '$state_id', '$district_id', '".USERAUTH."', NOW())":
                                  "UPDATE `tbl_aiish` SET `aiish_name` = '$aiish_Name', `aiish_district_id` = '$district_id', `aiish_state_id` = '$state_id', `aiish_updated_on` = NOW(), `aiish_updated_by` = '".USERAUTH."' WHERE `aiish_id` = '$aiish_id' ";
    $message = "AIISH center added successfully.";
    
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $newaiishId = mysql_insert_id();
            if(empty($aiish_id)){
                $aiishAddLogMsg = "New AIISH center added with aiish_id - $newaiishId";
            }
            else{
               $aiishAddLogMsg = "AIISH center updated to aiish_id - $aiish_id"; 
            }
            $aiishLogId = (empty($aiish_id))?"$newaiishId":"$aiish_id";
            $qryAddAiish = mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-aiish', '$aiishAddLogMsg')");
            
            $_SESSION["su"] = "$message";       
        }


?>

