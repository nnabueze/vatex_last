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
                                                <th data-hide="phone">VENDOR ID</th>
                                                <th data-hide="phone">ORDER AMOUNT</th>
                                                <th data-hide="phone">TRANSACTION ID</th>
                                                <th data-hide="phone,tablet">SALES DATE</th>
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
                                                    <?php echo $initiated_orders->Vendor_Id; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->Order_Amount; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders->Transaction_Id; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $initiated_orders->sales_date; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($initiated_orders->Order_Status =="close" || $initiated_orders->Order_Status=="Close"){ ?>
                                                    <span class="label label-success"><?php echo $initiated_orders->Order_Status; ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-warning"><?php echo $initiated_orders->Order_Status; ?></span>
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
                                                <th>SALES DATE</th>
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