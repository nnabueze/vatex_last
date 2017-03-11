				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Unremitted Initiated Orders</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">ORDER ID</th>
                                                <th data-hide="phone">VENDOR NAME</th>
                                                <th data-hide="phone">ORDER AMOUNT</th>
                                                <th data-hide="phone">TRANSACTION ID</th>
                                                <th data-hide="phone,tablet">SELLING PRICE</th>
                                                <th data-hide="phone,tablet">COST PRICE</th>
                                                <th data-hide="phone,tablet">ORDER DATE</th>
                                                <th data-hide="phone,tablet">SHIPPING FEE</th>
                                                <th data-hide="phone,tablet">ECOMMERCE_COMMISSION</th>
                                                <th data-hide="phone,tablet">WARRANTY</th>
                                                <th data-hide="phone,tablet">RETURN POLICY</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($initiated_orders as $initiated_orders){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo $initiated_orders->Order_Id; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($initiated_orders->vendor_name); ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->Order_Amount; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->Transaction_Id; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $initiated_orders->sell_price; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->cost_price; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->Order_date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->shipping_fee; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->commission; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->warranty_period; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->return_policy; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($initiated_orders->Order_Status == 1 ){ ?>
                                                    <span class="label label-success"><?php echo "Closed"; ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-warning"><?php echo "Open"; ?></span>
                                                    <?php } ?>
                                                </td>
                                             
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                            <tr>
                                                <th>ORDER ID</th>
                                                <th>VENDOR ID</th>
                                                <th>ORDER AMOUNT</th>
                                                <th>TRANSACTION ID</th>
                                                <th>SELLING PRICE</th>
                                                <th>COST PRICE</th>
                                                <th>ORDER DATE</th>
                                                <th data-hide="phone,tablet">SHIPPING FEE</th>
                                                <th data-hide="phone,tablet">ECOMMERCE_COMMISSION</th>
                                                <th data-hide="phone,tablet">WARRANTY</th>
                                                <th data-hide="phone,tablet">RETURN POLICY</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <!--/ End datatable -->
                                </div><!-- /.panel-body -->
                            </div><!-- /.panel -->
                            <!--/ End table advanced -->

                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->

                </div>