                <div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="col-md-3">
                                        <h3 class="panel-title">Last Month Transactions</h3>
                                    </div>
                                    <?php if(count($initiated_orders) > 0){?>
                                        <div class="col-md-3"><h3 class="panel-title">Period: <?php echo $period; ?></h3></div>
                                        <div class="col-md-3"><h3 class="panel-title">Current Date: <?php echo $current_date; ?></h3></div>
                                        <div class="col-md-3"><h3 class="panel-title">Sweeping Date: <?php echo $sweep_date; ?></div>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-hide="phone">TRANSACTION ID</th>
                                                <th data-hide="phone">TRANSACTION AMOUNT</th>
                                                <th data-hide="phone">TRANSACTION DATE</th>
                                                <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                <th data-hide="phone,tablet">NO OF ORDERS</th>
                                                <th data-hide="phone,tablet">VAT DEDUCTED</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                <th data-hide="phone,tablet" class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php 
                                                $total_amount = "";
                                                $total_vat = "";
                                            foreach($initiated_orders as $initiated_orders){
                                             ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <?php echo $initiated_orders['transaction_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders['transaction_amount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders['transaction_date']; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $initiated_orders['payment_date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders['no_of_orders']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $initiated_orders['vat_deducted']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($initiated_orders['status'] == 1 ){ ?>
                                                    <span class="label label-success"><?php echo "Closed"; ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-warning"><?php echo "Open"; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo site_url('transaction/current_order/'.$initiated_orders['transaction_id']);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                                </td>
                                             
                                            </tr>
                                            <?php 
                                                $total_amount += $initiated_orders['transaction_amount'];
                                                $total_vat += $initiated_orders['vat_deducted'];
                                            } ?>
                                        
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                            <tr>
                                            <?php if(count($initiated_orders) > 0){?>
                                            <th colspan="2">Total TransactionAmount:</th>
                                            <th colspan="2"><?php echo $total_amount; ?></th>
                                            
                                            <th colspan="2">Total VAT Amount</th>
                                            <th colspan="2"><?php echo $total_vat; ?></th>
                                            <?php }else{ ?>
                                            
                                            <th data-hide="phone">TRANSACTION ID</th>
                                            <th data-hide="phone">TRANSACTION AMOUNT</th>
                                            <th data-hide="phone">TRANSACTION DATE</th>
                                            <th data-hide="phone,tablet">PAYMENT DATE</th>
                                            <th data-hide="phone,tablet">NO OF ORDERS</th>
                                            <th data-hide="phone,tablet">VAT DEDUCTED</th>
                                            <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                            <th data-hide="phone,tablet" class="text-center">ACTION</th>
                                            <?php } ?>
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