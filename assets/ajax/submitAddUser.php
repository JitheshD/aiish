<?php 
include_once '../lib/maincore.php';

$userName=  mysql_real_escape_string($_POST['user_name']);
$userRole=mysql_real_escape_string($_POST['user_role']);
$userEmail=mysql_real_escape_string($_POST['user_email']);
$userPassword=mysql_real_escape_string($_POST['user_password']);
$encPwd = encode($userPassword);
$aiishId = mysql_real_escape_string($_POST["aiish_center"]);
$stateId=mysql_real_escape_string($_POST['state']);
$distId=mysql_real_escape_string($_POST['dist']);
$userId=mysql_real_escape_string($_POST['user_id']);


    $qry_1 = (empty($userId))?"INSERT INTO `user_tb` (`user_name`, `role_id`, `user_email`, `user_password`, `aiish_id`, `state_id`, `district_id`, `user_created_on`, `user_created_by`) VALUES('$userName', '$userRole', '$userEmail', '$encPwd', '$aiishId', '$stateId', '$distId', NOW(), '".USERAUTH."')":
                                  "UPDATE `user_tb` SET `user_name` = '$userName', `role_id` = '$userRole', `user_email` = '$userEmail', `user_password` = '$encPwd', `aiish_id` = '$aiishId', `state_id` = '$stateId', `district_id` = '$distId', `user_updated_on` = NOW(), `user_updated_by` = '".USERAUTH."' WHERE `user_id` = '$userId'";
    $message = "User added succesfully.".$qry_1;
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $newUserId = mysql_insert_id();
            if(empty($userId)){
                $userAddLogMsg = "New User added with user_id - $newUserId";
            }
            else{
               $userAddLogMsg = "add-user updated to user_id - $userId"; 
            }
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-user', '$userAddLogMsg')");
            $_SESSION["su"] = "$message";       
        }
?>

