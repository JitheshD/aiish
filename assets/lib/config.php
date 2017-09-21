<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "aiish_db6";

//Set Directory Level
global $page_name, $_PID;

$url = explode("/", $_GET["parm"]);

$page_name = $url[0];

$_PID = getParameter($url);
/////////////////////////
//Set page prefix
define("PREFIX", "aiish");

//Set database table prefix
define("DB_PREFIX", "aiish"); //optional

//Define url page masking value
define("404", "404");
define("home", "home");
define("admin-home", "admin_home");
define("create-role", "create_role");
define("add-user", "add_user");
define("add-state", "add_state");
define("add-district", "add_district");
define("add-taluk", "add_taluk");
define("add-aiish", "add_aiish");
define("add-nbs", "add_nbs");
define("add-osc", "add_osc");
define("add-hospital", "add_hospital");
define("pages", "pages");
define("registration", "registration");
define("reset-password", "reset_password");
define("userlist", "userlist");
define("requisition-form", "requisition_form");
define("approval", "approval");
define("data-entry", "data_entry");
define("phoneF-up", "phonefup");
define("phonefup", "phnfup");
define("screening-list", "screening_list");
define("user", "userinfo");
define("dashboard", "dashboard");
define("signup", "signup");
define("category", "category");
define("sub-category", "subcategory");
define("logout", "logout");
define("test", "test");
define("test1", "test1");
define("test-upload", "test_upload");

//////////////////////
setlocale(LC_MONETARY, 'en_IN');
//Set Location Time Zone
$timezone = "Asia/Calcutta";
if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set($timezone);
}

//Get Page Name by URL reference
function getPageByReference($case) {
    return (defined($case)) ? constant($case) : "404";
}

function getParameter($url) {
    $level = $cid = $pid = $p1 = "";
    $size = sizeof($url);
    for ($i = $size; $i >= 0; $i--) {

        $level .= (empty($level) || $i == 0) ? "./" : "../";
        $p1 = $url[$i];
        if (is_numeric($p1) || is_numeric(decode($p1))) {
            $cid = $p1;
        } elseif (!empty($p1) && !is_numeric($p1)) {
            $pid[$p1] = $cid;
            $cid = "";
        }
    }
    define("HostRoot", $level);
    return $pid;
}
?>
