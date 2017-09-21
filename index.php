<?php
define("Root",dirname(__FILE__)."/");

//Main Configuration
include_once Root."assets/lib/maincore.php";

////If Parameter Empty the load dashboard
$case = (empty($page_name)) ? "home" : getPageByReference($page_name);

//Check User login status
if (!isset($_SESSION['LBT_USER']) && empty($_SESSION['LBT_USER'])) {
//    if($page_name == "" || $page_name == "login"){
//        include_once Root."assets/pages/".PREFIX."_login.php";
//    }
//    elseif($page_name == "requisition-form"){
//        echo "Test";
        include_once Root."assets/common/".PREFIX."_header.php";

        
        //////Load Page Body Content
        include_once Root."assets/pages/".PREFIX."_home.php";

        ////Load Page Footer Content
        include_once Root."assets/common/".PREFIX."_footer.php";
//    }

}elseif($page_name == "logout"){
    include_once Root."assets/pages/".PREFIX."_logout.php";
}else{
    

//Load Page Header Content
include_once Root."assets/common/".PREFIX."_header.php";

//////Load Page Body Content
include_once Root."assets/pages/".PREFIX."_{$case}.php";

////Load Page Footer Content
include_once Root."assets/common/".PREFIX."_footer.php";
}

//include_once Root."assets/common/log.php";
?>
