				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="panel rounded shadow panel-default">
                                <?php 
								if($this->session->flashdata('error')!=''){
									echo 
									'<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Failure!</strong> '.$this->session->flashdata('error').'
									</div>';
							
								}
								if($this->session->flashdata('success')!=''){
									echo 
									'<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Success!</strong> '.$this->session->flashdata('success').'
									</div>';
								}
								?>
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Client Listing</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-setup-configure" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                        <tr>
                                            <th data-hide="phone">ClientID</th>
                                            <th data-class="expand">Client Name</th>
                                            <th data-hide="phone">Funds Sweep Date</th>
                                            <th data-hide="phone">VAT Input Window</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                        	<?php foreach($client_config_listing as $clientdata){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo $clientdata->client_id;?></b>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->client_name;?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $clientdata->sweep_execution_day;?> days
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $clientdata->vat_computation_hold;?> days
                                                </td>
                                                <td class="text-center">
                                                    
                                                    <a href="<?php echo site_url('clientadmin/fundsweep_config/'.$clientdata->client_id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-cog"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        <tr>
                                            <th>ClientID</th>
                                            <th>Client Name</th>
                                            <th>Funds Sweep Date</th>
                                            <th>VAT Input Window</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <!--/ End datatable -->
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                            <div class="divider"></div>
                            
                        </div>
                        
                        
                        <?php if($client_detail){?>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">FundsSweep Configuration - <?php echo $client_detail[0]->client_name;?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                    <form class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('clientadmin/fundsweep_config/'.$client_detail[0]->id);?>" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Monthly FundsSweep Day</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="sweep_execution_day" value="<?php echo $client_detail[0]->sweep_execution_day;?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Vendor VAT Input Window</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="vat_computation_hold" value="<?php echo $client_detail[0]->vat_computation_hold;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <div class="col-sm-offset-3">
                                                <input type="submit" name="update_fs_configuration" value="Update Configuration" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>

    
                                </div>
                            </div>
                        </div>
                        <?php }else{?>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">FundsSweep Configuration Form</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                    <form class="form-horizontal form-bordered" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Monthly FundsSweep Day</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" disabled="disabled" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Vendor VAT Input Window</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" disabled="disabled" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <div class="col-sm-offset-3">
                                                <button type="submit" disabled="disabled" class="btn btn-default">Submit Configuration</button>
                                            </div>
                                        </div>
                                    </form>

    
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div><!-- /.row -->

                </div>