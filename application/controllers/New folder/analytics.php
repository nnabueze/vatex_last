<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

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
		$data               = array();
		//$data['openticketcnt'] = $this->tickets_model->get_open_tickets_count();
		//$data['nonassignedticketcnt'] = sizeof($this->tickets_model->none_assigned_tickets());
		//$data['activebillers'] = sizeof($this->user_model->user_listing());
		//$data['latestbillertransaction'] = $this->user_model->get_latest_biller_transaction();
		
		$data['page_title'] = 'Client Module Dashboard';		
		$this->load->view('analytics',$data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */