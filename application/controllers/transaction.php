<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
        $this->load->model(array('user_model','client_model','vat_model','basic_model','transaction_model'));
		$this->load->library('upload');
		$this->load->helper(array('url'));
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
	}
	
	public function index(){
		$data = array();
		$this->load->view('transaction',$data);
	}

	public function gettransactiondata(){
		$this->vat_model->gettransactionhold();
	}

	public function initiated_orders()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Unremitted Transaction Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'initiated_orders';
		$criteria = array('order_status'=>0);
		$data['initiated_orders'] = $this->transaction_model->get_all_transaction();
		//$data['initiated_orders'] = $this->transaction_model->get_all_transaction1();
		$data['page_content'] = '03_transaction/initiated_orders';
		$this->load->view('includes/main_content', $data);
	}

	public function closed_orders()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Successful/Closed Transaction Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'closed_orders';
		$criteria = array('order_status'=>"Closed");
		$data['initiated_orders'] = $this->transaction_model->get_all_transaction($criteria);

		$data['page_content'] = '03_transaction/closed_orders';
		$this->load->view('includes/main_content', $data);
	}

	public function viewdetails($id,$date){
		$data = array();
		$data['vatdetails'] = $this->vat_model->get_all_hold_orders($id,$date);
		$this->load->view('holdvatdetails',$data);
	}
	
	//Joseph
	public function orderdetail($orderid){
		$data = array();
		$data['orderdetails'] = $this->transaction_model->get_orderid($orderid);
		$this->load->view('orderdetail',$data);

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