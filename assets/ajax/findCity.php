<?php 
include_once '../lib/maincore.php';

$countryId=intval($_GET['country']);
$stateId=intval($_GET['state']);
//$con = mysqli_connect('localhost', 'root', ''); 
//if (!$con) {
//    die('Could not connect: ' . mysql_error());
//}
//mysqli_select_db($con,'aiish1');
 $query="SELECT city_id,cityname FROM tbl_cities WHERE state_id='$countryId' AND dist_id='$stateId'"; 
$result=mysql_query($query);

?>
<div class="form-group">
    <select class="form-control" name="city" id="city">
<option disabled selected value>Select Taluk</option>
<?php while($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['city_id']?>><?php echo $row['cityname']?></option>
<?php } ?>
</select>
</div>
