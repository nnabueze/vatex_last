<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model','client_model','vat_model','basic_model','transaction_model','reports_model'));
		$this->load->library('upload','form_validation');
		$this->load->helper(array('url','form','download'));
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


//////////////////////////////////////////////////////////////////TRANSACTION
	//getting transaction for each ecommerce
	public function ecommerce_current_transaction()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$item = $this->session->userdata('ecommerce_id');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Current Transaction';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'ecommerce_current_transaction';
		$data['user'] = 'ecommerce';
		$data['period'] = date("F,Y",strtotime("-1 month"));
		$data['current_date'] = date('d F, Y');
		$data['sweep_date'] = date($this->sweep_date().' F, Y');
		$data['initiated_orders'] = $this->transaction_model->ecommerce_current_transaction($item);
		//echo "<pre>"; print_r($data['initiated_orders']); die;
		$data['page_content'] = '03_transaction/ecommerce_current_transaction';
		$this->load->view('includes/main_content', $data);
	}
	//getting previous month transactions
	public function current_transaction()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Current Transaction';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'current_transaction';
		$data['period'] = date("F,Y",strtotime("-1 month"));
		$data['current_date'] = date('d F, Y');
		$data['sweep_date'] = date($this->sweep_date().' F, Y');
		$data['initiated_orders'] = $this->transaction_model->current_transaction();
		//echo "<pre>"; print_r($data['initiated_orders']); die;
		$data['page_content'] = '03_transaction/current_transaction';
		$this->load->view('includes/main_content', $data);
	}

	//viewing list of order under a specifictransaction
	public function current_order($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$item = $this->session->userdata('ecommerce_id');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Current Transaction';
		$data['uri_segment_2'] = 'transaction';
		
		$data['initiated_orders'] = $this->transaction_model->current_order($id);
		if ($item) {
			$data['user'] = 'ecommerce';
			$data['uri_segment_3'] = 'ecommerce_current_transaction';
		}else{
			$data['user'] = 'firs';
			$data['uri_segment_3'] = 'current_transaction';
		}
		
		$data['page_content'] = '03_transaction/current_order';
		$this->load->view('includes/main_content', $data);
	}

	//getting initiated order
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
		$data['initiated_orders'] = $this->transaction_model->get_all_transaction();
		//$data['initiated_orders'] = $this->transaction_model->get_all_transaction1();
		$data['page_content'] = '03_transaction/initiated_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting vendor closed order
	public function vendor_orders()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
/*		$item['vandor_id']= $this->session->userdata('vendor_id');
		$item['ecommerce_id'] = $this->session->userdata('ecommerce_Id');*/
		$item = $this->session->userdata('tin');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Vendor Orders';
		$data['uri_segment_2'] = 'vendor_orders';
		$data['uri_segment_3'] = 'vendor_orders';
		$data['user'] = 'vendor';
		$data['vendor_orders'] = $this->transaction_model->vendor_order($item);

		$data['page_content'] = '03_transaction/vendor_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting list of vendor order
	public function vendor_initiated_orders()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$item['vandor_id']= $this->session->userdata('vendor_id');
		$item['ecommerce_id'] = $this->session->userdata('ecommerce_Id');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Vendor Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'initiated_orders';
		$data['user'] = 'vendor';
		$data['vendor_orders'] = $this->transaction_model->vendor_initiated_orders($item);

		$data['page_content'] = '03_transaction/vendor_list_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting vendor closed order
	public function vendor_closed_orders()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$item['vandor_id']= $this->session->userdata('vendor_id');
		$item['ecommerce_id'] = $this->session->userdata('ecommerce_Id');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Vendor Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'closed_orders';
		$data['user'] = 'vendor';
		$data['vendor_orders'] = $this->transaction_model->vendor_closed_orders($item);
	
		$data['page_content'] = '03_transaction/vendor_closed_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting all vendors order in all ecommerce paltform
	public function all_vendor_orders()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$phone= $this->session->userdata('tin');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Vendor Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'all_orders';
		$data['user'] = 'vendor';
		$data['vendors'] = $this->transaction_model->all_vendor_orders($phone);
		//echo"<pre>";print_r($data['vendor_orders']); die;
		$data['page_content'] = '03_transaction/all_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting all vendors order in all ecommerce paltform
	public function all_vendor_orders2()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$phone= $this->session->userdata('tin');

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Vendor Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'all_orders2';
		$data['user'] = 'vendor';
		$data['vendors'] = $this->transaction_model->all_vendor_orders($phone);
		//echo"<pre>";print_r($data['vendor_orders']); die;
		$data['page_content'] = '03_transaction/all_orders_closed';
		$this->load->view('includes/main_content', $data);
	}

	//ecommerce orders
	public function ecommerce_initiated_order()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$item = $this->session->userdata('ecommerce_id');
	
		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Ecommerce Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'ecommerce_initiated_order';
		$data['user'] = 'ecommerce';
		$data['vendor_orders'] = $this->transaction_model->ecommerce_initiated_orders($item);

		
		$data['page_content'] = '03_transaction/ecommerce_initiated_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting all list of ecommerce closed order
	public function ecommerce_closed_order()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}
		$item = $this->session->userdata('ecommerce_id');
		
		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'List of Ecommerce Orders';
		$data['uri_segment_2'] = 'transaction';
		$data['uri_segment_3'] = 'ecommerce_closed_order';
		$data['user'] = 'ecommerce';
		$data['vendor_orders'] = $this->transaction_model->ecommerce_closed_orders($item);
	
		
		$data['page_content'] = '03_transaction/ecommerce_closed_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting closed orders
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
		$criteria = array('order_status'=> '1');
		$data['initiated_orders'] = $this->transaction_model->get_all_transaction($criteria);

		$data['page_content'] = '03_transaction/closed_orders';
		$this->load->view('includes/main_content', $data);
	}

	//getting specific oreder details
	public function order_details($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Efiling of Input VAT';
		$data['uri_segment_2'] = 'vendor_orders';
		$data['uri_segment_3'] = 'vendor_orders';
		$data['user'] = 'vendor';
		$data['order_details'] = $this->transaction_model->order_details($id);

		$data['page_content'] = '03_transaction/input_vat';
		$this->load->view('includes/main_content', $data);

	}

	//storing input VAT
	public function input_vat()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}


		if ($this->input->post('input_vat')!='') {

			if($_FILES["pimg"]["name"] != ''){
				$uploads_dir = 'uploads/vat';
				$tmp_name = $_FILES["pimg"]["tmp_name"];
				$array = explode('.', $_FILES["pimg"]["name"]);
				$extension = end($array);
				$name = uniqid().".".$extension;
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
				$data['vat_image'] = $name;
			}
		}

		$data['input_vat']   = $this->input->post('input_vat');
		$data['id']      = $this->input->post('Id');

		if ($vat = $this->transaction_model->input_vat($data)) {
			$this->session->set_flashdata('success',"VAT entered susccessfully.");
			redirect(getUrl('transaction/vendor_orders'));
		}

		$this->session->set_flashdata('error',"unable to insert Vat.");
		redirect(getUrl('transaction/vendor_orders'));
	}

	//retrieving listof input vat for FIRS
	public function efiling()
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Efiling of Input VAT';
		$data['uri_segment_2'] = 'efiling';
		$data['uri_segment_3'] = 'efiling';
		$data['user'] = 'firs';
		$data['efilings'] = $this->transaction_model->efiling();

		$data['page_content'] = '03_transaction/efiling';
		$this->load->view('includes/main_content', $data);
	}

	//getting a specific input vat details for firs
	public function efiling_details($id)
	{
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$data = array();
		$data['datatable'] = TRUE;
		$data['page_title'] = 'Efiling of Input VAT';
		$data['uri_segment_2'] = 'efiling';
		$data['uri_segment_3'] = 'efiling';
		$data['user'] = 'firs';
		$data['order_details'] = $this->transaction_model->order_details($id);

		$data['page_content'] = '03_transaction/efiling_details';
		$this->load->view('includes/main_content', $data);
	}

	//downloading transaction image
	public function download($id){
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$data = file_get_contents(site_url().'uploads/vat/'.$id);
		$name = $id;
		force_download($name, $data);
	}

	//approving input vat by firs
	public function approve($id, $data)
	{
		
		if(!isAdminLoggedIn())
		{
			redirect(getUrl('login'));
		}

		$status = $this->transaction_model->approve($id,$data);

		switch ($status) {
		    case 1:
		        $this->session->set_flashdata('success',"VAT Approved Sucessful.");
		        redirect(getUrl('transaction/efiling'));
		        break;
		    case 2:
		        $this->session->set_flashdata('success',"VAT hav been sucessfully declined.");
		        redirect(getUrl('transaction/efiling'));
		        break;
		    default:
		    	$this->session->set_flashdata('error',"unable to approve VAT.");
		    	redirect(getUrl('transaction/efiling'));
		       
		}

	}

	//getting the fundsweep date
	private function sweep_date()
	{
		$sweep_date = $this->transaction_model->sweep_date();
		return $sweep_date;
	}


/////////////////////////////////////////////////////////////////////////////////////////



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