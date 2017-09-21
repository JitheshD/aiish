<?php

// Prevent any possible XSS attacks via $_GET.
if (stripget($_GET)) {
    die("Prevented a XSS attack through a GET variable!");
}

//Hide Session Error
error_reporting(1);

// Locate config.php and set the basedir path
$folder_level = "";
if(!isset($db_host)){
    $i = 0;
    while (!file_exists($folder_level . "assets/lib/config.php")) {
        $folder_level .= "../";
        $i++;
        //echo "<script>alert($i)</script>";
        if ($i == 7) {
            die("assets/lib/config.php file not found");
        }
    }
    include_once $folder_level."assets/lib/config.php";
    include_once $folder_level."assets/PHPMailer-master/PHPMailerAutoload.php";
    
}


// Establish mySQL database connection
$link = dbconnect($db_host, $db_user, $db_pass, $db_name);
unset($db_host, $db_user, $db_pass);

if (session_id() == '') {
    // session isn't started
    session_start();
    ob_start();
}



if (isset($_SESSION['LBT_USER']) && !empty($_SESSION['LBT_USER'])) {
    define("USERNAME", $_SESSION['LBT_USER']['user_email']);
    define("USERFULLNAME", $_SESSION['LBT_USER']['user_name']);
    define("USERID", $_SESSION['LBT_USER']['user_id']);
    define("USERAUTH", $_SESSION['LBT_USER']['role_id']);
}


if (file_exists($folder_level . "assets/update_query/query.php")) {
    include_once $folder_level . "assets/update_query/query.php";
    unlink($folder_level . "assets/update_query/query.php");
    //redirect($location);
}

include_once $folder_level . "assets/lib/db_query.php";
include_once $folder_level . "assets/lib/pro_query.php";


//define("SEARCHBY", $searchBy);
function dbconnect($db_host, $db_user, $db_pass, $db_name) {
    global $db_connect;

    $db_connect = @mysql_connect($db_host, $db_user, $db_pass);
    $db_select = @mysql_select_db($db_name);
    if (!$db_connect) {
        die("<strong>Unable to establish connection to MySQL</strong><br />" . mysql_errno() . " : " . mysql_error());
    } elseif (!$db_select) {
        include $folder_level . 'assets/lib/query.php';
        die("<strong>Unable to select MySQL database</strong><br />" . mysql_errno() . " : " . mysql_error());
    }
}

// Redirect browser using header or script function
function redirect($location, $script = false) {
    if (!$script) {
        header("Location: " . str_replace("&amp;", "&", $location));
        exit;
    } else {
        echo "<script type='text/javascript'>document.location.href='" . str_replace("&amp;", "&", $location) . "';</script>\n";
        exit;
    }
}

// Prevent any possible XSS attacks via $_GET.
function stripget($check_url) {
    $return = false;
    if (is_array($check_url)) {
        foreach ($check_url as $value) {
            if (stripget($value) == true) {
                return true;
            }
        }
    } else {
        $check_url = str_replace(array("\"", "\'"), array("", ""), urldecode($check_url));
        if (preg_match("/<[^<>]+>/i", $check_url)) {
            return true;
        }
    }
    return $return;
}

//Encode String
function encode($content) {
    $con = new Encryption();
    return $con->encode($content);
   // return base64_encode($content);
}

//Decode String
function decode($content) {
    $con = new Encryption();
    return $con->decode($content);
   // return base64_decode($content);
}

//Execute Commands
function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r")); 
    }
    else {
        exec($cmd . " > /dev/null &");  
    }
}


function check_string($str) {
    return (!empty($str)) ? $str : "";
}

function getRegdate() {
    //return date("l, F d\\t\h Y", time());
    return date("Y/m/d", time());
}

function dateDiff($d1, $d2) {
    $datetime1 = new DateTime($d1);
    $datetime2 = new DateTime($d2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%a');
}

function timeDiff($d1, $d2) {
    $datetime1 = new DateTime($d1);
    $datetime2 = new DateTime($d2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%H:%I');
}

function convertDate($originalDate) {
    return date("d/m/Y", strtotime($originalDate));
}

function conDateToNormalFormat($originalDate) {
    return date("F jS\, Y", strtotime($originalDate));
    
}

function convertToSqlDate($originalDate) {
//    $originalDate = str_replace('-', '/', $originalDate);
//    return date("Y-m-d", strtotime($originalDate));
    //return date("Y-m-d", strtotime($originalDate));
    return implode("/", array_reverse(explode("-", $originalDate)));
}

function convertFromSqlDate($originalDate) {
//    $originalDate = str_replace('/', '-', $originalDate);
//    return date("d-m-Y", strtotime($originalDate));
    return implode("-", array_reverse(explode("/", $originalDate)));
}

function randLetter() {
    $int = rand(0, 63);
    $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $rand_letter = $a_z[$int];
    return $rand_letter;
}

// function to display 100 limit words from any discription....
function string_limit_words($string, $word_limit = 100, $ending = '&hellip;') {
    $words = explode(' ', $string);
    if (count($words) > $word_limit) {
        return implode(' ', array_slice($words, 0, $word_limit)) . $ending;
    }
    return $string;
}



?>


<?php

//Password Encryption
class Encryption {

    var $skey = "yourSecretKeyabc"; // you can change it

    public function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function encode($value) {
        if (!$value) {
            return false;
        }
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        //echo "crypt text: ".$crypttext."--";
        return trim($this->safe_b64encode($crypttext));
    }

    public function decode($value) {
        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

}


?>
<?php
function emailFormat($content, $mailType=1){
    //$set = getSettingByID();
    $data = ""
        . "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
    <head>
        <meta http-equiv = 'Content-Type' content = 'text/html; charset=iso-8859-1'>
        <title>DISHA</title>
    </head>
    <body>
        <div class='wapper' style='width: 95%; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 11px; border:1px solid #dddddd; overflow: auto; zoom:1;'>
            <div class='wapper-header' style='text-align:center; padding: 10px; background: #00cbba; /*border-bottom: #1b1b1b 1px solid;*/'>
                <h3 align=center>DISHA</h3>
            </div>
            <div class='wapper-body' style='min-height: 200px; padding:10px; font-size:12px;'>
                {$content}
            </div>
        </div>
    </body>
</html>";
    
    return $data;
}

?>

<?php 
class BatchMailer {

    var $mail;

    function __construct ($mail) {
        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->Host = 'mail.leobots.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'noreply@leobots.com';
        $this->mail->Password = 'tech_1234';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->SMTPKeepAlive = true;
        $this->mail->Port = 465;
        $this->mail->From = 'noreply@leobots.com';
        $this->mail->FromName = 'DISHA';
        $this->mail->WordWrap = 50;
        $this->mail->isHTML(true);
        $this->mail->AltBody = 'Please use an HTML-enabled email client to view this message.';
    }

    function setSubject ($subject) {
        $this->mail->Subject = $subject;
    }

    function setBody ($body) {
        $this->mail->Body = stripslashes($body);
    }

    function sendTo ($to) {
        $this->mail->clearAddresses();
        $this->mail->addAddress($to);

        if (!$this->mail->send()) {
            // echo 'Mailer Error: ' . $this->mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

}

?>