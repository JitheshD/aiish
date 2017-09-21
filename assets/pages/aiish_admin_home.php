<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php if(USERAUTH == 1){ ?><h1>Administrator home</h1><?php } else{?><h1>Medical Officer Page</h1><?php } ?>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div>

<section class="section-large">
    <div class="container">

        <div class="row">
            <?php if(USERAUTH == 1){ ?>
            <div class="list-services">
                <div class="col-md-6 list-services__item wow bounceInRight" data-wow-delay="1s">
                    <span class="icon-round bg-color_second helper"><i class="icon flaticon-eye64"></i></span>
                    <div class="list-services__inner border_btm">
                        <h3 class="list-services__title"><a href="<?php echo HostRoot ?>registration">Registration</a></h3>
                        <!--<p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius</p>-->
                    </div>
                </div>
                <div class="col-md-6 list-services__item wow bounceInRight" data-wow-delay="1s">
                    <span class="icon-round bg-color_second helper"><i class="icon flaticon-eye64"></i></span>
                    <div class="list-services__inner border_btm">
                        <h3 class="list-services__title"><a href="<?php echo HostRoot ?>reset-password">Reset User Password</a></h3>
                        <!--<p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius</p>-->
                    </div>
                </div>
                <div class="col-md-6 list-services__item wow bounceInRight" data-wow-delay="1s">
                    <span class="icon-round bg-color_second helper"><i class="icon flaticon-eye64"></i></span>
                    <div class="list-services__inner border_btm">
                        <h3 class="list-services__title">Freeze Users</h3>
                        <!--<p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius</p>-->
                    </div>
                </div>
                <div class="col-md-6 list-services__item wow bounceInRight" data-wow-delay="1s">
                    <span class="icon-round bg-color_second helper"><i class="icon flaticon-eye64"></i></span>
                    <div class="list-services__inner border_btm">
                        <h3 class="list-services__title"><a href="<?php echo HostRoot ?>userlist">Lists of Users</a></h3>
                        <!--<p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius</p>-->
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
            </div><!-- end list-services -->
            <?php }else{ ?>
                <div class="list-services">
                    <div class="col-md-5 list-services__item wow bounceInRight" data-wow-delay="1s">
                        <span class="icon-round bg-color_second helper"><i class="icon flaticon-eye64"></i></span>
                        <div class="list-services__inner border_btm">
                            <h3 class="list-services__title"><a href="<?php echo HostRoot ?>approval">POCD Activities Approval</a></h3>
                            <!--<p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius</p>-->
                        </div>
                    </div>
                    <div class="col-md-5 list-services__item wow bounceInRight" data-wow-delay="1s">
                        <span class="icon-round bg-color_second helper"><i class="icon flaticon-eye64"></i></span>
                        <div class="list-services__inner border_btm">
                            <h3 class="list-services__title"><a href="<?php echo HostRoot ?>data-entry">POCD Data Entry</a></h3>
                            <!--<p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius</p>-->
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </div>
</section><!-- end section -->