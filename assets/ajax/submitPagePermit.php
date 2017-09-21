<?php

include_once '../lib/maincore.php';

$roleType = mysql_real_escape_string($_POST["role"]);
$Page_name = mysql_real_escape_string($_POST["pageName"]);
$index = mysql_real_escape_string($_POST["uniqId"]);

$selPageInform = "SELECT `page_id`, `page_name`, `role_type`, `permissions` FROM `tbl_page_permission` WHERE `page_name` = '$Page_name' AND `role_type` = '$roleType'";
//echo $selPageInform;
$result = mysql_query($selPageInform);
$rw = mysql_fetch_array($result);
$perRadChk1 = ($rw["permissions"] == 1)?"checked=''":"";
$perRadChk2 = ($rw["permissions"] == 2)?"checked=''":"";
$perRadChk3 = ($rw["permissions"] == 3)?"checked=''":"";

echo "<div id = 'pageId$index'><input hidden='' type='text' name='' id='perPageId$index' value='{$rw["page_id"]}'></div>
    <label class='control-label radio-inline'><input type='radio' size='' name='gender$index' class='roleRad$index ' id='view$index' onclick = 'perChange(\"$roleType\", \"$Page_name\", \"{$rw["page_id"]}\", \"$index\")' $perRadChk1  value='1' >View</label>
    <label class='control-label radio-inline'><input type='radio' size='' name='gender$index' class='roleRad$index ' id='edit$index' onclick = 'perChange(\"$roleType\", \"$Page_name\", \"{$rw["page_id"]}\", \"$index\")' $perRadChk2  value='2'  >Edit</label>
    <label class='control-label radio-inline'><input type='radio' size='' name='gender$index' class='roleRad$index ' id='restricted$index' onclick = 'perChange(\"$roleType\", \"$Page_name\", \"{$rw["page_id"]}\", \"$index\")' $perRadChk3 value='3'  >Restricted</label>
";
?>
<script>
    function perChange(role, page, pageid, index ){
        permision = $(".roleRad"+index+":checked").val();
        var pagePerId = $("#perPageId"+index).val();
       // alert(pagePerId);
        
        $.ajax({
                type: "POST",
                url: Root + 'assets/ajax/ChangePermission.php',
                data: {roleType: role, pageName: page, page_Id: pagePerId, permisnType: permision, indexVal: index},
                cache: false,
                success: function (data) {
                    if (data) {
                           //alert(data); 
                           $('#pageId'+index).fadeOut('fast', function () {
                                $('#pageId'+index).fadeIn('fast').html(data);
                            });
                        }
                        showToast.show('New page permission added',2000);

                }

            });
       
    }
</script>