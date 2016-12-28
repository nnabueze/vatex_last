<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','tickets_model','transaction_model'));
	} 

	public function index()
	{
		//exit;
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		
		$data = array();
		$data['page_title'] = 'FIRS Admin Dashboard';
		$data['uri_segment_2'] = 'dashboard';
		$data['dashboard'] = TRUE;
		$data['datatable'] = FALSE;
		
		if ($this->session->userdata('user') == "ecommerce") {
			$data['page_content'] = '01_dashboard/ecommerce_dashboard';
			$data['user'] = 'ecommerce';
		}else{

			$data['page_content'] = '01_dashboard/dashboard';
		}
		$this->load->view('includes/main_content', $data);
	}

	//vendor dashboard
	public function vendor()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login/vendor'));
		}
		$item['vandor_id']= $this->session->userdata('vendor_id');
		$item['ecommerce_id'] = $this->session->userdata('ecommerce_Id');

		$data = array();
		$data['page_title'] = 'FIRS Vendor Dashboard';
		$data['uri_segment_2'] = 'dashboard';
		$data['dashboard'] = TRUE;
		$data['datatable'] = FALSE;
		$data['user'] = 'vendor';
		$data['orders'] = $this->transaction_model->vendor_last_order($item);
/*		print_r($data['orders']);
		die;*/
		$data['page_content'] = '01_dashboard/vendor_dashboard';
		$this->load->view('includes/main_content', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */