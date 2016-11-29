
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-5">
                        <div class="panel rounded shadow">
                            <div class="panel-body">
                                <div class="inner-all">
                                    <ul class="list-unstyled">
                                        <li class="text-center">
                                            <img width="120" class="img-square img-bordered-primary" src="<?php echo base_url('uploads/user_img/'.$user_detail[0]->profile_img);?>">
                                        </li>
                                        <li class="text-center">
                                            <h4 class="text-capitalize"><?php echo $user_detail[0]->username; ?></h4>
                                            <!--<p class="text-muted text-capitalize"><?php echo $user_detail[0]->business_type; ?></p>-->
                                        </li>
                                        <li><br/></li>
                                        <li>
                                            <div class="btn-group-vertical btn-block">
                                                <a href="<?php echo site_url('users/editprofile');?>" class="btn btn-lilac"><i class="fa fa-pencil pull-right"></i>Edit My Profile</a>
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
                                    <li class="list-group-item"><i class="fa fa-user mr-5"></i> <?php echo $user_detail[0]->first_name; ?> <?php echo $user_detail[0]->last_name; ?></li>
                                    <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> <?php echo $user_detail[0]->email; ?></li>
                                </ul>
                                
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->

                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7">
                        <div class="panel rounded shadow panel-default">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h3 class="panel-title">User Activity History</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /.panel-heading -->
                            
                            <div class="panel-body">
                                <!-- Start datatable -->
                                <table id="datatable-client-profile" class="table table-striped table-default table-middle table-project-clients">
                                    <thead>
                                    <tr>
                                        <th data-class="expand">Date/Time</th>
                                        <th data-hide="phone">Activity Description</th>
                                    </tr>
                                    </thead>
                                    <!--tbody section is required-->
                                    <tbody>
                                        <tr class="border-warning">
                                            <td>
                                                August 12, 2016
                                            </td>
                                            <td>
                                                <b>34865486</b>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td>
                                                July 12, 2016
                                            </td>
                                            <td>
                                                <b>9876163</b>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td>
                                                June 12, 2016
                                            </td>
                                            <td>
                                                <b>2354921</b>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td>
                                                May 12, 2016
                                            </td>
                                            <td class="" >
                                                <b>39442342</b>
                                            </td>
                                        </tr>
                                        <tr class="border-warning">
                                            <td>
                                                April 12, 2016
                                            </td>
                                            <td class="text-left">
                                                <b>3456542</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <!--/ End datatable -->
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->
                        <div class="divider"></div>
                        
                    </div>
                    </div><!-- /.row -->

                </div><!-- /.body-content -->
                <!--/ End body content -->

