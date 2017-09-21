<?php 
include_once '../lib/maincore.php';

$districtName =  mysql_real_escape_string($_POST['districtName']);
$state_id = mysql_real_escape_string($_POST['state_id']);
$district_id = mysql_real_escape_string($_POST['district_id']);



    $qry_1 = (empty($district_id))?"INSERT INTO `tbl_districts` (`distname`, `state_id`, `dist_created_on`, `dist_created_by`) VALUES('$districtName', '$state_id', NOW(), '".USERAUTH."')":
                                  "UPDATE `tbl_districts` SET `distname` = '$districtName', `state_id` = '$state_id', `dist_updated_on` = NOW(), `dist_updated_by` = '".USERAUTH."' WHERE `dist_id` = '$district_id' ";
            $message = "District added successfully.";
    
     if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            
            $newDistrictId = mysql_insert_id();
            if(empty($district_id)){
                $districtAddLogMsg = "New District added with district_id - $newDistrictId";
            }
            else{
               $districtAddLogMsg = "add-district updated to district_id - $district_id"; 
            }
            
            mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'add-district', '$districtAddLogMsg')");
            $_SESSION["su"] = "$message";       
        }


?>

