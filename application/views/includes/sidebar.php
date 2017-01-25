<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$uri_segment_1 = $this->uri->segment(1);
//$uri_segment_2 = $this->uri->segment(2);
//$uri_segment_3 = $this->uri->segment(3);

?>

            <aside id="sidebar-left" class="sidebar-circle sidebar-primary">
                    <?php 
                        $userid = $this->session->userdata('user_id');
                        $userdt = $this->user_model->user_detail($userid);
                        
                        $usergroupid = $userdt[0]->user_group_id;
                        CI()->load->model('user_group_model');
                        $permissiondata = CI()->user_group_model->user_group_permissions_detail($usergroupid);
                        $perm= array();
                        foreach($permissiondata as $usp){
                            $perm[] = $usp->user_permissions;
                        }
                    ?>
                
                <div class="sidebar-content">
                    <div class="media">
                        <a class="pull-left has-notif avatar" href="<?php echo site_url('profile');?>">
                        
                                                    <?php
                                                    if (empty($userdt[0]->profile_img)) {
                                                    ?>
                                                        <img src="<?php echo base_url('uploads/user_img/images.jpg');?>?create=50x50,4888E1?f=ffffff" alt="admin">
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <!-- <img src="<?php echo base_url('uploads/user_img/'.$userdt[0]->profile_img);?>?create=50x50,4888E1?f=ffffff" alt="admin"> -->
                                                    <img src="<?php echo base_url('uploads/user_img/images.jpg');?>?create=50x50,4888E1?f=ffffff" alt="admin">
                                                    <?php } ?>
                            <i class="online"></i>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><span><strong><?php echo $userdt[0]->username; ?></strong></span></h4>
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
                </div>
                
                <ul class="sidebar-menu">
                    <li class="<?php if(strtolower($uri_segment_2)=='dashboard') { echo 'active'; }  ?>">
                        <a href="<?php echo site_url('dashboard');?>" title="Dashboard">
                            <span class="icon"><i class="fa fa-home"></i></span>
                            <span class="text">Dashboard</span>
                            <?php if(strtolower($uri_segment_2)=='dashboard') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                    </li>

                    <li class="submenu <?php if(strtolower($uri_segment_2)=='clientadmin') { echo 'active'; }  ?>">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-users"></i></span>
                            <span class="text">Client Management </span>
                            <span class="arrow"></span>
                            <?php if(strtolower($uri_segment_2)=='clientadmin') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                        <ul>
                            <li class="<?php if(strtolower($uri_segment_3)=='clientlisting') { echo 'active'; }  ?>">
                                <a href="<?php echo site_url('clientadmin/listing');?>" title="Client Listing">Client Listing</a>
                            </li>
                            
                            <li class="<?php if(strtolower($uri_segment_3)=='clientadd') { echo 'active'; }  ?>">
                                <a href="<?php echo site_url('clientadmin/create_new');?>" title="Create New Client">Create New Client</a>
                            </li>
                            
                            <!--<li class="<?php if(strtolower($uri_segment_3)=='clientactivation') { echo 'active'; }  ?>">
                                <a href="<?php echo site_url('clientadmin/activation_deactivation');?>" title="Activate/Deactivate">Activate/Deactivate</a>
                            </li>-->
                            
                         <!--    <li class="<?php //if(strtolower($uri_segment_3)=='client_fundssweep_settings') { echo 'active'; }  ?>">
                                <a href="<?php //echo site_url('clientadmin/fundsweep_config');?>" title="Funds Sweep Settings">Funds Sweeping Config</a>
                            </li> -->
                        </ul>
                    </li>

                    <li class="submenu <?php if(strtolower($uri_segment_2)=='transaction') { echo 'active'; }  ?>">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-table"></i></span>
                            <span class="text">Transaction Mgt. </span>
                            <span class="arrow"></span>
                            <?php if(strtolower($uri_segment_2)=='transaction') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                        <ul>
                            <li class="<?php if(strtolower($uri_segment_3)=='current_transaction') { echo 'active'; }  ?>"><a href="<?php echo site_url('transaction/current_transaction');?>" title="">Current Transactions</a></li>
                            <li class="<?php if(strtolower($uri_segment_3)=='initiated_orders') { echo 'active'; }  ?>"><a href="<?php echo site_url('transaction/initiated_orders');?>" title="">Initiated Orders</a></li>
                            <li class="<?php if(strtolower($uri_segment_3)=='closed_orders') { echo 'active'; }  ?>"><a href="<?php echo site_url('transaction/closed_orders');?>" title="">Successful/Closed Orders</a></li>
                        </ul>
                    </li>

                    <li class="<?php if(strtolower($uri_segment_2)=='reports') { echo 'active'; }  ?>">
                        <a href="<?php echo site_url('reports');?>" title="">
                            <span class="icon"><i class="fa fa-signal"></i></span>
                            <span class="text">Reports & Analytics </span>
                            <?php if(strtolower($uri_segment_2)=='reports') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                    </li>

                    <li class="submenu <?php if(strtolower($uri_segment_2)=='users') { echo 'active'; }  ?>">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-users"></i></span>
                            <span class="text">User Administration </span>
                            <span class="arrow"></span>
                            <?php if(strtolower($uri_segment_2)=='users') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                        <ul>
                            <li class="<?php if(strtolower($uri_segment_3)=='userlisting') { echo 'active'; }  ?>"><a href="<?php echo site_url('users/listing');?>" title="">List Users</a></li>
                            <li class="<?php if(strtolower($uri_segment_3)=='newuser') { echo 'active'; }  ?>"><a href="<?php echo site_url('users/newuser');?>" title="">Create New User</a></li>
                            <li class="<?php if(strtolower($uri_segment_3)=='privileges') { echo 'active'; }  ?>"><a href="<?php echo site_url('users/privileges');?>" title="">Usergroups/Privileges</a></li>
                            <!--<li class="<?php if(strtolower($uri_segment_3)=='resetuser') { echo 'active'; }  ?>"><a href="<?php echo site_url('users/passwordreset');?>" title="">Reset User Password</a></li>-->
                        </ul>
                    </li>
<!-- 
                    <li class="<?php if(strtolower($uri_segment_2)=='efiling') { echo 'active'; }  ?>">
                        <a href="<?php echo site_url('transaction/efiling');?>" title="efiling">
                            <span class="icon"><i class="fa fa-home"></i></span>
                            <span class="text">Efiling</span>
                            <?php if(strtolower($uri_segment_2)=='efiling') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                    </li> -->

                    <li class="submenu <?php if(strtolower($uri_segment_2)=='profile') { echo 'active'; }  ?>">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-user"></i></span>
                            <span class="text">Profile Management</span>
                            <span class="arrow"></span>
                            <?php if(strtolower($uri_segment_2)=='profile') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                        <ul>
                            <li class="<?php if(strtolower($uri_segment_3)=='userprofile') { echo 'active'; }  ?>"><a href="<?php echo site_url('users/profile');?>" title="">My Profile</a></li>
                            <li class="<?php if(strtolower($uri_segment_3)=='editprofile') { echo 'active'; }  ?>"><a href="<?php echo site_url('users/editprofile');?>" title="">Edit Profile</a></li>
                        </ul>
                    </li>

                    <li class="submenu <?php if(strtolower($uri_segment_2)=='vatible') { echo 'active'; }  ?>">
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-cogs"></i></span>
                            <span class="text">Rules & Procedures </span>
                            <span class="arrow"></span>
                            <?php if(strtolower($uri_segment_2)=='vatible') { echo '<span class="selected"></span>'; }  ?>
                        </a>
                        <ul>
                            <li class="<?php if(strtolower($uri_segment_3)=='vatible') { echo 'active'; }  ?>"><a href="<?php echo site_url('vat/vatibles');?>" title="">Non-Vatibles</a></li>
                        </ul>
                    </li>

                    <li class="active">
                        <a href="<?php echo site_url('login/logout');?>" title="">
                            <span class="icon"><i class="fa fa-sign-out"></i></span>
                            <span class="text">Logout</span>
                        </a>
                    </li>

                </ul>
            </aside>


