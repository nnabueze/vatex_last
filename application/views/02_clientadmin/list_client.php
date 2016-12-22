				<div class="body-content animated fadeIn">
					<div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('clientadmin/create_new');?>" class="btn btn-success"><i class="icon-user-follow icons"></i> Onboard New Client</a>
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
                                    <!-- Start datatable -->
                                    <table id="datatable-client-listing" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                        <tr>
                                            <th data-class="expand">Client ID</th>
                                            <th data-hide="phone">ECommerce Name</th>
                                            <th data-hide="phone">Client Type</th>
                                            <th data-hide="phone">ECommerce Contact</th>
                                            <th data-hide="phone,tablet">Contact Phone No</th>
                                            <th data-hide="phone,tablet" class="text-center">Status</th>
                                            <th data-hide="phone,tablet" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                        	<?php foreach($client_listing as $clientdata){ ?>
											<tr class="border-warning">
                                                <td>
                                                    <b><?php echo $clientdata->id; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->client_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->business_type; ?>
                                                </td>
                                                <td>
                                                    <?php echo $clientdata->contact_name; ?>
                                                </td>
                                                
												<td>
                                                    <?php echo $clientdata->contact_phone; ?>
                                                </td>
												<td class="text-center">
													<?php if($clientdata->status==1){ ?>
                                                    <span class="label label-success">Active</span>
													<?php } else { ?>
													<span class="label label-warning">Inactive</span>
													<?php } ?>
												</td>
                                                <td class="text-center">
                                                    <a href="<?php echo site_url('clientadmin/view_client/'.$clientdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo site_url('clientadmin/edit_client/'.$clientdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
													<a href="<?php echo site_url('clientadmin/settings/'.$clientdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Setup & Configure"><i class="fa fa-gears"></i></a>
                                                </td>
                                            </tr>
											<?php } ?>
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        <tr>
                                            <th>Client ID</th>
                                            <th>ECommerce Name</th>
                                            <th>Client Type</th>
                                            <th>ECommerce Contact</th>
                                            <th>Contact Phone Number</th>
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
                    
                </div>