				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Vendor Efiling Page</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">

                                <?php 
                                if($this->session->flashdata('error')!=''){
                                    echo 
                                    '<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>Failure!</strong> '.$this->session->flashdata('error').'
                                    </div>';
                            
                                }
                                if($this->session->flashdata('success')!=''){
                                    echo 
                                    '<div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>Successful!</strong> '.$this->session->flashdata('success').'
                                    </div>';
                                }
                                ?>
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">ECOMMERCE ID</th>
                                                <th data-hide="phone">TRANSACTION ID</th>
                                                <th data-hide="phone">VENDOR ID</th>
                                                <th data-hide="phone">ORDER ID</th>
                                                <th data-hide="phone,tablet">ORDER AMOUNT</th>
                                                <th data-hide="phone,tablet">QUANTITY</th>
                                                <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                <th data-hide="phone,tablet">FILE VAT</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($vendor_orders as $vendor_orders){
                                                $name = $this->reports_model->ecommerce($vendor_orders['Ecommerce_Id']);
                                             ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo $name; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $vendor_orders['Transaction_Id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $vendor_orders['Vendor_Id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $vendor_orders['Order_Id']; ?>
                                                </td>
                                                
                                                <td>
                                                    <?php echo $vendor_orders['Order_Amount']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $vendor_orders['Quantity']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $vendor_orders['Payment_Date']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($vendor_orders['Order_Status'] == 1 ){ ?>
                                                    <span class="label label-success"><?php echo "Closed"; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                <a href="<?php echo site_url('transaction/order_details/'.$vendor_orders['id']);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                           
                                                </td>
                                             
                                            </tr>
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
                                                <th>QUANTITY</th>
                                                <th>PAYMENT DATE</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                <th>FILE VAT</th>
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