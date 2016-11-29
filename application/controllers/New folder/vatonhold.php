<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vatonhold extends CI_Controller {

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
        $this->load->model(array('user_model','biller_model','vat_model','basic_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
	}
	
	public function index(){
		$data = array();
		$this->load->view('vatonhold',$data);
	}

	public function getholddata(){
		$this->vat_model->getvatonhold();
	}

	public function viewdetails($id,$date){
		$data = array();
		$data['vatdetails'] = $this->vat_model->get_all_hold_orders($id,$date);
		$this->load->view('holdvatdetails',$data);
	}

	public function refund($orderid,$userid,$sdate){
		$data = $this->vat_model->get_hold_order_details($orderid,$userid);
		//print_r($data);
		
		$savedata = array();
		$savedata['order_id'] =  $orderid;
		$savedata['ec_id'] =  $orderid;
		$savedata['salesdate'] =  $data[0]->sales_date;
		$savedata['refunddate'] =  date('Y-m-d H:i:s');
		$savedata['amount'] =  $data[0]->vat_amount;
		$savedata['refundtype'] =  1;
		$savedata['refundstatus'] =  1;
		$savedata['bankcode'] =  $data[0]->bankcode;
		$this->basic_model->savedata('order_refund',$savedata);
		$this->basic_model->customdele('payment_sweep_queue',array('ec_id'=>$userid,'orderid'=>$orderid));
		$this->session->set_flashdata('success',"Order Amount succesfully Refulnd.");
		redirect(getUrl('vatonhold/viewdetails/'.$userid.'/'.$data[0]->sales_date));
	}


	public function initiatemanualsweep($userid,$sdate){
		$this->vat_model->manual_sweep_start_process($userid,$sdate);	
		redirect(getUrl('vatonhold'));
	}


}