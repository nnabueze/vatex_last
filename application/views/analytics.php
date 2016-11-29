<?php
include('header.php');
include('sidebar.php');
?>
<section id="page-content">
<!-- START @PAGE CONTENT -->
     

               
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                 <div class="row">
                    <div class="col-md-3">
                         <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title">Data Analytics</h3>
                                    </div><!-- /.pull-left -->
                                    <div class="pull-right">
                                        <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                                    </div><!-- /.pull-right -->
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="panel-body">
                                     <form class="form-horizontal" role="form">
                                      <div class="form-group">
                                        <!-- <label class="control-label col-sm-3" for="email">Date Range:</label> -->
                                        <div class="col-sm-12">
                                          <input type="email" class="form-control" id="email" placeholder="Select Date Range">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <!-- <label class="control-label col-sm-3" for="pwd">Select client:</label> -->
                                        <div class="col-sm-12">
                                          <select class="form-control">
                                            <option>Select Status</option>
                                            <option>Remmitted VAT</option>
                                            <option>Pending VAT</option>
                                          </select>
                                        </div>
                                      </div>

                                   
                                      <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-4">
                                          <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-zoom-in"></span>&nbsp;Search</button>
                                        </div>
                                      </div>
                                    </form>
                                </div><!-- /.panel-body -->
                                <div class="panel-footer">
                                    <a href="#">Data Analytics <i class="fa fa-angle-right"></i></a>
                                </div><!-- /.panel-footer -->
                            </div><!-- /.panel -->

                    </div>
                    <div class="col-md-9">
                     <div id="container1"></div>
                    </div>
                 </div><!-- /.row -->
                 <div class=row>
                     &nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
                     &nbsp;
                 </div>
  
<div class="row">
    <div class="col-md-12">
        <div id="container"></div> 
    </div>
</div><!-- /.row -->

                   
                <!--/ End body content -->
<?php include('footer.php');?>		
		<!-- START @PAGE LEVEL PLUGINS -->
        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
<!-- START @CORE PLUGINS -->
<script src="<?php echo base_url('assets/global/plugins/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/jquery-cookie/jquery.cookie.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/typehead.js/dist/handlebars.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/typehead.js/dist/typeahead.bundle.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/jquery-nicescroll/jquery.nicescroll.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/jquery.sparkline.min/index.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/jquery-easing-original/jquery.easing.1.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/ionsound/js/ion.sound.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/bootbox/bootbox.js')?>"></script>
<!--/ END CORE PLUGINS -->

<!-- START @PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('assets/global/plugins/bower_components/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/global/plugins/bower_components/datatables/js/datatables.responsive.js')?>"></script>
<!--/ END PAGE LEVEL PLUGINS -->


<!-- START @PAGE LEVEL SCRIPTS -->
<script src="../assets/admin/js/apps.js"></script>
<script src="../assets/admin/js/pages/blankon.table.js"></script>
<script src="../assets/admin/js/demo.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--/ END PAGE LEVEL SCRIPTS -->
<!--/ END JAVASCRIPT SECTION -->
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average VAT'
        },
        subtitle: {
            text: 'Source: Vatex.com'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Remmitted VAT (₦)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} ₦</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jumia',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'Konga',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'Jiji',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Yudala',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });
});





$(function () {
    // Create the chart
    $('#container1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'VAT Analytics'
        },
        subtitle: {
            text: 'Click the columns to view versions. Source: <a href="#">Vatex.com</a>.'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total remmitted VAT'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: 'Ecommerce',
            colorByPoint: true,
            data: [{
                name: 'Jumia',
                y: 56.33,
                drilldown: 'Jumia'
            }, {
                name: 'Konga',
                y: 24.03,
                drilldown: 'Konga'
            }, {
                name: 'Jiji',
                y: 10.38,
                drilldown: 'Jiji'
            }, {
                name: 'Yudala',
                y: 4.77,
                drilldown: 'Yudala'
            }]
        }],
        drilldown: {
            series: [{
                name: 'Microsoft Internet Explorer',
                id: 'Microsoft Internet Explorer',
                data: [
                    [
                        'v11.0',
                        24.13
                    ],
                    [
                        'v8.0',
                        17.2
                    ],
                    [
                        'v9.0',
                        8.11
                    ],
                    [
                        'v10.0',
                        5.33
                    ],
                    [
                        'v6.0',
                        1.06
                    ],
                    [
                        'v7.0',
                        0.5
                    ]
                ]
            }, {
                name: 'Chrome',
                id: 'Chrome',
                data: [
                    [
                        'v40.0',
                        5
                    ],
                    [
                        'v41.0',
                        4.32
                    ],
                    [
                        'v42.0',
                        3.68
                    ],
                    [
                        'v39.0',
                        2.96
                    ],
                    [
                        'v36.0',
                        2.53
                    ],
                    [
                        'v43.0',
                        1.45
                    ],
                    [
                        'v31.0',
                        1.24
                    ],
                    [
                        'v35.0',
                        0.85
                    ],
                    [
                        'v38.0',
                        0.6
                    ],
                    [
                        'v32.0',
                        0.55
                    ],
                    [
                        'v37.0',
                        0.38
                    ],
                    [
                        'v33.0',
                        0.19
                    ],
                    [
                        'v34.0',
                        0.14
                    ],
                    [
                        'v30.0',
                        0.14
                    ]
                ]
            }, {
                name: 'Firefox',
                id: 'Firefox',
                data: [
                    [
                        'v35',
                        2.76
                    ],
                    [
                        'v36',
                        2.32
                    ],
                    [
                        'v37',
                        2.31
                    ],
                    [
                        'v34',
                        1.27
                    ],
                    [
                        'v38',
                        1.02
                    ],
                    [
                        'v31',
                        0.33
                    ],
                    [
                        'v33',
                        0.22
                    ],
                    [
                        'v32',
                        0.15
                    ]
                ]
            }, {
                name: 'Safari',
                id: 'Safari',
                data: [
                    [
                        'v8.0',
                        2.56
                    ],
                    [
                        'v7.1',
                        0.77
                    ],
                    [
                        'v5.1',
                        0.42
                    ],
                    [
                        'v5.0',
                        0.3
                    ],
                    [
                        'v6.1',
                        0.29
                    ],
                    [
                        'v7.0',
                        0.26
                    ],
                    [
                        'v6.2',
                        0.17
                    ]
                ]
            }, {
                name: 'Opera',
                id: 'Opera',
                data: [
                    [
                        'v12.x',
                        0.34
                    ],
                    [
                        'v28',
                        0.24
                    ],
                    [
                        'v27',
                        0.17
                    ],
                    [
                        'v29',
                        0.16
                    ]
                ]
            }]
        }
    });
});
</script>

<!-- START GOOGLE ANALYTICS -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-55892530-1', 'auto');
ga('send', 'pageview');

</script>
<!--/ END GOOGLE ANALYTICS -->
