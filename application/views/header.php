<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework. Included are multiple example pages, elements styles, and javascript widgets to get your project started.">
        <meta name="keywords" content="admin, admin template, bootstrap3, clean, fontawesome4, good documentation, lightweight admin, responsive dashboard, webapp">
        <meta name="author" content="Djava UI">
        <title>VATEX-FIRS Admin Console | Dashboard</title>
        <!--/ END META SECTION -->

        <!-- START @FONT STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Oswald:700,400" rel="stylesheet">
        <!--/ END FONT STYLES -->

        <!-- START @GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/fontawesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/animate.css/animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/dropzone/downloads/css/dropzone.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery.gritter/css/jquery.gritter.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/css/datatables.responsive.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/c3js-chart/c3.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/flag-icon-css/css/flag-icon.min.css'); ?>" rel="stylesheet">
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link href="<?php echo base_url('assets/main/assets/admin/css/reset.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/admin/css/layout.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/admin/css/components.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/admin/css/plugins.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/admin/css/themes/blue.theme.css'); ?>" rel="stylesheet" id="theme">
        <link href="<?php echo base_url('assets/main/assets/admin/css/custom.css'); ?>" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/html5shiv/dist/html5shiv.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/respond-minmax/dest/respond.min.js'); ?>"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
    </head>
    <!--/ END HEAD -->
<?php
$userid = $this->session->userdata('user_id');
						$userdt = $this->user_model->user_detail($userid);
?>
    <body class="page-session page-sound page-header-fixed page-sidebar-fixed demo-dashboard-session">

        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- START @WRAPPER -->
        <section id="wrapper">

            <!-- START @HEADER -->
            <header id="header">

                <!-- Start header left -->
                <div class="header-left">
                    <!-- Start offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                    <div class="navbar-minimize-mobile left">
                        <i class="fa fa-bars"></i>
                    </div>
                    <!--/ End offcanvas left -->

                    <!-- Start navbar header -->
                    <div class="navbar-header">

                        <!-- Start brand -->
                        <a class="navbar-brand" href="dashboard.html">
                            <img class="logo" src="<?php echo base_url('assets/main/assets/global/img/logo.png'); ?>" height="50" width="223">
                        </a><!-- /.navbar-brand -->
                        <!--/ End brand -->

                    </div><!-- /.navbar-header -->
                    <!--/ End navbar header -->

                    <!-- Start offcanvas right: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                    <div class="navbar-minimize-mobile right">
                        <i class="fa fa-cog"></i>
                    </div>
                    <!--/ End offcanvas right -->

                    <div class="clearfix"></div>
                </div><!-- /.header-left -->
                <!--/ End header left -->

                <!-- Start header right -->
                <div class="header-right">
                    <!-- Start navbar toolbar -->
                    <div class="navbar navbar-toolbar navbar-primary">

                        <!-- Start left navigation -->
                        <ul class="nav navbar-nav navbar-left">

                            <!-- Start sidebar shrink -->
                            <li class="navbar-minimize">
                                <a href="javascript:void(0);" title="Minimize sidebar">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </li>
                            <!--/ End sidebar shrink -->

                            <!-- Start form search -->
                            <li class="navbar-search">
                                <!-- Just view on mobile screen-->
                                <a href="#" class="trigger-search"><i class="fa fa-search"></i></a>
                                <form class="navbar-form">
                                    <div class="form-group has-feedback">
                                        <input type="text" class="form-control typeahead rounded" placeholder="Search for people, places and things">
                                        <button type="submit" class="btn btn-theme fa fa-search form-control-feedback rounded"></button>
                                    </div>
                                </form>
                            </li>
                            <!--/ End form search -->

                        </ul><!-- /.nav navbar-nav navbar-left -->
                        <!--/ End left navigation -->

                        <!-- Start right navigation -->
                        <ul class="nav navbar-nav navbar-right"><!-- /.nav navbar-nav navbar-right -->

                        <!-- Start profile -->
                        <li class="dropdown navbar-profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="meta">
                                    <span class="avatar"><img src="<?php echo site_url('uploads/'.$userdt[0]->profile_img);?>?create=35x35,4888E1?f=ffffff" class="img-circle" alt="admin"></span>
                                    <span class="text hidden-xs hidden-sm text-muted"><?php echo $userdt[0]->username; ?></span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <!-- Start dropdown menu -->
                            <ul class="dropdown-menu animated flipInX">
                                <li class="dropdown-header">Account</li>
                                <li><a href="<?php echo site_url('profile_management');?>"><i class="fa fa-user"></i>Edit profile</a></li>
                                <li><a href="<?php echo site_url('tickets');?>"><i class="fa fa-envelope-square"></i>Inbox </a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('login/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                            </ul>
                            <!--/ End dropdown menu -->
                        </li><!-- /.dropdown navbar-profile -->
                        <!--/ End profile -->

                        </ul>
                        <!--/ End right navigation -->

                    </div><!-- /.navbar-toolbar -->
                    <!--/ End navbar toolbar -->
                </div><!-- /.header-right -->
                <!--/ End header left -->

            </header> <!-- /#header -->
            <!--/ END HEADER -->