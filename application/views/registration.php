<?php
include('header_main.php');
include('sidebar.php');
?>
<div id="main" role="main">
	<!-- RIBBON -->
	<div id="ribbon">
		<span class="ribbon-button-alignment"> 
			<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
				<i class="fa fa-refresh"></i>
			</span> 
		</span>
		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<li>Home></li><li>User Administration</li><li>Create New User</li>
		</ol>
	</div>
	<!-- END RIBBON -->
	<div id="content">
		<div class="row">
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<h1 class="page-title txt-color-blueDark">					
					<!-- PAGE HEADER -->
					<i class="fa-fw fa fa-pencil-square-o"></i>Registration
					<span>> Create New User</span>
				</h1>
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
				<h2>Registration form </h2>				
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
					<form id="smart-form-register" class="smart-form" method="post" action ="<?php echo site_url('registration');?>">
						<header>Registration form</header>						
							<?php if($this->session->flashdata('error')!=''){
								echo '<section><p style="color:red;">'.$this->session->flashdata('error').'</p></section>';
							}?>
						<!--<fieldset>
							<section>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="text" name="username" placeholder="Username">
									<b class="tooltip tooltip-bottom-right">Needed to enter the website</b>
								</label>
							</section>
							<section>
								<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
									<input type="email" name="email" placeholder="Email address">
									<b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
							</section>

							<section>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password" placeholder="Password" id="password">
									<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
							</section>

							<section>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="passwordConfirm" placeholder="Confirm password">
									<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
							</section>
						</fieldset>-->

						<fieldset>
							<div class="row">
								<section class="col col-6">
									<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="text" name="username" placeholder="Username">
									<b class="tooltip tooltip-bottom-right">Needed to enter the website</b>
								</label>
								</section>
								<section class="col col-6">
									<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
									<input type="email" name="email" placeholder="Email address">
									<b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
								</section>
							</div>
							<div class="row">
								<section class="col col-6">
									<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password" placeholder="Password" id="password">
									<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
								</section>
								<section class="col col-6">
									<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="passwordConfirm" placeholder="Confirm password">
									<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
								</section>

							</div>
							<div class="row">
								<section class="col col-6">
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" name="firstname" placeholder="First name"><b class="tooltip tooltip-bottom-right">Please enter your first name</b>
									</label>
								</section>
								<section class="col col-6">
									<label class="input"><i class="icon-append fa fa-user"></i>
										<input type="text" name="lastname" placeholder="Last name"><b class="tooltip tooltip-bottom-right">Please enter your last name</b>
									</label>
								</section>
							</div>							
							<div class="row">
								<section class="col col-6">
									<label class="input"><i class="icon-append fa fa-mobile"></i>
										<input type="text" name="mobile" placeholder="Mobile No."><b class="tooltip tooltip-bottom-right">Please enter your mobile number</b>
									</label>
								</section>
								<section class="col col-6">
									<label class="select">
										<select name="user_group">
											<option value="0" selected="" disabled="">Select User Group</option>
											<?php $user_group = $this->user_model->user_group();
											foreach($user_group as $ug){
											?>
											<option value="<?php echo $ug->id;?>"><?php echo $ug->user_group;?></option>
											<?php }?>
										</select> <i></i> </label>
								</section>
							</div>
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Create User
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
</div>
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
			username : {
				required : true
			},
			email : {
				required : true,
				email : true
			},
			password : {
				required : true,
				minlength : 3,
				maxlength : 20
			},
			passwordConfirm : {
				required : true,
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
			mobile : {
				required : true
			},
			user_group : {
				required : true
			}
		},

		// Messages for form validation
		messages : {
			login : {
				required : 'Please enter your login'
			},
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
			mobile : {
				required : 'Please select your mobile no.'
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
<?php include('footer_main.php');?>		