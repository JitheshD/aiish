<?php 
include_once '../lib/maincore.php';

$role_name =  mysql_real_escape_string($_POST['roleName']);
$roleId =  mysql_real_escape_string($_POST['role_id']);

$qry_1 = (empty($roleId))?"INSERT INTO `user_role_tb` (`role_type`, `role_created_on`, `role_created_by`) VALUES('$role_name', NOW(), '".USERAUTH."')":
                                  "UPDATE `user_role_tb` SET `role_type` = '$role_name', `role_updated_on` = NOW(), `role_updated_by` = '".USERAUTH."' WHERE `role_id` = '$roleId' ";
    $message = "Role created successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $newRoleId = mysql_insert_id();
            if(empty($roleId)){
                $userRoleAddLogMsg = "New role created with role_id - $newRoleId";
            }
            else{
               $userRoleAddLogMsg = "create-role updated to role_id - $roleId"; 
            }
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'create-role', '$userRoleAddLogMsg')");
            $_SESSION["su"] = "$message";       
        }


?>

