<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>User List</h1>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">
        <!--<div class="row">-->
            <div class="col-xs-12">
                <div class="box">

                    <?php echo getSessionMsg() ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><h5>Email</h5></th>
                                    <th><h5>Username</h5></th>
                                    <th><h5>Status</h5></th>
                                    <th><h5>Action</h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo getUserList(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        <!--</div>-->
        
    </div>
</section><!-- end section -->