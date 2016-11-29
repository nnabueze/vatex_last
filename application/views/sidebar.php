<?php 
						$userid = $this->session->userdata('user_id');
						$userdt = $this->user_model->user_detail($userid);
						//print_r($userdt);
						//exit;
						$usergroupid = $userdt[0]->user_group_id;
						CI()->load->model('user_group_model');
						$permissiondata = CI()->user_group_model->user_group_permissions_detail($usergroupid);
						//print_r($permissiondata);
						$perm= array();
						foreach($permissiondata as $usp){
							$perm[] = $usp->user_permissions;
						}
						?>
<aside id="sidebar-left" class="sidebar-circle sidebar-light">

                <!-- Start left navigation - profile shortcut -->
                <div class="sidebar-content">
                    <div class="media">
                        <a class="pull-left has-notif avatar" href="page-profile.html">
						
                            <img src="<?php echo site_url('uploads/'.$userdt[0]->profile_img);?>?create=50x50,4888E1?f=ffffff" alt="admin">
                            <i class="online"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Hello, <span><strong><?php echo $userdt[0]->username; ?></strong></span></h4>
                            <small>
							<?php if($userdt[0]->user_group_id==1){ ?>
							<strong>Super Administrator</strong>
							<?php } elseif($userdt[0]->user_group_id==2){ ?>
							<strong>Administrator</strong>
							<?php } elseif($userdt[0]->user_group_id==3){ ?>
							<strong>Ecommerce</strong>	
							<?php } else {
							echo "<strong>Vendor</strong>";
							}?>
							
							</small>
                        </div>
                    </div>
                </div><!-- /.sidebar-content -->
                <!--/ End left navigation -  profile shortcut -->

                <!-- Start left navigation - menu -->
                <ul class="sidebar-menu">

                    <!-- Start navigation - dashboard -->
                    <li class="submenu active">
                        <a href="<?php echo site_url('dashboard');?>">
                            <span class="icon"><i class="fa fa-home"></i></span>
                            <span class="text">Dashboard</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <!--/ End navigation - dashboard -->
					<?php 
					if($this->session->userdata('vendor_id')!=''){
					?>
						<li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-money"></i></span>
                            <span class="text">Transaction</span>
                            <span class="arrow"></span>
                        </a>
							 <ul>
								<li><a href="#">Initiated Orders</a></li>
								<li><a href="#">Closed Orders</a></li>
								<li><a href="#">Sales Report</a></li>
                            
							</ul>
						 </li>
						 <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <span class="text">Reports</span>
                            <span class="arrow"></span>
                        </a>
							 <ul>
								<li><a href="#">Vat Computed</a></li>
								<li><a href="#">Vat Deducted</a></li>
								<li><a href="#">VAT Remittance</a></li>
								<li><a href="#">Tin Status</a></li>
                            
							</ul>
						 </li>
						 <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-cogs"></i></span>
                            <span class="text">e-Filing</span>
                            <span class="arrow"></span>
                        </a>
							 
						 </li>
					<?php } else {
					?>

					<?php if($userdt[0]->user_group_id==1 || $userdt[0]->user_group_id==2){ ?>
                    <!-- Start navigation - client management -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-group"></i></span>
                            <span class="text">Client Management</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
                            <li><a href="<?php echo site_url('client/add_client/');?>">Create New Client</a></li>
                            <li><a href="<?php echo site_url('client');?>">Client Listing & Profile</a></li>
                            <li><a href="#">Setup & Configure</a></li>
                            <li><a href="#">Notification Settings</a></li>
                            <li><a href="#">Bank Details</a></li>
                        </ul>
                    </li>
                    <!--/ End navigation - client management -->
					<?php } ?>
					
					<!-- Start navigation - Transactions -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-money"></i></span>
                            <span class="text">Transactions</span>
                            <span class="arrow"></span>
                        </a>
                            <ul>
                                <li ><a href="<?php echo site_url('transaction');?>">List of Orders</a></li>
                                <!-- <li><a href="fundssweep_completed.html">Completed Transaction</a></li> -->
    <!--                             <li><a href="fundssweep_reversal.html">Reversal</a></li>
                                <li><a href="fundssweep_invoicing.html">Invoicing</a></li> -->
                            </ul>
                    </li>
                    <!--/ End navigation - Transactions -->

                    <!-- Start navigation - funds sweep -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-money"></i></span>
                            <span class="text">Funds Sweep</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
                            <li><a href="<?php echo site_url('vatonhold');?>">Computed VAT</a></li>
                           <!-- <li><a href="<?php echo site_url('instantiatesweep');?>">Instantiate Sweep</a></li> -->
                            <li><a href="<?php echo site_url('pendingtransaction');?>">Deducted VAT</a></li>
                            <li><a href="<?php echo site_url('completetransaction');?>">Remitted VAT</a></li>
							<li><a href="<?php echo site_url('failedtransaction');?>">VAT Remittance Erroe</a></li>
                            <!--<li><a href="<?php echo site_url('reversal');?>">Reversal</a></li>
                            <li><a href="<?php echo site_url('vatonhold');?>">Invoicing</a></li>-->
                        </ul>
                    </li>
                    <!--/ End navigation - funds sweep -->

                    <!-- Start navigation - reporting -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <span class="text">Reporting</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
                            <!--<li><a href="reporting_records.html">Data Records</a></li>-->
                            <li><a href="<?php echo site_url('analytics')?>">Data Analytics</a></li>
                        </ul>
                    </li>
                    <!--/ End navigation - reporting -->

                    <!-- Start navigation - messaging centre -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-envelope"></i></span>
                            <span class="text">Message Centre</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
                            <li><a href="<?php echo site_url('tickets');?>">Tickets & Customer Support</a></li>
                            <li><a href="<?php echo site_url('tickets/new_tickets/');?>">Add Ticket</a></li>
                        </ul>
                    </li>
                    <!--/ End navigation - messaging centre -->

                    <!-- Start navigation - settings -->
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-cogs"></i></span>
                            <span class="text">Settings</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
						<?php if($userdt[0]->user_group_id==1 || $userdt[0]->user_group_id==2){ ?>
                            <li class="submenu">
                                <a href="#">User Administration <span class="arrow"></span></a>
                                <ul>
                                    <li><a href="<?php echo site_url('admin/');?>">User Listing</a></li>
                                    <li><a href="<?php echo site_url('admin/add_admin/');?>">Create User</a></li>
                                </ul>
                            </li>
						<?php } ?>
                            <li><a href="<?php echo site_url('profile_management');?>">Profile Management</a></li>
                            <?php if($userdt[0]->user_group_id==3){ ?>
							<li><a href="<?php echo site_url('client/settings');?>">Settings</a></li>
							<?php } ?>
                        </ul>
                    </li>
                    <!--/ End navigation - settings -->
                    <!-- Start navigation - vendors -->
					<?php if($userdt[0]->user_group_id==3){ ?>
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <span class="text">Vendors</span>
                            <span class="arrow"></span>
                        </a>
                        <ul>
                            <!--<li><a href="<?php echo site_url('vendor/add_vendor');?>">Create New Vendor</a></li>-->
                            <li><a href="<?php echo site_url('vendor/vendor_listing');?>">Vendor Listing & Profile</a></li>
                        </ul>
                    </li>
                    <!--/ End navigation - reporting -->
					<?php } } ?>
                    <!-- Start navigation - logout -->
                    <li>
                        <a href="<?php echo site_url('login/logout');?>" >
                            <span class="icon"><i class="fa fa-sign-out"></i></span>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                    <!--/ End navigation - logout -->

                </ul><!-- /.sidebar-menu -->
                <!--/ End left navigation - menu -->

            </aside><!-- /#sidebar-left -->
            <!--/ END SIDEBAR LEFT -->