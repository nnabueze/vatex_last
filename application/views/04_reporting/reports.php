				
                
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
                                                    <select class="chosen-select" tabindex="2">
                                                        <option value=""></option>
                                                        <option value="computed_report">Computed Report</option>
                                                        <option value="deducted_report">Deducted Report</option>
                                                        <option value="remittance_report">Remittance Report</option>
                                                        <option value="deduction_error_report">Deduction Error Report</option>
                                                        <option value="remittance_error_report">Remittance Error Report</option>
                                                        <option value="remittance_error_report">Order Transaction Volume</option>
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
                                        <h3 class="panel-title">Report Table - {Report Type}</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body no-padding">
                                    
                                        <div class="panel-body">
                                            <div class="panel panel-default panel-table no-margin">
                                                <div class="panel-body no-padding">
                                                    <table id="datatable-dom" class="table table-default table-middle table-striped table-bordered table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th>Column1 Label</th>
                                                            <th>Column2 Label</th>
                                                            <th>Column3 Label</th>
                                                            <th>Column4 Label</th>
                                                            <th>Column5 Label</th>
                                                            <th>Column6 Label</th>
                                                            <th>Column7 Label</th>
                                                        </tr>
                                                        </thead>

                                                        <tfoot>
                                                        <tr>
                                                            <th>Column1 Label</th>
                                                            <th>Column2 Label</th>
                                                            <th>Column3 Label</th>
                                                            <th>Column4 Label</th>
                                                            <th>Column5 Label</th>
                                                            <th>Column6 Label</th>
                                                            <th>Column7 Label</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div><!-- /.panel -->
                            <!--/ End table advanced -->

                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->

                </div>