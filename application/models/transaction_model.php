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


	function get_all_transaction($criteria=NULL)
	{
		if($criteria)
		{
			$result = $this->db->where($criteria)->get('payment_sweep_queue')->result();
		}
		else
		{
			$result = $this->db->get('payment_sweep_queue')->result();
		}
		
		return $result;
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
}