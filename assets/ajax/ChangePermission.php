<?php

include_once '../lib/maincore.php';

$roleType = mysql_real_escape_string($_POST["roleType"]);
$Page_name = mysql_real_escape_string($_POST["pageName"]);
$pageId = mysql_real_escape_string($_POST["page_Id"]);
$permisionType = mysql_real_escape_string($_POST["permisnType"]);
$index = $_POST["indexVal"];

$qryPagepermit = mysql_query("SELECT `permissions` FROM `tbl_page_permission` WHERE `page_id` = '$pageId'");
$rw = mysql_fetch_assoc($qryPagepermit); 

$qrySetPermit = (empty($pageId))?"INSERT INTO `tbl_page_permission` (`page_name`, `role_type`, `permissions`, `permit_created_by`, `permit_created_on`) VALUES('$Page_name', '$roleType', '$permisionType', '".USERAUTH."', NOW())":"UPDATE `tbl_page_permission` SET `page_name` = '$Page_name', `role_type` = '$roleType', `permissions` = '$permisionType', `permit_updated_by` = '".USERAUTH."', `permit_updated_on` = NOW() WHERE `page_id` = '$pageId'";


//echo $qrySetPermit;

mysql_query($qrySetPermit);

$lastPageId = mysql_insert_id();

$pageperId = (empty($pageId)||$lastPageId != 0)?"$lastPageId":"$pageId";

if(empty($pageId)){
   mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'pages', 'The permission ".getPermissionNameById($permisionType)." is assigned to pagename - $Page_name of role type - ".getRoleNameByID(encode($roleType))."')"); 
}
else{
    
   // echo "INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'pages', 'The permission is changed from -".getPermissionNameById($rw["permissions"])." to ".getPermissionNameById($permisionType)." , pagename '$Page_name' of role type ".getRoleNameByID(encode($roleType))."')";
    mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '".USERAUTH."', '".date("d-m-Y h:i:sa")."', 'pages', 'The permission is changed from -".getPermissionNameById($rw["permissions"])." to ".getPermissionNameById($permisionType)." , pagename $Page_name of role type ".getRoleNameByID(encode($roleType))."')"); 
}

echo "<input type='text' hidden='' name='' id='perPageId$index' value='$pageperId'>";