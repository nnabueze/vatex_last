<?php
include('header.php');
include('sidebar.php');
?>
<section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-male"></i> Orders Listing <span>...to manage Transaction</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">You are here:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Pending Transaction Details</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Order Listing</li>
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
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Pending Orders Listing</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
								<div><?php if($this->session->flashdata('error')!=''){
										echo '<section><p style="color:red;"><b>'.$this->session->flashdata('error').'</b></p></section>';
									}
									if($this->session->flashdata('success')!=''){
										echo '<section><p style="color:green;"><b>'.$this->session->flashdata('success').'</b></p></section>';
									}
									?></div>        
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-listing" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                        <tr>
											<th data-class="expand">Client Name</th>
                                            <th data-hide="phone">Order id</th>
                                            <th data-hide="phone">Vat Amount</th>
                                            <th data-hide="phone,tablet" class="text-right">Bank Name</th>
                                            <th data-hide="phone,tablet" class="text-right">Action</th>
										</tr>
                                        </thead>
                                        <tbody>
                                         <?php foreach($vatdetails as $clientdata){ 
											$userdata = $this->transaction_model->get_user_name($clientdata->ec_id);
											//print_r($userdata);
											$bankdata = $this->transaction_model->get_bank_name($clientdata->bankcode);
										 ?>
											<tr class="border-warning">
                                                <td>
                                                    <b><?php echo $userdata[0]->username; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->orderid; ?>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->vat_amount; ?>
                                                </td>
                                                <td>
                                                    <?php echo $bankdata[0]->bankname; ?>
                                                </td>
                                                
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Refund"><i class="fa fa-exchange"></i></a>
                                                </td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Order id</th>
                                            <th>Vat Amount</th>
                                            <th>Bank Name</th>
                                            
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
        <script src="<?php echo base_url('assets/main/assets/admin/js/pages/blankon.table.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/demo.js'); ?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->

		<script>
		
$( document ).ready(function() {
$('#datatable-listing').DataTable({
				 "bProcessing": true,
         "serverSide": false,
         
        });   
}); 
</script>