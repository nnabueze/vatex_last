<?php
include('header_main.php');
include('sidebar.php');
?>
<div id="main" role="main">
	<!-- RIBBON -->
	<div id="ribbon">
		<span class="ribbon-button-alignment"> 
			<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
				<i class="fa fa-refresh"></i>
			</span> 
		</span>
		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<li>Home></li><li>Biller Management</li><li>Billers Account</li><li>Approved Billers Account</li>
		</ol>
	</div>
	<!-- END RIBBON -->
	<!-- MAIN CONTENT -->
	<div id="content" >
		<div class="row">
			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<h1 class="page-title txt-color-blueDark">					
					<!-- PAGE HEADER -->
					<i class="fa-fw fa fa-pencil-square-o"></i>Approved Billers Listing
				</h1>
			</div>
		</div>
		<section id="widget-grid" class="">
		<!-- row -->
			<form method="post" action="<?php echo site_url("reports/biller_search");?>" id="smart-form-register">
				<div class="col-sm-3">				
					<div class="">
						<div class="">
						<?php //print_R($analysisarr);?>
							<select name="biller_srch" id="biller_srch">
								<option value="">Choose Biller</option>
								<?php 
								$all_biller = $this->biller_model->approved_biller_listing();
								foreach($all_biller as $allbiller){ ?>
								<option value="<?php echo $allbiller->id;?>">
								<?php echo $allbiller->company_name;?></option>
								<?php }?>	
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-3">				
					<div class="">
						<div class="">
							<select name="billertbl" id="billertbl">
								<option value="">Select Table Name</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-3">				
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="to" type="text" placeholder="Select a date" name="dateto">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>							
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<div class="input-group">
							<input class="form-control" id="from" type="text" placeholder="From" name="datefrm">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<input type="button" id="searchreport" name="biller_srch" id="billersearch" value="Go">
						</div>
					</div>
				</div>
			</form>		
		<table id="cd-grid" class="table table-striped table-bordered table-hover"  width="100%">
            <thead>
                <tr>
                    <th data-class="expand">Name</th>
					<th data-hide="phone">Merchant ID</th>
                    <th data-hide="phone">Transaction ID</th>
                    <th>Amount</th>
					<th data-hide="phone,tablet">Date</th>
					<th data-hide="phone,tablet">Customer Email</th>
					<th data-hide="phone,tablet">Destination Bank</th>

                </tr>
            </thead>
 

        </table>



</section>
	</div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo site_url('assets/js/plugin/datatables/jquery.dataTables.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/plugin/datatables/dataTables.colVis.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/plugin/datatables/dataTables.tableTools.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/plugin/datatables/dataTables.bootstrap.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/plugin/datatable-responsive/datatables.responsive.min.js');?>"></script>
		<script src="<?php echo site_url('assets/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js');?>"></script>
		<script type="text/javascript">		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!		
		$(document).ready(function() {			
			pageSetUp();
			
			/* // DOM Position key index //
		
			l - Length changing (dropdown)
			f - Filtering input (search)
			t - The Table! (datatable)
			i - Information (records)
			p - Pagination (paging)
			r - pRocessing 
			< and > - div elements
			<"#id" and > - div with an id
			<"class" and > - div with a class
			<"#id.class" and > - div with an id and class
			
			Also see: http://legacy.datatables.net/usage/features
			*/	
	
			
			/* COLUMN FILTER  */
		    var otable = $('#datatable_fixed_column').DataTable({
		    	//"bFilter": false,
		    	//"bInfo": false,
		    	//"bLengthChange": false
		    	//"bAutoWidth": false,
		    	//"bPaginate": false,
		    	//"bStateSave": true // saves sort state using localStorage
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_fixed_column) {
						responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_fixed_column.respond();
				}		
			
		    });
		    
		    // custom toolbar
		    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
		    	   
		    // Apply the filter
		    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    	
		        otable
		            .column( $(this).parent().index()+':visible' )
		            .search( this.value )
		            .draw();
		            
		    } );
		    /* END COLUMN FILTER */   
	    
			/* COLUMN SHOW - HIDE */
			$('#datatable_col_reorder').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				"autoWidth" : true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_col_reorder) {
						responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_col_reorder.respond();
				}			
			});
			
			/* END COLUMN SHOW - HIDE */
			$.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
				console.log(message);
			};
			/* TABLETOOLS */
			$('#datatable_tabletools').dataTable({
				
				// Tabletools options: 
				//   https://datatables.net/extensions/tabletools/button_options
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},		
		        "oTableTools": {
		        	 "aButtons": [
		             "copy",
		             "csv",
		             "xls",
		                {
		                    "sExtends": "pdf",
		                    "sTitle": "SmartAdmin_PDF",
		                    "sPdfMessage": "SmartAdmin PDF Export",
		                    "sPdfSize": "letter"
		                },
		             	{
	                    	"sExtends": "print",
	                    	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
	                	}
		             ],
		            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
		        },
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_tabletools) {
						responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_tabletools.respond();
				}
			});			
			/* END TABLETOOLS */	
					// Date Range Picker
			$("#from").datepicker({
			    defaultDate: "+1w",
			    changeMonth: true,
				dateFormat:'yy-mm-dd',
			    numberOfMonths: 3,
			    prevText: '<i class="fa fa-chevron-left"></i>',
			    nextText: '<i class="fa fa-chevron-right"></i>',
			    onClose: function (selectedDate) {
			        $("#to").datepicker("option", "maxDate", selectedDate);
			    }
		
			});
			$("#to").datepicker({
			    defaultDate: "+1w",
			    changeMonth: true,
			    numberOfMonths: 3,
			    dateFormat:'yy-mm-dd',
				prevText: '<i class="fa fa-chevron-left"></i>',
			    nextText: '<i class="fa fa-chevron-right"></i>',
			    onClose: function (selectedDate) {
			        $("#from").datepicker("option", "minDate", selectedDate);
			    }
			});
		})
		</script>		
		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
			_gaq.push(['_trackPageview']);
			
			(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<script>
			$(document).ready(function() {	
				/*var $registerForm = $("#smart-form-register").validate({
	
				// Rules for form validation
				rules : {
					biller_srch : {
						required : true
					},
					billertbl : {
						required : true
					},
					dateto : {
						required : true
					},
					datefrm : {
						required : true
					}
				},

				// Messages for form validation
				messages : {
					biller_srch : {
						required : 'Please select biller company name'
					},
					billertbl : {
						required : 'Please select the service table'
					},
					dateto : {
						required : 'Please choose the date'
					},
					datefrm : {
						required : 'Please choose the date'
					}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});	*/		
				$('#searchreport').click(function(){
					//buildSearchData = 'tblnm=payment_collection_ewrw';
					
				var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
				
					billertbl = $('#billertbl').val();
					todate = $('#to').val();
					fromdate = $('#from').val();
					//alert("<?php echo site_url('reports/biller_search/');?>"+billertbl+'/'+todate+'/'+fromdate);
					
					$('#cd-grid').DataTable({
						"processing": true,
						"serverSide": true,
						 "bDestroy": true,
						"ajax": "<?php echo site_url('reports/biller_search/');?>"+'/'+billertbl+'/'+todate+'/'+fromdate,
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+

						"t"+

						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",

				"oLanguage": {

					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'

				},		

		        "oTableTools": {
								"aButtons": [
												{
													"sExtends":    "text",
													"sButtonText": 'Export PDF',
													"fnClick": function ( nButton, oConfig, oFlash ) {
														billertbl = $('#billertbl').val();
														todate = $('#to').val();
														fromdate = $('#from').val();
														go_to_url = "<?php echo site_url('createpdf/pdf');?>"+'/'+billertbl+'/'+todate+'/'+fromdate;
														window.open(go_to_url, '_blank');
													}
												},
												{
													"sExtends":    "text",
													"sButtonText": 'Export CSV',
													"fnClick": function ( nButton, oConfig, oFlash ) {
														billertbl = $('#billertbl').val();
														todate = $('#to').val();
														fromdate = $('#from').val();
														go_to_url = "<?php echo site_url('reports/csv');?>"+'/'+billertbl+'/'+todate+'/'+fromdate;
														window.open(go_to_url, '_blank');
														alert( 'CSV button clicked' );
													}
												}
											]

		        },

					"autoWidth" : true,

			        
					"preDrawCallback" : function() {

						// Initialize the responsive datatables helper once.

						if (!responsiveHelper_dt_basic) {

							responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#cd-grid'), breakpointDefinition);

						}

					},

					"rowCallback" : function(nRow) {

						responsiveHelper_dt_basic.createExpandIcon(nRow);

					},

					"drawCallback" : function(oSettings) {

						responsiveHelper_dt_basic.respond();

					}
						
						
					});
				});
				
				/*$.fn.dataTable.ext.buttons.exportpdf = {
					text: 'Export PDF',
					action: function ( e, dt, node, config ) {
						alert('Export Pdf');
						//dt.ajax.reload();
					}
				};
				
				$.fn.dataTable.ext.buttons.exportcsv = {
					text: 'Export CSV',
					action: function ( e, dt, node, config ) {
						alert('Export CSV');
					}
				}; */
						   
				$('#biller_srch').change(function(){
					billerid = $(this).val();				
					$.ajax({
						url:"reports/getbillertable/",
						method:"POST",
						data:"billerid="+billerid,
					}).done(function(msg){
						$('#billertbl').html(msg);
					});
				});
				$('#billersearch').click(function(){
				alert("ERR");
					billersrch = $('#biller_srch').val();
					billertbl = $('#billertbl').val();
					todate = $('#to').val();
					fromdate = $('#from').val();
					if(billersrch=='' || billertbl == '' || todate == '' || fromdate == ''){
						alert("Please select all fields");	
						return false;
					}else{
						return true;
					}
				});
			} );
		</script>
<style>
.error{color:red;}
</style>
<?php include('footer_main.php');?>	