<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pendingtransaction extends CI_Controller {

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
	 * created by Ravi Prakash
	 */

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','biller_model','transaction_model','basic_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
	}
	
	public function index(){
		$data = array();
		$this->load->view('pendingtransaction',$data);
	}

	public function getholddata(){
		$this->transaction_model->gettrnsactiondata(2);
	}

	public function viewdetails($id){
		$data = array();
		$data['vatdetails'] = $this->transaction_model->get_all_orders($id);
		$this->load->view('transactiondetails',$data);
	}
}