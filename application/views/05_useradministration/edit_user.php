

				<div class="body-content animated fadeIn">
				    <div class="row">
                    	
                        <div class="col-lg-8 col-md-8 col-sm-12">
                        
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
                            
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Edit User Profile</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                	
                                    <!--<form id="smart-form-register"  class="form-horizontal form-bordered" role="form">-->
                                    <form id="client-create-validation" name="smart-form-register" class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('users/edit_user/'.$user_detail[0]->id);?>" enctype="multipart/form-data" role="form">
                                    
                                    	<div class="form-body">
                                        	<div class="col-lg-12 col-md-12 col-sm-12"> 
                                                <div class="form-group form-group-divider">
                                                    <div class="form-inner">
                                                        <h5 class="no-margin">User Information and Privilege</h5>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">First Name <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="User First Name" name="firstname" value="<?php echo $user_detail[0]->first_name; ?>"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Last Name <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="User Last Name" name="lastname" value="<?php echo $user_detail[0]->last_name; ?>"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">User Group <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <select name="user_group" class="chosen-select" tabindex="2">
                                                            <option value="0" selected="" disabled="">Select User Group</option>
															<?php $user_group = $this->user_model->user_group();
                                                            foreach($user_group as $ug){
                                                            ?>
                                                            <option value="<?php echo $ug->id;?>" <?php if($user_detail[0]->user_group_id == $ug->id){ echo "selected";}else{}?>><?php echo $ug->user_group;?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Username <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Username" name="username" value="<?php echo $user_detail[0]->username; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        	
                                            
                                            
                                        	
                                        </div>
                                        
                                        <div class="form-footer">
                                            <br /><br />
                                            <div>
                                                <input type="submit" name="updateuser" value="Update User Profile" class="btn btn-success">
                                                <!--<input type="submit" name="return_to_profile" value="Return to Client Profile" class="btn btn-inverse">-->
                                                <a href="<?php echo site_url('users');?>" class="btn btn-inverse">Return to User Listing</a>
                                            </div>
                                        </div><!-- /.form-footer -->
                                    </form>
    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->

                </div>