            </div>
            <!-- start: FOOTER -->
            <footer>
                <div class="footer-inner">
                    <div class="pull-left">
                        &copy; <span class="current-year"></span> <span class="text-bold text-uppercase">Zill Panchayath, Chamarajanagara</span>. <span>All rights reserved</span>
                        
                    </div>
                    <div class="pull-right">
                        <a href="http://www.leobots.com"><small>Developed by Leobots Technologies</small></a>&nbsp;&nbsp;<span class="go-top"><i class="ti-angle-up"></i></span>
                    </div>
                </div>
            </footer>
            <!-- end: FOOTER -->
            
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--extra-->
        
        <script src="<?php echo HostRoot; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/modernizr/modernizr.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/switchery/switchery.min.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="<?php echo HostRoot; ?>vendor/Chart.js/Chart.min.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/jquery.sparkline/jquery.sparkline.min.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <!-- start: CLIP-TWO JAVASCRIPTS -->
        <script src="<?php echo HostRoot; ?>assets/js/main.js"></script>
        <script src="<?php echo HostRoot; ?>assets/js/master.admin.js"></script>
        <!-- start: JavaScript Event Handlers for this page -->
        <script src="<?php echo HostRoot; ?>vendor/selectFx/classie.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/selectFx/selectFx.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/select2/select2.min.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/DataTables/jquery.dataTables.min.js"></script>
        <script src="<?php echo HostRoot; ?>assets/js/table-data.js"></script>
        <script src="<?php echo HostRoot; ?>assets/js/index.js"></script>
        <script src="<?php echo HostRoot; ?>vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?php echo HostRoot; ?>plugins/tabs/tab.js"></script>
        <script src="<?php echo HostRoot; ?>plugins/toast/xl-toast.js"></script>
        <script>
//            $(document).ready(function() {
//                $('#middlePat').click(function() {
//                    $.toast({title: 'Patient Data submitted succesfully', position: 'middle'});
//                });
//
//
//            });

        </script>
        <!--toast js-->
        <script type="text/javascript" src="<?php echo HostRoot ?>assets/js/script/showToast.js"></script>
        <script>
            jQuery(document).ready(function () {
                Main.init();
                Index.init();
            });
        </script>
        
        <!--Table export plugin-->
        <script type="text/javascript" src="<?php echo HostRoot; ?>assets/js/jquery.table2excel.js"></script>  
        <!-------->
        <script>
            function saveStockIn(id){
                var stockin = $("#stockin_"+id).val();
                var month = $("#month_"+id).val();
                var hostel = $("#hostel_"+id).val();
                var asset = $("#asset_"+id).val();
                var quantity = $("#qty_"+id).val();
                var total = $("#total_"+id).val();
                $.ajax({
                   type: "POST",
                   url: Root+"assets/ajax/todo_stockin.php",
                   data: {stockinid: stockin, mnth: month, hostelid: hostel, assetid: asset, qty: quantity, tot: total},
                   cache: false,
                   success:function (result) {
                       showToast.show('Saved Successfully',2000)
//                       alert(result);
                   }
                });
            }
            
            
 
            function saveStockOut(id){
                var stockout = $("#stockout_"+id).val();
                var month = $("#month_"+id).val();
                var hostel = $("#hostel_"+id).val();
                var asset = $("#asset_"+id).val();
                var quantity = $("#qty_"+id).val();
                $.ajax({
                   type: "POST",
                   url: Root+"assets/ajax/todo_stockout.php",
                   data: {stockoutid: stockout, mnth: month, hostelid: hostel, assetid: asset, qty: quantity},
                   cache: false,
                   success:function (result) {
                       console.log(result);
                       showToast.show('Saved Successfully',2000)
                   }
                });
            }
            
            
            function monthlyRequirement(asset){
                var hostel = $("#hostel_"+asset).val();
                var astid = $("#asset_"+asset).val();
                var req_quantity = $("#reqqty_"+asset).val();
                $.ajax({
                   type: "POST",
                   url: Root+"assets/ajax/todo_req_qty.php",
                   data: {hostelid: hostel, assetid: astid, reqqty: req_quantity},
                   cache: false,
                   success:function (result) {
                       showToast.show('Saved Successfully',2000)
                   }
                });
            }
            
        
            
            
            
        </script>
            
        <!-- end: JavaScript Event Handlers for this page -->
        <!-- end: CLIP-TWO JAVASCRIPTS -->
    </body>
</html>
