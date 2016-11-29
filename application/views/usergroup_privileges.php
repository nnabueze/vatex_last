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
			<li>Home></li><li>User Administration</li><li>User Group & Privileges</li>
		</ol>
	</div>
	<!-- END RIBBON -->
	<!-- MAIN CONTENT -->
	<div id="content" >
		<div class="row">	
			<h2 class="row-seperator-header"><i class="fa fa-th-list"></i> User Group & Privileges </h2>	
			<!-- NEW WIDGET START -->
			<article class="col-sm-12 col-md-12 col-lg-6">
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-greenDark" id="wid-id-2" data-widget-editbutton="false">
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
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>User Group Listing</h2>
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
							<div class="alert alert-info no-margin fade in">
							<?php if($this->session->flashdata('error')!=''){
								echo '<section><p style="color:red;">'.$this->session->flashdata('error').'</p></section>';								
							}
							if($this->session->flashdata('success')!=''){
								echo '<section><p style="color:green;">'.$this->session->flashdata('success').'</p></section>';
							}
							?>
							</div>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>User Group</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php $user_group = $this->user_group_model->user_group_list();
									$u =1;
									foreach($user_group as $ug){
									?>
										<tr>
											<td><?php echo $u;?>.</td>
											<td><?php echo $ug->user_group;?></td>
											<td><?php if($ug->status=='1'){
											echo "Enabled";
											}else{ echo "Disabled";}?></td>
											<td><a href="<?php echo site_url('usergroup_privileges/edit_usergroup_privileges/'.$ug->id);?>" title="Edit User Group" alt = "Edit User Group"><i class="fa fa-fw fa-edit text-muted hidden-md hidden-sm hidden-xs"></i></a>
											<a href="javascript: delete_user_privileges(<?php echo $ug->id; ?>)"title="Delete Usergroup privileges" alt = "Usergroup privileges"><i class="fa fa-fw  fa-close text-muted hidden-md hidden-sm hidden-xs"></i></a></td>
										</tr>
									<?php 
									$u++;
									}?>
									</tbody>
								</table>								
							</div>
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>
				<!-- end widget -->
			</article>
			<!-- WIDGET END -->
			<?php //echo  $this->uri->segment(2); // n=1 for controller, n=2 for method, et?>
			<!-- NEW WIDGET START -->
			<?php if($this->uri->segment(2) == ''){ ?>
			<article class="col-sm-12 col-md-12 col-lg-6">	
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-10" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
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
					<h2>New User group Form</h2>		
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
						<form id="add_usergroup" name="add_usergroup" class="smart-form" action="usergroup_privileges/add_usergroup" method="post">
							<header>User group Form</header>
							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="user_group" id="user_group" placeholder="User Group Name">
										<b class="tooltip tooltip-bottom-right">Please enter user group name</b>
									</label>
								</section>									
 							    <section>
								<label class="label">Status</label>
								<div class="row">
									<div class="col col-4">
										<label class="radio state-success" ><input type="radio" name="user_group_status" value="1" checked><i></i>Enable</label>
									</div>
									<div class="col col-4">
										<label class="radio state-success"><input type="radio" name="user_group_status" value="0"><i></i>Disable</label>
									</div>
								</div>
								</section>		
								<div class="widget-body no-padding">
								<div class="panel-group smart-accordion-default" id="accordion-2">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i>Biller Management</a></h4>
										</div>
										<div id="collapseTwo-1" class="panel-collapse collapse">
											<fieldset>
												<section>
													<div class="col col-6" style="    margin-top: -18px;">
													<label class="checkbox">
													<input type="checkbox" name="permissions[]" value="biller/add_biller">
													<i></i>Create New Biller</label>
													<label class="checkbox">
													<input type="checkbox" name="permissions[]" value="biller">
													<i></i>Approve New Biller</label>
													<label class="checkbox">
													<input type="checkbox" name="permissions[]" value="biller_administration">
													<i></i>Biller Configurations
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
														<input type="checkbox" name="permissions[]" value="usergroup_privileges">
														<i></i>User Group and Privileges
													</label>
													<label class="checkbox">
														<input type="checkbox" name="permissions[]" value="registration">
														<i></i>Create New User
													</label>
													<label class="checkbox">
														<input type="checkbox" name="permissions[]" value="users">
														<i></i>Edit User Account
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
														<input type="checkbox" name="permissions[]" value="profile_management">
														<i></i>Profile Management 
													</label>
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
														<input type="checkbox" name="permissions[]" value="tickets">
														<i></i>Tickets 
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
														<input type="checkbox" name="permissions[]" value="reports">
														<i></i>Reports
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
														<input type="checkbox" name="permissions[]" value="general_setting">
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
								<button type="submit" class="btn btn-primary">Add User Group</button>
							</footer>
						</form>						
					</div>
					<!-- end widget content -->					
				</div>
				<!-- end widget div -->				
				</div>
				<!-- end widget -->	
			</article>
			<!-- WIDGET END -->
			<?php }
			if($this->uri->segment(2) == 'edit_usergroup_privileges'){ ?>
			<article class="col-sm-12 col-md-12 col-lg-6">					
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-10" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
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
					<h2>Edit User group Form</h2>		
				</header>
				<!-- widget div-->
				<div>					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
					</div>
					<!-- end widget edit box -->					
					<!-- widget content -->
					<?php
					$uid = $this->uri->segment(3);
					?>
					<div class="widget-body no-padding">						
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
													<div class="col col-6" style="    margin-top: -18px;">
													<label class="checkbox">
													<input type="checkbox" name="permissions[]" value="biller/add_biller" <?php 
													if(in_array('biller/add_biller',$perm)){ echo "checked";}
													?>>
													<i></i>Create New Biller</label>
													<label class="checkbox">
													<input type="checkbox" name="permissions[]" value="biller" <?php 
													if(in_array('biller',$perm)){ echo "checked";}
													?>>
													<i></i>Approve New Biller</label>
													<label class="checkbox">
														<input type="checkbox" name="permissions[]" value="biller_administration" <?php 
													if(in_array('biller_administration',$perm)){ echo "checked";}
													?>>
														<i></i>Biller Configurations
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
														<i></i>Edit User Account
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
														<i></i>Tickets 
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
														<i></i>Reports
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
					<!-- end widget content -->					
				</div>
				<!-- end widget div -->				
				</div>
				<!-- end widget -->				
			</article>
			<!-- WIDGET END -->
			<?php } ?>			
		</div>	
	</div>
</div>
 <script type="text/javascript">
	function delete_user_privileges(uid)
	{
		if (confirm('Are You Sure to Delete this Record?')){
			window.location.href = 'usergroup_privileges/delete_usergroup_privileges/' + uid;
		}
	}
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
<?php include('footer_main.php');?>		