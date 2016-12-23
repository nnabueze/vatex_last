				<div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="panel rounded shadow panel-default">
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
                             <strong>Success!</strong> '.$this->session->flashdata('success').'
                         </div>';
                     }
                     ?>
                     <div class="panel-heading">
                        <div class="">
                            <h3 class="panel-title">Non Vatible Products</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->

                    <div class="panel-body">
                        <!-- Start datatable -->
                        <table id="datatable-setup-configure" class="table table-default table-middle table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th data-hide="phone">PRODUCT CATEGORY ID</th>
                                    <th data-class="expand">PRODUCT CATEGORY NAME</th>
                                    <th data-hide="phone">ACTION</th>
                                </tr>
                            </thead>
                            <!--tbody section is required-->
                            <tbody>
                             <?php foreach($vatibles as $vatible){ ?>
                             <tr class="border-warning">
                                <td>
                                    <b><?php echo $vatible['product_category_id'];?></b>
                                </td>
                                <td>
                                    <?php echo $vatible['product_category_name'];?>
                                </td>
                                <td class="text-center">

                                    <a href="<?php echo site_url('vat/vatible_delete/'.$vatible['id']);?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                        <!--tfoot section is optional-->
                        <tfoot>
                            <tr>
                                <th>PRODUCT CATEGORY ID</th>
                                <th>PRODUCT CATEGORY NAME</th>
                                <th>ACTION</th>
                            </tr>
                        </tfoot>
                    </table>

                    <!--/ End datatable -->
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
            <div class="divider"></div>

        </div>


        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="panel rounded shadow no-overflow">
                <div class="panel-heading">
                    <div class="">
                        <h3 class="panel-title">Upload Non-Vatible products via CSV <span class="pull-right"><a href="<?php echo site_url().'uploads/vat/template.xlsx';?>" class="btn btn-default btn-sm" >Download CSV Tamplate</a></span></h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body no-padding">
                <div class="col-lg-2 col-md-2 col-sm-12">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                <form id="client-create-validation" name="smart-form-register" class="form-horizontal form-bordered"  method="post" action ="<?php echo site_url('vat/importcsv');?>" enctype="multipart/form-data" role="form">
                    <div class="form-body">
                        <div class="form-group">

                            <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');?>" rel="stylesheet">
                            <link href="<?php echo base_url('assets/_main/global/plugins/bower_components/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css');?>" rel="stylesheet">

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div>
                                    <span class="btn btn-default "><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="userfile" value="" ></span><br/><br/>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                </div>




                </div>
            </div>
        </div>
    </div><!-- /.row -->

</div>