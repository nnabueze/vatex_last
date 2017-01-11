				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Vendor Closed Orders</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">Ecommerce Name</th>
                                                <th data-hide="phone">VENDOR ID</th>
                                                <th data-hide="phone">ORDER ID</th>
                                                <th data-hide="phone">ORDER AMOUNT</th>
                                                <th data-hide="phone">TRANSACTION ID</th>
                                                <th data-hide="phone,tablet">ORDER DATE</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php 
                                            foreach($vendors as $vendor){ 
                                                $data['ecommerce_id'] = $vendor['Ecommerce_Id'];
                                                $data['vandor_id'] = $vendor['Vendor_Id'];
                                                $trans = $this->transaction_model->vendor_closed_orders($data);

                                                foreach($trans as $initiated_orders){ 
                                                    ?>
                                                    <tr class="border-warning">
                                                        <td>
                                                            <b><?php echo $initiated_orders['ecommerce_name']; ?></b>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiated_orders['Vendor_Id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiated_orders['Order_Id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiated_orders['Order_Amount']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $initiated_orders['Transaction_Id']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $initiated_orders['Order_date']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if($initiated_orders['Order_Status'] == 1 ){ ?>
                                                            <span class="label label-success"><?php echo "Closed"; ?></span>
                                                            <?php } else { ?>
                                                            <span class="label label-warning"><?php echo "Open"; ?></span>
                                                            <?php } ?>
                                                        </td>

                                                    </tr>
                                                    <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                            <tr>
                                                <th>Ecommerce Name</th>
                                                <th>VENDOR ID</th>
                                                <th>ORDER ID</th>
                                                <th>ORDER AMOUNT</th>
                                                <th>TRANSACTION ID</th>
                                                <th>ORDER DATE</th>
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