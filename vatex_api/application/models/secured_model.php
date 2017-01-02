<?php
class Secured_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	//insert open order
	public function open_order($data)
	{
		$item['Transaction_Id']   = $data['Transaction_Id'];
		$item['Ecommerce_Id']   = $data['Ecommerce_Id'];
		$item['Vendor_Id']   = $data['Vendor_Id'];
		$item['Order_Id']   = $data['Order_Id'];
		$item['Order_Amount']   = $data['Order_Amount'];
		$item['Quantity']   = $data['Quantity'];
		$item['Order_date']   = $data['Order_date'];
		$item['Purchase_Price']   = $data['Purchase_Price'];
		$item['Product_Description']   = $data['Product_Description'];
		$item['Product_Category']   = $data['Product_Category'];
		$item['Net_VAT']   = $data['Net_VAT'];
		$item['Vendor_TIN']   = $data['Vendor_TIN'];
		$item['ecommerce_name']   = $data['ecommerce_name'];
		$item['vendor_name']   = $data['vendor_name'];

		if ($insert = $this->db->insert("vat_on_hold_sweep_queue", $item)) {

			//inserting record into transaction table
			$transaction['transaction_amount'] = $data['Order_Amount'];
			$transaction['no_of_orders'] = 1;
			$trans = $this->transaction($data['Transaction_Id']);
			if ($trans) {

				//sum up all the order amount under the transaction
				$transaction['transaction_amount']   = $transaction['transaction_amount'] + $trans['transaction_amount'];
				$transaction['no_of_orders'] = $trans['no_of_orders'] + 1;

				$this->db->where('transaction_id',$data['Transaction_Id']);
				$this->db->update('transactions', $transaction);
			}else{
				$transaction['transaction_id']   = $data['Transaction_Id'];
				$transaction['transaction_date']   = $data['Order_date'];
				$transaction['ecommerce_id']   = $data['Ecommerce_Id'];
				$transaction['ecommerce_name']   = $data['ecommerce_name'];

				$this->db->insert("transactions", $transaction);

			}
			return true;
		}

		return false;
	}

	//updated close order
	public function close_order($data)
	{
		$item['Ecommerce_Id']   = $data['Ecommerce_Id'];
		$item['Transaction_Id']   = $data['Transaction_Id'];
		$item['Payment_Date']   = $data['Payment_Date'];
		$item['Payment_Type']   = $data['Payment_Type'];
		$item['Delivery_Date']   = $data['Delivery_Date'];
		$item['Order_Status']   = $data['Order_Status'];
	
		//calculating the output VAT
		$orders = $this->db->where(array('Transaction_Id'=>$item['Transaction_Id']))->where('Ecommerce_Id',$item['Ecommerce_Id'])->get('vat_on_hold_sweep_queue')->result_array();
		
		if (count($orders) > 0) {
		 	foreach ($orders as $order) {
		 		//check if the product category is Vatable
		 		$result = $this->db->where(array('product_category_name'=>$order['Product_Category']))->get('vatibles')->row_array();

		 		if (!$result) {
		 			//computing Output Vat for specific order
		 			$data1['Output_VAT'] = 0.05 * $order['Order_Amount'];

		 			//insert the output vat
		 			$this->db->where('Order_Id', $order['Order_Id']);
		 			$this->db->update('vat_on_hold_sweep_queue', $data1);
		 		}
		 	}

		 	//close all the order within the specified transaction.
		 	$this->db->where('Transaction_Id', $data['Transaction_Id']);
		 	$this->db->update('vat_on_hold_sweep_queue', $item);

		 	//updating transaction table for closed transaction
		 	$transaction['payment_date']   = $data['Payment_Date'];
		 	$transaction['status']   = "1";
		 	$trans = $this->transaction($data['Transaction_Id']);
		 	if ($trans) {
		 		$transaction['vat_deducted']   = 0.05 * $trans['transaction_amount'];
		 		$this->db->where('transaction_id',$data['Transaction_Id']);
		 		$this->db->update('transactions', $transaction);
		 	}

		 	return true;
		 } 

		 return false;
	}

	//Varifying Biller token
	public function token_verify($data)
	{
		$token = $this->db->where(array('token_id'=>$data['token']))->where(array('api_key'=>$data['Ecommerce_Id']))->get('client_settings')->row_array();

		return $token;
	}

	//checking if order ID
	public function order_check($order)
	{
		$token = $this->db->where(array('Order_Id'=>$order))->get('vat_on_hold_sweep_queue')->row_array();

		return $token;
	}

	//check if the transaction exist
	public function transaction_check($data)
	{
		$token = $this->db->where(array('Transaction_Id'=>$data['Transaction_Id']))->where('Ecommerce_Id',$data['Ecommerce_Id'])->get('vat_on_hold_sweep_queue')->row_array();

		return $token;
	}

	//getting all users on the platform
	public function users()
	{
		$results = $this->db->select('contact_email, api_key')->get('client_settings')->result_array();

		//$users = array();
		$item = array();
		if (count($results) > 0) {
			
			foreach ($results as $value) {
				$item[$value['contact_email']] = $value['api_key'];

				//array_push($users, $value['contact_email'] = $value['api_key']);
			}
		}

		return $item;


		
	}

	//checking if vendor exist
	public function vendor_check($data)
	{

		$vendor = $this->db->where(array('Vendor_Id'=>$data['Vendor_Id']))
					->where(array('Ecommerce_Id'=>$data['Ecommerce_Id']))
					->get('vendor')
					->row_array();

		return $vendor;
	}

	//inserting vendor 
	public function insert_vendor($data)
	{
		$item['first_name']   = $data['first_name'];
		$item['last_name']   = $data['last_name'];
		$item['added_date']   = $data['date'];
		$item['email']   = $data['email'];
		$item['mobile']   = $data['mobile'];

		//insert into user table for easy login system
		if (! empty($item['mobile'])) {
			$this->db->insert("user", $item);
			if ($insert = $this->db->insert_id()) {

				$vendor['Ecommerce_Id']   = $data['Ecommerce_Id'];
				$vendor['Vendor_Id']   = $data['Vendor_Id'];
				$vendor['date']   = $data['date'];
				$vendor['user_id']   = $insert;
				$vendor['name']   = $data['first_name']." ".$data['last_name'];

				$this->db->insert("vendor", $vendor);
				return true;
			}
		}

		return false;
	}

	//get ecommerce name
	public function ecommerce($data)
	{
		$name = $this->db->where(array('key_id'=>$data))
					->get('client')
					->row_array();

		return $name['client_name'];
	}

	//getting vendor name
	public function vendor($data)
	{
		$name = $this->db->where(array('Vendor_Id'=>$data))
					->get('vendor')
					->row_array();

		return $name['name'];
	}

	//getting a specific transaction
	public function transaction($data)
	{
		$name = $this->db->where(array('transaction_id'=>$data))
					->get('transactions')
					->row_array();

		return $name;
	}

}