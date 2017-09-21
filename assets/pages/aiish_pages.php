
<?php// echo "INfo {$_SERVER['REMOTE_ADDR']} - Host Name - ".@getHostByAddr($_SERVER['REMOTE_ADDR'])." - Request time : {$_SERVER['REQUEST_TIME']} - ".time()."";


?>


<section class="section-large">
    <div class="container">
        <table id="example" class="table table-striped table-hover table-bordered results">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th class="col-md-5 col-xs-5">Page name</th>
                    <th class="col-md-4 col-xs-4">Role Type</th>
                    <th class="col-md-3 col-xs-3">Permisions</th>
                </tr>
                
            </thead>
            <tbody>
<!--                <tr class="warning no-result">
                    <td colspan="7"><i class="fa fa-warning"></i> No result</td>
                </tr>-->
                <?php echo pagesList() ?>
    
            </tbody>
        </table>
        
    </div>
</section>

<script>
    
    function roleSelect(index, page){
        var rolesel = $("#rolesel"+index).val();
        var pages = page;
        
         if(rolesel > 0){
            $(".roleRad"+index).removeAttr("disabled");
            
            $.ajax({
                    type: "POST",
                    url: Root + 'assets/ajax/submitPagePermit.php',
                    data: {role: rolesel, pageName: pages, uniqId: index},
                    cache: false,
                    success: function (data) {
                        if (data) {
                            //alert(data);
                                $('#DvPageID'+index).fadeOut('fast', function () {
                                    $('#DvPageID'+index).fadeIn('fast').html(data);
                                });
                            }
                            //showToast.show('New page permission added',2000);

                    }

                });
        }
    }
    
    
    
    
//    $("#rolesel").change(function(){
//        var rolesel = $("#rolesel").val();
//        if(rolesel > 0){
//            $(".roleRad").removeAttr("disabled");
//        }
//
//      });
</script>
 
                        
                            