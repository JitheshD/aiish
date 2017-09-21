<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//To Check Page Authentication
function checkAuthLevel($level1 = 0, $level2 = 0, $level3 = 0, $level4 = 0) {
    if ($level1 == 0 && $level2 == 0 && $level3 == 0 && $level4 == 0) {
        redirect(BASEDIR . "home.php");
    } else if ($level1 == $_SESSION['UDP_UserInfo']["user_auth"] || $level2 == $_SESSION['UDP_UserInfo']["user_auth"] || $level3 == $_SESSION['UDP_UserInfo']["user_auth"] || $level4 == $_SESSION['UDP_UserInfo']["user_auth"]) {
        $_SESSION["UDP_UserLevel"] = true;
    } else {
        redirect(BASEDIR . "?dashboard");
    }
}

//Check Uploading file status
function CheckFileStatus($File) {
    $Files = "";
    $fileInfo;
    // Require a file to be attached: false = Do not allow attachments true = allow only 1 file to be attached
    $requirefile = "true";

    // Allowed file types. add file extensions WITHOUT the dot.
    $allowtypes = array("jpg", "jpeg", "png", "gif", "bmp");
    // Maximum file size for attachments in KB NOT Bytes for simplicity. MAKE SURE your php.ini can handel it,
    // post_max_size, upload_max_filesize, file_uploads, max_execution_time!
    // 2048kb = 2MB,       1024kb = 1MB,     512kb = 1/2MB etc..
    $max_file_size = "2048";
    
    
    for ($i = 0; $i < sizeof($File); $i++) {
        $filename = "";
        $errorMessage = "";
        $fileName = rand(1, 100000000) . randLetter();

        if ((!empty($File[$i])) && ($File[$i]['error'] == 0)) { 
            // basename -- Returns filename component of path
            $filename = strtolower(basename($File['name'][$i]));
//            echo "<script> alert('{$filename}'); </script>";
            $ext = substr($filename, strrpos($filename, '.') + 1);
            $filesize = $File[$i]['size'];
            $max_bytes = $max_file_size * 1024;
            $fileName = $fileName . "." . $ext;
            //Check if the file type uploaded is a valid file type. 
            if (!in_array($ext, $allowtypes)) {
                $errorMessage .= "<span>Invalid extension for your file: <strong>'" . $filename . "'</strong></span><br />\n";

                // check the size of each file
            } elseif ($filesize > $max_bytes) {
                $errorMessage .= "<span> Your file: <strong>" . $filename . "</strong> is to big. Max file size is '" . $max_file_size . "'kb.</span><br />\n";
            }
        }
        
        $Files[$i]["FileName"] = $filename;
        $Files[$i]["FName"] = $fileName;
        $Files[$i]["FError"] = $errorMessage;
 
 
    }


    return $Files;
}

//Upload files to server
function uploadIt($FILES, $FileInfo, $attr, $attr_name, $directory) {

    if ((!empty($FILES["{$attr_name}"])) && ($FILES["{$attr_name}"]['error'] == 0)) {
        $target = $directory . $FileInfo["FName"];
        $attr["{$attr_name}"] = $FileInfo["FName"];
        //Uploading file to img/uaer/ directory
        if (move_uploaded_file($FILES["{$attr_name}"]["tmp_name"], $target)) {
            createThumbs("{$directory}{$FileInfo["FName"]}", "{$directory}{$FileInfo["FName"]}", 400);
            createThumbs("{$directory}{$FileInfo["FName"]}", "{$directory}thumbs/{$FileInfo["FName"]}", 150);
            $errorMessage .= "<center><span>The file {$FileInfo["FileName"]} has been uploaded.</span></center><br />\n";
        } else {
            $errorMessage .= "<span>Sorry, there was a problem uploading your file {$FileInfo["FileName"]}.</span><br />\n";
        }
        
    } else {
        $attr["{$attr_name}"] = $attr["{$attr_name}1"];
    }
    return $target;//$attr["{$attr_name}"];
}

//Create Uploaded Image Thumbnail
function createThumbs($pathToImages, $pathToThumbs, $thumbWidth) {
    // parse path for the extension
    $allowtypes = array("jpg", "jpeg", "png", "gif", "bmp");
    $info = pathinfo($pathToImages);
    // continue only if this is a JPEG image
    if (in_array($info['extension'], $allowtypes)) {
        // load image and get image size
        $img = ""; // imagecreatefromjpeg("{$pathToImages}");

        if ($info['extension'] == 'jpg' || $info['extension'] == 'jpeg')
            $img = imagecreatefromjpeg("{$pathToImages}");
        if ($info['extension'] == 'png')
            $img = imagecreatefrompng("{$pathToImages}");
        if ($info['extension'] == 'gif')
            $img = imagecreatefromgif("{$pathToImages}");
        if ($info['extension'] == 'bmp')
            $img = imagecreatefromwbmp("{$pathToImages}");

        $width = imagesx($img);
        $height = imagesy($img);

        // calculate thumbnail size
        $new_width = $thumbWidth;
        $new_height = floor($height * ( $thumbWidth / $width ));

        // create a new temporary image
        $tmp_img = imagecreatetruecolor($new_width, $new_height);

        // copy and resize old image into new image
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // save thumbnail into a file

        if ($info['extension'] == 'jpg' || $info['extension'] == 'jpeg')
            imagejpeg($tmp_img, "{$pathToThumbs}");
        if ($info['extension'] == 'png')
            imagepng($tmp_img, "{$pathToThumbs}");
        if ($info['extension'] == 'gif')
            imagegif($tmp_img, "{$pathToThumbs}");
        if ($info['extension'] == 'bmp')
            imagewbmp($tmp_img, "{$pathToThumbs}");
    }
}

function UploadImages($FILES, $attr, $dir){
    $target_dir = $dir;
    echo $target_dir;
    $target_file = $target_dir . basename($FILES["$attr"]["name"]);
    $uploadOk = 1;
    $errorMessage = "";
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    $fileName = rand(1, 100000000) . randLetter().".".$imageFileType;
    // Check if image file is a actual image or fake image
    $check = getimagesize($FILES["$attr"]["tmp_name"]);
    echo "Size chk-".$check;
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $errorMessage .= "File is not an image.<br />";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($FILES["$attr"]["size"] > 20971520) {
        $errorMessage .= "Sorry, your file is too large.<br />";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        //$errorMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //$errorMessage .= "Sorry, your image file was not uploaded.<br />";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($FILES["$attr"]["tmp_name"], $target_dir.$fileName)) {
            createThumbs($target_dir.$fileName, $target_dir."thumbs/".$fileName, 400);
//            if($FILES["$attr"]["size"] > 2097152){
//                createThumbs($target_dir.$fileName, $target_dir.$fileName, 1024);
//            }
        } else {
             $errorMessage .= "Sorry, there was an error uploading your file.".$FILES["$attr"]["tmp_name"]. $target_dir.$fileName;
        }
    }
    
     if (!empty($errorMessage)) {
        $_SESSION["er"] = $errorMessage;
        $fileName = "";
     }else{
          $_SESSION["su"] = "uploaded";
     }
     
    return $fileName;
}

//File Upload

function UploadFiles($FILES, $attr, $dir, $index = 0){
    $target_dir = $dir;
    $target_file = basename($FILES["$attr"]["name"]);//[$index]
    $uploadOk = 1;
    $errorMessage = "";
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    $fileName = (!empty($imageFileType)) ? rand(1, 100000000) . randLetter().".".$imageFileType : "";
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "tiff" &&  $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "ods" && $imageFileType != "xlsx" && $imageFileType != "zip" && $imageFileType != "rar") {
        //$errorMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errorMessage .= "File not uploaded, check File Format.- {$target_dir}{$fileName}<br />";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($FILES["$attr"]["tmp_name"], $target_dir.$fileName)) {
            createThumbs($target_dir.$fileName, $target_dir."thumbs/".$fileName, 500);
        } else {
             $errorMessage .= "Sorry, there was an error uploading your file. - {$target_dir}{$fileName}";
        }
    }
    
     if (!empty($errorMessage)) {
        $_SESSION["er"] = $errorMessage;
        $fileName = "";
     }
     
    return $fileName;
}

//Get Image Ext wise Icon
function getThumbnail($ext) {
    $data = "";
    switch (strtolower($ext)) {
        case "jpg" :
            $data = "jpeg-icon.png";
            break;
        case "jpeg" :
            $data = "jpeg-icon.png";
            break;
        case "png" :
            $data = "jpeg-icon.png";
            break;
        case "gif" :
            $data = "jpeg-icon.png";
            break;
        case "bmp" :
            $data = "jpeg-icon.png";
            break;
        case "pdf" :
            $data = "pdf.png";
            break;
        case "doc" :
            $data = "doc.png";
            break;
        case "docx" :
            $data = "doc.png";
            break;
        case "xls" :
            $data = "xls.png";
            break;
        case "ods" :
            $data = "ods.png";
            break;
        case "xlsx" :
            $data = "xlsx.png";
            break;
        case "zip" :
            $data = "zip.png";
            break;
        case "rar" :
            $data = "rar.png";
            break;
        default :
            $data = (!empty($ext)) ? "jpeg-icon.png" : "";
            break;
    }
    return $data;
}

//Print Session Message on Page Top
function getSessionMsg() {
    $data = ""; 
    if (!empty($_SESSION['er'])) {
        $data .= "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-remove pr10'></i>{$_SESSION['er']}</div>";
        unset($_SESSION['er']);
    }if (!empty($_SESSION['su'])) {
        $data .= "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-check pr10'></i>{$_SESSION['su']}</div>";
        unset($_SESSION['su']);
    }if (!empty($_SESSION['note'])) {
        $data .= "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning pr10'></i>{$_SESSION['note']}</div>";
        unset($_SESSION['note']);
    }
    return $data;
}

//On page view hit counter
function initCounter() {

    $ip = $_SERVER['REMOTE_ADDR']; //get visitor ip
    $location = $_SERVER['PHP_SELF']; //get server file path
    $sid = session_id();
    $qry_1 = "INSERT INTO counter(session_id, ip, location)VALUES('$sid', '$ip', '$location') ON DUPLICATE KEY UPDATE location='$location' ";
    //create log in database table 'counter'
    $create_log = mysql_query($qry_1);
}

//Get Hit counter SUM value
function getCounter() {

    $get_res = mysql_query("SELECT session_id FROM counter");

    $res = mysql_num_rows($get_res);

    return $res;
}

//Update User Activity Time
function hitUserActivity() {
    mysql_query("UPDATE `" . PREFIX . "_user_info_tb` SET `user_activity` = NOW(), `user_logout` = '' WHERE `user_id` = " . USERID);
}

//Get User Last Activity Time
function getUserActivity() {
    $result = mysql_query("SELECT TIME_FORMAT(TIMEDIFF(time(now()), `user_activity`),'%H:%I') AS diff FROM `" . PREFIX . "_user_info_tb` WHERE `user_id` = " . USERID . " LIMIT 0,1");
    $rw = mysql_fetch_array($result);
    return $rw["diff"];
}

//Update User Logout Time
function setUserLogoutTime() {
    mysql_query("UPDATE `" . PREFIX . "_user_info_tb` SET `user_logout` = NOW() WHERE `user_id` = " . USERID);
}

//Get Login System IP
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

//Check Login Username And Password
function doLogin($POST) {
    $userName = strip_tags($_POST["username"]);
    $passWord = strip_tags($_POST["password"]);
    //$qry_1 = "select * from `user_info_tb` where `user_status` = 1 and `user_name`='{$userName}' and `user_password`='" . encode($passWord) . "'"; // and `user_password`='" . encode($passWord) . "'
    $qry_1 = "select * from `user_tb` where `user_email`='{$userName}' and `user_password`='" . encode($passWord) . "'"; // and `user_password`='" . encode($passWord) . "'
   // echo $qry_1;
    $result = mysql_query($qry_1);
    
    $_SESSION["logstatus"] = (mysql_num_rows($result) == 1)?"1":"2";
    if (mysql_num_rows($result) == 1) {
        $_SESSION["loginTime"] = date("d-m-Y h:i:sa");
        //$login_status = "Success";
        
        $rw = mysql_fetch_array($result);
        //if($rw["user_logout"] != '0000-00-00 00:00:00'){
        $_SESSION['LBT_USER'] = $rw;
        unset($_SESSION['er']);
        mysql_query("UPDATE `user_log_tb` SET `user_last_login` = NOW(), `user_logout` = '' WHERE `user_id` = {$rw["user_id"]}");
        $_SESSION['su'] = "Welcome! <strong>" . $rw["user_full_name"] . "</strong> to Admin Dashboard.";
        redirect(HostRoot."dashboard");
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
        $_SESSION['er'] = "Invalid Username/Password!...";
        redirect(HostRoot."login");
    }
    
}

//Get Authentication Name
function getAuthName($ID) {
    $authName = array("", "Administrator", "Head of Department", "Reader", "Staff Members(Clinical Service)", "NBS Centers", "Other organizations");
    return $authName[$ID];
}

//Get Authentication List View
function getAuthSelectList($status) {
    $data = ($status == 1) ? "<option value='1' selected>" . getAuthName(1) . "</option>" : "<option value='1'>" . getAuthName(1) . "</option>";
    $data .= ($status == 2) ? "<option value='2' selected>" . getAuthName(2) . "</option>" : "<option value='2'>" . getAuthName(2) . "</option>";
    $data .= ($status == 3) ? "<option value='3' selected>" . getAuthName(3) . "</option>" : "<option value='3'>" . getAuthName(3) . "</option>";
    $data .= ($status == 4) ? "<option value='4' selected>" . getAuthName(4) . "</option>" : "<option value='4'>" . getAuthName(4) . "</option>";
    $data .= ($status == 5) ? "<option value='5' selected>" . getAuthName(5) . "</option>" : "<option value='5'>" . getAuthName(5) . "</option>";
    $data .= ($status == 6) ? "<option value='6' selected>" . getAuthName(6) . "</option>" : "<option value='6'>" . getAuthName(6) . "</option>";
   
    return $data;
}

function getAuthSelection($status){
    $data = ($status == 1)? "<li data-val='1' id='role' tabindex='1' role='option' class='jelect-option jelect-option_state_active'>" . getAuthName(1) . "</li>":"<li data-val='1' tabindex='1' role='option' class='jelect-option'>" . getAuthName(1) . "</li>";
    $data .= ($status == 2)?"<li data-val='2' id='role' tabindex='2' role='option' class='jelect-option jelect-option_state_active'>" . getAuthName(2) . "</li>":"<li data-val='2' tabindex='2' role='option' class='jelect-option'>" . getAuthName(2) . "</li>";

    return $data;
}


function getTranStatusInfo($ID){
    $data = array("Failure", "Pending", "Paid");
    return $data[$ID];
}

function getPermissionNameById($ID){
    $perId = $ID-1;
    $data = array("View","Edit","Restricted");
    return $data[$perId];
}

//Get Status Info 
function getStatusInfo($ID) {
    $data = array("Deleted", "<span style='color:green'>Active</span>", "<span style='color:red'>Deactivated</span>");
    return $data[$ID];
}

function getApprovalStatus($ID){
    $data = array("Yes", "No");
    return $data[$ID];
}




function getCategorySelectList($id){
    $data = "";
    //$qry_1 = (!empty($id))? "AND `taluk_id` = '{$id}'" : "";
    $qry = (!empty($id))?"SELECT * FROM `category_tb` WHERE `category_status` = '1' ORDER BY `category_id` = '$id'":"SELECT * FROM `category_tb` WHERE `category_status` = '1'";
    $result = mysql_query($qry);
    while($rw = mysql_fetch_assoc($result)){
        $category_list = ($rw["category_id"] != $id )? "<option value='{$rw["category_id"]}'>{$rw["category_name"]}</option>":"<option value='{$rw["category_id"]}' selected>{$rw["category_name"]}</option>";
        $data .="
            {$category_list}
        ";
    }
    return $data;
}

function getRoleSelectList($roleID){
    $data = "";
    $qry_1 = "SELECT `role_id`, `role_type` FROM `user_role_tb` WHERE `role_status` = '1'";
    $result = mysql_query($qry_1);
    while ($rw = mysql_fetch_assoc($result)){
        $roleLists = ($rw["role_id"] != $roleID)? "<option value='{$rw["role_id"]}'>{$rw["role_type"]}</option>":"<option value='{$rw["role_id"]}' selected>{$rw["role_type"]}</option>";
        $data .="{$roleLists}";
    }
    return $data;
}

function getAuthNameByID($authId){
    
    $data = "";
    $ID = decode($authId);
    $qry_1 = "SELECT `user_name` FROM `user_tb` WHERE `user_id` = '$ID'";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_array($result);
    $data = "{$rw["user_name"]}";
    return $data;
}

function getRoleNameByAuthID($authId){
    
    $data = "";
    $ID = decode($authId);
    $qry_1 = "SELECT `role_id` FROM `user_tb` WHERE `user_id` = '$ID'";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_array($result);
    $roleType = getRoleNameByID(encode($rw["role_id"]));
    $data = "$roleType";
    return $data;
}

function getRoleNameByID($authId){
    
    $data = "";
    $ID = decode($authId);
    $qry_1 = "SELECT `role_type` FROM `user_role_tb` WHERE `role_id` = '$ID'";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_array($result);
    $data = "{$rw["role_type"]}";
    return $data;
}

function getOrgSelection(){
    $data = "";
    $qry_1 = "SELECT `organization_name` FROM `requisition_tb`";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
        $data .= "<li data-val='{$rw["organization_name"]}' id='role' tabindex='' role='option' class='jelect-option jelect-option_state_active'>{$rw["organization_name"]}</li>";
    }
    return $data;
}
function getHospitalSelectList(){
    $data = "";
    $qry_1 = "Select hosp_id,hosp_name from tbl_hospital";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
        $data .= "<li data-val='{$rw["hosp_id"]}' id='role' tabindex='' role='option' class='jelect-option jelect-option_state_active'>{$rw["hosp_name"]}</li>";
    }
    return $data;
}
function HospitalSelectOption($hospital_id){
    $data = "";
    $qry_1 = "Select `hosp_id`, `hosp_name` from tbl_hospital";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
//        $data .= "<option value='{$rw["hosp_id"]}' id='' class=''>{$rw["hosp_name"]}</option>";
        $data .= ($hospital_id == $rw["hosp_id"])? "<option value='{$rw["hosp_id"]}' id='' selected class=''>{$rw["hosp_name"]}</option>":"<option value='{$rw["hosp_id"]}' id='' class=''>{$rw["hosp_name"]}</option>";
    }
    return $data;
}
function getStateSelectList($stateId){
    $data = "";
    $qry_1 = "SELECT state_id,statename as country FROM `tbl_states`";
    $result = mysql_query($qry_1);
    while ($row = mysql_fetch_array($result)){
//        $data .= "<option value='{$row['state_id']}' >{$row['country']}</option>";
        $data .= ($stateId == $row["state_id"])?"<option value='{$row['state_id']}' selected >{$row['country']}</option>":"<option value='{$row['state_id']}' >{$row['country']}</option>";
    }
    return $data;
}
function getImpresionSelectList($impId){
    $data = "";
    $qry_1 = "SELECT imp_id,imp_name FROM `tbl_impression`";
    $result = mysql_query($qry_1);
    while ($row = mysql_fetch_array($result)){
        $data .= ($impId == $row['imp_id'])?"<option selected='' value='{$row['imp_id']}'>{$row['imp_name']}</option>":"<option value='{$row['imp_id']}' >{$row['imp_name']}</option>";
    }
    return $data;
}

function getImpressionByID($impresnid){
    $qry_1 = "SELECT `imp_name` FROM `tbl_impression` WHERE `imp_id` = '$impresnid' ";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_assoc($result);
    $data = "{$rw["imp_name"]}";
    return $data;
}

function getDistrictSelectList($dist_id){
    //echo "<script>alert($dist_id)</script>";
    $data = "";
    $qry_1 = "SELECT `dist_id`, `state_id`, `distname` FROM `tbl_districts`";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
        $data .= ($dist_id == $rw["dist_id"])?"<option value='{$rw['dist_id']}'  selected  >{$rw['distname']}</option>":"<option value='{$rw['dist_id']}' onchange='getCity({$rw['dist_id']},this.value)' >{$rw['distname']}</option>";  
        
    }
    return $data;
    
}

function getCitySelectList($city_id){
    //echo "<script>alert($city_id)</script>";
    $data = "";
    $qry_1 = "SELECT `dist_id`, `city_id`, `cityname` FROM `tbl_cities`";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
        $data .= ($city_id == $rw["city_id"])?"<option value='{$rw['city_id']}' selected >{$rw['cityname']}</option>":"<option value='{$rw['city_id']}' >{$rw['cityname']}</option>";  
        
    }
    return $data;
    
}
//AIISH Select List
function getAIISHSelectList($aiishcenter){
    //echo "<script>alert($city_id)</script>";
    $data = "";
    $qry_1 = "SELECT `aiish_id`, `aiish_name` FROM `tbl_aiish` ";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
        $data .= ($aiishcenter == $rw["aiish_id"])?"<option value='{$rw['aiish_id']}' selected >{$rw['aiish_name']}</option>":"<option value='{$rw['aiish_id']}' >{$rw['aiish_name']}</option>";  
        
    }
    return $data;
    
}

function getImpressionStatus($pat_id, $abshrr){
    $data = "";
    //echo "Patient id:$pat_id";
//    $patientDetail = getBabyDetByPatientId($pat_id);
    
    //echo "Elderly: Pregnancy: {$patientDetail["elderly_pregnanacy"]}";
    $data = "
        ".getimpression($pat_id, $abshrr)."
    ";
    echo $data;
}

function getBabyDetByPatientId($patient){
    $data = "";
    $qry_1 = "SELECT pat.*, hrr.*, prenatal.*, natal.*, postnatal.*, other.*, screen1.*, screen2.*, boa.*, primref.*, acanal.*, aabr.* FROM `patient` pat, `tbl_hrr` hrr, `pre_natal_hrr` prenatal, `natal_hrr` natal, `post_natal_hrrr` postnatal, `other_hrr` other, `screening_test_1` screen1, `screening_test_2` screen2, `behavioral_obs_audiometry` boa, `primitive_reflex` primref, `acoustic_analysis` acanal, `aabr_screen` aabr WHERE pat.`Patient_Id` = hrr.`Patient_Id` AND pat.`Patient_Id` = prenatal.`Patient_Id` AND pat.`Patient_Id` = natal.`Patient_Id` AND pat.`Patient_Id` = postnatal.`Patient_Id` AND pat.`Patient_Id` = other.`Patient_Id` AND pat.`Patient_Id` = screen1.`Patient_Id` AND pat.`Patient_Id` = screen2.`Patient_Id` AND pat.`Patient_Id` = boa.`Patient_Id` AND pat.`Patient_Id` = primref.`Patient_Id` AND pat.`Patient_Id` = acanal.`Patient_Id` AND pat.`Patient_Id` = aabr.`Patient_Id` AND pat.`Patient_Id` = '$patient'";
    //echo $qry_1;
    $result = mysql_query($qry_1);
    $data = mysql_fetch_assoc($result);
    return $data;
}
function getBabyDetByAbsentHrr($patient){
    $data = "";
    $qry_1 = "SELECT pat.`Patient_Id`, hrr.* ,screen1.*, screen2.*, boa.*, acanal.*, primref.*, aabr.* FROM `patient` pat, `tbl_hrr` hrr, `screening_test_1` screen1, `screening_test_2` screen2, `behavioral_obs_audiometry` boa, `acoustic_analysis` acanal, `primitive_reflex` primref, `aabr_screen` aabr WHERE pat.`Patient_Id` = hrr.`Patient_Id` AND pat.`Patient_Id` = screen1.`Patient_Id` AND pat.`Patient_Id` = screen2.`Patient_Id` AND pat.`Patient_Id` = boa.`Patient_Id` AND pat.`Patient_Id` = acanal.`Patient_Id` AND pat.`Patient_Id` = primref.`Patient_Id` AND pat.`Patient_Id` = aabr.`Patient_Id` AND pat.`Patient_Id` = '$patient'";
   //echo $qry_1;
    $result = mysql_query($qry_1);
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getImprsnNameByID($impId){
    $data = "";
    $qry_1 = "SELECT `imp_name` FROM `tbl_impression` WHERE `imp_id` = '$impId' ";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_assoc($result);
    $data = "{$rw["imp_name"]}";
    return $data;
}

function SelectImpresion($pat,$imp_id){
    if($imp_id == 1){
        $bg = "#3fb618";
    }
    elseif($imp_id == 2){
       $bg = "#ff0039"; 
    }else{
        $bg = "#ff7518";
    }
    $data = "<select class='form-control' name='impresn' onchange='changeImpression(this,$pat)' style='background:$bg;margin-top:20px'>
                ".getImpresionSelectList($imp_id)."
            </select>";
    return $data;
    
}


function getUserRoleByID($ID){
    $qry_1 = "SELECT `role_id`, `role_type`, `role_created_on`, `role_updated_on`, `role_created_by`, `role_updated_by` FROM `user_role_tb` WHERE `role_id` = '$ID'";
    $result = mysql_query($qry_1);
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getUserInfoByID($ID){
    $qry_1 = "SELECT `user_id`, `user_name`, `role_id`, `user_email`, `user_password`, `aiish_id`, `state_id`, `district_id`, `user_status`, `user_created_on`, `user_updated_on`, `user_created_by`, `user_updated_by`, `created_ip` FROM `user_tb` WHERE `user_id` = '$ID'";
    $result = mysql_query($qry_1);
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getStateListsByID($ID){
    $qry_1 = "SELECT `state_id`, `statename`, `state_created_by`, `state_created_on`, `state_updated_by`, `state_updated_on` FROM `tbl_states` WHERE `state_id` = '$ID'";
    $result = mysql_query($qry_1);
    //echo $qry_1;
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getDistrictListsByID($ID){
    $qry_1 = "SELECT `dist_id`, `state_id`, `distname`, `dist_status`, `dist_created_on`, `dist_created_by`, `dist_updated_on`, `dist_updated_by` FROM `tbl_districts` WHERE `dist_id` = '$ID'";
    $result = mysql_query($qry_1);
    echo $qry_1;
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getTalukListsByID($ID){
    $qry_1 = "SELECT `city_id`, `cityname`, `dist_id`, `state_id`, `city_status`, `city_created_on`, `city_created_by`, `city_updated_on`, `city_updated_by` FROM `tbl_cities` WHERE `city_id` = '$ID'";
    $result = mysql_query($qry_1);
    //echo $qry_1;
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getStateNameByStateId($stateId){
    $qry_1 = "SELECT `statename`, `state_id` FROM `tbl_states` WHERE `state_id` = '$stateId'";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_array($result);
    return $rw["statename"];
}

function getDistNameByDistId($disId){
    $qry_1 = "SELECT `distname`, `dist_id` FROM `tbl_districts` WHERE `dist_id` = '$disId'";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_array($result);
    return $rw["distname"];
}
function getAIISHCenterNameByID($aiishID){
    $qry_1 = "SELECT `aiish_name`, `aiish_id` FROM `tbl_aiish` WHERE `aiish_id` = '$aiishID'";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_array($result);
    return $rw["aiish_name"];
}

function getNBSListsByID($nbsID){
    $qry_1 = "SELECT `nbs_id`, `nbs_name`, `aiish_id`, `nbs_state_id`, `nbs_district_id`, `nbs_status`, `nbs_created_by`, `nbs_created_on`, `nbs_updated_by`, `nbs_updated_on` FROM `tbl_nbs` WHERE `nbs_id` = '$nbsID'";
    $result = mysql_query($qry_1);
    $data = mysql_fetch_array($result);
    return $data;
}

function getAIISHListsByID($aiishID){
    $qry_1 = "SELECT `aiish_id`, `aiish_name`, `aiish_state_id`, `aiish_district_id`, `aiish_status`, `aiish_created_by`, `aiish_created_on`, `aiish_updated_by`, `aiish_updated_on` FROM `tbl_aiish` WHERE `aiish_id` = '$aiishID'";
    //echo $qry_1;
    $result = mysql_query($qry_1);
    $data = mysql_fetch_array($result);
    return $data;
}
function getOSCListsByID($OSCID){
    $qry_1 = "SELECT `osc_id`, `osc_names`, `aiish_id`, `osc_state_id`, `osc_district_id`, `osc_status`, `osc_created_by`, `osc_created_on`, `osc_updated_by`, `osc_updated_on` FROM `tbl_osc_centers` WHERE `osc_id` = '$OSCID'";
   // echo $qry_1;
    $result = mysql_query($qry_1);
    $data = mysql_fetch_array($result);
    return $data;
}
function getHospitalByID($HospID){
    $qry_1 = "SELECT `hosp_id`, `hosp_name`, `hosp_abbr`, `aiish_id`, `hosp_state_id`, `hosp_dist_id`, `hosp_status`, `hosp_created_by`, `hosp_created_on`, `hosp_updated_by`, `hosp_updated_on` FROM `tbl_hospital` WHERE `hosp_id` = '$HospID'";
   // echo $qry_1;
    $result = mysql_query($qry_1);
    $data = mysql_fetch_array($result);
    return $data;
}
