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
                                                <th data-class="expand">Order Id</th>
                                                <th data-hide="phone">Vendor Id</th>
                                                <th data-hide="phone">Client Type</th>
                                                <th data-hide="phone">Vendor Id</th>
                                                <th data-hide="phone,tablet">Order_Amount</th>
                                                <th data-hide="phone,tablet" class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($initiated_orders as $initiatedOrders){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo $initiatedOrders->Order_Id; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->sales_date; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->Transaction_Id; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiatedOrders->Order_Amount; ?>
                                                </td>

                                                <td>
                                                    <?php echo $initiatedOrders->Net_VAT; ?>
                                                </td>
                                                <td class="text-center">

                                                <?php if($initiatedOrders->Order_Status=="closed" || $initiatedOrders->Order_Status=="Closed"){ ?>
                                                    <span class="label label-success"><?php echo $initiatedOrders->Order_Status; ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-warning"><?php echo $initiatedOrders->Order_Status; ?></span>
                                                    <?php } ?>
                                                </td>

                                                <?php } ?>

                                            </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                            <tr>
                                                <th>Client ID</th>
                                                <th>ECommerce Name</th>
                                                <th>Client Type</th>
                                                <th>ECommerce Contact</th>
                                                <th>Contact Phone Number</th>
                                                <th>Status</th>
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