                <div class="body-content animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Successful/Closed Orders</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">ECOMMERCE NAME</th>
                                                <th data-hide="phone">TRANSACTION ID</th>
                                                <th data-hide="phone">VENDOR NAME</th>
                                                <th data-hide="phone">ORDER ID</th>
                                                <th data-hide="phone,tablet">ORDER AMOUNT</th>
                                                <th data-hide="phone,tablet">VAT DEDUCTED</th>
                                                <th data-hide="phone,tablet">QUANTITY</th>
                                                <th data-hide="phone,tablet">PAYMENT TYPE</th>
                                                <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                <th data-hide="phone,tablet">PRODUCT DESC</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($initiated_orders as $initiatedOrders){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo ucwords($initiatedOrders->ecommerce_name); ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->Transaction_Id; ?>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($initiatedOrders->vendor_name); ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->Order_Id; ?>
                                                </td>

                                                <td class="text-center">
                                                    ₦ <?php echo number_format($initiatedOrders->Order_Amount, 0); ?>
                                                </td>
                                                <td class="text-center">
                                                    ₦ <?php echo number_format($initiatedOrders->Output_VAT, 0); ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->Quantity; ?>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($initiatedOrders->Payment_Type); ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->Payment_Date; ?>
                                                </td>
                                                <td class="text-center">

                                                    <?php if($initiatedOrders->Order_Status== 1 ){ ?>
                                                    <span class="label label-success"><?php echo 'Closed'; ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-warning"><?php echo 'Open'; ?></span>
                                                    <?php } ?>
                                                </td>
                                               <!--  <td class="text-center">
                                                    <a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                                </td> -->
                                                <td>
                                                    <?php echo ucwords($initiatedOrders->Product_Description); ?>
                                                </td>

                                                <?php } ?>

                                            </tbody>
                                            <!--tfoot section is optional-->
                                            <tfoot>
                                                <tr>
                                                    <th>ECOMMERCE ID</th>
                                                    <th>TRANSACTION ID</th>
                                                    <th>VENDOR ID</th>
                                                    <th>ORDER ID</th>
                                                    <th>ORDER AMOUNT</th>
                                                    <th data-hide="phone,tablet">VAT DEDUCTED</th>
                                                    <th>QUANTITY</th>
                                                    <th data-hide="phone,tablet">PAYMENT TYPE</th>
                                                    <th>PAYMENT DATE</th>
                                                    <th>STATUS</th>
                                                    <th data-hide="phone,tablet">PRODUCT DESC</th>
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