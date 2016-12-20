				<div class="body-content animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="mini-stat-type-2 shadow border-danger">
                                        <h3 class="text-center text-thin">Daily</h3>
                                        <p class="text-center">
                                            <span class="overview-icon bg-danger"><i class="icon-arrow-down"></i></span>
                                        </p>
                                        <p>
                                            <b>$<span class="counter">2,452</span></b> <span class="fg-danger">-<span class="counter">35</span>%</span>
                                        </p>
                                        <p class="text-muted">
                                            Last Month: 124,342/422,421
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="mini-stat-type-2 shadow border-success">
                                        <h3 class="text-center text-thin">Weekly</h3>
                                        <p class="text-center">
                                            <span class="overview-icon bg-success"><i class="icon-arrow-up"></i></span>
                                        </p>
                                        <p>
                                            <b>$<span class="counter">7,321</span></b> <span class="fg-success">+<span class="counter">15</span>%</span>
                                        </p>
                                        <p class="text-muted">
                                            Last Month: 452,342/784,421
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title text-center">FIRS/NIBSS - <b>VAT Remittance Summary</b></h3>
                                        </div>
                                        <div class="panel-body no-padding">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <span class="pull-left text-capitalize">Estimated next VAT deductible</span>
                                                            <span class="pull-right text-strong fg-teals">N<span class="counter">12,456,230.45</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="pull-left text-capitalize">Count - Pending VAT input orders:</span>
                                                            <span class="pull-right text-strong fg-teals"><span class="counter">341</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="pull-left text-capitalize">Total Computed VAT Output:</span>
                                                            <span class="pull-right text-strong">N<span class="counter">0.00</span></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="pull-left text-capitalize">Total Computed VAT Output:</span>
                                                            <span class="pull-right text-strong">N<span class="counter">0.00</span></span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title text-left">Vendor-Last 5 closed orders</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-no-border table-middle table-primary">
                                                <thead>
                                                    <tr>
                                                        <th >ECOMMERCE ID</th>
                                                        <th data-hide="phone">TRANSACTION ID</th>
                                                        <th data-hide="phone">VENDOR ID</th>
                                                        <th data-hide="phone">ORDER ID</th>
                                                        <th data-hide="phone,tablet">ORDER AMOUNT</th>
                                                        <th data-hide="phone,tablet">QUANTITY</th>
                                                        <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                        <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                    </tr>
                                                </thead>
                                                <!--tbody section is required-->
                                                <tbody>
                                                    <?php foreach($orders as $initiatedOrders){ ?>
                                                    <tr class="border-warning">
                                                        <td>
                                                            <b><?php echo $initiatedOrders['Ecommerce_Id']; ?></b>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiatedOrders['Transaction_Id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiatedOrders['Vendor_Id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiatedOrders['Order_Id']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $initiatedOrders['Order_Amount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiatedOrders['Quantity']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiatedOrders['Payment_Date']; ?>
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