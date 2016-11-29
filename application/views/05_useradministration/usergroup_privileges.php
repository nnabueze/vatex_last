				
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
                                        <h3 class="panel-title">User Groups/Privileges</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-setup-configure" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                        <tr>
                                            <th data-hide="phone">#</th>
                                            <th data-class="expand">User Group</th>
                                            <th data-hide="phone">Description</th>
                                            <th data-hide="phone">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
										<?php $user_group = $this->user_group_model->user_group_list();
                                        $u =1;
                                        foreach($user_group as $ug){
                                        ?>
                                            <tr>
                                                <td><?php echo $u;?>.</td>
                                                <td><?php echo $ug->user_group;?></td>
                                                <td>Description</td>
                                                <td><?php if($ug->status=='1'){
                                                echo "Enabled";
                                                }else{ echo "Disabled";}?></td>
                                                <td class="text-center"><a href="<?php echo site_url('users/edit_usergroup_privileges/'.$ug->id);?>" title="Edit User Group" alt = "Edit User Group"><i class="fa fa-fw fa-edit text-muted hidden-md hidden-sm hidden-xs"></i></a>
                                                <a href="javascript: delete_user_privileges(<?php echo $ug->id; ?>)"title="Delete Usergroup privileges" alt = "Usergroup privileges"><i class="fa fa-fw  fa-close text-muted hidden-md hidden-sm hidden-xs"></i></a></td>
                                            </tr>
                                        <?php 
                                        $u++;
                                        }?>
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>User Group</th>
                                            <th>Description</th>
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
                        
                        <?php //echo  $this->uri->segment(2); // n=1 for controller, n=2 for method, et?>
                        <!-- NEW WIDGET START -->
                        <?php if($uri_segment_3 == 'privileges'){ ?>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">New User Group Form</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <form id="add_usergroup" name="add_usergroup" class="form-horizontal form-bordered" action="<?php echo base_url('users/add_usergroup');?>" method="post">
                                        <div class="form-body">
                                        	<div class="form-group">
                                                <label class="col-sm-4 control-label"><strong>Usergroup Name</strong></label>
                                                <div class="col-sm-8">
                                                    <input class="form-control rounded" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            	<label class="col-md-3 control-label"><strong>Status</strong></label>
                                                <div class="col-md-9">
                                                    <div class="radio">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="user_group_status" value="1" checked><i></i>
                                                            Enable
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="user_group_status" value="0"><i></i>
                                                            Disable
                                                        </label>
                                                    </div>
                                                </div>
                                            	
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Client Management</a></strong></label>
                                                <div id="collapseTwo-1" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked12" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked12">Create New Client</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked13"  name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked13">Client Listing</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked14"  name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked14">Funds Sweep Config</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-2" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Transactions</a></strong></label>
                                                <div id="collapseTwo-2" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked10" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked10">Initiated Orders</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked11" type="checkbox" name="permissions[]" value="" >
                                                        <label for="checkbox-unchecked11">Successful/Closed Orders</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-3" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Reports</a></strong></label>
                                                <div id="collapseTwo-3" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked9" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked9">Reports</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-4" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> User Administration</a></strong></label>
                                                <div id="collapseTwo-4" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked6" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked6">User Listing</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked7" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked7">Create New User</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked8" name="permissions[]" value="" type="checkbox" >
                                                        <label for="checkbox-unchecked8">User Groups & Privileges</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-5" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Profile Management</a></strong></label>
                                                <div id="collapseTwo-5" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked4" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked4">My Profile</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked5" name="permissions[]" value="" type="checkbox">
                                                        <label for="checkbox-unchecked5">Edit Profile</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-6" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Rules & Procedures</a></strong></label>
                                                <div id="collapseTwo-6" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked1" name="permissions[]" value="biller/add_biller" type="checkbox">
                                                        <label for="checkbox-unchecked1">VATible and Non-VATible</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked2" name="permissions[]" value="biller/add_biller" type="checkbox">
                                                        <label for="checkbox-unchecked2">Vendor Listing & Mapping</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked3" name="permissions[]" value="biller/add_biller" type="checkbox">
                                                        <label for="checkbox-unchecked3">Vendor Input VAT Tracking</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-body -->
                                        <div class="form-footer">
                                            <div class="pull-right">
                                                <button class="btn btn-danger mr-5">Cancel</button>
                                                <button class="btn btn-success" type="submit">Add User Group</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- /.form-footer -->
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- WIDGET END -->
                        <?php }
                        if($uri_segment_3 == 'edit_usergroup_privileges'){ ?>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Edit User Group Form</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                	<?php
									$uid = $this->uri->segment(4);
									?>
                                    <form id="add_usergroup" name="add_usergroup" class="form-horizontal form-bordered" action="<?php echo base_url('users/edit_usergroup_privileges/'.$uid);?>" method="post">
                                        <div class="form-body">
                                        	<div class="form-group">
                                                <label class="col-sm-4 control-label"><strong>Usergroup Name</strong></label>
                                                <div class="col-sm-8">
                                                    <input class="form-control rounded" value="<?php echo $user_group_dt[0]->user_group;?>" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            	<label class="col-md-3 control-label"><strong>Status</strong></label>
                                                <div class="col-md-9">
                                                    <div class="radio">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="user_group_status" value="1" <?php if($user_group_dt[0]->status == '1'){ echo "checked";}else{echo "";}?>><i></i>
                                                            Enable
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="user_group_status" value="0" <?php if($user_group_dt[0]->status == '0'){ echo "checked";}else{echo "";}?>><i></i>
                                                            Disable
                                                        </label>
                                                    </div>
                                                </div>
                                            	
                                            </div>
                                            
                                            <?php
                                            $perm = array();
                                            foreach($usergr_permission_dt as $usp){
                                                $perm[] = $usp->user_permissions;
                                            }
                                            ?>

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Client Management</a></strong></label>
                                                <div id="collapseTwo-1" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked12" name="permissions[]" value="clientadmin/create_new" <?php if(in_array('clientadmin/create_new',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked12">Create New Client</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked13"  name="permissions[]" value="clientadmin/listing" <?php if(in_array('clientadmin/listing',$perm)){ echo "checked";}?> >
                                                        <label for="checkbox-unchecked13">Client Listing</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked14"  name="permissions[]" value="clientadmin/fundsweep_config" <?php if(in_array('clientadmin/fundsweep_config',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked14">Funds Sweep Config</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-2" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Transactions</a></strong></label>
                                                <div id="collapseTwo-2" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked10" name="permissions[]" value="transaction/initiated_orders" <?php if(in_array('transaction/initiated_orders',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked10">Initiated Orders</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked11" type="checkbox" name="permissions[]" value="transaction/closed_orders" <?php if(in_array('transaction/closed_orders',$perm)){ echo "checked";}?> >
                                                        <label for="checkbox-unchecked11">Successful/Closed Orders</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-3" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Reports</a></strong></label>
                                                <div id="collapseTwo-3" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked9" name="permissions[]" value="reports" <?php if(in_array('reports',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked9">Reports</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-4" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> User Administration</a></strong></label>
                                                <div id="collapseTwo-4" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked6" name="permissions[]" value="users/listing" <?php if(in_array('users/listing',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked6">User Listing</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked7" name="permissions[]" value="users/newuser" <?php if(in_array('users/newuser',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked7">Create New User</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked8" name="permissions[]" value="users/privileges" <?php if(in_array('users/privileges',$perm)){ echo "checked";}?> type="checkbox" >
                                                        <label for="checkbox-unchecked8">User Groups & Privileges</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-5" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Profile Management</a></strong></label>
                                                <div id="collapseTwo-5" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked4" name="permissions[]" value="users/profile" <?php if(in_array('users/profile',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked4">My Profile</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked5" name="permissions[]" value="users/editprofile" <?php if(in_array('users/editprofile',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked5">Edit Profile</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->

                                            <div class="form-group">
                                                <label class="control-label"><strong><a data-toggle="collapse" href="#collapseTwo-6" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> Rules & Procedures</a></strong></label>
                                                <div id="collapseTwo-6" class="panel-collapse collapse">
                                                <div class="col-md-4">&nbsp;</div>
                                                <div class="col-md-8">
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked1" name="permissions[]" value="settings/#" <?php if(in_array('settings/#',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked1">VATible and Non-VATible</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked2" name="permissions[]" value="settings/#" <?php if(in_array('settings/#',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked2">Vendor Listing & Mapping</label>
                                                    </div>
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="checkbox-unchecked3" name="permissions[]" value="settings/#" <?php if(in_array('settings/#',$perm)){ echo "checked";}?> type="checkbox">
                                                        <label for="checkbox-unchecked3">Vendor Input VAT Tracking</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-body -->
                                        <div class="form-footer">
                                            <div class="pull-right">
                                                <button class="btn btn-danger mr-5">Cancel</button>
                                                <button class="btn btn-success" type="submit">Add User Group</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- /.form-footer -->
                                    </form>
                                    <form id="edit_usergroup" name="edit_usergroup" class="smart-form" action="<?php echo base_url('usergroup_privileges/edit_usergroup_privileges/'.$uid);?>" method="post">
                                        <header>User group Form</header>
                                        <fieldset>
                                            <section>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="user_group" id="user_group" placeholder="User Group Name" value="<?php echo $user_group_dt[0]->user_group;?>">
                                                    <b class="tooltip tooltip-bottom-right">Please enter user group name</b>
                                                </label>
                                            </section>									
                                            <section>
                                            <label class="label">Status</label>
                                            <div class="row">
                                                <div class="col col-4">
                                                    <label class="radio state-success" ><input type="radio" name="user_group_status" value="1" <?php if($user_group_dt[0]->status == '1'){ echo "checked";}else{echo "";}?>><i></i>Enable</label>
                                                </div>
                                                <div class="col col-4">
                                                    <label class="radio state-success"><input type="radio" name="user_group_status" value="0" <?php if($user_group_dt[0]->status == '0'){ echo "checked";}else{echo "";}?>><i></i>Disable</label>
                                                </div>
                                            </div>
                                            </section>	
                                            <?php
                                            $perm = array();
                                            foreach($usergr_permission_dt as $usp){
                                                $perm[] = $usp->user_permissions;
                                            }
                                            ?>
                                            <div class="widget-body no-padding">
                                            <div class="panel-group smart-accordion-default" id="accordion-2">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>Biller Management</a></h4>
                                                    </div>
                                                    <div id="collapseTwo-1" class="panel-collapse collapse">
                                                        <fieldset>
                                                            <section>
                                                                <div class="col col-9" style="    margin-top: -18px;">
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/listing" <?php if(in_array('biller/listing',$perm)){ echo "checked";}?>>
                                                                <i></i>List of Billers</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/add_biller" <?php if(in_array('biller/add_biller',$perm)){ echo "checked";}?>>
                                                                <i></i>Create New Biller</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/edit_biller" <?php if(in_array('biller/edit_biller',$perm)){ echo "checked";}?>>
                                                                <i></i>Edit Biller</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller" <?php if(in_array('biller',$perm)){ echo "checked";}?>>
                                                                <i></i>Approve New Biller</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/pending_biller" <?php if(in_array('biller/pending_biller',$perm)){ echo "checked";}?>>
                                                                <i></i>Pending Biller Request</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/approved_biller" <?php if(in_array('biller/approved_biller',$perm)){ echo "checked";}?>>
                                                                <i></i>Approved Billers</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/declined_biller" <?php if(in_array('biller/declined_biller',$perm)){ echo "checked";}?>>
                                                                <i></i>Declined Billers</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller_administration" <?php if(in_array('biller_administration',$perm)){ echo "checked";}?>>
                                                                <i></i>Biller Administration</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/biller_configuration" <?php if(in_array('biller/biller_configuration',$perm)){ echo "checked";}?>>
                                                                <i></i>Biller Configuration</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/biller_configuration_change" <?php if(in_array('biller/biller_configuration_change',$perm)){ echo "checked";}?>>
                                                                <i></i>Biller Configuration Change</label>
                                                                <label class="checkbox">
                                                                <input type="checkbox" name="permissions[]" value="biller/alter_table" <?php if(in_array('biller/alter_table',$perm)){ echo "checked";}?>>
                                                                <i></i>Biller Configuration - Alter DB Table</label>
                                                            </div>	
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-4" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>Message Center</a></h4>
                                                    </div>
                                                    <div id="collapseTwo-4" class="panel-collapse collapse">
                                                        <fieldset>
                                                            <section>
                                                                <div class="col col-6" style="    margin-top: -18px;">
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="tickets" <?php 
                                                                if(in_array('tickets',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>Support Centre 
                                                                </label>
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="ercas_message" <?php 
                                                                if(in_array('ercas_message',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>ERCAS Messaging
                                                                </label>
                                                            </div>	
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-5" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>Reports and Analytics</a></h4>
                                                    </div>
                                                    <div id="collapseTwo-5" class="panel-collapse collapse">
                                                        <fieldset>
                                                            <section>
                                                                <div class="col col-6" style="    margin-top: -18px;">
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="reports" <?php 
                                                                if(in_array('reports',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>Search / Generate Biller Reports
                                                                </label>
                                                            </div>	
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-2" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>User Administration</a></h4>
                                                    </div>
                                                    <div id="collapseTwo-2" class="panel-collapse collapse">
                                                        <fieldset>
                                                            <section>
                                                                <div class="col col-6" style="    margin-top: -18px;">
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="usergroup_privileges" <?php 
                                                                if(in_array('usergroup_privileges',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>User Group and Privileges
                                                                </label>
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="registration" <?php 
                                                                if(in_array('registration',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>Create New User
                                                                </label>
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="users" <?php 
                                                                if(in_array('users',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>User Accounts
                                                                </label>
                                                            </div>	
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-3" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>Profile Management</a></h4>
                                                    </div>
                                                    <div id="collapseTwo-3" class="panel-collapse collapse">
                                                        <fieldset>
                                                            <section>
                                                                <div class="col col-6" style="    margin-top: -18px;">
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="profile_management" <?php 
                                                                if(in_array('profile_management',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>Profile Management 
                                                                </label>
                                                            </div>	
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-6" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>General Setting</a></h4>
                                                    </div>
                                                    <div id="collapseTwo-6" class="panel-collapse collapse">
                                                        <fieldset>
                                                            <section>
                                                                <div class="col col-6" style="    margin-top: -18px;">
                                                                <label class="checkbox">
                                                                    <input type="checkbox" name="permissions[]" value="general_setting" <?php 
                                                                if(in_array('general_setting',$perm)){ echo "checked";}
                                                                ?>>
                                                                    <i></i>General Setting
                                                                </label>
                                                            </div>	
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        </fieldset>
                                        <footer>
                                            <button type="submit" class="btn btn-primary">Edit User Group</button>
                                        </footer>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>	
                        
                    </div><!-- /.row -->

                </div>
   
		
<script type="text/javascript">
	/*function delete_user_privileges(uid)
	{
		if (confirm('Are You Sure to Delete this Record?')){
			window.location.href = 'delete_usergroup_privileges/' + uid;
		}
	}*/
</script>
<script type="text/javascript">
// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
	$(document).ready(function() {
		pageSetUp();
		var $registerForm = $("#add_usergroup").validate({
	
		// Rules for form validation
		rules : {
			user_group : {
				required : true
			}
		},

		// Messages for form validation
		messages : {
			user_group : {
				required : 'Please enter your user group'
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});
});
</script>
