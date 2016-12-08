<?php
class Secured_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	//insert open order
	public function open_order($data)
	{
		if ($insert = $this->db->insert("vat_on_hold_sweep_queue", $data)) {
			return true;
		}

		return false;
	}

	//updated close order
	public function close_order($data)
	{
		//calculating the output VAT
		$orders = $this->db->where(array('Transaction_Id'=>$data['Transaction_Id']))->where('Ecommerce_Id',$data['Ecommerce_Id'])->get('vat_on_hold_sweep_queue')->result_array();
		
		if (count($orders) > 0) {
		 	foreach ($orders as $order) {
		 		//check if the product category is Vatable

		 		//computing Output Vat for specific order
		 		$data1['Output_VAT'] = 0.05 * $order['Order_Amount'];

		 		//insert the output vat
		 		$this->db->where('Order_Id', $order['Order_Id']);
		 		$this->db->update('vat_on_hold_sweep_queue', $data1);
		 	}

		 	//close all the order within the specified transaction.
		 	$this->db->where('Transaction_Id', $data['Transaction_Id']);
		 	$this->db->update('vat_on_hold_sweep_queue', $data);

		 	return true;
		 } 

		 return false;
	}

	//Varifying Biller token
	public function token_verify($data)
	{
		$token = $this->db->where(array('token_id'=>$data))->get('client_settings')->row_array();

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

}