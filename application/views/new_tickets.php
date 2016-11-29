<?php
include('header.php');
include('sidebar.php');
?>
<section id="page-content">	
	<!-- Start page header -->
	<div class="header-content">
		<h2><i class="fa fa-group"></i> Issue Tracker <span>Save your team lots of time on issue tracking</span></h2>
		<div class="breadcrumb-wrapper hidden-xs">
			<span class="label">You are here:</span>
			<ol class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="dashboard.html">Dashboard</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Pages</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="active">Issue Tracker</li>
			</ol>
		</div><!-- /.breadcrumb-wrapper -->
	</div><!-- /.header-content -->
	<!--/ End page header -->
	<div class="body-content animated fadeIn">
		<div class="row">
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<h1 class="page-title txt-color-blueDark">					
					<!-- PAGE HEADER -->
					<i class="fa-fw fa fa-pencil-square-o"></i>Support Message
					<span>> New Ticket</span>
				</h1>
			</div>
		</div>


		<!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                        	<div class="panel rounded shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Create New Support Ticket</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body no-padding">
                                    
                                        <div class="form-body">
                                        <form id="smart-form-register" name="smart-form-register" class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('client/add_client');?>" enctype="multipart/form-data">
					
										
							<?php if($this->session->flashdata('error')!=''){
								echo '<div><p style="color:red;">'.$this->session->flashdata('error').'</p></div>';								
							}
							if($this->session->flashdata('success')!=''){
								echo '<div><p style="color:green;">'.$this->session->flashdata('success').'</p></div>';
							}
							?>

							<div class="form-group">
                                 <label class="col-sm-3 control-label">First Name</label>
									<div class="col-md-6">
										<input type="text" name="firstname" placeholder="First name">
									</div>
							</div>
								
								
								<div class="form-group">
                                 <label class="col-sm-3 control-label">Last Name</label>
									<div class="col-md-6">
										<input type="text" name="lastname" placeholder="Last name">
									</div>
								</div>
														
								<div class="form-group">
                                 <label class="col-sm-3 control-label">Email Address</label>
									<div class="col-md-6">
									 	<input type="email" name="email" placeholder="Email address">
									</div>
								</div>
								<div class="form-group">
                                 <label class="col-sm-3 control-label">Mobile no.</label>
									<div class="col-md-6">
										<input type="text" name="mobile" placeholder="Mobile No.">
									</div>
								</div>
							
							<div class="row">
								<section class="col col-6">
									<label class="label">Issue Title</label>
									<div class="col-md-6">
									 <i class="icon-append fa fa-envelope-o"></i>
									<input type="text" name="issue_title" placeholder="Issue Title">
									<b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
								</section>
								<section class="col col-6">
									<label class="label">Issue Description</label>
									<div class="col-md-6">
									
										<textarea class="custom-scroll" rows="2" cols="73" name="issue_desc" placeholder="
										Issue Description">
										</textarea>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="label">Choose Biller</label>
									<label class="select"><select name="biller_id">
											<option value="0" selected="" disabled="">Choose Biller</option>
											<?php $biller = $this->biller_model->approved_biller_listing();
											foreach($biller as $billerlst){
											?>
											<option value="<?php echo $billerlst->id;?>"><?php echo $billerlst->company_name;?></option>
											<?php }?>
										</select> 
									</label>
								</section>
							</div>
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Create Ticket
							</button>
						</footer>
					
							</form>
										 </div>   
								</div>
							</div>
						</div>
					</div>



		<!-- Widget ID (each widget will need unique ID)-->
		<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
			<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">				
				data-widget-colorbutton="false"	
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true" 
				data-widget-sortable="false"
				
			-->
			<header>
				<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
				<h2>New Ticket form </h2>				
			</header>
			<!-- widget div-->
			<div>
				
				<!-- widget edit box -->
				<div class="jarviswidget-editbox">
					<!-- This area used as dropdown edit box -->
					
				</div>
				<!-- end widget edit box -->
				
				<!-- widget content -->
				<div class="widget-body no-padding">					
					<form id="smart-form-register" class="smart-form" method="post" action ="<?php echo site_url('tickets/new_tickets');?>">
						<header>New Ticket Form</header>						
							<?php if($this->session->flashdata('error')!=''){
								echo '<section><p style="color:red;">'.$this->session->flashdata('error').'</p></section>';
							}?>
						<fieldset>
							
							<div class="row">
								<section class="col col-6">
									<label class="label">First Name</label>
									<div class="col-md-6">
									<i class="icon-append fa fa-user"></i>
										<input type="text" name="firstname" placeholder="First name"><b class="tooltip tooltip-bottom-right">Please enter your first name</b>
									</label>
								</section>
								<section class="col col-6">
									<label class="label">Last Name</label>
									<div class="col-md-6">
									<i class="icon-append fa fa-user"></i>
										<input type="text" name="lastname" placeholder="Last name"><b class="tooltip tooltip-bottom-right">Please enter your last name</b>
									</label>
								</section>
							</div>							
							<div class="row">
								<section class="col col-6">
									<label class="label">Email Address</label>
									<div class="col-md-6">
									 <i class="icon-append fa fa-envelope-o"></i>
									<input type="email" name="email" placeholder="Email address">
									<b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
								</section>
								<section class="col col-6">
									<label class="label">Mobile no.</label>
									<div class="col-md-6">
									<i class="icon-append fa fa-mobile"></i>
										<input type="text" name="mobile" placeholder="Mobile No."><b class="tooltip tooltip-bottom-right">Please enter your mobile number</b>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="label">Issue Title</label>
									<div class="col-md-6">
									 <i class="icon-append fa fa-envelope-o"></i>
									<input type="text" name="issue_title" placeholder="Issue Title">
									<b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
								</section>
								<section class="col col-6">
									<label class="label">Issue Description</label>
									<div class="col-md-6">
									
										<textarea class="custom-scroll" rows="2" cols="73" name="issue_desc" placeholder="
										Issue Description">
										</textarea>
									</label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="label">Choose Biller</label>
									<label class="select"><select name="biller_id">
											<option value="0" selected="" disabled="">Choose Biller</option>
											<?php $biller = $this->biller_model->approved_biller_listing();
											foreach($biller as $billerlst){
											?>
											<option value="<?php echo $billerlst->id;?>"><?php echo $billerlst->company_name;?></option>
											<?php }?>
										</select> 
									</label>
								</section>
							</div>
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Create Ticket
							</button>
						</footer>
					</form>		
					
				</div>
				<!-- end widget content -->				
			</div>
			<!-- end widget div -->			
		</div>
		<!-- end widget -->
	</div>
</section>
<style>
.error{color:red;}
</style>
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js');?>"></script>
<script type="text/javascript">
// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
	$(document).ready(function() {
		pageSetUp();
		var $registerForm = $("#smart-form-register").validate({
	
		// Rules for form validation
		rules : {
			email : {
				required : true,
				email : true
			},
			firstname : {
				required : true
			},
			lastname : {
				required : true
			},
			mobile : {
				required : true
			},
			issue_title : {
				required : true
			},
			issue_desc : {
				required : true
			},
			biller_id: {
				required : true
			}
		},

		// Messages for form validation
		messages : {
			email : {
				required : 'Please enter your email address',
				email : 'Please enter a VALID email address'
			},			
			firstname : {
				required : 'Please enter your first name'
			},
			lastname : {
				required : 'Please enter your last name'
			},
			mobile : {
				required : 'Please enter your mobile no.'
			},
			issue_title : {
				required : 'Please enter the issue title'
			},
			issue_desc :{
				required : 'Please enter the issue description'			
			},
			biller_id: {
				required : 'Please select the biller'
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});
});
</script>
<?php include('footer.php');?>		