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
                    <div class="col-lg-4 col-md-4 col-sm-5">
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
                                                <a href="<?php echo site_url('client/edit_client/'.$client_detail[0]->id);?>" class="btn btn-default"><i class="fa fa-pencil pull-right"></i>Edit Client Profile</a>
                                            </div>
                                            <div class="btn-group-vertical btn-block">
                                                <a href="<?php echo site_url('client/settings/'.$client_detail[0]->id);?>" class="btn btn-default"><i class="fa fa-cog pull-right"></i>View Client Setup Configuration</a>
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
                                    <li class="list-group-item"><i class="fa fa-user mr-5"></i> <?php echo $client_detail[0]->first_name. ' '. $client_detail[0]->last_name; ?></li>
                                    <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> <?php echo $client_detail[0]->email; ?></li>
                                    <li class="list-group-item"><i class="fa fa-phone mr-5"></i> <?php echo $client_detail[0]->mobile; ?></li>
                                </ul>
                                
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->

                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7">
                        <div class="panel rounded shadow panel-default">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h3 class="panel-title">Remittance History</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /.panel-heading -->
                            
                            <div class="panel-body">
                                <!-- Start datatable -->
                                <table id="datatable-client-profile" class="table table-striped table-default table-middle table-project-clients">
                                    <thead>
                                    <tr>
                                        <th data-class="expand">Transaction ID</th>
                                        <th data-hide="phone">Remittance Date</th>
                                        <th data-hide="phone,tablet" class="text-right">Remittance Amount</th>
                                        <th data-hide="phone,tablet" class="text-center">Status</th>
                                        <th data-hide="phone,tablet" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <!--tbody section is required-->
                                    <tbody>
                                        <tr class="border-warning">
                                            <td>
                                                <b>34865486</b>
                                            </td>
                                            <td>
                                                August 12, 2016
                                            </td>
                                            <td class="text-right">
                                                2,000,000.00
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-success">Successful</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="client_profile_view.html" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td>
                                                <b>9876163</b>
                                            </td>
                                            <td>
                                                July 12, 2016
                                            </td>
                                            <td class="text-right">
                                                3,000,000.00
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-success">Successful</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="client_profile_view.html" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td>
                                                <b>2354921</b>
                                            </td>
                                            <td>
                                                June 12, 2016
                                            </td>
                                            <td class="text-right">
                                                2,500,000.00
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-success">Successful</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="client_profile_view.html" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td class="" >
                                                <b>39442342</b>
                                            </td>
                                            <td>
                                                May 12, 2016
                                            </td>
                                            <td class="text-right">
                                                500,000.00
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-success">Successful</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="client_profile_view.html" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td class="text-left">
                                                <b>3456542</b>
                                            </td>
                                            <td>
                                                April 12, 2016
                                            </td>
                                            <td class="text-right">
                                                1,500,000.00
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-success">Successful</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="client_profile_view.html" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--tfoot section is optional-->
                                    <tfoot>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Remittance Date</th>
                                        <th>Remittance Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                
                                <!--/ End datatable -->
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->
                        <div class="divider"></div>
                        
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
