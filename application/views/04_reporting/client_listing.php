				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- Start table advanced -->
                            <div class="panel panel-default shadow no-overflow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Client Listing Page</h3>
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
                                <?php $i=1; ?>
                                    <!-- Start datatable -->
                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th data-class="expand">S/N</th>
                                                <th data-hide="phone">ECOMMERCE ID</th>
                                                <th data-hide="phone">VENDOR ID</th>
                                            </tr>
                                        </thead>
                                        <!--tbody section is required-->
                                        <tbody>
                                            <?php foreach($client_listing as $client_listing){ ?>
                                            <tr class="border-warning">
                                                <td>
                                                    <b><?php echo $i; ?></b>
                                                </td>
                                                <td>
                                                    <?php echo $client_listing['Ecommerce_Id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $client_listing['Vendor_Id']; ?>
                                                </td>
                                              
                                             
                                            </tr>
                                            <?php $i++; } ?>
                                            
                                        </tbody>
                                        <!--tfoot section is optional-->
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>ECOMMERCE ID</th>
                                                <th>VENDOR ID</th>
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