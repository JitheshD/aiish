<?php 
include_once '../lib/maincore.php';

$talqName=  mysql_real_escape_string($_POST['talqName']);
$stateId=mysql_real_escape_string($_POST['stateId']);
$district_id=mysql_real_escape_string($_POST['district_id']);
$talq_id=mysql_real_escape_string($_POST['talq_id']);



    $qry_1 = (empty($talq_id))?"INSERT INTO `tbl_cities` (`cityname`, `dist_id`, `state_id`, `city_created_on`, `city_created_by`) VALUES('$talqName', '$stateId', '$district_id', NOW(), '".USERAUTH."')":
                                "UPDATE `tbl_cities` SET `cityname` = '$talqName', `dist_id` = '$district_id', `state_id` = '$stateId', `city_updated_on` = NOW(), `city_updated_by` = '".USERAUTH."' WHERE `city_id` = '$talq_id' ";
    $message = "Taluk added successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $newTalukId = mysql_insert_id();
            if(empty($talq_id)){
                $talqAddLogMsg = "New Taluk added with city_id - $newTalukId";
            }
            else{
               $talqAddLogMsg = "add-taluk updated to city_id - $talq_id"; 
            }
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-taluk', '$talqAddLogMsg')");
            $_SESSION["su"] = "$message";       
        }


?>

