				<div class="body-content animated fadeIn">
					<div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('users/newuser');?>" class="btn btn-success"><i class="icon-user-follow icons"></i> Create New User</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">User Listing</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                 	<?php 
									if($this->session->flashdata('error')!=''){
										echo 
										'<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<strong>Sorry!</strong> '.$this->session->flashdata('error').'
										</div>';
								
									}
									if($this->session->flashdata('success')!=''){
										echo 
										'<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<strong>Great!</strong> '.$this->session->flashdata('success').'
										</div>';
									}
									?>
                                    
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-client-listing" class="table table-striped table-primary table-middle table-project-clients">
                                        <thead>
                                            <tr>
                                                <!--<th data-hide="phone">ID</th>-->
                                                <th data-class="expand">Name</th>
                                                <th>Email Address</th>
                                                <th data-hide="phone,tablet">Username</th>
                                                <th data-hide="phone,tablet">User Group</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>Added Date</th>
                                                <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>Last Login</th>
                                                <th data-hide="phone">Action</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                        	<?php foreach($user_listing as $ul){?>
                                            <tr>
                                                <!--<td><?php echo $ul->id;?></td>-->
                                                <td><?php echo $ul->first_name.' '.$ul->last_name;?></td>
                                                <td><?php echo $ul->email;?></td>
                                                <td><?php echo $ul->username;?></td>
                                                <td><?php
                                                $usgd = $this->user_model->user_group_detail($ul->user_group_id);
                                                echo $usgd[0]->user_group;
                                                ?></td>
                                                <td><?php echo $ul->added_date;?></td>
                                                <td><?php echo $ul->last_login;?></td>
                                                <td><a href="<?php echo site_url('users/edit_user/'.$ul->id);?>" title="Edit User" alt = "Edit User"><i class="fa fa-fw fa-edit text-muted hidden-md hidden-sm hidden-xs"></i></a>
                                                <a href="javascript: delete_user(<?php echo $ul->id; ?>)" title="Delete User" alt = "Delete User"><i class="fa fa-fw  fa-close text-muted hidden-md hidden-sm hidden-xs"></i></a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                        	<tr>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Username</th>
                                                <th>User Group</th>
                                                <th>Added Date</th>
                                                <th>Last Login</th>
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
        <script type="text/javascript">        
        /*function delete_user(uid)
		{
			if (confirm('Are You Sure to Delete this Record?')){
				window.location.href = 'users/delete_user/' + uid;
			}
		}
		*/
		</script>