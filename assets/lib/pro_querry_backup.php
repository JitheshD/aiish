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




function getUserList(){
    $data = ""; $index = 1;
    $result = mysql_query("SELECT * FROM `users`");    
    while($value = mysql_fetch_array($result)){
        $ID = encode($value["userId"]);
        $st = ($value['userStatus'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");
        //$st = ($value['userStatus'] == 1) ? array("st"=>"2", "name"=>"Inactive") : array("st"=>"1", "name"=>"Active");
        $Action = (USERAUTH == '1')? "<td>
                            <a href='".HostRoot."registration/{$ID}'><i class='fa fa-gears'></i> Edit</a> &nbsp;|&nbsp;
                            <a href='".HostRoot."userlist/{$ID}/st/{$st["st"]}'><i class='fa fa-trash-o'></i> {$st["name"]}</a> &nbsp;|&nbsp;
                        </td>":"";
        $data .= ""
                . "<tr>
                        <td>{$value["userEmail"]}</td>
                        <td>{$value["userName"]}</td>
                        <td>".getStatusInfo($value["userStatus"])."</td>
                        $Action
                    </tr>";
        $index++;
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
        $data .="
            <tr>
                <td>$count</td>
                <td>{$rw["Baby_name"]}</td>
                <td>{$rw["baby_id_num"]}</td>
                <td>{$rw["POCD_No"]}</td>
                <td>{$rw["Phone_number"]}</td>    
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
        $qryPatient = "SELECT `Hospital_Name`, `Delivery_type_Name`, `Patient_Id`, `baby_id_num`, `Baby_name`, `POCD_No`, `Date_of_Birth`, `Age`, `Gender`, `Father_name`, `Mother_name`, `Religion`, `Present_address`, `Permanent_address`, `Phone_number`, `Email_id`, `user_name`, `state_id`, `district_id`, `city_id`, `test_impression`, `impresn_remmark`, `patient_status`, `Date_of_HRR_Screen`, `Caste` FROM `patient` WHERE `Patient_Id` = '{$patiet_id}'";
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
    echo $qry_1;
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
    
    if($patientDet["rt_screen1"] == 1 && $patientDet["lt_screen1"] == 1){
        $screen1Pass = "Pass";
    }
    elseif ($patientDet["rt_screen1"] == 1 && empty($patientDet["lt_screen1"])) {
        $screen1Pass = "Pass";
    }
    elseif (empty($patientDet["rt_screen1"]) && $patientDet["lt_screen1"] == 1) {
        $screen1Pass = "Pass";
    }
    if($patientDet["rt_screen2"] == 1 && $patientDet["lt_screen2"] == 1){
        $screen2Pass = "Pass";
    }
    elseif ($patientDet["rt_screen2"] == 1 && empty($patientDet["lt_screen2"])) {
        $screen2Pass = "Pass";
    }
    elseif (empty($patientDet["rt_screen2"]) && $patientDet["lt_screen2"] == 1) {
        $screen2Pass = "Pass";
    }
    if($patientDet["fivehz_80dBHL_pass"] == 1 || $patientDet["fivehz_50dBHL_pass"] == 1 || $patientDet["fourhz_80dBHL_pass"] == 1 || $patientDet["fourhz_50dBHL_pass"] == 1 || $patientDet["whitenoise_80dBHL_pass"] == 1 || ($patientDet["whitenoise_50dBHL_pass"] == 1 && empty($patientDet["whitenoise_50dBHL_refer"]))){
        if(empty($patientDet["fivehz_80dBHL_refer"] ) && empty($patientDet["fivehz_50dBHL_refer"]) && empty($patientDet["fourhz_80dBHL_refer"]) && empty($patientDet["fourhz_50dBHL_refer"]) && empty($patientDet["whitenoise_80dBHL_refer"]) ){
            $passBOA = "pass";
        }
    }
    
    if($patientDet["normal_val"] == 1){
        $acanalPass = "Pass";
    }
    if($patientDet["moro_pre"] == 1 || $patientDet["root_pre"] == 1 ||$patientDet["suck_pre"] == 1 || $patientDet["tonicneck_pre"] == 1 || $patientDet["palmar_pre"] == 1 || $patientDet["plantar_pre"] == 1 || $patientDet["babinski_pre"] == 1){
      if (empty($patientDetail["moro_abs"]) && empty($patientDet["root_abs"]) && empty($patientDet["suck_abs"]) && empty($patientDet["tonicneck_abs"]) && empty($patientDet["palmar_abs"]) && empty($patientDet["plantar_abs"]) && empty($patientDet["babinski_abs"])){
        $primRefPass = "pass";
      }
    }
    
    //if ($patientDet["hrr_type"] == '2' && $patientDet["rt_screen1"] == 1 || $patientDet["lt_screen1"] == 1 && $patientDet["rt_screen1"] != 2 && $patientDet["rt_screen1"] != 3 && $patientDet["lt_screen1"] != 2 && $patientDet["lt_screen1"] != 3 && $patientDet["rt_screen2"] == 1 || $patientDet["lt_screen2"] == 1  && $patientDet["rt_screen2"] != 2 && $patientDet["rt_screen2"] != 3 && $patientDet["lt_screen2"] != 2 && $patientDet["lt_screen2"] != 3 && ($patientDet["fivehz_80dBHL_pass"] == 1 || $patientDet["fivehz_50dBHL_pass"] == '1' || $patientDet["fourhz_80dBHL_pass"] == '1' || $patientDet["fourhz_50dBHL_pass"] == '1' || $patientDet["whitenoise_80dBHL_pass"] == '1' || $patientDet["whitenoise_50dBHL_pass"] == '1' && $patientDet["fivehz_80dBHL_refer"] != 1 && $patientDet["fivehz_50dBHL_refer"] != '1' && $patientDet["fourhz_80dBHL_refer"] != '1' && $patientDet["fourhz_50dBHL_refer"] != '1' && $patientDet["whitenoise_80dBHL_refer"] != '1' && $patientDet["whitenoise_50dBHL_refer"] != '1') && $patientDet["normal_val"] == 1 && $patientDet["abnormal_val"] != 1 ) {
    if ($patientDet["hrr_type"] == '2' && !empty($screen1Pass) && !empty($screen2Pass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
         $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='1' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updatenorisk = "UPDATE `patient` SET `test_impression` ='1' WHERE `Patient_Id` = '$patient'";
        mysql_query($updatenorisk);
        
        echo "<div class='row'>
                <div class='col-md-12'>
                    <div class='col-md-6'>
                        <h3><span class='label label-success' >$msg1</span></h3>
                    </div>
                    <div class='col-md-5'>
                        <select class='form-control' name='impresn'>
                            ".getImpresionSelectList()."
                        </select> 
                    </div>
                </div>
              </div>  
        ";
        $hrr  = ($patientDet["hrr_type"] == "2")?"Absence":"";
        $absensehrr = !empty($abshrr)?"Absense of HRR  ":"";
        $oaeRightPass = !empty($patientDet["rt_pass"])?"right ear Pass":"";
        $oaeLeftPass = !empty($patientDet["lt_pass"])?"Left ear Pass - ":"";
        $oaeRightPassTwo = !empty($patientDet["rt_two_pass"])?"Right ear Pass 2nd Screen":"";
        $oaeLeftPassTwo = !empty($patientDet["lt_two_pass"])?"Left ear Pass 2nd scrreen":"";
        $nbn500PassOne = !empty($patientDet["fivehz_80dBHL_pass"])?"5000Hz warable Tone-Intensity 80dBHL Pass":"";
        $nbn500PassTwo = !empty($patientDet["fivehz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass":"";
        $nbn4000PassOne = !empty($patientDet["fourhz_80dBHL_pass"])?"4000Hz warable Tone-Intensity 80dBHL Pass":"";
        $nbn4000PassTwo = !empty($patientDet["fourhz_50dBHL_pass"])?"4000Hz warable Tone-Intensity 50dBHL Pass":"";
        $whiteNoisyPassOne = !empty($patientDet["whitenoise_80dBHL_pass"])?"White noise-Intensity80dBHL Pass":"";
        $whiteNoisyPassTwo = !empty($patientDet["whitenoise_50dBHL_pass"])?"White noise-50dBHL Pass":"";
        $AcANormal = !empty($patientDet["normal_val"])?"Acounstic Analysis Normal":"";
        $Moro_Present = !empty($patientDet["moro_pre"])?"Moro Present":"";
        $Rooting_Present = !empty($patientDet["root_pre"])?"Rooting Present":"";
        $suckingPresent = !empty($patientDet["suck_pre"])?"Rooting Present":"";
        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"Tonic Present":"";
        $palmar_Present = !empty($patientDet["palmar_pre"])?"Palmar Present":"";
        $plantar_Present = !empty($patientDet["plantar_pre"])?"Plantar Present":"";
        $babinski_Present = !empty($patientDet["babinski_pre"])?"Baninski Present":"";
    
    
        $impresnRemark = "$absensehrr $oaeRightPass $oaeLeftPass $oaeRightPassTwo $oaeLeftPassTwo $nbn500PassOne $nbn500PassTwo"
                . "$nbn4000PassOne $nbn4000PassTwo $whiteNoisyPassOne $whiteNoisyPassTwo $AcANormal $Moro_Present"
                . "$Rooting_Present $suckingPresent $tonic_Present $tonic_Present $palmar_Present $plantar_Present $babinski_Present";

        $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
        mysql_query($updateImprRemark);
        
        echo "<div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr>
                        <th>HRR SCreening</th>
                        <th>OAE</th>
                        <th>BOA</th>
                        <th class=''>Acounstic analysis</th>
                        <th class=''>Primitive Reflexes</th>
                    </tr>
                    <tr>
                        <td>$hrr</td>
                        <td>
                            <p>$oaeRightPass</p>
                            <p>$oaeLeftPass</p>
                            <p>$oaeRightPassTwo</p>
                            <p>$oaeLeftPassTwo</p>
                        </td>
                        <td>
                            <p>$nbn500PassOne</p>
                            <p>$nbn500PassTwo</p>
                            <p>$nbn4000PassOne</p>
                            <p>$nbn4000PassTwo</p>
                            <p>$whiteNoisyPassOne</p>
                            <p>$whiteNoisyPassTwo</p>
                        </td>
                        <td>
                            <p>$AcANormal</p>
                        </td>
                        <td>
                            <p>$Moro_Present</p>
                            <p>$Rooting_Present</p>
                            <p>$suckingPresent</p>
                            <p>$tonic_Present</p>
                            <p>$palmar_Present</p>
                            <p>$plantar_Present</p>
                            <p>$babinski_Present</p>
                        </td>

                    </tr>
                </tbody>

            </table>
            
            </div>
        ";
    
    }
    elseif ($patientDet["hrr_type"] == '1' && !empty($screen1Pass) && !empty($screen2Pass) && !empty($passBOA) && !empty($acanalPass) && !empty($primRefPass)) {
        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
        $q1 = mysql_query($s1);
        $r1 = mysql_fetch_assoc($q1);
        $msg1 = $r1['imp_name'];

        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
        
        $hrrType  = ($patientDetail["hrr_type"] == 1)?"Presence":"";
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"Excessive vomiting - ":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"Elderly Pregnancy - ":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"High/Low BP - ":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"Blood Sugar -":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"H/O Abortion - ":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"Rh Incompatibility - ":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"Viral Bacterial infection - ":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"Oto toxic medication - ":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"Chemical fumes - ":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"Alcohol - ":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"Smoking - ":"";
        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
        $fetal_Distress = !empty($patientDetail["fd"])?"Fetal distress - ":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
        $de_Generative = !empty($patientDetail["dd"])?"Degenerative diseas - ":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"Viral/bacterial infection - ":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"Convilsions - ":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"Otitis Media with effusion - ":"";
        $baby_trauma = !empty($patientDetail["thn"])?"Trauma of heador neck - ":"";
        
        $nbn500_passone = !empty($patientDetail["fivehz_80dBHL_pass"])?"5000Hz warable Tone-Intensity 80dBHL Pass - ":"";
        $nbn500_passtwo = !empty($patientDetail["fivehz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass -  - ":"";
        $nbn4000_passone = !empty($patientDetail["fourhz_80dBHL_pass"])?"4000 warable Tone-Intensity 80dBHL Pass -  - ":"";
        $nbn4000_passtwo = !empty($patientDetail["fourhz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass -  - ":"";
        $whitenoisy_passone = !empty($patientDetail["whitenoise_80dBHL_pass"])?"White noise-Intensity80dBHL Pass - ":"";
        $whitenoisy_passtwo = !empty( $patientDetail["whitenoise_50dBHL_pass"])?"White noise-Intensity50dBHL Pass- ":"";
        
        $oaeright_pass = !empty( $patientDetail["rt_pass"])?"Screenone right Pass ":"";
        $oaeleft_pass = !empty( $patientDetail["lt_pass"])?"Screenone left Pass ":"";
        $oaeright_pass2 = !empty( $patientDetail["rt_two_pass"])?"Screen two right Pass ":"";
        $oaeleft_pass2 = !empty( $patientDetail["lt_two_pass"])?"Screen two left Pass ":"";
        
        
        $acanal_normal = !empty($patientDetail["normal_val"])?"Acounstic analysis normal - ":"";
        
        $moro_Present = !empty($patientDetail["moro_pre"])?"Moro Present - ":"";
        $rooting_Present = !empty($patientDetail["root_pre"])?"Rootin Present - ":"";
        $suck_Present = !empty($patientDetail["suck_pre"])?"sucking Present - ":"";
        $tonic_Present = !empty($patientDetail["tonicneck_pre"])?"tonic neck Present - ":"";
        $palmar_Present = !empty($patientDetail["palmar_pre"])?"palmar Present - ":"";
        $planter_Present = !empty($patientDetail["plantar_pre"])?"plantar Present - ":"";
        $babinski_Present = !empty($patientDetail["babinski_pre"])?"babinski Present - ":"";
        
        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $acanal_normal"
            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
    
    echo "
        <div class='row'>
            <div class='col-md-5'>
                <h3><span class='label label-warning' >$msg1</span></h3>
            </div>
            <div class='col-md-5'>
                <select class='form-control' name='impresn'>
                    ".getImpresionSelectList()."
                </select> 
            </div>
        </div>
        ";
    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
    mysql_query($updateatrisk2);
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr>
                        <th class='text-center'>HRR Screening</th>
                        <th class=''>OAE</th>
                        <th class=''>BOA</th>
                        <th class=''>Acounstic analysis</th>
                        <th class=''>Primitive Reflexes</th>
                    </tr>
                    <tr>
                        <td>$hrrType</td>
                        <td>
                            <p>$oaeright_pass</p>
                            <p>$oaeLeftPass</p>
                            <p>$oaeright_pass2</p>
                            <p>$oaeleft_pass2</p>
                        </td>
                        <td>
                            <p>$nbn500_passone</p>
                            <p>$nbn500_passtwo</p>
                            <p>$nbn4000_passone</p>
                            <p>$nbn4000_passtwo</p>
                            <p>$whitenoisy_passone</p>
                            <p>$whitenoisy_passtwo</p>
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
    else{
        $s12 = "select `imp_name` from `tbl_impression` where `imp_id`='2' ";
        $q12 = mysql_query($s12);
        $r12 = mysql_fetch_assoc($q12);
        $msg12 = $r12['imp_name'];
        
        $hrrType = ($patientDetail["hrr_type"] == 1)?"Present":"";
        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"Excessive vomiting - ":"";
        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"Elderly Pregnancy - ":"";
        $baby_bp = !empty($patientDetail["highlow_bp"])?"High/Low BP - ":"";
        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"Blood Sugar -":"";
        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"H/O Abortion - ":"";
        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"Rh Incompatibility - ":"";
        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"Viral Bacterial infection - ":"";
        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"Oto toxic medication - ":"";
        $chem_Fume = !empty($patientDetail["chem_fum"])?"Chemical fumes - ":"";
        $baby_alcohol = !empty($patientDetail["alcohol"])?"Alcohol - ":"";
        $baby_smoke = !empty($patientDetail["smoking"])?"Smoking - ":"";
        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
        $fetal_Distress = !empty($patientDetail["fd"])?"Fetal distress - ":"";
        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
        $de_Generative = !empty($patientDetail["dd"])?"Degenerative diseas - ":"";
        $viral_Infect = !empty($patientDetail["vbf"])?"Viral/bacterial infection - ":"";
        $baby_convulsions = !empty($patientDetail["cnv"])?"Convilsions - ":"";
        $baby_otitis = !empty($patientDetail["omwe"])?"Otitis Media with effusion - ":"";
        $baby_trauma = !empty($patientDetail["thn"])?"Trauma of heador neck - ":"";
        $nbn500_referone = !empty($patientDetail["fivehz_80dBHL_refer"])?"5000Hz warable Tone-Intensity 80dBHL Refer - ":"";
        $nbn500_refertwo = !empty($patientDetail["fivehz_50dBHL_refer"])?"5000Hz warable Tone-Intensity 50dBHL refer -  - ":"";
        $nbn4000_referone = !empty($patientDetail["fourhz_80dBHL_refer"])?"4000 warable Tone-Intensity 80dBHL Refer -  - ":"";
        $nbn4000_refertwo = !empty($patientDetail["fourhz_50dBHL_refer"])?"5000Hz warable Tone-Intensity 50dBHL Refer -  - ":"";
        $whitenoisy_referone = !empty($patientDetail["whitenoise_80dBHL_refer"])?"White noise-Intensity80dBHL Refer - ":"";
        $whitenoisy_refertwo = !empty( $patientDetail["whitenoise_50dBHL_refer"])?"White noise-Intensity50dBHL Refer- ":"";
        
        $sceen1rtRefer = !empty( $patientDetail["rt_refer"])?"Screenone right refer ":"";
        $sceen1ltRefer = !empty( $patientDetail["lt_refer"])?"Screenone left refer ":"";
        $sceen2rtRefer = !empty( $patientDetail["rt_two_refer"])?"Screen two right refer ":"";
        $sceen2ltRefer = !empty( $patientDetail["lt_two_refer"])?"Screen two left refer ":"";
        
        
        $acanal_abnormal = !empty($patientDetail["abnormal_val"])?"Acounstic analysis Abnormal - ":"";
        
        $moro_Absent = !empty($patientDetail["moro_abs"])?"Moro absent - ":"";
        $rooting_Absent = !empty($patientDetail["root_abs"])?"Rootin absent - ":"";
        $suck_Absent = !empty($patientDetail["suck_abs"])?"sucking absent - ":"";
        $root_Absent = !empty($patientDetail["root_abs"])?"sucking absent - ":"";
        $tonic_Absent = !empty($patientDetail["tonicneck_abs"])?"tonic neck absent - ":"";
        $palmar_Absent = !empty($patientDetail["palmar_abs"])?"palmar absent - ":"";
        $planter_Absent = !empty($patientDetail["plantar_abs"])?"plantar absent - ":"";
        $babinski_Absent = !empty($patientDetail["babinski_abs"])?"babinski absent - ":"";
        
        $impresnRemark = "1$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
            . "$baby_trauma $nbn500_referone $nbn500_refertwo $nbn4000_referone $nbn4000_refertwo $whitenoisy_referone"
            . "$whitenoisy_refertwo $sceen1rtRefer $sceen1ltRefer $sceen2rtRefer $sceen2ltRefer $acanal_abnormal"
            . "$moro_Absent $rooting_Absent $suck_Absent $root_Absent $tonic_Absent $palmar_Absent $planter_Absent $babinski_Absent" ;
    
    
            
    $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
    mysql_query($updateImprRemark);
    
    
    $updateatrisk1 = "UPDATE `patient` SET `test_impression` ='2' WHERE `Patient_Id` = '$patient'";
    echo "
        <div class='row'>
            <div class='col-md-12'>
                <div class='col-md-6'>
                    <h3><span class='label label-danger' >$msg12</span></h3>
                </div>
                <div class='col-md-5'>
                    <select class='form-control' name='impresn'>
                        ".getImpresionSelectList()."
                    </select> 
                </div>
            </div>
        
         ";
    echo "<p><h4>Impression Remark</h4></p>
        <div class='col-md-12'>
            <table class='table'>
                <tbody>
                    <tr>
                        <th class='text-center'>HRR Screening</th>
                        <th class=''>OAE</th>
                        <th class=''>BOA</th>
                        <th class=''>Acounstic analysis</th>
                        <th class=''>Primitive Reflexes</th>
                    </tr>
                    <tr>
                        <td>$hrrType</td>
                        <td>
                            <p>$sceen1rtRefer</p>
                            <p>$sceen1ltRefer</p>
                            <p>$sceen2rtRefer</p>
                            <p>$sceen2ltRefer</p>
                        </td>
                        <td>
                            <p>$nbn500_referone</p>
                            <p>$nbn500_refertwo</p>
                            <p>$nbn4000_referone</p>
                            <p>$nbn4000_refertwo</p>
                            <p>$whitenoisy_referone</p>
                            <p>$whitenoisy_referone</p>
                        </td>
                        <td>
                            <p>$acanal_abnormal</p>
                        </td>
                        <td>
                            <p>$moro_Absent</p>
                            <p>$root_Absent</p>
                            <p>$suck_Absent</p>
                            <p>$tonic_Absent</p>
                            <p>$palmar_Absent</p>
                            <p>$planter_Absent</p>
                            <p>$babinski_Absent</p>
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
    
//    if ($patientDetail["hrr_type"] == '1' && $patientDetail["rt_pass"] = '1' || $patientDetail["lt_pass"] = '1' && $patientDetail["rt_two_pass"] = '1' || $patientDetail["lt_two_pass"] = '1'  && $patientDetail["fivehz_80dBHL_pass"] == '1' || $patientDetail["fivehz_50dBHL_pass"] == '1' || $patientDetail["fourhz_80dBHL_pass"] == '1' || $patientDetail["fourhz_50dBHL_pass"] == '1' || $patientDetail["whitenoise_80dBHL_pass"] == '1' || $patientDetail["whitenoise_50dBHL_pass"] == '1' &&  && $patientDetail["normal_val"] == '1' && $patientDetail["moro_pre"] == '1' || $patientDetail["root_pre"] == '1' || $patientDetail["suck_pre"] == '1' || $patientDetail["tonicneck_pre"] == '1' || $patientDetail["palmar_pre"] == '1' || $patientDetail["plantar_pre"] == '1' || $patientDetail["babinski_pre"] == '1') {
    //if ($patientDet["hrr_type"] == '2' && ($patientDet["rt_screen1"] = '1' && $patientDet["lt_screen1"] = '1') && ($patientDet["rt_screen2"] = '1' || $patientDet["lt_screen2"] = '1')  && ($patientDet["fivehz_80dBHL_pass"] == '1' || $patientDet["fivehz_50dBHL_pass"] == '1' || $patientDet["fourhz_80dBHL_pass"] == '1' || $patientDet["fourhz_50dBHL_pass"] == '1' || $patientDet["whitenoise_80dBHL_pass"] == '1' || $patientDet["whitenoise_50dBHL_pass"] == '1')) {
//    if ($patientDet["hrr_type"] == '2' && $patientDet["rt_screen1"] = '1' && $patientDet["lt_screen1"] = '1' && empty($patientDet["rt_screen2"]) && empty($patientDet["lt_screen2"]) && ($patientDet["fivehz_80dBHL_pass"] == '1' || $patientDet["fivehz_50dBHL_pass"] == '1' || $patientDet["fourhz_80dBHL_pass"] == '1' || $patientDet["fourhz_50dBHL_pass"] == '1' || $patientDet["whitenoise_80dBHL_pass"] == '1' || $patientDet["whitenoise_50dBHL_pass"] == '1')) {
//        $s1 = "select `imp_name` from `tbl_impression` where `imp_id`='1' ";
//        $q1 = mysql_query($s1);
//        $r1 = mysql_fetch_assoc($q1);
//        $msg1 = $r1['imp_name'];
//
//        $updatenorisk = "UPDATE `patient` SET `test_impression` ='1' WHERE `Patient_Id` = '$patient'";
//        mysql_query($updatenorisk);
//        
//        echo "<div class='row'>
//                <div class='col-md-12'>
//                    <div class='col-md-6'>
//                        <h3><span class='label label-success' >$msg1</span></h3>
//                    </div>
//                    <div class='col-md-5'>
//                        <select class='form-control' name='impresn'>
//                            ".getImpresionSelectList()."
//                        </select> 
//                    </div>
//                </div>
//              </div>  
//        ";
//        $hrr  = ($patientDet["hrr_type"] == "2")?"Absence":"";
//        $absensehrr = !empty($abshrr)?"Absense of HRR  ":"";
//        $oaeRightPass = !empty($patientDet["rt_pass"])?"right ear Pass":"";
//        $oaeLeftPass = !empty($patientDet["lt_pass"])?"Left ear Pass - ":"";
//        $oaeRightPassTwo = !empty($patientDet["rt_two_pass"])?"Right ear Pass 2nd Screen":"";
//        $oaeLeftPassTwo = !empty($patientDet["lt_two_pass"])?"Left ear Pass 2nd scrreen":"";
//        $nbn500PassOne = !empty($patientDet["fivehz_80dBHL_pass"])?"5000Hz warable Tone-Intensity 80dBHL Pass":"";
//        $nbn500PassTwo = !empty($patientDet["fivehz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass":"";
//        $nbn4000PassOne = !empty($patientDet["fourhz_80dBHL_pass"])?"4000Hz warable Tone-Intensity 80dBHL Pass":"";
//        $nbn4000PassTwo = !empty($patientDet["fourhz_50dBHL_pass"])?"4000Hz warable Tone-Intensity 50dBHL Pass":"";
//        $whiteNoisyPassOne = !empty($patientDet["whitenoise_80dBHL_pass"])?"White noise-Intensity80dBHL Pass":"";
//        $whiteNoisyPassTwo = !empty($patientDet["whitenoise_50dBHL_pass"])?"White noise-50dBHL Pass":"";
//        $AcANormal = !empty($patientDet["normal_val"])?"Acounstic Analysis Normal":"";
//        $Moro_Present = !empty($patientDet["moro_pre"])?"Moro Present":"";
//        $Rooting_Present = !empty($patientDet["root_pre"])?"Rooting Present":"";
//        $suckingPresent = !empty($patientDet["suck_pre"])?"Rooting Present":"";
//        $tonic_Present = !empty($patientDet["tonicneck_pre"])?"Tonic Present":"";
//        $palmar_Present = !empty($patientDet["palmar_pre"])?"Palmar Present":"";
//        $plantar_Present = !empty($patientDet["plantar_pre"])?"Plantar Present":"";
//        $babinski_Present = !empty($patientDet["babinski_pre"])?"Baninski Present":"";
//    
//    
//        $impresnRemark = "$absensehrr $oaeRightPass $oaeLeftPass $oaeRightPassTwo $oaeLeftPassTwo $nbn500PassOne $nbn500PassTwo"
//                . "$nbn4000PassOne $nbn4000PassTwo $whiteNoisyPassOne $whiteNoisyPassTwo $AcANormal $Moro_Present"
//                . "$Rooting_Present $suckingPresent $tonic_Present $tonic_Present $palmar_Present $plantar_Present $babinski_Present";
//
//        $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
//        mysql_query($updateImprRemark);
//        
//        echo "<div class='col-md-12'>
//            <table class='table'>
//                <tbody>
//                    <tr>
//                        <th>HRR SCreening</th>
//                        <th>OAE</th>
//                        <th>BOA</th>
//                        <th class=''>Acounstic analysis</th>
//                        <th class=''>Primitive Reflexes</th>
//                    </tr>
//                    <tr>
//                        <td>$hrr</td>
//                        <td>
//                            <p>$oaeRightPass</p>
//                            <p>$oaeLeftPass</p>
//                            <p>$oaeRightPassTwo</p>
//                            <p>$oaeLeftPassTwo</p>
//                        </td>
//                        <td>
//                            <p>$nbn500PassOne</p>
//                            <p>$nbn500PassTwo</p>
//                            <p>$nbn4000PassOne</p>
//                            <p>$nbn4000PassTwo</p>
//                            <p>$whiteNoisyPassOne</p>
//                            <p>$whiteNoisyPassTwo</p>
//                        </td>
//                        <td>
//                            <p>$AcANormal</p>
//                        </td>
//                        <td>
//                            <p>$Moro_Present</p>
//                            <p>$Rooting_Present</p>
//                            <p>$suckingPresent</p>
//                            <p>$tonic_Present</p>
//                            <p>$palmar_Present</p>
//                            <p>$plantar_Present</p>
//                            <p>$babinski_Present</p>
//                        </td>
//
//                    </tr>
//                </tbody>
//
//            </table>
//            
//            </div>
//        ";
//        
//       
//         
//        
//    }
//    
        
    
//    elseif (($patientDetail["excessive_vomiting"] == 1 || $patientDetail["highlow_bp"] == 1 || $patientDetail["elderly_pregnanacy"] == 1 || $patientDetail["blood_sugar"] == 1 || $patientDetail["ho_abortions"] == 1 || $patientDetail["rh_incompatitlibility"] == 1 || $patientDetail["viralbacterial_infections"] == 1 || $patientDetail["oto_tox_med"] == 1 || $patientDetail["chem_fum"] == 1 || $patientDetail["alcohol"] == 1 || $patientDetail["smoking"] == 1) &&
//        ($patientDetail["lbw"] == 1 || $patientDetail["fd"] == 1 || $patientDetail["ba"] == 1 || $patientDetail["nj"] == 1 || $patientDetail["as_1min"] == 1 || $patientDetail["as_5min"] == 1 || $patientDetail["birth_wt"] != NULL || $patientDetail["bilrubin_level"] != NULL || $patientDetail["delayed_birth_cry"] != NULL || $patientDetail["aspiration_of_fluid_days"] != NULL || $patientDetail["premature_delivery_week"] != NULL) &&
//        ($patientDetail["csa"] == 1 || $patientDetail["ca"] == 1 || $patientDetail["dd"] == 1 || $patientDetail["vbf"] == 1 || $patientDetail["cnv"] == 1 || $patientDetail["omwe"] == 1 || $patientDetail["thn"] == 1) &&
//        ($patientDetail["fivehz_80dBHL_refer"] == 1 || $patientDetail["fivehz_50dBHL_refer"] == 1 || $patientDetail["fourhz_80dBHL_refer"] == 1 || $patientDetail["fourhz_50dBHL_refer"] == 1 || $patientDetail["whitenoise_80dBHL_refer"] == 1 || $patientDetail["whitenoise_50dBHL_refer"] == 1) &&
//        ($patientDetail["rt_refer"] == 1 || $patientDetail["lt_refer"] == 1 || $patientDetail["rt_two_refer"] == 1 || $patientDetail["lt_two_refer"] == 1) &&
//        ($patientDetail["aabr_rt_refer"] == 1 || $patientDetail["aabr_lt_refer"] == 1 && $patientDetail["abnormal_val"] == 1 && $patientDetail["moro_abs"] == 1 || $patientDetail["suck_abs"] == 1 || $patientDetail["root_abs"] == 1 || $patientDetail["tonicneck_abs"] == 1 || $patientDetail["palmar_abs"] == 1 || $patientDetail["plantar_abs"] == 1 || $patientDetail["babinski_abs"] == 1)) {
//    elseif (($patientDetail["hrr_type"] == 1) && ($patientDetail["excessive_vomiting"] == 1 || $patientDetail["highlow_bp"] == 1 || $patientDetail["elderly_pregnanacy"] == 1 || $patientDetail["blood_sugar"] == 1 || $patientDetail["ho_abortions"] == 1 || $patientDetail["rh_incompatitlibility"] == 1 || $patientDetail["viralbacterial_infections"] == 1 || $patientDetail["oto_tox_med"] == 1 || $patientDetail["chem_fum"] == 1 || $patientDetail["alcohol"] == 1 || $patientDetail["smoking"] == 1 ||
//        $patientDetail["lbw"] == 1 || $patientDetail["fd"] == 1 || $patientDetail["ba"] == 1 || $patientDetail["nj"] == 1 || $patientDetail["as_1min"] == 1 || $patientDetail["as_5min"] == 1 || $patientDetail["birth_wt"] != NULL || $patientDetail["bilrubin_level"] != NULL || $patientDetail["delayed_birth_cry"] == 1 || $patientDetail["birthcrysec"] != NULL || $patientDetail["aspiration_of_fluid_days"] == 1 || $patientDetail["premature_delivery_week"] == 1 || $patientDetail["premature_delivery_val"]!= NULL ||
//        $patientDetail["csa"] == 1 || $patientDetail["ca"] == 1 || $patientDetail["dd"] == 1 || $patientDetail["vbf"] == 1 || $patientDetail["cnv"] == 1 || $patientDetail["omwe"] == 1 || $patientDetail["thn"] == 1) &&
//        ($patientDetail["fivehz_80dBHL_refer"] == 1 || $patientDetail["fivehz_50dBHL_refer"] == 1 || $patientDetail["fourhz_80dBHL_refer"] == 1 || $patientDetail["fourhz_50dBHL_refer"] == 1 || $patientDetail["whitenoise_80dBHL_refer"] == 1 || $patientDetail["whitenoise_50dBHL_refer"] == 1) &&
//        ($patientDetail["rt_refer"] == 1 || $patientDetail["lt_refer"] == 1 || $patientDetail["rt_two_refer"] == 1 || $patientDetail["lt_two_refer"] == 1) &&
//         ($patientDetail["abnormal_val"] == 1 && $patientDetail["moro_abs"] == 1 || $patientDetail["suck_abs"] == 1 || $patientDetail["root_abs"] == 1 || $patientDetail["tonicneck_abs"] == 1 || $patientDetail["palmar_abs"] == 1 || $patientDetail["plantar_abs"] == 1 || $patientDetail["babinski_abs"] == 1)) {
//        
//        $s12 = "select `imp_name` from `tbl_impression` where `imp_id`='2' ";
//        $q12 = mysql_query($s12);
//        $r12 = mysql_fetch_assoc($q12);
//        $msg12 = $r12['imp_name'];
//        
//        $hrrType = ($patientDetail["hrr_type"] == 1)?"Present":"";
//        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"Excessive vomiting - ":"";
//        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"Elderly Pregnancy - ":"";
//        $baby_bp = !empty($patientDetail["highlow_bp"])?"High/Low BP - ":"";
//        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"Blood Sugar -":"";
//        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"H/O Abortion - ":"";
//        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"Rh Incompatibility - ":"";
//        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"Viral Bacterial infection - ":"";
//        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"Oto toxic medication - ":"";
//        $chem_Fume = !empty($patientDetail["chem_fum"])?"Chemical fumes - ":"";
//        $baby_alcohol = !empty($patientDetail["alcohol"])?"Alcohol - ":"";
//        $baby_smoke = !empty($patientDetail["smoking"])?"Smoking - ":"";
//        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
//        $fetal_Distress = !empty($patientDetail["fd"])?"Fetal distress - ":"";
//        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
//        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
//        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
//        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
//        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
//        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
//        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
//        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
//        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
//        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
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
//        
//        
//        $acanal_abnormal = !empty($patientDetail["abnormal_val"])?"Acounstic analysis Abnormal - ":"";
//        
//        $moro_Absent = !empty($patientDetail["moro_abs"])?"Moro absent - ":"";
//        $rooting_Absent = !empty($patientDetail["root_abs"])?"Rootin absent - ":"";
//        $suck_Absent = !empty($patientDetail["suck_abs"])?"sucking absent - ":"";
//        $root_Absent = !empty($patientDetail["root_abs"])?"sucking absent - ":"";
//        $tonic_Absent = !empty($patientDetail["tonicneck_abs"])?"tonic neck absent - ":"";
//        $palmar_Absent = !empty($patientDetail["palmar_abs"])?"palmar absent - ":"";
//        $planter_Absent = !empty($patientDetail["plantar_abs"])?"plantar absent - ":"";
//        $babinski_Absent = !empty($patientDetail["babinski_abs"])?"babinski absent - ":"";
//        
//        $impresnRemark = "1$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
//            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
//            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
//            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
//            . "$baby_trauma $nbn500_referone $nbn500_refertwo $nbn4000_referone $nbn4000_refertwo $whitenoisy_referone"
//            . "$whitenoisy_refertwo $sceen1rtRefer $sceen1ltRefer $sceen2rtRefer $sceen2ltRefer $acanal_abnormal"
//            . "$moro_Absent $rooting_Absent $suck_Absent $root_Absent $tonic_Absent $palmar_Absent $planter_Absent $babinski_Absent" ;
//    
//    
//            
//    $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
//    mysql_query($updateImprRemark);
//    
//    
//    $updateatrisk1 = "UPDATE `patient` SET `test_impression` ='2' WHERE `Patient_Id` = '$patient'";
//    echo "
//        <div class='row'>
//            <div class='col-md-12'>
//                <div class='col-md-6'>
//                    <h3><span class='label label-danger' >$msg12</span></h3>
//                </div>
//                <div class='col-md-5'>
//                    <select class='form-control' name='impresn'>
//                        ".getImpresionSelectList()."
//                    </select> 
//                </div>
//            </div>
//        
//         ";
//    echo "<p><h4>Impression Remark</h4></p>
//        <div class='col-md-12'>
//            <table class='table'>
//                <tbody>
//                    <tr>
//                        <th class='text-center'>HRR Screening</th>
//                        <th class=''>OAE</th>
//                        <th class=''>BOA</th>
//                        <th class=''>Acounstic analysis</th>
//                        <th class=''>Primitive Reflexes</th>
//                    </tr>
//                    <tr>
//                        <td>$hrrType</td>
//                        <td>
//                            <p>$sceen1rtRefer</p>
//                            <p>$sceen1ltRefer</p>
//                            <p>$sceen2rtRefer</p>
//                            <p>$sceen2ltRefer</p>
//                        </td>
//                        <td>
//                            <p>$nbn500_referone</p>
//                            <p>$nbn500_refertwo</p>
//                            <p>$nbn4000_referone</p>
//                            <p>$nbn4000_refertwo</p>
//                            <p>$whitenoisy_referone</p>
//                            <p>$whitenoisy_referone</p>
//                        </td>
//                        <td>
//                            <p>$acanal_abnormal</p>
//                        </td>
//                        <td>
//                            <p>$moro_Absent</p>
//                            <p>$root_Absent</p>
//                            <p>$suck_Absent</p>
//                            <p>$tonic_Absent</p>
//                            <p>$palmar_Absent</p>
//                            <p>$planter_Absent</p>
//                            <p>$babinski_Absent</p>
//                        </td>
//
//                    </tr>
//                </tbody>
//            </table>
//        </div>
//
//
//    ";
//    mysql_query($updateatrisk1);
//    
//    $nbslist = getNbsList($patientDetail);
////    $osclist = getOSCList();
//    
//    $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
//    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
//    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
//    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
//    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
//    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
//        echo ""
//        . "<div class='row'>
//                <h4>Refer to...</h4>
//                <!--<div class='col-md-12'> -->
//                    <div class='col-md-3 col-md-offset-1 form-group '>
//                        <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
//                    </div>
//                    <div class='col-md-3 col-md-offset-1 form-group'>
//                        <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
//                    </div>
//                    <div class='col-md-3 col-md-offset-1 form-group'>
//                        <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
//                    </div>
//                <!--</div>-->
//                <div class='col-md-12 '>
//                    <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
//                         $nbslist
//                    </div>
//
//                    <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
//                        ".getOSCList($patientDetail)."
//                    </div>
//                    <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
//                        ".getAIISHList($patientDetail)."
//                    </div>
//                    <div class='col-md-12 col-md-offset-8 form-group' id='' >
//                        <input type='text' id='nbsCheckedVal' hidden='' value=''> 
//                        <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
//                    </div>
//                </div>
//                
//            </div>
//            
//        ";
//    }
//    elseif (($patientDetail["hrr_type"] == 1) && $patientDetail["excessive_vomiting"] == 1 || $patientDetail["highlow_bp"] == 1 || $patientDetail["elderly_pregnanacy"] == 1 || $patientDetail["blood_sugar"] == 1 || $patientDetail["ho_abortions"] == 1 || $patientDetail["rh_incompatitlibility"] == 1 || $patientDetail["viralbacterial_infections"] == 1 || $patientDetail["oto_tox_med"] == 1 || $patientDetail["chem_fum"] == 1 || $patientDetail["alcohol"] == 1 || $patientDetail["smoking"] == 1 ||
//        $patientDetail["lbw"] == 1 || $patientDetail["fd"] == 1 || $patientDetail["ba"] == 1 || $patientDetail["nj"] == 1 || $patientDetail["as_1min"] == 1 || $patientDetail["as_5min"] == 1 || $patientDetail["birth_wt"] != NULL || $patientDetail["bilrubin_level"] != NULL || $patientDetail["delayed_birth_cry"] == 1 || $patientDetail["birthcrysec"] != NULL || $patientDetail["aspiration_of_fluid_days"] == 1 || $patientDetail["premature_delivery_week"] == 1 || $patientDetail["premature_delivery_val"]!= NULL ||
//        $patientDetail["csa"] == 1 || $patientDetail["ca"] == 1 || $patientDetail["dd"] == 1 || $patientDetail["vbf"] == 1 || $patientDetail["cnv"] == 1 || $patientDetail["omwe"] == 1 || $patientDetail["thn"] == 1 &&
//        $patientDetail["fivehz_80dBHL_pass"] == 1 || $patientDetail["fivehz_50dBHL_pass"] == 1 || $patientDetail["fourhz_80dBHL_pass"] == 1 || $patientDetail["fourhz_50dBHL_pass"] == 1 || $patientDetail["whitenoise_80dBHL_pass"] == 1 || $patientDetail["whitenoise_50dBHL_pass"] == 1 &&
//        $patientDetail["rt_pass"] == 1 || $patientDetail["lt_pass"] == 1 || $patientDetail["rt_two_pass"] == 1 || $patientDetail["lt_two_pass"] == 1 &&
//        $patientDetail["normal_val"] == 1 && $patientDetail["moro_pre"] == 1 || $patientDetail["suck_pre"] == 1 || $patientDetail["root_pre"] == 1 || $patientDetail["tonicneck_pre"] == 1 || $patientDetail["palmar_pre"] == 1 || $patientDetail["plantar_pre"] == 1 || $patientDetail["babinski_pre"] == 1) {
//    elseif (($patientDetail["hrr_type"] == 1) && $patientDetail["excessive_vomiting"] == 1 || $patientDetail["highlow_bp"] == 1 || $patientDetail["elderly_pregnanacy"] == 1 || $patientDetail["blood_sugar"] == 1 || $patientDetail["ho_abortions"] == 1 || $patientDetail["rh_incompatitlibility"] == 1 || $patientDetail["viralbacterial_infections"] == 1 || $patientDetail["oto_tox_med"] == 1 || $patientDetail["chem_fum"] == 1 || $patientDetail["alcohol"] == 1 || $patientDetail["smoking"] == 1 ||
//        $patientDetail["lbw"] == 1 || $patientDetail["fd"] == 1 || $patientDetail["ba"] == 1 || $patientDetail["nj"] == 1 || $patientDetail["as_1min"] == 1 || $patientDetail["as_5min"] == 1 || $patientDetail["birth_wt"] != NULL || $patientDetail["bilrubin_level"] != NULL || $patientDetail["delayed_birth_cry"] == 1 || $patientDetail["birthcrysec"] != NULL || $patientDetail["aspiration_of_fluid_days"] == 1 || $patientDetail["premature_delivery_week"] == 1 || $patientDetail["premature_delivery_val"]!= NULL ||
//        $patientDetail["csa"] == 1 || $patientDetail["ca"] == 1 || $patientDetail["dd"] == 1 || $patientDetail["vbf"] == 1 || $patientDetail["cnv"] == 1 || $patientDetail["omwe"] == 1 || $patientDetail["thn"] == 1 &&
//        $patientDetail["fivehz_80dBHL_pass"] == 1 || $patientDetail["fivehz_50dBHL_pass"] == 1 || $patientDetail["fourhz_80dBHL_pass"] == 1 || $patientDetail["fourhz_50dBHL_pass"] == 1 || $patientDetail["whitenoise_80dBHL_pass"] == 1 || $patientDetail["whitenoise_50dBHL_pass"] == 1 &&
//        ($patientDetail["rt_pass"] == 1 && $patientDetail["lt_pass"] == 1 ) || ($patientDetail["rt_pass"] == 1 && empty($patientDetail["lt_pass"])) || (empty($patientDetail["rt_pass"]) && $patientDetail["lt_pass"] == 1 ) || ($patientDetail["rt_two_pass"] == 1 || $patientDetail["lt_two_pass"] == 1 && empty ($patientDetail["rt_two_refer"]) && empty ($patientDetail["lt_two_refer"]) && empty ($patientDetail["rt_cnt_two_noisy"]) && empty ($patientDetail["lt_cnt_two_noisy"])) &&
//        $patientDetail["normal_val"] == 1 && $patientDetail["moro_pre"] == 1 || $patientDetail["suck_pre"] == 1 || $patientDetail["root_pre"] == 1 || $patientDetail["tonicneck_pre"] == 1 || $patientDetail["palmar_pre"] == 1 || $patientDetail["plantar_pre"] == 1 || $patientDetail["babinski_pre"] == 1) {
//    
//        $s123 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
//        $q123 = mysql_query($s123);
//        $r123 = mysql_fetch_assoc($q123);
//        $msg123 = $r123['imp_name'];
//
//        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
//        
//        $hrrType  = ($patientDetail["hrr_type"] == 1)?"Presence":"";
//        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"Excessive vomiting - ":"";
//        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"Elderly Pregnancy - ":"";
//        $baby_bp = !empty($patientDetail["highlow_bp"])?"High/Low BP - ":"";
//        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"Blood Sugar -":"";
//        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"H/O Abortion - ":"";
//        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"Rh Incompatibility - ":"";
//        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"Viral Bacterial infection - ":"";
//        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"Oto toxic medication - ":"";
//        $chem_Fume = !empty($patientDetail["chem_fum"])?"Chemical fumes - ":"";
//        $baby_alcohol = !empty($patientDetail["alcohol"])?"Alcohol - ":"";
//        $baby_smoke = !empty($patientDetail["smoking"])?"Smoking - ":"";
//        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
//        $fetal_Distress = !empty($patientDetail["fd"])?"Fetal distress - ":"";
//        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
//        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
//        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
//        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
//        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
//        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
//        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
//        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
//        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
//        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
//        $de_Generative = !empty($patientDetail["dd"])?"Degenerative diseas - ":"";
//        $viral_Infect = !empty($patientDetail["vbf"])?"Viral/bacterial infection - ":"";
//        $baby_convulsions = !empty($patientDetail["cnv"])?"Convilsions - ":"";
//        $baby_otitis = !empty($patientDetail["omwe"])?"Otitis Media with effusion - ":"";
//        $baby_trauma = !empty($patientDetail["thn"])?"Trauma of heador neck - ":"";
//        
//        $nbn500_passone = !empty($patientDetail["fivehz_80dBHL_pass"])?"5000Hz warable Tone-Intensity 80dBHL Pass - ":"";
//        $nbn500_passtwo = !empty($patientDetail["fivehz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass -  - ":"";
//        $nbn4000_passone = !empty($patientDetail["fourhz_80dBHL_pass"])?"4000 warable Tone-Intensity 80dBHL Pass -  - ":"";
//        $nbn4000_passtwo = !empty($patientDetail["fourhz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass -  - ":"";
//        $whitenoisy_passone = !empty($patientDetail["whitenoise_80dBHL_pass"])?"White noise-Intensity80dBHL Pass - ":"";
//        $whitenoisy_passtwo = !empty( $patientDetail["whitenoise_50dBHL_pass"])?"White noise-Intensity50dBHL Pass- ":"";
//        
//        $oaeright_pass = !empty( $patientDetail["rt_pass"])?"Screenone right Pass ":"";
//        $oaeleft_pass = !empty( $patientDetail["lt_pass"])?"Screenone left Pass ":"";
//        $oaeright_pass2 = !empty( $patientDetail["rt_two_pass"])?"Screen two right Pass ":"";
//        $oaeleft_pass2 = !empty( $patientDetail["lt_two_pass"])?"Screen two left Pass ":"";
//        
//        
//        $acanal_normal = !empty($patientDetail["normal_val"])?"Acounstic analysis normal - ":"";
//        
//        $moro_Present = !empty($patientDetail["moro_pre"])?"Moro Present - ":"";
//        $rooting_Present = !empty($patientDetail["root_pre"])?"Rootin Present - ":"";
//        $suck_Present = !empty($patientDetail["suck_pre"])?"sucking Present - ":"";
//        $tonic_Present = !empty($patientDetail["tonicneck_pre"])?"tonic neck Present - ":"";
//        $palmar_Present = !empty($patientDetail["palmar_pre"])?"palmar Present - ":"";
//        $planter_Present = !empty($patientDetail["plantar_pre"])?"plantar Present - ":"";
//        $babinski_Present = !empty($patientDetail["babinski_pre"])?"babinski Present - ":"";
//        
//        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
//            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
//            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
//            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
//            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
//            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $acanal_normal"
//            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
//    
//    echo "
//        <div class='row'>
//            <div class='col-md-5'>
//                <h3><span class='label label-warning' >$msg123</span></h3>
//            </div>
//            <div class='col-md-5'>
//                <select class='form-control' name='impresn'>
//                    ".getImpresionSelectList()."
//                </select> 
//            </div>
//        </div>
//        ";
//    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
//    mysql_query($updateatrisk2);
//    echo "<p><h4>Impression Remark</h4></p>
//        <div class='col-md-12'>
//            <table class='table'>
//                <tbody>
//                    <tr>
//                        <th class='text-center'>HRR Screening</th>
//                        <th class=''>OAE</th>
//                        <th class=''>BOA</th>
//                        <th class=''>Acounstic analysis</th>
//                        <th class=''>Primitive Reflexes</th>
//                    </tr>
//                    <tr>
//                        <td>$hrrType</td>
//                        <td>
//                            <p>$oaeright_pass</p>
//                            <p>$oaeLeftPass</p>
//                            <p>$oaeright_pass2</p>
//                            <p>$oaeleft_pass2</p>
//                        </td>
//                        <td>
//                            <p>$nbn500_passone</p>
//                            <p>$nbn500_passtwo</p>
//                            <p>$nbn4000_passone</p>
//                            <p>$nbn4000_passtwo</p>
//                            <p>$whitenoisy_passone</p>
//                            <p>$whitenoisy_passtwo</p>
//                        </td>
//                        <td>
//                            <p>$acanal_normal</p>
//                        </td>
//                        <td>
//                            <p>$moro_Present</p>
//                            <p>$rooting_Present</p>
//                            <p>$suck_Present</p>
//                            <p>$tonic_Present</p>
//                            <p>$palmar_Present</p>
//                            <p>$planter_Present</p>
//                            <p>$babinski_Present</p>
//                        </td>
//
//                    </tr>
//                </tbody>
//            </table>
//        </div>";
//     $nbslist = getNbsList($patientDetail);
//     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
//    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
//    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
//    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
//    $aiishradioTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"checked=''":"";
//    $aiishdivTogle = ($patientDetail["aiish_refer"] != 0 || !empty($patientDetail["aiish_refer"]))?"display:block":"display:none";
//    
//    echo ""
//    . "<div class='row'>
//            <h4>Refer to...</h4>
//            <!--<div class='col-md-12'> -->
//                <div class='col-md-3 col-md-offset-1 form-group '>
//                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
//                </div>
//                <div class='col-md-3 col-md-offset-1 form-group'>
//                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
//                </div>
//                <div class='col-md-3 col-md-offset-1 form-group'>
//                    <label class='radio'><input type='radio' name='referto' value='1' id='aiishcentr' $aiishradioTogle class='aiishcentr'>AIISH center</label>
//                </div>
//            <!--</div>-->
//            <div class='col-md-12 '>
//                <div class='col-md-3 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
//                     $nbslist
//                </div>
//            
//                <div class='col-md-3 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
//                    ".getOSCList($patientDetail)."
//                </div>
//                <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
//                    ".getAIISHList($patientDetail)."
//                </div>
//            </div>
//            <div class='col-md-12 col-md-offset-8 form-group' id='' >
//                <input type='text' id='nbsCheckedVal' hidden=''> 
//                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
//            </div>
//            <div class='col-md-12 '>
//                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
//            </div>
//        </div>
//            
//        ";
//    
//        echo "
//            <!--<div class='col-md-8'>
//                <table class='table'>
//                    <tbody>
//                        <tr>
//                            <th>POCD no.</th>
//                            <th>Baby id</th>
//                            <th>Baby name</th>
//                            <th>Date of exam</th>
//                        </tr>
//                    
//                        <tr>
//                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
//                        
//                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
//                        
//                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
//                        
//                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
//                        </tr>
//                    </tbody>
//                </table>    
//            </div>-->
//        ";
//    }
//    else{
////    elseif (($patientDetail["hrr_type"] == 2) &&
////        ($patientDetail["fivehz_80dBHL_refer"] == 1 || $patientDetail["fivehz_50dBHL_refer"] == 1 || $patientDetail["fourhz_80dBHL_refer"] == 1 || $patientDetail["fourhz_50dBHL_refer"] == 1 || $patientDetail["whitenoise_80dBHL_refer"] == 1 || $patientDetail["whitenoise_50dBHL_refer"] == 1) &&
////        ($patientDetail["rt_refer"] == 1 || $patientDetail["lt_refer"] == 1 || $patientDetail["rt_two_refer"] == 1 || $patientDetail["lt_two_refer"] == 1 )&&
////         ($patientDetail["abnormal_val"] == 1) && ($patientDetail["moro_abs"] == 1 || $patientDetail["suck_abs"] == 1 || $patientDetail["root_abs"] == 1 || $patientDetail["tonicneck_abs"] == 1 || $patientDetail["palmar_abs"] == 1 || $patientDetail["plantar_abs"] == 1 || $patientDetail["babinski_abs"] == 1)) {
//        
//        $s12 = "select `imp_name` from `tbl_impression` where `imp_id`='2' ";
//        $q12 = mysql_query($s12);
//        $r12 = mysql_fetch_assoc($q12);
//        $msg12 = $r12['imp_name'];
//        
//        $hrrType = ($patientDet["hrr_type"] == 2)?"Absent":"";
////        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"Excessive vomiting - ":"";
////        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"Elderly Pregnancy - ":"";
////        $baby_bp = !empty($patientDetail["highlow_bp"])?"High/Low BP - ":"";
////        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"Blood Sugar -":"";
////        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"H/O Abortion - ":"";
////        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"Rh Incompatibility - ":"";
////        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"Viral Bacterial infection - ":"";
////        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"Oto toxic medication - ":"";
////        $chem_Fume = !empty($patientDetail["chem_fum"])?"Chemical fumes - ":"";
////        $baby_alcohol = !empty($patientDetail["alcohol"])?"Alcohol - ":"";
////        $baby_smoke = !empty($patientDetail["smoking"])?"Smoking - ":"";
////        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
////        $fetal_Distress = !empty($patientDetail["fd"])?"Fetal distress - ":"";
////        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
////        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
////        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
////        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
////        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
////        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
////        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
////        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
////        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
////        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
////        $de_Generative = !empty($patientDetail["dd"])?"Degenerative diseas - ":"";
////        $viral_Infect = !empty($patientDetail["vbf"])?"Viral/bacterial infection - ":"";
////        $baby_convulsions = !empty($patientDetail["cnv"])?"Convilsions - ":"";
////        $baby_otitis = !empty($patientDetail["omwe"])?"Otitis Media with effusion - ":"";
////        $baby_trauma = !empty($patientDetail["thn"])?"Trauma of heador neck - ":"";
//        $nbn500_referone = !empty($patientDet["fivehz_80dBHL_refer"])?"5000Hz warable Tone-Intensity 80dBHL Refer - ":"";
//        $nbn500_refertwo = !empty($patientDet["fivehz_50dBHL_refer"])?"5000Hz warable Tone-Intensity 50dBHL refer -  - ":"";
//        $nbn4000_referone = !empty($patientDet["fourhz_80dBHL_refer"])?"4000 warable Tone-Intensity 80dBHL Refer -  - ":"";
//        $nbn4000_refertwo = !empty($patientDet["fourhz_50dBHL_refer"])?"5000Hz warable Tone-Intensity 50dBHL Refer -  - ":"";
//        $whitenoisy_referone = !empty($patientDet["whitenoise_80dBHL_refer"])?"White noise-Intensity80dBHL Refer - ":"";
//        $whitenoisy_refertwo = !empty( $patientDet["whitenoise_50dBHL_refer"])?"White noise-Intensity50dBHL Refer- ":"";
//        
//        $sceen1rtRefer = !empty( $patientDet["rt_refer"])?"Screenone right refer ":"";
//        $sceen1ltRefer = !empty( $patientDet["lt_refer"])?"Screenone left refer ":"";
//        $sceen2rtRefer = !empty( $patientDet["rt_two_refer"])?"Screen two right refer ":"";
//        $sceen2ltRefer = !empty( $patientDet["lt_two_refer"])?"Screen two left refer ":"";
//        
//        
//        $acanal_abnormal = !empty($patientDet["abnormal_val"])?"Acounstic analysis Abnormal - ":"";
//        
//        $moro_Absent = !empty($patientDet["moro_abs"])?"Moro absent - ":"";
//        $rooting_Absent = !empty($patientDet["root_abs"])?"Rootin absent - ":"";
//        $suck_Absent = !empty($patientDet["suck_abs"])?"sucking absent - ":"";
//        $root_Absent = !empty($patientDet["root_abs"])?"sucking absent - ":"";
//        $tonic_Absent = !empty($patientDet["tonicneck_abs"])?"tonic neck absent - ":"";
//        $palmar_Absent = !empty($patientDet["palmar_abs"])?"palmar absent - ":"";
//        $planter_Absent = !empty($patientDet["plantar_abs"])?"plantar absent - ":"";
//        $babinski_Absent = !empty($patientDet["babinski_abs"])?"babinski absent - ":"";
//        
//        $impresnRemark = "2$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
//            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
//            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
//            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
//            . "$baby_trauma $nbn500_referone $nbn500_refertwo $nbn4000_referone $nbn4000_refertwo $whitenoisy_referone"
//            . "$whitenoisy_refertwo $sceen1rtRefer $sceen1ltRefer $sceen2rtRefer $sceen2ltRefer $acanal_abnormal"
//            . "$moro_Absent $rooting_Absent $suck_Absent $root_Absent $tonic_Absent $palmar_Absent $planter_Absent $babinski_Absent" ;
//    
//    
//            
//    $updateImprRemark = "UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient'";
//    mysql_query($updateImprRemark);
//    
//    
//    $updateatrisk1 = "UPDATE `patient` SET `test_impression` ='2' WHERE `Patient_Id` = '$patient'";
//    echo "
//        <div class='row'>
//            <div class='col-md-12'>
//                <div class='col-md-6'>
//                    <h3><span class='label label-danger' >$msg12</span></h3>
//                </div>
//                <div class='col-md-5'>
//                    <select class='form-control' name='impresn'>
//                        ".getImpresionSelectList()."
//                    </select> 
//                </div>
//            </div>
//        
//         ";
//    echo "<p><h4>Impression Remark</h4></p>
//        <div class='col-md-12'>
//            <table class='table'>
//                <tbody>
//                    <tr>
//                        <th class='text-center'>HRR Screening</th>
//                        <th class=''>OAE</th>
//                        <th class=''>BOA</th>
//                        <th class=''>Acounstic analysis</th>
//                        <th class=''>Primitive Reflexes</th>
//                    </tr>
//                    <tr>
//                        <td>$hrrType</td>
//                        <td>
//                            <p>$sceen1rtRefer</p>
//                            <p>$sceen1ltRefer</p>
//                            <p>$sceen2rtRefer</p>
//                            <p>$sceen2ltRefer</p>
//                        </td>
//                        <td>
//                            <p>$nbn500_referone</p>
//                            <p>$nbn500_refertwo</p>
//                            <p>$nbn4000_referone</p>
//                            <p>$nbn4000_refertwo</p>
//                            <p>$whitenoisy_referone</p>
//                            <p>$whitenoisy_referone</p>
//                        </td>
//                        <td>
//                            <p>$acanal_abnormal</p>
//                        </td>
//                        <td>
//                            <p>$moro_Absent</p>
//                            <p>$root_Absent</p>
//                            <p>$suck_Absent</p>
//                            <p>$tonic_Absent</p>
//                            <p>$palmar_Absent</p>
//                            <p>$planter_Absent</p>
//                            <p>$babinski_Absent</p>
//                        </td>
//
//                    </tr>
//                </tbody>
//            </table>
//        </div>";
//    mysql_query($updateatrisk1);
//    
//    $nbslist = getNbsList($patientDetail);
////    $osclist = getOSCList();
//    
//    $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
//    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
//    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
//    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
//    $aiishradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
//    $aiishdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
//        echo ""
//        . "<div class='row'>
//                <h4>Refer to...</h4>
//                <!--<div class='col-md-12'> -->
//                    <div class='col-md-5 col-md-offset-1 form-group '>
//                        <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
//                    </div>
//                    <div class='col-md-5 col-md-offset-1 form-group'>
//                        <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
//                    </div>
//                <!--</div>-->
//                <div class='col-md-12 '>
//                    <div class='col-md-5 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
//                         $nbslist
//                    </div>
//
//                    <div class='col-md-5 col-md-offset-4 form-group osclistload' id='oscDV' style='$oscdivTogle'>
//                        ".getOSCList($patientDetail)."
//                    </div>
//                    <div class='col-md-3 col-md-offset-8 form-group aiishlistload' id='aiishDV' style='$aiishdivTogle'>
//                        ".getAIISHList($patientDetail)."
//                    </div>
//                    <div class='col-md-12 col-md-offset-8 form-group' id='' >
//                        <input type='text' id='nbsCheckedVal' hidden='' value=''> 
//                        <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
//                    </div>
//                </div>
//                
//            </div>
//            
//        ";
//    }
//    else{    
////    elseif ($patientDetail["hrr_type"] == 1 && $patientDetail["excessive_vomiting"] == 1 || $patientDetail["highlow_bp"] == 1 || $patientDetail["elderly_pregnanacy"] == 1 || $patientDetail["blood_sugar"] == 1 || $patientDetail["ho_abortions"] == 1 || $patientDetail["rh_incompatitlibility"] == 1 || $patientDetail["viralbacterial_infections"] == 1 || $patientDetail["oto_tox_med"] == 1 || $patientDetail["chem_fum"] == 1 || $patientDetail["alcohol"] == 1 || $patientDetail["smoking"] == 1 ||
////        $patientDetail["lbw"] == 1 || $patientDetail["fd"] == 1 || $patientDetail["ba"] == 1 || $patientDetail["nj"] == 1 || $patientDetail["as_1min"] == 1 || $patientDetail["as_5min"] == 1 || $patientDetail["birth_wt"] != NULL || $patientDetail["bilrubin_level"] != NULL || $patientDetail["delayed_birth_cry"] == 1 || $patientDetail["birthcrysec"] != NULL || $patientDetail["aspiration_of_fluid_days"] == 1 || $patientDetail["premature_delivery_week"] == 1 || $patientDetail["premature_delivery_val"]!= NULL ||
////        $patientDetail["csa"] == 1 || $patientDetail["ca"] == 1 || $patientDetail["dd"] == 1 || $patientDetail["vbf"] == 1 || $patientDetail["cnv"] == 1 || $patientDetail["omwe"] == 1 || $patientDetail["thn"] == 1 &&
////        $patientDetail["fivehz_80dBHL_pass"] == 1 || $patientDetail["fivehz_50dBHL_pass"] == 1 || $patientDetail["fourhz_80dBHL_pass"] == 1 || $patientDetail["fourhz_50dBHL_pass"] == 1 || $patientDetail["whitenoise_80dBHL_pass"] == 1 || $patientDetail["whitenoise_50dBHL_pass"] == 1 &&
////        $patientDetail["rt_pass"] == 1 || $patientDetail["lt_pass"] == 1 || $patientDetail["rt_two_pass"] == 1 || $patientDetail["lt_two_pass"] == 1 &&
////        $patientDetail["normal_val"] == 1 && $patientDetail["moro_pre"] == 1 || $patientDetail["suck_pre"] == 1 || $patientDetail["root_pre"] == 1 || $patientDetail["tonicneck_pre"] == 1 || $patientDetail["palmar_pre"] == 1 || $patientDetail["plantar_pre"] == 1 || $patientDetail["babinski_pre"] == 1) {
//        $s123 = "select `imp_name` from `tbl_impression` where `imp_id`='3' ";
//        $q123 = mysql_query($s123);
//        $r123 = mysql_fetch_assoc($q123);
//        $msg123 = $r123['imp_name'];
//
//        $updateatrisk2 = "UPDATE `patient` SET `test_impression` ='3' WHERE `Patient_Id` = '$patient'";
//        
//        
//        $ex_Vomit = !empty($patientDetail["excessive_vomiting"])?"Excessive vomiting - ":"";
//        $eld_Preg = !empty($patientDetail["elderly_pregnanacy"])?"Elderly Pregnancy - ":"";
//        $baby_bp = !empty($patientDetail["highlow_bp"])?"High/Low BP - ":"";
//        $blood_Sugar = !empty($patientDetail["blood_sugar"])?"Blood Sugar -":"";
//        $baby_Abortion = !empty($patientDetail["ho_abortions"])?"H/O Abortion - ":"";
//        $baby_rh = !empty($patientDetail["rh_incompatitlibility"])?"Rh Incompatibility - ":"";
//        $viral_Infection = !empty($patientDetail["viralbacterial_infections"])?"Viral Bacterial infection - ":"";
//        $oto_Medication = !empty($patientDetail["oto_tox_med"])?"Oto toxic medication - ":"";
//        $chem_Fume = !empty($patientDetail["chem_fum"])?"Chemical fumes - ":"";
//        $baby_alcohol = !empty($patientDetail["alcohol"])?"Alcohol - ":"";
//        $baby_smoke = !empty($patientDetail["smoking"])?"Smoking - ":"";
//        $weight_Less = !empty($patientDetail["lbw"])?" Low Birth weight>105kg - ":"";
//        $fetal_Distress = !empty($patientDetail["fd"])?"Fetal distress - ":"";
//        $birth_Asphyxia = !empty($patientDetail["ba"])?"birth asphyxia - ":"";
//        $baby_jaundice = !empty($patientDetail["nj"])?"Neonatak Jaundice - ":"";
//        $apg_Arone = !empty($patientDetail["as_1min"])?"APGAR Score: 0-4 @ 1min $bilLevel - ":"";
//        $apgarFive = !empty($patientDetail["as_5min"])?"APGAR Score: 0-6@ 5min - ":"";
//        $birth_weigt = !empty($patientDetail["birth_wt"])?"Birth weight $birth_wt - ":"";
//        $bil_Level = !empty($patientDetail["bilrubin_level"])?"Bilirubin Level $bilLevel - ":"";
//        $baby_birthcry = !empty($patientDetail["delayed_birth_cry"])?"Delayed birt cry $babybirthcry sec - ":"";
//        $baby_nicu = !empty($patientDetail["aspiration_of_fluid_days"])?"NIU $babynicu days - ":"";
//        $cranio_Facial = !empty($patientDetail["premature_delivery_week"])?"Craniofacial - ":"";
//        $co_Genital = !empty($patientDetail["csa"])?"Congential anomalies - ":"";
//        $de_Generative = !empty($patientDetail["dd"])?"Degenerative diseas - ":"";
//        $viral_Infect = !empty($patientDetail["vbf"])?"Viral/bacterial infection - ":"";
//        $baby_convulsions = !empty($patientDetail["cnv"])?"Convilsions - ":"";
//        $baby_otitis = !empty($patientDetail["omwe"])?"Otitis Media with effusion - ":"";
//        $baby_trauma = !empty($patientDetail["thn"])?"Trauma of heador neck - ":"";
//        
//        $nbn500_passone = !empty($patientDetail["fivehz_80dBHL_pass"])?"5000Hz warable Tone-Intensity 80dBHL Pass - ":"";
//        $nbn500_passtwo = !empty($patientDetail["fivehz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass -  - ":"";
//        $nbn4000_passone = !empty($patientDetail["fourhz_80dBHL_pass"])?"4000 warable Tone-Intensity 80dBHL Pass -  - ":"";
//        $nbn4000_passtwo = !empty($patientDetail["fourhz_50dBHL_pass"])?"5000Hz warable Tone-Intensity 50dBHL Pass -  - ":"";
//        $whitenoisy_passone = !empty($patientDetail["whitenoise_80dBHL_pass"])?"White noise-Intensity80dBHL Pass - ":"";
//        $whitenoisy_passtwo = !empty( $patientDetail["whitenoise_50dBHL_pass"])?"White noise-Intensity50dBHL Pass- ":"";
//        
//        $oaeright_pass = !empty( $patientDetail["rt_pass"])?"Screenone right Pass ":"";
//        $oaeleft_pass = !empty( $patientDetail["lt_pass"])?"Screenone left Pass ":"";
//        $oaeright_pass2 = !empty( $patientDetail["rt_two_pass"])?"Screen two right Pass ":"";
//        $oaeleft_pass2 = !empty( $patientDetail["lt_two_pass"])?"Screen two left Pass ":"";
//        
//        
//        $acanal_normal = !empty($patientDetail["normal_val"])?"Acounstic analysis normal - ":"";
//        
//        $moro_Present = !empty($patientDetail["moro_pre"])?"Moro Present - ":"";
//        $rooting_Present = !empty($patientDetail["root_pre"])?"Rootin Present - ":"";
//        $suck_Present = !empty($patientDetail["suck_pre"])?"sucking Present - ":"";
//        $tonic_Present = !empty($patientDetail["tonicneck_pre"])?"tonic neck Present - ":"";
//        $palmar_Present = !empty($patientDetail["palmar_pre"])?"palmar Present - ":"";
//        $planter_Present = !empty($patientDetail["plantar_pre"])?"plantar Present - ":"";
//        $babinski_Present = !empty($patientDetail["babinski_pre"])?"babinski Present - ":"";
//        
//        $impresnRemark = "$ex_Vomit $eld_Preg $baby_bp $blood_Sugar $baby_Abortion $baby_rh $viral_Infection"
//            . "$oto_Medication $chem_Fume $baby_alcohol $baby_smoke $weight_Less $fetal_Distress"
//            . "$birth_Asphyxia $baby_jaundice $apg_Arone $apgarFive $birth_weigt $bil_Level $baby_birthcry"
//            . "$baby_nicu $cranio_Facial $co_Genital $de_Generative $viral_Infect $baby_convulsions  $baby_otitis"
//            . "$baby_trauma $nbn500_passone $nbn500_passtwo $nbn4000_passone $nbn4000_passtwo $whitenoisy_passone"
//            . "$whitenoisy_passtwo $oaeright_pass $oaeleft_pass $oaeright_pass2 $oaeleft_pass2 $acanal_normal"
//            . "$moro_Present $rooting_Present $suck_Present $tonic_Present $palmar_Present $planter_Present $babinski_Present" ;
//    
//    echo "
//        <div class='row'>
//            <div class='col-md-5'>
//                <h3><span class='label label-warning' >$msg123</span></h3>
//            </div>
//            <div class='col-md-5'>
//                <select class='form-control' name='impresn'>
//                    ".getImpresionSelectList()."
//                </select> 
//            </div>
//        </div>
//        ";
//    mysql_query("UPDATE `patient` SET `impresn_remmark` = '$impresnRemark' WHERE `Patient_Id` = '$patient';");
//    mysql_query($updateatrisk2);
//    echo "<p><h4>Impression Remark</h4><label>$impresnRemark</label></p>";
//     $nbslist = getNbsList($patientDetail);
//     $nbsradioTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"checked=''":"";
//    $nbsdivTogle = ($patientDetail["nbs_refer"] != 0 || !empty($patientDetail["nbs_refer"]))?"display:block":"display:none";
//    $oscradioTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"checked=''":"";
//    $oscdivTogle = ($patientDetail["osc_refer"] != 0 || !empty($patientDetail["osc_refer"]))?"display:block":"display:none";
//    
//    echo ""
//    . "<div class='row'>
//            <h4>Refer to...</h4>
//            <!--<div class='col-md-12'> -->
//                <div class='col-md-5 col-md-offset-1 form-group '>
//                    <lable class='radio'><input type='radio' name='referto' value='1' id='nbscentr' $nbsradioTogle class='nbscentr'>NBS center</label>
//                </div>
//                <div class='col-md-5 col-md-offset-1 form-group'>
//                    <label class='radio'><input type='radio' name='referto' value='1' id='osccentr' $oscradioTogle class='osccentr'>OSC center</label>
//                </div>
//            <!--</div>-->
//            <div class='col-md-12 '>
//                <div class='col-md-5 col-md-offset-1 form-group nbslistload' id='nbsDV' style='$nbsdivTogle'>
//                     $nbslist
//                </div>
//            
//                <div class='col-md-5 col-md-offset-6 form-group osclistload' id='oscDV' style='$oscdivTogle'>
//                    ".getOSCList($patientDetail)."
//                </div>
//            </div>
//            <div class='col-md-12 col-md-offset-8 form-group' id='' >
//                <input type='text' id='nbsCheckedVal' hidden=''> 
//                <button class='btn btn-default' name = 'savePatRefer' id='savePatRefer' onclick = 'saveRefer($patient)' >Save</button>
//            </div>
//            <div class='col-md-12 '>
//                <a class='btn btn-info pull-right' href='".HostRoot."phoneF-up/{$patient}'>Phonr F/up</a>
//            </div>
//        </div>
//            
//        ";
//    
//        echo "
//            <!--<div class='col-md-8'>
//                <table class='table'>
//                    <tbody>
//                        <tr>
//                            <th>POCD no.</th>
//                            <th>Baby id</th>
//                            <th>Baby name</th>
//                            <th>Date of exam</th>
//                        </tr>
//                    
//                        <tr>
//                            <td class='text-center'>{$patientDetail["POCD_No"]}</td>
//                        
//                            <td class='text-center'>{$patientDetail["baby_id_num"]}</td>
//                        
//                            <td class='text-center'>{$patientDetail["Baby_name"]}</td>
//                        
//                            <td class='text-center'>{$patientDetail["Date_of_HRR_Screen"]}</td>
//                        </tr>
//                    </tbody>
//                </table>    
//            </div>-->
//        ";
//    }
}


function getPfupBymnth($pID, $mnth){
    $qry_pfup = "SELECT `pfup_id`, `Patient_Id`, `pfup_remark`, `pfup_month` FROM `tbl_phonef_up` WHERE `Patient_Id` = '$pID' AND `pfup_month` = '$mnth'";
    $result = mysql_query($qry_pfup);
    $data = mysql_fetch_assoc($result);
    
    return $data;
    
}