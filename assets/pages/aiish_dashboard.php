<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Dashboard</h1>
                <!--<div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>-->
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">
        <div class="row">
            <!--<div class="col-md-5 col-sm-7 border_top">-->
                <!--<div class="separator_40"></div>-->
                <ul class="list-mark">
                    <?php if(USERAUTH == "1"){ ?>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>User Create</span></a></li>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>Role Create</span></a></li>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>Add States</span></a></li>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>Add Districts</span></a></li>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>Add Cities</span></a></li>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>Approval</span></a></li>
                    <li><a class="icon icon-login" href="<?php echo HostRoot ?>data-entry"><span class='panel-title'>NBS Data entry</span></a></li>
                    <li><a class="icon icon-login" href="<?php echo HostRoot ?>screening-list"><span class='panel-title'>NBS Screening</span></a></li>

                    <?php } ?>
                    <li><a class="icon icon-login" href="javascript:void(0);"><span class='panel-title'>Register</span></a></li>
                    
                </ul>
            <!--</div>-->
        </div>
        
    </div>
</section><!-- end section -->