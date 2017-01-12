<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','tickets_model','transaction_model','reports_model'));
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
			$item = $this->session->userdata('ecommerce_id');

			$data['page_content'] = '01_dashboard/ecommerce_dashboard';
			$data['total_amount'] = $this->transaction_model->ecommerce_total_amount($item);
			$data['output_vat'] = $this->transaction_model->ecommerce_total_amount($item);
			$data['input_vat'] = $this->transaction_model->ecommerce_total_amount($item);
			$data['net_vat'] = $this->transaction_model->ecommerce_total_amount($item);
			$data['orders'] = $this->transaction_model->ecommerce_last_transaction($item);
			
			$data['user'] = 'ecommerce';
		}else{

			$data['page_content'] = '01_dashboard/dashboard';

			$data['total_amount'] = $this->transaction_model->all_total_amount();
			$data['output_vat'] = $this->transaction_model->all_total_amount();
			$data['input_vat'] = $this->transaction_model->all_total_amount();
			$data['net_vat'] = $this->transaction_model->all_total_amount();
			$data['orders'] = $this->transaction_model->all_last_transaction();
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
/*		$item['vandor_id']= $this->session->userdata('vendor_id');
		$item['ecommerce_id'] = $this->session->userdata('ecommerce_Id');*/
		$item= $this->session->userdata('tin');

		$data = array();
		$data['page_title'] = 'FIRS Vendor Dashboard';
		$data['uri_segment_2'] = 'dashboard';
		$data['dashboard'] = TRUE;
		$data['datatable'] = FALSE;
		$data['user'] = 'vendor';
		$data['total_amount'] = $this->transaction_model->vendor_total_amount($item);
		$data['output_vat'] = $this->transaction_model->vendor_total_amount($item);
		$data['input_vat'] = $this->transaction_model->vendor_total_amount($item);
		$data['net_vat'] = $this->transaction_model->vendor_total_amount($item);
		$data['orders'] = $this->transaction_model->vendor_last_order($item);
/*		print_r($data['orders']);
		die;*/
		$data['page_content'] = '01_dashboard/vendor_dashboard';
		$this->load->view('includes/main_content', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */