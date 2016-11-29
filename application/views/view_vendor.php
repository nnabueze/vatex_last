<?php
include('header.php');
include('sidebar.php');
?>
<!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-male"></i> Profile <span>profile sample</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">You are here:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Client Management</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Client Profile</li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="panel rounded shadow">
                            <div class="panel-body">
                                <div class="inner-all">
                                    <ul class="list-unstyled">
                                        <li class="text-center">
                                            <img class="img-circle img-bordered-primary" src="http://img.djavaui.com/?create=100x100,4888E1?f=ffffff" alt="Tol Lee">
                                        </li>
                                        <li class="text-center">
                                            <h4 class="text-capitalize"><?php echo $client_detail[0]->companyname; ?></h4>
                                            <p class="text-muted text-capitalize">E-Commerce Provider</p>
                                        </li>
                                        <li><br/></li>
                                        <li>
                                            <div class="btn-group-vertical btn-block">
                                                <a href="<?php echo site_url('vendor/edit_vendor/'.$client_detail[0]->id);?>" class="btn btn-default"><i class="fa fa-pencil pull-right"></i>Edit Vendor Profile</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.panel -->

                        <div class="panel panel-theme rounded shadow">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h3 class="panel-title">Contact Details</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /.panel-heading -->
                            <div class="panel-body no-padding rounded">
                                <ul class="list-group no-margin">
                                    <li class="list-group-item"><i class="fa fa-user mr-5"></i> <?php echo $client_detail[0]->firstname. ' '. $client_detail[0]->lastname; ?></li>
                                    <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> <?php echo $client_detail[0]->email; ?></li>
                                    <li class="list-group-item"><i class="fa fa-phone mr-5"></i> <?php echo $client_detail[0]->mobile; ?></li>
                                </ul>
                                
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->

                    </div>
                    </div><!-- /.row -->

                </div><!-- /.body-content -->
                <!--/ End body content -->





<?php include('footer.php');?>		
<!-- START @PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/datatables.responsive.js'); ?>"></script>
        <!--/ END PAGE LEVEL PLUGINS -->
        
        
        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/main/assets/admin/js/apps.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/pages/blankon.table.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/demo.js'); ?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->
