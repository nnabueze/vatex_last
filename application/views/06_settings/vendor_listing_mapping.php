				<div class="body-content animated fadeIn">
					<div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Vendor Listing and Mapping</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">Vendor ID</th>
                                                <th>Vendor TIN</th>
                                                <th data-hide="phone,tablet">Client Mapped</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date Added</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Last Login</th>
                                                <th data-hide="phone,tablet" class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                        	<?php foreach($vendor_listing as $ul){?>
                                            <tr>
                                                <td><?php echo $ul->vendor_id;?></td>
                                                <td><?php echo $ul->vendor_tin;?></td>
                                                <td><?php echo $ul->client_name;?></td>
                                                <td><?php echo $ul->date_added;?></td>
                                                <td><?php echo $ul->last_login;?></td>
                                                <td class="text-center">
                                                	<?php if($ul->status==1){ ?>
                                                    <span class="label label-success">Active</span>
													<?php } else { ?>
													<span class="label label-warning">Inactive</span>
													<?php } ?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        	<tr>
                                                <th>Vendor ID</th>
                                                <th>Vendor TIN</th>
                                                <th>Client Mapped</th>
                                                <th>Date Added</th>
                                                <th>Last Login</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        
                                    </table>
                                    
                                    <!--/ End datatable -->
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                        </div>
                    </div>
                    
                </div>