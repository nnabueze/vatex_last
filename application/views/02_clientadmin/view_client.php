
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-5">
                        <div class="panel rounded shadow">
                            <div class="panel-body">
                                <div class="inner-all">
                                    <ul class="list-unstyled">
                                        <li class="text-center">
                                            <img width="120" class="img-square img-bordered-primary" src="<?php echo base_url('uploads/client_img/'.$client_detail[0]->company_logo);?>">
                                        </li>
                                        <li class="text-center">
                                            <h4 class="text-capitalize"><?php echo $client_detail[0]->client_name; ?> - <?php echo $client_detail[0]->business_type; ?></h4>
                                            <!--<p class="text-muted text-capitalize"><?php echo $client_detail[0]->business_type; ?></p>-->
                                        </li>
                                        <li><br/></li>
                                        <li>
                                            <div class="btn-group-vertical btn-block">
                                                <a href="<?php echo site_url('clientadmin/edit_client/'.$client_detail[0]->id);?>" class="btn btn-lilac"><i class="fa fa-pencil pull-right"></i>Edit Client Profile</a>
                                            </div>
                                            <div class="btn-group-vertical btn-block">
                                                <a href="<?php echo site_url('clientadmin/settings/'.$client_detail[0]->id);?>" class="btn btn-inverse"><i class="fa fa-cog pull-right"></i>View Client Setup Configuration</a>
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
                                    <li class="list-group-item"><i class="fa fa-user mr-5"></i> <?php echo $client_detail[0]->contact_name; ?></li>
                                    <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> <?php echo $client_detail[0]->contact_email; ?></li>
                                    <li class="list-group-item"><i class="fa fa-phone mr-5"></i> <?php echo $client_detail[0]->contact_phone; ?></li>
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
                                                <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
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
                                                <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
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
                                                <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
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
                                                <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
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

