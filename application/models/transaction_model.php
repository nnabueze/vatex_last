<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
		
	}
	
	function gettrnsactiondata($status){
		$requestData= $_REQUEST;

			$columns = array( 
			// datatable column index  => database column name
				0 =>'id', 
				1 => 'ec_id',
				2=> 'no_of_transaction',
				3=> 'amount',
				4=> 'sweep_date',
				5=> 'bankcode',
			);



			// getting total number records without any search
		$sql = "select * from vat_nibss_transaction where status='".$status."' order by sweep_date";
		
		$result = $this->db->query($sql);
		
		//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
		$totalData = $result->num_rows;
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


		$sql = "select * from vat_nibss_transaction WHERE status='".$status."'";
		/*if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( employee_name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR employee_salary LIKE '".$requestData['search']['value']."%' ";

			$sql.=" OR employee_age LIKE '".$requestData['search']['value']."%' )";
		} */

		//$sql.=" group by sales_date,ec_id "; 
		
		$result = $this->db->query($sql);
		$totalFiltered = $result->num_rows;
		

		//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
		//$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
//		echo $sql;
		$query = $this->db->query($sql);
		
		$data = array();
		   foreach ($query->result_array() as $row){
			   // preparing an array
			$nestedData=array(); 
			
			$userdata = $this->db->select('username')->where('id',$row["ec_id"])->get('user')->result();
			$bankdata = $this->db->select('bankname')->where('bankcode',$row["bankcode"])->get('bankcode')->result();
			//echo $this->db->last_query();
			$nestedData[] = $row["id"];
			$nestedData[] = $userdata[0]->username;
			$nestedData[] = $row["no_of_transaction"];
			$nestedData[] = $row["amount"];
			$nestedData[] = $row["sweep_date"];
			$nestedData[] = $bankdata[0]->bankname;
			$nestedData[] = "Pending";
			
			$data[] = $nestedData;
		}

		



		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),  
					"recordsTotal"    => intval( $totalData ),  
					"recordsFiltered" => intval( $totalFiltered ), 
					"data"            => $data   
					); 

		echo json_encode($json_data);  // send data as json format


	}

	//get current month transactions
	public function current_transaction()
	{
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$end_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		$orders = $this->db->where('status','1')
		->where('payment_date >=',$start_of_last_month)
		->where('payment_date <=',$start_of_current_month)
		->get('transactions')
		->result_array();

		return $orders;

	}

	//getting ecommerce transaction only
	public function ecommerce_current_transaction($item)
	{
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$end_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		$orders = $this->db->where('status','1')
		->where('payment_date >=',$start_of_last_month)
		->where('payment_date <=',$start_of_current_month)
		->where('ecommerce_id',$item)
		->get('transactions')
		->result_array();

		return $orders;
	}

	//getting list of last month order
	public function current_order($id)
	{
		$orders = $this->db->where('Transaction_Id',$id)
		->get('vat_on_hold_sweep_queue')
		->result_array();

		return $orders;
	}


	function get_all_transaction($criteria=NULL)
	{
		if($criteria)
		{
			$result = $this->db->where($criteria)
					->order_by('id',"desc")
					->get('vat_on_hold_sweep_queue')
					->result();
		}
		else
		{
			$result = $this->db->select('*')
					->order_by('id',"desc")
					->get('vat_on_hold_sweep_queue')
					->result();
		}
		
		return $result;
	}

	//getting the sweep date
	public function sweep_date()
	{
		$result = $this->db->get('sweep_settings')
				->row_array();
		return $result['sweep_execution_day'];
	}

	
	function get_all_orders($id){
		return $result = $this->db->where(array('nibsid'=>$id))->get('payment_vat_details')->result();
	}
	
	//Joseph
	
	function get_orderid($orderid){
		return $result = $this->db->where(array('Order_Id'=>$orderid))->get('vat_on_hold_sweep_queue')->result_array();
	}

	function get_user_name($id){
		return $userdata = $this->db->select('username')->where('id',$id)->get('user')->result();
	}
	function get_bank_name($id){
		return $bankdata = $this->db->select('bankname')->where('bankcode',$id)->get('bankcode')->result();
	}
	function get_hold_order_details($orderid,$userid){
		return $result = $this->db->where(array('ec_id'=>$userid,'orderid'=>$orderid))->get('payment_sweep_queue')->result();
	}

	function manual_sweep_start_process($userid,$sdate){
		$sql = "select bankcode,sales_date,ec_id, COUNT(ec_id) as cunt, sum(vat_amount)as amt from payment_sweep_queue where ec_id='". $userid."' and sales_date='".$sdate."' group by sales_date,ec_id order by sales_date";
		$result = $this->db->query($sql);	
		$data = $result->result();
		//print_r($data);
		$savedata = array();
		$savedata['ec_id'] = $data[0]->ec_id;
		$savedata['no_of_transaction'] = $data[0]->cunt;
		$savedata['amount'] = $data[0]->amt;
		$savedata['bankcode'] = $data[0]->bankcode;
		$savedata['sweep_date'] = date('Y-m-d');
		$savedata['status'] = 2;
		$this->db->insert('vat_nibss_transaction',$savedata);
		$nibsid = $this->db->insert_id();

		$orderdata = $this->db->where(array('ec_id'=>$userid,'sales_date'=>$sdate))->get('payment_sweep_queue')->result();
		
		$savedata = array();
		$i=0;
		foreach($orderdata as $ordersinfo){
			$savedata[$i] = array(
								   'nibsid' => $nibsid, 
								   'ec_id' => $ordersinfo->ec_id,
								   'orderid' => $ordersinfo->orderid,
								   'vat_amount' => $ordersinfo->vat_amount,
								   'sales_date' => $ordersinfo->sales_date,
								   'bankcode' => $ordersinfo->bankcode,
								 );
								
			
				$i++;
				if($i==50){
					$this->db->insert_batch('payment_vat_details', $savedata);
					$i=0;
					$savedata = array();
				}	
		}
		if($i!=0){
			$this->db->insert_batch('payment_vat_details', $savedata);
		}

		$this->db->delete('payment_sweep_queue',array('ec_id'=>$userid,'sales_date'=>$sdate));
	}

	////////////////////////////VENDOR////////////////////////////////////////

	//aprrove in vat_on_hold_sweep_queue table is to specify when INPUT VAT have been entered
	//and approved.
	//0 means vat have not been entered
	//1 means it have been entered
	//2 means FIRS have approved.

	//getting vendor order closed order of last month
	public function vendor_order($data)
	{
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$end_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		return $result = $this->db->where(array('Vendor_TIN'=>$data))
						->where(array('Order_Status'=>'1'))
						->where(array('approve'=>'0'))
						->where('Payment_Date >=',$start_of_last_month)
						->where('Payment_Date <=',$start_of_current_month)
						->order_by('id',"desc")
						->get('vat_on_hold_sweep_queue')
						->result_array();
	}


	//getting all the list of vendor initiated order
	public function vendor_initiated_orders($data)
	{
		return $result = $this->db->where(array('Ecommerce_Id'=>$data['ecommerce_id']))
						->where(array('Vendor_Id'=>$data['vandor_id']))
						->order_by('id',"desc")
						->get('vat_on_hold_sweep_queue')
						->result_array();
	}

	//getting list of vendor closded order
	public function vendor_closed_orders($data)
	{
		return $result = $this->db->where(array('Ecommerce_Id'=>$data['ecommerce_id']))
						->where(array('Vendor_Id'=>$data['vandor_id']))
						->where(array('Order_Status'=>'1'))
						->order_by('id',"desc")
						->get('vat_on_hold_sweep_queue')
						->result_array();
	}

	//getting vendor the last 5 closed order
	public function vendor_last_order($data)
	{
		 $result = $this->db->where(array('Vendor_TIN'=>$data))
						->where(array('Order_Status'=>'1'))
						->limit(5)
						->order_by('id',"desc")
						->get('vat_on_hold_sweep_queue')
						->result_array();

		return $result;
	}

	//getting specific ecommerce last 5 closed transaction
	public function ecommerce_last_transaction($data)
	{
		return $result = $this->db->where(array('ecommerce_id'=>$data))
						->where(array('Status'=>'1'))
						->limit(5)
						->order_by('id',"desc")
						->get('transactions')
						->result_array();
	}

	//getting all ecommerce last 5 closed transaction
	public function all_last_transaction()
	{
		return $result = $this->db->where(array('Status'=>'1'))
						->limit(5)
						->order_by('id',"desc")
						->get('transactions')
						->result_array();
	}

	//getting a specific order
	public function order_details($id)
	{
		return $result = $this->db->where(array('id'=>$id))
						->get('vat_on_hold_sweep_queue')
						->row_array();
	}

	//storing vandor input vat
	public function input_vat($data)
	{
		$item['input_vat'] = $data['input_vat'];
		$item['vat_image'] = $data['vat_image'];
		$item['approve'] = "1";

		//check if the date is greater than 21st.
		$day_of_current_month = date('d', strtotime(date('Y-m-1')));
		if ($day_of_current_month < 21) {
			$this->db->where('id', $data['id']);
			$this->db->update('vat_on_hold_sweep_queue', $item);

			return True;
		}
		return FALSE;
	}

	//getting list of inputed vat
	public function efiling()
	{
		return $result = $this->db->where(array('approve'=>'1'))
						->where(array('status'=>'0'))
						->order_by('id',"desc")
						->get('vat_on_hold_sweep_queue')
						->result_array();
	}

	//approving efiling(input vat) by firs
	public function approve($id, $data)
	{
		switch ($id) {
		    case "confirm":
		        $result = $this->db->where(array('id'=>$data))
		        						->get('vat_on_hold_sweep_queue')
		        						->row_array();
		      	if ($result) {
		      		$item['Net_VAT'] = $result['Output_VAT'] - $result['input_vat'];
		      		$item['approve'] = "2";

		      		$this->db->where('id', $data);
		      		$this->db->update('vat_on_hold_sweep_queue', $item);

		      		return 1;
		      	}
		      	return 3;
		        break;
		    case "decline":
				$result = $this->db->where(array('id'=>$data))
										->get('vat_on_hold_sweep_queue')
										->row_array();
				if ($result) {
					$item['Net_VAT'] = $result['Output_VAT'];
					$item['approve'] = "3";

					$this->db->where('id', $data);
					$this->db->update('vat_on_hold_sweep_queue', $item);

					return 2;
				}
				return 3;
		        break;
		    default:
		        return 3;
		}
	}

	//getting the list of all ecommerce initiated transaction
	public function ecommerce_initiated_orders($data)
	{
		$result = $this->db->where(array('Ecommerce_Id'=>$data))
								->get('vat_on_hold_sweep_queue')
								->result_array();
		return $result;
	}

	//getting list of all ecommerces closed order
	public function ecommerce_closed_orders($data)
	{
		$result = $this->db->where(array('Ecommerce_Id'=>$data))
								->where("Order_Status","1")
								->get('vat_on_hold_sweep_queue')
								->result_array();
		return $result;
	}

	//getting list of vendors with the same tin
	public function all_vendor_orders($phone)
	{
		$result = $this->db->where(array('tin'=>$phone))
								->get('vendor')
								->result_array();
		return $result;
	}

	//getting vendor total amount accross board
	public function vendor_total_amount($item)
	{
		//$period = date("F,Y",strtotime("-1 month"));
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		$result = $this->db->where(array('Vendor_TIN'=>$item))
								->where("Payment_Date >=", $start_of_last_month)
								->where("Payment_Date <=",$start_of_current_month)
								->where("Order_Status","1")
								->get('vat_on_hold_sweep_queue')
								->result_array();
		return $result;
	}

	//getting specific ecommerce total amount accross board
	public function ecommerce_total_amount($item)
	{
		//$period = date("F,Y",strtotime("-1 month"));
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		$result = $this->db->where(array('ecommerce_id'=>$item))
								->where("transaction_date >=", $start_of_last_month)
								->where("transaction_date <=",$start_of_current_month)
								->where("status","0")
								->get('computed_vat')
								->result_array();
		return $result;
	}

	//getting all ecommerce total amount across board
	public function all_total_amount()
	{
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		$result = $this->db->where("transaction_date >=", $start_of_last_month)
								->where("transaction_date <=",$start_of_current_month)
								->get('computed_vat')
								->result_array();
		return $result;
	}

	//last month total transaction
	public function total_transaction($trans =NULL)
	{
		if ($trans) {

			$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
			$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

			$result = $this->db->where("transaction_date >=",$start_of_last_month)
									->where("transaction_date <=", $start_of_current_month)
									->where("ecommerce_id",$trans)
									->where("status","1")
									->get('transactions')
									->result_array();

			return $result;
		}else{
			$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
			$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

			$result = $this->db->where("transaction_date >=",$start_of_last_month)
									->where("transaction_date <=", $start_of_current_month)
									->where("status","1")
									->get('transactions')
									->result_array();


			return $result;
		}
	}

	//getting last month total order
	public function total_order($order=null)
	{
		if ($order) {
			$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
			$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

			$result = $this->db->where("payment_date >=",$start_of_last_month)
									->where("payment_date <=", $start_of_current_month)
									->where("Ecommerce_Id", $order)
									->where("Order_Status", "1")
									->get('vat_on_hold_sweep_queue')
									->result_array();


			return $result;
		}else{
			$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
			$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

			$result = $this->db->where("payment_date >=",$start_of_last_month)
									->where("payment_date <=", $start_of_current_month)
									->where("Order_Status", "1")
									->get('vat_on_hold_sweep_queue')
									->result_array();


			return $result;
		}
	}

	//getting the vendor total order
	public function vendor_total_order($order)
	{
		$start_of_last_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
		$start_of_current_month = date('Y-m-d', strtotime(date('Y-m-1')));

		$result = $this->db->where("payment_date >=",$start_of_last_month)
								->where("payment_date <=", $start_of_current_month)
								->where("Vendor_TIN", $order)
								->where("Order_Status", "1")
								->get('vat_on_hold_sweep_queue')
								->result_array();
		return $result;
	}
}