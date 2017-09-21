<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../lib/maincore.php';

$mobileno = strip_tags($_POST["smsnum"]);

$sendmsg = friendly_string("Please contact with bellow AIISH for further Test - 857458678");

$msg = urlencode($sendmsg);

$key = "569661af6b9fd";
$senderID = "lbtech";

$mobile = preg_replace("/\r\n/", ",", $mobileno);
echo "http://softsms.in/app/smsapi/index.php?key={$key}&type=text&contacts={$mobile}&senderid={$senderID}&msg={$msg}";
file_get_contents("http://softsms.in/app/smsapi/index.php?key={$key}&type=text&contacts={$mobile}&senderid={$senderID}&msg={$msg}");
        //echo "http://softsms.in/app/smsapi/index.php?key={$key}&type=text&contacts={$mobile}&senderid={$senderID}&msg={$msg}";
    // $_SESSION["su"] = "SMS has been sent successfully. . .";
