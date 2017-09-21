<?php
//    if (isset($_POST['PostInfo'])) {
//        doLogin($_POST); //On submit check login Status
//    }
?>

<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from html.templines.com/health/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 May 2017 06:42:59 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HEALTHCARE Agency dsdsads</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
        <link href="<?php echo HostRoot ?>css/master.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo HostRoot ?>plugins/iview/css/iview.css" type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo HostRoot ?>plugins/iview/css/skin/style.css" type='text/css' media='all' />
        <script type="text/javascript" src="<?php echo HostRoot ?>js/jquery-1.11.1.min.js"></script>
        <script src= "<?php echo HostRoot ?>js/jquery-migrate-1.2.1.js" ></script>
        <script src="<?php echo HostRoot ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo HostRoot ?>js/bootstrap-3.1.1.min.js"></script>
        <script src="<?php echo HostRoot ?>js/modernizr.custom.js"></script>
    </head>

    <body>
        <div class="layout-theme animated-css"  data-header="sticky" data-header-top="200"  > 

            <!-- Loader Landing Page -->
            <div id="ip-container" class="ip-container"> 
                <!-- initial header -->
                <header class="ip-header" >
                    <div class="ip-loader">
                        <div class="text-center">
                            <div class="ip-logo"><img  src="<?php echo HostRoot ?>img/aiish.jpg" height="50" width="294" alt="logo"></div>
                        </div>
                        <svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
                        <path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,39.3,10z"/>
                        <path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
                        </svg> </div>
                </header>
            </div>
            <!-- Loader end -->

            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5 text-left">
                            <ul class="social-links">
                                <li><a target="_blank" href="https://www.facebook.com/"><i class="social_icons social_facebook_square"></i></a></li>
                                <li class=""><a target="_blank" href="https://twitter.com/"><i class="social_icons social_twitter_square"></i></a></li>
                                <li><a target="_blank" href="https://www.google.com/"><i class="social_icons social_googleplus_square"></i></a></li>
                                <li><a target="_blank" href="https://www.linkedin.com/"><i class="social_icons social_linkedin_square"></i></a></li>
                                <li><a target="_blank" href="https://www.youtube.com/"><i class="social_icons social_youtube_square"></i></a></li>
                                <li class="li-last"><a target="_blank" href="https://instagram.com/"><i class="social_icons social_instagram_square"></i></a></li>
                            </ul>
                        </div>
                        <div class="top-header__links col-sm-7">
                            <div class="btn-group languages">
                                <button type="button" class="btn_languages dropdown-toggle" data-toggle="dropdown"><i class="icon_globe-2"></i>English UK<span class="caret color_primary"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="javascript:void(0);">English UK1</a></li>
                                    <li><a href="javascript:void(0);">English UK2</a></li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);">Hospital Timings</a> <a href="javascript:void(0);">Book an Appointment</a> </div>
                    </div>
                </div>
            </div>

            <!-- HEADER -->
            <div class="header">
                <div class="container">
                    <div class="header-inner">
                        <div class="row">
                            <div class="col-md-4 col-xs-12"> <a href="index-2.html" class="logo"> <img class="logo__img" src="<?php echo HostRoot ?>img/aiish.jpg" height="50" width="294" alt="Logo"> </a> </div>
                            <div class="col-md-8 col-xs-12">
                                <div class="header-block"> 
                                    <form class="" id="myLogin" method="post">
                                        <input type="text" class="" value="" required="" placeholder="User name" name="username" id="username" value="Testusser" >
                                        <input type="password" class="" value="" required="" placeholder="Password" id="password" name="password" >
                                        <!--<input type="button" class="btn btn_transparent" value="Login">-->
                                        <!--<button class="btn btn_transparent" name="PostInfo" type="submit">Login</button>-->
                                        <input type="submit" class="btn btn_transparent" name="PostInfo" id="PostInfo" value="Login">
                                    </form> 
                                    <?php echo getSessionMsg() ?>
                                </div>
                                        <!--<span class="header-label"> <i class="icon-header icon-envelope-open color_primary"></i> <span class="helper"> Email us <a href="mailto:help@domain.com"><strong>help@domain.com</strong></a></span> </span> <a class="top-cart" href="http://html.templines.com/"> <i class="icon icon-basket bg-color_primary"></i> Cart Items: 2 <span class="top-cart__price color_second">$250.00</span></a> </div>
                                <!--<form class="hidden-md hidden-lg text-center" id="search-global-mobile" method="get">
                                  <input type="text" value="" id="search-mobile" name="s" >
                                  <button type="submit"><i class="icon fa fa-search"></i></button>
                                </form> -->
                            </div>
                        </div>
                    </div>
                    <!-- end header-inner--> 
                </div>
                <!-- end container-->

                <div class="top-nav ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12  col-xs-12">
                                <div class="navbar yamm " >
                                    <div class="navbar-header hidden-md  hidden-lg  hidden-sm ">
                                        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                                        <a href="#" class="navbar-brand">Menu</a> </div>
                                    <div id="navbar-collapse-1" class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav">
                                            <li class="dropdown"><a href="home.html"  >Home <b class="caret color_primary"></b> </a>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li> <a href="home.html"> Home 1</a> </li>
                                                    <li> <a href="home-2.html"> Home 2</a> </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="home.html"  >ABOUT<b class="caret color_primary"></b> </a>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li> <a href="about-1.html"  > about 1</a> </li>
                                                    <li> <a href="about-2.html"  > about 2</a> </li>
                                                    <li> <a href="doctors.html"  > doctors</a> </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="javascript:void(0)"  > Department <b class="caret color_primary"></b> </a>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li> <a href="<?php echo HostRoot ?>requisition-form"  > Online Requisition Form</a> </li>
                                                    <li> <a href="services-details.html"  > services details</a> </li>
                                                    <li> <a href="services-departments.html"  > services departments</a> </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="blog-1.html"  >Blog <b class="caret color_primary"></b> </a>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li> <a href="blog-1.html" > Blog </a> </li>
                                                    <li> <a href="blog-post.html"  > post</a> </li>
                                                </ul>
                                            </li>
                                            <li class=" yamm-fw"><a href="shop-main.html"  >Shop <b class="caret color_primary"></b> </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                    <h3 class="t1-title">Neurology <i class="decor-brand decor-brand_footer"></i> </h3>
                                                                    <ul>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 1</a></li>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 2</a></li>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 3</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                    <h3 class="t1-title">Dental Surgery <i class="decor-brand decor-brand_footer"></i> </h3>
                                                                    <ul>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 1</a></li>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 2</a></li>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 3</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                    <h3 class="t1-title">Pregnancy <i class="decor-brand decor-brand_footer"></i> </h3>
                                                                    <ul>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 1</a></li>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 2</a></li>
                                                                        <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 3</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="appointment-form.html"  >APPOINTMENT FORM </a> </li>
                                            <li><a href="contact.html"  >CONTACT </a> </li>
                                        </ul>
                                        <form id="search-global-menu" class="hidden-xs hidden-sm" method="get">
                                            <input type="text" value="" id="search" name="s" >
                                            <button type="submit"><i class="icon-magnifier"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end top-nav --> 
            </div>
            <!-- HEADER END -->

            <div id="iview" class="main-slider">
                <div data-iview:thumbnail="<?php echo HostRoot ?>media/slider_main/1.jpg" data-iview:image="media/slider_main/1.jpg" data-iview:transition="block-drop-random" >
                    <div class="container">
                        <div class="iview-caption bg-no-caption" data-x="660" data-y="143" data-transition="expandLeft">
                            <div class="custom-caption">
                                <p class="slide-title bg-color_second">A Team Of Medical Professionals</p>
                                <p class="slide-title_second">To Take Care Of Your Health</p>
                                <p class="slide-text">Sed posuere nunc libero pellentesque vitae</p>
                                <p class="slide-text">Vestibulum tincidunt ante ipsum</p>
                                <a href="javascript:void(0);" class="btn bg-color_primary">VIEW SERVICES <span class="btn-plus">+</span></a> </div>
                        </div>
                    </div>
                </div>
                <div data-iview:thumbnail="media/slider_main/2.jpg" data-iview:image="media/slider_main/2.jpg" data-iview:transition="block-drop-random" >
                    <div class="container">
                        <div class="iview-caption  bg-no-caption" data-x="260" data-y="293" data-transition="expandLeft">
                            <div class="custom-caption">
                                <p class="slide-title bg-color_second">A Team Of Medical Professionals</p>
                                <p class="slide-title_second">To Take Care Of Your Health</p>
                                <p class="slide-text">Sed posuere nunc libero pellentesque vitae</p>
                                <p class="slide-text">Vestibulum tincidunt ante ipsum</p>
                                <a href="javascript:void(0);" class="btn bg-color_primary">VIEW SERVICES <span class="btn-plus">+</span></a> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end iview -->

            <div class="container">
                <div class="block-hourse bg bg_1 bg_transparent wow zoomIn" data-wow-delay="1s">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="block-hourse__inner block-hourse__inner_first">
                                <p class="block-hourse__text"><i class="icon icon-note"></i>Need a Doctor for Check-up?</p>
                                <p class="block-hourse__title">JUST MAKE AN APPOINTMENT</p>
                                <a class="btn btn_transparent" href="javascript:void(0);">GET AN APPOINTMENT</a> </div>
                        </div>
                        <section class="col-md-6">
                            <div class="block-hourse__inner block-hourse__inner_second">
                                <div class="block-hourse__title-table"><i class="icon icon-clock"></i>OPENING HOURS</div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Monday - Friday</td>
                                            <td><span class="line-bottom"></span></td>
                                            <td>08:00am - 10:00pm</td>
                                        </tr>
                                        <tr>
                                            <td>Saturday - Sunday</td>
                                            <td><span class="line-bottom"></span></td>
                                            <td>09:00am - 06:00pm</td>
                                        </tr>
                                        <tr>
                                            <td>Emergency Services</td>
                                            <td><span class="line-bottom"></span></td>
                                            <td>24 hours Open</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                    <!-- end row --> 
                </div>
                <!-- end block-hourse --> 
            </div>
            <!-- end container -->

            <section class="advantages wow fadeInUp" data-wow-delay="1.5s">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="ui-title-block">Welcome to <strong class="font-weight_600">HEALTHCARE</strong><span class="font-weight-norm color_primary">AGENCY</span></h1>
                            <div class="ui-subtitle-block">Our medical specialists care about you & your family’s health</div>
                        </div>
                        <section class="advantages__inner col-sm-4"> <i class="icon flaticon-medical51 color_second"></i>
                            <h2 class="ui-title-inner">HealthCare Professionals</h2>
                            <i class="decor-brand"></i>
                            <p class="ui-text text-center">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo aoreet dignissim lectus etiam ipsum habitant tristique</p>
                            <a class="btn btn_small" href="javascript:void(0);">LEARN MORE</a> </section>
                        <section class="advantages__inner col-sm-4"> <i class="icon flaticon-medical109 color_second"></i>
                            <h2 class="ui-title-inner">Medical Excellence</h2>
                            <i class="decor-brand"></i>
                            <p class="ui-text text-center">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo aoreet dignissim lectus etiam ipsum habitant tristique</p>
                            <a class="btn btn_small" href="javascript:void(0);">LEARN MORE</a> </section>
                        <section class="advantages__inner col-sm-4"> <i class="icon flaticon-healthcare6 color_second"></i>
                            <h2 class="ui-title-inner">Latest Technologies</h2>
                            <i class="decor-brand"></i>
                            <p class="ui-text text-center">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo aoreet dignissim lectus etiam ipsum habitant tristique</p>
                            <a class="btn btn_small" href="javascript:void(0);">LEARN MORE</a> </section>
                    </div>
                    <!-- end row --> 
                </div>
                <!-- end container --> 
            </section>
            <!-- end advantages -->

            <section class="section bg bg_2 bg_transparent text-center">

                <div class="icon-tabs-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="ui-title-block color_white">Our <strong>Advantages</strong></h2>
                                <div class="ui-subtitle-block no-spacing">You have a number of reasons to choose us!</div>
                            </div>
                            <div class="icon-tabs">
                                <div class="col-md-6 wow bounceInLeft">
                                    <ul class="list-icons ">
                                        <li class="active ">
                                            <a href="#icontab1" aria-controls="icontab1" role="tab" data-toggle="tab"><span class="icon-round bg-color_second helper "><i class="icon fa fa-ambulance"></i></span></a></li>
                                        <li> <a href="#icontab2" aria-controls="icontab2"  role="tab" data-toggle="tab"><span class="icon-round bg-color_second helper"><i class="icon fa fa-heartbeat"></i></span></a></li>
                                        <li> <a href="#icontab3" aria-controls="icontab3"  role="tab" data-toggle="tab"><span class="icon-round bg-color_second helper"><i class="icon fa fa-hospital-o"></i></span></a></li>
                                        <li> <a href="#icontab4" aria-controls="icontab4"  role="tab" data-toggle="tab"><span class="icon-round bg-color_second helper"><i class="icon fa fa-user-md"></i></span></a></li>
                                        <li> <a href="#icontab5" aria-controls="icontab5"  role="tab" data-toggle="tab"><span class="icon-round bg-color_second helper"><i class="icon fa fa-shield"></i></span></a></li>
                                    </ul>

                                </div>
                                <div class="col-md-6 text-right wow bounceInRight"> 

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="icontab1"><img src="media/530x270/1.jpg" height="270" width="530" alt="Foto">

                                            <div class="tab-info">

                                                <p class="title-small">COMMITMENT – We fulfill our promises!</p>
                                                <p class="ui-text text-center color_light-grey">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo laoreet dignissim lectus etiam ipsum habitant tristique cras augue ipsum pharetra scelerisq ueac mollis vel metus sed ipsum donec.</p>

                                            </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="icontab2"><img src="media/530x270/2.jpg"  alt="Foto">

                                            <div class="tab-info">

                                                <p class="title-small">Nunc  mollis ligula aliquet!</p>
                                                <p class="ui-text text-center color_light-grey">Justo laoreet dignis sim lectus duic etiamd ipsum habitant tristique nam est. Donec venenatis leo eu varius curus da metus nuc placerat cursus In sodales purus non nisi.  Suspendisse justo elit vulputate vel sodales sit amet convallis vel dolor.</p>

                                            </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="icontab3"><img src="media/530x270/3.jpg"  alt="Foto">


                                            <div class="tab-info">

                                                <p class="title-small">Pellentesque sem class aptent</p>
                                                <p class="ui-text text-center color_light-grey">Justo laoreet dignis sim lectus duic etiamd ipsum habitant tristique nam est. Donec venenatis leo eu varius curus da metus nuc placerat cursus In sodales purus non nisi. Aliquam orci lacus, mattis nec ornare sed</p>

                                            </div>


                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="icontab4"><img src="media/530x270/4.jpg"  alt="Foto">

                                            <div class="tab-info">

                                                <p class="title-small">Donec id sapien sed ipsum</p>
                                                <p class="ui-text text-center color_light-grey">Justo laoreet dignis sim lectus duic etiamd ipsum habitant tristique nam est. Donec venenatis leo eu varius curus da metus nuc placerat cursus In sodales purus non nisi. </p>

                                            </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="icontab5"><img src="media/530x270/5.jpg"  alt="Foto">

                                            <div class="tab-info">

                                                <p class="title-small">Why Primary Health Care</p>
                                                <p class="ui-text text-center color_light-grey">Aliquam orci lacus, mattis nec ornare sed, varius eget, turpis. Donec eget massa velit interdum interdum. Cras vehicula, pede a viverra varius pede sapien commodo turpis et blandit ut nisi. Eonec pede</p>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row --> 
                    </div>  </div>
                <!-- end container --> 
            </section>
            <!-- end section -->

            <div class="banner mod-1 bg bg_3 bg_transparent wow zoomIn" data-wow-delay="1s">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-1">
                            <div class="banner__wrap pull-left">
                                <p class="banner__title">Are you ready to buy this template?</p>
                                <p class="banner__text">Egestas dolor erat vamus suscipit sed ipsum estduin vitae nised volutpat</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-offset-1"> <a class="btn btn pull-right" href="javascript:void(0);">PURCHASE NOW <span class="btn-plus">+</span></a> </div>
                    </div>
                </div>
            </div>
            <!-- end banner -->

            <div class="section-large bg bg_4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2 col-sm-6">
                            <h2 class="ui-title-block ui-title-block_small">Services <span>We offer</span></h2>
                            <p class="ui-text">Pellentesque vitae ultrice posuere. Praesent justo laoret dignis lectus etiam ipsum habitant tristique nam est. Donec venentse eu varius cursus masa metus adipiscing ante.</p>
                            <ul class="list-mark list-mark_big">
                                <li><a class="icon icon-login" href="javascript:void(0);">Eye Care Solutions</a></li>
                                <li><a class="icon icon-login" href="javascript:void(0);">Dental Surgery</a></li>
                                <li><a class="icon icon-login" href="javascript:void(0);">Blood Tests And X-Rays</a></li>
                                <li><a class="icon icon-login" href="javascript:void(0);">Health Care Problems</a></li>
                                <li><a class="icon icon-login" href="javascript:void(0);">Medicies And Drug Store</a></li>
                                <li><a class="icon icon-login" href="javascript:void(0);">General Prescriptions</a></li>
                                <li><a class="icon icon-login" href="javascript:void(0);">Pregnancy and Births</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 wow bounceInRight" data-wow-delay="1s">
                            <div class="padd_left_20">
                                <h2 class="ui-title-block ui-title-block_small">Hospital <span>Departments</span></h2>
                                <div class="panel-group accordion" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse-1"><i class="icon fa"></i></a>
                                            <h3 class="panel-title">Emergancy / Critical Care</h3>
                                        </div>
                                        <div id="collapse-1" class="panel-collapse collapse in">
                                            <div class="panel-body"> <img src="media/120x125/1.jpg" height="125" width="120" alt="Foto">
                                                <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan tristique nam est. Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat volutpat diam uspendise vel sed ipsum justo mattis.</p>
                                                <a href="javascript:void(0);" class="link">LEARN MORE</a> </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse-2"><i class="icon fa"></i></a>
                                            <h3 class="panel-title">Dental Clinic</h3>
                                        </div>
                                        <div id="collapse-2" class="panel-collapse collapse">
                                            <div class="panel-body"> <img src="media/120x125/1.jpg" height="125" width="120" alt="Foto">
                                                <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan tristique nam est. Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat volutpat diam uspendise vel sed ipsum justo mattis.</p>
                                                <a href="javascript:void(0);" class="link">LEARN MORE</a> </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse-3"><i class="icon fa"></i></a>
                                            <h3 class="panel-title">Allergic Diseases</h3>
                                        </div>
                                        <div id="collapse-3" class="panel-collapse collapse">
                                            <div class="panel-body"> <img src="media/120x125/1.jpg" height="125" width="120" alt="Foto">
                                                <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan tristique nam est. Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat volutpat diam uspendise vel sed ipsum justo mattis.</p>
                                                <a href="javascript:void(0);" class="link">LEARN MORE</a> </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse-4"><i class="icon fa"></i></a>
                                            <h3 class="panel-title">Neurology</h3>
                                        </div>
                                        <div id="collapse-4" class="panel-collapse collapse">
                                            <div class="panel-body"> <img src="media/120x125/1.jpg" height="125" width="120" alt="Foto">
                                                <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan tristique nam est. Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat volutpat diam uspendise vel sed ipsum justo mattis.</p>
                                                <a href="javascript:void(0);" class="link">LEARN MORE</a> </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse" data-parent="#accordion" href="#collapse-5"><i class="icon fa"></i></a>
                                            <h3 class="panel-title">Primary Health Care</h3>
                                        </div>
                                        <div id="collapse-5" class="panel-collapse collapse">
                                            <div class="panel-body"> <img src="media/120x125/1.jpg" height="125" width="120" alt="Foto">
                                                <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan tristique nam est. Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat volutpat diam uspendise vel sed ipsum justo mattis.</p>
                                                <a href="javascript:void(0);" class="link">LEARN MORE</a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row --> 
                </div>
                <!-- end container --> 
            </div>
            <!-- end section -->

            <section class="section bg bg_5 bg_transparent">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 color_white wow bounceInleft">
                            <h2 class="ui-title-block color_white font-weight_700">We Diagnose & Treat</h2>
                            <div class="subtitle_mod-1">Unique Problems in Our Research Center</div>
                            <p class="ui-text color_white">Nulla tristique ipsum in quam. Integer ac elit. Duis turpis faucibus non, mollis quis fringilla eros. Praesent tempor molestie metus. Aliquam massa sapien. Aenean cursus mattis sapien. Integer elementum nisi ac volutpat vestibulum enim.</p>
                            <a class="btn btn_transparent" href="javascript:void(0);">WATCH THE VIDEO</a> </div>
                        <div class="col-md-5 col-md-offset-1"> <a class="link_on-youtube wow bounceInRight" href="https://www.youtube.com/watch?v=NnuaHGW1cwU&amp;rel=0" rel="prettyPhoto" title="YouTube"><i class="icon_video-player icon-camcorder bg-color_primary"></i><img src="media/450x270/1.jpg" height="270" width="450" alt="Link on youtube"></a> </div>
                    </div>
                    <!-- end row --> 
                </div>
                <!-- end container --> 
            </section>
            <!-- end section -->

            <section class="section-large">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="ui-title-block text-center">Latest Health<strong> & Medical News</strong></h2>
                            <div class="ui-subtitle-block">Purus sapien consequat vitae sagittis ut facilisis arcu</div>
                            <i class="decor-brand"></i> </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <article class="article-short wow bounceInLeft">
                                <ul class="info-post">
                                    <li class="date color_primary">30</li>
                                    <li class="month">APR</li>
                                    <li class="comments"><a href="javascript:void(0);"><i class="icon icon-bubbles color_second"></i>20</a></li>
                                </ul>
                                <img src="media/290x250/1.jpg" height="250" width="290" alt="Foto"> <a href="javascript:void(0);" class="category color_primary">Health & Care</a> <a href="javascript:void(0);" class="autor">By Dr. Smith</a>
                                <h3 class="title" >Why Primary Health Care is very important in life?</h3>
                                <p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius cursus mas metus [...]</p>
                                <a class="btn btn_small" href="javascript:void(0);">READ MORE</a> </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="article-short wow bounceInUp" data-wow-delay=".5s">
                                <ul class="info-post">
                                    <li class="date color_primary">21</li>
                                    <li class="month">MAY</li>
                                    <li class="comments"><a href="javascript:void(0);"><i class="icon icon-bubbles color_second"></i>20</a></li>
                                </ul>
                                <img src="<?php echo HostRoot ?>media/290x250/2.jpg" height="250" width="290" alt="Foto"> <a href="javascript:void(0);" class="category color_primary">Dental Surgery</a> <a href="javascript:void(0);" class="autor">By Dr. Smith</a>
                                <h3 class="title" >Proin tortor elit rutrum amet sodales feugiat in diam.</h3>
                                <p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius cursus mas metus [...]</p>
                                <a class="btn btn_small" href="javascript:void(0);">READ MORE</a> </article>
                        </div>
                        <div class="col-sm-4">
                            <article class="article-short wow bounceInRight">
                                <ul class="info-post">
                                    <li class="date color_primary">25</li>
                                    <li class="month">JUN</li>
                                    <li class="comments"><a href="javascript:void(0);"><i class="icon icon-bubbles color_second"></i>20</a></li>
                                </ul>
                                <img src="<?php echo HostRoot ?>media/290x250/3.jpg" height="250" width="290" alt="Foto"> <a href="javascript:void(0);" class="category color_primary">Eye Disease</a> <a href="javascript:void(0);" class="autor">By Dr. Smith</a>
                                <h3 class="title" >Ornare dui vel euismod ultrices rcil libero pulvinar justo.</h3>
                                <p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est. Donec venenatis leo eu varius cursus mas metus [...]</p>
                                <a class="btn btn_small" href="javascript:void(0);">READ MORE</a> </article>
                        </div>
                    </div>
                </div>
                <!-- end container --> 
            </section>
            <!-- end section -->

            <ul class="bxslider slider_gallery"
                data-max-slides="7"
                data-min-slides="3"
                data-width-slides="400"
                data-margin-slides="0"
                data-auto-slides="true"
                data-move-slides="1"
                data-infinite-slides="true"
                data-pager="false" >
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/1.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/1.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/2.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/2.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/3.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/3.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/4.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/4.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/1.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/1.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/2.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/2.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/3.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/3.jpg" height="350" width="400"></a></li>
                <li class="slide"><a href="<?php echo HostRoot ?>media/carusel/fullscreen/4.jpg" rel="prettyPhoto[gallery1]"><span class="slide_bg"></span><img src="media/carusel/thumbnails/4.jpg" height="350" width="400"></a></li>
            </ul>
            <!-- end slider_gallery -->

            <section class="subscribe bg bg_6 bg_transparent color_white wow zoomIn" data-wow-delay="1s">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="subscribe__inner clearfix">
                                <div class="pull-left">
                                    <h2 class="subscribe__title">Subscribe to Newsletter</h2>
                                    <p class="subscribe__text">Get healthy news and solutions to your problems from our experts!</p>
                                </div>
                                <div class="pull-right">
                                    <form class="form-inline" role="form">
                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="Your email address here ...">
                                            <input class="btn bg-color_primary" type="submit" value="SIGN UP">
                                        </div>
                                    </form>
                                    <p class="subscribe__note">* We respect your privacy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end subscribe -->

            <section class="slider-reviews section-large slider-reviews_1-col bg bg_7 bg_transparent">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="ui-title-block text-center">What Our <strong>Patients Are Saying</strong></h2>
                            <div class="ui-subtitle-block text-center">Purus sapien consequat vitae sagittis ut facilisis arcu</div>
                            <i class="decor-brand"></i> </div>
                        <div class="col-md-11 col-xs-12">
                            <ul class="bxslider"
                                data-max-slides="1"
                                data-min-slides="1"
                                data-width-slides="1000"
                                data-margin-slides="0"
                                data-auto-slides="false"
                                data-move-slides="1"
                                data-infinite-slides="false"
                                data-controls="false" >
                                <li class="slide">
                                    <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130" width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span class="categories">Kidney Patient</span> <span class="categories">Australia</span> </div>
                                    <div class="quote">
                                        <blockquote> Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum pulvinar leo sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus turpis iaculis hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat eget nisi. Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa tristique iaculis. Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat orci sed ipsum mollis quis. </blockquote>
                                    </div>
                                </li>
                                <li class="slide">
                                    <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130" width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span class="categories">Kidney Patient</span> <span class="categories">Australia</span> </div>
                                    <div class="quote">
                                        <blockquote>
                                            <p>Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum pulvinar leo sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus turpis iaculis hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat eget nisi. Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa tristique iaculis. Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat orci sed ipsum mollis quis.</p>
                                        </blockquote>
                                    </div>
                                </li>
                                <li class="slide">
                                    <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130" width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span class="categories">Kidney Patient</span> <span class="categories">Australia</span> </div>
                                    <div class="quote">
                                        <blockquote>
                                            <p>Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum pulvinar leo sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus turpis iaculis hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat eget nisi. Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa tristique iaculis. Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat orci sed ipsum mollis quis.</p>
                                        </blockquote>
                                    </div>
                                </li>
                                <li class="slide">
                                    <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130" width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span class="categories">Kidney Patient</span> <span class="categories">Australia</span> </div>
                                    <div class="quote">
                                        <blockquote>
                                            <p>Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum pulvinar leo sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus turpis iaculis hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat eget nisi. Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa tristique iaculis. Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat orci sed ipsum mollis quis.</p>
                                        </blockquote>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end slider-reviews -->

            <div class="banner bg bg_3 bg_transparent wow zoomIn" data-wow-delay="1s">
                <div class="container"> 

                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="list-progress">
                                <li> <span class="icon-round icon-round_small bg-color_second helper"><i class="icon fa fa-user-md"></i></span>
                                    <div class="info"> <span class="chart" data-percent="126"> <span class="percent"></span> </span> <span class="label-chart">Hospital Rooms</span> </div>
                                </li>
                                <li> <span class="icon-round icon-round_small bg-color_second helper"><i class="icon fa fa-hospital-o"></i></span>
                                    <div class="info"> <span class="chart" data-percent="510"> <span class="percent"></span> </span> <span class="label-chart">Qualified Staff</span> </div>
                                </li>
                                <li> <span class="icon-round icon-round_small bg-color_second helper"><i class="icon fa fa-heartbeat"></i></span>
                                    <div class="info"> <span class="chart" data-percent="6200"> <span class="percent"></span> </span> <span class="label-chart">Satisfied Patients</span> </div>
                                </li>
                                <li> <span class="icon-round icon-round_small bg-color_second helper"><i class="icon fa fa-shield"></i></span>
                                    <div class="info"> <span class="chart" data-percent="513"> <span class="percent"></span> </span> <span class="label-chart">Doctors Medals</span> </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end banner -->

            <footer class="footer">
                <div class="footer__inner">
                    <div class="container">
                        <div class="footer__block clearfix">
                            <div class="block__wrap pull-left">
                                <p class="block__title"><i class="block__icon icon-note"></i>Need a Doctor for Check-up?</p>
                                <p class="block__text">JUST MAKE AN APPOINTMENT & YOU’RE DONE!</p>
                            </div>
                            <a class="block__btn btn bg-color_second pull-right" href="javascript:void(0);">GET AN APPOINTMENT <span class="btn-plus">+</span></a> </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <section class="footer__section">
                                    <h2 class="footer__title">About HealthCare Agency</h2>
                                    <i class="decor-brand decor-brand_footer"></i>
                                    <p>Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim lectus etiam ipsum habitant tristique</p>
                                    <address class="footer__contacts">
                                        <i class="footer__icon icon-pointer color_primary"></i>Plot No. 38 St. 39 UpHill Town, Newyork, USA
                                    </address>
                                    <p class="footer__contacts"><i class="footer__icon icon-call-in color_primary"></i>+522 234 56789  / +522 234 56780</p>
                                    <p class="footer__contacts"><i class="footer__icon icon-envelope-open color_primary"></i>info@healthcare-agency.org</p>
                                </section>
                                <section class="footer__section">
                                    <h2 class="footer__title">Opening Hours</h2>
                                    <i class="decor-brand decor-brand_footer"></i>
                                    <table class="footer__table">
                                        <tbody>
                                            <tr>
                                                <td>Monday - Friday</td>
                                                <td>08:00am - 10:00pm</td>
                                            </tr>
                                            <tr>
                                                <td>Saturday - Sunday</td>
                                                <td>09:00am - 06:00pm</td>
                                            </tr>
                                            <tr>
                                                <td>Emergency Services</td>
                                                <td>24 hours Open</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                            <section class="footer__section col-sm-4">
                                <h2 class="footer__title">Recent Tweets</h2>
                                <i class="decor-brand decor-brand_footer"></i>
                                <section class="tweets">
                                    <h3 class="tweets__title"><i class="footer__icon icon-social-twitter color_primary"></i>@ HealthCare Agency</h3>
                                    <p class="tweets__text">Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim.</p>
                                    <span class="tweets__time">3 hours ago</span> </section>
                                <section class="tweets">
                                    <h3 class="tweets__title"><i class="footer__icon icon-social-twitter color_primary"></i>@ HealthCare Agency</h3>
                                    <p class="tweets__text">Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim.</p>
                                    <span class="tweets__time">3 hours ago</span> </section>
                                <section class="tweets">
                                    <h3 class="tweets__title"><i class="footer__icon icon-social-twitter color_primary"></i>@ HealthCare Agency</h3>
                                    <p class="tweets__text">Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim.</p>
                                    <span class="tweets__time">3 hours ago</span> </section>
                            </section>
                            <section class="footer__section col-sm-4">
                                <h2 class="footer__title">Contact Form</h2>
                                <i class="decor-brand decor-brand_footer"></i>
                                <form class="form" role="form">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Full Name">
                                        <input class="form-control" type="email" placeholder="Email address">
                                        <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                                        <input class="btn bg-color_primary pull-right" type="submit" value="SEND NOW">
                                    </div>
                                </form>
                            </section>
                        </div>
                        <!-- end row --> 
                    </div>
                    <!-- end container --> 
                </div>
                <!-- end footer__inner -->

                <div class="footer__menu clearfix">
                    <div class="container"> <a href="index-2.html" class="logo pull-left"> <img class="logo__img" src="<?php echo HostRoot ?>img/aiish.jpg" height="44" width="270" alt="Logo"> </a>
                        <ul class="pull-right">
                            <li><a href="javascript:void(0);">HOME</a></li>
                            <li><a href="javascript:void(0);">ABOUT</a></li>
                            <li><a href="javascript:void(0);">SERVICES</a></li>
                            <li><a href="javascript:void(0);">PAGES</a></li>
                            <li><a href="javascript:void(0);">GALLERY</a></li>
                            <li><a href="javascript:void(0);">BLOG</a></li>
                            <li><a href="javascript:void(0);">SHOP</a></li>
                            <li><a href="javascript:void(0);">CONTACT</a></li>
                        </ul>
                    </div>
                    <!-- end container --> 
                </div>
                <!-- end footer__menu -->

                <div class="footer__bottom"> <span class="copyright">© Copyrights 2015 Healthcare Agency</span>
                    <ul class="social-links">
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="social_icons social_facebook_square"></i></a></li>
                        <li class=""><a target="_blank" href="https://twitter.com/"><i class="social_icons social_twitter_square"></i></a></li>
                        <li><a target="_blank" href="https://www.google.com/"><i class="social_icons social_googleplus_square"></i></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/"><i class="social_icons social_linkedin_square"></i></a></li>
                        <li><a target="_blank" href="https://www.youtube.com/"><i class="social_icons social_youtube_square"></i></a></li>
                        <li class="li-last"><a target="_blank" href="https://instagram.com/"><i class="social_icons social_instagram_square"></i></a></li>
                    </ul>
                </div>
            </footer>
        </div>
        
        <!-- end layout-theme --> 

        <span class="scroll-top bg-color_second"> <i class="fa fa-angle-up"> </i></span> 

        
        
        <script src="<?php echo HostRoot ?>js/dist/jquery.validate.js"></script>
    <script>
        $(function() {
         // Setup form validation on the #register-form element
            $("#myLogin").validate({
                
                // Specify the validation rules
                rules: {
                    username: "required",
                    password: "required"
                        
                    
            },
        //        
                // Specify the validation error messages
                messages: {
                    username: "Please enter name",
                    password: "Password required"
                    

                }
            });
        });
        
        
        
        
        
        <!--HOME SLIDER--> 
        <script src="<?php echo HostRoot ?>plugins/iview/js/iview.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

        <!-- SCRIPTS --> 
        <script type="text/javascript" src="<?php echo HostRoot ?>plugins/isotope/jquery.isotope.min.js"></script> 
        <script src="<?php echo HostRoot ?>js/waypoints.min.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/bxslider/jquery.bxslider.min.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/prettyphoto/js/jquery.prettyPhoto.js"></script> 
        <script src="../../cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/datetimepicker/jquery.datetimepicker.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/jelect/jquery.jelect.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/nouislider/jquery.nouislider.all.min.js"></script> 

        <!-- Loader --> 
        <script src="<?php echo HostRoot ?>plugins/loader/js/classie.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/loader/js/pathLoader.js"></script> 
        <script src="<?php echo HostRoot ?>plugins/loader/js/main.js"></script> 
        <script src="<?php echo HostRoot ?>js/classie.js"></script> 
        <!--THEME--> 
        <script src="<?php echo HostRoot ?>js/cssua.min.js"></script> 
        <script src="<?php echo HostRoot ?>js/wow.min.js"></script> 
        <script src="<?php echo HostRoot ?>js/custom.js"></script>
    </body>
 
    <!-- Mirrored from html.templines.com/health/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 May 2017 06:43:25 GMT -->
</html>
