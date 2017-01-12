                                <div class="body-content animated fadeIn">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                                                            <b>₦<span class="counter"><?php echo $amount;?></span></b> 
                                                        </h3>
                                                        <p class="text-center text-thin">
                                                            Last Month
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                    <div class="mini-stat-type-2 shadow border-success">
                                                        <h3 class="text-center text-thin">OUTPUT VAT</h3>
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
                                                            <b>₦<span class="counter"><?php echo $output_vats;?></span></b> 
                                                        </h3>
                                                        <p class="text-center text-thin">
                                                            Last Month
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                        <div class="mini-stat-type-2 shadow border-primary">
                                                            <h3 class="text-center text-thin">INPUT VAT</h3>
                                                            <p class="text-center">
                                                                <span class="overview-icon bg-primary"><i class="icon-arrow-up"></i></span>
                                                            </p>
                                                            <?php
                                                            //calculating input vat accross board
                                                                $input_vats = 0;
                                                                if (count($input_vat) > 0) {
                                                                    foreach ($input_vat as $input_vat) {
                                                                        $input_vats += $input_vat['input_vat'];
                                                                    }
                                                                }
                                                            ?>
                                                            <h3 class="text-center text-thin">
                                                                <b>₦<span class="counter"><?php echo $input_vats;?></span></b> 
                                                            </h3>
                                                            <p class="text-center text-thin">
                                                                Last Month
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                        <div class="mini-stat-type-2 shadow border-success">
                                                            <h3 class="text-center text-thin">NET VAT</h3>
                                                            <p class="text-center">
                                                                <span class="overview-icon bg-success"><i class="icon-arrow-down"></i></span>
                                                            </p>
                                                            <?php
                                                            //calculating net vat accross board
                                                                $net_vats = 0;
                                                                if (count($total_amount) > 0) {
                                                                    foreach ($net_vat as $net_vat) {
                                                                        $net_vats += $net_vat['net_vat'];
                                                                    }
                                                                }
                                                            ?>
                                                            <h3 class="text-center text-thin">
                                                                <b>₦<span class="counter"><?php echo $net_vats;?></span></b> 
                                                            </h3>
                                                            <p class="text-center text-thin">
                                                                Last Month
                                                            </p>
                                                        </div>
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
                                                                        <th data-hide="phone">TRANSACTION ID</th>
                                                                        <th data-hide="phone">TRANSACTION AMOUNT</th>
                                                                        <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                                        <th data-hide="phone,tablet">NO OF ORDER</th>
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
                                                                            <b><?php echo $initiatedOrders['transaction_id']; ?></b>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $initiatedOrders['transaction_amount']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $initiatedOrders['payment_date']; ?>
                                                                        </td>

                                                                        <td>
                                                                            <?php echo $initiatedOrders['no_of_orders']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $initiatedOrders['vat_deducted']; ?>
                                                                        </td>
                                                                        <td class="text-center">

                                                                            <?php if($initiatedOrders['status']== 1 ){ ?>
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