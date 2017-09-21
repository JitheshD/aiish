<?php
include_once '../lib/maincore.php';


$country=intval($_GET['country']);

$query="SELECT `dist_id`, `distname` as state FROM `tbl_districts` WHERE `state_id` = '$country'";
$result=mysql_query($query);

?>
<div class="form-group" >
<select class="form-control" name="district" id="district" onchange="getCity(<?php echo $country?>,this.value)">
<option disabled selected value>Select District</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value="<?php echo $row['dist_id']?>" ><?php echo $row['state']?></option>
<?php } ?>
</select>
</div>

<!--$country=intval($_GET['country']);
$con = mysqli_connect('localhost', 'root', ''); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysqli_select_db($con,'aiish1');
$query="SELECT dist_id ,distname as state FROM tbl_districts WHERE state_id='$country'";
$result=mysqli_query($con,$query);

?>
<div class="form-group" >
<select class="form-control" name="state_up" id="district" onchange="getCity(<?php echo $country?>,this.value)">
<option>Select District</option>
<?php while ($row=mysqli_fetch_array($result)) { ?>
<option value=<?php echo $row['dist_id']?>><?php echo $row['state']?></option>
<?php } ?>
</select>
</div>-->


