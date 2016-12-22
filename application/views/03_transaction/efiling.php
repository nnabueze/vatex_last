				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Efiling Page</h3>
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
                                                <th data-hide="phone,tablet">QUANTITY</th>
                                                <th data-hide="phone,tablet">PAYMENT DATE</th>
                                                <th data-hide="phone,tablet">ORDER AMOUNT</th>
                                                <th data-hide="phone,tablet">INPUT VAT</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                <th data-hide="phone,tablet">ACTION</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($efilings as $efiling){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo $efiling['Ecommerce_Id']; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $efiling['Transaction_Id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $efiling['Vendor_Id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $efiling['Order_Id']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $efiling['Quantity']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $efiling['Payment_Date']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $efiling['Order_Amount']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $efiling['input_vat']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if($efiling['approve'] == 1 ){ ?>
                                                    <span class="label label-warning"><?php echo "Not Approved"; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                <a href="<?php echo site_url('transaction/efiling_details/'.$efiling['id']);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                           
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
                                                <th>QUANTITY</th>
                                                <th>PAYMENT DATE</th>
                                                <th>ORDER AMOUNT</th>
                                                <th>INPUT VAT</th>
                                                <th data-hide="phone,tablet" class="text-center">STATUS</th>
                                                <th>ACTION</th>
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