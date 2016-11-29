<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

                <footer class="footer-content">
                    <span id="copyright-year"></span> &copy; FIRS - Federal Internal Revenue Services. Powered by Gention Global Resources for FIRS.
                </footer>

            </section>
            <!--/ END PAGE CONTENT -->

        </section>
        <!--/ END WRAPPER -->

        <!-- START @BACK TOP -->
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div>
        <!--/ END BACK TOP -->

		
	<?php
		$this->load->view('includes/js_main'); 
		
		if($dashboard == TRUE)
		{
			$this->load->view('includes/js_dashboard');	
		}
		if($datatable == TRUE)
		{
			$this->load->view('includes/js_datatable');
		}
		if($formelements == TRUE)
		{
			$this->load->view('includes/js_formelements');
		}
		?>
        <!--/ END JAVASCRIPT SECTION -->
        
        
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

    </body>
    <!--/ END BODY -->

</html>
