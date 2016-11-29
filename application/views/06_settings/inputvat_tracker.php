				<div class="body-content animated fadeIn">
					<div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Input VAT Tracker</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                 	
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-client-listing" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                        <tr>
                                            <th data-class="expand">Order ID</th>
                                            <th data-hide="phone">Transaction ID</th>
                                            <th data-hide="phone">Vendor ID</th>
                                            <th data-hide="phone">Client Name</th>
                                            <th data-hide="phone">Purchase Amt</th>
                                            <th data-hide="phone,tablet">Input VAT</th>
                                            <th data-hide="phone,tablet">Computed VAT</th>
                                            <th data-hide="phone,tablet">Days Remaining</th>
                                            <th data-hide="phone,tablet" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                        	<?php foreach($order_listing as $orderdata){ ?>
											<tr class="border-warning">
                                                <td>
                                                    <!--<b><?php echo $orderdata->id; ?></b>-->
                                                </td>
                                                <td>
                                                    <!--<?php echo $orderdata->client_name; ?>-->
                                                </td>
                                                <td>
                                                    <!--<?php echo $orderdata->business_type; ?>-->
                                                </td>
                                                <td>
                                                    <!--<?php echo $orderdata->contact_name; ?>-->
                                                </td>
                                                <td>
                                                    <!--<?php echo $orderdata->contact_name; ?>-->
                                                </td>
                                                <td>
                                                    <!--<?php echo $orderdata->contact_name; ?>-->
                                                </td>
                                                <td>
                                                    <!--<?php echo $orderdata->contact_name; ?>-->
                                                </td>
                                                
												<td>
                                                    <!--<?php echo $orderdata->contact_phone; ?>-->
                                                </td>
                                                <td class="text-center">
                                                    <!--<a href="<?php echo site_url('settings/inputvat_item/'.$orderdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo site_url('settings/inputvat_reminder/'.$orderdata->id);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Send a reminder to Vendor"><i class="fa fa-pencil"></i></a>-->
                                                </td>
                                            </tr>
											<?php } ?>
                                            
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Transaction ID</th>
                                            <th>Vendor ID</th>
                                            <th>Client Name</th>
                                            <th>Purchase Amt</th>
                                            <th>Input VAT</th>
                                            <th>Computed VAT</th>
                                            <th>Days Remaining</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>