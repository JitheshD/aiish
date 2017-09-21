<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../lib/maincore.php';

$mobile_number =  $_POST["contactno"];  
$message = "Phone Followup test message";
$SMS_Message = friendly_string($message);
$msg = urlencode($SMS_Message); //160 char length
        //echo urldecode($SMS_Message);
        $key = "569661af6b9fd";
        $senderID = "LBTECH";

        $mobile = preg_replace("/\r\n/", ",", $mobile_number); 
        
        file_get_contents("http://softsms.in/app/smsapi/index.php?key={$key}&type=text&contacts={$mobile}&senderid={$senderID}&msg={$msg}");
        echo "http://softsms.in/app/smsapi/index.php?key={$key}&type=text&contacts={$mobile}&senderid={$senderID}&msg={$msg}";


echo "$mobile_number";

function friendly_string($string) {
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');

    return $string;
}