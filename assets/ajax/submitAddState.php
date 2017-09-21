<?php 
include_once '../lib/maincore.php';

$state_name=  mysql_real_escape_string($_POST['stateName']);
$state_id=mysql_real_escape_string($_POST['stateId']);



    $qry_1 = (empty($state_id))?"INSERT INTO `tbl_states` (`statename`, `state_created_on`, `state_created_by`) VALUES('$state_name', NOW(), '".USERAUTH."')":
                                  "UPDATE `tbl_states` SET `statename` = '$state_name', `state_updated_on` = NOW(), `state_updated_by` = '".USERAUTH."' WHERE `state_id` = '$state_id' ";
    $message = "State added successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $newStateId = mysql_insert_id();
            if(empty($state_id)){
                $stateAddLogMsg = "New State added with state_id - $newStateId";
            }
            else{
               $stateAddLogMsg = "add-state updated to state_id - $state_id"; 
            }
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-state', '$stateAddLogMsg')");
            $_SESSION["su"] = "$message";       
        }


?>

