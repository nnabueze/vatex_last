<?php
include('header.php');
include('sidebar.php');
?>
<!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-cogs"></i> Computed VAT <span>...</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">You are here:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Funds Sweeping</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Computed VAT</li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->
			<?php if($this->session->flashdata('error')!=''){
							echo '<section><p style="color:red;">'.$this->session->flashdata('error').'</p></section>';
						}
						if($this->session->flashdata('success')!=''){
							echo '<section><p style="color:green;">'.$this->session->flashdata('success').'</p></section>';
						}
						?>
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                    	<div class="col-lg-3 col-md-3 col-sm-4">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Select Sweep Options</h3>
                                    </div><!-- /.pull-left -->
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                                    </div><!-- /.pull-right -->
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <form action="#">
                                        <div class="form-group no-margin">
                                            <div class="rdio rdio-primary circle">
                                                <input id="price-range2" type="radio" name="price-range">
                                                <label for="price-range2">Preview by Client</label>
                                            </div>
                                            <div class="rdio rdio-primary circle">
                                                <input id="price-range3" type="radio" name="price-range">
                                                <label for="price-range3">Preview by Next Due Date</label>
                                            </div>
                                            <div class="rdio rdio-primary circle">
                                                <input id="price-range1" type="radio" name="price-range">
                                                <label for="price-range1">Preview AutoSweep Queue</label>
                                            </div>
                                            <div class="rdio rdio-primary circle">
                                                <input id="price-range4" type="radio" name="price-range">
                                                <label for="price-range4">AutoSweep Configuration</label>
                                            </div>
                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div><!-- /.form-group -->
                                    </form>
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->

                        </div>
                        
                        <div class="col-lg-9 col-md-9 col-sm-8">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">VAT on Hold Queue</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="vatonhold" class="table table-striped table-default table-middle">
                                        <thead>
                                        <tr>
                                            <th data-hide="phone">ClientID</th>
                                            <th data-class="expand">Client</th>
                                            <th data-hide="phone">Transactions</th>
                                            <th data-hide="phone, tablet">Amount</th>
                                            <th data-hide="phone, tablet">SweepDate</th>
                                            <th data-hide="phone, tablet">SourceBank</th>
                                            <th data-hide="phone, tablet">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
										</tbody>
										<!--tfoot section is optional-->
                                        <tfoot>
                                        <tr><th>ClientID</th>
                                            <th>Client</th>
                                            <th>Transactions</th>
                                            <th>Amount</th>
                                            <th>SweepDate</th>
                                            <th>SourceBank</th>
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
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#vatonhold').DataTable( {
					"processing": true,
					"serverSide": true,
					"bFilter":false,
					"ajax":{
						url :"<?php echo base_url('vatonhold/getholddata'); ?>", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".vatonhold-error").html("");
							$("#vatonhold").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#vatonhold_processing").css("display","none");
							
						}
					},
					 "columnDefs": [ {
					createdRow: function(row, data, index) {
						$(row).addClass('whatever'); // 6 is index of column
					},
					"targets": -1,
					"data": null,
					"defaultContent": " <a id='view' class='btn btn-default btn-xs' data-toggle='tooltip' data-placement='top' data-original-title='View detail'><i class='fa fa-eye'></i></a><a id='execute_sweep' class='btn btn-default btn-xs' data-toggle='tooltip' data-placement='top' data-original-title='Execute Sweep'><i class='fa fa-cogs'></i></a>"
				} ]
				} );

				   $('#vatonhold tbody ').on( 'click', '#view', function () {
						var data = dataTable.row( $(this).parents('tr') ).data();
						//alert(data[0]+'---'+data[4]);
						window.location.href = "<?php echo base_url('vatonhold/viewdetails/');?>/"+data[0]+"/"+data[4];
					} );
				 $('#vatonhold tbody ').on( 'click', '#execute_sweep', function () {
						var data = dataTable.row( $(this).parents('tr') ).data();
						//window.location.href = "index.php?categ=delete&id="+ data[0];
						//alert(data);
						window.location.href = "<?php echo base_url('vatonhold/initiatemanualsweep/');?>/"+data[0]+"/"+data[4];
					} );
					dataTable.on( 'draw', function () {
						$('tr').each(function (){
							  $(this).addClass('border-warning');

						})
						$('td').each(function (){
							  $(this).addClass('text-center');

						})
					});
				$('#vatonhold tr').addClass("border-warning");
			} );
		</script>