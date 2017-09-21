<?php
$pages[] = array();
foreach ($case as $key=>$pages){
    $_SESSION["trackPage"] .= $pages;
}
$user = !(USERAUTH == "USERAUTH")?"".USERAUTH."":"0";

 
$_SESSION["page"] .= $case.",";

 $commaDevidePage = explode(",", $_SESSION["page"]);
 $last_index = sizeof($commaDevidePage);
 $prevLastIndex = $last_index-2;
 $prevofPrevIndex = $last_index-3;
 
 if($commaDevidePage[$prevLastIndex] == $commaDevidePage[$prevofPrevIndex]){
     $pageView = "";
 }
 else{
     $pageView = $case.",";
 }
 
 $_SESSION["pageViewed"] .= $pageView; 

//$page_view = ($commaDevidePage[$prevLastIndex] == $case)?"":""; 
if(!empty($_SESSION["logstatus"])){ 
  $ip_addr = $_SERVER["REMOTE_ADDR"];
  $log_user = $user;
  $loginTime = $_SESSION["loginTime"];
  $loginStatus = $_SESSION["logstatus"];
  $page_view = mysql_real_escape_string($_SESSION["pageViewed"]); 
  
  if(empty($_SESSION["log_id"])){
    $qry_log = "INSERT INTO `activity_log_tb` (`log_ip_address`, `log_login_status`, `log_login_user`, `log_login_time`, `log_pages_viewed`) VALUES('$ip_addr', '$loginStatus', '$log_user', '$loginTime', '$page_view')";
   // mysql_query($qry_log);
   // $_SESSION["log_id"] = mysql_insert_id();
   
  }
  else{
     $qry_log = "UPDATE `activity_log_tb` SET `log_ip_address` = '$ip_addr',`log_login_status` = '$loginStatus', `log_login_user` = '$log_user', `log_login_time` = '$loginTime', `log_pages_viewed` = '$page_view' WHERE `log_id` = '{$_SESSION["log_id"]}'";
    // mysql_query($qry_log);
  }
  
   echo $qry_log;
//echo "Page Name: $case </br> IP Address: {$_SERVER["REMOTE_ADDR"]} </br> User: ".USERAUTH." </br> Login time: ".date("Y-m-d", $_SESSION["loginTime"])."";
//echo "Page Name: {$page_view} </br> IP Address: {$_SERVER["REMOTE_ADDR"]} </br> User: $user</br> Login time: {$_SESSION["loginTime"]} </br> Login status : {$_SESSION["logstatus"]}";

}
