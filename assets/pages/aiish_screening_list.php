<style>
    .results tr[visible='false'],
    .no-result{
        display:none;
    }

    .results tr[visible='true']{
        display:table-row;
    }

    .counter{
        padding:8px; 
        color:#ccc;
    }
</style>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php if (USERAUTH == 2) { ?><h1>Medical Officer Page</h1><?php } ?>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">


        <span class="counter pull-right"></span>
        <table id="example" class="table table-striped table-hover table-bordered results">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th class="col-md-5 col-xs-5">Baby name</th>
                    <th class="col-md-4 col-xs-4">Baby ID No.</th>
                    <th class="col-md-3 col-xs-3">POCD No.</th>
                    <th class="col-md-3 col-xs-3">Contact number</th>
                    <th class="col-md-3 col-xs-3">Impression</th>
                    <th class="col-md-3 col-xs-3">Status</th>
                    <th class="col-md-3 col-xs-3">Action</th>
                </tr>
                
            </thead>
            <tbody>
<!--                <tr class="warning no-result">
                    <td colspan="7"><i class="fa fa-warning"></i> No result</td>
                </tr>-->
                <?php echo getScreeningList(); ?>
    <!--            <tr>
                    <th scope="row">1</th>
                    <td>Vatanay Özbeyli</td>
                    <td>UI & UX</td>
                    <td>Istanbul</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Burak Özkan</td>
                    <td>Software Developer</td>
                    <td>Istanbul</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Egemen Özbeyli</td>
                    <td>Purchasing</td>
                    <td>Kocaeli</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Engin Kızıl</td>
                    <td>Sales</td>
                    <td>Bozuyük</td>
                </tr>-->
            </tbody>
        </table>

        <!--        <div class="row">
                    
                </div>-->
    </div>
</section><!-- end section -->

<script>
    //    followup sms
 function folwUpSms(mblno){
     //alert(mblno);
     $.ajax({
            type: "POST",
            url: Root+'assets/ajax/sendFolwupSms.php',
            data: {contactno: mblno},
            cache: false,
            success:function (data) {
                console.log(data);
//                $('#impresn').fadeOut('fast', function () {
//                    $('#impresn').fadeIn('fast').html(data);
//
//                 });
               }

            });
 }
////  
//    $(document).ready(function () {
//        $('#example').DataTable({
//            "pagingType": "full_numbers"
//        });
//
//
//        $(".search").keyup(function () {
//            var searchTerm = $(".search").val();
//            var listItem = $('.results tbody').children('tr');
//            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
//
//            $.extend($.expr[':'], {'containsi': function (elem, i, match, array) {
//                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
//                }
//            });
//
//            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
//                $(this).attr('visible', 'false');
//            });
//
//            $(".results tbody tr:containsi('" + searchSplit + "')").each(function (e) {
//                $(this).attr('visible', 'true');
//            });
//
//            var jobCount = $('.results tbody tr[visible="true"]').length;
//            $('.counter').text(jobCount + ' item');
//
//            if (jobCount == '0') {
//                $('.no-result').show();
//            } else {
//                $('.no-result').hide();
//            }
//        });
//    });
</script>