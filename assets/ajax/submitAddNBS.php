<?php 
include_once '../lib/maincore.php';

$nbs_name =  mysql_real_escape_string($_POST['nbsName']);
$aiish_id =  mysql_real_escape_string($_POST['aiishId']);
$districtId =  mysql_real_escape_string($_POST['district_id']);
$state_id = mysql_real_escape_string($_POST['stateId']);
$nbs_id = mysql_real_escape_string($_POST['nbsId']);



    $qry_1 = (empty($nbs_id))?"INSERT INTO `tbl_nbs` (`nbs_name`, `aiish_id`, `nbs_district_id`, `nbs_state_id`, `nbs_created_on`, `nbs_created_by`) VALUES('$nbs_name', '$aiish_id', '$districtId', '$state_id', NOW(), '".USERAUTH."')":
                                  "UPDATE `tbl_nbs` SET `nbs_name` = '$nbs_name', `aiish_id` = '$aiish_id', `nbs_district_id` = '$districtId', `nbs_state_id` = '$state_id', `nbs_updated_on` = NOW(), `nbs_updated_by` = '".USERAUTH."' WHERE `nbs_id` = '$nbs_id' ";
    $message = "NBS Center added successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            
            $newNBSId = mysql_insert_id();
            if(empty($nbs_id)){
                $nbsAddLogMsg = "New NBS center added with nbs_id - $newNBSId";
            }
            else{
               $nbsAddLogMsg = "add-nbs updated to nbs_id - $nbs_id"; 
            }
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-nbs', '$nbsAddLogMsg')");
            
            $_SESSION["su"] = "$message";       
        }


?>

