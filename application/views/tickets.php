<?php
include('header.php');
include('sidebar.php');
?>
<!-- START @PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/fontawesome/css/font-awesome.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/animate.css/animate.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/simple-line-icons/css/simple-line-icons.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/flag-icon-css/css/flag-icon.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/main/assets/global/plugins/bower_components/chartist/dist/chartist.min.css');?>" rel="stylesheet">
        <!--/ END PAGE LEVEL STYLES -->
<section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-group"></i> Issue Tracker <span>Save your team lots of time on issue tracking</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">You are here:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="dashboard.html">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Issue Tracker</li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Start issue chart -->
                            <ul class="list-inline heading-issue-chart">
                                <li>
                                    <span class="label label-circle label-success">&nbsp;</span> Added
                                </li>
                                <li>
                                    <span class="label label-circle label-warning">&nbsp;</span> Fixed
                                </li>
                                <li>
                                    <span class="label label-circle label-danger">&nbsp;</span> Bug
                                </li>
                            </ul>
                            <div class="ct-chart ct-issue-chart mb-20" style="height: 200px;"></div>
                            <!--/ End issue chart -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Issue list -->
                            <div class="panel panel-default panel-issue-tracker shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Issue list</h3>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add new issue</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-sub-heading inner-all">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-horizontal" action="#">
                                                <div class="form-body">
                                                    <div class="form-group no-margin">
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" placeholder="Search issue by name...">
                                                            <span class="input-group-btn"><button type="submit" class="btn btn-default">Search</button></span>
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.form-body -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-issue-tracker table-middle">
                                            <tbody>
											<?php 
											foreach($tcktlist as $tlist){ ?>
                                            <tr>
                                                <td>
                                                    <div class="ckbox ckbox-teal">
                                                        <input id="checkbox-issue-1" type="checkbox" class="checkbox-issue">
                                                        <label for="checkbox-issue-1">&nbsp;</label>
                                                    </div>
                                                    <div class="rating rating-success">
                                                        <span class="star"></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="label label-success rounded">Added</span>
                                                </td>
                                                <td>
                                                    <a href="#">#<?php echo ucwords($tlist->issue_title);?></a>
                                                    <p class="no-margin">
                                                        <?php echo ucwords($tlist->issue_title);?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="flag flag-icon-background flag-icon-it" title="Italy"></div> <?php echo ucwords($tlist->first_name.' '.$tlist->last_name);?>
                                                </td>
                                                <td>
                                                    <?php echo $tlist->creation_date;?>
                                                </td>
                                                <td>
                                                    <span class="pie">3,2</span> <span>3d</span>
                                                </td>
                                            </tr>
											<?php }?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div><!-- /.panel-body -->
                                <div class="panel-footer">
                                    <div class="pull-right">
                                        <ul class="pagination no-margin">
                                            <li class="disabled"><a href="#">«</a></li>
                                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">»</a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-footer -->
                            </div>
                            <!--/ End issue list -->
                        </div>
                    </div>

                </div><!-- /.body-content -->
                <!--/ End body content -->

                <!-- Start footer content -->
                <footer class="footer-content">
                    2014 - <span id="copyright-year"></span> &copy; Blankon Admin. Created by <a href="http://djavaui.com/" target="_blank">Djava UI</a>, Yogyakarta ID
                    <span class="pull-right">0.01 GB(0%) of 15 GB used</span>
                </footer><!-- /.footer-content -->
                <!--/ End footer content -->

            </div>
			</section>

<?php include('footer.php');?>			
        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery/dist/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery-cookie/jquery.cookie.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/typehead.js/dist/handlebars.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/typehead.js/dist/typeahead.bundle.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery-nicescroll/jquery.nicescroll.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery.sparkline.min/index.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/ionsound/js/ion.sound.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/bootbox/bootbox.js');?>"></script>
        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/peity/jquery.peity.min.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/chartist/dist/chartist.min.js');?>"></script>
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/main/assets/admin/js/apps.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/pages/blankon.project.issuetracker.js');?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/demo.js');?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->

        <!-- START GOOGLE ANALYTICS -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-55892530-1', 'auto');
            ga('send', 'pageview');

        </script>
        <!--/ END GOOGLE ANALYTICS -->
