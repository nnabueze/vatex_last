				

<div class="body-content animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="panel rounded shadow">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h3 class="panel-title">Report Search Form</h3>
                    </div>
                    <div class="clearfix"></div>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding">
                    <form class="form-horizontal form-bordered" role="form" action="<?php echo site_url("reports/search_report");?>" method="POST">
                        <div class="form-body">
                            <div class="form-group">
                               <label class="col-sm-2 control-label">Report Type:</label>
                               <div class="col-sm-4">
                                <select class="chosen-select" name="item" tabindex="2">
                                    <option value=""></option>
                                    <option value="">Transaction Report</option>
                                    <option value="remittance_report">Vat Remittance Report</option>
                                </select>
                            </div>

                            <label class="col-sm-1 control-label">Date Range:</label>
                            <div class="col-sm-3">
                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                    <input id="reportrange" type="text" class="form-control input-sm" name="report_date">
                            </div>
                        <div class="col-sm-2">
                           <button type="submit" name="search_report" value="search" class="btn btn-sm btn-success">Search</button>
                       </div>
                   </div>
               </div>
           </form>
       </div>
   </div>
</div>
</div>

<div class="row">
    <div class="col-md-12">

        <!-- Start table advanced -->
        <div class="panel panel-default shadow no-overflow">
            <div class="panel-heading">
                <div class="pull-left">
                    <h3 class="panel-title">Report Table - 
                    <?php
                    switch ($type) {
                        case "deducted_report":
                             echo "DEDUCTED REPORT";
                            break;
                        case "remittance_report":
                            echo "VAT REMITTANCE REPORT";
                            break;
                        default:
                            echo "TRANSACTION REPORT";
                    }
                     ?>
                    </h3>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.panel-heading -->


            <div class="panel-body no-padding">

                <div class="panel-body">
                    <div class="panel panel-default panel-table no-margin">
                        <div class="panel-body no-padding">



                            <!--   Table for computted VAT -->                            
                            <?php if($type == ""){?>


                            <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>ECOMMERCE NAME</th>
                                        <th>VENDOR ID</th>
                                        <th>AMOUNT</th>
                                        <th>VAT</th>
                                        <th>TRASACTION DATE</th>
                                        <th data-hide="phone,tablet" class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total_amount = "";
                                    $total_vat = "";
                                    foreach($report as $report){ 
                                        $name = $this->reports_model->ecommerce($report->ecommerce_id);
                                        ?>
                                    <tr class="border-warning">
                                        <td>
                                            <b><?php echo ucwords($report->ecommerce_name); ?></b>
                                        </td>
                                        <td>
                                            <?php echo ucwords($report->vendor_name); ?>
                                        </td>
                                        <td>
                                            ₦ <?php echo number_format($report->transaction_amount, 0); ?>
                                        </td>
                                        <td>
                                            ₦ <?php echo number_format($report->output_vat, 0); ?>
                                        </td>
                                        <td>
                                            <?php echo $report->transaction_date; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('reports/computted_order/'.$report->vendor_id.'/'.date('Y-m-d', strtotime($report->transaction_date)));?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="View detail"><i class="fa fa-eye"></i></a>
                                        </td>
                                    

                                        <?php 
                                            $total_amount += $report->transaction_amount;
                                            $total_vat += $report->output_vat;
                                        } ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <?php if(count($report) > 0){?>
                                        <th colspan="1"><b>Total Transaction Amount:</b></th>
                                        <th colspan="1"><b>₦ <?php echo number_format($total_amount, 0); ?></b></th>
                                        <th></th>
                                        <th colspan="1"><b>Total Deducted VAT (5%)</b></th>
                                        <th colspan="2"><b>₦ <?php echo number_format($total_vat, 0); ?></b></th>
                                        <?php }else{ ?>
                                        <th>ECOMMERCE NAME</th>
                                        <th>VENDOR ID</th>
                                        <th>AMOUNT</th>
                                        <th>VAT</th>
                                        <th>TRASACTION DATE</th>
                                        <th data-hide="phone,tablet" class="text-center">ACTION</th>
                                        <?php } ?>
                                        </tr>
                                    </tfoot>
                                </table>


                        <!-----//////////////////////////////////////////  Computer Vat ends ////////////////////////////////////////////////////////////////////////////////-------->

                                <?php } elseif ($type == "deducted_report") {?>

                                <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>ECOMMERCE ID</th>
                                            <th>VENDOR ID</th>
                                            <th>PERIOD</th>
                                            <th>TRANSACTION AMOUNT</th>
                                            <th>INPUT VAT</th>
                                            <th>OUTPUT VAT</th>
                                            <th>NET VAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($report as $report){ 
                                            $name = $this->reports_model->ecommerce($report->ecommerce_id);
                                            ?>
                                        <tr class="border-warning">
                                            <td>
                                                <b><?php echo $name; ?></b>
                                            </td>
                                            <td>
                                                <?php echo $report->vendor_id; ?>
                                            </td>
                                            <td>
                                                <?php echo $report->period; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $report->transaction_amount; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php echo $report->input_vat; ?>
                                            </td>
                                            <td >
                                                <?php echo $report->output_vat; ?></span>

                                            </td>
                                            <td >
                                                <?php echo $report->net_vat; ?></span>

                                            </td>


                                            <?php } ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ECOMMERCE ID</th>
                                                <th>VENDOR ID</th>
                                                <th>PERIOD</th>
                                                <th>TRANSACTION AMOUNT</th>
                                                <th>INPUT VAT</th>
                                                <th>OUTPUT VAT</th>
                                                <th>Net VAT</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <!-----//////////////////////////////////////////  Deducted Vat ends ////////////////////////////////////////////////////////////////////////////////-------->
                                     

                                     <?php }elseif($type == "remittance_report"){?>

                                     <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                         <thead>
                                             <tr>
                                                 <th>ECOMMERCE ID</th>
                                                 <th>VENDOR ID</th>
                                                 <th>PERIOD</th>
                                                 <th>TRANSACTION AMOUNT</th>
                                                 <th>VAT REMITTANCE AMOUNT</th>
                                                 <th>VAT REMITTANCE DATE</th>
                                                 <th>ECOMMERCE BANK</th>
                                                 <th>FIRS BANK</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php foreach($report as $report){
                                                $name = $this->reports_model->ecommerce($report->ecommerce_id);
                                              ?>
                                             <tr class="border-warning">
                                                 <td>
                                                     <b><?php echo $name; ?></b>
                                                 </td>
                                                 <td>
                                                     <?php echo $report->vendor_id; ?>
                                                 </td>
                                                 <td>
                                                     <?php echo $report->period; ?>
                                                 </td>
                                                 <td>
                                                     <?php echo $report->transaction_amount; ?>
                                                 </td>

                                                 <td>
                                                     <?php echo $report->remittance_amount; ?>
                                                 </td>
                                                 <td >
                                                     <?php echo $report->remittance_date; ?></span>

                                                 </td>
                                                 <td >
                                                     <?php echo $report->ecommerce_bank; ?></span>

                                                 </td>
                                                 <td >
                                                     <?php echo $report->FIRS_bank; ?></span>

                                                 </td>
                                                 <?php } ?>

                                             </tbody>
                                             <tfoot>
                                                 <tr>
                                                     <th>ECOMMERCE ID</th>
                                                     <th>VENDOR ID</th>
                                                     <th>PERIOD</th>
                                                     <th>TRANSACTION AMOUNT</th>
                                                     <th>VAT REMITTANCE AMOUNT</th>
                                                     <th>VAT REMITTANCE DATE</th>
                                                     <th>ECOMMERCE BANK</th>
                                                     <th>FIRS BANK</th>
                                                 </tr>
                                             </tfoot>
                                         </table>

                                         <!-----//////////////////////////////////////////  Remitted Vat ends ////////////////////////////////////////////////////////////////////////////////-------->
                                     <?php }?>


                                </div>
                            </div>
                        </div>
                    </div>








                </div><!-- /.panel -->
                <!--/ End table advanced -->

            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->

    </div>