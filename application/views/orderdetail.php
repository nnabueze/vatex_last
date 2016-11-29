<?php
include('header.php');
include('sidebar.php');

?>
<section id="page-content">
<!-- START @PAGE CONTENT -->
            <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <!-- Start grid option -->
                    <h4>Order Details</h4>
                   

                    <div class="row">
                        <div class="col-md-12">
                            <div class="callout callout-info mb-20">
                                <p>See complete details about an order.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!--<div class="table-responsive">-->                           
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th colspan="5">
										<a href="<?php echo site_url('transaction');?>">List of Orders</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th colspan="1">Order ID</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Order_Id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="1">Transaction ID</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Transaction_Id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Product Description</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Product_Description']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Product Category</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Product_Category']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Unit Price</th>
                                        <td colspan="2">₦<?php echo  $orderdetails[0]['Order_Amount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Quantity']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Purchase Price</th>
                                        <td colspan="4">₦<?php echo  $orderdetails[0]['Purchase_Price']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td colspan="2">₦<?php echo  $orderdetails[0]['Net_VAT']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ecommerce</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['ec_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Vendor</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Vendor_Id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Order_Status']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Order_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment Date</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Payment_Date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment Type</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['[Payment_Type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Date</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['Delivery_Date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Timestamp</th>
                                        <td colspan="2"><?php echo  $orderdetails[0]['adddate']; ?></td>
                                    </tr>						
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
		   
		   <div class="row">  
					&nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
		   </div>
                        </div>
                    </div><!-- /.row -->
                   
                <!--/ End body content -->
<?php include('footer.php');?>		
		<!-- START @PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/global/plugins/bower_components/datatables/js/datatables.responsive.js'); ?>"></script>
        <!--/ END PAGE LEVEL PLUGINS -->
        
        
        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('assets/main/assets/admin/js/apps.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/pages/blankon.table.js'); ?>"></script>
        <script src="<?php echo base_url('assets/main/assets/admin/js/demo.js'); ?>"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->
		