<?php

include_once '../lib/maincore.php';

$patID = $_POST["patient_Id"];
$SelImp = $_POST["imprSel"];
$impresion = getImprsnNameByID($SelImp);

$qry_1 = mysql_query("UPDATE `patient` SET `test_impression` = '' WHERE `Patient_Id` = ''");

switch ($SelImp){
    case "1": echo "<h3><span class='label label-success' >$impresion</span></h3>";
        break;
    case "2": echo "<h3><span class='label label-danger' >$impresion</span></h3>";
        break;
    case "3": echo "<h3><span class='label label-warning' >$impresion</span></h3>";
        break;
    default :"";
}           

//echo "<h3><span class='label label-success' >$impresion</span></h3>";