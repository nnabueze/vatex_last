<?php
include('header.php');
include('sidebar.php');
?>

<!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-home"></i>Dashboard <span>dashboard & statistics</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">You are here:</span>
                        <ol class="breadcrumb">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
               <div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="mini-stat-type-3 shadow border-danger">
                                <div class="ribbon-wrapper">
                                    <a href="#" class="ribbon ribbon-success ribbon-shadow">View</a>
                                </div>
                                <span class="text-uppercase text-block text-center">Computted VAT AMOUNT</span>
                                <h3 class="text-strong text-center">₦<span class="counter">24.5</span></h3>
   
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="mini-stat-type-3 shadow border-danger">
                                <div class="ribbon-wrapper">
                                    <a href="#" class="ribbon ribbon-danger ribbon-shadow">View</a>
                                </div>
                                <span class="text-uppercase text-block text-center">Deducted VAT AMOUNT</span>
                                <h3 class="text-strong text-center">₦<span class="counter">3,540</span></h3>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="mini-stat-type-3 shadow border-danger">
                                <div class="ribbon-wrapper">
                                    <a href="#" class="ribbon ribbon-primary ribbon-shadow">View</a>
                                </div>
                                <span class="text-uppercase text-block text-center">REMITTED VAT AMOUNT</span>
                                <h3 class="text-strong text-center">₦<span class="counter">1.8</span></h3>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="mini-stat-type-3 shadow border-danger">
                                <div class="ribbon-wrapper">
                                    <a href="#" class="ribbon ribbon-warning ribbon-shadow">View</a>
                                </div>
                                <span class="text-uppercase text-block text-center">VAT REMITTANCE ERROR</span>
                                <h3 class="text-strong text-center">₦<span class="counter">2,480</span></h3>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">

                            <!-- Start total investments -->
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Total investments</h3>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-action="expand" data-toggle="tooltip" data-placement="top" data-title="Expand"><i class="fa fa-expand"></i></button>
                                        <button class="btn btn-sm" data-action="refresh" data-toggle="tooltip" data-placement="top" data-title="Refresh"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                                        <button class="btn btn-sm" data-action="remove" data-toggle="tooltip" data-placement="top" data-title="Remove"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="total-investments" class="chart"></div>
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                            <!--/ End total investments -->

                        </div>
                        <div class="col-md-3">

                            <!-- Start list investment -->
                             <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center">List - <b>Ecommerce VAT</b></h3>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body no-padding">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <span class="pull-left text-capitalize">Jumia</span>
                                                    <span class="pull-right text-strong">₦<span class="counter">233.34</span>K</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="pull-left text-capitalize">Konga</span>
                                                    <span class="pull-right text-strong">₦<span class="counter">237.14</span>K</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="pull-left text-capitalize">Yudala</span>
                                                    <span class="pull-right text-strong">₦<span class="counter">542.9</span>K</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="pull-left text-capitalize">Jiji</span>
                                                    <span class="pull-right text-strong">₦<span class="counter">231.9</span>K</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="pull-left text-capitalize">Shopify</span>
                                                    <span class="pull-right text-strong">₦<span class="counter">784.39</span>K</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- /.panel-body -->
                            </div>
                            <!--/ End list investment -->

                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Median Raised</h3>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-action="refresh" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Refresh"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                                        <button class="btn btn-sm" data-action="remove" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Remove"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-median-raised" class="table table-bordered table-condensed table-striped table-default">
                                        <thead>
                                        <tr>
                                            <th data-class="expand">Series</th>
                                            <th data-hide="phone"><span class="fa fa-globe"></span> Computed VAT</th>
                                            <th data-hide="phone"><span class="fa fa-globe"></span> Remittance Error</th>
                                            <th data-hide="phone"><span class="fa fa-globe"></span>Deducted VAT </th>
                                            <th data-hide="phone,tablet"><span class="fa fa-globe"></span>Remitted VAT</th>
                                            <th data-hide="phone,tablet"><i class="fa fa-globe"></i>Total</th>
                                        </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody></tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        <tr>
                                            <th>Series</th>
                                            <th>Computed VAT</th>
                                            <th> Remittance Error</th>
                                            <th>Deducted VAT </th>
                                            <th>Remitted VAT</th>
                                            <th>Total</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <!--/ End datatable -->
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                        </div>
                    </div>

                </div><!-- /.body-content -->
                <!--/ End body content -->

<?php include('footer.php');?>		 
<!-- START @PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/jquery.gritter/js/jquery.gritter.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/d3/d3.min.js'); ?>" charset="utf-8"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/c3js-chart/c3.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/datatables.responsive.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/waypoints/lib/jquery.waypoints.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/counter-up/jquery.counterup.min.js'); ?>"></script>
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/main/assets/admin/js/apps.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/pages/blankon.dashboard.investor.js'); ?>"></script>
        <!----><script src="<?php echo base_url('assets/main/assets/admin/js/demo.js'); ?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->
