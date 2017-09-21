<?php
include_once '../lib/maincore.php';

$birthday = strip_tags($_POST["birthday"]);
$bdayConvert = DateTime::createFromFormat('d/m/Y', $birthday);
$bday = $bdayConvert->format('Y-m-d');
$today = date("Y-m-d");
$diff = date_diff(date_create($bday), date_create($today));

$day=$diff->format('%d');
$month=$diff->format('%m');
$year=$diff->format('%y');


echo "
    <label  name='age'>Age</label>
    <input name='age' class='form-control' size='40' id='baby_age' readonly='' value='$year year ,$month month ,$day day'>  
";