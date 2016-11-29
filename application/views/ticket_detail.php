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
			<li>Home></li><li>Support Center</li><li>Support Messaging</li>
		</ol>
	</div>
	<!-- END RIBBON -->
			<!-- widget div-->
	<div id="content">
		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-puzzle-piece"></i> Tickets <span>>
					Ticket Detail</span></h1>
			</div>
			<!-- end col -->
		</div>
		<!-- end row -->
		<!-- row -->
		<div class="row">
			<div class="col-sm-12">
				<div class="well">
					<table class="table table-striped table-forum">
						<thead>
							<tr>
								<th colspan="2"><a href="tickets"> Tickets </a> > <a href="tickets/tickets_detail/<?php echo $tcktdt[0]->id;?>">Tickets Detail </a> > <?php echo $tcktdt[0]->issue_title;?> </th>
							</tr>
						</thead>
						<tbody>
							<!-- Post -->
						<tr>
							<?php 
							$udt = $this->user_model->user_detail($tcktdt[0]->user_id);
							$bdt = $this->biller_model->biller_detail($tcktdt[0]->biller_id);
							if($tcktdt[0]->ticket_created_by =='1'){?>
								<td class="text-center" style="color:#3276b1;"><strong>
								<?php echo $udt[0]->first_name;?></strong></td>
							<?php }else{?>
							<td class="text-center" style="color:#3276b1;"><strong>
							<?php echo $bdt[0]->name;?></strong></td>						
							<?php }?>
							<td>on <em><?php echo date('M d, Y  g:i a',strtotime($tcktdt[0]->creation_date))?></em></td>
						</tr>
						<tr>
							<td class="text-center" style="width: 12%;">
							<div class="push-bit">
							<?php if($tcktdt[0]->ticket_created_by =='1'){?>
							 <img src="<?php echo site_url('uploads/'.$udt[0]->profile_img);?>" width="50" alt="avatar" class="online">
							<?php }else{?>
							<img src="<?php echo site_url('uploads/'.$bdt[0]->company_logo);?>" width="50" alt="avatar" class="online">
							<?php }?>
							</div></td>
							<td>
							<p><?php echo $tcktdt[0]->issue_detail;?></p></td>
						</tr>
							<!-- end Post -->						

							<!-- Post -->
						<?php
						if($tktrply!=''){
						foreach($tktrply as $reply){
						?>
						<tr>				
							<td class="text-center" style="color:#3276b1;"><strong>
							<?php if($reply->replied_by =='1'){
								$udt = $this->user_model->user_detail($tcktdt[0]->user_id);
								echo $udt[0]->first_name.' '.$udt[0]->last_name;
							}else{
								$udt = $this->biller_model->biller_detail($tcktdt[0]->biller_id);
								echo $udt[0]->name;
							}?>
							</td>
							<td>on <em><?php echo date('M d, Y  g:i a',strtotime($reply->date_added))?></em></td>
						</tr>
						<tr>
							<td class="text-center" style="width: 12%;">
							<div class="push-bit">
							 <?php if($reply->replied_by =='1'){
							 $reply_udt = $this->user_model->user_detail($reply->user_id);	if($reply_udt[0]->profile_img!= ''){						
							 ?>
								<img src="<?php echo site_url('uploads/'.$reply_udt[0]->profile_img);?>" width="50" alt="avatar" class="online">
							<?php }}else{
							$reply_udt = $this->biller_model->biller_detail($reply->biller_id);
							if($reply_udt[0]->company_logo!= ''){
							?>
							<img src="<?php echo site_url('uploads/'.$reply_udt[0]->company_logo);?>" width="50" alt="avatar" class="online">
							<?php
							}
							}?>
							</div></td>
							<td><div id="forumPost">
							<?php echo $reply->issue_details;?>							
							</div></td>
						</tr>
						<!-- end Post -->
						<?php }
							}
						?>
						<!-- end Post -->
							<form name="ticket_reply" method="post" action="<?php echo site_url("tickets/reply");?>">
							<tr>
								<td colspan="2" >
								<input type="hidden" name="tktid" value="<?php echo $tcktdt[0]->id;?>">
								<input type="hidden" name="userid" value="<?php echo $this->session->userdata('user_id');?>">
								<textarea cols="100" rows="5" class="custom-scroll" name="tckt_dt"></textarea></td>
							</tr>							
							<tr>
								<td colspan="2" align="middle">
								<?php
								$tkt_close = $this->tickets_model->closed_tickets($tcktdt[0]->id);
								if(sizeof($tkt_close)==0){
								?>
								<input type="submit" name="tkt_reply" value="Reply">
								<input type="submit" name="tkt_close" value="Close">
								<?php }else{?>
								<input type="submit" name="tkt_reopen" value="Re-open">
								<?php }?>
								<a href="<?php echo site_url('tickets');?>"><input type="button" name="tkt_cancel" value="Cancel"></a>
								</td>
							</tr>
							</form>
						</tbody>
					</table>
				</div>
				</div>

		</div>
		<!-- end row -->		
	</div>
	<!-- end widget div -->			
</div>

<?php include('footer_main.php');?>		