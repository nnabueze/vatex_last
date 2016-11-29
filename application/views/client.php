<?php
include('header.php');
include('sidebar.php');
?>

<section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-male"></i> Client Listing <span>...to manage clients</span></h2>
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
                            <li class="active">Client Listing</li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div class="body-content animated fadeIn">
					<div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-warning"><i class="icon-user-follow icons"></i> Onboard New Client</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Client Listing</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-client-listing" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                        <tr>
											<th data-class="expand">Client Name</th>
                                            <th data-hide="phone">Identifier</th>
                                            <th data-hide="phone">Client Type</th>
                                            <th data-hide="phone">Account Manager</th>
                                            <th data-hide="phone,tablet" class="text-right">Manager Email</th>
                                            <th data-hide="phone,tablet" class="text-right">Mobile</th>
											<th data-hide="phone,tablet" class="text-right">Status</th>
                                            <th data-hide="phone,tablet" class="text-right">Action</th>
										</tr>
                                        </thead>
                                        <tbody>
                                         <?php foreach($client_listing as $clientdata){ ?>
											<tr class="border-warning">
                                                <td>
                                                    <b><?php echo $clientdata->first_name; ?> <?php echo $clientdata->last_name; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->username; ?>
                                                </td>
                                                <td>
                                                    ECommerce
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->amanager; ?>
                                                </td>
                                                
												<td class="text-right">
                                                    <?php echo $clientdata->amemail; ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php echo $clientdata->mobile; ?>
                                                </td>
												<td class="text-center">
													<?php if($clientdata->status==1){ ?>
                                                    <span class="label label-lilac">Active</span>
													<?php } else { ?>
													<span class="label label-warning">Inactive</span>
													<?php } ?>
												</td>
                                                <td class="text-center">
                                                    <a href="<?php echo site_url('client/view_client/'.$clientdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo site_url('client/edit_client/'.$clientdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
													<a href="<?php echo site_url('client/settings/'.$clientdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Setup & Configure"><i class="fa fa-gears"></i></a>
                                                </td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Identifier</th>
                                            <th>Client Type</th>
                                            <th>Account Manager</th>
                                            <th>Manager Email</th>
                                            <th>Mobile</th>
											<th>Status</th>
                                            <th>Action</th>
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
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/datatables.responsive.js'); ?>"></script>
        <!--/ END PAGE LEVEL PLUGINS -->
        
        
        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/main/assets/admin/js/apps.js'); ?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->
		<script>
		
/*$( document ).ready(function() {
$('#datatable-client-listing').DataTable({
				 "bProcessing": true,
         "serverSide": true,
         "ajax":{
            url :"<?php echo site_url('client/listclient/');?>", // json datasource
            type: "post",  // type of method  , by default would be get
            error: function(){  // error handling code
             // $(".employee-grid-error").html("");
              //$("#employee_grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee_grid_processing").css("display","none");
            }
          }
        });   
}); */
</script>