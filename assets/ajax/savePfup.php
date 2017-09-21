<?php

include_once '../lib/maincore.php';

//$explodeMnthId = mysql_real_escape_string($_POST["month"]);
$remark = mysql_real_escape_string($_REQUEST["refrRemark"]);

echo "$remark";