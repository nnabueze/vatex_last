<?php
include('header.php');
include('sidebar.php');
?>

<!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-cogs"></i> Financial Information <span>...client bank details and mandate</span></h2>
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
                            <li class="active">Client Settings</li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Client Settings</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                    
                                        <div class="form-body">
                                            
                                    <?php //echo $user_id; ?>    

<form id="smart-form-register" name="smart-form-register" class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('client/settings/'.$user_id);?>" enctype="multipart/form-data">
					<div class="form-group form-group-divider">
                                            <div class="form-inner">
                                                <h5 class="no-margin">API Information</h5>
                                            </div>
                                        </div><!-- /.form-group -->
										
							<?php if($this->session->flashdata('error')!=''){
								echo '<div><p style="color:red;">'.$this->session->flashdata('error').'</p></div>';								
							}
							if($this->session->flashdata('success')!=''){
								echo '<div><p style="color:green;">'.$this->session->flashdata('success').'</p></div>';
							}
							?>
							
							<div class="form-group">
                                 <label class="col-sm-3 control-label">API Key</label>
                                   <div class="col-md-6">
										<input type="text" disabled name="apikey" value="<?php echo $settings[0]->api_key; ?>" >
									</div>
							</div>
							<div class="form-group">
                                 <label class="col-sm-3 control-label">API Token</label>
                                   <div class="col-md-6">
										<input type="text" disabled name="apitoken" value="<?php echo $settings[0]->token_id; ?>" >
									</div>
							</div>

							
							
							
							
							<div class="form-group form-group-divider">
                                            <div class="form-inner">
                                                <h5 class="no-margin">Vat Settings Information</h5>
                                            </div>
                                        </div><!-- /.form-group -->
                                        
							<div class="form-group">
                                 <label class="col-sm-3 control-label">Execution Period</label>
                                   <div class="col-md-6">
										<input type="radio" name="execution_period" value="1" <?php if($settings[0]->vat_execution_period==1){ echo 'checked';}?>> &nbsp;Daily
										<input type="radio" name="execution_period" value="2" <?php if($settings[0]->vat_execution_period==2){ echo 'checked';}?>> &nbsp;Weekly
										<input type="radio" name="execution_period" value="3" <?php if($settings[0]->vat_execution_period==3){ echo 'checked';}?>> &nbsp;Monthly
									</div>
							</div>

							<div class="form-group">
                                 <label class="col-sm-3 control-label">Execution Mode</label>
                                   <div class="col-md-6">
										<input type="radio" name="vat_execution_mode" value="1" <?php if($settings[0]->vat_execution_mode==1){ echo 'checked';}?>> &nbsp;Auto
										<input type="radio" name="vat_execution_mode" value="2" <?php if($settings[0]->vat_execution_mode==2){ echo 'checked';}?>> &nbsp;Manual
										
									</div>
							</div>


						
						<div class="form-footer">
                                            <div class="col-sm-offset-3">
                                                <button type="submit" name="editsettings" value="Submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div><!-- /.form-footer -->


                                </div>
                            </div>
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
