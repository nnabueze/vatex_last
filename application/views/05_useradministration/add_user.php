

				<div class="body-content animated fadeIn">
				    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Create New User Form</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                	
                                    <!--<form id="smart-form-register"  class="form-horizontal form-bordered" role="form">-->
                                    <form id="user-create-validation" name="smart-form-register" class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('users/newuser');?>" enctype="multipart/form-data" role="form">
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
											<strong>Failure!</strong> '.$this->session->flashdata('success').'
										</div>';
									}
									?>
                                    
                                        <div class="form-body">
                                        	<div class="col-lg-5 col-md-5 col-sm-12"> 
                                                <div class="form-group form-group-divider">
                                                    <div class="form-inner">
                                                        <h5 class="no-margin">Basic Information</h5>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">First Name <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="User First Name" name="firstname"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Last Name <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="User Last Name" name="lastname"/>
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
                                                        <input type="text" class="form-control input-sm" placeholder="Username" name="username"/>
                                                    </div>
                                                </div>
                                            </div>
                                        	
                                            <div class="col-lg-5 col-md-5 col-sm-12"> 
                                                <div class="form-group form-group-divider">
                                                    <div class="form-inner">
                                                        <h5 class="no-margin">Login Credentials</h5>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Email Address <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Email Address" name="email"/>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Password <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control input-sm" placeholder="Password" name="password"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Confirm Password <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control input-sm" placeholder="Password" name="passwordConfirm"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        	<div class="col-lg-2 col-md-2 col-sm-12"> 
                                                <div class="form-group form-group-divider">
                                                    <div class="form-inner">
                                                        <h5 class="no-margin">User Image</h5>
                                                    </div>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                	
                                                    <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">
        											<link href="<?php echo base_url('assets/_main/global/plugins/bower_components/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css');?>" rel="stylesheet">
                                                    
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                            <img data-src="holder.js/100%x100%/blankon/text:User image" alt="...">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="max-width: 150px; max-height: 150px;"></div>
                                                        <div>
                                                            <span class="btn btn-lilac btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="pimg" value="" ></span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.form-body -->
                                        
                                        
                                        <div class="form-footer">
                                            <br /><br />
                                            <div>
                                                <button type="submit" class="btn btn-success">Create User</button>
                                            </div>
                                        </div><!-- /.form-footer -->
                                    </form>
                                    
                                    <script type="text/javascript">
									// DO NOT REMOVE : GLOBAL FUNCTIONS!
											
										$(document).ready(function() {
											pageSetUp();
											var $registerForm = $("#user-create-validation").validate({
										
											// Rules for form validation
											rules : {
												email : {
													required : true,
													email : true
												},
												password : {
													required : false,
													minlength : 3,
													maxlength : 20
												},
												passwordConfirm : {
													required : false,
													minlength : 3,
													maxlength : 20,
													equalTo : '#password'
												},
												firstname : {
													required : true
												},
												lastname : {
													required : true
												},
												user_group : {
													required : true
												}
											},
									
											// Messages for form validation
											messages : {
												email : {
													required : 'Please enter your email address',
													email : 'Please enter a VALID email address'
												},
												password : {
													required : 'Please enter your password'
												},
												passwordConfirm : {
													required : 'Please enter your password one more time',
													equalTo : 'Please enter the same password as above'
												},
												firstname : {
													required : 'Please select your first name'
												},
												lastname : {
													required : 'Please select your last name'
												},
												user_group : {
													required : 'Please select your user group'
												}
											},
									
											// Do not change code below
											errorPlacement : function(error, element) {
												error.insertAfter(element.parent());
											}
										});
									});
									</script>
    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->

                </div>