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
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>HEALTHCARE Agency</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
        <link href="<?php echo HostRoot ?>css/master.css" rel="stylesheet">
        <link href="<?php echo HostRoot ?>css/validate.css" rel="stylesheet">
        <link href="<?php echo HostRoot ?>css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo HostRoot ?>plugins/iview/css/iview.css" type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo HostRoot ?>plugins/iview/css/skin/style.css" type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo HostRoot ?>plugins/tabs/tab.css" type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo HostRoot ?>plugins/toast/showToast.css" type='text/css' media='all' />
        <script type="text/javascript" src="<?php echo HostRoot ?>js/jquery-1.11.1.min.js"></script>
        <script src= "<?php echo HostRoot ?>js/jquery-migrate-1.2.1.js" ></script>
        <script src="<?php echo HostRoot ?>js/jquery-ui.min.js"></script>
        <script src="<?php echo HostRoot ?>js/bootstrap-3.1.1.min.js"></script>
        <script src="<?php echo HostRoot ?>js/modernizr.custom.js"></script>
        <script src="<?php echo HostRoot ?>js/jquery.dataTables.min.js"></script>
        <script src="<?php echo HostRoot ?>js/dist/jquery.validate.js"></script>
        <script src="<?php echo HostRoot ?>js/submission/formRestriction.js"></script>
        <script src="<?php echo HostRoot ?>plugins/toast/showToast.js"></script> 
        <!--<script src="<?php echo HostRoot ?>js/datemonthyear.js"></script>-->
        <?php echo "<script> window.Root = '".HostRoot."';</script>" ?>
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
                        <div class="top-header__links col-sm-6">
                            <a href="javascript:void(0);">Client information</a> <a href="javascript:void(0);">General questions</a> <a href="javascript:void(0);">Request an appointment</a> </div>
                    </div>
                </div>
            </div>

            <!-- HEADER -->
            <div class="header">
                <div class="container">
                    <div class="header-inner">
                        <div class="row">
                            <div class="col-md-4 col-xs-12"> <a href="index-2.html" class="logo"> <img class="logo__img" src="<?php echo HostRoot ?>img/aiish.jpg" height="50" width="294" alt="Logo"> </a> </div>
                            <div class="col-md-7 col-xs-12">
                                <div class="header-block">
                                    
                                    <?php 
                                    if(USERAUTH == "USERAUTH"){ ?>
                                        <form class='' id='formLogin' method='post'>
                                            <div class="form-group">
                                                <input type='text' class='' value='' placeholder='User name' id="userName" name='username' value='' >
                                                <input type='password' class='' value='' placeholder='Password' id="password" name='password' >
                                            </div>
                                            <div id="loginResultMsg" class="error"></div>
                                            <button class='btn btn_transparent' id="submitLogin" name='PostInfo' type='submit'>Login</button>
                                        </form>
                                   <?php }else{ 
                                       echo"<label>Welcome</label><span>&nbsp; ".USERFULLNAME."</span>
                                    <span class='top-cart__price color_second'><a href='".HostRoot ."logout' class='btn bg-color_primary'>Logout</a></span>";
                                   }?>
                                   
                                    <!--<?php echo $_SESSION["userId"] ?>
                                    //<?php //if(USERAUTH === "USERAUTH"){?>
                                    
                                            <form class='' id='' method='post'>
                                                <input type='text' class='' value='' placeholder='User name' name='username' value='Testusser' >
                                                <input type='password' class='' value='' placeholder='Password' name='password' >
                                                <button class='btn btn_transparent' name='PostInfo' type='submit'>Login</button>
                                            </form>
                                        //<?php//} if(!empty(USERAUTH)){ ?>
                                    
                                            <label>Welcome</label><span>&nbsp;//<?php echo USERFULLNAME ?></span>
                                    <span class='top-cart__price color_second'><a href='//<?php echo HostRoot ?>logout' class='btn bg-color_primary'>Logout</a></span>
                                            
                                       //<?php //}
//                                    ?> -->
                                    
                                    
                                    
                                    <!--<a class="top-cart" href="http://html.templines.com/"> <i class="icon icon-basket bg-color_primary"></i> Cart Items: 2 <span class="top-cart__price color_second">$250.00</span></a> </div> -->
                                </div>	
                                <!--<div class="header-block"> 
                                                    <form class="" id="" method="post">
                                                      <input type="text" class="" value="" placeholder="User name" name="email" >
                                                      <input type="password" class="" value="" placeholder="Password" name="email" >
                                                      <button class="btn btn_transparent" type="submit">Login</button>
                                                    </form> 
                                            </div> -->
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
                                            <li class=""><a href="<?php (!empty(USERAUTH))?"".HostRoot."dashboard":"".HostRoot."home" ?>"  >Home </a>
                                                
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
            
            <script>
                $("document").ready(function() {
                        $('#formLogin').submit(function() {
                            submitLoginCheck();
                            return false;
                        });
                });
                
                function submitLoginCheck(){
                    var userName = $("#formLogin [name='username']").val();
                    var userPassword = $("#formLogin [name='password']").val();
                    //alert(userName + userPassword);
                    $.ajax({
                        type: "POST",
                        url: Root+'assets/ajax/doLoginSubmit.php',
                        data: {user_name: userName, password: userPassword},
                        cache: false,
                        success:function (data) {
                            if($.trim(data) === "success"){
                                window.location.href = Root+'dashboard';
                            }
                            $('#loginResultMsg').fadeOut('fast', function () {
                                $('#loginResultMsg').fadeIn('fast').html(data);
                                

                             });
                            
                           }

                        });

                }
            
            </script>            
            