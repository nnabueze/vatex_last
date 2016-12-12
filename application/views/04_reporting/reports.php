				

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
                    <form class="form-horizontal form-bordered" role="form" action="<?php echo site_url("reports");?>" method="POST">
                        <div class="form-body">
                            <div class="form-group">
                               <label class="col-sm-2 control-label">Report Type:</label>
                               <div class="col-sm-4">
                                <select class="chosen-select" name="item" tabindex="2">
                                    <option value=""></option>
                                    <option value="computed_report">Computed Report</option>
                                    <option value="deducted_report">Deducted Report</option>
                                    <option value="remittance_report">Remittance Report</option>
                                    <option value="deduction_error_report">Deduction Error Report</option>
                                    <option value="remittance_error_report">Remittance Error Report</option>
                                    <option value="order_transaction_volume">Order Transaction Volume</option>
                                    <option value="remittance_error_report">Order Transaction Summary</option>
                                    <option value="remittance_error_report">Vendor VAT Remittance History</option>
                                    <option value="remittance_error_report">Project VAT Remittance Report</option>
                                    <option value="remittance_error_report">VAT Revenue Report</option>
                                    <option value="remittance_error_report">VAT Revenue History Report</option>
                                </select>
                            </div>
                            <label class="col-sm-1 control-label">Date Range:</label>
                            <div class="col-sm-3">
                               <div class="">
                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                    <span></span> <b class="caret"></b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                           <button type="submit" name="search_report" value="search" class="btn btn-success">Search</button>
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
                        case "computed_report":
                            echo "COMPUTED REPORT";
                            break;
                        case "deducted_report":
                             echo "DEDUCTED REPORT";
                            break;
                        case "remittance_report":
                            echo "REMITTANCE REPORT";
                            break;
                        case "deduction_error_report":
                            echo "DEDUCTION ERROR REPORT";
                            break;
                        case "remittance_error_report":
                            echo "REMITTANCE ERROR REPORT";
                            break;
                        case "order_transaction_volume":
                            echo "ORDER TRANSACTION VOLUME";
                            break;
                        case "remittance_report":
                            echo "REMITTANCE REPORT";
                            break;
                        case "remittance_report":
                            echo "REMITTANCE REPORT";
                            break;
                        case "remittance_report":
                            echo "REMITTANCE REPORT";
                            break;
                        case "remittance_report":
                            echo "REMITTANCE REPORT";
                            break;
                   
                        default:
                            //code to be executed if n is different from all labels;
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
                            <?php if($type == "computed_report"){?>


                            <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>ecommerce_id</th>
                                        <th>vendor_id</th>
                                        <th>period</th>
                                        <th>transaction_amount</th>
                                        <th>input_vat</th>
                                        <th>output_vat</th>
                                        <th>NET VAT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($report as $report){ ?>
                                    <tr class="border-warning">
                                        <td>
                                            <b><?php echo $report->ecommerce_id; ?></b>
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
                                            <?php echo $report->input_vat; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $report->output_vat; ?></span>

                                        </td>
                                        <td class="text-center">
                                            <?php echo $report->net_vat; ?></span>

                                        </td>

                                        <?php } ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ecommerce_id</th>
                                            <th>vendor_id</th>
                                            <th>period</th>
                                            <th>transaction_amount</th>
                                            <th>input_vat</th>
                                            <th>output_vat</th>
                                            <th>Net Vat</th>
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
                                        <?php foreach($report as $report){ ?>
                                        <tr class="border-warning">
                                            <td>
                                                <b><?php echo $report->ecommerce_id; ?></b>
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
                                             <?php foreach($report as $report){ ?>
                                             <tr class="border-warning">
                                                 <td>
                                                     <b><?php echo $report->ecommerce_id; ?></b>
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