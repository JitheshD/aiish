<?php
$nav[$page_name] = "active open";
?>
<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>DISHA - Control Panel</title>
        <!-- start: META -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="Admin Control Panel of Paryaya Administrative, Shri Krishna Matha, Udupi." name="description" />
        <meta content="Leobots Technologies" name="author" />
        <!-- end: META -->
        <!-- start: GOOGLE FONTS -->
        <!--<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />-->
        <!-- end: GOOGLE FONTS -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="<?php echo HostRoot; ?>vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo HostRoot; ?>vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo HostRoot; ?>vendor/themify-icons/themify-icons.min.css">
        <link href="<?php echo HostRoot; ?>vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo HostRoot; ?>vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo HostRoot; ?>vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <!-- end: MAIN CSS -->
        <!-- start: CLIP-TWO CSS -->
        <link rel="stylesheet" href="<?php echo HostRoot; ?>assets/css/styles.css">
        <link rel="stylesheet" href="<?php echo HostRoot; ?>assets/css/plugins.css">
        <link rel="stylesheet" href="<?php echo HostRoot; ?>assets/css/themes/theme-2.css" id="skin_color" />
        <!-- end: CLIP-TWO CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link href="<?php echo HostRoot; ?>vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php echo HostRoot; ?>vendor/select2/select2.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo HostRoot; ?>vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
        <!--toast Message-->
        <link rel="stylesheet" type="text/css" href="<?php echo HostRoot ?>assets/css/style/showToast.css" />
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <?php echo "<script> window.Root = '".HostRoot."'; </script>"; ?>
        <script src="<?php echo HostRoot; ?>vendor/jquery/jquery.min.js"></script>
        
        <?php echo "<script> window.BASEDIR = '".HostRoot."'; </script>"; ?>
        
    </head>
    <!-- end: HEAD -->
    <body>
        <div id="app" class="app-navbar-fixed app-footer-fixed">
            <!-- sidebar -->
            <div class="sidebar app-aside" id="sidebar">
                <div class="sidebar-container perfect-scrollbar ">
                    <nav>
                        <!-- start: SEARCH FORM -->
<!--                        <div class="search-form">
                            <a class="s-open" href="#">
                                <i class="ti-search"></i>
                            </a>
                            <form class="navbar-form" role="search">
                                <a class="s-remove" href="#" target=".navbar-form">
                                    <i class="ti-close"></i>
                                </a>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <button class="btn search-button" type="submit">
                                        <i class="ti-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>-->
                        <!-- end: SEARCH FORM -->
                        <!-- start: MAIN NAVIGATION MENU -->
                        <div class="navbar-title">
                            <span>Main Navigation</span>
                        </div>
                        <ul class="main-navigation-menu">
                            <li class="<?php echo $nav["dashboard"]; ?>">
                                <a href="<?php echo HostRoot; ?>dashboard">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Dashboard</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="<?php echo $nav["hostel"]; ?>">
                                <a href="<?php echo HostRoot; ?>hostel">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-building "></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Hostel Info</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="<?php echo $nav["stock_in"]; ?>">
                                <a href="<?php echo HostRoot; ?>stock_in">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-mail-forward"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Stock In</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="<?php echo $nav["stock_out"]; ?>">
                                <a href="<?php echo HostRoot; ?>stock_out">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-mail-reply"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Stock Out</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="<?php echo $nav["stock_available"]; ?> <?php echo $nav["monthly_usage"]; ?>">
                                <a href="javascript:void(0)">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Stock Reports </span><i class="icon-arrow"></i>
                                        </div>
                                    </div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?php echo $nav["stock_available"]; ?>">
                                        <a href="<?php echo HostRoot; ?>stock_available">
                                            <span class="title"> Stock Info </span>
                                        </a>
                                    </li>
                                    <li class="<?php echo $nav["monthly_usage"]; ?>">
                                        <a href="<?php echo HostRoot; ?>monthly_usage">
                                            <span class="title"> Monthly Usage </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            <li class="<?php echo $nav['asset_item']; ?> <?php echo $nav['user']; ?>">
                                <a href="javascript:void(0)">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="ti-settings"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Utilities </span><i class="icon-arrow"></i>
                                        </div>
                                    </div>
                                </a>
                                <ul class="sub-menu">
                                    <li class="<?php echo $nav["asset_item"]; ?>">
                                        <a href="<?php echo HostRoot; ?>asset_item">
                                            <span class="title"> Items/Assets </span>
                                        </a>
                                        
                                    </li>
                                    <li class="<?php echo $nav["monthly_requirement"]; ?>">
                                        <a href="<?php echo HostRoot; ?>monthly_requirement">
                                            <span class="title">Monthly Requirement of assets</span>
                                        </a>
                                        
                                    </li>
                                    <li class="<?php echo $nav["students"]; ?>">
                                        <a href="<?php echo HostRoot; ?>students">
                                            <span class="title">Hostel Student List</span>
                                        </a>
                                        
                                    </li>
                                    <li class="<?php echo $nav["user"]; ?>">
                                        <a href="<?php echo HostRoot; ?>user">
                                            <span class="title"> User Info </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            
                        </ul>
                        <!-- end: MAIN NAVIGATION MENU -->
                        
                        <!-- start: DOCUMENTATION BUTTON -->
<!--                        <div class="wrapper">
                            <a href="documentation.html" class="button-o">
                                <i class="ti-help"></i>
                                <span>Documentation</span>
                            </a>
                        </div>-->
                        <!-- end: DOCUMENTATION BUTTON -->
                    </nav>
                </div>
            </div>
            <!-- / sidebar -->
            <div class="app-content">
                <!-- start: TOP NAVBAR -->
                <header class="navbar navbar-default navbar-static-top">
                    <!-- start: NAVBAR HEADER -->
                    <div class="navbar-header">
                        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
                            <i class="ti-align-justify"></i>
                        </a>
                        <a class="navbar-brand" href="#">
                            DISHA
                        </a>
                        <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
                            <i class="ti-align-justify"></i>
                        </a>
                        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="ti-view-grid"></i>
                        </a>
                    </div>
                    <!-- end: NAVBAR HEADER -->
                    <!-- start: NAVBAR COLLAPSE -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-right">
                            <li class="dropdown">
                                <a href class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i><strong><?php echo getNotificationCount(); ?></strong>
                                </a>
                                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
                                        <li>
                                            <div class="drop-down-wrapper ps-container">
                                                <ul>
                                                    <?php echo getNotificationList(); ?>
                                                </ul>
                                            </div>
                                        </li>
                                        
                                </ul>
                            </li>
                            <li class="dropdown current-user">
                                <a href class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo HostRoot; ?>assets/images/media-user.png" alt=""> <span class="username"><?php echo USERFULLNAME; ?> <i class="ti-angle-down"></i></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-dark">
                                    <li>
                                        <a href="<?php echo HostRoot; ?>user/<?php echo encode(USERID); ?>">
                                            Manage Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo HostRoot; ?>logout">
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- end: USER OPTIONS DROPDOWN -->
                        </ul>
                        <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
<!--                        <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                            <div class="arrow-left"></div>
                            <div class="arrow-right"></div>
                        </div>-->
                        <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
                    </div>
<!--                    <a class="dropdown-off-sidebar" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
                        &nbsp;
                    </a>-->
                    <!-- end: NAVBAR COLLAPSE -->
                </header>
                <!-- end: TOP NAVBAR -->