                                <div class="body-content animated fadeIn">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="mini-stat-type-2 shadow border-success">
                                                        <h3 class="text-center text-thin">Total Order</h3>
                                                        <p class="text-center">
                                                            <span class="overview-icon bg-success"><i class="icon-arrow-down"></i></span>
                                                        </p>

                                                        <h3 class="text-center text-thin">
                                                            <b><span class="counter"><?php echo number_format(count($total_order), 0);?></span></b> 
                                                        </h3>
                                                        <p class="text-center text-thin">
                                                            Last Month
                                                        </p>
                                                    </div>
                                                </div>

                                                
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <div class="mini-stat-type-2 shadow border-primary">
                                                            <h3 class="text-center text-thin">Total Amount</h3>
                                                            <p class="text-center">
                                                                <span class="overview-icon bg-primary"><i class="icon-arrow-up"></i></span>
                                                            </p>
                                                                    <?php
                                                                                                                    //calculating amount accross board
                                                                                                                        $amount = 0;
                                                                                                                        if (count($total_amount) > 0) {
                                                                                                                            foreach ($total_amount as $total_amount) {
                                                                                                                                $amount += $total_amount['transaction_amount'];
                                                                                                                            }
                                                                                                                        }
                                                                                                                    ?>
                                                            <h3 class="text-center text-thin">
                                                                <b>₦<span class="counter"><?php echo number_format($amount, 0);?></span></b> 
                                                            </h3>
                                                            <p class="text-center text-thin">
                                                                Last Month
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="mini-stat-type-2 shadow border-success">
                                                            <h3 class="text-center text-thin">VAT (5%)</h3>
                                                            <p class="text-center">
                                                                <span class="overview-icon bg-success"><i class="icon-arrow-down"></i></span>
                                                            </p>
                                                            <?php
                                                            //calculating output vat accross board
                                                                $output_vats = 0;
                                                                if (count($output_vat) > 0) {
                                                                    foreach ($output_vat as $output_vat) {
                                                                        $output_vats += $output_vat['output_vat'];
                                                                    }
                                                                }
                                                            ?>
                                                            <h3 class="text-center text-thin">
                                                                <b>₦<span class="counter"><?php echo number_format($output_vats, 0);?></span></b> 
                                                            </h3>
                                                            <p class="text-center text-thin">
                                                                Last Month
                                                            </p>
                                                        </div>
                                                    </div>
               

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title text-left">Ecommerce Last 5 Closed Transactions</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-no-border table-middle table-primary">
                                                                <thead>
                                                                    <tr>
                                                                        <th data-hide="phone">ECOMMERCE NAME</th>
                                                                        <th data-hide="phone">ORDER ID</th>
                                                                        <th data-hide="phone">ORDER AMOUNT</th>
                                                                        <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                                        <th data-hide="phone,tablet">QUANTITY</th>
                                                                        <th data-hide="phone,tablet">VAT DEDUCTED</th>
                                                                        <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                                    </tr>
                                                                </thead>
                                                                <!--tbody section is required-->
                                                                <tbody>
                                                                    <?php foreach($orders as $initiatedOrders){ 
                                                                        ?>
                                                                    <tr class="border-warning">
                                                                        <td>
                                                                            <b><?php echo ucwords($initiatedOrders['ecommerce_name']); ?></b>
                                                                        </td>
                                                                        <td>
                                                                            <b><?php echo $initiatedOrders['Order_Id']; ?></b>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo number_format($initiatedOrders['Order_date'], 2) ; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $initiatedOrders['Payment_Date']; ?>
                                                                        </td>

                                                                        <td>
                                                                            <?php echo $initiatedOrders['Quantity']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo number_format($initiatedOrders['Output_VAT'], 2); ?>
                                                                        </td>
                                                                        <td class="text-center">

                                                                            <?php if($initiatedOrders['Order_Status']== 1 ){ ?>
                                                                            <span class="label label-success"><?php echo 'Closed'; ?></span>
                                                                            <?php } else { ?>
                                                                            <span class="label label-warning"><?php echo 'Open'; ?></span>
                                                                            <?php } ?>
                                                                        </td>

                                                                        <?php } ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>

                                </div>