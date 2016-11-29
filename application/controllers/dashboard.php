<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','tickets_model'));
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
		$data['page_content'] = '01_dashboard/dashboard';
		$this->load->view('includes/main_content', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */