<?php
include_once '../lib/maincore.php';

$user_name = strip_tags($_POST["user_name"]);
$user_password = encode(strip_tags($_POST["password"]));

if(!empty($user_name) && !empty($user_password)){
 $qry_1 = "select * from `user_tb` where `user_email`='{$user_name}' and `user_password`='$user_password'"; 
   // echo $qry_1;
    $result = mysql_query($qry_1);
    
    $_SESSION["logstatus"] = (mysql_num_rows($result) == 1)?"1":"2";
    if (mysql_num_rows($result) == 1) {
        unset($_SESSION["attempt_count"]);
        unset($_SESSION["logFailId"]);
        echo "success";
        $activity = "";
        
        //$_SESSION["loginTime"] = date("d-m-Y h:i:sa");
        //$login_status = "Success";
        
        $rw = mysql_fetch_array($result);
        $_SESSION['LBT_USER'] = $rw;
        unset($_SESSION['er']);
        
        $qry_logActivity = "INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '{$rw["user_id"]}', '".date("d-m-Y h:i:sa")."', 'login', 'Login attempt success')";
        mysql_query($qry_logActivity);
        
       // mysql_query("UPDATE `user_log_tb` SET `user_last_login` = NOW(), `user_logout` = '' WHERE `user_id` = {$rw["user_id"]}");
        
        ///Setting Cookie
//        $year = time() + 31536000;
//        if($POST['remember']) {
//            setcookie('remember_me', $userName, $year);
//        }
//        elseif(!$POST['remember']) {
//            if(isset($_COOKIE['remember_me'])) {
//                $past = time() - 100;
//                setcookie(remember_me, gone, $past);
//            }
//        }
        
        /* }elseif($rw["user_logout"] == '0000-00-00 00:00:00'){
          $_SESSION['er'] = "Not able to login. Another Session is in active Mode";
          redirect("./login.php");
          } */
    } else {
       // $login_status = "fail";
        
        $sel_log = mysql_query("SELECT `log_id` FROM `activity_log_tb` WHERE `log_id` = '{$_SESSION["logFailId"]}'");
        $rwLog = mysql_fetch_assoc($sel_log);
        $attempt = empty($_SESSION["attempt_count"])?1:$_SESSION["attempt_count"]+1;
       if(empty($rwLog["log_id"])){
        mysql_query("INSERT INTO `activity_log_tb` (`ip_address`, `user`, `activity_date_time`, `activity_page`, `page_activity`) VALUES('{$_SERVER["REMOTE_ADDR"]}', '0', '".date("d-m-Y h:i:sa")."', 'login', 'Login attempt Failed(Attempted $attempt times)')");
        $_SESSION["logFailId"] = mysql_insert_id();
        $_SESSION["attempt_count"] = $_SESSION["attempt_count"] + 1;
        //echo "Attempt - {$_SESSION["attempt_count"]}";
        
        } 
       else{
          mysql_query("UPDATE `activity_log_tb` SET `page_activity` = 'Login attempt Failed(Attempted $attempt times)' WHERE `log_id`= '{$_SESSION["logFailId"]}' ");
           
            //mysql_query($qry_logActivity); 
            $_SESSION["attempt_count"] = $_SESSION["attempt_count"] + 1;
            //echo "Attemp -{$_SESSION["attempt_count"]}";
           
        }
       echo "Invalid Username/Password!...";
    }
}
else{
    echo "User name password required";
}