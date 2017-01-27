				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Vendor Orders</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">VENDOR NAME</th>
                                                <th data-class="expand">ORDER ID</th>
                                                <th data-hide="phone">ORDER AMOUNT</th>
                                                <th data-hide="phone">VAT DEDUCTED</th>
                                                <th data-hide="phone">QUANTITY</th>
                                                <th data-hide="phone">PURCHASE PRICE</th>
                                                <th data-hide="phone">PAYMENT TYPE</th>
                                                <th data-hide="phone,tablet">SELLING PRICE</th>
                                                <th data-hide="phone,tablet">PRODUCT DESC</th>
                                                <th data-hide="phone,tablet">PRODUCT CATEGORY</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($reports as $report){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo ucwords($report['vendor_name']); ?></b>
                                                </td>
                                                <td>
                                                    <b><?php echo ucwords($report['Order_Id']); ?></b>
                                                </td>
                                                <td class="text-center">
                                                    ₦ <?php echo number_format($report['Order_Amount'], 0); ?>
                                                </td>
                                                <td class="text-center">
                                                    ₦ <?php echo number_format($report['Output_VAT'], 0); ?>
                                                </td>
                                                <td>
                                                    <?php echo $report['Quantity']; ?>
                                                </td>
                                                <td class="text-center">
                                                    ₦ <?php echo number_format($report['Purchase_Price'], 0); ?>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($report['Payment_Type']); ?>
                                                </td>
                                                <td class="text-center">
                                                    ₦ <?php echo number_format($report['sell_price'], 0); ?>
                                                </td>
                                                <td>
                                                    <?php echo $report['Product_Description']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $report['Product_Category']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($report['Order_Status'] == 1 ){ ?>
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
                                            <th data-class="expand">VENDOR NAME</th>
                                            <th data-class="expand">ORDER ID</th>
                                            <th data-hide="phone">ORDER AMOUNT</th>
                                            <th data-hide="phone">VAT DEDUCTED</th>
                                            <th data-hide="phone">QUANTITY</th>
                                            <th data-hide="phone">PURCHASE PRICE</th>
                                            <th data-hide="phone">PAYMENT TYPE</th>
                                            <th data-hide="phone,tablet">SELLING PRICE</th>
                                            <th data-hide="phone,tablet">PRODUCT DESC</th>
                                            <th data-hide="phone,tablet">PRODUCT CATEGORY</th>
                                            <th data-hide="phone,tablet" class="text-center">STATUS</th>
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