<?php 
 $formData = toDoApproval($_PID);
 
?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Approval Page</h1>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="col-md-2 col-md-offset-1"></div>
                    <div class="col-md-4 col-md-offset-1">
                        <form method="POST" action="">
                            <div role="select" class="jelect">
                                <input id="jelect" name="org" data-text="imagemin" type="text" onchange="this.form.submit()" class="jelect-input required" value="">
                                <div tabindex="0" role="button" class="jelect-current">Select Organization</div>

                                <ul class="jelect-options" name="role">

                                    <?php echo getOrgSelection() ?>
    <!--                                <li data-val='0' tabindex="0" role="option" class="jelect-option jelect-option_state_active">Role 1</li>
                                    <li data-val='1' tabindex="0" role="option" class="jelect-option">Role 2</li>
                                    <li data-val='2' tabindex="0" role="option" class="jelect-option">Role 3</li>-->
                                </ul>
                            </div>
                        </form>
                    </div>

                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><h5>Batch Number</h5></th>
                                    <th><h5>Organization Name</h5></th>
                                    <th><h5>Contact Person Name</h5></th>
                                    <th><h5>Phone no.</h5></th>
                                    <th><h5>Email ID</h5></th>
                                    <th><h5>Fax</h5></th>
                                    <th><h5>Paying Attention for</h5></th>
                                    <th><h5>Screening Program</h5></th>
                                    <th><h5>Expected Program Date</h5></th>
                                    <th><h5>Program Time</h5></th>
                                    <th><h5> Approval Status</h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getRequisitionList($_POST["org"]); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        
    </div>
</section><!-- end section -->