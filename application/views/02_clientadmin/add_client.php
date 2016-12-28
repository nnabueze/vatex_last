

				<div class="body-content animated fadeIn">
				    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Create New Client Form</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                	
                                    <!--<form id="smart-form-register"  class="form-horizontal form-bordered" role="form">-->
                                    <form id="client-create-validation" name="smart-form-register" class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('clientadmin/create_new');?>" enctype="multipart/form-data" role="form">
                                    <input type="hidden" name="user" value="1">
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
											<strong>Successful!</strong> '.$this->session->flashdata('success').'
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
                                                    <label class="col-sm-4 control-label">Company Name <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Client Company Name" name="client_name"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Client Identifier <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Client Identifier" name="unique_identifier"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Line of Business <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Line of Client Business" name="business_type"/>
                                                    </div>
                                                </div>
                                            </div>
                                        	
                                            <div class="col-lg-5 col-md-5 col-sm-12"> 
                                                <div class="form-group form-group-divider">
                                                    <div class="form-inner">
                                                        <h5 class="no-margin">Contact Information</h5>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Prime Contact <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Prime Contact on Tax Matters" name="contact_name"/>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Email Address <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Email Address" name="contact_email"/>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Phone Number <span class="asterisk">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" placeholder="Phone Number" name="contact_phone"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        	<div class="col-lg-2 col-md-2 col-sm-12"> 
                                                <div class="form-group form-group-divider">
                                                    <div class="form-inner">
                                                        <h5 class="no-margin">Client Image</h5>
                                                    </div>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                	
                                                    <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">
        											<link href="<?php echo base_url('assets/_main/global/plugins/bower_components/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css');?>" rel="stylesheet">
                                                    
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                            <img data-src="holder.js/100%x100%/blankon/text:Fluid image" alt="...">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="max-width: 150px; max-height: 150px;"></div>
                                                        <div>
                                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="pimg" value="" ></span>
                                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.form-body -->
                                        
                                        
                                        <div class="form-footer">
                                            <br /><br />
                                            <div>
                                                <button type="submit" class="btn btn-success">Create Client</button>
                                            </div>
                                        </div><!-- /.form-footer -->
                                    </form>
    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.row -->

                </div>