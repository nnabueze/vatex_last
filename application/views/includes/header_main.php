<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico" />
		<link rel="alternate" href="<?php echo base_url();?>" hreflang="x-default" />
		<!--<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('website_name'); ?></title>-->
        <title>VATEX-FIRS Admin Console | Dashboard</title>
        <!--/ END META SECTION -->

        <!-- START @FONT STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Oswald:700,400" rel="stylesheet">
        <!--/ END FONT STYLES -->

        <!-- START @GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/fontawesome/css/font-awesome.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/animate.css/animate.min.css');?>" rel="stylesheet">
        
               
        <?php
		
		if($dashboard == TRUE)
		{
			$this->load->view('includes/css_dashboard');	
		}
		if($datatable == TRUE)
		{
			$this->load->view('includes/css_datatable');
		}
		if($formelements == TRUE)
		{
			$this->load->view('includes/css_formelements');
		}
		?>
        <link href="<?php echo base_url('assets/_main/admin/css/themes/blue.theme.css');?>" rel="stylesheet" id="theme">
        <link href="<?php echo base_url('assets/_main/admin/css/custom.css');?>" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <script src="../assets/global/plugins/bower_components/respond-minmax/dest/respond.min.js"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
    </head>
    
    <?php
		$userid = $this->session->userdata('user_id');
		$userdt = $this->user_model->user_detail($userid);
	?>
    
    <body class="page-session page-sound page-header-fixed page-sidebar-fixed demo-dashboard-session">

        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <section id="wrapper">
            <header id="header">
                <div class="header-left">
                    <div class="navbar-minimize-mobile left">
                        <i class="fa fa-bars"></i>
                    </div>

                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <!--<img class="logo" src="http://img.djavaui.com/?create=175x50,81B71A?f=ffffff" alt="logo">-->
                            <img class="logo" src="<?php echo base_url('assets/_main/global/img/logo.png'); ?>" height="50" width="223">
                        </a>
                    </div>

                    <div class="navbar-minimize-mobile right">
                        <i class="fa fa-cog"></i>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="header-right">
                    <div class="navbar navbar-toolbar">

                        <ul class="nav navbar-nav navbar-left">
                            <li class="navbar-minimize">
                                <a href="javascript:void(0);" title="Minimize sidebar">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </li>
                        </ul>
                        
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown navbar-profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="meta">
                                        <span class="avatar">
                                            <?php
                                            if (empty($userdt[0]->profile_img)) {
                                            ?>
                                                <img src="<?php echo base_url('uploads/user_img/images.jpg');?>?create=50x50,4888E1?f=ffffff" alt="admin">
                                            <?php
                                            }else{
                                            ?>
                                            <img src="<?php echo base_url('uploads/user_img/'.$userdt[0]->profile_img);?>?create=50x50,4888E1?f=ffffff" alt="admin">
                                            <?php } ?>
                                        </span>
                                        <span class="text hidden-xs hidden-sm text-muted"><?php echo $userdt[0]->username; ?></span>
                                        <span class="caret"></span>
                                    </span>
                                </a>
                                <!-- Start dropdown menu -->
                                <ul class="dropdown-menu animated flipInX">
                                    <li class="dropdown-header">Account</li>
                                    <li><a href="<?php echo site_url('users/profile');?>"><i class="fa fa-user"></i>Edit profile</a></li>
                                    <li><a href="<?php echo site_url('tickets');?>"><i class="fa fa-envelope-square"></i>Tickets </a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo site_url('login/logout');?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        
                        </ul>

                    </div>
                </div>
            </header> 