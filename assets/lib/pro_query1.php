<?php 

/////////////////////////////////////////////////////////////
//// User Page Start
///////////////////////////////////////////////////////////

function ToDoUserForm($POST, $GET, $FILES){
    $formData = $qry_1 = "";
    $status = FALSE;
    
    if(isset($POST["SubmitUser"])){
//        $usr_id = strip_tags($POST["user_id"]);
        $usr_name = strip_tags($POST["name"]);
        $usr_email = strip_tags($POST["email"]);
//        $usr_password = hash('sha256', $POST["password"]);
        $user_role = strip_tags($POST["user_role"]);
        //$usr_full_name = strip_tags($POST["full_name"]);
        //$qry_1 =  "CALL toDoUserAction('{$usr_id}', '{$usr_name}', '{$usr_email}', '{$usr_password}', '{$user_role}')";
        //mysql_query($qry_1);
        
        $status = TRUE;
    }else if(isset($GET["registration"]) && is_numeric(decode($GET["registration"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $usr_id = decode($GET["registration"]);
        $qry_1 = "CALL updateUserStatus('{$usr_id}','{$st}')";
        //mysql_query($qry_1);
        echo $qry_1;
        $status = TRUE;
    }else if( isset($GET["registration"]) && is_numeric(decode($GET["registration"])) && !isset($GET["st"]) ){
        $id =  decode($GET["registration"]);
        //echo "<script>alert('$id')</script>";
        $formData = getUserByID($id);
        $status = FALSE;
    }    
    
    
    if($status){
        mysql_query($qry_1);
        if(mysql_errno()){ $_SESSION["er"] = "Unexpected Error found while processing this task....".$qry_1; }
        else{ $_SESSION["su"] = "Task Completed ...."; 
        
 ?>
    <script>
        alert("Saved");
        $(function(){
            showToast.show('Saved Successfully',2000)
        });
    </script>
//<?php
        }
        redirect(HostRoot."registration");
    }
    return $formData;
}

function SubmitUser($POST, $GET){
    $formData = "";
    $status = FALSE;
    
    if(isset($POST["submitUsrInfo"])){
        $usrName = strip_tags($POST["username"]);
        $usrRole = strip_tags($POST["user_role"]);
        $usrEmail = strip_tags($POST["useremail"]);
        $usrPwd = strip_tags($POST["userpassword"]);
//        $encPwd = hash('sha256', $usrPwd);
        $encPwd = encode($usrPwd);
        $usrId = strip_tags($POST["user_id"]);
        
        if(empty($usrId)){
            $qry_1 = "INSERT INTO `user_tb` (`user_name`, `role_id`, `user_email`, `user_password`, `user_created_on`, `user_created_by`) VALUES('$usrName', '$usrRole', '$usrEmail', '$encPwd', NOW(), '".USERAUTH."')";
        }
        else{
            $qry_1 = "UPDATE `user_tb` SET `user_name` = '$usrName', `role_id` = '$usrRole', `user_email` = '$usrEmail', `user_password` = '$encPwd', `user_updated_on` = NOW(), `user_updated_by` = '".USERAUTH."' WHERE `user_id` = '$usrId' ";
        }
        //mysql_query($qry_1);
        
        $status = TRUE;
    }else if(isset($GET["add-user"]) && is_numeric(decode($GET["add-user"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $user_id = decode($GET["add-user"]);
        
        $qry_1 = "UPDATE `user_tb` SET `user_status` = '$st' WHERE `user_id` = '$user_id' ";
        mysql_query($qry_1);
        $status = TRUE;
    }else if( isset($GET["add-user"]) && is_numeric(decode($GET["add-user"])) && !isset($GET["st"]) ){
        $id =  decode($GET["add-user"]);
        $formData = getUserInfoByID($id);
        $status = FALSE;
    }    
    
    
    if($status){
        if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $_SESSION["su"] = "Task Completed ....".$qry_1;       
        }
        redirect(HostRoot."add-user");
    }
    
    return $formData;
    
}


function getUserList(){
    $data = "";
    
    $qry_user = "SELECT `user_id`, `user_name`, `role_id`, `user_email`, `user_password`, `user_status`, `user_created_on`, `user_updated_on`, `user_created_by`, `user_updated_by` FROM `user_tb`";
    $result_user = mysql_query($qry_user);
    
    while($rw_user = mysql_fetch_array($result_user)){
        
        $ID = encode($rw_user["user_id"]);
        $roleID = encode($rw_user["role_id"]);
        $roleCreatedBy = !empty($rw_user["user_created_by"])?"".getAuthNameByID(encode($rw_user["user_created_by"]))."(". getRoleNameByAuthID(encode($rw_user["user_created_by"])).")":"";
        $roleUpdateBy = !empty($rw_user["user_updated_by"])?"".getAuthNameByID(encode($rw_user["user_updated_by"]))."(". getRoleNameByAuthID(encode($rw_user["user_updated_by"])).")":"";
        
        $st = ($rw_user['user_status'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");        
        
        $data .= "
            <tr>
                <td>{$rw_user["user_name"]}</td>
                <td>". getRoleNameByID($roleID)."</td>
                <td>{$rw_user["user_email"]}</td>
                <td>{$rw_user["user_created_on"]}</td>    
                <td>$roleCreatedBy</td>
                <td>{$rw_user["user_updated_on"]}</td>
                <td>$roleUpdateBy</td>
                <td>".getStatusInfo($rw_user["user_status"])."</td>
                <td><a href='".HostRoot."add-user/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                    <a href='".HostRoot."add-user/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a></td>
            </tr>

        ";
    }
    return $data;
}

function getUserByID($ID){
    //echo "<script>alert('$ID')</script>";
    $_qry = "SELECT * FROM `users` WHERE `userId` = '{$ID}'";
   // echo "<script>alert('$_qry')</script>";
    $result = mysql_query($_qry);
    $data = mysql_fetch_assoc($result);
    return $data;
}


function getUserCount(){
    $qry_1 = "SELECT 
                (select count(*) from user_info_tb where user_status = 1) as ActiveUser,
                (select count(*) from user_info_tb WHERE user_status <> 1) as InactiveUser,
                (select count(*) from user_info_tb) as TotalUser";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_assoc($result);
    return $rw;
}

//Category Form

function ToDoCategoryForm($POST, $GET, $FILES){
    $formData = $qry_1 = "";
    $status = FALSE;
    
    if(isset($POST["SubmitCategory"])){
        $cat_id = strip_tags($POST["cat_id"]);
        $cat_name = strip_tags($POST["cat_name"]);

        $qry_1 =  "CALL ToDoCategoryForm('{$cat_id}', '{$cat_name}', '".$_SESSION['LBT_USER']["user_id"]."')";
        //mysql_query($qry_1);
        
        $status = TRUE;
    }else if(isset($GET["category"]) && is_numeric(decode($GET["category"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $cat_id = decode($GET["category"]);
        $qry_1 = "CALL updateCategoryStatus('{$cat_id}','{$st}')";
        //mysql_query($qry_1);
        $status = TRUE;
    }else if( isset($GET["category"]) && is_numeric(decode($GET["category"])) && !isset($GET["st"]) ){
        $id =  decode($GET["category"]);
//        echo "<script>alert('$id')</script>";
        $formData = getCategoryByID($id);
        $status = FALSE;
    }    
    
    
    if($status){
        mysql_query($qry_1);
        if(mysql_errno()){ $_SESSION["er"] = "Unexpected Error found while processing this task....".$qry_1; }
        else{ $_SESSION["su"] = "Task Completed ....".$qry_1; 
 ?>
    <script>
        alert("Saved");
        $(function(){
            showToast.show('Saved Successfully',2000)
        });
    </script>
<?php
        }
        redirect(HostRoot."category");
    }
    return $formData;
}

function getCategoryList(){
    $data = ""; $index = 1;
    $result = mysql_query("SELECT * FROM `category_tb`");    
    while($value = mysql_fetch_array($result)){
        $ID = encode($value["category_id"]);
        $st = ($value['category_status'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");
        $data .= ""
                . "<tr>
                        <td>$index</td>
                        <td>{$value["category_name"]}</td>
                        <td>".getStatusInfo($value["category_status"])."</td>
                        <td>
                            <a href='".HostRoot."category/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                            <a href='".HostRoot."category/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a>
                        </td>
                    </tr>";
        $index++;
    }
    return $data;
}

function getCategoryByID($ID){
    $_qry = "SELECT * FROM `category_tb` WHERE `category_id` = '{$ID}'";
    $result = mysql_query($_qry);
    $data = mysql_fetch_assoc($result);
    return $data;
}


function getCategriesCount(){
    $qry_1 = "SELECT 
                (select count(*) from category_tb where category_status = 1) as ActiveCategory,
                (select count(*) from category_tb WHERE category_status <> 1) as InactiveCategory,
                (select count(*) from category_tb) as TotalCategory";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_assoc($result);
    return $rw;
}


function ToDoSubcategoryForm($POST, $GET, $FILES) {
    $formData = $qry_1 = "";
    $status = FALSE;

    if (isset($POST["SubmitSubcategory"])) {
        $subcat_id = strip_tags($POST["subcat_id"]);
        $subcat_name = strip_tags($POST["subcat_name"]);
        $cat_id = strip_tags($POST["cat_name"]);
        
        $qry_1 = "CALL toDoSubcatAction('{$subcat_id}', '{$subcat_name}', '{$cat_id}', '" . $_SESSION['LBT_USER']["user_id"] . "')";
        //mysql_query($qry_1);

        $status = TRUE;
    } else if (isset($GET["subcategory"]) && is_numeric(decode($GET["subcategory"])) && isset($GET["st"]) && is_numeric($GET["st"])) {
        $st = strip_tags($GET["st"]);
        $cat_id = decode($GET["subcategory"]);
        $qry_1 = "CALL updateSubcatStatus('{$cat_id}','{$st}')";
        //mysql_query($qry_1);
        $status = TRUE;
    } else if (isset($GET["subcategory"]) && is_numeric(decode($GET["subcategory"])) && !isset($GET["st"])) {
        $id = decode($GET["subcategory"]);
        $formData = getSubcategoryByID($id);
        $status = FALSE;
    }


    if ($status) {
        mysql_query($qry_1);
        if (mysql_errno()) {
            $_SESSION["er"] = "Unexpected Error found while processing this task...." . $qry_1;
        } else {
            $_SESSION["su"] = "Task Completed ....";
        }
        redirect(HostRoot . "subcategory");
    }
    return $formData;
}

function getSubcategoryList() {
    $data = "";
    $index = 1;
    $result = mysql_query("SELECT * FROM `sub_category_tb`");
    while ($value = mysql_fetch_array($result)) {
        $ID = encode($value["subcategory_id"]);
        $st = ($value['subcategory_status'] == 1) ? array("st" => "2", "name" => "Inactive") : array("st" => "1", "name" => "Active");
        $data .= ""
                . "<tr>
                        <td>$index</td>
                        <td>{$value["subcategory_name"]}</td>
                        <td>{$value["category_name"]}</td>
                        <td>" . getStatusInfo($value["subcategory_status"]) . "</td>
                        <td>
                            <a href='" . HostRoot . "subcategory/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                            <a href='" . HostRoot . "subcategory/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a>
                        </td>
                    </tr>";
        $index++;
    }
    return $data;
}

function getSubcategoryByID($ID) {
    $_qry = "SELECT * FROM `subcategory_tb` WHERE `subcategory_id` = '{$ID}'";
    $result = mysql_query($_qry);
    $data = mysql_fetch_assoc($result);
    return $data;
}

function getSubcategoryCount() {
    $qry_1 = "SELECT 
                (select count(*) from subcategory_tb where subcategory_status = 1) as ActiveSubcategories,
                (select count(*) from subcategory_tb WHERE subcategory_status <> 1) as InactiveSubcategories,
                (select count(*) from subcategory_tb) as TotalSubcategories";
    $result = mysql_query($qry_1);
    $rw = mysql_fetch_assoc($result);
    return $rw;
}


////////////////////////////////////
//Requisition form
//////////////////////////

function ToDoRequisitionForm($POST, $GET, $FILES) {
    $formData = $qry_1 = "";
    $status = FALSE;

    if (isset($POST["SubmitRequisitn"])) {
//        $usr_id = strip_tags($POST["user_id"]);
        $org_name = strip_tags($POST["org_name"]);
        $contact_persn = strip_tags($POST["contact_persn"]);
        $contact_no = strip_tags($POST["contact_no"]);
        $emailid = strip_tags($POST["emailid"]);
        $address = strip_tags($POST["address"]);
        $fax = strip_tags($POST["fax"]);
        $pay_atten = strip_tags($POST["pay_atten"]);
        $screening_prog = strip_tags($POST["screening_prog"]);
        $program_date = convertFromSqlDate(strip_tags($POST["program_date"]));
        $program_time = strip_tags($POST["program_time"]);
        $abt_org = strip_tags($POST["abt_org"]);
        $qry_1 =  "INSERT INTO `requisition_tb` (`organization_name`, `contact_person`, `contact_no`, `emailid`, `address`, `fax`, `paying_attention_for`, `screening_program`, `screening_date`, `screening_time`, `about_organization`) VALUES('$org_name', '$contact_persn', '$contact_no', '$emailid', '$address', '$fax', '$pay_atten', '$screening_prog', '$program_date', '$program_time', '$abt_org')";
        //mysql_query($qry_1);

        $status = TRUE;
    } 


    if ($status) {
        mysql_query($qry_1);
        if (mysql_errno()) {
            $_SESSION["er"] = "Unexpected Error found while processing this task...." . $qry_1;
        } else {
            $_SESSION["su"] = "Task Completed ....";
            ?>
                <script>
                    alert("Saved");
                    $(function(){
                        showToast.show('Saved Successfully',2000)
                    });
                </script>
            //<?php

        }
        redirect(HostRoot . "requisition-form");
    }
    return $formData;
}

function getRequisitionList($org) {
    $data = "";
    $index = 1;
    $seleOrg = !empty($org)? "WHERE `organization_name` = '$org'":"";
    $result = mysql_query("SELECT * FROM `requisition_tb` $seleOrg");
    while ($value = mysql_fetch_array($result)) {
        $ID = encode($value["batch_no"]);
        $st = ($value['approval_status'] == 1) ? array("st" => "2", "name" => "Yes") : array("st" => "1", "name" => "No");
        //$st = ($value['userStatus'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");
       
        $Action =  ($st["st"] == 1)?"<td>
                        <a href='" . HostRoot . "approval/{$ID}/st/{$st["st"]}'><i class='fa fa-close'></i> {$st["name"]}</a>;
                    </td>":"<td>
                        <a href='" . HostRoot . "approval/{$ID}/st/{$st["st"]}'><i class='fa fa-check-circle'></i> {$st["name"]}</a>;
                    </td>";
        $data .= ""
                . "<tr>
                        <td>{$value["batch_no"]}</td>
                        <td>{$value["organization_name"]}</td>
                        <td>{$value["contact_person"]}</td>
                        <td>{$value["contact_no"]}</td>
                        <td>{$value["emailid"]}</td>
                        <td>{$value["fax"]}</td>
                        <td>{$value["paying_attention_for"]}</td>
                        <td>{$value["screening_program"]}</td>
                        <td>{$value["screening_date"]}</td>
                        <td>{$value["screening_time"]}</td>
                        $Action
                    </tr>";
        $index++;
    }
    return $data;
}

function toDoApproval($GET){
    $formData = $qry_1 = "";
    $status = FALSE;
    
    if(isset($GET["approval"]) && is_numeric(decode($GET["approval"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $ap_id = decode($GET["approval"]);
        //$qry_1 = "CALL updateUserStatus('{$usr_id}','{$st}')";
        $qry_1 = "UPDATE `requisition_tb` SET `approval_status` = '$st' WHERE `batch_no` = '$ap_id'";
        //mysql_query($qry_1);
        //echo $qry_1;
        $status = TRUE;
    }   
    
    if($status){
        mysql_query($qry_1);
        if(mysql_errno()){ $_SESSION["er"] = "Unexpected Error found while processing this task....".$qry_1; }
        else{ $_SESSION["su"] = "Task Completed ...."; 
        
 ?>
    <script>
        alert("Saved");
        $(function(){
            showToast.show('Saved Successfully',2000)
        });
    </script>
//<?php
        }
        redirect(HostRoot."approval");
    }
    return $formData;
}

function getScreeningProgramData($POST){
    $screen_program = $POST["screen_program"];
    $_qry = "SELECT * FROM `requisition_tb` WHERE `screening_program` = '{$screen_program}'";
    $result = mysql_query($_qry);
    $data = mysql_fetch_assoc($result);
    return $data;
}

//////////////////////////////////////////////////////////////////////////////////////
//Submit screening services
////////////////////////////////////////////////////////////////////////////////////

function toDoSubmitScreening($POST, $GET, $PID){
    $formdata = "";
    $status = FALSE;
    
    if(isset($POST["submit_screening"])){
//        $babyId = strip_tags($POST["baby_id_num"]);
//        $pocd_no = mysql_real_escape_string(strip_tags($POST["pocd_no"]));
        $babyName = mysql_real_escape_string(strip_tags($POST["babyName"]));
        $birthdate = mysql_real_escape_string(strip_tags($POST["birthdate"]));
        $age = mysql_real_escape_string(strip_tags($POST["age"]));
        $father = mysql_real_escape_string(strip_tags($POST["father"]));
        echo "<script>alert($father)</script>";
//        $mother = mysql_real_escape_string(strip_tags($POST["mother"]));
        $contact_no = mysql_real_escape_string(strip_tags($POST["contact_no"]));
        $state = mysql_real_escape_string(strip_tags($POST["state"]));
        $district = mysql_real_escape_string(strip_tags($POST["district"]));
        echo "<script>alert($district)</script>";
        
//        $email = mysql_real_escape_string(strip_tags($POST["email"]));
//        $gender = mysql_real_escape_string(strip_tags($POST["gender"]));
        
       
        
        
    }
    
}


////////////////////////////

function getNbsList($getCenter){
    $data ="";
    $centername = $getCenter["nbs_refer"];
    $qry_1 = "SELECT `nbs_id`, `nbs_name` FROM `tbl_nbs`";
    $result = mysql_query($qry_1);
    
    
    while($rw = mysql_fetch_array($result)){
        $radioheck = ($centername == $rw["nbs_id"])?"checked=''":"";
        $data .= "
            <!--<div class='col-md-3 col-md-offset-1 form-group '>  
            <input type='checkbox' class='checkbox' hidden='' value='{$rw["nbs_id"]}' id='' name=''>{$rw["nbs_name"]}
            </div>-->
            <label class='radio'><input type='radio' class='radio nbschked' $radioheck onclick = savenbschk({$rw["nbs_id"]}); value='{$rw["nbs_id"]}' id='' name='nbs'>{$rw["nbs_name"]}</label>
        ";
    }
    return $data;
}
function getOSCList($getCenter){
    $data ="";
    $centername = $getCenter["osc_refer"];
    
    $qry_1 = "SELECT `osc_id`, `osc_names` FROM `tbl_osc_centers`";
    $result = mysql_query($qry_1);
    
    while($rw = mysql_fetch_array($result)){
        $radioheck = ($centername == $rw["osc_id"])?"checked=''":"";
        $data .= "
            <label class='radio' ><input type='radio' class='radio oscchecked' $radioheck onclick = saveoscchk(); value='{$rw["osc_id"]}' id='' name='osc'>{$rw["osc_names"]}</label>
        ";
    }
    return $data;
}
function getAIISHList($getCenter){
    $data ="";
    $centername = $getCenter["aiish_refer"];
    
    $qry_1 = "SELECT `aiish_id`, `aiish_name` FROM `tbl_aiish`";
    $result = mysql_query($qry_1);
    
    while($rw = mysql_fetch_array($result)){
        $radioheck = ($centername == $rw["aiish_id"])?"checked=''":"";
        $data .= "
            <label class='radio' ><input type='radio' class='radio aiishchecked' $radioheck onclick = saveaiishchk(); value='{$rw["aiish_id"]}' id='' name='aiish'>{$rw["aiish_name"]}</label>
        ";
    }
    return $data;
}
//function getOSCList(){
//    $data ="";
//    
//    $qry_1 = "SELECT `osc_id`, `osc_names` FROM `tbl_osc_centers`";
//    $result = mysql_query($qry_1);
//    
//    while($rw = mysql_fetch_array($result)){
//        $data .= "
//          <!--<div class='col-md-3 col-md-offset-1 form-group '>  
//                <input type='checkbox' class='checkbox' value='{$rw["osc_id"]}' id='' name=''>{$rw["osc_name"]}
//            </div> -->
//            <label><input type='checkbox' class='checkbox' value='{$rw["osc_id"]}' id='' name=''>{$rw["osc_name"]}</label>
//        ";
//    }
//    return $data;
//}

function getScreeningList(){
    $data = "";
    $count = 1;
//    $sql_1 = "SELECT pat.*, prenatal.*, natal.*, postnatal.*, other.*, screen1.*, screen2.*, boa.*, primitive.*, aabr.*, acanalys.* FROM `patient` pat, `pre_natal_hrr` prenatal, `natal_hrr` natal, `post_natal_hrrr` postnatal, `other_hrr` other, `screening_test_1` screen1, `screening_test_2` screen2, `behavioral_obs_audiometry` boa, `primitive_reflex` primitive, `aabr_screen` aabr, `acoustic_analysis` acanalys WHERE pat.`Patient_Id` = prenatal.`Patient_Id` AND pat.`Patient_Id` = natal.`Patient_Id` AND pat.`Patient_Id` = postnatal.`Patient_Id` AND pat.`Patient_Id` = other.`Patient_Id` AND pat.`Patient_Id` = screen1.`Patient_Id` AND pat.`Patient_Id` = screen2.`Patient_Id` AND pat.`Patient_Id` = boa.`Patient_Id` AND pat.`Patient_Id` = primitive.`Patient_Id` AND pat.`Patient_Id` = aabr.`Patient_Id` AND pat.`Patient_Id` = acanalys.`Patient_Id`";
    $sql_1 = "SELECT `Hospital_Name`, `Delivery_type_Name`, `Patient_Id`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Present_address`, `Permanent_address`, `Phone_number`, `Email_id`, `user_name`, `test_impression`, `impresn_remmark`, `patient_status` FROM `patient`";
    $result = mysql_query($sql_1); 
    while($rw = mysql_fetch_array($result)){
        $status_id = ($rw["patient_status"] == 1)? 2 : 1;
        $edit = ($rw["patient_status"] == 1)?"<a href='".HostRoot."data-entry/{$rw["Patient_Id"]}'><i class='fa fa-pencil'>Edit</i></a>/":"";
        $patient_status = ($rw["patient_status"] == 1)? "<p style='color: green'>Active</p>":"<p style='color: red'>Deactivated</p>";
        $impresnStatus = ($rw["test_impression"] == 3)?"<a href='".HostRoot."phoneF-up/{$rw["Patient_Id"]}' class='btn btn-default'>Phone F/up</a>":"";
        $folwUpSms = ($rw["test_impression"] == 3)?"<button class='btn btn-default' onclick='folwUpSms({$rw["Phone_number"]})'> <span class='fa fa-send'></span>Send sms</button>":"";
        $data .="
            <tr>
                <td>$count</td>
                <td>{$rw["Baby_name"]}</td>
                <td>{$rw["baby_id_num"]}</td>
                <td>{$rw["POCD_No"]}</td>
                <td><p>{$rw["Phone_number"]}</p><p>{$folwUpSms}</p></td>    
                <td>".getImpressionByID($rw["test_impression"])."<p>$impresnStatus</p></td>
                <td>{$patient_status}</td>
                <td><span>$edit<a href='".HostRoot."data-entry/{$rw["Patient_Id"]}/status/{$status_id}'><i class='fa fa-trash-o'>Delete</i></a></span></td>
            </tr>
        ";
        $count++;
    }
    return $data;
}

function getPatientInfo($POST,$GET){
    $data = "";
    $patiet_id = $GET["data-entry"];
    
    if(isset($GET["data-entry"]) && is_numeric($GET["data-entry"]) && isset($GET["status"]) && is_numeric($GET["status"]) ){
        $st = strip_tags($GET["status"]);
        $pid = strip_tags($GET["data-entry"]);
        $qry_1 = "UPDATE `patient` SET `patient_status` = '$st' WHERE `Patient_Id` = '$pid'";
        //echo $qry_1;
        mysql_query($qry_1);
        redirect(HostRoot. "screening-list");
    
    }
    elseif (isset($GET["data-entry"]) && is_numeric($GET["data-entry"]) && !isset($GET["status"])) {
        //$qryPatient = "SELECT pat.*, prenatal.*, natal.*, postnatal.*, other.*, screen1.*, screen2.*, boa.*, primitive.*, aabr.*, acanalys.* FROM `patient` pat, `pre_natal_hrr` prenatal, `natal_hrr` natal, `post_natal_hrrr` postnatal, `other_hrr` other, `screening_test_1` screen1, `screening_test_2` screen2, `behavioral_obs_audiometry` boa, `primitive_reflex` primitive, `aabr_screen` aabr, `acoustic_analysis` acanalys WHERE pat.`Patient_Id` = prenatal.`Patient_Id` AND pat.`Patient_Id` = natal.`Patient_Id` AND pat.`Patient_Id` = postnatal.`Patient_Id` AND pat.`Patient_Id` = other.`Patient_Id` AND pat.`Patient_Id` = screen1.`Patient_Id` AND pat.`Patient_Id` = screen2.`Patient_Id` AND pat.`Patient_Id` = boa.`Patient_Id` AND pat.`Patient_Id` = primitive.`Patient_Id` AND pat.`Patient_Id` = aabr.`Patient_Id` AND pat.`Patient_Id` = acanalys.`Patient_Id` AND pat.`Patient_Id` = '{$patiet_id}'";
        $qryPatient = "SELECT `Hospital_Name`, `Delivery_type_Name`, `Patient_Id`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Present_address`, `Permanent_address`, `Phone_number`, `Email_id`, `user_name`, `state_id`, `district_id`, `city_id`, `test_impression`, `impresn_remmark`, `patient_status`, `Date_of_HRR_Screen` FROM `patient` WHERE `Patient_Id` = '{$patiet_id}'";
        //echo $qryPatient;
        $resultPatient = mysql_query($qryPatient);
        $data = mysql_fetch_assoc($resultPatient);
    }
    return $data;
}
//function getPatientInfo($POST,$GET){
//    $data = "";
//    $patiet_id = $GET["data-entry"];
//    
//    if(isset($GET["data-entry"]) && is_numeric($GET["data-entry"]) && isset($GET["status"]) && is_numeric($GET["status"]) ){
//        $st = strip_tags($GET["status"]);
//        $pid = strip_tags($GET["data-entry"]);
//        $qry_1 = "UPDATE `patient` SET `patient_status` = '$st' WHERE `Patient_Id` = '$pid'";
//        //echo $qry_1;
//        mysql_query($qry_1);
//        redirect(HostRoot. "screening-list");
//    
//    }
//    elseif (isset($GET["data-entry"]) && is_numeric($GET["data-entry"]) && !isset($GET["status"])) {
//        //$qryPatient = "SELECT pat.*, prenatal.*, natal.*, postnatal.*, other.*, screen1.*, screen2.*, boa.*, primitive.*, aabr.*, acanalys.* FROM `patient` pat, `pre_natal_hrr` prenatal, `natal_hrr` natal, `post_natal_hrrr` postnatal, `other_hrr` other, `screening_test_1` screen1, `screening_test_2` screen2, `behavioral_obs_audiometry` boa, `primitive_reflex` primitive, `aabr_screen` aabr, `acoustic_analysis` acanalys WHERE pat.`Patient_Id` = prenatal.`Patient_Id` AND pat.`Patient_Id` = natal.`Patient_Id` AND pat.`Patient_Id` = postnatal.`Patient_Id` AND pat.`Patient_Id` = other.`Patient_Id` AND pat.`Patient_Id` = screen1.`Patient_Id` AND pat.`Patient_Id` = screen2.`Patient_Id` AND pat.`Patient_Id` = boa.`Patient_Id` AND pat.`Patient_Id` = primitive.`Patient_Id` AND pat.`Patient_Id` = aabr.`Patient_Id` AND pat.`Patient_Id` = acanalys.`Patient_Id` AND pat.`Patient_Id` = '{$patiet_id}'";
//        $qryPatient = "SELECT `Hospital_Name`, `Delivery_type_Name`, `Patient_Id`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Present_address`, `Permanent_address`, `Phone_number`, `Email_id`, `user_name`, `state_id`, `district_id`, `city_id`, `test_impression`, `impresn_remmark`, `patient_status`, `Date_of_HRR_Screen` FROM `patient` WHERE `Patient_Id` = '{$patiet_id}'";
//        //echo $qryPatient;
//        $resultPatient = mysql_query($qryPatient);
//        $data = mysql_fetch_assoc($resultPatient);
//    }
//    return $data;
//}

function getStep2Info($POST,$GET){
    $qry_1 = "SELECT pat.`Patient_Id`, hrr.*, prenatal.*, natal.*, postnatal.*, other.* FROM `patient` pat, `tbl_hrr` hrr, `pre_natal_hrr` prenatal, `natal_hrr` natal, `post_natal_hrrr` postnatal, `other_hrr` other WHERE pat.`Patient_Id` = prenatal.`Patient_Id` AND pat.`Patient_Id` = natal.`Patient_Id` AND pat.`Patient_Id` = postnatal.`Patient_Id` AND pat.`Patient_Id` = other.`Patient_Id` AND pat.`Patient_Id` = hrr.`Patient_Id` AND pat.`Patient_Id` = '{$GET["data-entry"]}'";
    //echo $qry_1;
    $resultStep2 = mysql_query($qry_1);
    $data = mysql_fetch_assoc($resultStep2);
    return $data;
}

function getHrrDetByPatient($patient){
    $qry_1 = "SELECT `hrr_type`, `hrr_id` FROM `tbl_hrr` WHERE `Patient_Id` = '$patient'";
    //echo $qry_1;
    $resultStep2 = mysql_query($qry_1);
    $data = mysql_fetch_assoc($resultStep2);
    return $data;
}


function getStep3Info($POST,$GET){
    $qry_1 = "SELECT pat.`Patient_Id`, screen1.*, screen2.*, boa.*, primref.*, acanal.*, aabr.* FROM `patient` pat, `screening_test_1` screen1, `screening_test_2` screen2, `behavioral_obs_audiometry` boa, `primitive_reflex` primref, `acoustic_analysis` acanal, `aabr_screen` aabr WHERE pat.`Patient_Id` = screen1.`Patient_Id` AND pat.`Patient_Id` = screen2.`Patient_Id` AND pat.`Patient_Id` = boa.`Patient_Id` AND pat.`Patient_Id` = primref.`Patient_Id` AND pat.`Patient_Id` = acanal.`Patient_Id` AND pat.`Patient_Id` = aabr.`Patient_Id` AND pat.`Patient_Id` = '{$GET["data-entry"]}'";
    //echo $qry_1;
    $resultStep2 = mysql_query($qry_1);
    $data = mysql_fetch_assoc($resultStep2);
    return $data;
}

function getHospitalNameById($hospital){
    $qry_Hospital = "SELECT `hosp_name` FROM `tbl_hospital` WHERE `hosp_id` = '{$hospital}'";
    $result = mysql_query($qry_Hospital);
    $rw = mysql_fetch_array($result);
    $data = $rw["hosp_name"];
    return $data;
}

function getPatient($patient){
    $qry_1 = "SELECT `Hospital_Name`, `Delivery_type_Name`, `Patient_Id`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Caste`, `Region`, `Present_address`, `Permanent_address`, `state_id`, `district_id`, `city_id`, `Phone_number`, `Email_id`, `Income_per_month`, `Medical_history`, `Date_of_HRR_Screen`, `user_name`, `test_impression`, `impresn_remmark` FROM `patient` WHERE `Patient_Id` = '{$patient}' AND `patient_status` = '1'";
    $resultPatient = mysql_query($qry_1);
    $data = mysql_fetch_assoc($resultPatient);
    return $data;
    
}

function getimpression($patient, $abshrr){
    $patientDet = getBabyDetByAbsentHrr($patient);
    $patientDetail = getBabyDetByPatientId($patient);
    
    if($patientDet["hrr_type"] == 1 || $patientDet["hrr_type"] == 2){
        $hrr = "pass";
    }
    
    if($patientDet["rt_screen1"] == 1 && $patientDet["lt_screen1"] == 1){
        $screen1Pass = "pass";
        //echo "screen1";
    }
    elseif ($patientDet["rt_screen1"] == 1 && empty($patientDet["lt_screen1"])) {
        $screen1Pass = "pass";
        //echo "screen1";
    }
    elseif (empty($patientDet["rt_screen1"]) && $patientDet["lt_screen1"] == 1) {
        $screen1Pass = "pass";
       // echo "screen1";
    }
    if($patientDet["rt_screen2"] == 1 && $patientDet["lt_screen2"] == 1){
        $screen2Pass = "pass";
        //echo "screen2";
    }
    elseif ($patientDet["rt_screen2"] == 1 && empty($patientDet["lt_screen2"])) {
        $screen2Pass = "pass";
       // echo "screen2";
    }
    elseif (empty($patientDet["rt_screen2"]) && $patientDet["lt_screen2"] == 1) {
        $screen2Pass = "pass";
        //echo "screen2";
    }
    
    if($patientDet["rt_screen1"] == 1 && $patientDet["lt_screen1"] != 1){
        $screen1Query = "pass";
        //echo "screen1";
    }
    elseif ($patientDet["rt_screen1"] != 1 && $patientDet["lt_screen1"] == 1) {
        $screen1Query = "pass";
        //echo "screen1";
    }
    
    if($patientDet["rt_screen2"] == 1 && $patientDet["lt_screen2"] != 1){
        $screen2Query = "refer";
        //echo "screen2";
    }
    elseif ($patientDet["rt_screen2"] != 1 && $patientDet["lt_screen2"] == 1) {
        $screen2Query = "refer";
       // echo "screen2";
    }
    elseif (empty($patientDet["rt_screen2"]) && $patientDet["lt_screen2"] == 1) {
        $screen2Pass = "pass";
        //echo "screen2";
    }
    if($patientDet["aabr_rt_pass"] == 1 && $patientDet["aabr_lt_pass"] == 1){
        $aabrPass = "pass";
    }
    elseif($patientDet["aabr_rt_pass"] == 0 && $patientDet["aabr_lt_pass"] == 1 && $patientDet["aabr_rt_refer"] == 0 && $patientDet["aabr_rt_cnt_noisy"] == 0){
        $aabrPass = "pass";
    }
    elseif($patientDet["aabr_lt_pass"] == 0 && $patientDet["aabr_rt_pass"] == 1 && $patientDet["aabr_lt_refer"] == 0 && $patientDet["aabr_lt_cnt_noisy"] == 0){
        $aabrPass = "pass";
    }
    
    
    if($patientDet["fivehz_80dBHL_pass"] == 1 || $patientDet["fivehz_50dBHL_pass"] == 1 || $patientDet["fourhz_80dBHL_pass"] == 1 || $patientDet["fourhz_50dBHL_pass"] == 1 || $patientDet["whitenoise_80dBHL_pass"] == 1 || ($patientDet["whitenoise_50dBHL_pass"] == 1 && empty($patientDet["whitenoise_50dBHL_refer"]))){
        if(empty($patientDet["fivehz_80dBHL_refer"] ) && empty($patientDet["fivehz_50dBHL_refer"]) && empty($patientDet["fourhz_80dBHL_refer"]) && empty($patientDet["fourhz_50dBHL_refer"]) && empty($patientDet["whitenoise_80dBHL_refer"]) ){
            $passBOA = "pass";
            //echo "BOA";
        }
    }
    
    if($patientDet["normal_val"] == 1){
        $acanalPass = "pass";
        //echo "Acanal";
    }
    if($patientDet["moro_pre"] == 1 || $patientDet["root_pre"] == 1 ||$patientDet["suck_pre"] == 1 || $patientDet["tonicneck_pre"] == 1 || $patientDet["palmar_pre"] == 1 || $patientDet["plantar_pre"] == 1 || $patientDet["babinski_pre"] == 1){
      if (empty($patientDet["moro_abs"]) && empty($patientDet["root_abs"]) && empty($patientDet["suck_abs"]) && empty($patientDet["tonicneck_abs"]) && empty($patientDet["palmar_abs"]) && empty($patientDet["plantar_abs"]) && empty($patientDet["babinski_abs"])){
        $primRefPass = "pass";
        //echo "infantcry";
      }
    }
    
    
    //if ($patientDet["hrr_type"] == '2' && $patientDet["rt_screen1"] == 1 || $patientDet["lt_screen1"] == 1 && $patientDet["rt_screen1"] != 2 && $patientDet["rt_screen1"] != 3 && $patientDet["lt_screen1"] != 2 && $patientDet["lt_screen1"] != 3 && $patientDet["rt_screen2"] == 1 || $patientDet["lt_screen2"] == 1  && $patientDet["rt_screen2"] != 2 && $patientDet["rt_screen2"] != 3 && $patientDet["lt_screen2"] != 2 && $patientDet["lt_screen2"] != 3 && ($patientDet["fivehz_80dBHL_pass"] == 1 || $patientDet["fivehz_50dBHL_pass"] == '1' || $patientDet["fourhz_80dBHL_pass"] == '1' || $patientDet["fourhz_50dBHL_pass"] == '1' || $patientDet["whitenoise_80dBHL_pass"] == '1' || $patientDet["whitenoise_50dBHL_pass"] == '1' && $patientDet["fivehz_80dBHL_refer"] != 1 && $patientDet["fivehz_50dBHL_refer"] != '1' && $patientDet["fourhz_80dBHL_refer"] != '1' && $patientDet["fourhz_50dBHL_refer"] != '1' && $patientDet["whitenoise_80dBHL_refer"] != '1' && $patientDet["whitenoise_50dBHL_refer"] != '1') && $patientDet["normal_val"] == 1 && $patientDet["abnormal_val"] != 1 ) {
    if ($patientDet["hrr_type"] == 2 && $screen1Pass == "pass" && $screen2Pass == "pass" && $passBOA == "pass" && $acanalPass == "pass" && $primRefPass == "pass") {
         $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='1' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updatenorisk = "UPDATE `patient` SET `test_impression` ='1' WHERE `Patient_Id` = '$patient'";
        mysql_query($updatenorisk);
        
        echo "<div class='row'>
                <div class='col-md-12'>
                    <div class='col-md-6 impSel' id=''>
                        <h3><span class='label label-success' >$msg1</span></h3>
                    </div>
                    <div class='col-md-5'>
                        ".SelectImpresion($patient)."
                    </div>
                </div>
              </div>  
        ";
        $hrr  = ($patientDet["hrr_type"] == 2)?"<p><h4>Absent</h4></p>":"";
        $oaeRightPass = ($patientDet["rt_screen1"] == 1)?"<li><span class='panel-title'>Right ear:</span> Pass</li>":"";
        $oaeRightRefer = ($patientDet["rt_screen1"] == 2)?"<li><span class='panel-title'>Right ear:</span> Refer</li>":"";
        $oaeRightCNT = ($patientDet["rt_screen1"] == 3)?"<li><span class='panel-title'>Right ear:</span> CNT</li>":"";
        $oaeLeftPass = !empty($patientDet["lt_screen1"])?"<li><span class='panel-title'>Left ear:</span> Pass</li>":"";
        $oaeRightPassTwo = !empty($patientDet["rt_screen2"])?"<li><span class='panel-title'>Right ear:</span> Pass</li>":"";
        $oaeLeftPassTwo = !empty($patientDet["lt_screen2"])?"<li><span class='panel-title'>Left ear:</span> Pass</li>":"";
        
        $nbn500PassOne = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500PassTwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $nbn4000PassOne = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn4000PassTwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $whiteNoisyPassOne = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whiteNoisyPassTwo = !empty($patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrList = (empty($aabrRtearPass) && empty($aabrLtearPass) && empty($aabrRtearRefer) && empty($aabrLtearRefer) && empty($aabrRtearCNT) && empty($aabrLtearCNT))?
                    "<p>-</p>":"<p><h5>Rt ear</h5></p>
                            <p><ul>$aabrRtearPass
                            $aabrRtearRefer
                            $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                            <p><ul>$aabrLtearPass
                            $aabrLtearRefer
                            $aabrLtearCNT</ul></p>";
        
        
        
        $AcANormal = !empty($patientDet["normal_val"])?"<li>Normal</li>":"";
        
        $Moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $Rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suckingPresent = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic:</span> Present</li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present</li>":"";
        $plantar_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present</li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
    
    
        $impresnRemark = "$hrr $oaeRightPass $oaeLeftPass $oaeRightPassTwo $oaeLeftPassTwo $nbn500PassOne $nbn500PassTwo"
                . "$nbn4000PassOne $nbn4000PassTwo $whiteNoisyPassOne $whiteNoisyPassTwo $AcANormal $Moro_Present"
                . "$Rooting_Present $suckingPresent $tonic_Present $tonic_Present $palmar_Present $plantar_Present $babinski_Present";

        $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
        mysql_query($updateImprRemark);
        
        echo "<div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #00e765'>
                        <th><h4>HRR Screening</h4></th>
                        <th><h4>OAE</h4></th>
                        <th><h4>BOA</h4></th>
                        <th><h4>AABR</h4></th>
                        <th class=''><h4>Acoustic analyses</h4></th>
                        <th class=''><h4>Primitive Reflexes</h4></th>
                    </tr>
                    <tr>
                        <td>$hrr</td>
                        <td>
                            <p><h4> 1st Screening </h4></p>
                            <p><ul>$oaeRightPass
                            $oaeLeftPass</ul></p>
                            <p><h4> 2nd Screening </h4></p>    
                            <p><ul>$oaeRightPassTwo
                            $oaeLeftPassTwo</ul></p>
                        </td>
                        <td><p><li>Pass</li></p>
                        </td>
                        <td>
                            $aabrList
                        </td>
                        <td>
                            <p>$AcANormal</p>
                        </td>
                        <td>
                            <p><ul>$Moro_Present
                            $Rooting_Present
                            $suckingPresent
                            $tonic_Present
                            $palmar_Present
                            $plantar_Present
                            $babinski_Present</ul></p>
                        </td>

                    </tr>
                </tbody>

            </table>
            
            </div>
        ";
    
    }
    elseif ($patientDet["hrr_type"] == 2 && $screen2Pass == "pass" && $aabrPass = "pass" && $passBOA == "pass" && $acanalPass == "pass" && $primRefPass == "pass") {
         $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='1' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updatenorisk = "UPDATE `patient` SET `test_impression` ='1' WHERE `Patient_Id` = '$patient'";
        mysql_query($updatenorisk);
        
        echo "<div class='row'>
                <div class='col-md-12'>
                    <div class='col-md-6 impSel' >
                        <h3><span class='label label-success' >$msg1</span></h3>
                    </div>
                    <div class='col-md-5'>
                        ".SelectImpresion($patient)."
                    </div>
                </div>
              </div>  
        ";
        $hrr  = ($patientDet["hrr_type"] == 2)?"<p><h4>Absent</h4></p>":"";
        $oaeRightPass = ($patientDet["rt_screen1"] == 1)?"<li><span class='panel-title'>Right ear:</span> Pass</li>":"";
        $oaeRightRefer = ($patientDet["rt_screen1"] == 2)?"<li><span class='panel-title'>Right ear:</span> Refer</li>":"";
        $oaeRightCNT = ($patientDet["rt_screen1"] == 3)?"<li><span class='panel-title'>Right ear:</span> CNT</li>":"";
        $oaeLeftPass = ($patientDet["lt_screen1"] == 1)?"<li><span class='panel-title'>Left ear:</span> Pass</li>":"";
        $oaeLeftRefer = ($patientDet["lt_screen1"] == 2)?"<li><span class='panel-title'>Left ear:</span> Refer</li>":"";
        $oaeLeftCNT= ($patientDet["lt_screen1"] == 3)?"<li><span class='panel-title'>Left ear:</span> CNT</li>":"";
        $oaeRightPassTwo = !empty($patientDet["rt_screen2"])?"<li><span class='panel-title'>Right ear:</span> Pass</li>":"";
        $oaeLeftPassTwo = !empty($patientDet["lt_screen2"])?"<li><span class='panel-title'>Left ear:</span> Pass</li>":"";
        
        $nbn500PassOne = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500PassTwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $nbn4000PassOne = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn4000PassTwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $aabrList = (empty($aabrRtearPass) && empty($aabrLtearPass) && empty($aabrRtearRefer) && empty($aabrLtearRefer) && empty($aabrRtearCNT) && empty($aabrLtearCNT))?
                    "<p>-</p>":"<p><h5>Rt ear</h5></p>
                            <p><ul>$aabrRtearPass
                            $aabrRtearRefer
                            $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                            <p><ul>$aabrLtearPass
                            $aabrLtearRefer
                            $aabrLtearCNT</ul></p>";
        
        $whiteNoisyPassOne = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whiteNoisyPassTwo = !empty($patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        
        $AcANormal = !empty($patientDet["normal_val"])?"<li>Normal</li>":"";
        
        $Moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $Rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting: </span>Present</li>":"";
        $suckingPresent = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic:</span> Present</li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present</li>":"";
        $plantar_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present</li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
    
    
        $impresnRemark = "$hrr $oaeRightPass $oaeLeftPass $oaeRightPassTwo $oaeLeftPassTwo $nbn500PassOne $nbn500PassTwo"
                . "$nbn4000PassOne $nbn4000PassTwo $whiteNoisyPassOne $whiteNoisyPassTwo $AcANormal $Moro_Present"
                . "$Rooting_Present $suckingPresent $tonic_Present $tonic_Present $palmar_Present $plantar_Present $babinski_Present";

        $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
        mysql_query($updateImprRemark);
        
        echo "<div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #00e765'>
                        <th><h4>HRR Screening</h4></th>
                        <th><h4>OAE</h4></th>
                        <th><h4>BOA</h4></th>
                        <th><h4>AABR</h4></th>
                        <th class=''><h4>Acoustic analyses</h4></th>
                        <th class=''><h4>Primitive Reflexes</h4></th>
                    </tr>
                    <tr>
                        <td>$hrr</td>
                        <td>
                            <p><h4> 1st Screening </h4></p>
                            <p><ul>$oaeRightPass$oaeRightRefer$oaeRightCNT
                            $oaeLeftPass$oaeLeftRefer$oaeLeftCNT</ul></p>
                            <p><h4> 2nd Screening </h4></p>    
                            <p><ul>$oaeRightPassTwo
                            $oaeLeftPassTwo</ul></p>
                        </td>
                        <td><p><li>Pass</li></p>
                        </td>
                        <td>
                            $aabrList
                        </td>
                        <td>
                            <p>$AcANormal</p>
                        </td>
                        <td>
                            <p><ul>$Moro_Present
                            $Rooting_Present
                            $suckingPresent
                            $tonic_Present
                            $palmar_Present
                            $plantar_Present
                            $babinski_Present</ul></p>
                        </td>

                    </tr>
                </tbody>

            </table>
            
            </div>
        ";
    
    }
    elseif ($patientDetail["hrr_type"] == 2 && !empty($screen1Pass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
         $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='1' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updatenorisk = "UPDATE `patient` SET `test_impression` ='1' WHERE `Patient_Id` = '$patient'";
        mysql_query($updatenorisk);
        
        echo "<div class='row'>
                <div class='col-md-12'>
                    <div class='col-md-6 impSel'>
                        <h3><span class='label label-success' >$msg1</span></h3>
                    </div>
                    <div class='col-md-5'>
                        ".SelectImpresion($patient)."
                    </div>
                </div>
              </div>  
        ";
        $hrr  = ($patientDet["hrr_type"] == 2)?"<p><h4>Absent</h4></p>":"";
        $oaeRightPass = !empty($patientDet["rt_screen1"])?"<li><span class='panel-title'>Right ear:</span> Pass</li>":"";
        $oaeLeftPass = !empty($patientDet["lt_screen1"])?"<li><span class='panel-title'>Left ear:</span> Pass</li>":"";
        $oaeRightPassTwo = !empty($patientDet["rt_screen2"])?"<li><span class='panel-title'>Right ear:</span> Pass</li>":"";
        $oaeLeftPassTwo = !empty($patientDet["lt_screen2"])?"<li><span class='panel-title'>Left ear:</span> Pass</li>":"";
        $nbn500PassOne = !empty($patientDet["fivehz_80dBHL_pass"])?"<li><span class='panel-title'>80dBHL:</span> Pass</li>":"";
        $nbn500PassTwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li><span class='panel-title'>50dBHL:</span> Pass</li>":"";
        
        $nbn4000PassOne = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn4000PassTwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrList = (empty($aabrRtearPass) && empty($aabrLtearPass) && empty($aabrRtearRefer) && empty($aabrLtearRefer) && empty($aabrRtearCNT) && empty($aabrLtearCNT))?
                    "<p>-</p>":"<p><h5>Rt ear</h5></p>
                            <p><ul>$aabrRtearPass
                            $aabrRtearRefer
                            $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                            <p><ul>$aabrLtearPass
                            $aabrLtearRefer
                            $aabrLtearCNT</ul></p>";
        
        $whiteNoisyPassOne = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whiteNoisyPassTwo = !empty($patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        
        $AcANormal = !empty($patientDet["normal_val"])?"<li>Normal</li>":"";
        
        $Moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $Rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suckingPresent = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Rooting: </span>Present</li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic:</span> Present</li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present</li>":"";
        $plantar_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar: </span>Present</li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
    
    
        $impresnRemark = "$hrr $oaeRightPass $oaeLeftPass $oaeRightPassTwo $oaeLeftPassTwo $nbn500PassOne $nbn500PassTwo"
                . "$nbn4000PassOne $nbn4000PassTwo $whiteNoisyPassOne $whiteNoisyPassTwo $AcANormal $Moro_Present"
                . "$Rooting_Present $suckingPresent $tonic_Present $tonic_Present $palmar_Present $plantar_Present $babinski_Present";

        $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
        mysql_query($updateImprRemark);
        
        echo "<div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #00e765'>
                        <th><h4>HRR Screening</h4></th>
                        <th><h4>OAE</h4></th>
                        <th><h4>BOA</h4></th>
                        <th><h4>AABR</h4></th>
                        <th class=''><h4>Acoustic analyses</h4></th>
                        <th class=''><h4>Primitive Reflexes</h4></th>
                    </tr>
                    <tr>
                        <td>$hrr</td>
                        <td>
                            <p><h4> 1st Screening </h4></p>
                            <p><ul>$oaeRightPass
                            $oaeLeftPass</ul></p>
                        </td>
                        <td><p><li>Pass</li></p>
                        </td>
                        <td>
                            $aabrList
                        </td>
                        <td>
                            <p>$AcANormal</p>
                        </td>
                        <td>
                            <p><ul>$Moro_Present
                            $Rooting_Present
                            $suckingPresent
                            $tonic_Present
                            $palmar_Present
                            $plantar_Present
                            $babinski_Present</ul></p>
                        </td>

                    </tr>
                </tbody>

            </table>
            
            </div>
        ";
    
    }
    elseif ($patientDet["hrr_type"] == 1 && !empty($screen1Pass) && !empty($screen2Pass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
        
        $hrrType  = ($patientDet["hrr_type"] == 1)?"<p><h4>Presence</h4></p>":"";
        
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"<li>Excessive vomiting </li>":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"<li>Elderly Pregnancy </li>":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"<li>High/Low B.P</li>":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"<li>Blood Sugar</li>":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"<li>H/O Abortions </li>":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"<li>Rh Incompatibility</li>":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"<li>Viral/Bacterial infections </li>":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"<li>Oto toxic medications </li>":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"<li>Chemical fumes </li>":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"<li>Alcohol</li>":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"<li>Smoking </li>":"";
        
        $preNatalList = (empty($ex_Vomit) && empty($eld_Preg) && empty($baby_bp) && empty($blood_Sugar) && empty($baby_Abortion) && empty($baby_rh) && empty($viral_Infection) && empty($oto_Medication) && empty($chem_Fume) && empty($baby_alcohol) && empty($baby_smoke))?
                        "<h4>-</h4>":"<p>$ex_Vomit</p>
                                <p>$eld_Preg</p>
                                <p>$baby_bp</p>
                                <p>$blood_Sugar</p>
                                <p>$baby_Abortion</p>
                                <p>$baby_rh</p>
                                <p>$viral_Infection</p>
                                <p>$oto_Medication</p>
                                <p>$chem_Fume</p>
                                <p>$baby_alcohol</p>
                                <p>$baby_smoke</p>";
        
        $weight_Less = !empty($patientDetail["lbw"])?" <li><span class='panel-title'>Low Birth weight < 1.5kg:</span> {$patientDetail["birth_wt"]} Kg </li>":"-";
        $fetal_Distress = !empty($patientDetail["fd"])?"<li>Fetal distress</li>":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"<li>Birth asphyxia </li>":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"<li>Neonatal Jaundice</li>":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"<li>APGAR Score: 0-4 @ 1min</li>":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"<li>APGAR Score: 0-6@ 5min </li>":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"<li>Neonatal Jaudice.<p> <span class='panel-title'>Bilirubin Level:</span>{$patientDetail["bilrubin_level"]} </p></li> ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"<li><span class='panel-title'>Delayed birth cry:</span> {$patientDetail["birthcrysec"]} sec </li>":"";
        $baby_nicu = !empty($patientDetail["nicu"])?"<li><span class='panel-title'>NICU:</span> {$patientDetail["nicu_val"]} days </li>":"";
        $prematuredelWeek = !empty($patientDetail["premature_delivery_week"])?"<li><span class='panel-title'>Premature Delivery :</span> {$patientDetail["premature_delivery_val"]} Week</li>":"";
        $aspirationFluid = !empty($patientDetail["aspiration_of_fluid_days"])?"<li>Aspiration of amniotic fluid</li>":"";
        
        $natalList = (empty($weight_Less) && empty($fetal_Distress) && empty($birth_Asphyxia) && empty($apg_Arone) && empty($apgarFive) && empty($bil_Level) && empty($baby_birthcry) && empty($baby_nicu) && empty($prematuredelWeek) && empty($aspirationFluid))?
                "<h4>-</h4>":"<p>$weight_Less</p>
                        <p>$fetal_Distress</p>
                        <p>$birth_Asphyxia</p>
                        <p>$apg_Arone</p>
                        <p>$apgarFive</p>
                        <p>$bil_Level</p>
                        <p>$baby_birthcry</p>
                        <p>$baby_nicu</p>
                        <p>$prematuredelWeek</p>
                        <p>$aspirationFluid</p>";
        
        $cranio_Facial = !empty($patientDetail["csa"])?"<li>Craniofacial </li>":"";
        $co_Genital = !empty($patientDetail["ca"])?"<li>Congential anomalies </li>":"";
        $de_Generative = !empty($patientDetail["dd"])?"<li>Degenerative diseases </li>":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"<li>Viral/bacterial infections </li>":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"<li>Convulsions </li>":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"<li>Otitis Media with effusion </li>":"";
        $baby_trauma = !empty($patientDetail["thn"])?"<li>Trauma of head or neck </li>":"";
        
        $postNatalList = (empty($cranio_Facial) && empty($co_Genital) && empty($de_Generative) && empty($viral_Infect) && empty($baby_convulsions) && empty($baby_otitis) && empty($baby_trauma))?
                        "<h4>-</h4>":"<p>$cranio_Facial</p>
                            <p>$co_Genital</p>
                            <p>$de_Generative</p>
                            <p>$viral_Infect</p>
                            <p>$baby_convulsions</p>
                            <p>$baby_otitis</p>
                            <p>$baby_trauma</p>";
        
        $consPos = ($patientDetail["cons_pos_val"] == 1)?"'+'ve":"";
        $consNeg = ($patientDetail["cons_neg_val"] == 1)?"<li>'-'ve</li>":"";
        $consPos1 = ($patientDetail["conspos1"] == 1)?"1 degree":"";
        $consPos2 = ($patientDetail["conspos2"] == 1)?"2 degree":"";
        $consPos3 = ($patientDetail["conspos3"] == 1)?"3 degree":"";
        
        $consPosVal = !empty($consPos)?"<p><h5>Consanguinity</h5></p><li>$consPos($consPos1$consPos2$consPos3)</li>":"";
        
        $famPos = ($patientDetail["fam_his_pos"] == 1)?"'+'ve":"";
        $famNeg = ($patientDetail["fam_his_neg"] == 1)?"<li>'-'ve</li>":"";
        $famMat = ($patientDetail["fam_his_mat"] == 1)?"Maternal":"";
        $famPat = ($patientDetail["fam_his_pat"] == 1)?"Paternal":"";
        $famHi = ($patientDetail["fam_his_hi"] == 1)?"Hl":"";
        $famSp = ($patientDetail["fam_his_sp"] == 1)?"Sp":"";
        $famLg = ($patientDetail["fam_his_lg"] == 1)?"Lg":"";
        $famMd = ($patientDetail["fam_his_md"] == 1)?"MD":"";
        $famOth = ($patientDetail["fam_his_oth"] == 1)?"Other":"";
        
        $famPOsVal = !empty($famPos)?"<p><h5>Family History</h5></p><li>$famPos($famMat$famPat)($famHi$famSp$famLg$famMd$famOth)</li>":"";
        
        $otherList = (empty($consPosVal) && empty($consNeg) && empty($famPOsVal) && empty($famNeg))?"<h4>-</h4>":"<p>$consPosVal$consNeg</p>
                                <p>$famPOsVal$famNeg</p>";
//        $otherList = (empty($nbn500PassOne) && empty($nbn500PassTwo) && $nbn4000PassOne && $nbn4000PassTwo && $whiteNoisyPassOne && $whiteNoisyPassTwo)?"-":"";
        
        $aabrRtearPass = ($patientDet["aabr_rt_pass"] == 1)?"<li>Pass</li>":"";
        $aabrLtearPass = ($patientDet["aabr_lt_pass"] == 1)?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $aabr_List = (!empty($aabrRtearPass) || !empty($aabrLtearPass) )?"<p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p>":"-";
        
        $nbn500_passone = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500_passtwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL:Pass </li>":"";
        $nbn4000_passone = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL:Pass</li>":"";
        $nbn4000_passtwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $whitenoisy_passone = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whitenoisy_passtwo = !empty( $patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL:Pass</li>":"";
        
        
        
        $oaeright_pass = !empty( $patientDet["rt_screen1"])?"<li>Rt- Pass </li>":"";
        $oaeleft_pass = !empty( $patientDet["lt_screen1"])?"<li>Lt- Pass </li>":"";
        $oaeright_pass2 = !empty( $patientDet["rt_screen2"])?"<li>Rt- Pass </li>":"";
        $oaeleft_pass2 = !empty( $patientDet["lt_screen2"])?"<li>Lt- Pass </li>":"";
        
        
        $acanal_normal = !empty($patientDet["normal_val"])?"<li>Normal </li>":"";
        
        $moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suck_Present = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Sucking:</span> Present </li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic neck:</span> Present </li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present </li>":"";
        $planter_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present </li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
        
        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $bil_Level $baby_birthcry $prematuredelWeek $aspirationFluid"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $ $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "
        <div class='row'>
            <div class='col-md-5 impSel'>
                <h3><span class='label label-warning' >$msg1</span></h3>
            </div>
            <div class='col-md-5'>
                ".SelectImpresion($patient)."
            </div>
        </div>
        ";
    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
    mysql_query($updateatrisk2);
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #C97626'>
                        <th><h5>HRR Screening</h5></th>
                        <th><h5>OAE</h5></th>
                        <th><h5>BOA</h5></th>
                        <th><h5>AABR</h5></th>
                        <th class=''><h5>Acoustic analyses</h5></th>
                        <th class=''><h5>Primitive Reflexes</h5></th>
                    </tr>
                    <tr>
                        <td>$hrrType
                            <p><h5>Prenatal HRR</h5></p>
                                $preNatalList
                                
                            
                            <p><h5>Natal HRR</h5></p>
                                $natalList
                                
                                    
                            <p><h5>PostNatal HRR</h5></p>
                               $postNatalList
                                    
                            <p><h5>Other HRR</h5></p>
                                $otherList
                                
                                
                        </td>
                        <td>
                            <p><h5>1st Screening</h5></p>
                                <p>$oaeright_pass</p>
                                <p>$oaeleft_pass</p>
                            <p><h5>2nd Screening</h5></p>    
                                <p>$oaeright_pass2</p>
                                <p>$oaeleft_pass2</p>
                        </td>
                        <td>
                            <p><li>Pass</li></p>
                        </td>
                        <td>
                        $aabr_List
                            <!--<p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p> -->
                        </td>
                        <td>
                            <p>$acanal_normal</p>
                        </td>
                        <td>
                            <p>$moro_Present</p>
                            <p>$rooting_Present</p>
                            <p>$suck_Present</p>
                            <p>$tonic_Present</p>
                            <p>$palmar_Present</p>
                            <p>$planter_Present</p>
                            <p>$babinski_Present</p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>";
     $nbslist = getNbsList($patientDetail);
     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
    
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-3 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
                     $nbslist
                </div>
            
                <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
                    ".getOSCList($patientDetail)."
                </div>
                <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
            <div class='col-md-12 col-md-offset-8 form-group' id='' >
                <input type='text' id='nbsCheckedVal' hidden=''> 
                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
            </div>
            <div class='col-md-12 '>
                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
            </div>
        </div>
            
        ";
    
        echo "
            <!--<div class='col-md-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>POCD no.</th>
                            <th>Baby id</th>
                            <th>Baby name</th>
                            <th>Date of exam</th>
                        </tr>
                    
                        <tr>
                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
                        
                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>-->
        ";
    
    }
    elseif ($patientDet["hrr_type"] == 1 && !empty($screen1Pass) && empty ($patientDet["rt_screen2"]) && empty ($patientDet["lt_screen2"])  && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
        
        $hrrType  = ($patientDet["hrr_type"] == 1)?"<p><h4>Presence</h4></p>":"";
        
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"<li>Excessive vomiting </li>":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"<li>Elderly Pregnancy </li>":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"<li>High/Low B.P</li>":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"<li>Blood Sugar</li>":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"<li>H/O Abortions </li>":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"<li>Rh Incompatibility</li>":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"<li>Viral/Bacterial infections </li>":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"<li>Oto toxic medications </li>":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"<li>Chemical fumes </li>":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"<li>Alcohol</li>":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"<li>Smoking </li>":"";
        
        $preNatalList = (empty($ex_Vomit) && empty($eld_Preg) && empty($baby_bp) && empty($blood_Sugar) && empty($baby_Abortion) && empty($baby_rh) && empty($viral_Infection) && empty($oto_Medication) && empty($chem_Fume) && empty($baby_alcohol) && empty($baby_smoke))?
                        "<h4>-</h4>":"<p>$ex_Vomit</p>
                                <p>$eld_Preg</p>
                                <p>$baby_bp</p>
                                <p>$blood_Sugar</p>
                                <p>$baby_Abortion</p>
                                <p>$baby_rh</p>
                                <p>$viral_Infection</p>
                                <p>$oto_Medication</p>
                                <p>$chem_Fume</p>
                                <p>$baby_alcohol</p>
                                <p>$baby_smoke</p>";
        
        $weight_Less = !empty($patientDetail["lbw"])?" <li><span class='panel-title'>Low Birth weight < 1.5kg:</span> {$patientDetail["birth_wt"]} Kg </li>":"-";
        $fetal_Distress = !empty($patientDetail["fd"])?"<li>Fetal distress</li>":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"<li>Birth asphyxia </li>":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"<li>Neonatal Jaundice</li>":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"<li>APGAR Score: 0-4 @ 1min</li>":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"<li>APGAR Score: 0-6@ 5min </li>":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"<li>Neonatal Jaudice.<p> <span class='panel-title'>Bilirubin Level:</span>{$patientDetail["bilrubin_level"]} </p></li> ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"<li><span class='panel-title'>Delayed birth cry:</span> {$patientDetail["birthcrysec"]} sec </li>":"";
        $baby_nicu = !empty($patientDetail["nicu"])?"<li><span class='panel-title'>NICU:</span> {$patientDetail["nicu_val"]} days </li>":"";
        $prematuredelWeek = !empty($patientDetail["premature_delivery_week"])?"<li><span class='panel-title'>Premature Delivery :</span> {$patientDetail["premature_delivery_val"]} Week</li>":"";
        $aspirationFluid = !empty($patientDetail["aspiration_of_fluid_days"])?"<li>Aspiration of amniotic fluid</li>":"";
        
        $natalList = (empty($weight_Less) && empty($fetal_Distress) && empty($birth_Asphyxia) && empty($apg_Arone) && empty($apgarFive) && empty($bil_Level) && empty($baby_birthcry) && empty($baby_nicu) && empty($prematuredelWeek) && empty($aspirationFluid))?
                "<h4>-</h4>":"<p>$weight_Less</p>
                        <p>$fetal_Distress</p>
                        <p>$birth_Asphyxia</p>
                        <p>$apg_Arone</p>
                        <p>$apgarFive</p>
                        <p>$bil_Level</p>
                        <p>$baby_birthcry</p>
                        <p>$baby_nicu</p>
                        <p>$prematuredelWeek</p>
                        <p>$aspirationFluid</p>";
        
        $cranio_Facial = !empty($patientDetail["csa"])?"<li>Craniofacial </li>":"";
        $co_Genital = !empty($patientDetail["ca"])?"<li>Congential anomalies </li>":"";
        $de_Generative = !empty($patientDetail["dd"])?"<li>Degenerative diseases </li>":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"<li>Viral/bacterial infections </li>":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"<li>Convulsions </li>":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"<li>Otitis Media with effusion </li>":"";
        $baby_trauma = !empty($patientDetail["thn"])?"<li>Trauma of head or neck </li>":"";
        
        $postNatalList = (empty($cranio_Facial) && empty($co_Genital) && empty($de_Generative) && empty($viral_Infect) && empty($baby_convulsions) && empty($baby_otitis) && empty($baby_trauma))?
                        "<h4>-</h4>":"<p>$cranio_Facial</p>
                            <p>$co_Genital</p>
                            <p>$de_Generative</p>
                            <p>$viral_Infect</p>
                            <p>$baby_convulsions</p>
                            <p>$baby_otitis</p>
                            <p>$baby_trauma</p>";
        
        $consPos = ($patientDetail["cons_pos_val"] == 1)?"'+'ve":"";
        $consNeg = ($patientDetail["cons_neg_val"] == 1)?"<li>'-'ve</li>":"";
        $consPos1 = ($patientDetail["conspos1"] == 1)?"1 degree":"";
        $consPos2 = ($patientDetail["conspos2"] == 1)?"2 degree":"";
        $consPos3 = ($patientDetail["conspos3"] == 1)?"3 degree":"";
        
        $consPosVal = !empty($consPos)?"<p><h5>Consanguinity</h5></p><li>$consPos($consPos1$consPos2$consPos3)</li>":"";
        
        $famPos = ($patientDetail["fam_his_pos"] == 1)?"'+'ve":"";
        $famNeg = ($patientDetail["fam_his_neg"] == 1)?"<li>'-'ve</li>":"";
        $famMat = ($patientDetail["fam_his_mat"] == 1)?"Maternal":"";
        $famPat = ($patientDetail["fam_his_pat"] == 1)?"Paternal":"";
        $famHi = ($patientDetail["fam_his_hi"] == 1)?"Hl":"";
        $famSp = ($patientDetail["fam_his_sp"] == 1)?"Sp":"";
        $famLg = ($patientDetail["fam_his_lg"] == 1)?"Lg":"";
        $famMd = ($patientDetail["fam_his_md"] == 1)?"MD":"";
        $famOth = ($patientDetail["fam_his_oth"] == 1)?"Other":"";
        
        $famPOsVal = !empty($famPos)?"<p><h5>Family History</h5></p><li>$famPos($famMat$famPat)($famHi$famSp$famLg$famMd$famOth)</li>":"";
        
        $otherList = (empty($consPosVal) && empty($consNeg) && empty($famPOsVal) && empty($famNeg))?"<h4>-</h4>":"<p>$consPosVal$consNeg</p>
                                <p>$famPOsVal$famNeg</p>";
//        $otherList = (empty($nbn500PassOne) && empty($nbn500PassTwo) && $nbn4000PassOne && $nbn4000PassTwo && $whiteNoisyPassOne && $whiteNoisyPassTwo)?"-":"";
        
        $aabrRtearPass = ($patientDet["aabr_rt_pass"] == 1)?"<li>Pass</li>":"";
        $aabrLtearPass = ($patientDet["aabr_lt_pass"] == 1)?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $aabr_List = (!empty($aabrRtearPass) || !empty($aabrLtearPass) )?"<p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p>":"-";
        
        $nbn500_passone = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500_passtwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL:Pass </li>":"";
        $nbn4000_passone = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL:Pass</li>":"";
        $nbn4000_passtwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $whitenoisy_passone = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whitenoisy_passtwo = !empty( $patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL:Pass</li>":"";
        
        
        
        $oaeright_pass = !empty( $patientDet["rt_screen1"])?"<li>Rt- Pass </li>":"";
        $oaeleft_pass = !empty( $patientDet["lt_screen1"])?"<li>Lt- Pass </li>":"";
        $oaeright_pass2 = !empty( $patientDet["rt_screen2"])?"<li>Rt- Pass </li>":"";
        $oaeleft_pass2 = !empty( $patientDet["lt_screen2"])?"<li>Lt- Pass </li>":"";
        
        
        $acanal_normal = !empty($patientDet["normal_val"])?"<li>Normal </li>":"";
        
        $moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suck_Present = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Sucking:</span> Present </li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic neck:</span> Present </li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present </li>":"";
        $planter_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present </li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
        
        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $bil_Level $baby_birthcry $prematuredelWeek $aspirationFluid"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $ $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "
        <div class='row'>
            <div class='col-md-5 impSel'>
                <h3><span class='label label-warning' >$msg1</span></h3>
            </div>
            <div class='col-md-5'>
                ".SelectImpresion($patient)."
            </div>
        </div>
        ";
    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
    mysql_query($updateatrisk2);
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #C97626'>
                        <th><h5>HRR Screening</h5></th>
                        <th><h5>OAE</h5></th>
                        <th><h5>BOA</h5></th>
                        <th><h5>AABR</h5></th>
                        <th class=''><h5>Acoustic analyses</h5></th>
                        <th class=''><h5>Primitive Reflexes</h5></th>
                    </tr>
                    <tr>
                        <td>$hrrType
                            <p><h5>Prenatal HRR</h5></p>
                                $preNatalList
                                
                            
                            <p><h5>Natal HRR</h5></p>
                                $natalList
                                
                                    
                            <p><h5>PostNatal HRR</h5></p>
                               $postNatalList
                                    
                            <p><h5>Other HRR</h5></p>
                                $otherList
                                
                                
                        </td>
                        <td>
                            <p><h5>1st Screening</h5></p>
                                <p>$oaeright_pass</p>
                                <p>$oaeleft_pass</p>
                            <!--<p><h5>2nd Screening</h5></p>    
                                <p>$oaeright_pass2</p>
                                <p>$oaeleft_pass2</p> -->
                        </td>
                        <td>
                            <p><li>Pass</li></p>
                        </td>
                        <td>
                        $aabr_List
                            <!--<p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p> -->
                        </td>
                        <td>
                            <p>$acanal_normal</p>
                        </td>
                        <td>
                            <p>$moro_Present</p>
                            <p>$rooting_Present</p>
                            <p>$suck_Present</p>
                            <p>$tonic_Present</p>
                            <p>$palmar_Present</p>
                            <p>$planter_Present</p>
                            <p>$babinski_Present</p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>";
     $nbslist = getNbsList($patientDetail);
     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
    
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-3 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
                     $nbslist
                </div>
            
                <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
                    ".getOSCList($patientDetail)."
                </div>
                <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
            <div class='col-md-12 col-md-offset-8 form-group' id='' >
                <input type='text' id='nbsCheckedVal' hidden=''> 
                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
            </div>
            <div class='col-md-12 '>
                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
            </div>
        </div>
            
        ";
    
        echo "
            <!--<div class='col-md-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>POCD no.</th>
                            <th>Baby id</th>
                            <th>Baby name</th>
                            <th>Date of exam</th>
                        </tr>
                    
                        <tr>
                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
                        
                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>-->
        ";
    
    }
    elseif ($patientDet["hrr_type"] == 1 && !empty($screen2Pass) && !empty ($aabrPass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
        
        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
        
        $hrrType  = ($patientDet["hrr_type"] == 1)?"<p><h4>Presence</h4></p>":"";
        
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"<li>Excessive vomiting </li>":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"<li>Elderly Pregnancy </li>":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"<li>High/Low B.P</li>":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"<li>Blood Sugar</li>":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"<li>H/O Abortions </li>":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"<li>Rh Incompatibility</li>":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"<li>Viral/Bacterial infections </li>":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"<li>Oto toxic medications </li>":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"<li>Chemical fumes </li>":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"<li>Alcohol</li>":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"<li>Smoking </li>":"";
        
        $preNatalList = (empty($ex_Vomit) && empty($eld_Preg) && empty($baby_bp) && empty($blood_Sugar) && empty($baby_Abortion) && empty($baby_rh) && empty($viral_Infection) && empty($oto_Medication) && empty($chem_Fume) && empty($baby_alcohol) && empty($baby_smoke))?
                        "<h4>-</h4>":"<p>$ex_Vomit</p>
                                <p>$eld_Preg</p>
                                <p>$baby_bp</p>
                                <p>$blood_Sugar</p>
                                <p>$baby_Abortion</p>
                                <p>$baby_rh</p>
                                <p>$viral_Infection</p>
                                <p>$oto_Medication</p>
                                <p>$chem_Fume</p>
                                <p>$baby_alcohol</p>
                                <p>$baby_smoke</p>";
        
        $weight_Less = !empty($patientDetail["lbw"])?" <li><span class='panel-title'>Low Birth weight < 1.5kg: </span>{$patientDetail["birth_wt"]} Kg </li>":"-";
        $fetal_Distress = !empty($patientDetail["fd"])?"<li>Fetal distress</li>":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"<li>Birth asphyxia </li>":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatal Jaundice":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"<li>APGAR Score: 0-4 @ 1min</li>":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"<li>APGAR Score: 0-6@ 5min </li>":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"<li><span class='panel-title'>Neonatal Jaudice.</span><p> <span class='panel-title'>Bilirubin Level:</span>{$patientDetail["bilrubin_level"]} </p></li> ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"<li><span class='panel-title'>Delayed birth cry:</span> {$patientDetail["birthcrysec"]} sec </li>":"";
        $baby_nicu = !empty($patientDetail["nicu"])?"<li><span class='panel-title'>NICU:</span> {$patientDetail["nicu_val"]} days </li>":"";
        $prematuredelWeek = !empty($patientDetail["premature_delivery_week"])?"<li><span class='panel-title'>Premature Delivery :</span> {$patientDetail["premature_delivery_val"]} Week</li>":"";
        $aspirationFluid = !empty($patientDetail["aspiration_of_fluid_days"])?"<li>Aspiration of amniotic fluid</li>":"";
        
        $natalList = (empty($weight_Less) && empty($fetal_Distress) && empty($birth_Asphyxia) && empty($apg_Arone) && empty($apgarFive) && empty($bil_Level) && empty($baby_birthcry) && empty($baby_nicu) && empty($prematuredelWeek) && empty($aspirationFluid))?
                "<h4>-</h4>":"<p>$weight_Less</p>
                        <p>$fetal_Distress</p>
                        <p>$birth_Asphyxia</p>
                        <p>$apg_Arone</p>
                        <p>$apgarFive</p>
                        <p>$bil_Level</p>
                        <p>$baby_birthcry</p>
                        <p>$baby_nicu</p>
                        <p>$prematuredelWeek</p>
                        <p>$aspirationFluid</p>";
        
        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"<li>Craniofacial </li>":"";
        $co_Genital = !empty($patientDetail["csa"])?"<li>Congential anomalies </li>":"";
        $de_Generative = !empty($patientDetail["dd"])?"<li>Degenerative diseases </li>":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"<li>Viral/bacterial infections </li>":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"<li>Convulsions </li>":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"<li>Otitis Media with effusion </li>":"";
        $baby_trauma = !empty($patientDetail["thn"])?"<li>Trauma of head or neck </li>":"";
        
        $postNatalList = (empty($cranio_Facial) && empty($co_Genital) && empty($de_Generative) && empty($viral_Infect) && empty($baby_convulsions) && empty($baby_otitis) && empty($baby_trauma))?
                        "<h4>-</h4>":"<p>$cranio_Facial</p>
                            <p>$co_Genital</p>
                            <p>$de_Generative</p>
                            <p>$viral_Infect</p>
                            <p>$baby_convulsions</p>
                            <p>$baby_otitis</p>
                            <p>$baby_trauma</p>";
        
        $consPos = ($patientDetail["cons_pos_val"] == 1)?"'+'ve":"";
        $consNeg = ($patientDetail["cons_neg_val"] == 1)?"<li>'-'ve</li>":"";
        $consPos1 = ($patientDetail["conspos1"] == 1)?"1 degree":"";
        $consPos2 = ($patientDetail["conspos2"] == 1)?"2 degree":"";
        $consPos3 = ($patientDetail["conspos3"] == 1)?"3 degree":"";
        
        $consPosVal = !empty($consPos)?"<p><h5>Consanguinity</h5></p><li>$consPos($consPos1$consPos2$consPos3)</li>":"";
        
        $famPos = ($patientDetail["fam_his_pos"] == 1)?"'+'ve":"";
        $famNeg = ($patientDetail["fam_his_neg"] == 1)?"<li>'-'ve</li>":"";
        $famMat = ($patientDetail["fam_his_mat"] == 1)?"Maternal":"";
        $famPat = ($patientDetail["fam_his_pat"] == 1)?"Paternal":"";
        $famHi = ($patientDetail["fam_his_hi"] == 1)?"Hl":"";
        $famSp = ($patientDetail["fam_his_sp"] == 1)?"Sp":"";
        $famLg = ($patientDetail["fam_his_lg"] == 1)?"Lg":"";
        $famMd = ($patientDetail["fam_his_md"] == 1)?"MD":"";
        $famOth = ($patientDetail["fam_his_oth"] == 1)?"Other":"";
        
        $famPOsVal = !empty($famPos)?"<p><h5>Family History</h5></p><li>$famPos($famMat$famPat)($famHi$famSp$famLg$famMd$famOth)</li>":"";
        
        $otherList = (empty($consPosVal) && empty($consNeg) && empty($famPOsVal) && empty($famNeg))?"<h4>-</h4>":"<p>$consPosVal$consNeg</p>
                                <p>$famPOsVal$famNeg</p>";
//        $otherList = (empty($nbn500PassOne) && empty($nbn500PassTwo) && $nbn4000PassOne && $nbn4000PassTwo && $whiteNoisyPassOne && $whiteNoisyPassTwo)?"-":"";
        
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $nbn500_passone = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500_passtwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL:Pass </li>":"";
        $nbn4000_passone = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL:Pass</li>":"";
        $nbn4000_passtwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $whitenoisy_passone = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whitenoisy_passtwo = !empty( $patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL:Pass</li>":"";
        
        
        
        $oaeright_pass = ( $patientDet["rt_screen1"] == 1)?"<li>Rt- Pass </li>":"";
        $oaeright_Refer = ( $patientDet["rt_screen1"] == 2)?"<li>Rt- Refer </li>":"";
        $oaeright_CNT = ( $patientDet["rt_screen1"] == 3)?"<li>Rt- CNT </li>":"";
        $oaeleft_pass = ( $patientDet["lt_screen1"] == 1)?"<li>Lt- Pass </li>":"";
        $oaeleft_Refer= ( $patientDet["lt_screen1"] == 2)?"<li>Lt- Refer</li>":"";
        $oaeleft_CNT= ( $patientDet["lt_screen1"] == 3)?"<li>Lt- CNT</li>":"";
        $oaeright_pass2 = !empty( $patientDet["rt_screen2"])?"<li>Rt- Pass </li>":"";
        $oaeleft_pass2 = !empty( $patientDet["lt_screen2"])?"<li>Lt- Pass </li>":"";
        
        
        $acanal_normal = !empty($patientDet["normal_val"])?"<li>Normal </li>":"";
        
        $moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>NICU:</span>Moro:</span> Present</li>":"";
        $rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>NICU:</span>Rooting:</span> Present</li>":"";
        $suck_Present = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>NICU:</span>Sucking:</span> Present </li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>NICU:</span>Tonic neck:</span> Present </li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>NICU:</span>Palmar: </span>Present </li>":"";
        $planter_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>NICU:</span>Plantar:</span> Present </li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>NICU:</span>Babinski:</span> Present</li>":"";
        
        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $bil_Level $baby_birthcry $prematuredelWeek $aspirationFluid"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $ $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "
        <div class='row'>
            <div class='col-md-5 impSel'>
                <h3><span class='label label-warning' >$msg1</span></h3>
            </div>
            <div class='col-md-5'>
                ".SelectImpresion($patient)."
            </div>
        </div>
        ";
    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
    mysql_query($updateatrisk2);
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #C97626'>
                        <th><h5>HRR Screening</h5></th>
                        <th><h5>OAE</h5></th>
                        <th><h5>BOA</h5></th>
                        <th><h5>AABR</h5></th>
                        <th class=''><h5>Acoustic analyses</h5></th>
                        <th class=''><h5>Primitive Reflexes</h5></th>
                    </tr>
                    <tr>
                        <td>$hrrType
                            <p><h5>Prenatal HRR</h5></p>
                                $preNatalList
                                
                            
                            <p><h5>Natal HRR</h5></p>
                                $natalList
                                
                                    
                            <p><h5>PostNatal HRR</h5></p>
                               $postNatalList
                                    
                            <p><h5>Other HRR</h5></p>
                                $otherList
                                
                                
                        </td>
                        <td>
                            <p><h5>1st Screening</h5></p>
                                <p>$oaeright_pass$oaeright_Refer$oaeright_CNT</p>
                                <p>$oaeLeftPass$oaeleft_Refer$oaeleft_CNT</p>
                            <p><h5>2nd Screening</h5></p>    
                                <p>$oaeright_pass2</p>
                                <p>$oaeleft_pass2</p>
                        </td>
                        <td>
                            <p><h5>500Hz warble tones/NBN</h5></p>
                                <p>$nbn500_passone</p>
                                <p>$nbn500_passtwo</p>
                            <p><h5>4000Hz warble tones/NBN</h5></p>        
                                <p>$nbn4000_passone</p>
                                <p>$nbn4000_passtwo</p>
                            <p><h5>White noise</h5></p>        
                                <p>$whitenoisy_passone</p>
                                <p>$whitenoisy_passtwo</p>
                        </td>
                        <td>
                            <p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p>
                        </td>
                        <td>
                            <p>$acanal_normal</p>
                        </td>
                        <td>
                            <p>$moro_Present</p>
                            <p>$rooting_Present</p>
                            <p>$suck_Present</p>
                            <p>$tonic_Present</p>
                            <p>$palmar_Present</p>
                            <p>$planter_Present</p>
                            <p>$babinski_Present</p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>";
     $nbslist = getNbsList($patientDetail);
     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
    
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-3 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
                     $nbslist
                </div>
            
                <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
                    ".getOSCList($patientDetail)."
                </div>
                <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
            <div class='col-md-12 col-md-offset-8 form-group' id='' >
                <input type='text' id='nbsCheckedVal' hidden=''> 
                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
            </div>
            <div class='col-md-12 '>
                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
            </div>
        </div>
            
        ";
    
        echo "
            <!--<div class='col-md-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>POCD no.</th>
                            <th>Baby id</th>
                            <th>Baby name</th>
                            <th>Date of exam</th>
                        </tr>
                    
                        <tr>
                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
                        
                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>-->
        ";
    
    }
    elseif (!empty ($hrr) && !empty($screen1Query) && !empty($screen2Query) && !empty ($aabrPass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
        if(empty($aabrPass) || !empty($aabrPass)){
        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
        
        $hrrType  = ($patientDet["hrr_type"] == 1)?"<p><h4>Presence</h4></p>":"<p><h4>Absence</h4></p>";
        
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"<li>Excessive vomiting </li>":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"<li>Elderly Pregnancy </li>":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"<li>High/Low B.P</li>":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"<li>Blood Sugar</li>":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"<li>H/O Abortions </li>":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"<li>Rh Incompatibility</li>":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"<li>Viral/Bacterial infections </li>":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"<li>Oto toxic medications </li>":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"<li>Chemical fumes </li>":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"<li>Alcohol</li>":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"<li>Smoking </li>":"";
        
        $preNatalList = (empty($ex_Vomit) && empty($eld_Preg) && empty($baby_bp) && empty($blood_Sugar) && empty($baby_Abortion) && empty($baby_rh) && empty($viral_Infection) && empty($oto_Medication) && empty($chem_Fume) && empty($baby_alcohol) && empty($baby_smoke))?
                        "<h4>-</h4>":"<p>$ex_Vomit</p>
                                <p>$eld_Preg</p>
                                <p>$baby_bp</p>
                                <p>$blood_Sugar</p>
                                <p>$baby_Abortion</p>
                                <p>$baby_rh</p>
                                <p>$viral_Infection</p>
                                <p>$oto_Medication</p>
                                <p>$chem_Fume</p>
                                <p>$baby_alcohol</p>
                                <p>$baby_smoke</p>";
        
        $weight_Less = !empty($patientDetail["lbw"])?" <li><span class='panel-title'>Low Birth weight < 1.5kg:</span> {$patientDetail["birth_wt"]} Kg </li>":"-";
        $fetal_Distress = !empty($patientDetail["fd"])?"<li>Fetal distress</li>":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"<li>Birth asphyxia </li>":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatal Jaundice":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"<li>APGAR Score: 0-4 @ 1min</li>":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"<li>APGAR Score: 0-6@ 5min </li>":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"<li><span class='panel-title'>Neonatal Jaudice.</span><p> <span class='panel-title'>Bilirubin Level:</span>{$patientDetail["bilrubin_level"]} </p></li> ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"<li><span class='panel-title'>Delayed birth cry:</span> {$patientDetail["birthcrysec"]} sec </li>":"";
        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"<li><span class='panel-title'>NICU:</span> {$patientDetail["nicu_val"]} days </li>":"";
        $prematuredelWeek = !empty($patientDetail["nicu"])?"<li><span class='panel-title'>Premature Delivery:</span> {$patientDetail["premature_delivery_val"]} Week</li>":"";
        $aspirationFluid = !empty($patientDetail["aspiration_of_fluid_days"])?"<li>Aspiration of amniotic fluid</li>":"";
        
        $natalList = (empty($weight_Less) && empty($fetal_Distress) && empty($birth_Asphyxia) && empty($apg_Arone) && empty($apgarFive) && empty($bil_Level) && empty($baby_birthcry) && empty($baby_nicu) && empty($prematuredelWeek) && empty($aspirationFluid))?
                "<h4>-</h4>":"<p>$weight_Less</p>
                        <p>$fetal_Distress</p>
                        <p>$birth_Asphyxia</p>
                        <p>$apg_Arone</p>
                        <p>$apgarFive</p>
                        <p>$bil_Level</p>
                        <p>$baby_birthcry</p>
                        <p>$baby_nicu</p>
                        <p>$prematuredelWeek</p>
                        <p>$aspirationFluid</p>";
        
        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"<li>Craniofacial </li>":"";
        $co_Genital = !empty($patientDetail["csa"])?"<li>Congential anomalies </li>":"";
        $de_Generative = !empty($patientDetail["dd"])?"<li>Degenerative diseases </li>":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"<li>Viral/bacterial infections </li>":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"<li>Convulsions </li>":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"<li>Otitis Media with effusion </li>":"";
        $baby_trauma = !empty($patientDetail["thn"])?"<li>Trauma of head or neck </li>":"";
        
        $postNatalList = (empty($cranio_Facial) && empty($co_Genital) && empty($de_Generative) && empty($viral_Infect) && empty($baby_convulsions) && empty($baby_otitis) && empty($baby_trauma))?
                        "<h4>-</h4>":"<p>$cranio_Facial</p>
                            <p>$co_Genital</p>
                            <p>$de_Generative</p>
                            <p>$viral_Infect</p>
                            <p>$baby_convulsions</p>
                            <p>$baby_otitis</p>
                            <p>$baby_trauma</p>";
        
        $consPos = ($patientDetail["cons_pos_val"] == 1)?"'+'ve":"";
        $consNeg = ($patientDetail["cons_neg_val"] == 1)?"<li>'-'ve</li>":"";
        $consPos1 = ($patientDetail["conspos1"] == 1)?"1 degree":"";
        $consPos2 = ($patientDetail["conspos2"] == 1)?"2 degree":"";
        $consPos3 = ($patientDetail["conspos3"] == 1)?"3 degree":"";
        
        $consPosVal = !empty($consPos)?"><p><h6>Consanguinity</h6></p><li>$consPos($consPos1$consPos2$consPos3)</li>":"";
        
        $famPos = ($patientDetail["fam_his_pos"] == 1)?"'+'ve":"";
        $famNeg = ($patientDetail["fam_his_neg"] == 1)?"<li>'-'ve</li>":"";
        $famMat = ($patientDetail["fam_his_mat"] == 1)?"Maternal":"";
        $famPat = ($patientDetail["fam_his_pat"] == 1)?"Paternal":"";
        $famHi = ($patientDetail["fam_his_hi"] == 1)?"Hl":"";
        $famSp = ($patientDetail["fam_his_sp"] == 1)?"Sp":"";
        $famLg = ($patientDetail["fam_his_lg"] == 1)?"Lg":"";
        $famMd = ($patientDetail["fam_his_md"] == 1)?"MD":"";
        $famOth = ($patientDetail["fam_his_oth"] == 1)?"Other":"";
        
        $famPOsVal = !empty($famPos)?"<p><h6>Family History</h6></p><li>$famPos($famMat$famPat)($famHi$famSp$famLg$famMd$famOth)</li>":"";
        
        $otherList = (empty($consPosVal) && empty($consNeg) && empty($famPOsVal) && empty($famNeg))?"<h4>-</h4>":"<p>$consPosVal$consNeg</p>
                                <p>$famPOsVal$famNeg</p>";
//        $otherList = (empty($nbn500PassOne) && empty($nbn500PassTwo) && $nbn4000PassOne && $nbn4000PassTwo && $whiteNoisyPassOne && $whiteNoisyPassTwo)?"-":"";
        
        
        $hrrResult = ($patientDet["hrr_type"] == 2)?"":"<p><h5>Prenatal HRR</h5></p>
                                $preNatalList
                                
                            
                            <p><h5>Natal HRR</h5></p>
                                $natalList
                                
                                    
                            <p><h5>PostNatal HRR</h5></p>
                               $postNatalList
                                    
                            <p><h5>Other HRR</h5></p>
                                $otherList";
        
        
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $nbn500_passone = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500_passtwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL:Pass </li>":"";
        $nbn4000_passone = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL:Pass</li>":"";
        $nbn4000_passtwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $whitenoisy_passone = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whitenoisy_passtwo = !empty( $patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL:Pass</li>":"";
        
        
        
        $oaeright_pass = ( $patientDet["rt_screen1"] == 1)?"<li>Rt- Pass </li>":"";
        $oaeright_Refer = ( $patientDet["rt_screen1"] == 2)?"<li>Rt- Refer </li>":"";
        $oaeright_CNT = ( $patientDet["rt_screen1"] == 3)?"<li>Rt- CNT </li>":"";
        $oaeleft_pass = ( $patientDet["lt_screen1"] == 1)?"<li>Lt- Pass </li>":"";
        $oaeleft_Refer= ( $patientDet["lt_screen1"] == 2)?"<li>Lt- Refer</li>":"";
        $oaeleft_CNT= ( $patientDet["lt_screen1"] == 3)?"<li>Lt- CNT</li>":"";
        $oaeright_pass2 = ( $patientDet["rt_screen2"] == 1)?"<li>Rt- Pass </li>":"";
        $oaeright_refer2 = ( $patientDet["rt_screen2"] == 2)?"<li>Rt- Refer </li>":"";
        $oaeright_CNT2 = ( $patientDet["rt_screen2"] == 3)?"<li>Rt- CNT </li>":"";
        $oaeleft_pass2 = ( $patientDet["lt_screen2"] == 1)?"<li>Lt- Pass </li>":"";
        $oaeleft_refer2 = ( $patientDet["lt_screen2"] == 2)?"<li>Lt- Refer </li>":"";
        $oaeleft_CNT2 = ( $patientDet["lt_screen2"] == 3)?"<li>Lt- CNT </li>":"";
        
        
        $acanal_normal = !empty($patientDet["normal_val"])?"<li>Normal </li>":"";
        
        $moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suck_Present = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Sucking:</span> Present </li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic neck:</span> Present </li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present </li>":"";
        $planter_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present </li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
        
        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $bil_Level $baby_birthcry $prematuredelWeek $aspirationFluid"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $ $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "
        <div class='row'>
            <div class='col-md-5 impSel'>
                <h3><span class='label label-warning' >$msg1</span></h3>
            </div>
            <div class='col-md-5'>
                ".SelectImpresion($patient)."
            </div>
        </div>
        ";
    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
    mysql_query($updateatrisk2);
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #C97626'>
                        <th><h5>HRR Screening</h5></th>
                        <th><h5>OAE</h5></th>
                        <th><h5>BOA</h5></th>
                        <th><h5>AABR</h5></th>
                        <th class=''><h5>Acoustic analyses</h5></th>
                        <th class=''><h5>Primitive Reflexes</h5></th>
                    </tr>
                    <tr>
                        <td>$hrrType
                            $hrrResult
                                
                                
                        </td>
                        <td>
                            <p><h5>1st Screening</h5></p>
                                <p>$oaeright_pass$oaeright_Refer$oaeright_CNT</p>
                                <p>$oaeLeftPass$oaeleft_Refer$oaeleft_CNT</p>
                            <p><h5>2nd Screening</h5></p>    
                                <p>$oaeright_pass2$oaeright_refer2$oaeright_CNT2</p>
                                <p>$oaeleft_pass2$oaeleft_refer2$oaeleft_CNT2</p>
                        </td>
                        <td>
                            <p><li>Pass</li></p>
                        </td>
                        <td>
                            <p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p>
                        </td>
                        <td>
                            <p>$acanal_normal</p>
                        </td>
                        <td>
                            <p>$moro_Present</p>
                            <p>$rooting_Present</p>
                            <p>$suck_Present</p>
                            <p>$tonic_Present</p>
                            <p>$palmar_Present</p>
                            <p>$planter_Present</p>
                            <p>$babinski_Present</p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>";
     $nbslist = getNbsList($patientDetail);
     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
    
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-3 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
                     $nbslist
                </div>
            
                <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
                    ".getOSCList($patientDetail)."
                </div>
                <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
            <div class='col-md-12 col-md-offset-8 form-group' id='' >
                <input type='text' id='nbsCheckedVal' hidden=''> 
                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
            </div>
            <div class='col-md-12 '>
                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
            </div>
        </div>
            
        ";
    
        echo "
            <!--<div class='col-md-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>POCD no.</th>
                            <th>Baby id</th>
                            <th>Baby name</th>
                            <th>Date of exam</th>
                        </tr>
                    
                        <tr>
                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
                        
                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>-->
        ";
        }
    }
    elseif (!empty ($hrr) && !empty($screen1Query) && !empty($screen2Pass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
        if(empty($aabrPass) || !empty($aabrPass)){
        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
        
        $hrrType  = ($patientDet["hrr_type"] == 1)?"<p><h4>Presence</h4></p>":"<p><h4>Absence</h4></p>";
        
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"<li>Excessive vomiting </li>":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"<li>Elderly Pregnancy </li>":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"<li>High/Low B.P</li>":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"<li>Blood Sugar</li>":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"<li>H/O Abortions </li>":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"<li>Rh Incompatibility</li>":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"<li>Viral/Bacterial infections </li>":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"<li>Oto toxic medications </li>":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"<li>Chemical fumes </li>":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"<li>Alcohol</li>":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"<li>Smoking </li>":"";
        
        $preNatalList = (empty($ex_Vomit) && empty($eld_Preg) && empty($baby_bp) && empty($blood_Sugar) && empty($baby_Abortion) && empty($baby_rh) && empty($viral_Infection) && empty($oto_Medication) && empty($chem_Fume) && empty($baby_alcohol) && empty($baby_smoke))?
                        "<h4>-</h4>":"<p>$ex_Vomit</p>
                                <p>$eld_Preg</p>
                                <p>$baby_bp</p>
                                <p>$blood_Sugar</p>
                                <p>$baby_Abortion</p>
                                <p>$baby_rh</p>
                                <p>$viral_Infection</p>
                                <p>$oto_Medication</p>
                                <p>$chem_Fume</p>
                                <p>$baby_alcohol</p>
                                <p>$baby_smoke</p>";
        
        $weight_Less = !empty($patientDetail["lbw"])?" <li><span class='panel-title'>Low Birth weight < 1.5kg:</span> {$patientDetail["birth_wt"]} Kg </li>":"-";
        $fetal_Distress = !empty($patientDetail["fd"])?"<li>Fetal distress</li>":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"<li>Birth asphyxia </li>":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatal Jaundice":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"<li>APGAR Score: 0-4 @ 1min</li>":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"<li>APGAR Score: 0-6@ 5min </li>":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"<li><span class='panel-title'>Neonatal Jaudice.</span><p> <li><span class='panel-title'>Bilirubin Level:</span>{$patientDetail["bilrubin_level"]} </p></li> ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"<li><span class='panel-title'>Delayed birth cry:></span> {$patientDetail["birthcrysec"]} sec </li>":"";
        $baby_nicu = !empty($patientDetail["nicu"])?"<li><span class='panel-title'>NICU:</span> {$patientDetail["nicu_val"]} days </li>":"";
        $prematuredelWeek = !empty($patientDetail["premature_delivery_week"])?"<li><span class='panel-title'>Premature Delivery:</span> {$patientDetail["premature_delivery_val"]} Week</li>":"";
        $aspirationFluid = !empty($patientDetail["aspiration_of_fluid_days"])?"<li>Aspiration of amniotic fluid</li>":"";
        
        $natalList = (empty($weight_Less) && empty($fetal_Distress) && empty($birth_Asphyxia) && empty($apg_Arone) && empty($apgarFive) && empty($bil_Level) && empty($baby_birthcry) && empty($baby_nicu) && empty($prematuredelWeek) && empty($aspirationFluid))?
                "<h4>-</h4>":"<p>$weight_Less</p>
                        <p>$fetal_Distress</p>
                        <p>$birth_Asphyxia</p>
                        <p>$apg_Arone</p>
                        <p>$apgarFive</p>
                        <p>$bil_Level</p>
                        <p>$baby_birthcry</p>
                        <p>$baby_nicu</p>
                        <p>$prematuredelWeek</p>
                        <p>$aspirationFluid</p>";
        
        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"<li>Craniofacial </li>":"";
        $co_Genital = !empty($patientDetail["csa"])?"<li>Congential anomalies </li>":"";
        $de_Generative = !empty($patientDetail["dd"])?"<li>Degenerative diseases </li>":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"<li>Viral/bacterial infections </li>":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"<li>Convulsions </li>":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"<li>Otitis Media with effusion </li>":"";
        $baby_trauma = !empty($patientDetail["thn"])?"<li>Trauma of head or neck </li>":"";
        
        $postNatalList = (empty($cranio_Facial) && empty($co_Genital) && empty($de_Generative) && empty($viral_Infect) && empty($baby_convulsions) && empty($baby_otitis) && empty($baby_trauma))?
                        "<h4>-</h4>":"<p>$cranio_Facial</p>
                            <p>$co_Genital</p>
                            <p>$de_Generative</p>
                            <p>$viral_Infect</p>
                            <p>$baby_convulsions</p>
                            <p>$baby_otitis</p>
                            <p>$baby_trauma</p>";
        
        $consPos = ($patientDetail["cons_pos_val"] == 1)?"'+'ve":"";
        $consNeg = ($patientDetail["cons_neg_val"] == 1)?"<li>'-'ve</li>":"";
        $consPos1 = ($patientDetail["conspos1"] == 1)?"1 degree":"";
        $consPos2 = ($patientDetail["conspos2"] == 1)?"2 degree":"";
        $consPos3 = ($patientDetail["conspos3"] == 1)?"3 degree":"";
        
        $consPosVal = !empty($consPos)?"<p><h6>Consanguinity</h6></p><li>$consPos($consPos1$consPos2$consPos3)</li>":"";
        
        $famPos = ($patientDetail["fam_his_pos"] == 1)?"'+'ve":"";
        $famNeg = ($patientDetail["fam_his_neg"] == 1)?"<li>'-'ve</li>":"";
        $famMat = ($patientDetail["fam_his_mat"] == 1)?"Maternal":"";
        $famPat = ($patientDetail["fam_his_pat"] == 1)?"Paternal":"";
        $famHi = ($patientDetail["fam_his_hi"] == 1)?"Hl":"";
        $famSp = ($patientDetail["fam_his_sp"] == 1)?"Sp":"";
        $famLg = ($patientDetail["fam_his_lg"] == 1)?"Lg":"";
        $famMd = ($patientDetail["fam_his_md"] == 1)?"MD":"";
        $famOth = ($patientDetail["fam_his_oth"] == 1)?"Other":"";
        
        $famPOsVal = !empty($famPos)?"<p><h6>Family History</h6></p><li>$famPos($famMat$famPat)($famHi$famSp$famLg$famMd$famOth)</li>":"";
        
        $otherList = (empty($consPosVal) && empty($consNeg) && empty($famPOsVal) && empty($famNeg))?"<h4>-</h4>":"<p>$consPosVal$consNeg</p>
                                <p>$famPOsVal$famNeg</p>";
//        $otherList = (empty($nbn500PassOne) && empty($nbn500PassTwo) && $nbn4000PassOne && $nbn4000PassTwo && $whiteNoisyPassOne && $whiteNoisyPassTwo)?"-":"";
        
        
        $hrrResult = ($patientDet["hrr_type"] == 2)?"":"<p><h5>Prenatal HRR</h5></p>
                                $preNatalList
                                
                            
                            <p><h5>Natal HRR</h5></p>
                                $natalList
                                
                                    
                            <p><h5>PostNatal HRR</h5></p>
                               $postNatalList
                                    
                            <p><h5>Other HRR</h5></p>
                                $otherList";
        
        
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $nbn500_passone = !empty($patientDet["fivehz_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $nbn500_passtwo = !empty($patientDet["fivehz_50dBHL_pass"])?"<li>50dBHL:Pass </li>":"";
        $nbn4000_passone = !empty($patientDet["fourhz_80dBHL_pass"])?"<li>80dBHL:Pass</li>":"";
        $nbn4000_passtwo = !empty($patientDet["fourhz_50dBHL_pass"])?"<li>50dBHL: Pass</li>":"";
        $whitenoisy_passone = !empty($patientDet["whitenoise_80dBHL_pass"])?"<li>80dBHL: Pass</li>":"";
        $whitenoisy_passtwo = !empty( $patientDet["whitenoise_50dBHL_pass"])?"<li>50dBHL:Pass</li>":"";
        
        
        
        $oaeright_pass = ( $patientDet["rt_screen1"] == 1)?"<li>Rt- Pass </li>":"";
        $oaeright_Refer = ( $patientDet["rt_screen1"] == 2)?"<li>Rt- Refer </li>":"";
        $oaeright_CNT = ( $patientDet["rt_screen1"] == 3)?"<li>Rt- CNT </li>":"";
        $oaeleft_pass = ( $patientDet["lt_screen1"] == 1)?"<li>Lt- Pass </li>":"";
        $oaeleft_Refer= ( $patientDet["lt_screen1"] == 2)?"<li>Lt- Refer</li>":"";
        $oaeleft_CNT= ( $patientDet["lt_screen1"] == 3)?"<li>Lt- CNT</li>":"";
        $oaeright_pass2 = ( $patientDet["rt_screen2"] == 1)?"<li>Rt- Pass </li>":"";
        $oaeright_refer2 = ( $patientDet["rt_screen2"] == 2)?"<li>Rt- Refer </li>":"";
        $oaeright_CNT2 = ( $patientDet["rt_screen2"] == 3)?"<li>Rt- CNT </li>":"";
        $oaeleft_pass2 = ( $patientDet["lt_screen2"] == 1)?"<li>Lt- Pass </li>":"";
        $oaeleft_refer2 = ( $patientDet["lt_screen2"] == 2)?"<li>Lt- Refer </li>":"";
        $oaeleft_CNT2 = ( $patientDet["lt_screen2"] == 3)?"<li>Lt- CNT </li>":"";
        
        
        $acanal_normal = !empty($patientDet["normal_val"])?"<li>Normal </li>":"";
        
        $moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suck_Present = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Sucking:</span> Present </li>":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic neck:</span> Present </li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present </li>":"";
        $planter_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present </li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
        
        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $bil_Level $baby_birthcry $prematuredelWeek $aspirationFluid"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $ $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "
        <div class='row'>
            <div class='col-md-5 impSel'>
                <h3><span class='label label-warning' >$msg1</span></h3>
            </div>
            <div class='col-md-5'>
                ".SelectImpresion($patient)."
            </div>
        </div>
        ";
    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
    mysql_query($updateatrisk2);
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #C97626'>
                        <th><h5>HRR Screening</h5></th>
                        <th><h5>OAE</h5></th>
                        <th><h5>BOA</h5></th>
                        <th><h5>AABR</h5></th>
                        <th class=''><h5>Acoustic analyses</h5></th>
                        <th class=''><h5>Primitive Reflexes</h5></th>
                    </tr>
                    <tr>
                        <td>$hrrType
                            $hrrResult
                                
                                
                        </td>
                        <td>
                            <p><h5>1st Screening</h5></p>
                                <p>$oaeright_pass$oaeright_Refer$oaeright_CNT</p>
                                <p>$oaeLeftPass$oaeleft_Refer$oaeleft_CNT</p>
                            <p><h5>2nd Screening</h5></p>    
                                <p>$oaeright_pass2$oaeright_refer2$oaeright_CNT2</p>
                                <p>$oaeleft_pass2$oaeleft_refer2$oaeleft_CNT2</p>
                        </td>
                        <td>
                            <p><li>Pass</li></p>
                        </td>
                        <td>
                            <p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p>
                        </td>
                        <td>
                            <p>$acanal_normal</p>
                        </td>
                        <td>
                            <p>$moro_Present</p>
                            <p>$rooting_Present</p>
                            <p>$suck_Present</p>
                            <p>$tonic_Present</p>
                            <p>$palmar_Present</p>
                            <p>$planter_Present</p>
                            <p>$babinski_Present</p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>";
     $nbslist = getNbsList($patientDetail);
     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
    
    echo ""
    . "<div class='row'>
            <h4>Refer to...</h4>
            <!--<div class='col-md-12'> -->
                <div class='col-md-3 col-md-offset-1 form-group '>
                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
                </div>
                <div class='col-md-3 col-md-offset-1 form-group'>
                    <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
                </div>
            <!--</div>-->
            <div class='col-md-12 '>
                <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
                     $nbslist
                </div>
            
                <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
                    ".getOSCList($patientDetail)."
                </div>
                <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                    ".getAIISHList($patientDetail)."
                </div>
            </div>
            <div class='col-md-12 col-md-offset-8 form-group' id='' >
                <input type='text' id='nbsCheckedVal' hidden=''> 
                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
            </div>
            <div class='col-md-12 '>
                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
            </div>
        </div>
            
        ";
    
        echo "
            <!--<div class='col-md-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <th>POCD no.</th>
                            <th>Baby id</th>
                            <th>Baby name</th>
                            <th>Date of exam</th>
                        </tr>
                    
                        <tr>
                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
                        
                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
                        
                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
                        </tr>
                    </tbody>
                </table>    
            </div>-->
        ";
        }
    }
    else{
        $s12 = "select `imp_name` from `tbl_impression` where `imp_id`='2' ";
        $q12 = mysql_query($s12);
        $r12 = mysql_fetch_assoc($q12);
        $msg12 = $r12['imp_name'];
        
        $hrrType = ($patientDet["hrr_type"] == 1)?"<p><h4>Present<h4></p>":"<p><h4>Absent</h4></p>";
        
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"<li>Excessive vomiting</li>":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"<li>Elderly Pregnancy</li>":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"<li>High/Low B.P</li>":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"<li>Blood sugar</li>":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"<li>H/O abortions</li>":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"<li>Rh Incompatibility</li>":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"<li>Viral/Bacterial infections</li>":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"<li>Oto toxic medications</li>":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"<li>Chemical fumes</li>":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"<li>Alcohol</li>":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"<li>Smoking </li>":"";
        
        $preNatalList = (empty($ex_Vomit) && empty($eld_Preg) && empty($baby_bp) && empty($blood_Sugar) && empty($baby_Abortion) && empty($baby_rh) && empty($viral_Infection) && empty($oto_Medication) && empty($chem_Fume) && empty($baby_alcohol) && empty($baby_smoke))?
                        "<h4>-</h4>":"<p>$ex_Vomit</p>
                                <p>$eld_Preg</p>
                                <p>$baby_bp</p>
                                <p>$blood_Sugar</p>
                                <p>$baby_Abortion</p>
                                <p>$baby_rh</p>
                                <p>$viral_Infection</p>
                                <p>$oto_Medication</p>
                                <p>$chem_Fume</p>
                                <p>$baby_alcohol</p>
                                <p>$baby_smoke</p>";
        
        $weight_Less = !empty($patientDetail["lbw"])?"<li><span class='panel-title'>Low Birth weight > 1.5kgs. :</span>{$patientDetail["birth_wt"]}Kg</li> ":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"<li><span class='panel-title'>Neonatal Jaundice. Bilirubin Level: </span>{$patientDetail["bilrubin_level"]} </li> ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"<li><span class='panel-title'>Delayed birth cry :</span>{$patientDetail["birthcrysec"]} sec </li>":"";
        $prematuredelWeek = !empty($patientDetail["premature_delivery_week"])?"<li><span class='panel-title'>Premature Delivery:</span> {$patientDetail["premature_delivery_val"]} Week</li>":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"<li>Birth asphyxia</li>":"";
        $fetal_Distress = !empty($patientDetail["fd"])?"<li>Fetal distress</li>":"";
        $aspirationFluid = !empty($patientDetail["aspiration_of_fluid_days"])?"<li>Aspiration of amniotic fluid</li>":"";
        $baby_nicu = !empty($patientDetail["nicu"])?"<li><span class='panel-title'>NICU :</span>{$patientDetail["nicu_val"]} days</li>":"";
        //$baby_jaundice = !empty($patientDetail["nj"])?"<li>Neonatak Jaundice</li> ":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"<li>APGAR Score: 0-4 @ 1min</li>":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"<li>APGAR Score: 0-6@ 5min </li>":"";
        
        $natalList = (empty($weight_Less) && empty($fetal_Distress) && empty($birth_Asphyxia) && empty($apg_Arone) && empty($apgarFive) && empty($bil_Level) && empty($baby_birthcry) && empty($baby_nicu) && empty($prematuredelWeek) && empty($aspirationFluid))?
                "<h4>-</h4>":"<p>$weight_Less</p>
                        <p>$fetal_Distress</p>
                        <p>$birth_Asphyxia</p>
                        <p>$apg_Arone</p>
                        <p>$apgarFive</p>
                        <p>$bil_Level</p>
                        <p>$baby_birthcry</p>
                        <p>$baby_nicu</p>
                        <p>$prematuredelWeek</p>
                        <p>$aspirationFluid</p>";
        

//        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
//        $fetal_Distress = !empty  ($patientDetail["fd"])?"Fetal distress - ":"";
//        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
//        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
//        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
//        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
//        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
//        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
//        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
//        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
//        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
        $cranio_Facial = !empty($patientDetail["ca"])?"<li>Craniofacial anomalies</li>":"";
        $co_Genital = !empty($patientDetail["csa"])?"<li>Congenital anomalies</li> ":"";
        $de_Generative = !empty($patientDetail["dd"])?"<li>Degenerative diseases </li>":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"<li>Viral/bacterial infections </li>":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"<li>Convulsions </li>":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"<li>Otitis Media with effusion </li>":"";
        $baby_trauma = !empty($patientDetail["thn"])?"<li>Trauma of head or neck </li>":"";

        $postNatalList = (empty($cranio_Facial) && empty($co_Genital) && empty($de_Generative) && empty($viral_Infect) && empty($baby_convulsions) && empty($baby_otitis) && empty($baby_trauma))?
                        "<h4>-</h4>":"<p>$cranio_Facial</p>
                            <p>$co_Genital</p>
                            <p>$de_Generative</p>
                            <p>$viral_Infect</p>
                            <p>$baby_convulsions</p>
                            <p>$baby_otitis</p>
                            <p>$baby_trauma</p>";
        
        $consPos = ($patientDetail["cons_pos_val"] == 1)?"'+'ve":"";
        $consNeg = ($patientDetail["cons_neg_val"] == 1)?"<li>'-'ve</li>":"";
        $consPos1 = ($patientDetail["conspos1"] == 1)?"1 degree":"";
        $consPos2 = ($patientDetail["conspos2"] == 1)?"2 degree":"";
        $consPos3 = ($patientDetail["conspos3"] == 1)?"3 degree":"";
        
        $consPosVal = !empty($consPos)?"<p><h6>Consanguinity</h6></p><li>$consPos($consPos1$consPos2$consPos3)</li>":"";
        
        
        
        $famPos = ($patientDetail["fam_his_pos"] == 1)?"'+'ve":"";
        $famNeg = ($patientDetail["fam_his_neg"] == 1)?"<li>'-'ve</li>":"";
        $famMat = ($patientDetail["fam_his_mat"] == 1)?"Maternal":"";
        $famPat = ($patientDetail["fam_his_pat"] == 1)?"Paternal":"";
        $famHi = ($patientDetail["fam_his_hi"] == 1)?"Hl":"";
        $famSp = ($patientDetail["fam_his_sp"] == 1)?"Sp":"";
        $famLg = ($patientDetail["fam_his_lg"] == 1)?"Lg":"";
        $famMd = ($patientDetail["fam_his_md"] == 1)?"MD":"";
        $famOth = ($patientDetail["fam_his_oth"] == 1)?"Other":"";
        
        $famPOsVal = !empty($famPos)?"<p><h6>Family History</h6></p><li>$famPos($famMat$famPat)($famHi$famSp$famLg$famMd$famOth)</li>":"";
        
        $otherList = (empty($consPosVal) && empty($consNeg) && empty($famPOsVal) && empty($famNeg))?"<h4>-</h4>":"<p><h6>Consanguinity</h6></p><p>$consPosVal$consNeg</p>
                                <p><h6>Family History</h6></p><p>$famPOsVal$famNeg</p>";

//        //        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
//        $de_Generative = !empty($patientDetail["dd"])?"Degenerative diseas - ":"";
//        $viral_Infect = !empty($patientDetail["vbf"])?"Viral/bacterial infection - ":"";
//        $baby_convulsions = !empty($patientDetail["cnv"])?"Convilsions - ":"";
//        $baby_otitis = !empty($patientDetail["omwe"])?"Otitis Media with effusion - ":"";
//        $baby_trauma = !empty($patientDetail["thn"])?"Trauma of heador neck - ":"";
//        $nbn500_referone = !empty($patientDetail["fivehz_80dBHL_refer"])?"5000Hz warable Tone-Intensity 80dBHL Refer - ":"";
//        $nbn500_refertwo = !empty($patientDetail["fivehz_50dBHL_refer"])?"5000Hz warable Tone-Intensity 50dBHL refer -  - ":"";
//        $nbn4000_referone = !empty($patientDetail["fourhz_80dBHL_refer"])?"4000 warable Tone-Intensity 80dBHL Refer -  - ":"";
//        $nbn4000_refertwo = !empty($patientDetail["fourhz_50dBHL_refer"])?"5000Hz warable Tone-Intensity 50dBHL Refer -  - ":"";
//        $whitenoisy_referone = !empty($patientDetail["whitenoise_80dBHL_refer"])?"White noise-Intensity80dBHL Refer - ":"";
//        $whitenoisy_refertwo = !empty( $patientDetail["whitenoise_50dBHL_refer"])?"White noise-Intensity50dBHL Refer- ":"";
//        
//        $sceen1rtRefer = !empty( $patientDetail["rt_refer"])?"Screenone right refer ":"";
//        $sceen1ltRefer = !empty( $patientDetail["lt_refer"])?"Screenone left refer ":"";
//        $sceen2rtRefer = !empty( $patientDetail["rt_two_refer"])?"Screen two right refer ":"";
//        $sceen2ltRefer = !empty( $patientDetail["lt_two_refer"])?"Screen two left refer ":"";
        
        //$fetch_patientDet = ($patientDet["hrr_type"] == 1)?"$patientDetail":"$patientDet";
        
        
        
        $nbn500_passone = !empty($patientDet["fivehz_80dBHL_pass"])?"pass":"";
        $nbn500_passtwo = !empty($patientDet["fivehz_50dBHL_pass"])?"pass":"";
        $nbn4000_passone = !empty($patientDet["fourhz_80dBHL_pass"])?"pass":"";
        $nbn4000_passtwo = !empty($patientDet["fourhz_50dBHL_pass"])?"pass":"";
        $whitenoisy_passone = !empty($patientDet["whitenoise_80dBHL_pass"])?"pass":"";
        $whitenoisy_passtwo = !empty( $patientDet["whitenoise_50dBHL_pass"])?"pass":"";
        
        $nbn500_referone = !empty($patientDet["fivehz_80dBHL_refer"])?"refer":"";
        $nbn500_refertwo = !empty($patientDet["fivehz_50dBHL_refer"])?"refer":"";
        $nbn4000_referone = !empty($patientDet["fourhz_80dBHL_refer"])?"refer":"";
        $nbn4000_refertwo = !empty($patientDet["fourhz_50dBHL_refer"])?"refer":"";
        $whitenoisy_referone = !empty($patientDet["whitenoise_80dBHL_refer"])?"refer":"";
        $whitenoisy_refertwo = !empty( $patientDet["whitenoise_50dBHL_refer"])?"refer":"";
        
        if($nbn500_referone || $nbn500_refertwo){
            $nbn500refer = "refer";
        }
        elseif($nbn500PassOne || $nbn500_passtwo){
            if($nbn500_passone == 'pass' && $nbn500_passtwo == 'pass'){$nbn500pass="pass";}
            elseif($nbn500_passone == 'pass' && $nbn500_passtwo == '' && $nbn500_refertwo == ''){$nbn500pass="pass";}
            elseif($nbn500_passone == '' && $nbn500_passtwo == 'pass' && $nbn500_referone == ''){$nbn500pass="pass";}
        }
        
        if($nbn4000_referone || $nbn4000_refertwo){
            $nbn4000refer = "refer";
        }
        elseif($nbn4000_passone || $nbn4000_passtwo){
            if($nbn4000_passone == 'pass' && $nbn4000_passtwo == 'pass'){$nbn4000pass="pass";}
            elseif($nbn4000_passone == 'pass' && $nbn4000_passtwo == '' && $nbn4000_refertwo == ''){$nbn4000pass="pass";}
            elseif($nbn4000_passone == '' && $nbn4000_passtwo == 'pass' && $nbn4000_refertwo == ''){$nbn4000pass="pass";}
        }
        if($whitenoisy_referone || $whitenoisy_refertwo){
            $whitenoisyrefer = "refer";
        }
        elseif($whitenoisy_passone || $whitenoisy_passtwo){
            if($whitenoisy_passone == 'pass' && $whitenoisy_passtwo == 'pass'){$whitenoisypass="pass";}
            elseif($whitenoisy_passone == 'pass' && $whitenoisy_passtwo == '' && $whitenoisy_refertwo == ''){$whitenoisypass="pass";}
            elseif($whitenoisy_passone == '' && $whitenoisy_passtwo == 'pass' && $whitenoisy_refertwo == ''){$whitenoisypass="pass";}
        }
        
        if($nbn500refer || $nbn4000refer || $whitenoisyrefer){
            $boaResult = "Refer";
        }
        elseif($nbn500pass || $nbn4000pass || $whitenoisypass){
            $boaResult = "Pass";
        }
        
        $aabrRtearPass = !empty($patientDet["aabr_rt_pass"])?"<li>Pass</li>":"";
        $aabrLtearPass = !empty($patientDet["aabr_lt_pass"])?"<li>Pass</li>":"";
        $aabrRtearRefer = !empty($patientDet["aabr_rt_refer"])?"<li>Refer</li>":"";
        $aabrLtearRefer = !empty($patientDet["aabr_lt_refer"])?"<li>Refer</li>":"";
        $aabrRtearCNT = !empty($patientDet["aabr_rt_cnt_noisy"])?"<li>CNT</li>":"";
        $aabrLtearCNT= !empty($patientDet["aabr_lt_cnt_noisy"])?"<li>CNT</li>":"";
        
        $aabrResult = !empty($aabrRtearPass || $aabrLtearPass || $aabrRtearRefer || $aabrLtearRefer || $aabrRtearCNT || $aabrLtearCNT)?"<p><h5>Rt ear</h5></p>
                                <p><ul>$aabrRtearPass
                                $aabrRtearRefer
                                $aabrRtearCNT</ul></p>
                            <p><h5>Lt ear</h5></p>
                                <p><ul>$aabrLtearPass
                                $aabrLtearRefer
                                $aabrLtearCNT</ul></p>":"<h3>-</h3>";
        
        $oaeright_pass = ($patientDet["rt_screen1"]==1)?"<li>Rt Pass </li>":"";
        $oaeleft_pass = ( $patientDet["lt_screen1"] == 1)?"<li>Lt Pass </li>":"";
        $oaeright_pass2 = ( $patientDet["rt_screen2"] == 1)?"<li>Rt Pass </li>":"";
        $oaeleft_pass2 = ( $patientDet["lt_screen2"] == 1)?"<li>Lt Pass </li>":"";
        $oaeright_refer = ( $patientDet["rt_screen1"] == 2)?"<li>Rt Refer </li>":"";
        $oaeleft_refer = ( $patientDet["lt_screen1"] == 2)?"<li>Lt Refer</li>":"";
        $oaeright_refer2 = ( $patientDet["rt_screen2"] == 2)?"<li>Rt Refer</li>":"";
        $oaeleft_refer2 = ( $patientDet["lt_screen2"] == 2)?"<li>Lt Refer</li>":"";
        $oaeright_cnt = ( $patientDet["rt_screen1"] == 3)?"<li>Rt CNT </li>":"";
        $oaeleft_cnt = ( $patientDet["lt_screen1"] == 3)?"<li>Lt CNT</li>":"";
        $oaeright_cnt2 = ( $patientDet["rt_screen2"] == 3)?"<li>Rt CNT</li>":"";
        $oaeleft_cnt2 = ( $patientDet["lt_screen2"] == 3)?"<li>Lt CNT</li>":"";
        
        
        $acanal_abnormal = ($patientDet["abnormal_val"] == 1)?" Abnormal ":"Normal";
        
        $moro_Present = !empty($patientDet["moro_pre"])?"<li><span class='panel-title'>Moro:</span> Present</li>":"";
        $rooting_Present = !empty($patientDet["root_pre"])?"<li><span class='panel-title'>Rooting:</span> Present</li>":"";
        $suck_Present = !empty($patientDet["suck_pre"])?"<li><span class='panel-title'>Sucking:</span> Present</li>":"";
        //$root_Present = !empty($patientDetail["root_pre"])?"sucking Present":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"<li><span class='panel-title'>Tonic neck:</span> Present</li>":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"<li><span class='panel-title'>Palmar:</span> Present</li>":"";
        $planter_Present = !empty($patientDet["plantar_pre"])?"<li><span class='panel-title'>Plantar:</span> Present</li>":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"<li><span class='panel-title'>Babinski:</span> Present</li>":"";
        
        $moro_Absent = !empty($patientDet["moro_abs"])?"<li><span class='panel-title'>Moro:</span> Absent </li>":"";
        $rooting_Absent = !empty($patientDet["root_abs"])?"<li><span class='panel-title'>Rooting:</span> Absent </li> ":"";
        $suck_Absent = !empty($patientDet["suck_abs"])?"<li><span class='panel-title'>Sucking:</span> Absent </li> ":"";
        //$root_Absent = !empty($patientDetail["root_abs"])?"sucking absent - ":"";
        $tonic_Absent = !empty($patientDet["tonicneck_abs"])?"<li><span class='panel-title'>Tonic neck:</span> Absent </li> ":"";
        $palmar_Absent = !empty($patientDet["palmar_abs"])?"<li><span class='panel-title'>Palmar:</span> Absent </li> ":"";
        $planter_Absent = !empty($patientDet["plantar_abs"])?"<li><span class='panel-title'>Plantar:</span> Absent </li> ":"";
        $babinski_Absent = !empty($patientDet["babinski_abs"])?"<li><span class='panel-title'>Babinski:</span> Absent </li> ":"";
        
        $impresnRemark = "1$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
            . "$baby_nicu $prematuredelWeek $aspirationFluid  $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_referone $nbn500_refertwo $nbn4000_referone $nbn4000_refertwo $whitenoisy_referone"
            . "$whitenoisy_refertwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $oaeright_refer $oaeleft_refer $oaeright_refer2 $oaeleft_refer2 $oaeright_cnt $oaeleft_cnt $oaeright_cnt2 $oaeleft_cnt2 $acanal_abnormal"
            . "$Moro_Present $moro_Absent $rooting_Present $rooting_Absent $suck_Present $suck_Absent $ $tonic_Present $tonic_Absent $palmar_Present $palmar_Absent $plantar_Present $planter_Absent $babinski_Present $babinski_Absent" ;
    
    
            
    $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
    mysql_query($updateImprRemark);
    
    
    $updateatrisk1 = "UPDATE `patient` SET `test_impression` ='2' WHERE `Patient_Id` = '$patient'";
    echo "
        <div class='row'>
            <div class='col-md-12'>
                <div class='col-md-6 impSel'>
                    <h3><span class='label label-danger' >$msg12</span></h3>
                </div>
                <div class='col-md-5'>
                    ".SelectImpresion($patient)."
                </div>
            </div>
        
         ";
    
    $hrrTest = ($patientDet["hrr_type"] == 1)?"
                            <p><h5>Prenatal HRR</h5></p>
                                $preNatalList
                            
                            <p><h5>Natal HRR</h5></p>
                                $natalList
                            
                            <p><h5>PostNatal HRR</h5></p>
                                $postNatalList
                            
                           <p><h5>Other HRR</h5></p>
                                $otherList
                        </td>":"";
    
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr style='background-color: #d44'>
                        <th><h4>HRR Screening</h4></th>
                        <th><h4>OAE</h4></th>
                        <th><h4>BOA</h4></th>
                        <th><h4>AABR</h4></th>
                        <th class=''><h4>Acoustic Analysis</h4></th>
                        <th class=''><h4>Primitive Reflexes</h4></th>
                    </tr>
                    <tr>
                        <td><h4>$hrrType</h4>
                          $hrrTest  
                        <td>
                            <p><h5>1st Screening</h5></p>
                                <p><ul>$oaeright_pass
                                $oaeleft_pass
                                $oaeright_refer
                                $oaeleft_refer
                                $oaeright_cnt
                                $oaeleft_cnt</ul></p>
                            <p><h5>2nd Screening</h5></p> 
                                <p><ul>$oaeright_pass2
                                $oaeleft_pass2
                                $oaeright_refer2
                                $oaeleft_refer2
                                $oaeright_cnt2
                                $oaeleft_cnt2</ul></p>
                        </td>
                        <td>
                            <p>$boaResult</p>
                        </td>
                        <td>
                            $aabrResult
                        </td>
                        <td>
                            <p>$acanal_abnormal</p>
                        </td>
                        <td>
                            <p><ul>$moro_Present
                            $rooting_Present
                            $suck_Present
                            $tonic_Present
                            $palmar_Present
                            $planter_Present
                            $babinski_Present
                            $moro_Absent
                            $rooting_Absent
                            $suck_Absent
                            $tonic_Absent
                            $palmar_Absent
                            $planter_Absent
                            $babinski_Absent</ul></p>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>


    ";
    mysql_query($updateatrisk1);
    
    $nbslist = getNbsList($patientDetail);
//    $osclist = getOSCList();
    
    $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
        echo ""
        . "<div class='row'>
                <h4>Refer to...</h4>
                <!--<div class='col-md-12'> -->
                    <div class='col-md-3 col-md-offset-1 form-group '>
                        <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
                    </div>
                    <div class='col-md-3 col-md-offset-1 form-group'>
                        <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
                    </div>
                    <div class='col-md-3 col-md-offset-1 form-group'>
                        <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
                    </div>
                <!--</div>-->
                <div class='col-md-12 '>
                    <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
                         $nbslist
                    </div>

                    <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
                        ".getOSCList($patientDetail)."
                    </div>
                    <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
                        ".getAIISHList($patientDetail)."
                    </div>
                    <div class='col-md-12 col-md-offset-8 form-group' id='' >
                        <input type='text' id='nbsCheckedVal' hidden='' value=''> 
                        <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
                    </div>
                </div>
                
            </div>
            
        ";
    }
    
}


function getPfupBymnth($pID, $mnth){
    $qry_pfup = "SELECT `pfup_id`, `Patient_Id`, `pfup_remark`, `pfup_month` FROM `tbl_phonef_up` WHERE `Patient_Id` = '$pID' AND `pfup_month` = '$mnth'";
    $result = mysql_query($qry_pfup);
    $data = mysql_fetch_assoc($result);
    
    return $data;
    
}

//Submit Role
function SubmitRole($POST, $GET){
    $formData = "";
    $status = FALSE;
    
    if(isset($GET["create-role"]) && is_numeric(decode($GET["create-role"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $role_id = decode($GET["create-role"]);
        
        $qry_1 = "UPDATE `user_role_tb` SET `role_status` = '$st' WHERE `role_id` = '$role_id' ";
        mysql_query($qry_1);
        $status = TRUE;
    }else if( isset($GET["create-role"]) && is_numeric(decode($GET["create-role"])) && !isset($GET["st"]) ){
        $id =  decode($GET["create-role"]);
        $formData = getUserRoleByID($id);
        
        $status = FALSE;
    }    
    
    
    if($status){
        if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....";
        }else{
            mysql_query($qry_1);
            $_SESSION["su"] = "Task Completed ....".$qry_1;       
        }
        redirect(HostRoot."create-role");
    }
    
    return $formData;
}



// Role List

function getRoleList(){
    $data = "";
    
    $qry_role = "SELECT `role_id`, `role_type`, `role_status`, `role_created_on`, `role_updated_on`, `role_created_by`, `role_updated_by` FROM `user_role_tb`";
    $result_role = mysql_query($qry_role);
    
    while($rw_role = mysql_fetch_array($result_role)){
        $ID = encode($rw_role["role_id"]);
        $st = ($rw_role['role_status'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");        
        $roleCreatedBy = !empty($rw_role["role_created_by"])?"".getAuthNameByID(encode($rw_role["role_created_by"]))."(". getRoleNameByAuthID(encode($rw_role["role_created_by"])).")":"";
        $roleUpdateBy = !empty($rw_role["role_updated_by"])?"".getAuthNameByID(encode($rw_role["role_updated_by"]))."(". getRoleNameByAuthID(encode($rw_role["role_updated_by"])).")":"";
        $data .= "
            <tr>
                <td>{$rw_role["role_type"]}</td>
                <td>{$rw_role["role_created_on"]}</td>
                <td>{$roleCreatedBy}</td>
                <td>{$rw_role["role_updated_on"]}</td>
                <td>{$roleUpdateBy}</td>
                <td>".getStatusInfo($rw_role["role_status"])."</td>
                <td><a href='".HostRoot."create-role/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                    <a href='".HostRoot."create-role/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a></td>
            </tr>

        ";
    }
    return $data;
}

//Submit State
function SubmitState($POST, $GET){
    $formData = "";
    $status = FALSE;
    
    if(isset($POST["submitStateInfo"])){
        $statename = strip_tags($POST["stateName"]);
        $stateId = strip_tags($POST["stateId"]);
        
        if(empty($stateId)){
            $qry_1 = "INSERT INTO `tbl_states` (`statename`, `state_created_on`, `state_created_by`) VALUES('$statename', NOW(), '".USERAUTH."')";
        }
        else{
            $qry_1 = "UPDATE `tbl_states` SET `statename` = '$statename', `state_created_on` = NOW(), `state_updated_by` = '".USERAUTH."' WHERE `state_id` = '$stateId' ";
        }
        //mysql_query($qry_1);
        
        $status = TRUE;
    }else if(isset($GET["add-state"]) && is_numeric(decode($GET["add-state"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $state_id = decode($GET["add-state"]);
        
        $qry_1 = "UPDATE `tbl_states` SET `state_status` = '$st' WHERE `state_id` = '$state_id' ";
        $status = TRUE;
    }else if( isset($GET["add-state"]) && is_numeric(decode($GET["add-state"])) && !isset($GET["st"]) ){
        $id =  decode($GET["add-state"]);
        $formData = getStateListsByID($id);
        
        $status = FALSE;
    }    
    
    
    if($status){
        if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....".$qry_1;
        }else{
            mysql_query($qry_1);
            $_SESSION["su"] = "Task Completed ....".$qry_1;       
        }
        redirect(HostRoot."add-state");
    }
    
    return $formData;
}

function getStateList(){
    $data = "";
    
    $qry_state = "SELECT `state_id`, `statename`, `state_status`, `state_created_by`, `state_created_on`, `state_updated_by`, `state_updated_on` FROM `tbl_states` ORDER BY `state_id`";
    $result_state = mysql_query($qry_state);
    
    while($rw_state = mysql_fetch_array($result_state)){
        $ID = encode($rw_state["state_id"]);
        $st = ($rw_state['state_status'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");        
        $stateCreatedBy = !empty($rw_state["state_created_by"])?"".getAuthNameByID(encode($rw_state["state_created_by"]))."(". getRoleNameByAuthID(encode($rw_state["state_created_by"])).")":"";
        $stateUpdateBy = !empty($rw_state["role_updated_by"])?"".getAuthNameByID(encode($rw_state["state_updated_by"]))."(". getRoleNameByAuthID(encode($rw_state["state_updated_by"])).")":"";
        $data .= "
            <tr>
                <td>{$rw_state["statename"]}</td>
                <td>{$stateCreatedBy}</td>
                <td>{$rw_state["state_created_on"]}</td>
                <td>{$rw_state["state_updated_on"]}</td>
                <td>{$stateUpdateBy}</td>
                <td>".getStatusInfo($rw_state["state_status"])."</td>
                <td><a href='".HostRoot."add-state/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                    <a href='".HostRoot."add-state/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a></td>
            </tr>

        ";
    }
    return $data;
}

//Submit District
function SubmitDistrict($POST, $GET){
    $formData = "";
    $status = FALSE;
    
    if(isset($POST["submitDistInfo"])){
        $distName = strip_tags($POST["distname"]);
        $stateId = strip_tags($POST["state"]);
        $distId = strip_tags($POST["district_id"]);
        
        if(empty($distId)){
            $qry_1 = "INSERT INTO `tbl_districts` (`distname`, `state_id`, `dist_created_on`, `dist_created_by`) VALUES('$distName', '$stateId', NOW(), '".USERAUTH."')";
        }
        else{
            $qry_1 = "UPDATE `tbl_districts` SET `distname` = '$distName', `state_id` = '$stateId', `dist_updated_on` = NOW(), `dist_updated_by` = '".USERAUTH."' WHERE `dist_id` = '$distId' ";
        }
        //mysql_query($qry_1);
        
        $status = TRUE;
    }else if(isset($GET["add-district"]) && is_numeric(decode($GET["add-district"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $district_id = decode($GET["add-district"]);
        
        $qry_1 = "UPDATE `tbl_districts` SET `dist_status` = '$st' WHERE `dist_id` = '$district_id' ";
        $status = TRUE;
    }else if( isset($GET["add-district"]) && is_numeric(decode($GET["add-district"])) && !isset($GET["st"]) ){
        $id =  decode($GET["add-district"]);
        $formData = getDistrictListsByID($id);
        
        $status = FALSE;
    }    
    
    
    if($status){
        if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....".$qry_1;
        }else{
            mysql_query($qry_1);
            $_SESSION["su"] = "Task Completed ....".$qry_1;       
        }
        redirect(HostRoot."add-district");
    }
    
    return $formData;
}

function getDistrictList(){
    $data = "";
    
    $qry_dist = "SELECT `dist_id`, `state_id`, `distname`, `dist_status`, `dist_created_on`, `dist_created_by`, `dist_updated_on`, `dist_updated_by` FROM `tbl_districts`";
    $result_dist = mysql_query($qry_dist);
    
    while($rw_dist= mysql_fetch_array($result_dist)){
        $ID = encode($rw_dist["dist_id"]);
        $st = ($rw_dist['dist_status'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");        
        $distCreatedBy = !empty($rw_dist["dist_created_by"])?"".getAuthNameByID(encode($rw_dist["dist_created_by"]))."(". getRoleNameByAuthID(encode($rw_dist["dist_created_by"])).")":"";
        $distUpdateBy = !empty($rw_dist["dist_updated_by"])?"".getAuthNameByID(encode($rw_dist["dist_updated_by"]))."(". getRoleNameByAuthID(encode($rw_dist["dist_updated_by"])).")":"";
        $data .= "
            <tr>
                <td>{$rw_dist["distname"]}</td>
                <td>".getStateNameByStateId($rw_dist["state_id"])."</td>
                <td>{$distCreatedBy}</td>
                <td>{$rw_dist["dist_created_on"]}</td>
                <td>{$rw_dist["dist_updated_on"]}</td>
                <td>{$distUpdateBy}</td>
                <td>".getStatusInfo($rw_dist["dist_status"])."</td>
                <td><a href='".HostRoot."add-district/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                    <a href='".HostRoot."add-district/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a></td>
            </tr>

        ";
    }
    return $data;
}

//Submit Taluk
function SubmitTaluk($POST, $GET){
    $formData = "";
    $status = FALSE;
    
    if(isset($POST["submitTalqInfo"])){
        $talqName = strip_tags($POST["talqname"]);
        $stateId = strip_tags($POST["state"]);
        $distId = strip_tags($POST["district"]);
        $talqId = strip_tags($POST["talq_id"]);
        
        if(empty($talqId)){
            $qry_1 = "INSERT INTO `tbl_cities` (`cityname`, `dist_id`, `state_id`, `city_created_on`, `city_created_by`) VALUES('$talqName', '$stateId', '$distId', NOW(), '".USERAUTH."')";
        }
        else{
            $qry_1 = "UPDATE `tbl_cities` SET `cityname` = '$talqName', `dist_id` = '$distId', `state_id` = '$stateId', `city_updated_on` = NOW(), `city_updated_by` = '".USERAUTH."' WHERE `city_id` = '$talqId' ";
        }
        //mysql_query($qry_1);
        
        $status = TRUE;
    }else if(isset($GET["add-taluk"]) && is_numeric(decode($GET["add-taluk"])) && isset($GET["st"]) && is_numeric($GET["st"])){
        $st = strip_tags($GET["st"]);
        $taluk_id = decode($GET["add-taluk"]);
        
        $qry_1 = "UPDATE `tbl_cities` SET `city_status` = '$st' WHERE `city_id` = '$taluk_id' ";
        $status = TRUE;
    }else if( isset($GET["add-taluk"]) && is_numeric(decode($GET["add-taluk"])) && !isset($GET["st"]) ){
        $id =  decode($GET["add-taluk"]);
        $formData = getTalukListsByID($id);
        
        $status = FALSE;
    }    
    
    
    if($status){
        if(mysql_errno()){
            $_SESSION["er"] = "Unexpected Error found while processing this task....".$qry_1;
        }else{
            mysql_query($qry_1);
            $_SESSION["su"] = "Task Completed ....".$qry_1;       
        }
        redirect(HostRoot."add-taluk");
    }
    
    return $formData;
}

function getTalukList(){
    $data = "";
    
    $qry_talq = "SELECT `city_id`, `cityname`, `dist_id`, `state_id`, `city_status`, `city_created_on`, `city_created_by`, `city_updated_on`, `city_updated_by` FROM `tbl_cities`";
    $result_talq = mysql_query($qry_talq);
    
    while($rw_talq = mysql_fetch_array($result_talq)){
        $ID = encode($rw_talq["city_id"]);
        $st = ($rw_talq['city_status'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");        
        $cityCreatedBy = !empty($rw_talq["city_created_by"])?"".getAuthNameByID(encode($rw_talq["city_created_by"]))."(". getRoleNameByAuthID(encode($rw_talq["city_created_by"])).")":"";
        $ciyUpdateBy = !empty($rw_talq["city_updated_by"])?"".getAuthNameByID(encode($rw_talq["city_updated_by"]))."(". getRoleNameByAuthID(encode($rw_talq["city_updated_by"])).")":"";
        $data .= "
            <tr>
                <td>{$rw_talq["cityname"]}</td>
                <td>".getStateNameByStateId($rw_talq["state_id"])."</td>
                <td>".getDistNameByDistId($rw_talq["dist_id"])."</td>
                <td>{$cityCreatedBy}</td>
                <td>{$rw_talq["city_created_on"]}</td>
                <td>{$rw_talq["city_updated_on"]}</td>
                <td>{$ciyUpdateBy}</td>
                <td>".getStatusInfo($rw_talq["city_status"])."</td>
                <td><a href='".HostRoot."add-taluk/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                    <a href='".HostRoot."add-taluk/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a></td>
            </tr>

        ";
    }
    return $data;
}

function pagesList(){
    $data = "";
    $index = 1;
    $directry = opendir("".HostRoot."assets/pages/");
    while ($file = readdir($directry)) { 
        if (eregi("\.php",$file)) { # Look at only files with a .php extension
          $data .= "<tr>
                        <td>$index</td>
                        <td>$file</td>
                        <td><div class='col-md-6'><select class='form-control' name='roles'><option disabled selected value>Select Role</option>".getRoleSelectList()."</select></div></td>
                        <td>
                            <label class='control-label radio-inline'><input type='radio' size='' name='gender' class=' ' id='male' value='male' disabled=''  >View</label>
                            <label class='control-label radio-inline'><input type='radio' size='' name='gender' class=' ' id='male' value='male' disabled=''  >Edit</label>
                        </td>    
                    </tr>
              
                    ";
//          $phpPages .= "<tr><td>$file</td>";
//          $roleSelList .= "<td><select name='roles'>".getRoleSelectList()."</select></td>";
//          $permission .="View</tr>"; 
          $index++;
        }
    }
    
    return $data;
}


//Fetch files 

function getFileList(){
    $data = "";
    $qry_1 = "SELECT * FROM `test_image`";
    $result = mysql_query($qry_1);
    while($rw = mysql_fetch_array($result)){
//        header("Content-type:audio/mpeg");
//        header("Content-Disposition: attachment; filename=' $rw[image];'");
        $data .= ""
                . "<p>File Name: {$rw["name"]}</p>"
                . "<p>
                    <audio controls src='" . getEmbeddedAudioSrc('mp3', $rw['image']) . "'>
                  </p>";
    }
    return $data;
}

function getEmbeddedAudioSrc($type, $data) { 
   return 'data:audio/' . $type . ';base64,' . base64_encode($data); 
}