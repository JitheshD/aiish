<?php
    $upDateLogout = "UPDATE `activity_log_tb` SET `log_logout_time` = '".date("d-m-Y h:i:sa")."' WHERE `log_id` = '{$_SESSION["log_id"]}'";
    mysql_query($upDateLogout);
    session_destroy();
    redirect(HostRoot);
?>