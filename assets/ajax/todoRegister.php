<?php
include_once '../lib/maincore.php';

$user_name = strip_tags($_POST["usrname"]);
$user_email_id = strip_tags($_POST["usremail"]);
$user_role = strip_tags($_POST["usrrole"]);
$user_password = hash('sha256', $_POST["usrpwd"]);
$user_id = strip_tags($_POST["usrid"]);
//$key = "569661af6b9fd";
//$gen_otp = rand(10000, 99999);
//$send_otp = urlencode($gen_otp);
if($user_id == ""){
$qry_1 = "SELECT * FROM `users` WHERE `userEmail` = '$user_email_id'";
$result = mysql_query($qry_1);
//$rw = mysql_fetch_array($result);
if(mysql_num_rows($result) != 0){
    echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-remove pr10'></i>Email alredy exists</div>";
}

else{
    echo "1";
    //echo $user_name;
   // file_get_contents("http://softsms.in/app/smsapi/index.php?key={$key}&type=text&contacts={$user_mobile_number}&senderid=LBTECH&msg={$send_otp}"); 
    //http://softsms.in/app/smsapi/index.php?key=569661af6b9fd&type=text&contacts=8748867919&senderid=LBTECH&msg=test+new    
    
     mysql_query("INSERT INTO `users` (`userName`, `userEmail`, `userRole`, `userPass`, `user_inserted_on`, `user_created_by`) VALUES('$user_name', '$user_email_id', '$user_role', '$user_password', NOW(), '".USERID."') ");
    
    
//    $submit_reg = "CALL sumitRegistration('{$user_mobile_number}', '{$user_password}', '{$user_name}', '{$user_email_id}', '{$send_otp}')";


}
}
else{
        mysql_query("UPDATE `users` SET `userName` = '$user_name', `userEmail` = '$user_email_id', `userRole` = '$user_role', `userPass` = '$user_password', `user_updated_on` = NOW(), `user_updated_by` = '".USERID."' WHERE `userId` = '$user_id'");
    }



